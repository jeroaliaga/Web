<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "./";
	$id = $_GET["id"];
	$idPublicacion = $_GET["idPublicacion"];
	foreach($array_secciones as $seccion){
		if($seccion['id']==$id){
			$estoy = $seccion['name'];
		}
	}
	//incluyo todos los modulos que necesito en el orden que se deben cargar
	$includes_array = array('navigation.php','eliminar_publicacion.php');
	///Configuracion termina aqui
	
	///Datos generales
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	///Expulsa
	include($ruta_raiz."includes/sitematrix/expulsa.php");
	
	//Proceso el form de crear regalo
	if(isset($_POST['action']) && $_POST['action']=='DoDelete'){
		include($ruta_raiz."includes/procesos/DoDelete.php");
	} else {
		unset($_SESSION['fecha_publicacion']);
		unset($_SESSION['page_content']);
		unset($_SESSION['page_title']);
	}
	
	///consulto el nombre de la seccion
	mysql_select_db($database_name, $ddbb_naevp);
	$query_R_section = "SELECT * FROM tipo_publicacion where id = '$id'";
	$R_section = mysql_query($query_R_section, $ddbb_naevp) or die(mysql_error());
	$row_R_section = mysql_fetch_assoc($R_section);
	$totalRows_R_section = mysql_num_rows($R_section);
	
	///consulto la publicacion
	mysql_select_db($database_name, $ddbb_naevp);
	$query_R_info_publicacion = "SELECT * FROM publicaciones where id = '$idPublicacion'";
	$R_info_publicacion = mysql_query($query_R_info_publicacion, $ddbb_naevp) or die(mysql_error());
	$row_R_info_publicacion = mysql_fetch_assoc($R_info_publicacion);
	$totalRows_R_info_publicacion = mysql_num_rows($R_info_publicacion);
	
	if($totalRows_R_section==0 || $totalRows_R_info_publicacion==0){
		header('Location: '.$ruta_raiz.'inicio.php');
	}

	///Modulo lenguajes
	//include($ruta_raiz."includes/sitematrix/modulo_lenguajes.php");
	///Page info
	include($ruta_raiz."includes/sitematrix/page_info.php");
	///Head
	include($ruta_raiz."includes/sitematrix/head.php");
?> 
<body>
	<?php include($ruta_raiz."includes/sitematrix/preloader.php"); ?>
    <div id="wrapper">
	<?php
		foreach ($includes_array as $include_array)
		{
			include($ruta_raiz."includes/contenidos/".$include_array);
		}
	?>
	</div>
	<?php
	///Scripts antes de cerrar el body
	include($ruta_raiz."includes/sitematrix/more_scripts.php");
	?>
</body>
</html>
