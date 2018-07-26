<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "./";
	$estoy = "cambiar_password";

		//incluyo todos los modulos que necesito en el orden que se deben cargar
		$includes_array = array('navigation.php','cambiar_password.php');
	///Configuracion termina aqui
	
	///Datos generales
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	//form del buscador de propiedades por ID
	if(isset($_POST['id_transaccion'])){
		include($ruta_raiz."includes/procesos/id_transaccion.php");
	}
	
	//Proceso el form de editar usuario
	if(isset($_POST['submit_guardar_password'])){
		include($ruta_raiz."includes/procesos/cambia_password.php");
	}
	
	///Expulsa
	include($ruta_raiz."includes/sitematrix/expulsa.php");

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
