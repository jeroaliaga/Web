<?php
	$post_content = $_POST['post_content'];
	$post_parent = $_POST['post_parent'];
	
	$page_content = addslashes($post_content);
	$page_type = '0';  //0=post, 1=page
	$page_author = $_SESSION['id_usuario'];
	$permalink = '';
	$hoy_ahora = $hoy_y_ahora;
	$active = '1';
	$parent = $post_parent;
	
	if($post_content==''){
		$estado_proceso = array('Por favor completa todos los campos.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	} else {
		//hago el ingreso a la ddbb
		$query="INSERT into publicaciones (id, page_content, page_type, page_author, permalink, hoy_ahora, active, parent) 
		VALUES(NULL, '$page_content', '".$page_type."', '".$page_author."', '".$permalink."', '".$hoy_ahora."', '".$active."', '".$parent."'); ";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
			$estado_proceso = array('Publicación exitosa.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
			unset($_SESSION['post_tags']);
			unset($_SESSION['post_type']);
			unset($_SESSION['post_target']);
			unset($_SESSION['post_content']);
			unset($_SESSION['post_title']);
			header('Location: index.php?id='.$post_parent);
		} else {
			$estado_proceso = array('Algo salio mal.  Por favor vuelva a intentarlo.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
		}
	}
?>