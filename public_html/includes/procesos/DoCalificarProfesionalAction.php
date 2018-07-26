<?php
	$idProfesional = $_POST['idProfesional'];
	$calificacion = $_POST['calificacion'];
	$item = 0;
	foreach($calificacion as $cal){
		$item = $item + 1;
		//hago el ingreso a la ddbb
		$query="INSERT into calificacion_x_usuario (id, id_usuario, id_calificador, item, value) VALUES(NULL, '".$idProfesional."', '".$_SESSION['id_usuario']."', '".$item."', '".$cal."'); ";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		mysql_query($query, $ddbb_naevp);
	}
	$estado_proceso = array('Gracias por calificar al profesional.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
?>