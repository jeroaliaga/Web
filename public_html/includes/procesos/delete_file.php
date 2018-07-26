<?php	
	include("../../includes/sitematrix/gral_data.php");
	$delete_file = $_POST['delete_file'];
	if($delete_file==''){
		$array_resultados = array(1,"Por favor seleccione un archivo.");
		echo json_encode($array_resultados);
	} else {
		$query="UPDATE adjuntos_x_publicacion SET active = '0' WHERE id = '$delete_file'; ";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
			$array_resultados = array(2,"Publicación eliminada!");
			echo json_encode($array_resultados);
		} else {
			$array_resultados = array(1,"Algo salio mal.  Por favor vuelva a intentarlo.");
			echo json_encode($array_resultados);
		}			
	}
?>