<?php
	require_once $ruta_raiz.'includes/modulos/Facebook/autoload.php';
	$fb = new Facebook\Facebook([
	  'app_id' => '609383382578270',
	  'app_secret' => '28b1f9f7bd100417e4dddc852cb8b8e1',
	  'default_graph_version' => 'v2.8',
	]);
	
	if($_GET['code']){
		$code = $_GET['code'];
	}

	if (isset($_SESSION['facebook_access_token'])) {
		$loginFB = TRUE;
	} else {
		if(!$code){
			//si no esta el token muestro el boton de logueo con FB
			$helper = $fb->getRedirectLoginHelper();
			$permissions = ['email']; // optional
			if($estoy == "registro-login"){
				$loginUrl = $helper->getLoginUrl('http://desaludhablamos.com/invitado/', $permissions);
			} else {
				$loginUrl = $helper->getLoginUrl('http://desaludhablamos.com/'.$estoy.'/?id='.$id, $permissions);
			}
			//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
			$loginFB = TRUE;
		} else {
			//si esta el token redirecciono al home
			$helper = $fb->getRedirectLoginHelper();
			try {
			$accessToken = $helper->getAccessToken();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  //echo 'Graph returned an error: ' . $e->getMessage();
			  //exit;
			  $loginFB = FALSE;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  //exit;
			  $loginFB = FALSE;
			}

			if (isset($accessToken)) {
				if (isset($_SESSION['facebook_access_token'])) {
					$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
				} else {
					$_SESSION['facebook_access_token'] = (string) $accessToken;
					// OAuth 2.0 client handler
					$oAuth2Client = $fb->getOAuth2Client();
					// Exchanges a short-lived access token for a long-lived one
					$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
					$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
					$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
				}
				// validating the access token
				try {
					$request = $fb->get('/me');
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
					// When Graph returns an error
					if ($e->getCode() == 190) {
						unset($_SESSION['facebook_access_token']);
						$helper = $fb->getRedirectLoginHelper();
						$loginUrl = $helper->getLoginUrl('http://desaludhablamos.com/'.$estoy.'/?id='.$id, $permissions);
						echo "<script>window.top.location.href='".$loginUrl."'</script>";
						exit;
					}
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
					// When validation fails or other local issues
					//echo 'Facebook SDK returned an error: ' . $e->getMessage();
					//exit;
					$loginFB = FALSE;
				}
				// getting basic info about user
				try {
					$profile_request = $fb->get('/me?fields=id,name,birthday,email,last_name,first_name,gender');
					$profile = $profile_request->getGraphNode()->asArray();
				} catch(Facebook\Exceptions\FacebookResponseException $e) {
					// When Graph returns an error
					echo 'Graph returned an error: ' . $e->getMessage();
					unset($_SESSION['facebook_access_token']);
					echo "<script>window.top.location.href='http://desaludhablamos.com/".$estoy."/?id=".$id."</script>";
					exit;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
					// When validation fails or other local issues
					//echo 'Facebook SDK returned an error: ' . $e->getMessage();
					//exit;
					$loginFB = FALSE;
				}
				// priting basic info about user on the screen
				// print_r($profile);
				$fblist_fbid = $profile['id'];
				$fblist_fullname = $profile['name'];
				$fblist_first_name = $profile['first_name'];
				$fblist_last_name = $profile['last_name'];
				$fblist_email = $profile['email'];
				$fblist_gender = $profile['gender'];
				$fblist_img = '//graph.facebook.com/'.$fblist_fbid.'/picture?type=large';
				
				$_SESSION['fblist_fbid'] = $fblist_fbid;
				
				// consulto la ddbb a ver si el usuario ya esta creado
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_aaa = "SELECT * from users where fb_id = '$fblist_fbid'";
				$R_aaa = mysql_query($query_R_aaa, $ddbb_naevp) or die(mysql_error());
				$row_R_aaa = mysql_fetch_assoc($R_aaa);
				$totalRows_R_aaa = mysql_num_rows($R_aaa);
				if($totalRows_R_aaa==0){
					// guardo los datos del usuario en la ddbb
					$query="INSERT into users (id, nombre, apellido, email, tipo_usuario, active, fecha_registro, img, fb_id) 
					VALUES(NULL, '$fblist_first_name', '$fblist_last_name', '$fblist_email', '3', '1', '$hoy_y_ahora', '$fblist_img', '$fblist_fbid'); ";
					mysql_select_db($database_name, $ddbb_naevp);
					if(mysql_query($query, $ddbb_naevp)){
						$redirect = TRUE;
					}
				} else {
					$redirect = TRUE;
				}
				
				if($redirect){
					// Now you can redirect to another page and use the access token from $_SESSION['facebook_access_token']		
					header('Location: http://desaludhablamos.com/'.$estoy.'/?id='.$id);
					exit();
				}
			} else {
				$helper = $fb->getRedirectLoginHelper();
				$loginUrl = $helper->getLoginUrl('http://desaludhablamos.com/'.$estoy.'/?id='.$id, $permissions);
				echo "<script>window.top.location.href='".$loginUrl."'</script>";
			}
		}
	}
?>