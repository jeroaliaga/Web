<div class="bloque_registro">
	<div class="container">
		<?php if($estado_proceso){?>
		<div class="row" style="margin-top:20px;">
			<div class="alert <?php echo $estado_proceso[1]; ?>">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <?php echo $estado_proceso[0]; ?>
			</div>
		</div>
		<?php } ?>

		<?php if(count($_SESSION['resultados_busco_profesional'])>0){?>
		<h1>Estos son los resultados que encontramos...</h1>
		<div class="col-xs-12 col-md-10">
			<ul class="bloque_resultados_profesionales">
				<?php
					$resultados_a_mostrar = 0;
					foreach($_SESSION['resultados_busco_profesional'] as $resultado_profesionales){
					
					$id_profesional = $resultado_profesionales['id'];
					
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
		
					//si existen los filtros extra los aplico
					if($subespecialidad){
						foreach($subespecialidad as $f_1){
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_f_1 = "select * from opciones_x_usuario where grupo_opciones = '1' and id_usuario = '$id_profesional' and id_opcion = '$f_1'";
							$R_f_1 = mysql_query($query_R_f_1, $ddbb_naevp) or die(mysql_error());
							$row_R_f_1 = mysql_fetch_assoc($R_f_1);
							$totalRows_R_f_1 = mysql_num_rows($R_f_1);
							if($totalRows_R_f_1>0){
								$show_f_1 = true;
								break;
							} else {
								$show_f_1 = false;
							}
						}
					} else {
						$show_f_1 = true;
					}
					
					if($pclinica){
						foreach($pclinica as $f_5){
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_f_5 = "select * from opciones_x_usuario where grupo_opciones = '5' and id_usuario = '$id_profesional' and id_opcion = '$f_5'";
							$R_f_5 = mysql_query($query_R_f_5, $ddbb_naevp) or die(mysql_error());
							$row_R_f_5 = mysql_fetch_assoc($R_f_5);
							$totalRows_R_f_5 = mysql_num_rows($R_f_5);
							if($totalRows_R_f_5>0){
								$show_f_5 = true;
								break;
							} else {
								$show_f_5 = false;
							}
						}
					} else {
						$show_f_5 = true;
					}
					
					if($idiomas){
						foreach($idiomas as $f_2){
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_f_2 = "select * from opciones_x_usuario where grupo_opciones = '2' and id_usuario = '$id_profesional' and id_opcion = '$f_2'";
							$R_f_2 = mysql_query($query_R_f_2, $ddbb_naevp) or die(mysql_error());
							$row_R_f_2 = mysql_fetch_assoc($R_f_2);
							$totalRows_R_f_2 = mysql_num_rows($R_f_2);
							if($totalRows_R_f_2>0){
								$show_f_2 = true;
								break;
							} else {
								$show_f_2 = false;
							}
						}
					} else {
						$show_f_2 = true;
					}
					
					if($matencion){
						foreach($matencion as $f_3){
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_f_3 = "select * from opciones_x_usuario where grupo_opciones = '3' and id_usuario = '$id_profesional' and id_opcion = '$f_3'";
							$R_f_3 = mysql_query($query_R_f_3, $ddbb_naevp) or die(mysql_error());
							$row_R_f_3 = mysql_fetch_assoc($R_f_3);
							$totalRows_R_f_3 = mysql_num_rows($R_f_3);
							if($totalRows_R_f_3>0){
								$show_f_3 = true;
								break;
							} else {
								$show_f_3 = false;
							}
						}
					} else {
						$show_f_3 = true;
					}
					
					if($osocial){
						foreach($osocial as $f_4){
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_f_4 = "select * from opciones_x_usuario where grupo_opciones = '4' and id_usuario = '$id_profesional' and id_opcion = '$f_4'";
							$R_f_4 = mysql_query($query_R_f_4, $ddbb_naevp) or die(mysql_error());
							$row_R_f_4 = mysql_fetch_assoc($R_f_4);
							$totalRows_R_f_4 = mysql_num_rows($R_f_4);
							if($totalRows_R_f_4>0){
								$show_f_4 = true;
								break;
							} else {
								$show_f_4 = false;
							}
						}
					} else {
						$show_f_4 = true;
					}
					
					if($mtrabajo){
						foreach($mtrabajo as $f_6){
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_f_6 = "select * from opciones_x_usuario where grupo_opciones = '6' and id_usuario = '$id_profesional' and id_opcion = '$f_6'";
							$R_f_6 = mysql_query($query_R_f_6, $ddbb_naevp) or die(mysql_error());
							$row_R_f_6 = mysql_fetch_assoc($R_f_6);
							$totalRows_R_f_6 = mysql_num_rows($R_f_6);
							if($totalRows_R_f_6>0){
								$show_f_6 = true;
								break;
							} else {
								$show_f_6 = false;
							}
						}
					} else {
						$show_f_6 = true;
					}
					
					if($tematicas){
						foreach($tematicas as $f_7){
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_f_7 = "select * from opciones_x_usuario where grupo_opciones = '7' and id_usuario = '$id_profesional' and id_opcion = '$f_7'";
							$R_f_7 = mysql_query($query_R_f_7, $ddbb_naevp) or die(mysql_error());
							$row_R_f_7 = mysql_fetch_assoc($R_f_7);
							$totalRows_R_f_7 = mysql_num_rows($R_f_7);
							if($totalRows_R_f_7>0){
								$show_f_7 = true;
								break;
							} else {
								$show_f_7 = false;
							}
						}
					} else {
						$show_f_7 = true;
					}
					
					if($oclinica){
						foreach($oclinica as $f_8){
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_f_8 = "select * from opciones_x_usuario where grupo_opciones = '8' and id_usuario = '$id_profesional' and id_opcion = '$f_8'";
							$R_f_8 = mysql_query($query_R_f_8, $ddbb_naevp) or die(mysql_error());
							$row_R_f_8 = mysql_fetch_assoc($R_f_8);
							$totalRows_R_f_8 = mysql_num_rows($R_f_8);
							if($totalRows_R_f_8>0){
								$show_f_8 = true;
								break;
							} else {
								$show_f_8 = false;
							}
						}
					} else {
						$show_f_8 = true;
					}
					
					//consulto el perfil del profesional
					mysql_select_db($database_name, $ddbb_naevp);
					mysql_query("SET NAMES 'utf8'");
					$query_R_user_perfil = "select * from users_info where id_usuario = '$id_profesional'";
					$R_user_perfil = mysql_query($query_R_user_perfil, $ddbb_naevp) or die(mysql_error());
					$row_R_user_perfil = mysql_fetch_assoc($R_user_perfil);
					$totalRows_R_user_perfil = mysql_num_rows($R_user_perfil);
						
					if($pesc){
						foreach($pesc as $f_pesc){
							if($row_R_user_perfil['pesc']==$f_pesc){
								$show_pesc = true;
								break;
							} else {
								$show_pesc = false;
							}
						}
					} else {
						$show_pesc = true;
					}
					
					if($aos){
						foreach($aos as $f_aos){
							if($row_R_user_perfil['os']==$f_aos){
								$show_aos = true;
								break;
							} else {
								$show_aos = false;
							}
						}
					} else {
						$show_aos = true;
					}
					
					if($dpe){
						foreach($dpe as $f_dpe){
							if($row_R_user_perfil['disponible_emergencias']==$f_dpe){
								$show_dpe = true;
								break;
							} else {
								$show_dpe = false;
							}
						}
					} else {
						$show_dpe = true;
					}
					
					if($show_f_1 == TRUE && $show_f_2 == TRUE && $show_f_3 == TRUE && $show_f_4 == TRUE && $show_f_5 == TRUE && $show_f_6 == TRUE && $show_f_7 == TRUE && $show_f_8 == TRUE && $show_pesc == TRUE && $show_aos == TRUE && $show_dpe == TRUE){
						
						$resultados_a_mostrar = $resultados_a_mostrar + 1;
						
						//consulto la cantidad de publicaciones
						mysql_select_db($database_name, $ddbb_naevp);
						mysql_query("SET NAMES 'utf8'");
						$query_R_user_publicaciones = "select * from publicaciones where parent = '0' and active = '1' and page_author = '$id_profesional'";
						$R_user_publicaciones = mysql_query($query_R_user_publicaciones, $ddbb_naevp) or die(mysql_error());
						$row_R_user_publicaciones = mysql_fetch_assoc($R_user_publicaciones);
						$totalRows_R_user_publicaciones = mysql_num_rows($R_user_publicaciones);
						if($totalRows_R_user_publicaciones==0){
							$total_publicaciones = $totalRows_R_user_publicaciones;
						} else {
							$total_publicaciones = '0';
						}
				?>
				<li>
					<!--<div class="col-xs-12 col-md-1 col_comentarios">
						<h3>Calificaciones<br/><i class="fa fa-star" aria-hidden="true"></i></h3>
					</div>-->
					<div class="col-xs-12 col-md-2 col_imagen_perfil">
						<a href="<?php echo $ruta_raiz.'profesionales/?id='.$resultado_profesionales['id']; ?>" title="Ver perfil completo">
							<div class="img_perfil" style="background: url('<?php if($resultado_profesionales['img']){ echo $resultado_profesionales['img']; } else { echo $default_user_image; } ?>');"></div>
						</a>
					</div>
					<div class="col-xs-12 col-md-9 col_contenido">
						<h2><a href="<?php echo $ruta_raiz.'profesionales/?id='.$resultado_profesionales['id']; ?>" title="Ver perfil completo"><?php echo $resultado_profesionales['nombre'].' '.$resultado_profesionales['apellido']; ?></a></h2>
						<?php if($resultado_profesionales['is_verified']==1){?><span><i class="fa fa-check-square-o" aria-hidden="true"></i> Profesional Verificado</span><?php } ?>
						<?php 
						if($row_R_user_perfil['presentacion_personal']){
							echo '<div class="parrafo">'.$row_R_user_perfil['presentacion_personal'].'</div>';
						} else {
							echo '<div class="parrafo">Presentación no cargada por el usuario.</div>';
						}
						?>
						<div class="bloque_calificaciones">
							<span>Calificaciones</span>
							<ul class="calificaciones resultados">
								<?php
									$array_calificaciones = array(
										array('Calidez y<br/>empatia',1),
										array('Capacidad de<br/>escucha',2),
										array('Dominio de<br/>la especialidad',3),
										array('Instalaciones<br/>&nbsp;',4)
									);
									foreach($array_calificaciones as $calif){
								?>
								<li>
									<span><?php echo $calif[0]; ?></span>
									<div>
									<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
									<?php
										mysql_select_db($database_name, $ddbb_naevp);
										mysql_query("SET NAMES 'utf8'");
										$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$resultado_profesionales['id']."' and value = '1'";
										$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
										$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
										$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
										if($totalRows_R_user_cal>0){
											$cal = $totalRows_R_user_cal;
										} else {
											$cal = '0';
										}
									?>
									<strong><?php echo $cal; ?></strong>
									</div>
									<div>
									<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
									<?php
										mysql_select_db($database_name, $ddbb_naevp);
										mysql_query("SET NAMES 'utf8'");
										$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$resultado_profesionales['id']."' and value = '2'";
										$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
										$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
										$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
										if($totalRows_R_user_cal>0){
											$cal = $totalRows_R_user_cal;
										} else {
											$cal = '0';
										}
									?>
									<strong><?php echo $cal; ?></strong>
									</div>
									<div>
									<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
									<?php
										mysql_select_db($database_name, $ddbb_naevp);
										mysql_query("SET NAMES 'utf8'");
										$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$resultado_profesionales['id']."' and value = '3'";
										$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
										$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
										$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
										if($totalRows_R_user_cal>0){
											$cal = $totalRows_R_user_cal;
										} else {
											$cal = '0';
										}
									?>
									<strong><?php echo $cal; ?></strong>
									</div>
									<div>
									<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
									<?php
										mysql_select_db($database_name, $ddbb_naevp);
										mysql_query("SET NAMES 'utf8'");
										$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$resultado_profesionales['id']."' and value = '4'";
										$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
										$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
										$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
										if($totalRows_R_user_cal>0){
											$cal = $totalRows_R_user_cal;
										} else {
											$cal = '0';
										}
									?>
									<strong><?php echo $cal; ?></strong>
									</div>
									<div>
									<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
									<?php
										mysql_select_db($database_name, $ddbb_naevp);
										mysql_query("SET NAMES 'utf8'");
										$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$resultado_profesionales['id']."' and value = '5'";
										$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
										$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
										$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
										if($totalRows_R_user_cal>0){
											$cal = $totalRows_R_user_cal;
										} else {
											$cal = '0';
										}
									?>
									<strong><?php echo $cal; ?></strong>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<div class="col-xs-12 col-md-1 col_actions">
						<a id="showModal" href="<?php echo $ruta_raiz.'includes/procesos/DoContactarProfesional.php?id='.$resultado_profesionales['id']; ?>" data-toggle="modal" data-target="#EnviarMensaje" title="Contactar">Contactar<i class="fa fa-envelope-o" aria-hidden="true"></i></a>
						<a href="<?php echo $ruta_raiz.'profesionales/?id='.$resultado_profesionales['id']; ?>" title="Ver perfil completo">Ver perfil<i class="fa fa-eye" aria-hidden="true"></i></a>
					</div>
				</li>
				<?php } }  ?>
			</ul>
			<?php if($resultados_a_mostrar=='0'){ echo '<h1>Lamentablemente no encontramos resultados para tu búsqueda.<br/>Vuelve a intentarlo ingresando diferentes parámetros.</h1>'; } ?>
		</div>
		<div class="col-xs-12 col-md-2 col_filtros">
			<h2>Filtros</h2>
			<?php
				if($_SESSION['filtro_especialidad']){
					//subespecialidades
					$especialidad_filtro = $_SESSION['filtro_especialidad'];
					mysql_select_db($database_name, $ddbb_naevp);
					mysql_query("SET NAMES 'utf8'");
					$query_R_especialidad_filtro = "select * from especialidades where parent = '$especialidad_filtro' order by orden asc, nombre asc";
					$R_especialidad_filtro = mysql_query($query_R_especialidad_filtro, $ddbb_naevp) or die(mysql_error());
					$row_R_especialidad_filtro = mysql_fetch_assoc($R_especialidad_filtro);
					$totalRows_R_especialidad_filtro = mysql_num_rows($R_especialidad_filtro);
					if($totalRows_R_especialidad_filtro>0){
			?>
			<div class="bloque_filtros">
				<span>Sub Especialidades</span>
				<ul class="lista_filtros">
				<?php 
					do { 
					if (in_array($row_R_especialidad_filtro['id'], $subespecialidad)) {
					$nueva_url = str_replace("&subespecialidad[]=".$row_R_especialidad_filtro['id'],"",basename($_SERVER['REQUEST_URI']));
				?>
				<li class="term-item "><a href="<?php echo $nueva_url; ?>" title="Quitar filtro <?php echo $row_R_especialidad_filtro['nombre']; ?>"><i class="fa fa-times" aria-hidden="true"></i><?php echo $row_R_especialidad_filtro['nombre']; ?></a></li>
				<?php } else { ?>
				<li class="term-item "><a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&subespecialidad[]=<?php echo $row_R_especialidad_filtro['id']; ?>" title="<?php echo $row_R_especialidad_filtro['nombre']; ?>">- <?php echo $row_R_especialidad_filtro['nombre']; ?></a></li>
				<?php } } while ($row_R_especialidad_filtro = mysql_fetch_assoc($R_especialidad_filtro)); ?>
				</ul>
			</div>
			<?php } } ?>
			
			<div class="bloque_filtros">
				<span>Primera Entrevista Sin Cargo</span>
				<?php
				if (in_array('1', $pesc)) {
					$nueva_url = str_replace("&pesc[]=1","",basename($_SERVER['REQUEST_URI']));
					echo '<a href="'.$nueva_url.'" title="Quitar filtro Primera entrevista sin cargo"><i class="fa fa-times" aria-hidden="true"></i>Si</a>';
				} else {
					$nueva_url = basename($_SERVER['REQUEST_URI']).'&pesc[]=1';
					echo '<a href="'.$nueva_url.'" title="Primera entrevista sin cargo">Si</a>';
				}
				if (in_array('2', $pesc)) {
					$nueva_url = str_replace("&pesc[]=2","",basename($_SERVER['REQUEST_URI']));
					echo '<a href="'.$nueva_url.'" title="Quitar filtro Primera entrevista sin cargo"><i class="fa fa-times" aria-hidden="true"></i>No</a>';
				} else {
					$nueva_url = basename($_SERVER['REQUEST_URI']).'&pesc[]=2';
					echo '<a href="'.$nueva_url.'" title="Primera entrevista sin cargo">No</a>';
				}
				?>
			</div>
			
			<div class="bloque_filtros">
				<span>Atiende Obra Social</span>
				<?php
				if (in_array('1', $aos)) {
					$nueva_url = str_replace("&aos[]=1","",basename($_SERVER['REQUEST_URI']));
					echo '<a href="'.$nueva_url.'" title="Quitar filtro Atiende Obra Social"><i class="fa fa-times" aria-hidden="true"></i>Si</a>';
					$mostrar_os = TRUE;
				} else {
					$nueva_url = basename($_SERVER['REQUEST_URI']).'&aos[]=1';
					echo '<a href="'.$nueva_url.'" title="Atiende Obra Social">Si</a>';
				}
				if (in_array('2', $aos)) {
					$nueva_url = str_replace("&aos[]=2","",basename($_SERVER['REQUEST_URI']));
					echo '<a href="'.$nueva_url.'" title="Quitar filtro NO Atiende Obra Social"><i class="fa fa-times" aria-hidden="true"></i>No</a>';
				} else {
					$nueva_url = basename($_SERVER['REQUEST_URI']).'&aos[]=2';
					echo '<a href="'.$nueva_url.'" title="NO Atiende Obra Social">No</a>';
				}
				?>
			</div>
			
			<?php
			if($mostrar_os){
				//Obras sociales
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_osocial_filtro = "select * from obras_sociales where active = '1' order by nombre asc";
				$R_osocial_filtro = mysql_query($query_R_osocial_filtro, $ddbb_naevp) or die(mysql_error());
				$row_R_osocial_filtro = mysql_fetch_assoc($R_osocial_filtro);
				$totalRows_R_osocial_filtro = mysql_num_rows($R_osocial_filtro);
				if($totalRows_R_osocial_filtro>0){
			?>
			<div class="bloque_filtros">
				<span>Obras Sociales</span>
				<ul class="lista_filtros">
				<?php 
					do { 
					if (in_array($row_R_osocial_filtro['id'], $osocial)) {
					$nueva_url = str_replace("&osocial[]=".$row_R_osocial_filtro['id'],"",basename($_SERVER['REQUEST_URI']));
				?>
				<li class="term-item "><a href="<?php echo $nueva_url; ?>" title="Quitar filtro <?php echo $row_R_osocial_filtro['nombre']; ?>"><i class="fa fa-times" aria-hidden="true"></i><?php echo $row_R_osocial_filtro['nombre']; ?></a></li>
				<?php } else { ?>
				<li class="term-item "><a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&osocial[]=<?php echo $row_R_osocial_filtro['id']; ?>" title="<?php echo $row_R_osocial_filtro['nombre']; ?>">- <?php echo $row_R_osocial_filtro['nombre']; ?></a></li>
				<?php } } while ($row_R_osocial_filtro = mysql_fetch_assoc($R_osocial_filtro)); ?>
				</ul>
			</div>
			<?php } } ?>
			
			<?php
				//Población Clínica
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_pclinica_filtro = "select * from poblacion_clinica where active = '1' order by poblacion asc";
				$R_pclinica_filtro = mysql_query($query_R_pclinica_filtro, $ddbb_naevp) or die(mysql_error());
				$row_R_pclinica_filtro = mysql_fetch_assoc($R_pclinica_filtro);
				$totalRows_R_pclinica_filtro = mysql_num_rows($R_pclinica_filtro);
				if($totalRows_R_pclinica_filtro>0){
			?>
			<div class="bloque_filtros">
				<span>Población Clínica</span>
				<ul class="lista_filtros">
				<?php 
					do { 
					if (in_array($row_R_pclinica_filtro['id'], $pclinica)) {
					$nueva_url = str_replace("&pclinica[]=".$row_R_pclinica_filtro['id'],"",basename($_SERVER['REQUEST_URI']));
				?>
				<li class="term-item "><a href="<?php echo $nueva_url; ?>" title="Quitar filtro <?php echo $row_R_pclinica_filtro['poblacion']; ?>"><i class="fa fa-times" aria-hidden="true"></i><?php echo $row_R_pclinica_filtro['poblacion']; ?></a></li>
				<?php } else { ?>
				<li class="term-item "><a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&pclinica[]=<?php echo $row_R_pclinica_filtro['id']; ?>" title="<?php echo $row_R_pclinica_filtro['poblacion']; ?>">- <?php echo $row_R_pclinica_filtro['poblacion']; ?></a></li>
				<?php } } while ($row_R_pclinica_filtro = mysql_fetch_assoc($R_pclinica_filtro)); ?>
				</ul>
			</div>
			<?php } ?>
			
			<?php
				//Modalidad Atención
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_matencion_filtro = "select * from modalidad_atencion where active = '1' order by modalidad_atencion asc";
				$R_matencion_filtro = mysql_query($query_R_matencion_filtro, $ddbb_naevp) or die(mysql_error());
				$row_R_matencion_filtro = mysql_fetch_assoc($R_matencion_filtro);
				$totalRows_R_matencion_filtro = mysql_num_rows($R_matencion_filtro);
				if($totalRows_R_matencion_filtro>0){
			?>
			<div class="bloque_filtros">
				<span>Modalidad Atención</span>
				<?php 
					do { 
					if (in_array($row_R_matencion_filtro['id'], $matencion)) {
					$nueva_url = str_replace("&matencion[]=".$row_R_matencion_filtro['id'],"",basename($_SERVER['REQUEST_URI']));
				?>
				<a href="<?php echo $nueva_url; ?>" title="Quitar filtro <?php echo $row_R_matencion_filtro['modalidad_atencion']; ?>"><i class="fa fa-times" aria-hidden="true"></i><?php echo $row_R_matencion_filtro['modalidad_atencion']; ?></a>
				<?php } else { ?>
				<a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&matencion[]=<?php echo $row_R_matencion_filtro['id']; ?>" title="<?php echo $row_R_matencion_filtro['modalidad_atencion']; ?>">- <?php echo $row_R_matencion_filtro['modalidad_atencion']; ?></a>
				<?php } } while ($row_R_matencion_filtro = mysql_fetch_assoc($R_matencion_filtro)); ?>
			</div>
			<?php } ?>
			
			<?php
				//Modalidad de Trabajo
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_mtrabajo_filtro = "select * from modalidad_trabajo where active = '1' order by modalidad_trabajo asc";
				$R_mtrabajo_filtro = mysql_query($query_R_mtrabajo_filtro, $ddbb_naevp) or die(mysql_error());
				$row_R_mtrabajo_filtro = mysql_fetch_assoc($R_mtrabajo_filtro);
				$totalRows_R_mtrabajo_filtro = mysql_num_rows($R_mtrabajo_filtro);
				if($totalRows_R_mtrabajo_filtro>0){
			?>
			<div class="bloque_filtros">
				<span>Modalidad de Trabajo</span>
				<ul class="lista_filtros">
				<?php 
					do { 
					if (in_array($row_R_mtrabajo_filtro['id'], $mtrabajo)) {
					$nueva_url = str_replace("&mtrabajo[]=".$row_R_mtrabajo_filtro['id'],"",basename($_SERVER['REQUEST_URI']));
				?>
				<li class="term-item "><a href="<?php echo $nueva_url; ?>" title="Quitar filtro <?php echo $row_R_mtrabajo_filtro['modalidad_trabajo']; ?>"><i class="fa fa-times" aria-hidden="true"></i><?php echo $row_R_mtrabajo_filtro['modalidad_trabajo']; ?></a></li>
				<?php } else { ?>
				<li class="term-item "><a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&mtrabajo[]=<?php echo $row_R_mtrabajo_filtro['id']; ?>" title="<?php echo $row_R_mtrabajo_filtro['modalidad_trabajo']; ?>">- <?php echo $row_R_mtrabajo_filtro['modalidad_trabajo']; ?></a></li>
				<?php } } while ($row_R_mtrabajo_filtro = mysql_fetch_assoc($R_mtrabajo_filtro)); ?>
				</ul>
			</div>
			<?php } ?>
			
			<div class="bloque_filtros">
				<span>Disponible para Emergencias</span>
				<?php
				if (in_array('1', $dpe)) {
					$nueva_url = str_replace("&dpe[]=1","",basename($_SERVER['REQUEST_URI']));
					echo '<a href="'.$nueva_url.'" title="Quitar filtro Disponible para emergencias"><i class="fa fa-times" aria-hidden="true"></i>Si</a>';
				} else {
					$nueva_url = basename($_SERVER['REQUEST_URI']).'&dpe[]=1';
					echo '<a href="'.$nueva_url.'" title="Disponible para emergencias">Si</a>';
				}
				if (in_array('2', $dpe)) {
					$nueva_url = str_replace("&dpe[]=2","",basename($_SERVER['REQUEST_URI']));
					echo '<a href="'.$nueva_url.'" title="Quitar filtro NO Disponible para emergencias"><i class="fa fa-times" aria-hidden="true"></i>No</a>';
				} else {
					$nueva_url = basename($_SERVER['REQUEST_URI']).'&dpe[]=2';
					echo '<a href="'.$nueva_url.'" title="NO Disponible para emergencias">No</a>';
				}
				?>
			</div>
			
			<?php
				//Idiomas
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_idiomas_filtro = "select * from idiomas where active = '1' order by orden asc, nombre asc";
				$R_idiomas_filtro = mysql_query($query_R_idiomas_filtro, $ddbb_naevp) or die(mysql_error());
				$row_R_idiomas_filtro = mysql_fetch_assoc($R_idiomas_filtro);
				$totalRows_R_idiomas_filtro = mysql_num_rows($R_idiomas_filtro);
				if($totalRows_R_idiomas_filtro>0){
			?>
			<div class="bloque_filtros">
				<span>Idiomas</span>
				<ul class="lista_filtros">
				<?php 
					do { 
					if (in_array($row_R_idiomas_filtro['id'], $idiomas)) {
					$nueva_url = str_replace("&idiomas[]=".$row_R_idiomas_filtro['id'],"",basename($_SERVER['REQUEST_URI']));
				?>
				<li class="term-item "><a href="<?php echo $nueva_url; ?>" title="Quitar filtro <?php echo $row_R_idiomas_filtro['nombre']; ?>"><i class="fa fa-times" aria-hidden="true"></i><?php echo $row_R_idiomas_filtro['nombre']; ?></a></li>
				<?php } else { ?>
				<li class="term-item "><a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&idiomas[]=<?php echo $row_R_idiomas_filtro['id']; ?>" title="<?php echo $row_R_idiomas_filtro['nombre']; ?>">- <?php echo $row_R_idiomas_filtro['nombre']; ?></a></li>
				<?php } } while ($row_R_idiomas_filtro = mysql_fetch_assoc($R_idiomas_filtro)); ?>
				</ul>
			</div>
			<?php } ?>
			
			<?php
				//Temáticas
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_tematicas_filtro = "select * from tematicas where active = '1' order by nombre asc";
				$R_tematicas_filtro = mysql_query($query_R_tematicas_filtro, $ddbb_naevp) or die(mysql_error());
				$row_R_tematicas_filtro = mysql_fetch_assoc($R_tematicas_filtro);
				$totalRows_R_tematicas_filtro = mysql_num_rows($R_tematicas_filtro);
				if($totalRows_R_tematicas_filtro>0){
			?>
			<div class="bloque_filtros">
				<span>Temáticas</span>
				<ul class="lista_filtros">
				<?php 
					do { 
					if (in_array($row_R_tematicas_filtro['id'], $tematicas)) {
					$nueva_url = str_replace("&tematicas[]=".$row_R_tematicas_filtro['id'],"",basename($_SERVER['REQUEST_URI']));
				?>
				<li class="term-item "><a href="<?php echo $nueva_url; ?>" title="Quitar filtro <?php echo $row_R_tematicas_filtro['nombre']; ?>"><i class="fa fa-times" aria-hidden="true"></i><?php echo $row_R_tematicas_filtro['nombre']; ?></a></li>
				<?php } else { ?>
				<li class="term-item "><a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&tematicas[]=<?php echo $row_R_tematicas_filtro['id']; ?>" title="<?php echo $row_R_tematicas_filtro['nombre']; ?>">- <?php echo $row_R_tematicas_filtro['nombre']; ?></a></li>
				<?php } } while ($row_R_tematicas_filtro = mysql_fetch_assoc($R_tematicas_filtro)); ?>
				</ul>
			</div>
			<?php } ?>
			
			<?php
			if($espfilter==2||$espfilter==3){
				//Orientación Clínica
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_oclinica_filtro = "select * from orientacion_clinica where active = '1' order by nombre asc";
				$R_oclinica_filtro = mysql_query($query_R_oclinica_filtro, $ddbb_naevp) or die(mysql_error());
				$row_R_oclinica_filtro = mysql_fetch_assoc($R_oclinica_filtro);
				$totalRows_R_oclinica_filtro = mysql_num_rows($R_oclinica_filtro);
				if($totalRows_R_oclinica_filtro>0){
			?>
			<div class="bloque_filtros">
				<span>Orientación Clínica</span>
				<ul class="lista_filtros">
				<?php
					do {
					if (in_array($row_R_oclinica_filtro['id'], $oclinica)) {
					$nueva_url = str_replace("&oclinica[]=".$row_R_oclinica_filtro['id'],"",basename($_SERVER['REQUEST_URI']));
				?>
				<li class="term-item "><a href="<?php echo $nueva_url; ?>" title="Quitar filtro <?php echo $row_R_oclinica_filtro['nombre']; ?>"><i class="fa fa-times" aria-hidden="true"></i><?php echo $row_R_oclinica_filtro['nombre']; ?></a></li>
				<?php } else { ?>
				<li class="term-item "><a href="<?php echo basename($_SERVER['REQUEST_URI']); ?>&oclinica[]=<?php echo $row_R_oclinica_filtro['id']; ?>" title="<?php echo $row_R_oclinica_filtro['nombre']; ?>">- <?php echo $row_R_oclinica_filtro['nombre']; ?></a></li>
				<?php } } while ($row_R_oclinica_filtro = mysql_fetch_assoc($R_oclinica_filtro)); ?>
				</ul>
			</div>
			<script>
				$(window).load(function(){
					$('.lista_filtros').each(function() {
						var $list = $(this);
						$list.before('<button class="more_less">Más opciones</button>')
						$list.find('.term-item:gt(2)').hide();
					});
					$('.more_less').click(function() {
						var $btn = $(this)
						$btn.next().find('.term-item:gt(2)').slideToggle();    
						$btn.text($btn.text() == 'Más opciones' ? 'Menos opciones' : 'Más opciones');    
					});
				});
			</script>
			<?php } } ?>
			
		</div>
		<?php } else { ?>
		<h1>Lamentablemente no encontramos resultados para tu búsqueda.<br/>Vuelve a intentarlo ingresando diferentes parámetros.</h1>
		<?php } ?>						
	</div>
</div>

<!-- Modal Enviar Mensaje -->
<div id="EnviarMensaje" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<!--Aca el contenido externo-->
    </div>
  </div>
</div>

<script type="text/javascript">
$('.modal').on('hidden.bs.modal', function(e){ 
	$(this).removeData();
	$("#recaptcha2").empty();
}) ;
$('.modal').on('shown.bs.modal', function() {
    grecaptcha.render("captcha2", {sitekey: "<?php echo $clave_sitio; ?>", theme: "light"});
})
</script>