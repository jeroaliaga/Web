<?php
	$page_title = mysql_real_escape_string($_POST['page_title']);
	$page_content = $_POST['page_content'];
	$fecha_p = $_POST['fecha_publicacion'];
	$tags = $_POST['tags'];
	$fp = explode('/', $fecha_p);
	$fecha_publicacion = $fp[2].'-'.$fp[0].'-'.$fp[1];
	$img_publicacion_vieja = $_POST['img_publicacion_vieja'];
	
	$idPublicacion = $_POST['idPublicacion'];
	$parent = $_POST['parent'];
	$menu_parent = $_POST['menu_parent'];

	session_start();
	$_SESSION['page_title'] = $page_title;
	$_SESSION['page_content'] = $page_content;
	$_SESSION['fecha_publicacion'] = $fecha_p;
	
	/*Modulo subir imagen*/
	$file = $_POST['file'];
	$directorio_imagen_user = $ruta_raiz.'../static/img_publicaciones/';

	$nombre_archivo = $_FILES['file']['name'];
	$tamano_archivo = $_FILES['file']['size'];
	$file_tmp = $_FILES['file']['tmp_name'];
	$tipo_archivo = $_FILES['file']['type']; 

	if($nombre_archivo){
		if ($tipo_archivo == "image/gif" || $tipo_archivo == "image/jpeg" || $tipo_archivo == "image/jpg" || $tipo_archivo == "image/png"){		
			$hoy = date('Y-m-d');
			$rand = rand(0000,9999);
			$nombre_nuevo_archivo = $hoy.'_'.$rand.'_'. normaliza($nombre_archivo);
			//compruebo si las características del archivo son las que deseo 
			move_uploaded_file($file_tmp, $directorio_imagen_user.$nombre_nuevo_archivo);
			$img_publicacion = $nombre_nuevo_archivo;		
		}
	}
	/*Fin modulo subir imagen*/
	
	$page_type = '0';  //0=post, 1=page
	if($page_author){
		$page_author = $page_author;
	}
	$permalink = '';
	if($fecha_publicacion){
		$hoy_ahora = $fecha_publicacion;
	} else {
		$hoy_ahora = $hoy_y_ahora;
	}
	if($img_publicacion){ 
		$img = $img_publicacion; 
	} else {
		$img = $img_publicacion_vieja; 
	}
	$active = '1';
	if($_POST['tags']){
		$tags = $_POST['tags'];
	} else {
		$tags = '';
	}
	//$target = '_self';
	
	if($page_title=='' || $page_content==''){
		$estado_proceso = array('Por favor completa todos los campos.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	} else {
		//hago el ingreso a la ddbb
		$query="UPDATE publicaciones set page_title='".$page_title."', 
		page_content='$page_content', 
		page_type='".$page_type."', 
		permalink='".$permalink."', 
		hoy_ahora='".$hoy_ahora."', 
		img='".$img."' , 
		tags='".$tags."', ";
		if($page_author){
			$query.="page_author='".$page_author."', ";
		}
		if($parent){
			$query.="parent='".$parent."', ";
		}
		if($menu_parent){
			$query.="menu_parent='".$menu_parent."', ";
		}
		if($target){
			$query.="target='".$target."', ";
		}
		
		$query.="active='".$active."' WHERE id = '".$idPublicacion."'; ";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
			$estado_proceso = array('Publicación exitosa.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
			unset($_SESSION['fecha_publicacion']);
			unset($_SESSION['page_content']);
			unset($_SESSION['page_title']);
		} else {
			$estado_proceso = array('Algo salio mal.  Por favor vuelva a intentarlo.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
		}		
	}
?>