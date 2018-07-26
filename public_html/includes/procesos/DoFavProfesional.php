<?php
	include("../../includes/sitematrix/gral_data.php");
	$id_profesional = $_POST['id_profesional'];
	$id_usuario = $_POST['id_usuario'];
	$action = $_POST['action'];
	
	if($id_profesional=='' || $id_usuario=='' || $action==''){
		$array_resultados = array(1,"Algo salio mal.  Por favor vuelva a intentarlo.");
		echo json_encode($array_resultados);
	} else {
		
		//reviso si ya esta entre los favoritos
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_fav_already = "select * from profesionales_favoritos where id_usuario='".$id_usuario."' and id_profesional='".$id_profesional."'";
		$R_fav_already = mysql_query($query_R_fav_already, $ddbb_naevp) or die(header($error_mysql));
		$row_R_fav_already = mysql_fetch_assoc($R_fav_already);
		$totalRows_RR_fav_already = mysql_num_rows($R_fav_already);
		
		if($totalRows_RR_fav_already==0){
			//hago el ingreso a la ddbb
			$query="INSERT into profesionales_favoritos (id, id_profesional, id_usuario) 
			VALUES(NULL, '".$id_profesional."', '".$id_usuario."'); ";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			mysql_query($query, $ddbb_naevp);
			$array_resultados = array(2,"Exito.");
			echo json_encode($array_resultados);
		} else {
			//hago el ingreso a la ddbb
			$query="DELETE from profesionales_favoritos WHERE id_usuario='".$id_usuario."' and id_profesional='".$id_profesional."'; ";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			mysql_query($query, $ddbb_naevp);
			$array_resultados = array(3,"Exito.");
			echo json_encode($array_resultados);
		}
	}
?>