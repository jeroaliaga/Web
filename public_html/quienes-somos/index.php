<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "../";
	$estoy = "quienes-somos";
	include($ruta_raiz."includes/sitematrix/gral_data.php");
		//incluyo todos los modulos que necesito en el orden que se deben cargar
		$includes_array = array('navigation.php','bloque_head.php', 'bloque_quienes_somos.php','bloque_suscripcion.php','footer.php');
	///Configuracion termina aqui
	
	///Consultas comunes
	include($ruta_raiz."includes/sitematrix/consultas.php");

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