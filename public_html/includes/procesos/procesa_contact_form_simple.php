<?php
if(isset($_POST['enviar'])){

	//tomo todas las variables y las meto en un array
	foreach($_POST as $nombre_campo => $valor)
	{ 
		$asignacion[$nombre_campo]=$valor;
	}
	
	//elimino el ultimo valor que es el del boton
	array_pop($asignacion);
	
	//reviso que no haya nada vacio
	if(array_search("", $asignacion) == true){
	
		$error = "Por favor complete todos los campos solicitados.";
		
	} else {
	
		$header = "From: ".$sender_contact_form." \r\n";
		$header .= "Reply-To: " . $asignacion['Email'] . " \r\n";
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
		$header .= "Mime-Version: 1.0 \r\n";
		$header .= "Content-Type: text/html";

		$mensaje = "
		DATOS DEL CONTACTO<br>
		Nombre y apellido: " . $asignacion['Nombre'] . "<br>
		E-mail: " . $asignacion['Email'] . "<br>
		MENSAJE<br>
		Mensaje: " . $asignacion['Mensaje'] . "<br>
		------------------------------------<br>
		Enviado el " . date('d/m/Y', time());"
		</html>
		";
		
		$asignacion['email_destinatario']=$destinatario_contact_form;
		$asunto = $asignacion['asunto'];
		
		if(mail($asignacion['email_destinatario'], $asunto, utf8_decode($mensaje), $header)){
		
			$error = "Mensaje enviado correctamente.  Pronto nos pondremos en contacto con Ud.";
		
		}
		
	}
}
?>