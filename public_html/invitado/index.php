<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "../";
	$estoy = "mi-perfil";
	$titulo_seccion = "Mis preferencias";
	$edit = $_GET['edit'];
	include($ruta_raiz."includes/sitematrix/gral_data.php");
		//incluyo todos los modulos que necesito en el orden que se deben cargar
		$includes_array = array('navigation.php','bloque_head.php', 'bloque_mis-preferencias.php','footer.php');
	///Configuracion termina aqui
	
	//modulo Facebook Logon
	include($ruta_raiz."includes/sitematrix/fb.php");
	
	if(!$_SESSION['id_usuario']){
		header('Location: '.$ruta_raiz.'login/');
		exit();
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'DoDeletePublicacionAction'){
		include($ruta_raiz."includes/procesos/DoDeletePublicacionAction.php");
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'DoGuardarPublicacion'){
		include($ruta_raiz."includes/procesos/DoGuardarPublicacion.php");
		$DoGuardarPublicacion = TRUE;
		$estado_proceso = array('Publicación guardada exitosamente.', 'alert-success'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	}
	
	///Consultas comunes
	include($ruta_raiz."includes/sitematrix/consultas.php");
	
	if(isset($_POST['action']) && $_POST['action'] == 'publish'){
		include($ruta_raiz."includes/procesos/publish.php");
		$DoPublish = TRUE;
	}
	
	if(isset($_POST['action']) && $_POST['action'] == 'DoGuardarPerfil'){
		include($ruta_raiz."includes/procesos/DoGuardarPerfil.php");
		$DoGuardarPerfil = TRUE;
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
	<?php
	foreach ($includes_array as $include_array){
		include($ruta_raiz."includes/contenidos/".$include_array);
	}
	///Scripts antes de cerrar el body
	include($ruta_raiz."includes/sitematrix/more_scripts.php");
	?>
</body>
</html>