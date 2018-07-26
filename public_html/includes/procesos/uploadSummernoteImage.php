<?php
$image = $_FILES['image']['name'];
$uploaddir = '../../static/img_publicaciones/';
      // that's the directory in the document_root where I put pics
	$uploadfile = $uploaddir . basename($image);
	if( move_uploaded_file($_FILES['image']['tmp_name'],$uploadfile)) {
		echo basename($image);
	} else {
		echo "Algo salio mal..."; // <= nobody is perfect :)
	}
?>