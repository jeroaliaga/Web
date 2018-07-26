<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "./";
	$estoy = "login";
	///Configuracion termina aqui
	
	///Datos generales
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	//hago el log out
	if($_GET['exit'] && $_GET['exit']=='yes'){
		unset($_SESSION['usuarioregistrado']);
	}
	
	//proceso el login
	if(isset($_POST['submit']) && $_POST['submit'] == 'Ingresar'){

		$email = $_POST['email'];
		$password = $_POST['password'];

		if($email == "" || $password == ""){
		//Error que muestra si el campo user esta vacio
		$error_login = "Por favor ingrese su email y contraseña.";

		} else {
			///primero consulto que el usuario exista
			mysql_select_db($database_name, $ddbb_naevp);
			$query_R_user = "SELECT * from admin_users
			WHERE mail = '$email'";
			$R_user = mysql_query($query_R_user, $ddbb_naevp) or die(mysql_error());
			$row_R_user = mysql_fetch_assoc($R_user);
			$totalRows_R_user = mysql_num_rows($R_user);
			
			if($totalRows_R_user>0){
			
				if($row_R_user['password']==''){
					//ingreso por primera vez y establezco la contraseña
					$sql="UPDATE admin_users SET password = MD5('$password') WHERE mail = '$email';";
					if(mysql_query($sql,$ddbb_naevp)){
						///Esta todo bien y hace el logueo al sistema
						$valor_cookie = $row_R_user['id_usuario'];
						$_SESSION['usuarioregistrado'] = $valor_cookie;
						echo '<script>';
						echo 'window.location.replace("inicio.php");';
						echo '</script>';
						}
				} else {
					//ingreso comun y comparo la contraseña con la dada
					if($row_R_user['password']==md5($password)){
						///Esta todo bien y hace el logueo al sistema
						$valor_cookie = $row_R_user['id_usuario'];
						$_SESSION['usuarioregistrado'] = $valor_cookie;
						echo '<script>';
						echo 'window.location.replace("inicio.php");';
						echo '</script>';
						} else {
						$error_login = "La contraseña dada no concuerda con la del usuario.  Vuelva a intentarlo.";
					}
				}
			
			} else {
				$error_login = "Usuario inexistente.";
			}
		}
	}
	//fin proceso login

	///Modulo lenguajes
	//include($ruta_raiz."includes/sitematrix/modulo_lenguajes.php");
	///Page info
	include($ruta_raiz."includes/sitematrix/page_info.php");
	///Head
	include($ruta_raiz."includes/sitematrix/head.php");
?> 
<body>
	<?php include($ruta_raiz."includes/sitematrix/preloader.php"); ?>
    <?php
	///Secciones
	include($ruta_raiz."includes/contenidos/login.php");
	
	///Scripts antes de cerrar el body
	include($ruta_raiz."includes/sitematrix/more_scripts.php");
	?>
</body>
</html>
