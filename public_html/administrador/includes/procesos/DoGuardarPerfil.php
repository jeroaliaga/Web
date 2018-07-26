<?php
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$email = $_POST['email'];
	$active = $_POST['active'];
	$tipo_usuario = $_POST['tipo_usuario'];
	$id_usuario_save = $_POST['id_usuario_save'];
	
	if($nombre=='' || $apellido=='' || $email==''){
		$estado_proceso = array('Por favor completa todos los campos.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	} else {
		//hago el ingreso a la ddbb
		$query="UPDATE users set nombre='".$nombre."', 
		apellido='".$apellido."', 
		email='".$email."', 
		active='".$active."', 
		tipo_usuario='".$tipo_usuario."' 
		WHERE id = '".$id_usuario_save."'; ";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
			$estado_proceso = array('Usuario editado correctamente.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
		} else {
			$estado_proceso = array('Algo salio mal.  Por favor vuelva a intentarlo.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
		}		
	}
?>