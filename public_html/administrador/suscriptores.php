<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "./";
	foreach($array_secciones as $seccion){
		if($seccion['id']==$id){
			$estoy = $seccion['name'];
		}
	}
	//incluyo todos los modulos que necesito en el orden que se deben cargar
	$includes_array = array('navigation.php','listado_suscriptores.php');
	///Configuracion termina aqui
	
	///Datos generales
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	///Expulsa
	include($ruta_raiz."includes/sitematrix/expulsa.php");
	
	///consulto el nombre de la seccion
	mysql_select_db($database_name, $ddbb_naevp);
	$query_R_section = "SELECT * FROM menu where id_menu = '$id'";
	$R_section = mysql_query($query_R_section, $ddbb_naevp) or die(mysql_error());
	$row_R_section = mysql_fetch_assoc($R_section);
	$totalRows_R_section = mysql_num_rows($R_section);
	
	///Obtengo el listado de suscriptores
	mysql_select_db($database_name, $ddbb_naevp);
	$query_R_list_publicaciones = "SELECT * FROM news order by id desc";
	$R_list_publicaciones = mysql_query($query_R_list_publicaciones, $ddbb_naevp) or die(mysql_error());
	$row_R_list_publicaciones = mysql_fetch_assoc($R_list_publicaciones);
	$totalRows_R_list_publicaciones = mysql_num_rows($R_list_publicaciones);

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
