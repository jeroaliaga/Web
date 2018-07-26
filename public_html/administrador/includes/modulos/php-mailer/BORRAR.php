<?php
require 'class.phpmailer.php';
require 'class.smtp.php'; //incluimos la clase para envíos por SMTP
 
$mail = new PHPMailer();
$mail->Host = "mail.inesco.com";
$mail->Mailer ="smtp";
$mail->SMTPAuth = true;
$mail->IsHTML(true);
$mail->Username = "rrhh@inesco.com";
$mail->Password = "rrhhinesco";
$mail->FromName="Pagina Web RRHH";
$mail->Subject="Nuevo Curriculum";
$mail->From = "rrhh@inesco.com";

$mail->AddAddress('lucianomdq@gmail.com','');	
				
$mail->MsgHTML('Mensaje con HTML');//cuerpo con html
 
$mail->AddAttachment("files/demo.zip");//adjuntos un archivo al mensaje
 
if(!$mail->Send()) {//finalmente enviamos el email
   echo $mail->ErrorInfo;//si no se envía correctamente se muestra el error que ocurrió
} else {
   echo 'Correo enviado correctamente';
}
?>