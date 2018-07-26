<?php
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
		$nombre_nuevo_archivo = $hoy.'_'.$rand.'_'. trim($nombre_archivo);
		//compruebo si las características del archivo son las que deseo 
		move_uploaded_file($file_tmp, $directorio_imagen_user.$nombre_nuevo_archivo);
		$img_publicacion = $sitio_url.'static/img_publicaciones/'.$nombre_nuevo_archivo;		
	}
}
?>