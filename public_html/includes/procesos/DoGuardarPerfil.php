<?php
	$nombre = mysql_real_escape_string($_POST['nombre']);
	$apellido = mysql_real_escape_string($_POST['apellido']);
	$email = mysql_real_escape_string($_POST['email']);
	$fecha_nacimiento = mysql_real_escape_string($_POST['fecha_nacimiento']);
	$cp = mysql_real_escape_string($_POST['cp']);
	$pais = mysql_real_escape_string($_POST['pais']);
	$ciudad = mysql_real_escape_string($_POST['ciudad']);
	$provincia = mysql_real_escape_string($_POST['provincia']);
	$consultorio_direccion = mysql_real_escape_string($_POST['consultorio_direccion']);
	$consultorio_telefono = mysql_real_escape_string($_POST['consultorio_telefono']);
	$matricula = mysql_real_escape_string($_POST['matricula']);
	$honorarios = mysql_real_escape_string($_POST['honorarios']);
	$pesc = mysql_real_escape_string($_POST['pesc']);
	$formacion_academica = mysql_real_escape_string($_POST['formacion_academica']);
	
	$password = mysql_real_escape_string($_POST['password']);
	$repassword = mysql_real_escape_string($_POST['repassword']);
	
	$experiencia_laboral = mysql_real_escape_string($_POST['experiencia_laboral']);
	$experiencia_anio = $_POST['experiencia_anio'];
	$experiencia_institucion = $_POST['experiencia_institucion'];
	$experiencia_titulo = $_POST['experiencia_titulo'];
	
	$fa_anio = $_POST['fa_anio'];
	$fa_institucion = $_POST['fa_institucion'];
	$fa_titulo = $_POST['fa_titulo'];
	
	$consultorio_direccion = $_POST['consultorio_direccion'];
	$consultorio_telefono = $_POST['consultorio_telefono'];
	$consultorio_cp = $_POST['consultorio_cp'];
	$consultorio_pais = $_POST['consultorio_pais'];
	$consultorio_estado = $_POST['consultorio_estado'];
	$consultorio_partido = $_POST['consultorio_partido'];
	$consultorio_ciudad = $_POST['consultorio_ciudad'];
	$pais_txt = $_POST['pais_txt'];
	$estado_txt = $_POST['estado_txt'];
	$partido_txt = $_POST['partido_txt'];
	$ciudad_txt = $_POST['ciudad_txt'];
	
	/*print_r($consultorio_direccion);
	print_r($consultorio_telefono);
	print_r($consultorio_cp);
	print_r($consultorio_pais);
	print_r($consultorio_estado);
	print_r($consultorio_partido);
	print_r($consultorio_ciudad);
	print_r($pais_txt);
	print_r($estado_txt);
	print_r($partido_txt);
	print_r($ciudad_txt);*/
	
	$asociacion_institucion = mysql_real_escape_string($_POST['asociacion_institucion']);
	$www = mysql_real_escape_string($_POST['www']);
	$presentacion_personal = mysql_real_escape_string($_POST['presentacion_personal']);
	$disponible_emergencias = mysql_real_escape_string($_POST['disponible_emergencias']);
	$reintegros_os = $_POST['reintegros_os'];
	$os = mysql_real_escape_string($_POST['os']);
	
	$especialidades = $_POST['especialidades'];
	$tematicas = $_POST['tematicas'];
	$orientaciones_clinicas = $_POST['orientaciones_clinicas'];
	$modalidad_atencion = $_POST['modalidad_atencion'];
	$modalidad_trabajo = $_POST['modalidad_trabajo'];
	$idiomas = $_POST['idiomas'];
	$obras_sociales = $_POST['obras_sociales'];
	$poblacion_clinica = $_POST['poblacion_clinica'];
	
	session_start();
	$_SESSION['nombre'] = $nombre;
	$_SESSION['apellido'] = $apellido;
	$_SESSION['email'] = $email;
	$_SESSION['fecha_nacimiento'] = $fecha_nacimiento;
	$_SESSION['cp'] = $cp;
	$_SESSION['pais'] = $pais;
	$_SESSION['ciudad'] = $ciudad;
	$_SESSION['provincia'] = $provincia;
	$_SESSION['consultorio_direccion'] = $consultorio_direccion;
	$_SESSION['consultorio_telefono'] = $consultorio_telefono;
	$_SESSION['matricula'] = $matricula;
	$_SESSION['honorarios'] = $honorarios;
	$_SESSION['pesc'] = $pesc;
	$_SESSION['formacion_academica'] = $formacion_academica;
	//$_SESSION['experiencia_laboral'] = $experiencia_laboral;
	$_SESSION['asociacion_institucion'] = $asociacion_institucion;
	$_SESSION['www'] = $www;
	$_SESSION['presentacion_personal'] = $presentacion_personal;
	$_SESSION['disponible_emergencias'] = $disponible_emergencias;
	$_SESSION['reintegros_os'] = $reintegros_os;
	$_SESSION['os'] = $os;
	$_SESSION['especialidades'] = $especialidades;
	$_SESSION['tematicas'] = $tematicas;
	$_SESSION['orientaciones_clinicas'] = $orientaciones_clinicas;
	$_SESSION['modalidad_atencion'] = $modalidad_atencion;
	$_SESSION['modalidad_trabajo'] = $modalidad_trabajo;
	$_SESSION['idiomas'] = $idiomas;
	$_SESSION['obras_sociales'] = $obras_sociales;
	$_SESSION['poblacion_clinica'] = $poblacion_clinica;
	
	/*foreach ($_SESSION as $key=>$val){
		echo $key." ".$val."<br/>";
	}*/
	/*foreach($_POST as $key => $value) {
		echo "POST parameter '$key' has '$value'";
	}*/
	$id_user_update = $_SESSION['id_usuario'];

	/*Modulo Update Profile IMG*/
	$file = $_POST['file'];
	$directorio_imagen_user = $ruta_raiz.'static/img_perfiles/';

	$nombre_archivo = $_FILES['file']['name'];
	$tamano_archivo = $_FILES['file']['size'];
	$file_tmp = $_FILES['file']['tmp_name'];
	$tipo_archivo = $_FILES['file']['type']; 

	if($nombre_archivo){
		if ($tipo_archivo == "image/gif" || $tipo_archivo == "image/jpeg" || $tipo_archivo == "image/jpg" || $tipo_archivo == "image/png"){		
			$hoy = date('Y-m-d');
			$rand = rand(0000,9999);
			$nombre_nuevo_archivo = $hoy.'_'.$rand.'_'. normaliza($nombre_archivo);
			//compruebo si las características del archivo son las que deseo 
			move_uploaded_file($file_tmp, $directorio_imagen_user.$nombre_nuevo_archivo);
			$img_perfil = $ruta_absoluta.'static/img_perfiles/'.$nombre_nuevo_archivo;
			
			//hago el update de la imagen
			$query="UPDATE users SET img = '$img_perfil' where id = '$id_user_update';";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			mysql_query($query, $ddbb_naevp);
			
		}
	}
	/*FIN Modulo Update Profile IMG*/

	//actualizo la contraseña
	if($password && $repassword){
		if($password == $repassword){
			$query="UPDATE users SET pass = MD5('$password') WHERE id = '$id_user_update';";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			mysql_query($query, $ddbb_naevp);
		} else {
			$estado_proceso = array("Las contraseñas ingresadas no coinciden y por lo tanto no fue actualizada.", 'alert-warning');
		}
	}
	
	//actualizo los datos de la tabla USERS
	if($nombre || $email){
		$query="UPDATE users SET nombre = '$nombre', email = '$email' where id = '$id_user_update';";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		mysql_query($query, $ddbb_naevp);
	}
	if($apellido){
		$query="UPDATE users SET apellido = '$apellido' where id = '$id_user_update';";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		mysql_query($query, $ddbb_naevp);
	}
	
		//actualizo el resto de los datos secundarios
		//primero consulto si ya completo estos datos o es la primera vez
		$fecha_nacimiento_pieces = explode('/', $fecha_nacimiento);
		$fecha_nacimiento_insert = $fecha_nacimiento_pieces[2].'-'.$fecha_nacimiento_pieces[0].'-'.$fecha_nacimiento_pieces[1];
		
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_info_ch = "select * from users_info where id_usuario = '$id_user_update'";
		$R_user_info_ch = mysql_query($query_R_user_info_ch, $ddbb_naevp) or die(header($error_mysql));
		$row_R_user_info_ch = mysql_fetch_assoc($R_user_info_ch);
		$totalRows_R_user_info_ch = mysql_num_rows($R_user_info_ch);
		if($totalRows_R_user_info_ch==0){
			//ingreso los datos
			$query="INSERT into users_info (id, id_usuario, fecha_nacimiento, codigo_postal, id_pais, ciudad, provincia, consultorio_direccion, consultorio_telefono, matricula, honorarios, pesc, formacion_academica, experiencia_laboral, asociacion_institucion, www, presentacion_personal, disponible_emergencias, os) 
			VALUES(NULL, '$id_user_update', '$fecha_nacimiento_insert', '$cp', '$pais', '$ciudad', '$provincia', '$consultorio_direccion', '$consultorio_telefono', '$matricula', '$honorarios', '$pesc', '$formacion_academica', '$experiencia_laboral', '$asociacion_institucion', '$www', '$presentacion_personal', '$disponible_emergencias', '$os'); ";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			mysql_query($query, $ddbb_naevp);
		} else {
			//actualizo los datos
			$query="UPDATE users_info SET fecha_nacimiento='$fecha_nacimiento_insert', 
			codigo_postal='$cp', 
			id_pais='$pais', 
			ciudad='$ciudad', 
			provincia='$provincia', 
			consultorio_direccion='$consultorio_direccion', 
			consultorio_telefono='$consultorio_telefono', 
			matricula='$matricula', 
			honorarios='$honorarios', 
			pesc='$pesc', 
			formacion_academica='$formacion_academica', 
			asociacion_institucion='$asociacion_institucion', 
			www='$www', 
			presentacion_personal='$presentacion_personal', 
			disponible_emergencias='$disponible_emergencias', 
			reintegros_os='$reintegros_os', 
			os='$os' 
			where id_usuario = '$id_user_update';";
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			mysql_query($query, $ddbb_naevp);
		}
		
		//borro todo lo de la tabla OPCIONES_X_USUARIO
		$query="DELETE FROM opciones_x_usuario WHERE id_usuario = '$id_user_update';";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		mysql_query($query, $ddbb_naevp);
		
		//ingreso a la tabla OPCIONES_X_USUARIO de acuerdo a cada grupo
		/*
		1=Especialidades
		2=Idiomas
		3=Modalidad Atencion
		4=Obras Sociales
		5=Poblacion Clinica
		6=Modalidad Trabajo
		7=Tematicas
		8=Orientacion Clinica
		*/
		if($especialidades){
			foreach($especialidades as $especialidad){
				$query="INSERT into opciones_x_usuario (id, id_usuario, id_opcion, grupo_opciones) 
				VALUES(NULL, '$id_user_update', '$especialidad', '1'); ";
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				mysql_query($query, $ddbb_naevp);
			}
		}
		if($idiomas){
			foreach($idiomas as $idioma){
				$query="INSERT into opciones_x_usuario (id, id_usuario, id_opcion, grupo_opciones) 
				VALUES(NULL, '$id_user_update', '$idioma', '2'); ";
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				mysql_query($query, $ddbb_naevp);
			}
		}
		if($modalidad_atencion){
			foreach($modalidad_atencion as $mat){
				$query="INSERT into opciones_x_usuario (id, id_usuario, id_opcion, grupo_opciones) 
				VALUES(NULL, '$id_user_update', '$mat', '3'); ";
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				mysql_query($query, $ddbb_naevp);
			}
		}
		if($obras_sociales){
			foreach($obras_sociales as $ooss){
				$query="INSERT into opciones_x_usuario (id, id_usuario, id_opcion, grupo_opciones) 
				VALUES(NULL, '$id_user_update', '$ooss', '4'); ";
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				mysql_query($query, $ddbb_naevp);
			}
		}
		if($poblacion_clinica){
			foreach($poblacion_clinica as $poc){
				$query="INSERT into opciones_x_usuario (id, id_usuario, id_opcion, grupo_opciones) 
				VALUES(NULL, '$id_user_update', '$poc', '5'); ";
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				mysql_query($query, $ddbb_naevp);
			}
		}
		if($modalidad_trabajo){
			foreach($modalidad_trabajo as $matt){
				$query="INSERT into opciones_x_usuario (id, id_usuario, id_opcion, grupo_opciones) 
				VALUES(NULL, '$id_user_update', '$matt', '6'); ";
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				mysql_query($query, $ddbb_naevp);
			}
		}
		if($tematicas){
			foreach($tematicas as $tematica){
				$query="INSERT into opciones_x_usuario (id, id_usuario, id_opcion, grupo_opciones) 
				VALUES(NULL, '$id_user_update', '$tematica', '7'); ";
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				mysql_query($query, $ddbb_naevp);
			}
		}
		if($orientaciones_clinicas){
			foreach($orientaciones_clinicas as $orientacion_clinica){
				$query="INSERT into opciones_x_usuario (id, id_usuario, id_opcion, grupo_opciones) 
				VALUES(NULL, '$id_user_update', '$orientacion_clinica', '8'); ";
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				mysql_query($query, $ddbb_naevp);
			}
		}
		
		$query="DELETE FROM experiencia_x_usuario WHERE id_usuario = '$id_user_update';";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
			$exp_n = 0;
			foreach($experiencia_anio as $exp_anio){
				if($experiencia_anio[$exp_n]&&$experiencia_institucion[$exp_n]&&$experiencia_titulo[$exp_n]){
					//hago el ingreso
					$query="INSERT into experiencia_x_usuario (id, id_usuario, anio, institucion, titulo) 
					VALUES(NULL, '$id_user_update', '".$experiencia_anio[$exp_n]."', '".$experiencia_institucion[$exp_n]."', '".$experiencia_titulo[$exp_n]."'); ";
					mysql_select_db($database_name, $ddbb_naevp);
					mysql_query("SET NAMES 'utf8'");
					mysql_query($query, $ddbb_naevp);
				}
				$exp_n = $exp_n + 1;
			}
		}
	
		$query="DELETE FROM fa_x_usuario WHERE id_usuario = '$id_user_update';";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
			$exp_n = 0;
			foreach($fa_anio as $f_anio){
				if($fa_anio[$exp_n]&&$fa_institucion[$exp_n]&&$fa_titulo[$exp_n]){
					//hago el ingreso
					$query="INSERT into fa_x_usuario (id, id_usuario, anio, institucion, titulo) 
					VALUES(NULL, '$id_user_update', '".$fa_anio[$exp_n]."', '".$fa_institucion[$exp_n]."', '".$fa_titulo[$exp_n]."'); ";
					mysql_select_db($database_name, $ddbb_naevp);
					mysql_query("SET NAMES 'utf8'");
					mysql_query($query, $ddbb_naevp);
				}
				$exp_n = $exp_n + 1;
			}
		}
		
		$query="DELETE FROM consultorio_x_usuario WHERE id_usuario = '$id_user_update';";
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		if(mysql_query($query, $ddbb_naevp)){
			$exp_n = 0;
			foreach($consultorio_direccion as $c_direccion){
				/*$query="INSERT into consultorio_x_usuario (id, id_usuario, direccion, telefono, cp, pais, id_pais, estado, id_estado, partido, id_partido, ciudad, id_ciudad, active) 
				VALUES(NULL, '$id_user_update', '".$c_direccion."', '".$consultorio_tel."', '".$consultorio_codigo."', '".$pais_txt[$exp_n]."', '".$consultorio_pais[$exp_n]."', '".$estado_txt[$exp_n]."', '".$consultorio_estado[$exp_n]."', '".$partido_txt[$exp_n]."', '".$consultorio_partido[$exp_n]."', '".$ciudad_txt[$exp_n]."', '".$consultorio_ciudad[$exp_n]."','1'); ";
				echo $query;*/
				if($consultorio_ciudad[$exp_n]){
					$consultorio_ciudad_ingresar = $consultorio_ciudad[$exp_n];
				} else {
					$consultorio_ciudad_ingresar = $consultorio_partido[$exp_n];
				}
				if($consultorio_direccion[$exp_n]&&$consultorio_pais[$exp_n]&&$consultorio_estado[$exp_n]&&$consultorio_partido[$exp_n]){
					if($consultorio_telefono[$exp_n]){ $consultorio_tel = $consultorio_telefono[$exp_n]; } else { $consultorio_tel = ''; }
					if($consultorio_cp[$exp_n]){ $consultorio_codigo = $consultorio_cp[$exp_n]; } else { $consultorio_codigo = ''; }
					//hago el ingreso
					$query="INSERT into consultorio_x_usuario (id, id_usuario, direccion, telefono, cp, pais, id_pais, estado, id_estado, partido, id_partido, ciudad, id_ciudad, active) 
					VALUES(NULL, '$id_user_update', '".$c_direccion."', '".$consultorio_tel."', '".$consultorio_codigo."', '".$pais_txt[$exp_n]."', '".$consultorio_pais[$exp_n]."', '".$estado_txt[$exp_n]."', '".$consultorio_estado[$exp_n]."', '".$partido_txt[$exp_n]."', '".$consultorio_partido[$exp_n]."', '".$ciudad_txt[$exp_n]."', '".$consultorio_ciudad_ingresar."','1'); ";
					mysql_select_db($database_name, $ddbb_naevp);
					mysql_query("SET NAMES 'utf8'");
					mysql_query($query, $ddbb_naevp);
				}
				$exp_n = $exp_n + 1;
			}
		}
		
	unset($_SESSION['nombre']);
	unset($_SESSION['apellido']);
	unset($_SESSION['email']);
	unset($_SESSION['fecha_nacimiento']);
	unset($_SESSION['cp']);
	unset($_SESSION['pais']);
	unset($_SESSION['ciudad']);
	unset($_SESSION['provincia']);
	unset($_SESSION['consultorio_direccion']);
	unset($_SESSION['consultorio_telefono']);
	unset($_SESSION['matricula']);
	unset($_SESSION['honorarios']);
	unset($_SESSION['pesc']);
	unset($_SESSION['formacion_academica']);
	//unset($_SESSION['experiencia_laboral']);
	unset($_SESSION['asociacion_institucion']);
	unset($_SESSION['www']);
	unset($_SESSION['presentacion_personal']);
	unset($_SESSION['disponible_emergencias']);
	unset($_SESSION['reintegros_os']);
	unset($_SESSION['os']);
	unset($_SESSION['especialidades']);
	unset($_SESSION['tematicas']);
	unset($_SESSION['orientaciones_clinicas']);
	unset($_SESSION['modalidad_atencion']);
	unset($_SESSION['modalidad_trabajo']);
	unset($_SESSION['idiomas']);
	unset($_SESSION['obras_sociales']);
	unset($_SESSION['poblacion_clinica']);
	
	unset($_SESSION['consultorio_pais']);
	unset($_SESSION['consultorio_estado']);
	unset($_SESSION['consultorio_partido']);
	unset($_SESSION['consultorio_ciudad']);
	unset($_SESSION['estado_txt']);
	unset($_SESSION['partido_txt']);
	unset($_SESSION['ciudad_txt']);
?>