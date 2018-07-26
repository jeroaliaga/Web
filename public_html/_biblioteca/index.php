<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "../";
	header('P3P: CP="CAO PSA OUR"');
	session_start();
	$estoy = "biblioteca";
	$tipo_publicacion_id = '5';
	$titulo_seccion = "Biblioteca";
	$id = $_GET['id'];
	$filtro = $_GET['filtro'];
	if($id){
		$bloque_carga = 'bloque_publicacion.php';
	} else {
		$bloque_carga = 'bloque_publicaciones.php';
	}
	include($ruta_raiz."includes/sitematrix/gral_data.php");
		//incluyo todos los modulos que necesito en el orden que se deben cargar
		$includes_array = array('navigation.php','bloque_head.php', $bloque_carga, 'bloque_comentarios.php','bloque_suscripcion.php','footer.php');
	///Configuracion termina aqui
	
	//modulo Facebook Logon
	include($ruta_raiz."includes/sitematrix/fb.php");
	
	///Consultas comunes
	include($ruta_raiz."includes/sitematrix/consultas.php");
	
	//publicacion
	if(isset($_POST['action']) && $_POST['action'] == 'publish'){
		include($ruta_raiz."includes/procesos/publish_response.php");
	}

	///Modulo lenguajes
	//include($ruta_raiz."includes/sitematrix/modulo_lenguajes.php");
	///Page info
	include($ruta_raiz."includes/sitematrix/page_info.php");
	///Head
	include($ruta_raiz."includes/sitematrix/head.php");
?> 
<body>
	<?php
	foreach ($includes_array as $include_array){
		include($ruta_raiz."includes/contenidos/".$include_array);
	}
	///Scripts antes de cerrar el body
	include($ruta_raiz."includes/sitematrix/more_scripts.php");
	?>
</body>
</html>