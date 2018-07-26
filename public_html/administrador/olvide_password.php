<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "./";
	$estoy = "olvide_password";
	///Configuracion termina aqui
	
	///Datos generales
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	//proceso recupero password
	if(isset($_POST['submit']) && $_POST['submit'] == 'Recuperar'){

		$email = $_POST['email'];

		if($email == ""){
		//Error que muestra si el campo user esta vacio
		$error_login = "Por favor ingrese su email.";

		} else {
			///primero consulto que el usuario exista
			mysql_select_db($database_name, $ddbb_naevp);
			$query_R_user = "SELECT * from admin_users
			WHERE mail = '$email'";
			$R_user = mysql_query($query_R_user, $ddbb_naevp) or die(mysql_error());
			$row_R_user = mysql_fetch_assoc($R_user);
			$totalRows_R_user = mysql_num_rows($R_user);
			
			if($totalRows_R_user>0){
			
				$password = rand(000000,999999);
					
				//hago el update de la contraseña
				$sql="UPDATE admin_users SET password = MD5('$password') WHERE mail = '$email';";
				if(mysql_query($sql,$ddbb_naevp)){
						
						///Mando un mail con la contraseña nueva al usuario
						$mensaje = "
						Estimado ".$row_R_user['nombre'].":<br>
						Hemos generado una nueva contraseña para que pueda acceder a su cuenta de ".$panel_name.".<br>
						Contraseña temporal: ".$password."<br>
						Cuando ingrese al sistema podrá cambiarla por una de su elección.<br>
						------------------------------------<br>
						Enviado el " . date('d/m/Y', time());" <br>
						</html>
						";
						//echo $row_R_user['mail'].' es el email del destinatario<br/>';
						$header = 'From: ' . $row_R_user['mail'] . " \r\n";
						$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
						$header .= 'MIME-Version: 1.0' . "\r\n";
						$header .= "Content-Type: text/html; charset=UTF-8";
						$para = $row_R_user['mail'];
						$asunto = 'Recuperación de contraseña para '.$panel_name;
					
						if(mail($para, $asunto, $mensaje, $header)){					
							//header('Location: index.php');
							$error_login = "La nueva contraseña fue enviada a su correo.";
						}
				}
			
			} else {
				$error_login = "Usuario inexistente.";
			}
		}
	}
	//fin proceso recupero password

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
	include($ruta_raiz."includes/contenidos/recupero_password.php");
	
	///Scripts antes de cerrar el body
	include($ruta_raiz."includes/sitematrix/more_scripts.php");
	?>
</body>
</html>
