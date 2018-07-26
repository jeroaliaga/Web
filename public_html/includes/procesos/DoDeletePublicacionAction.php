<?php
	$idPublicacionEdit = $_POST['idPublicacionEdit'];
	$query="UPDATE publicaciones SET active = '0' WHERE id = '$idPublicacionEdit'; ";
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	if(mysql_query($query, $ddbb_naevp)){
		$estado_proceso = array('Publicación eliminada!.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	} else {
		$estado_proceso = array('Algo salio mal.  Por favor vuelva a intentarlo.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	}
?>