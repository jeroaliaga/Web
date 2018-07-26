<?php
	$post_tags = mysql_real_escape_string($_POST['post_tags']);
	$post_type = mysql_real_escape_string($_POST['post_type']);
	$post_target = mysql_real_escape_string($_POST['post_target']);
	$post_content = $_POST['post_content'];
	$post_title = mysql_real_escape_string($_POST['post_title']);
	if($_POST['post_visibility']){
		$post_visibility = mysql_real_escape_string($_POST['post_visibility']);
	} else {
		$post_visibility = '0';
	}
	if($_POST['link_compra']){
		$link_compra = mysql_real_escape_string($_POST['link_compra']);
	} else {
		$link_compra = '';
	}
	
	/*echo $post_tags.' son los tags<br/>';
	echo $post_type.' es el post type<br/>';
	echo $post_target.' es el target<br/>';
	echo $post_content.' es el content<br/>';
	echo $post_title.' es el titulo<br/>';*/

	session_start();
	$_SESSION['post_tags'] = $post_tags;
	$_SESSION['post_type'] = $post_type;
	$_SESSION['post_target'] = $post_target;
	$_SESSION['post_content'] = $post_content;
	$_SESSION['post_title'] = $post_title;
	$_SESSION['post_visibility'] = $post_visibility;
	$_SESSION['link_compra'] = $link_compra;
	
	foreach($_FILES['archivos']['tmp_name'] as $key => $tmp_name ){
		$file_size =$_FILES['archivos']['size'][$key];
		if($file_size > 2097152){
			$estado_proceso = array('Algunos archivos no se pudieron subir debido a que son mayores a 2MB', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
			break;
		} else {
			$tiene_adjuntos = TRUE;
		}
	}
	
	$page_title = $post_title;
	$page_content = addslashes($post_content);
	$page_type = '0';  //0=post, 1=page
	$page_author = $_SESSION['id_usuario'];
	$permalink = '';
	$hoy_ahora = $hoy_y_ahora;
	$img = '';
	$active = '1';
	$tags = $post_tags;
	$parent = '0';
	$menu_parent = $post_type;
	$target = $post_target;
	$post_visibility = $post_visibility;
	
	if($post_type=='' || $post_target=='' || $post_content=='' || $post_title==''){
		$estado_proceso = array('Por favor completa todos los campos.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	} else {
		//hago el ingreso a la ddbb
		$query="INSERT into publicaciones (id, page_title, page_content, page_type, page_author, permalink, hoy_ahora, img, active, tags, parent, menu_parent, target, visibilidad, link_compra) 
		VALUES(NULL, '".$page_title."', '$page_content', '".$page_type."', '".$page_author."', '".$permalink."', '".$hoy_ahora."', '".$img."', '".$active."', '".$tags."', '".$parent."', '".$menu_parent."', '".$target."', '".$post_visibility."', '".$link_compra."'); ";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
		
			if($tiene_adjuntos){
				//si la publicacion tiene archivos los meto en la ddbb
				$id_publicacion = mysql_insert_id();
				$orden = 0;
				foreach($_FILES['archivos']['tmp_name'] as $key => $tmp_name ){
					$orden = $orden+1;
					$file_name = $key.$_FILES['archivos']['name'][$key];
					$file_size =$_FILES['archivos']['size'][$key];
					$file_tmp =$_FILES['archivos']['tmp_name'][$key];
					$file_type=$_FILES['archivos']['type'][$key];  
					
					$hoy = date('Y-m-d');
					$rand = rand(0000,9999);
					$file_nombre =$hoy.'_'.$rand.'_'.$file_name;
					$file_url = $ruta_absoluta.'static/docs/'.$file_nombre;
										
					if(move_uploaded_file($file_tmp,$ruta_raiz.'static/docs/'.$file_nombre)){
						//aca meto el archivo en la ddbb
						$query="INSERT into adjuntos_x_publicacion (id, id_publicacion, file_name, file_url, file_type, file_size, orden, hoy_ahora, active) 
						VALUES(NULL, '".$id_publicacion."', '".$file_name."', '".$file_url."', '".$file_type."', '".$file_size."', '".$orden."', '".$hoy_ahora."', '1'); ";
						mysql_select_db($database_name, $ddbb_naevp);
						mysql_query("SET NAMES 'utf8'");
						mysql_query($query, $ddbb_naevp);
					}
				}
			}
		
			$estado_proceso = array('Publicación exitosa.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
			unset($_SESSION['post_tags']);
			unset($_SESSION['post_type']);
			unset($_SESSION['post_target']);
			unset($_SESSION['post_content']);
			unset($_SESSION['post_title']);
			unset($_SESSION['post_visibility']);
			unset($_SESSION['link_compra']);
		} else {
			$estado_proceso = array('Algo salio mal.  Por favor vuelva a intentarlo.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
		}
	}
?>