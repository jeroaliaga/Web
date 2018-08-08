<?php
	ini_set('error_reporting', E_ALL);error_reporting(E_ALL);
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "./";
	$estoy = "inicio";
	include($ruta_raiz."includes/sitematrix/gral_data.php");
		//incluyo todos los modulos que necesito en el orden que se deben cargar
		$includes_array = array('navigation.php', 'inicio.php','bloque_notas.php','bloque_suscripcion.php','footer.php');
	///Configuracion termina aqui
	
	if(isset($_POST['action']) && $_POST['action'] == 'DoBuscarProfesional'){
		include($ruta_raiz."includes/procesos/DoBuscarProfesional.php");
	}
	
	/*aca comienza el proceso de log out*/
	if($_GET['exit'] && $_GET['exit']=='yes'){
		session_start();
		unset($_SESSION['id_usuario']);
		unset($_SESSION['nombre_usr']);
		unset($_SESSION['apellido_usr']);
		unset($_SESSION['email_usr']);
		unset($_SESSION['tipo_usr']);
		unset($_SESSION['facebook_access_token']);
		unset($_SESSION['fblist_fbid']);
		setcookie("LoginCookie", "", time()-3600);
	}
	/*aca termina el proceso de log out*/
	
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
	<script src='static/js/run.js'></script>

</body>
</html>