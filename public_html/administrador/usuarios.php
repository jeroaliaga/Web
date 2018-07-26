<?php
	session_start();
	///Configuración empieza aqui
	$ruta_raiz = "./";
	//incluyo todos los modulos que necesito en el orden que se deben cargar
	$includes_array = array('navigation.php','listado_usuarios.php');
	///Configuracion termina aqui
	
	///Datos generales
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	///Expulsa
	include($ruta_raiz."includes/sitematrix/expulsa.php");
	
	///consulto el nombre de la seccion
	mysql_select_db($database_name, $ddbb_naevp);
	$query_R_section = "SELECT * FROM tipo_publicacion where id = '$id'";
	$R_section = mysql_query($query_R_section, $ddbb_naevp) or die(mysql_error());
	$row_R_section = mysql_fetch_assoc($R_section);
	$totalRows_R_section = mysql_num_rows($R_section);
	
	///Obtengo el listado de usuarios
	mysql_select_db($database_name, $ddbb_naevp);
	$query_R_list_usuarios = "SELECT users.*, tipo_usuarios.tipo_usuario as tipo_usuario_n
	FROM users, tipo_usuarios
	where users.tipo_usuario = tipo_usuarios.id
	order by fecha_registro desc";
	$R_list_usuarios = mysql_query($query_R_list_usuarios, $ddbb_naevp) or die(mysql_error());
	$row_R_list_usuarios = mysql_fetch_assoc($R_list_usuarios);
	$totalRows_R_list_usuarios = mysql_num_rows($R_list_usuarios);

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
