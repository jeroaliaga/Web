<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "../";
	$estoy = "profesionales";
	$titulo_seccion = "Profesionales";
	$id = $_GET['id'];
	$espfilter = $_GET['espfilter'];
	$subespecialidad = $_GET['subespecialidad'];
	$pclinica = $_GET['pclinica'];
	$idiomas = $_GET['idiomas'];
	$tematicas = $_GET['tematicas'];
	$matencion = $_GET['matencion'];
	$mtrabajo = $_GET['mtrabajo'];
	$oclinica = $_GET['oclinica'];
	$osocial = $_GET['osocial'];
	$pesc = $_GET['pesc'];
	$aos = $_GET['aos'];
	$dpe = $_GET['dpe'];
	if($id){
		$bloque_carga = 'bloque_detalles-profesional.php';
	} else {
		$bloque_carga = 'bloque_resultados-profesionales.php';
	}
	include($ruta_raiz."includes/sitematrix/gral_data.php");
		//incluyo todos los modulos que necesito en el orden que se deben cargar
		$includes_array = array('navigation.php','bloque_head.php', $bloque_carga, 'footer.php');
	///Configuracion termina aqui
	
	///Consultas comunes
	include($ruta_raiz."includes/sitematrix/consultas.php");
	
	if(isset($_POST['action']) && $_POST['action'] == 'DoContactarProfesionalAction'){
		include($ruta_raiz."includes/procesos/DoContactarProfesionalAction.php");
	}
	if(isset($_POST['action']) && $_POST['action'] == 'DoCalificarProfesionalAction'){
		include($ruta_raiz."includes/procesos/DoCalificarProfesionalAction.php");
	}
	
	/*if(isset($_GET['extra-filters']) && $_GET['extra-filters'] == 'yes'){
		include($ruta_raiz."includes/procesos/DoBuscarProfesional.php");
	}*/

	///Modulo lenguajes
	//include($ruta_raiz."includes/sitematrix/modulo_lenguajes.php");
	///Page info
	include($ruta_raiz."includes/sitematrix/page_info.php");
	///Head
	include($ruta_raiz."includes/sitematrix/head.php");
?> 
<body>
	<?php include($ruta_raiz."includes/sitematrix/preloader.php"); ?>
	<?php
	foreach ($includes_array as $include_array){
		include($ruta_raiz."includes/contenidos/".$include_array);
	}
	///Scripts antes de cerrar el body
	include($ruta_raiz."includes/sitematrix/more_scripts.php");
	?>
</body>
</html>