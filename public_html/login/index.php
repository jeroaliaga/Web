<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "../";
	$estoy = "login";
	$titulo_seccion = "Registro / Log In";
	include($ruta_raiz."includes/sitematrix/gral_data.php");
		//incluyo todos los modulos que necesito en el orden que se deben cargar
		$includes_array = array('navigation.php','bloque_head.php', 'bloque_registro-login.php','bloque_suscripcion.php','footer.php');
	///Configuracion termina aqui
	
	//modulo Facebook Logon
	include($ruta_raiz."includes/sitematrix/fb.php");
	
	///Consultas comunes
	include($ruta_raiz."includes/sitematrix/consultas.php");
	
	if(isset($_SESSION['facebook_access_token'])){
		echo "<script>window.top.location.href='http://desaludhablamos.com/invitado/'</script>";
		exit;
	}
	
	if(isset($_COOKIE['LoginCookie'])){
		$id_usuario = $_COOKIE['LoginCookie'];
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_login = "select * from users where id = '$id_usuario' and active = 1";
		$R_user_login = mysql_query($query_R_user_login, $ddbb_naevp) or die(header($error_mysql));
		$row_R_user_login = mysql_fetch_assoc($R_user_login);
		$totalRows_R_user_login = mysql_num_rows($R_user_login);
		
		if($totalRows_R_user_login>0){
			$id_usuario = $row_R_user_login['id'];
			session_start(); 
			$_SESSION['id_usuario'] = $id_usuario;
			$_SESSION['nombre_usr'] = $row_R_user_login['nombre'];
			$_SESSION['apellido_usr'] = $row_R_user_login['apellido'];
			$_SESSION['email_usr'] = $row_R_user_login['email'];
			$_SESSION['tipo_usr'] = $row_R_user_login['tipo_usuario'];
			$_SESSION['img_usr'] = $row_R_user_login['img'];
			$_SESSION['fullname'] = $row_R_user_login['nombre'].' '.$row_R_user_login['apellido'];
			header("Location: ".$ruta_raiz."mi-perfil/");
			exit();
		}
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'recupero'){
		
		session_start(); 
		$email = strip_tags($_POST['email']);
		
		if($email=='' ){
			$estado_proceso = array('Por favor ingrese su email.', 'alert-warning');
		} else {
			//consulto si ya hay alguien registrado con el mail
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			$query_R_aaa = "select * from users where email = '$email'";
			$R_aaa = mysql_query($query_R_aaa, $ddbb_naevp) or die(header($error_mysql));
			$row_R_aaa = mysql_fetch_assoc($R_aaa);
			$totalRows_R_aaa = mysql_num_rows($R_aaa);
			
			if($totalRows_R_aaa==0){
				$estado_proceso = array('El email ingresado no aparece entre nuestros registros.  Por favor vuelva a intentarlo.', 'alert-warning');
			} else {
				$id_usuario = $row_R_aaa['id'];
				$user_email = $row_R_aaa['email'];
				//creo una nueva password y hago el update en la ddbb
				$new_pass = rand(000000,999999);
				$sql="UPDATE users SET pass = MD5('$new_pass') WHERE id = '$id_usuario';";
				if(mysql_query($sql,$ddbb_naevp)){
					//mando mail al usuario con la nueva password
					//mando mail al usuario informando el dia y hora de la entrega
					//mando un email al usuario con los datos del registro
					require ($ruta_raiz."includes/sitematrix/email_sender.php"); //email sender data
					//$message = file_get_contents($ruta_absoluta.'includes/modulos/email_templates/detalle_compra.php?id='.$id_transaccion);
					$message = "Su nueva contraseña fue generada satisfactoriamente.<br/><br/>Nueva contraseña: ".$new_pass."<br/><br/>Por favor guarde este email o recuerde cambiar su contraseña por una que le sea facilmente recordable.";
					require $ruta_raiz.'includes/modulos/php-mailer/class.phpmailer.php';
					require $ruta_raiz.'includes/modulos/php-mailer/class.smtp.php'; //incluimos la clase para envíos por SMTP
					$mail = new PHPMailer();
					$mail->Host = $host_mail;
					$mail->Mailer ="mail";
					$mail->SMTPAuth = true;
					$mail->IsHTML(true);
					$mail->Username = $username_mail;
					$mail->Password = $password_mail;
					$mail->Subject = utf8_decode('Contraseña Recuperada');
					$mail->AddReplyTo($reply_to_email);
					$mail->From = $from_mail;
					$mail->FromName = $from_mail_name;
					$mail->AddAddress($user_email);					
					//$mail->AddAddress($destinatario_contacto);
					$mail->MsgHTML(utf8_decode($message));//cuerpo con html
					///$mail->AddAttachment("files/demo.zip");//adjuntos un archivo al mensaje	
					if($mail->Send()){
						$estado_proceso = array("La nueva contraseña le fue enviada por email a ".$user_email."<br/>Por favor recuerde cambiarla en algún momento.", 'alert-warning');
					} else {
						$estado_proceso = array("Ocurrio un error al intentar enviar su nueva contraseña por email a ".$mail."<br/>Por favor vuelva a intentarlo en unos minutos.", 'alert-warning');
					}
				}
			}
		}		
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'register'){
		
		session_start(); 
		$nombre = strip_tags($_POST['nombre']);
		$apellido = strip_tags($_POST['apellido']);
		if($_POST['tipo_registro']!='0'){
			$tipo_registro = $_POST['tipo_registro'];
		} else {
			$tipo_registro = '1';
		}
		$email = strip_tags($_POST['email']);
		$reemail = strip_tags($_POST['reemail']);
		$password = strip_tags($_POST['password']);
		$repassword = strip_tags($_POST['repassword']);	
		
		$_SESSION['nombre'] = $nombre;
		$_SESSION['apellido'] = $apellido;
		$_SESSION['tipo_registro'] = $tipo_registro;
		$_SESSION['email'] = $email;
		$_SESSION['reemail'] = $reemail;
		
		if($nombre=='' || $email=='' || $reemail=='' || $tipo_registro=='' ){
			$estado_proceso = array('Por favor complete todos los campos solicitados.', 'alert-warning');
		} else {
			if($apellido=='' && $tipo_registro=='1' ){
				$estado_proceso = array('Al registrarse como profesional el apellido es obligatorio.', 'alert-warning');
			} else {
				if($email!=$reemail){
					$estado_proceso = array('Por favor verifique que el email ingresado en ambos campos sea el mismo.', 'alert-warning');
				} else {
					if($password!=$repassword){
						$estado_proceso = array('Por favor verifique su contraseña.', 'alert-warning');
					} else {
						//consulto si ya hay alguien registrado con el mail
						mysql_select_db($database_name, $ddbb_naevp);
						mysql_query("SET NAMES 'utf8'");
						$query_R_aaa = "select * from users where email = '$email'";
						$R_aaa = mysql_query($query_R_aaa, $ddbb_naevp) or die(header($error_mysql));
						$row_R_aaa = mysql_fetch_assoc($R_aaa);
						$totalRows_R_aaa = mysql_num_rows($R_aaa);
						
						if($totalRows_R_aaa>0){
							$estado_proceso = array('El email ingresado ya está en uso.  Por favor use otro.', 'alert-warning');
						} else {
							
							///inserto los datos en la tabla customers
							$sql="INSERT INTO users (id, nombre, apellido, email, pass, tipo_usuario, active, fecha_registro) 
							VALUES (NULL, '$nombre', '$apellido', '$email', MD5('$password'), '$tipo_registro', '1', '$hoy_y_ahora');";
							if(mysql_query($sql,$ddbb_naevp)){
								unset($_SESSION['nombre']);
								unset($_SESSION['apellido']);
								unset($_SESSION['tipo_registro']);
								unset($_SESSION['email']);
								unset($_SESSION['reemail']);
								$estado_proceso = array('Usuario registrado correctamente.', 'alert-success');
								/*
								//mando un email al usuario con los datos del registro
								require ($ruta_raiz."includes/sitematrix/email_sender.php"); //email sender data
								$message = file_get_contents($ruta_absoluta.'includes/modulos/email_templates/welcome.php?password='.$password);
								require $ruta_raiz.'includes/modulos/php-mailer/class.phpmailer.php';
								require $ruta_raiz.'includes/modulos/php-mailer/class.smtp.php'; //incluimos la clase para envíos por SMTP
								$mail = new PHPMailer();
								$mail->Host = $host_mail;
								$mail->Mailer ="mail";
								$mail->SMTPAuth = true;
								$mail->IsHTML(true);
								$mail->Username = $username_mail;
								$mail->Password = $password_mail;
								$mail->Subject = utf8_decode('Bienvenido a TFG');
								//$mail->AddReplyTo($email, $nombre.' '.$apellido);
								$mail->From = $from_mail;
								$mail->FromName = $from_mail_name;
								$mail->AddAddress($email);
								//$mail->AddAddress($destinatario_contacto);
								$mail->MsgHTML(utf8_decode($message));//cuerpo con html
								///$mail->AddAttachment("files/demo.zip");//adjuntos un archivo al mensaje	
								if($mail->Send()){						
									$id_customer = mysql_insert_id();
									$_SESSION['id_customer'] = $id_customer;
									header('Location: '.$ruta_raiz.'carro/index.php');
								}
								*/						
							} else {
								$estado_proceso = array('Algo salio mal con el registro.  Por favor vuelva a intentarlo en unos minutos.', 'alert-warning');
							}
						}
					}
				}
			}
		}		
	} else {
		unset($_SESSION['nombre']);
		unset($_SESSION['apellido']);
		unset($_SESSION['tipo_registro']);
		unset($_SESSION['email']);
		unset($_SESSION['reemail']);
	}
	/*aca termina el proceso de registro*/

	///Modulo lenguajes
	//include($ruta_raiz."includes/sitematrix/modulo_lenguajes.php");
	///Page info
	include($ruta_raiz."includes/sitematrix/page_info.php");
	///Head
	include($ruta_raiz."includes/sitematrix/head.php");
?> 
<body>
	<?php
	foreach ($includes_array as $include_array){
		include($ruta_raiz."includes/contenidos/".$include_array);
	}
	///Scripts antes de cerrar el body
	include($ruta_raiz."includes/sitematrix/more_scripts.php");
	?>
</body>
</html>