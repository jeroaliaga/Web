<?php
	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$motivo = $_POST['motivo'];
	$mensaje = $_POST['mensaje'];
	
	//mando un email al usuario con los datos del registro
	require ($ruta_raiz."includes/sitematrix/email_sender.php"); //email sender data
	$message = "
	DATOS DEL CONTACTO<br>
	Nombre y apellido: " . $nombre . "<br>
	E-mail: " . $email . "<br>
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
	$mail->Subject = utf8_decode($motivo);
	$mail->AddReplyTo($email, $nombre);
	$mail->From = $from_mail;
	$mail->FromName = $from_mail_name;
	$mail->AddAddress($destinatario_contact_form);
	//$mail->AddAddress($destinatario_contacto);
	$mail->MsgHTML(utf8_decode($message));//cuerpo con html
	///$mail->AddAttachment("files/demo.zip");//adjuntos un archivo al mensaje	
	
	if($mail->Send()){						
		$estado_proceso = array('Mensaje correctamente enviado.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	}
?>