<?php
$directorio_imagen_user = $ruta_raiz.'../static/img_productos/';


$array_imagenes = array();
foreach($_FILES['file']['tmp_name'] as $key => $tmp_name ){
	$file_name = $key.$_FILES['file']['name'][$key];
	$file_size =$_FILES['file']['size'][$key];
	$file_tmp =$_FILES['file']['tmp_name'][$key];
	$file_type=$_FILES['file']['type'][$key];  
	if($file_size > 2097152){
		$error = 'Algunos archivos no se pudieron subir debido a que son mayores a 2MB';
	}

	
	$hoy = date('Y-m-d');
	$rand = rand(0000,9999);
	$image =$hoy.'_'.$rand.'_'.strtr($file_name, $normalizeChars);
	
	if ($file_type == "image/gif" || $file_type == "image/jpeg" || $file_type == "image/jpg" || $file_type == "image/png"){		
		if(move_uploaded_file($file_tmp,$directorio_imagen_user.$image)){
			//aca el array de imagenes
			array_push($array_imagenes,$image);
		}
	}
}
if(count($array_imagenes)>0){
	$string_array_imagenes = serialize($array_imagenes);
}
?>