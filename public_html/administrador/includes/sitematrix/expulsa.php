<?php
if(!$_SESSION['usuarioregistrado']){
  	header('Location: '.$ruta_raiz.'index.php');
} else {

	$id_user = $_SESSION['usuarioregistrado'];
	
	///consultas para obtener la info basica del usuario
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user = "select * from admin_users where id_usuario = '$id_user'";
	$R_user = mysql_query($query_R_user, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user = mysql_fetch_assoc($R_user);
	$totalRows_R_user = mysql_num_rows($R_user);
	
	$id_perfil = $row_R_user['id_perfil'];
	$id_usuario = $row_R_user['id_usuario'];

}
?>