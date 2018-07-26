<?php	
	//tomo las variables
	$id_usuario_p = $_POST['id_usuario_p'];
	$password = strip_tags($_POST['password']);
	$repassword = strip_tags($_POST['repassword']);
	
	if($password!=$repassword){
		$estado_proceso = array('Las contraseñas ingresadas no coinciden.', 'alert-danger'); //mensaje del alerta, tipo de alerta
	} else {
		//hago el update en la ddbb
		$query="UPDATE admin_users SET password = MD5('$password') WHERE id_usuario = '$id_usuario_p';";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
		
			$estado_proceso = array('La contraseña se ha editado correctamente.', 'alert-success'); //mensaje del alerta, tipo de alerta
		
		}
	}
?>

				