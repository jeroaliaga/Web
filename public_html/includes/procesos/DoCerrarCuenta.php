<?php
	$password = mysql_real_escape_string($_POST['password']);
	$id_user_delete = $_SESSION['id_usuario'];
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_login = "select * from users where id = '$id_user_delete' and pass = MD5('$password') and active = 1";
	$R_user_login = mysql_query($query_R_user_login, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_login = mysql_fetch_assoc($R_user_login);
	$totalRows_R_user_login = mysql_num_rows($R_user_login);
	if($totalRows_R_user_login>0){
		$query="UPDATE users SET active = 0 WHERE id = '$id_user_delete';";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
			echo '<script>';
			echo '	window.location = "http://desaludhablamos.com/?exit=yes";';
			echo '</script>';
		}
	} else {
		$estado_proceso = array("Por favor verifique su contraseña.", 'alert-warning');
	}
?>