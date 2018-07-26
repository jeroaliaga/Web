<?php
	$nombre_origen = $_POST['nombre_origen'];
	$email_origen = $_POST['email_origen'];
	$telefono_origen = $_POST['telefono_origen'];
	$mensaje = $_POST['mensaje'];
	$email_destino = $_POST['email_destino'];
	
	if($nombre_origen == '' || $email_origen  == '' || $mensaje == ''){
		$estado_proceso = array('Por favor complete todos los campos marcados con *.', 'alert-warning');
	} else {
		require ($ruta_raiz."includes/sitematrix/email_sender.php"); //email sender data
		$message = "
		DATOS DEL CONTACTO<br>
		Nombre: " . $nombre_origen . "<br>
		E-mail: " . $email_origen . "<br>
		Teléfono: " . $telefono_origen . "<br>
		MENSAJE<br>
		Mensaje: " . $mensaje . "<br>
		------------------------------------<br>
		Enviado el " . date('d/m/Y', time());"
		</html>
		";
		require $ruta_raiz.'includes/modulos/php-mailer/class.phpmailer.php';
		require $ruta_raiz.'includes/modulos/php-mailer/class.smtp.php'; //incluimos la clase para envíos por SMTP
		$mail = new PHPMailer();
		$mail->Host = $host_mail;
		$mail->Mailer ="mail";
		$mail->SMTPAuth = true;
		$mail->IsHTML(true);
		$mail->Username = $username_mail;
		$mail->Password = $password_mail;
		$mail->Subject = 'Mensaje de un usuario desde www.desaludhablamos.com';
		$mail->AddReplyTo($email_origen, $nombre_origen);
		$mail->From = $from_mail;
		$mail->FromName = $from_mail_name;
		$mail->AddAddress($email_destino);
		//$mail->AddAddress($destinatario_contacto);
		$mail->MsgHTML(utf8_decode($message));//cuerpo con html
		///$mail->AddAttachment("files/demo.zip");//adjuntos un archivo al mensaje	
		
		if($mail->Send()){						
			$estado_proceso = array('Mensaje correctamente enviado.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
		} else {
			$estado_proceso = array('Algo salió mal.  Por favor vuelva a intentarlo en unos minutos.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
		}
	}
	/*if ($_POST["g-recaptcha-response"]) {
		
		$captcha=$_POST["g-recaptcha-response"];
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => array(
				'secret' => $clave_secreta,
				'response' => $captcha
			)
		));
		$response = curl_exec($curl);
		curl_close($curl);
		if(strpos($response, '"success": true') !== FALSE) {
			$nombre_origen = $_POST['nombre_origen'];
			$email_origen = $_POST['email_origen'];
			$telefono_origen = $_POST['telefono_origen'];
			$mensaje = $_POST['mensaje'];
			$email_destino = $_POST['email_destino'];
			
			require ($ruta_raiz."includes/sitematrix/email_sender.php"); //email sender data
			$message = "
			DATOS DEL CONTACTO<br>
			Nombre: " . $nombre_origen . "<br>
			E-mail: " . $email_origen . "<br>
			Teléfono: " . $telefono_origen . "<br>
			MENSAJE<br>
			Mensaje: " . $mensaje . "<br>
			------------------------------------<br>
			Enviado el " . date('d/m/Y', time());"
			</html>
			";
			require $ruta_raiz.'includes/modulos/php-mailer/class.phpmailer.php';
			require $ruta_raiz.'includes/modulos/php-mailer/class.smtp.php'; //incluimos la clase para envíos por SMTP
			$mail = new PHPMailer();
			$mail->Host = $host_mail;
			$mail->Mailer ="mail";
			$mail->SMTPAuth = true;
			$mail->IsHTML(true);
			$mail->Username = $username_mail;
			$mail->Password = $password_mail;
			$mail->Subject = 'Mensaje de un usuario desde www.desaludhablamos.com';
			$mail->AddReplyTo($email_origen, $nombre_origen);
			$mail->From = $from_mail;
			$mail->FromName = $from_mail_name;
			$mail->AddAddress($email_destino);
			//$mail->AddAddress($destinatario_contacto);
			$mail->MsgHTML(utf8_decode($message));//cuerpo con html
			///$mail->AddAttachment("files/demo.zip");//adjuntos un archivo al mensaje	
			
			if($mail->Send()){						
				$estado_proceso = array('Mensaje correctamente enviado.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
			} else {
				$estado_proceso = array('Algo salió mal.  Por favor vuelva a intentarlo en unos minutos.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
			}
		} else {
			$estado_proceso = array("Por favor demuéstranos que no eres un robot.", 'alert-danger');
		}
	} else {
		$estado_proceso = array("Problemas de validación.", 'alert-danger');
	}*/
?>