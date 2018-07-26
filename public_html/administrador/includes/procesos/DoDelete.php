<?php	
	$idPublicacion = $_POST['idPublicacion'];
	$parent = $_POST['parent'];
	
	//hago el ingreso a la ddbb
	$query="UPDATE publicaciones set active='0'	WHERE id = '".$idPublicacion."'; ";
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	if(mysql_query($query, $ddbb_naevp)){
		header('Location: '.$ruta_raiz.'listar_publicaciones.php?id='.$parent);
	} else {
		$estado_proceso = array('Algo salio mal.  Por favor vuelva a intentarlo.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	}		
?>