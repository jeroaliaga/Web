<?php
	//Consultas
	if($_SESSION['tipo_usr']==1 || $_SESSION['tipo_usr']==2){
		/*if($_SESSION['tipo_usr']==1){
			$target_publicaciones = '3,1';
		} else {
			$target_publicaciones = '3,2';
		}*/
		$target_publicaciones = '3,2,1';
	} else {
		$target_publicaciones = '3';
	}
	
	//login al sistema como PROFESIONAL o INSTITUCION
	if(isset($_POST['action']) && $_POST['action'] == 'login'){
		$email = strip_tags($_POST['email']);
		$password = strip_tags($_POST['password']);
		$remember_me = $_POST['remember_me'];
		
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_login = "select * from users where email = '$email' and pass = MD5('$password') and active = 1";
		$R_user_login = mysql_query($query_R_user_login, $ddbb_naevp) or die(header($error_mysql));
		$row_R_user_login = mysql_fetch_assoc($R_user_login);
		$totalRows_R_user_login = mysql_num_rows($R_user_login);
		
		if($totalRows_R_user_login>0){
			$id_usuario = $row_R_user_login['id'];
			session_start(); 
			$_SESSION['id_usuario'] = $id_usuario;
			$_SESSION['nombre_usr'] = $row_R_user_login['nombre'];
			$_SESSION['apellido_usr'] = $row_R_user_login['apellido'];
			$_SESSION['email_usr'] = $row_R_user_login['email'];
			$_SESSION['tipo_usr'] = $row_R_user_login['tipo_usuario'];
			$_SESSION['img_usr'] = $row_R_user_login['img'];
			$_SESSION['tipo_usuario'] = $row_R_user_login['tipo_usuario'];
			$_SESSION['fullname'] = $row_R_user_login['nombre'].' '.$row_R_user_login['apellido'];
			if($remember_me){
				setcookie("LoginCookie",$id_usuario,time()+31556926 ,'/');
			}
			header("Location: ".$ruta_raiz."mi-perfil/");
			exit();
		} else {
			$estado_proceso = array('Los datos proporcionados son incorrectos.  Por favor revise y vuelva a intentarlo.', 'alert-warning');
		}
	}
	
	//login al sistema como PACIENTE
	if(isset($_SESSION['fblist_fbid'])){
		$fblist_fbid = $_SESSION['fblist_fbid'];
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_login = "select * from users where fb_id = '$fblist_fbid' and active = 1";
		$R_user_login = mysql_query($query_R_user_login, $ddbb_naevp) or die(header($error_mysql));
		$row_R_user_login = mysql_fetch_assoc($R_user_login);
		$totalRows_R_user_login = mysql_num_rows($R_user_login);
		
		if($totalRows_R_user_login>0){
			$id_usuario = $row_R_user_login['id'];
			session_start(); 
			$_SESSION['id_usuario'] = $id_usuario;
			$_SESSION['nombre_usr'] = $row_R_user_login['nombre'];
			$_SESSION['apellido_usr'] = $row_R_user_login['apellido'];
			$_SESSION['email_usr'] = $row_R_user_login['email'];
			$_SESSION['tipo_usr'] = $row_R_user_login['tipo_usuario'];
			$_SESSION['fullname'] = $row_R_user_login['nombre'].' '.$row_R_user_login['apellido'];
		} else {
			$estado_proceso = array('Los datos proporcionados son incorrectos.  Por favor revise y vuelva a intentarlo.', 'alert-warning');
		}
	}
	
	//Obtengo el listado de especialidades
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_especialidades = "select * from especialidades where active = 1 and parent = 0 order by nombre asc";
	$R_especialidades = mysql_query($query_R_especialidades, $ddbb_naevp) or die(mysql_error());
	$row_R_especialidades = mysql_fetch_assoc($R_especialidades);
	$totalRows_R_especialidades = mysql_num_rows($R_especialidades);
	if($totalRows_R_especialidades>0){
		$arr_especialidades = array();
		do {
			$arr_especialidades[] = array("id" => $row_R_especialidades['id'],
								"nombre"  => $row_R_especialidades['nombre'],
								"tipo"  => $row_R_especialidades['tipo'],
								"parent" => $row_R_especialidades['parent']);
		} while ($row_R_especialidades = mysql_fetch_assoc($R_especialidades));
	}
	
	//Obtengo los nombres de los registros
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_listado_nombre = "select * from users where tipo_usuario IN (1,2) order by apellido asc, nombre asc";
	$R_listado_nombre = mysql_query($query_R_listado_nombre, $ddbb_naevp) or die(mysql_error());
	$row_R_listado_nombre = mysql_fetch_assoc($R_listado_nombre);
	$totalRows_R_listado_nombre = mysql_num_rows($R_listado_nombre);
	if($totalRows_R_listado_nombre>0){
		$arr_nombres_profesionales = array();
		do {
			$arr_nombres_profesionales[] = array("id" => $row_R_listado_nombre['id'],
								"nombre"  => $row_R_listado_nombre['nombre'],
								"apellido"  => $row_R_listado_nombre['apellido']);
		} while ($row_R_listado_nombre = mysql_fetch_assoc($R_listado_nombre));
	}
	
	//Obtengo los nombres de las ciudades
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_listado_ciudades = "select distinct(ciudad) as ciudad, id_ciudad, estado, pais from consultorio_x_usuario order by ciudad asc";
	$R_listado_ciudades = mysql_query($query_R_listado_ciudades, $ddbb_naevp) or die(mysql_error());
	$row_R_listado_ciudades = mysql_fetch_assoc($R_listado_ciudades);
	$totalRows_R_listado_ciudades = mysql_num_rows($R_listado_ciudades);
	if($totalRows_R_listado_ciudades>0){
		$arr_ciudades_profesionales = array();
		do {
			$arr_ciudades_profesionales[] = array(
				"ciudad" => $row_R_listado_ciudades['ciudad'],
				"id_ciudad" => $row_R_listado_ciudades['id_ciudad'],
				"estado" => $row_R_listado_ciudades['estado'],
				"pais" => $row_R_listado_ciudades['pais']
			);
		} while ($row_R_listado_ciudades = mysql_fetch_assoc($R_listado_ciudades));
	}
	
	//Obtengo los tipo de usuarios
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_tipo_usuario = "select * from tipo_usuarios where active = 1 order by tipo_usuario asc";
	$R_tipo_usuario = mysql_query($query_R_tipo_usuario, $ddbb_naevp) or die(mysql_error());
	$row_R_tipo_usuario = mysql_fetch_assoc($R_tipo_usuario);
	$totalRows_R_tipo_usuario = mysql_num_rows($R_tipo_usuario);
	
	if($estoy=='mi-perfil'){
		//Obtengo el listado de paises
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_paises = "select * from paises where active = 1 order by pais asc";
		$R_paises = mysql_query($query_R_paises, $ddbb_naevp) or die(header($error_mysql));
		$row_R_paises = mysql_fetch_assoc($R_paises);
		$totalRows_R_paises = mysql_num_rows($R_paises);
		if($totalRows_R_paises>0){
			$array_paises = array();
			do {
				$array_paises[] = array(
					"id" => $row_R_paises['id'],
					"name" => $row_R_paises['pais'],
					"name_short" => $row_R_paises['pais_short']
				);							
			} while ($row_R_paises = mysql_fetch_assoc($R_paises));
		}
		//Obtengo el listado de especialidades
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_esp = "select * from especialidades where active = 1 and parent = 0 order by orden asc, nombre asc";
		$R_esp = mysql_query($query_R_esp, $ddbb_naevp) or die(header($error_mysql));
		$row_R_esp = mysql_fetch_assoc($R_esp);
		$totalRows_R_esp = mysql_num_rows($R_esp);
		//Obtengo el listado de poblaciones clinicas
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_pc = "select * from poblacion_clinica where active = 1 order by poblacion asc";
		$R_pc = mysql_query($query_R_pc, $ddbb_naevp) or die(header($error_mysql));
		$row_R_pc = mysql_fetch_assoc($R_pc);
		$totalRows_R_pc = mysql_num_rows($R_pc);
		//Obtengo el listado de modalidades de atencion
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_ma = "select * from modalidad_atencion where active = 1 order by modalidad_atencion asc";
		$R_ma = mysql_query($query_R_ma, $ddbb_naevp) or die(header($error_mysql));
		$row_R_ma = mysql_fetch_assoc($R_ma);
		$totalRows_R_ma = mysql_num_rows($R_ma);
		//Obtengo el listado de modalidades de trabajo
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_mt = "select * from modalidad_trabajo where active = 1 order by modalidad_trabajo asc";
		$R_mt = mysql_query($query_R_mt, $ddbb_naevp) or die(header($error_mysql));
		$row_R_mt = mysql_fetch_assoc($R_mt);
		$totalRows_R_mt = mysql_num_rows($R_mt);
		//Obtengo el listado de idiomas
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_idi = "select * from idiomas where active = 1 order by orden asc, nombre asc";
		$R_idi = mysql_query($query_R_idi, $ddbb_naevp) or die(header($error_mysql));
		$row_R_idi = mysql_fetch_assoc($R_idi);
		$totalRows_R_idi = mysql_num_rows($R_idi);
		//Obtengo el listado de obras sociales
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_os = "select * from obras_sociales where active = 1 order by nombre asc";
		$R_os = mysql_query($query_R_os, $ddbb_naevp) or die(header($error_mysql));
		$row_R_os = mysql_fetch_assoc($R_os);
		$totalRows_R_os = mysql_num_rows($R_os);
		//Obtengo el listado de tematicas
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_tem = "select * from tematicas where active = 1 order by nombre asc";
		$R_tem = mysql_query($query_R_tem, $ddbb_naevp) or die(header($error_mysql));
		$row_R_tem = mysql_fetch_assoc($R_tem);
		$totalRows_R_tem = mysql_num_rows($R_tem);
		//Obtengo el listado de orientaciones clinicas
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_ocl = "select * from orientacion_clinica where active = 1 order by nombre asc";
		$R_ocl = mysql_query($query_R_ocl, $ddbb_naevp) or die(header($error_mysql));
		$row_R_ocl = mysql_fetch_assoc($R_ocl);
		$totalRows_R_ocl = mysql_num_rows($R_ocl);
		
		//Obtengo los tipo de usuarios destinatarios de los posts
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_tipo_usuario_p = "select * from tipo_usuarios order by tipo_usuario asc";
		$R_tipo_usuario_p = mysql_query($query_R_tipo_usuario_p, $ddbb_naevp) or die(mysql_error());
		$row_R_tipo_usuario_p = mysql_fetch_assoc($R_tipo_usuario_p);
		$totalRows_R_tipo_usuario_p = mysql_num_rows($R_tipo_usuario_p);
		if($totalRows_R_tipo_usuario_p>0){
			$tipo_usuarios_array = array();
			do {
				$tipo_usuarios_array[] = array("id"  => $row_R_tipo_usuario_p['id'],"tipo_usuario"  => $row_R_tipo_usuario_p['tipo_usuario']);
			} while ($row_R_tipo_usuario_p = mysql_fetch_assoc($R_tipo_usuario_p));
		}
		//Obtengo los tipos de publicacion
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_tipo_p = "select * from tipo_publicacion where parent = 0 order by tipo_publicacion asc";
		$R_tipo_p = mysql_query($query_R_tipo_p, $ddbb_naevp) or die(mysql_error());
		$row_R_tipo_p = mysql_fetch_assoc($R_tipo_p);
		$totalRows_R_tipo_p = mysql_num_rows($R_tipo_p);
		if($totalRows_R_tipo_p>0){
			$tipo_publicacion_array = array();
			do {
				$tipo_publicacion_array[] = array("id"  => $row_R_tipo_p['id'],"tipo_publicacion"  => $row_R_tipo_p['tipo_publicacion']);
			} while ($row_R_tipo_p = mysql_fetch_assoc($R_tipo_p));
		}
	}
	
	//Obtengo las notas (ultimas 10)
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_notas = "select * 
	from publicaciones 
	where menu_parent = 1 
	and target IN ($target_publicaciones) 
	order by hoy_ahora desc 
	limit 6";
	$R_notas = mysql_query($query_R_notas, $ddbb_naevp) or die(mysql_error());
	$row_R_notas = mysql_fetch_assoc($R_notas);
	$totalRows_R_notas = mysql_num_rows($R_notas);
	
	if($estoy!="profesionales"&&$id){
		//obtengo los detalles de la publicacion
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_publicacion = "select publicaciones.*, users.*, users.img as user_img, publicaciones.img as publicacion_img
		from publicaciones, users
		where publicaciones.id = $id 
		and publicaciones.parent = '0' 
		and publicaciones.page_author = users.id";
		$R_publicacion = mysql_query($query_R_publicacion, $ddbb_naevp) or die(mysql_error());
		$row_R_publicacion = mysql_fetch_assoc($R_publicacion);
		$totalRows_R_publicacion = mysql_num_rows($R_publicacion);
		if($totalRows_R_publicacion<1){
			header('Location: '.$ruta_raiz.'index.php');
		}
		//obtengo los comentarios de la publicacion
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_publicacion_com = "select publicaciones.*, users.*
		from publicaciones, users
		where publicaciones.parent = $id 
		and publicaciones.page_author = users.id 
		order by hoy_ahora desc";
		$R_publicacion_com = mysql_query($query_R_publicacion_com, $ddbb_naevp) or die(mysql_error());
		$row_R_publicacion_com = mysql_fetch_assoc($R_publicacion_com);
		$totalRows_R_publicacion_com = mysql_num_rows($R_publicacion_com);
		
		//a partir del usuario de la publicacion voy a obtener algunos datos extra
		$page_author = $row_R_publicacion['page_author'];
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_page_author_extra_info = "select * from users_info where id_usuario = '$page_author'";
		$R_page_author_extra_info = mysql_query($query_R_page_author_extra_info, $ddbb_naevp) or die(mysql_error());
		$row_R_page_author_extra_info = mysql_fetch_assoc($R_page_author_extra_info);
		$totalRows_R_page_author_extra_info = mysql_num_rows($R_page_author_extra_info);
	}
	
	if($estoy=="profesionales"&&$id){
		//obtengo todos los datos del profesional
		
		//consulto los datos basicos del profesional
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_basic = "select * from users where id = '$id'";
		$R_user_basic = mysql_query($query_R_user_basic, $ddbb_naevp) or die(mysql_error());
		$row_R_user_basic = mysql_fetch_assoc($R_user_basic);
		$totalRows_R_user_basic = mysql_num_rows($R_user_basic);
		
		//consulto la cantidad de publicaciones
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_publicaciones = "select * from publicaciones where parent = '0' and active = '1' and page_author = '$id'";
		$R_user_publicaciones = mysql_query($query_R_user_publicaciones, $ddbb_naevp) or die(mysql_error());
		$row_R_user_publicaciones = mysql_fetch_assoc($R_user_publicaciones);
		$totalRows_R_user_publicaciones = mysql_num_rows($R_user_publicaciones);
		if($totalRows_R_user_publicaciones==0){
			$total_publicaciones = $totalRows_R_user_publicaciones;
		} else {
			$total_publicaciones = '0';
		}
		
		//consulto el perfil del profesional
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_perfil = "select * from users_info where id_usuario = '$id'";
		$R_user_perfil = mysql_query($query_R_user_perfil, $ddbb_naevp) or die(mysql_error());
		$row_R_user_perfil = mysql_fetch_assoc($R_user_perfil);
		$totalRows_R_user_perfil = mysql_num_rows($R_user_perfil);
		
		//consulto el/los consultorios
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_cons = "select * from consultorio_x_usuario where id_usuario = '$id'";
		$R_user_cons = mysql_query($query_R_user_cons, $ddbb_naevp) or die(mysql_error());
		$row_R_user_cons = mysql_fetch_assoc($R_user_cons);
		$totalRows_R_user_cons = mysql_num_rows($R_user_cons);
		
		//consulto las opciones del profesional (especialidades)
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_oxu_esp = "select especialidades.nombre as nombre
		from especialidades, opciones_x_usuario 
		where opciones_x_usuario.id_usuario = '$id' 
		and opciones_x_usuario.grupo_opciones = 1
		and opciones_x_usuario.id_opcion = especialidades.id order by especialidades.nombre asc";
		$R_oxu_esp = mysql_query($query_R_oxu_esp, $ddbb_naevp) or die(mysql_error());
		$row_R_oxu_esp = mysql_fetch_assoc($R_oxu_esp);
		$totalRows_R_oxu_esp = mysql_num_rows($R_oxu_esp);
		
		//consulto las opciones del profesional (idiomas)
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_oxu_idi = "select idiomas.nombre as nombre
		from idiomas, opciones_x_usuario 
		where opciones_x_usuario.id_usuario = '$id' 
		and opciones_x_usuario.grupo_opciones = 2
		and opciones_x_usuario.id_opcion = idiomas.id order by idiomas.nombre asc";
		$R_oxu_idi = mysql_query($query_R_oxu_idi, $ddbb_naevp) or die(mysql_error());
		$row_R_oxu_idi = mysql_fetch_assoc($R_oxu_idi);
		$totalRows_R_oxu_idi = mysql_num_rows($R_oxu_idi);
		
		//consulto las opciones del profesional (Modalidad Atencion)
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_oxu_mat = "select modalidad_atencion.modalidad_atencion as nombre
		from modalidad_atencion, opciones_x_usuario 
		where opciones_x_usuario.id_usuario = '$id' 
		and opciones_x_usuario.grupo_opciones = 3
		and opciones_x_usuario.id_opcion = modalidad_atencion.id order by modalidad_atencion.modalidad_atencion asc";
		$R_oxu_mat = mysql_query($query_R_oxu_mat, $ddbb_naevp) or die(mysql_error());
		$row_R_oxu_mat = mysql_fetch_assoc($R_oxu_mat);
		$totalRows_R_oxu_mat = mysql_num_rows($R_oxu_mat);
		
		//consulto las opciones del profesional (obras sociales)
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_oxu_oso = "select obras_sociales.nombre as nombre
		from obras_sociales, opciones_x_usuario 
		where opciones_x_usuario.id_usuario = '$id' 
		and opciones_x_usuario.grupo_opciones = 4
		and opciones_x_usuario.id_opcion = obras_sociales.id order by obras_sociales.nombre asc";
		$R_oxu_oso = mysql_query($query_R_oxu_oso, $ddbb_naevp) or die(mysql_error());
		$row_R_oxu_oso = mysql_fetch_assoc($R_oxu_oso);
		$totalRows_R_oxu_oso = mysql_num_rows($R_oxu_oso);
		
		//consulto las opciones del profesional (Poblacion clinica)
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_oxu_pcl = "select poblacion_clinica.poblacion as nombre
		from poblacion_clinica, opciones_x_usuario 
		where opciones_x_usuario.id_usuario = '$id' 
		and opciones_x_usuario.grupo_opciones = 5
		and opciones_x_usuario.id_opcion = poblacion_clinica.id order by poblacion_clinica.poblacion asc";
		$R_oxu_pcl = mysql_query($query_R_oxu_pcl, $ddbb_naevp) or die(mysql_error());
		$row_R_oxu_pcl = mysql_fetch_assoc($R_oxu_pcl);
		$totalRows_R_oxu_pcl = mysql_num_rows($R_oxu_pcl);
		
		//consulto las opciones del profesional (Tematicas)
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_oxu_tem = "select tematicas.nombre as nombre
		from tematicas, opciones_x_usuario 
		where opciones_x_usuario.id_usuario = '$id' 
		and opciones_x_usuario.grupo_opciones = 7
		and opciones_x_usuario.id_opcion = tematicas.id order by tematicas.nombre asc";
		$R_oxu_tem = mysql_query($query_R_oxu_tem, $ddbb_naevp) or die(mysql_error());
		$row_R_oxu_tem = mysql_fetch_assoc($R_oxu_tem);
		$totalRows_R_oxu_tem = mysql_num_rows($R_oxu_tem);
		
		//consulto las opciones del profesional (Orientación Clínica)
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_oxu_ocl = "select orientacion_clinica.nombre as nombre
		from orientacion_clinica, opciones_x_usuario 
		where opciones_x_usuario.id_usuario = '$id' 
		and opciones_x_usuario.grupo_opciones = 8
		and opciones_x_usuario.id_opcion = orientacion_clinica.id order by orientacion_clinica.nombre asc";
		$R_oxu_ocl = mysql_query($query_R_oxu_ocl, $ddbb_naevp) or die(mysql_error());
		$row_R_oxu_ocl = mysql_fetch_assoc($R_oxu_ocl);
		$totalRows_R_oxu_ocl = mysql_num_rows($R_oxu_ocl);
		
		//consulto las modalidades de trabajo
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_oxu_mt = "select modalidad_trabajo.modalidad_trabajo as nombre
		from modalidad_trabajo, opciones_x_usuario 
		where opciones_x_usuario.id_usuario = '$id'
		and opciones_x_usuario.grupo_opciones = 6
		and opciones_x_usuario.id_opcion = modalidad_trabajo.id order by modalidad_trabajo.modalidad_trabajo asc";
		$R_oxu_mt = mysql_query($query_R_oxu_mt, $ddbb_naevp) or die(mysql_error());
		$row_R_oxu_mt = mysql_fetch_assoc($R_oxu_mt);
		$totalRows_R_oxu_mt = mysql_num_rows($R_oxu_mt);
	}
	
	//notas
	if($estoy == "notas" && !$id){
		//busco las notas ordenadas por fecha
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_publicaciones_list = "select publicaciones.*, users.nombre, users.apellido, users.img, tipo_publicacion.path, publicaciones.img as publicacion_img
		from publicaciones, users, tipo_publicacion
		where publicaciones.page_author = users.id ";
		if($filtro){
			$query_R_publicaciones_list .= " and publicaciones.menu_parent = '$filtro' ";
		} else {
			$query_R_publicaciones_list .= " and publicaciones.menu_parent = 1 ";
		}
		$query_R_publicaciones_list .= " and tipo_publicacion.id = publicaciones.menu_parent 
		and publicaciones.parent = 0 and publicaciones.active = 1 
		and publicaciones.target IN ($target_publicaciones)  
		order by publicaciones.hoy_ahora desc";
		$R_publicaciones_list = mysql_query($query_R_publicaciones_list, $ddbb_naevp) or die(mysql_error());
		$row_R_publicaciones_list = mysql_fetch_assoc($R_publicaciones_list);
		$totalRows_R_publicaciones_list = mysql_num_rows($R_publicaciones_list);
	}
	
	//Actividades
	if($estoy == "actividades" && !$id){
		//busco las notas ordenadas por fecha
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_publicaciones_list = "select publicaciones.*, users.nombre, users.apellido, users.img, tipo_publicacion.path, publicaciones.img as publicacion_img
		from publicaciones, users, tipo_publicacion
		where publicaciones.page_author = users.id ";
		if($filtro){
			$query_R_publicaciones_list .= " and publicaciones.menu_parent = '$filtro' ";
		} else {
			$query_R_publicaciones_list .= " and publicaciones.menu_parent IN (2,3,4) "; 
		}
		$query_R_publicaciones_list .= " and tipo_publicacion.id = publicaciones.menu_parent 
		and publicaciones.parent = 0 and publicaciones.active = 1 
		and publicaciones.target IN ($target_publicaciones) 
		order by publicaciones.hoy_ahora desc";
		$R_publicaciones_list = mysql_query($query_R_publicaciones_list, $ddbb_naevp) or die(mysql_error());
		$row_R_publicaciones_list = mysql_fetch_assoc($R_publicaciones_list);
		$totalRows_R_publicaciones_list = mysql_num_rows($R_publicaciones_list);
	}
	
	//Foros
	if($estoy == "foros" && !$id){
		//busco las notas ordenadas por fecha
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_publicaciones_list = "select publicaciones.*, users.nombre, users.apellido, users.img, tipo_publicacion.path, publicaciones.img as publicacion_img
		from publicaciones, users, tipo_publicacion
		where publicaciones.page_author = users.id ";
		if($filtro){
			$query_R_publicaciones_list .= " and publicaciones.menu_parent = '$filtro' ";
		} else {
			$query_R_publicaciones_list .= " and publicaciones.menu_parent = 6 ";
		}
		$query_R_publicaciones_list .= " and tipo_publicacion.id = publicaciones.menu_parent 
		and publicaciones.parent = 0 and publicaciones.active = 1 
		and publicaciones.target IN ($target_publicaciones) 
		order by publicaciones.hoy_ahora desc";
		$R_publicaciones_list = mysql_query($query_R_publicaciones_list, $ddbb_naevp) or die(mysql_error());
		$row_R_publicaciones_list = mysql_fetch_assoc($R_publicaciones_list);
		$totalRows_R_publicaciones_list = mysql_num_rows($R_publicaciones_list);
	}
	
	//Herramientas
	if($estoy == "herramientas" && !$id){
		//busco las notas ordenadas por fecha
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_publicaciones_list = "select publicaciones.*, users.nombre, users.apellido, users.img, tipo_publicacion.path, publicaciones.img as publicacion_img
		from publicaciones, users, tipo_publicacion
		where publicaciones.page_author = users.id ";
		if($filtro){
			$query_R_publicaciones_list .= " and publicaciones.menu_parent = '$filtro' ";
		} else {
			$query_R_publicaciones_list .= " and publicaciones.menu_parent IN (8,9,10)  ";
		}
		$query_R_publicaciones_list .= " and tipo_publicacion.id = publicaciones.menu_parent 
		and publicaciones.parent = 0 and publicaciones.active = 1  
		and publicaciones.target IN ($target_publicaciones) 
		order by publicaciones.hoy_ahora desc";
		$R_publicaciones_list = mysql_query($query_R_publicaciones_list, $ddbb_naevp) or die(mysql_error());
		$row_R_publicaciones_list = mysql_fetch_assoc($R_publicaciones_list);
		$totalRows_R_publicaciones_list = mysql_num_rows($R_publicaciones_list);
	}
	
	if($_POST['action'] && $_POST['action']=='DoRegisterNewsletter'){
		$news_nombre = $_POST['news_nombre'];
		$news_email = $_POST['news_email'];
		//consulto la base de datos a ver si esta registrado
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_nl = "select * from newsletter where email = '$news_email'";
		$R_nl = mysql_query($query_R_nl, $ddbb_naevp) or die(mysql_error());
		$row_R_nl = mysql_fetch_assoc($R_nl);
		$totalRows_R_nl = mysql_num_rows($R_nl);
		if($totalRows_R_nl>0){
			//aca aviso que ya esta registrado
			$estado_suscripcion = 'El email ingresado ya se encuentra en nuestra base de datos.';
		} else {
			//aca hago el ingreso
			$query="INSERT into newsletter (id, nombre, email, active) 
			VALUES(NULL, '".$news_nombre."', '".$news_email."', '1'); ";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			if(mysql_query($query, $ddbb_naevp)){
				$estado_suscripcion = 'Suscripción exitosa! pronto comenzarás a recibir nuestras novedades por email.';
			} else {
				$estado_suscripcion = 'Algo salio mal.  Por favor vuelva a intentarlo en unos minutos.';
			}
		}
	}
?>