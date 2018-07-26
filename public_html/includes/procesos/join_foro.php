<?php
	include("../../includes/sitematrix/gral_data.php");
	$id_publicacion = $_POST['id_publicacion'];
	$id_usuario = $_POST['id_usuario'];
	$action = $_POST['action'];
	
	if($id_publicacion=='' || $id_usuario=='' || $action==''){
		$array_resultados = array(1,"Algo salio mal.  Por favor vuelva a intentarlo.");
		echo json_encode($array_resultados);
	} else {
		if($action=='join'){
			//hago el ingreso a la ddbb
			$query="INSERT into grupos_discusion (id, id_usuario, id_publicacion) 
			VALUES(NULL, '".$id_usuario."', '".$id_publicacion."'); ";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			mysql_query($query, $ddbb_naevp);
			$array_resultados = array(2,"Exito.");
			echo json_encode($array_resultados);
		}
		if($action=='unjoin'){
			//hago el ingreso a la ddbb
			$query="DELETE from grupos_discusion WHERE id_usuario='".$id_usuario."' and id_publicacion='".$id_publicacion."'; ";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			mysql_query($query, $ddbb_naevp);
			$array_resultados = array(2,"Exito.");
			echo json_encode($array_resultados);
		}
	}
?>