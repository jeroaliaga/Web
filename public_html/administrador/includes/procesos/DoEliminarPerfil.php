<?php
	$id_usuario_save = $_POST['id_usuario_save'];
	

	//hago el ingreso a la ddbb
	$query="DELETE from users WHERE id = '".$id_usuario_save."'; ";
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	if(mysql_query($query, $ddbb_naevp)){
		header('Location: '.$ruta_raiz.'usuarios.php');
	} else {
		$estado_proceso = array('Algo salio mal.  Por favor vuelva a intentarlo.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	}		
?>