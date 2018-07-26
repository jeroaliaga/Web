<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "./";
	$id = $_GET["id"];
	foreach($array_secciones as $seccion){
		if($seccion['id']==$id){
			$estoy = $seccion['name'];
		}
	}
	//incluyo todos los modulos que necesito en el orden que se deben cargar
	$includes_array = array('navigation.php','nueva_publicacion.php');
	///Configuracion termina aqui
	
	///Datos generales
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	///Expulsa
	include($ruta_raiz."includes/sitematrix/expulsa.php");
	
	//Proceso el form de crear regalo
	if(isset($_POST['action']) && $_POST['action']=='DoPublish'){
		include($ruta_raiz."includes/procesos/DoPublish.php");
	} else {
		unset($_SESSION['fecha_publicacion']);
		unset($_SESSION['page_content']);
		unset($_SESSION['page_title']);
	}
	
	///consulto el nombre de la seccion
	mysql_select_db($database_name, $ddbb_naevp);
	$query_R_section = "SELECT * FROM menu where id_menu = '$id'";
	$R_section = mysql_query($query_R_section, $ddbb_naevp) or die(mysql_error());
	$row_R_section = mysql_fetch_assoc($R_section);
	$totalRows_R_section = mysql_num_rows($R_section);

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
