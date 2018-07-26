<?php
	session_start();
	$ruta_raiz = "../../";
	include($ruta_raiz."includes/sitematrix/gral_data.php");

	//Consulto las actividades que vencen hoy
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_act = "select publicaciones.*, users.nombre, users.apellido, users.email
	from publicaciones, users 
	where publicaciones.menu_parent = '7' 
	and publicaciones.page_author = users.id
	and date(publicaciones.hoy_ahora) = '$hoy_y_ahora'";
	$R_act = mysql_query($query_R_act, $ddbb_naevp) or die(mysql_error());
	$row_R_act = mysql_fetch_assoc($R_act);
	$totalRows_R_act = mysql_num_rows($R_act);
	if($totalRows_R_act>0){
	
		require ($ruta_raiz."includes/sitematrix/email_sender.php"); //email sender data
		require $ruta_raiz.'includes/modulos/php-mailer/class.phpmailer.php';
		require $ruta_raiz.'includes/modulos/php-mailer/class.smtp.php'; //incluimos la clase para envíos por SMTP
		
		do {
			
			$page_title = $row_R_act['page_title'];
			$nombre = $row_R_act['nombre'];
			$apellido = $row_R_act['apellido'];
			$email = $row_R_act['email'];
			
			$message = '
			Hola ' . $nombre . '!<br><br>
			Queremos avisarte que la actividad <strong>' . $page_title . '</strong> termina hoy y dejará de estar visible desde la página www.desaludhablamos.com<br>
			Si quieres cambiar la fecha y que siga activa por favor haz click <a href="http://desaludhablamos.com/mi-perfil/?edit='.$row_R_act['id'].'" title="Editar actividad">AQUI</a><br/><br/> 
			------------------------------------<br>
			Enviado el ' . date('d/m/Y', time()).'</html>';
			$mail = new PHPMailer();
			$mail->Host = $host_mail;
			$mail->Mailer ="mail";
			$mail->SMTPAuth = true;
			$mail->IsHTML(true);
			$mail->Username = $username_mail;
			$mail->Password = $password_mail;
			$mail->Subject = 'Informacion importante desde www.desaludhablamos.com';
			$mail->AddReplyTo($email_origen, $nombre_origen);
			$mail->From = $from_mail;
			$mail->FromName = $from_mail_name;
			$mail->AddAddress($email);
			//$mail->AddAddress($destinatario_contacto);
			$mail->MsgHTML(utf8_decode($message));//cuerpo con html
			///$mail->AddAttachment("files/demo.zip");//adjuntos un archivo al mensaje	
			$mail->Send();
			
		} while ($row_R_act = mysql_fetch_assoc($R_act));
	} else {
		echo "nada para actualizar";
	}
?>