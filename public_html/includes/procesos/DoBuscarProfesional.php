<?php
	$profesional_nombre = $_POST['profesional_nombre'];
	$especialidad = $_POST['especialidad'];
	$ciudad_nombre = $_POST['ciudad_nombre'];
	
	$_SESSION['filtro_especialidad'] = $especialidad;
	$_SESSION['profesional_nombre'] = $profesional_nombre;
	$_SESSION['ciudad_nombre'] = $ciudad_nombre;
	
	//$_GET['extra-filters'];
	
	if($profesional_nombre=='' && $especialidad=='' && $ciudad_nombre==''){
		$estado_proceso = array('Por favor complete al menos un campo de los solicitados.', 'alert-warning'); //mensaje del alerta, tipo de alerta (alert-success o alert-warning)
	} else {
	
		unset($_SESSION['resultados_busco_profesional']);
		
		//si esta el nombre del profesional me voy a guiar por ese dato
		//caso contrario me voy a guiar por los otros dos en conjunto
		if($profesional_nombre!=''){
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			$query_R_busco_profesional = "select users.* 
			from users
			where (concat(' ', users.nombre, users.apellido) LIKE '%".$profesional_nombre."%' OR concat(users.nombre,' ',users.apellido) LIKE '%".$profesional_nombre."%') and users.tipo_usuario IN (1,2)  
			order by apellido asc, nombre asc";
			$R_busco_profesional = mysql_query($query_R_busco_profesional, $ddbb_naevp) or die(mysql_error());
			$row_R_busco_profesional = mysql_fetch_assoc($R_busco_profesional);
			$totalRows_R_busco_profesional = mysql_num_rows($R_busco_profesional);
			if($totalRows_R_busco_profesional>0){
				$resultados_busco_profesional = array();
				do {
					$resultados_busco_profesional[] = array("id" => $row_R_busco_profesional['id'],
									"nombre"  => $row_R_busco_profesional['nombre'],
									"apellido"  => $row_R_busco_profesional['apellido'],
									"tipo_usuario" => $row_R_busco_profesional['tipo_usuario'], 
									"fecha_registro" => $row_R_busco_profesional['fecha_registro'], 
									"is_verified" => $row_R_busco_profesional['is_verified'], 
									"img" => $row_R_busco_profesional['img']);
				} while ($row_R_busco_profesional = mysql_fetch_assoc($R_busco_profesional));
			}
			session_start();
			$_SESSION['resultados_busco_profesional'] = $resultados_busco_profesional;
			header("Location: ".$ruta_raiz."profesionales/?extra-filters=yes&espfilter=".$especialidad);
		} else {
			
			//voy a buscar por los otros dos parametros (especialidad y/o ciudad)
			mysql_select_db($database_name, $ddbb_naevp);
			mysql_query("SET NAMES 'utf8'");
			$query_R_busco_profesional = "select distinct(users.id) as id, users.* ";
			$query_R_busco_profesional .= "from users";
			
			if($especialidad){
				$query_R_busco_profesional .= ", opciones_x_usuario, especialidades ";
			}
			if($ciudad_nombre){
				$query_R_busco_profesional .= ", consultorio_x_usuario ";
			}

			$query_R_busco_profesional .= "where 1=1 ";
			
			if($especialidad){
				$query_R_busco_profesional .= "and opciones_x_usuario.id_usuario = users.id and opciones_x_usuario.grupo_opciones = 1 and opciones_x_usuario.id_opcion = especialidades.id and ( especialidades.id = '".$especialidad."' or especialidades.parent = '".$especialidad."' ) ";
			}
			if($ciudad_nombre){
				$query_R_busco_profesional .= "and consultorio_x_usuario.id_ciudad = '".$ciudad_nombre."' and consultorio_x_usuario.id_usuario = users.id ";
			}
			
			$query_R_busco_profesional .= "and users.tipo_usuario IN (1,2)   
			order by users.apellido asc, users.nombre asc";
			$R_busco_profesional = mysql_query($query_R_busco_profesional, $ddbb_naevp) or die(mysql_error());
			$row_R_busco_profesional = mysql_fetch_assoc($R_busco_profesional);
			$totalRows_R_busco_profesional = mysql_num_rows($R_busco_profesional);
			if($totalRows_R_busco_profesional>0){
			$resultados_busco_profesional = array();
				do {
					$resultados_busco_profesional[] = array("id" => $row_R_busco_profesional['id'],
									"nombre"  => $row_R_busco_profesional['nombre'],
									"apellido"  => $row_R_busco_profesional['apellido'],
									"tipo_usuario" => $row_R_busco_profesional['tipo_usuario'], 
									"fecha_registro" => $row_R_busco_profesional['fecha_registro'], 
									"img" => $row_R_busco_profesional['img']);
				} while ($row_R_busco_profesional = mysql_fetch_assoc($R_busco_profesional));
			}
			session_start();
			$_SESSION['resultados_busco_profesional'] = $resultados_busco_profesional;
			header("Location: ".$ruta_raiz."profesionales/?extra-filters=yes&espfilter=".$especialidad);
			//echo $query_R_busco_profesional;
		}	
		
	}
?>