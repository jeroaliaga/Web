<?php
	$id_user_i = $_SESSION['id_usuario'];
	//consultas extra para el perfil
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_i = "select * from users_info where id_usuario = '$id_user_i'";
	$R_user_info_i = mysql_query($query_R_user_info_i, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_i = mysql_fetch_assoc($R_user_info_i);
	$totalRows_R_user_info_i = mysql_num_rows($R_user_info_i);
	
	//consultas especialidades
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_esp = "select * from opciones_x_usuario where id_usuario = '$id_user_i' and grupo_opciones = '1'";
	$R_user_info_esp = mysql_query($query_R_user_info_esp, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_esp = mysql_fetch_assoc($R_user_info_esp);
	$totalRows_R_user_info_esp = mysql_num_rows($R_user_info_esp);
	if($totalRows_R_user_info_esp>0){
		$array_especialidades = array();
		do {
			$array_especialidades[] = $row_R_user_info_esp['id_opcion'];
		} while ($row_R_user_info_esp = mysql_fetch_assoc($R_user_info_esp));
	}
	
	//consultas idiomas
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_idi = "select * from opciones_x_usuario where id_usuario = '$id_user_i' and grupo_opciones = '2'";
	$R_user_info_idi = mysql_query($query_R_user_info_idi, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_idi = mysql_fetch_assoc($R_user_info_idi);
	$totalRows_R_user_info_idi = mysql_num_rows($R_user_info_idi);
	if($totalRows_R_user_info_idi>0){
		$array_idiomas = array();
		do {
			$array_idiomas[] = $row_R_user_info_idi['id_opcion'];
		} while ($row_R_user_info_idi = mysql_fetch_assoc($R_user_info_idi));
	}
	
	//consultas Modalidad Atencion
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_ma = "select * from opciones_x_usuario where id_usuario = '$id_user_i' and grupo_opciones = '3'";
	$R_user_info_ma = mysql_query($query_R_user_info_ma, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_ma = mysql_fetch_assoc($R_user_info_ma);
	$totalRows_R_user_info_ma = mysql_num_rows($R_user_info_ma);
	if($totalRows_R_user_info_ma>0){
		$array_modalidad_atencion = array();
		do {
			$array_modalidad_atencion[] = $row_R_user_info_ma['id_opcion'];
		} while ($row_R_user_info_ma = mysql_fetch_assoc($R_user_info_ma));
	}
	
	//consultas Obras Sociales
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_os = "select * from opciones_x_usuario where id_usuario = '$id_user_i' and grupo_opciones = '4'";
	$R_user_info_os = mysql_query($query_R_user_info_os, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_os = mysql_fetch_assoc($R_user_info_os);
	$totalRows_R_user_info_os = mysql_num_rows($R_user_info_os);
	if($totalRows_R_user_info_os>0){
		$array_obras_sociales = array();
		do {
			$array_obras_sociales[] = $row_R_user_info_os['id_opcion'];
		} while ($row_R_user_info_os = mysql_fetch_assoc($R_user_info_os));
	}
	
	//consultas Poblacion Clinica
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_pc = "select * from opciones_x_usuario where id_usuario = '$id_user_i' and grupo_opciones = '5'";
	$R_user_info_pc = mysql_query($query_R_user_info_pc, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_pc = mysql_fetch_assoc($R_user_info_pc);
	$totalRows_R_user_info_pc = mysql_num_rows($R_user_info_pc);
	if($totalRows_R_user_info_pc>0){
		$array_poblacion_clinica = array();
		do {
			$array_poblacion_clinica[] = $row_R_user_info_pc['id_opcion'];
		} while ($row_R_user_info_pc = mysql_fetch_assoc($R_user_info_pc));
	}
	
	//consulto mis publicaciones
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_publicaciones = "select publicaciones.*, tipo_publicacion.path 
	from publicaciones, tipo_publicacion 
	where publicaciones.page_author = '$id_user_i' 
	and publicaciones.parent = '0' 
	and publicaciones.menu_parent = tipo_publicacion.id 
	order by publicaciones.hoy_ahora desc";
	$R_user_publicaciones = mysql_query($query_R_user_publicaciones, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_publicaciones = mysql_fetch_assoc($R_user_publicaciones);
	$totalRows_R_user_publicaciones = mysql_num_rows($R_user_publicaciones);
	
	if($edit){
		//busco los datos de la publicacion a editar
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_user_publicaciones_e = "select publicaciones.*, tipo_publicacion.path 
		from publicaciones, tipo_publicacion 
		where publicaciones.page_author = '$id_user_i' 
		and publicaciones.parent = '0' 
		and publicaciones.id = '$edit' 
		and publicaciones.menu_parent = tipo_publicacion.id 
		order by publicaciones.hoy_ahora desc";
		$R_user_publicaciones_e = mysql_query($query_R_user_publicaciones_e, $ddbb_naevp) or die(header($error_mysql));
		$row_R_user_publicaciones_e = mysql_fetch_assoc($R_user_publicaciones_e);
		$totalRows_R_user_publicaciones_e = mysql_num_rows($R_user_publicaciones_e);
		do {
			$edit_title = $row_R_user_publicaciones_e['page_title'];
			$edit_content = $row_R_user_publicaciones_e['page_content'];
			$edit_tags = $row_R_user_publicaciones_e['tags'];
			$post_type = $row_R_user_publicaciones_e['menu_parent'];
			$post_target = $row_R_user_publicaciones_e['target'];
		} while ($row_R_user_publicaciones_e = mysql_fetch_assoc($R_user_publicaciones_e));
	}
?>
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
		<div class="col-xs-12 col-md-12">
			<div class="bloque_tabs">
				<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
					<li <?php if(!$DoGuardarPerfil&&!$DoPublish&&!$edit){echo 'class="active"'; } ?>><a href="#material" data-toggle="tab"><i class="fa fa-paperclip" aria-hidden="true"></i> Publicaciones</a></li>
					<li <?php if($DoPublish){echo 'class="active"'; } ?>><a href="#nueva_publicacion" data-toggle="tab"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva Publicación</a></li>
					<li <?php if($DoGuardarPerfil){echo 'class="active"'; } ?>><a href="#perfil" data-toggle="tab"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Mi Perfil</a></li>
					<?php if($totalRows_R_user_publicaciones_e>0){?>
					<li class="active"><a href="#edit" data-toggle="tab"><i class="fa fa-pencil" aria-hidden="true"></i> <?php echo substr($edit_title, 0, 15); ?>...</a></li>
					<?php } ?>
				</ul>
				<div id="my-tab-content" class="tab-content">
					<div class="tab-pane<?php if(!$DoGuardarPerfil&&!$DoPublish&&!$edit){echo ' active'; } ?>" id="material">
						<?php if($totalRows_R_user_publicaciones==0){?>
							<h1>Aun no tienes publicaciones realizadas.</h1>
						<?php } else { ?>
							<h1>Estas son tus publicaciones.</h1>
							<ul class="bloque_mis_comentarios">
								<?php 
									do { 
									$id_publicacion = $row_R_user_publicaciones['id'];
									//cuento las respuestas
									mysql_select_db($database_name, $ddbb_naevp);
									mysql_query("SET NAMES 'utf8'");
									$query_R_user_publicaciones_r = "select * from publicaciones where parent = '$id_publicacion'";
									$R_user_publicaciones_r = mysql_query($query_R_user_publicaciones_r, $ddbb_naevp) or die(header($error_mysql));
									$row_R_user_publicaciones_r = mysql_fetch_assoc($R_user_publicaciones_r);
									$totalRows_R_user_publicaciones_r = mysql_num_rows($R_user_publicaciones_r);
								?>
								<li>
									<div class="col-xs-12 col-md-1 col_comentarios">
										<h3><?php echo $totalRows_R_user_publicaciones_r; ?><br/><i class="fa fa-comments-o" aria-hidden="true"></i></h3>
									</div>
									<div class="col-xs-12 col-md-10 col_contenido">
										<h2><?php echo $row_R_user_publicaciones['page_title']; ?></h2>
										<div class="parrafo"><?php echo substr($row_R_user_publicaciones['page_content'], 0, 500); ?>...</div>
										<span><?php echo date("d/m/Y h:i A", strtotime($row_R_user_publicaciones['hoy_ahora'])); ?></span>
									</div>
									<div class="col-xs-12 col-md-1 col_actions">
										<a href="<?php echo $ruta_raiz.'mi-perfil/?edit='.$row_R_user_publicaciones['id'].'&id_user_i='.$id_user_i; ?>" title="Editar"><i class="fa fa-pencil" aria-hidden="true"></i></a>
										<a href="<?php echo $ruta_raiz.'includes/procesos/DoDelelePublicacion.php?id='.$row_R_user_publicaciones['id']; ?>" data-toggle="modal" data-target="#EliminarPublicacion" title="Eliminar"><i class="fa fa-trash" aria-hidden="true"></i></a>
										<a href="<?php echo $ruta_raiz.$row_R_user_publicaciones['path'].'/?id='.$row_R_user_publicaciones['id']; ?>" title="Ver nota completa"><i class="fa fa-eye" aria-hidden="true"></i></a>
									</div>
								</li>
								<?php } while ($row_R_user_publicaciones = mysql_fetch_assoc($R_user_publicaciones)); ?>
							</ul>
						<?php } ?>
					</div>
					<div class="tab-pane<?php if($DoPublish){echo ' active'; } ?>" id="nueva_publicacion">
						<h1>Ingresa el contenido de la nueva publicación</h1>
						<form name="login_form" id="perfil_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<input name="post_title" placeholder="Título" required type="text" class="form-control" <?php if($_SESSION['nombre']){echo 'value="'.$_SESSION['nombre'].'"';}?>>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<textarea id="summernote" class="form-control" name="post_content"></textarea>
									<script>
										$(document).ready(function() {
											var IMAGE_PATH = 'http://desaludhablamos.com/static/img_publicaciones/';
											$('#summernote').summernote({
												toolbar: [
													// [groupName, [list of button]]
													['style', ['bold', 'italic', 'underline', 'clear']],
													['font', ['strikethrough', 'superscript', 'subscript']],
													['fontsize', ['fontsize']],
													['color', ['color']],
													['para', ['ul', 'ol', 'paragraph']],
													['height', ['height']],
													['insert', ['picture', 'link', 'video', 'table']],
													['misc', ['fullscreen', 'codeview', 'undo', 'redo']]
												],
												lang: 'es-ES',
												placeholder: 'Escribe aquí el contenido de la publicación...',
												height: 400,                 // set editor height
												minHeight: null,             // set minimum height of editor
												maxHeight: null,             // set maximum height of editor
												focus: true,                 // set focus to editable area after initializing summernote
												callbacks : {
													onImageUpload: function(image) {
														uploadImage(image[0]);
													}
												}
											});
										
										function uploadImage(image) {
											var data = new FormData();
											data.append("image",image);
											$.ajax ({
												data: data,
												type: "POST",
												url: "<?php echo $ruta_raiz; ?>includes/procesos/uploadSummernoteImage.php",// this file uploads the picture and 
																 // returns a chain containing the path
												cache: false,
												contentType: false,
												processData: false,
												success: function(url) {
													var image = IMAGE_PATH + url;
													$('#summernote').summernote("insertImage", image);
													},
													error: function(data) {
														console.log(data);
														}
												});
											}
										});
									</script>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<select name="post_target" class="form-control" required>
										<option>Seleccionar a quién va dirigida la publicación</option>
										<?php foreach($tipo_usuarios_array as $tipo_usuarios){ ?>
										<option value="<?php echo $tipo_usuarios['id']; ?>" <?php if($_SESSION['post_target'] && $_SESSION['post_target']==$tipo_usuarios['id']){echo ' selected'; } ?>><?php echo $tipo_usuarios['tipo_usuario']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<select name="post_type" class="form-control" required>
										<option>Seleccionar tipo de publicación</option>
										<?php foreach($tipo_publicacion_array as $tipo_publicacion){?>
										<option value="<?php echo $tipo_publicacion['id']; ?>" <?php if($_SESSION['post_type'] && $_SESSION['post_type']==$tipo_publicacion['id']){echo ' selected'; } ?>><?php echo $tipo_publicacion['tipo_publicacion']; ?></option>
										<?php }  ?>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="post_tags" placeholder="Ingresa las palabras claves de la publicación"></textarea>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<button type="submit" class="btn btn-default btn_publicar">Publicar</button>
								<input type="hidden" name="action" value="publish" />
							</div>
						</form>
					</div>
					<div class="tab-pane<?php if($DoGuardarPerfil){echo ' active'; } ?>" id="perfil">
						<h1>Mantén tu perfil actualizado</h1>
						<form name="login_form" id="perfil_form" enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="email">Nombre*</label>
									<input name="nombre" required type="text" class="form-control" <?php if($_SESSION['nombre']){echo 'value="'.$_SESSION['nombre'].'"';} else { echo 'value="'.$_SESSION['nombre_usr'].'"'; }?>>
								</div>
								<div class="form-group">
									<label for="email">Apellido*</label>
									<input name="apellido" required type="text" class="form-control" <?php if($_SESSION['apellido']){echo 'value="'.$_SESSION['apellido'].'"';} else { echo 'value="'.$_SESSION['apellido_usr'].'"'; }?>>
								</div>
								<div class="form-group">
									<label for="email">Email*:</label>
									<input name="email" required type="email" class="form-control" id="email" <?php if($_SESSION['email']){echo 'value="'.$_SESSION['email'].'"';} else { echo 'value="'.$_SESSION['email_usr'].'"'; }?>>
								</div>
								<div class="form-group">
									<label for="email">Fecha de Nacimiento*:</label>
									<input type="text" name="fecha_nacimiento" class="form-control" required <?php if($_SESSION['fecha_nacimiento']){echo 'value="'.$_SESSION['fecha_nacimiento'].'"';} else { if($row_R_user_info_i['fecha_nacimiento']){echo 'value="'.date("m/d/Y", strtotime($row_R_user_info_i['fecha_nacimiento'])).'"';} }?> />
								</div>
								<div class="form-group">
									<label for="email">Código Postal*:</label>
									<input name="cp" required type="text" class="form-control" <?php if($_SESSION['cp']){echo 'value="'.$_SESSION['cp'].'"';} else { if($row_R_user_info_i['codigo_postal']){echo 'value="'.$row_R_user_info_i['codigo_postal'].'"';} }?>>
								</div>
								<div class="form-group">
									<label for="email">Pais*:</label>
									<select name="pais" class="form-control" required>
										<option>Seleccionar</option>
										<?php do { ?>
										<option value="<?php echo $row_R_paises['id']; ?>" <?php if($_SESSION['pais'] && $_SESSION['pais']==$row_R_paises['id']){echo ' selected'; } else { if($row_R_user_info_i['id_pais']==$row_R_paises['id']){echo 'selected';} }?>><?php echo $row_R_paises['pais']; ?></option>
										<?php } while ($row_R_paises = mysql_fetch_assoc($R_paises)); ?>
									</select>
								</div>
								<div class="form-group">
									<label for="email">Ciudad*:</label>
									<input name="ciudad" required type="text" class="form-control" id="ciudad" <?php if($_SESSION['ciudad']){echo 'value="'.$_SESSION['ciudad'].'"';} else { if($row_R_user_info_i['ciudad']){echo 'value="'.$row_R_user_info_i['ciudad'].'"';} }?>>
								</div>
								<div class="form-group">
									<label for="email">Dirección del Consultorio:</label>
									<input name="consultorio_direccion" type="text" class="form-control" id="consultorio_direccion" <?php if($_SESSION['consultorio_direccion']){echo 'value="'.$_SESSION['consultorio_direccion'].'"';} else { if($row_R_user_info_i['consultorio_direccion']){echo 'value="'.$row_R_user_info_i['consultorio_direccion'].'"';} }?>>
								</div>
								<div class="form-group">
									<label for="email">Teléfono del Consultorio:</label>
									<input name="consultorio_telefono" type="text" class="form-control" id="consultorio_telefono" <?php if($_SESSION['consultorio_telefono']){echo 'value="'.$_SESSION['consultorio_telefono'].'"';} else { if($row_R_user_info_i['consultorio_telefono']){echo 'value="'.$row_R_user_info_i['consultorio_telefono'].'"';} }?>>
								</div>
								<div class="form-group">
									<label for="email">Número de matrícula nacional/provincial*:</label>
									<input name="matricula" required type="text" class="form-control" id="matricula" <?php if($_SESSION['matricula']){echo 'value="'.$_SESSION['matricula'].'"';} else { if($row_R_user_info_i['matricula']){echo 'value="'.$row_R_user_info_i['matricula'].'"';} }?>>
									<small>Sin matricula la pagina no verifica el perfil del profesional</small>
								</div>
								<div class="form-group">
									<label for="email">Honorarios*:</label>
									<input name="honorarios" type="text" class="form-control" id="honorarios" <?php if($_SESSION['honorarios']){echo 'value="'.$_SESSION['honorarios'].'"';} else { if($row_R_user_info_i['honorarios']){echo 'value="'.$row_R_user_info_i['honorarios'].'"';} }?>>
								</div>
								<div class="form-group">
									<label for="email">Realiza la primera entrevista sin cargo*:</label>
									<select name="pesc" class="form-control" required>
										<option>Seleccionar</option>
										<option value="1" <?php if($_SESSION['pesc']&&$_SESSION['pesc']==1){echo 'selected'; } else { if($row_R_user_info_i['pesc']=='1'){echo 'selected';} }?>>Si</option>
										<option value="2" <?php if($_SESSION['pesc']&&$_SESSION['pesc']==2){echo 'selected'; } else { if($row_R_user_info_i['pesc']=='2'){echo 'selected';} }?>>No</option>
									</select>
								</div>
								<div class="form-group">
									<label for="email">Formación académica: Estudios secundarios y universitarios, cursos, etc.</label>
									<textarea name="formacion_academica" class="form-control"><?php 
										if($_SESSION['formacion_academica']){
											echo $_SESSION['formacion_academica'];
										} else { if($row_R_user_info_i['formacion_academica']){echo $row_R_user_info_i['formacion_academica'];} }
										?></textarea>
								</div>
								<div class="form-group">
									<label for="email">Experiencia laboral</label>
									<textarea name="experiencia_laboral" class="form-control"><?php 
										if($_SESSION['experiencia_laboral']){
											echo $_SESSION['experiencia_laboral'];
										} else { if($row_R_user_info_i['experiencia_laboral']){echo $row_R_user_info_i['experiencia_laboral'];} }
										?></textarea>
								</div>
								<div class="form-group">
									<label for="email">¿Es parte de alguna asociación o institución?</label>
									<textarea name="asociacion_institucion" class="form-control"><?php 
										if($_SESSION['asociacion_institucion']){
											echo $_SESSION['asociacion_institucion'];
										} else { if($row_R_user_info_i['asociacion_institucion']){echo $row_R_user_info_i['asociacion_institucion'];} }
										?></textarea>
								</div>
								<div class="form-group">
									<label for="email">Página web personal:</label>
									<input name="www" type="text" class="form-control" id="www" <?php if($_SESSION['www']){echo 'value="'.$_SESSION['www'].'"';} else { if($row_R_user_info_i['www']){echo 'value="'.$row_R_user_info_i['www'].'"';} }?>>
								</div>
								<div class="form-group">
									<label for="email">Presentación personal</label>
									<textarea name="presentacion_personal" class="form-control"><?php 
										if($_SESSION['presentacion_personal']){
											echo $_SESSION['presentacion_personal'];
										} else { if($row_R_user_info_i['presentacion_personal']){echo $row_R_user_info_i['presentacion_personal'];} }
										?></textarea>
								</div>
								<div class="form-group">
									<label for="email">Imagen de perfil</label>
									<input name="file" id="input-2" type="file" class="file" data-show-upload="false" data-show-caption="true">
									<div id="errorBlock43" class="help-block"></div>
									<script>
									$("#input-2").fileinput({
										maxFileSize: 2000,
										allowedFileExtensions: ["jpg", "png", "gif", "jpeg"],
										elErrorContainer: "#errorBlock43",
										<?php if($_SESSION['img_usr']){?>
										initialPreview: [
											"<img style='height:160px' src='<?php echo $_SESSION['img_usr']; ?>'>",
										],
										initialCaption: 'Initial-Image.jpg',
										initialPreviewShowDelete: false,
										showRemove: false,
										showClose: false,
										<?php } ?>
										browseLabel: "Buscar imagen..."
									});
									</script>
								</div>
							</div>
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="especialidades">Especialidades*:</label>
										<ul class="especialidades">
										<?php 
											do { 
											$id_especialidad_parent = $row_R_esp['id'];
											//obtengo las sub especialidades
											mysql_select_db($database_name, $ddbb_naevp);
											mysql_query("SET NAMES 'utf8'");
											$query_R_sesp = "select * from especialidades where active = 1 and parent = '$id_especialidad_parent' order by nombre asc";
											$R_sesp = mysql_query($query_R_sesp, $ddbb_naevp) or die(header($error_mysql));
											$row_R_sesp = mysql_fetch_assoc($R_sesp);
											$totalRows_R_sesp = mysql_num_rows($R_sesp);
											
											if($totalRows_R_sesp>0){
												//hay subespecialidades
												echo '<p class="subesp_title">'.$row_R_esp['nombre'].'</p>';
												echo '<ul class="subesp">';
												do {
													echo '<li>';
													echo '<input type="checkbox" name="especialidades[]" ';
													if($_SESSION['especialidades']){
														if (in_array($row_R_sesp['id'], $_SESSION['especialidades'])) { 
															echo 'checked="checked"'; 
														}
													} else {
														if (in_array($row_R_sesp['id'], $array_especialidades)) { 
															echo 'checked="checked"'; 
														}
													}													
													echo 'value="'.$row_R_sesp['id'].'">'.$row_R_sesp['nombre'];
													echo '</li>';
												} while ($row_R_sesp = mysql_fetch_assoc($R_sesp));
												echo '</ul>';
											} else {
												//no hay subespecialidades
												echo '<li>';
												echo '<input type="checkbox" name="especialidades[]" ';
												if($_SESSION['especialidades']){
													if (in_array($row_R_esp['id'], $_SESSION['especialidades'])) { 
														echo 'checked="checked"'; 
													}
												} else {
													if (in_array($row_R_esp['id'], $array_especialidades)) { 
														echo 'checked="checked"'; 
													}
												}
												echo 'value="'.$row_R_esp['id'].'">'.$row_R_esp['nombre'];
												echo '</li>';
											}
										} while ($row_R_esp = mysql_fetch_assoc($R_esp)); ?>
										</ul>
								</div>
								<div class="form-group">
									<label for="especialidades">Población Clínica con la que trabaja*:</label>
										<ul class="especialidades">
										<?php do { ?>
										<li>
										<input type="checkbox" name="poblacion_clinica[]" <?php if($_SESSION['poblacion_clinica']){if (in_array($row_R_pc['id'], $_SESSION['poblacion_clinica'])) { echo 'checked="checked"'; } } else { if (in_array($row_R_pc['id'], $array_poblacion_clinica)) { echo 'checked="checked"'; } } ?> value="<?php echo $row_R_pc['id']; ?>"><?php echo $row_R_pc['poblacion']; ?>
										</li>
										<?php } while ($row_R_pc = mysql_fetch_assoc($R_pc)); ?>
										</ul>
								</div>
								<div class="form-group">
									<label for="especialidades">Modalidad Atención*:</label>
										<ul class="especialidades">
										<?php do { ?>
										<li>
										<input type="checkbox" name="modalidad_atencion[]" <?php if($_SESSION['modalidad_atencion']){if (in_array($row_R_ma['id'], $_SESSION['modalidad_atencion'])) { echo 'checked="checked"'; } } else { if (in_array($row_R_ma['id'], $array_modalidad_atencion)) { echo 'checked="checked"'; } }?> value="<?php echo $row_R_ma['id']; ?>"><?php echo $row_R_ma['modalidad_atencion']; ?>
										</li>
										<?php } while ($row_R_ma = mysql_fetch_assoc($R_ma)); ?>
										</ul>
								</div>
								<div class="form-group">
									<label for="especialidades">Disponible en Emergencias*:</label>
										<ul class="especialidades">
											<li><input type="radio" name="disponible_emergencias" value="1" <?php if($_SESSION['disponible_emergencias']&&$_SESSION['disponible_emergencias']=='1'){ echo 'checked="checked"'; } else { if($row_R_user_info_i['disponible_emergencias']=='1'){ echo 'checked="checked"'; } }?>>Si</li>
											<li><input type="radio" name="disponible_emergencias" value="2" <?php if($_SESSION['disponible_emergencias']&&$_SESSION['disponible_emergencias']=='2'){ echo 'checked="checked"'; } else { if($row_R_user_info_i['disponible_emergencias']=='2'){ echo 'checked="checked"'; } }?>>No</li>
										</ul>
								</div>
								<div class="form-group">
									<label for="especialidades">Idiomas*:</label>
										<ul class="especialidades">
										<?php do { ?>
										<li>
										<input type="checkbox" name="idiomas[]" value="<?php echo $row_R_idi['id']; ?>" <?php if($_SESSION['idiomas']){if (in_array($row_R_idi['id'], $_SESSION['idiomas'])) { echo 'checked="checked"'; } } else { if (in_array($row_R_idi['id'], $array_idiomas)) { echo 'checked="checked"'; } } ?>><?php echo $row_R_idi['nombre']; ?>
										</li>
										<?php } while ($row_R_idi = mysql_fetch_assoc($R_idi)); ?>
										</ul>
								</div>
								<div class="form-group">
									<label for="email">Atiende con Obra Social:</label>
									<select name="os" id="os" class="form-control" required>
										<option>Seleccionar</option>
										<option value="1" <?php if($_SESSION['os']&&$_SESSION['os']=='1'){ echo 'selected'; } else { if($row_R_user_info_i['os']=='1'){echo 'selected';} }?>>Si</option>
										<option value="2" <?php if($_SESSION['os']&&$_SESSION['os']=='2'){ echo 'selected'; } else { if($row_R_user_info_i['os']=='2'){echo 'selected';} }?>>No</option>
									</select>
									<ul class="especialidades" id="os_list" <?php if(($_SESSION['os']&&$_SESSION['os']=='1')||$row_R_user_info_i['os']=='1'){ echo 'style="display:inline;"'; } else { echo 'style="display:none;"'; }?> >
										<?php do { ?>
										<li>
										<input class="obras_sociales" type="checkbox" name="obras_sociales[]" <?php if($_SESSION['obras_sociales']){if (in_array($row_R_os['id'], $_SESSION['obras_sociales'])) { echo 'checked="checked"'; } } else { if (in_array($row_R_os['id'], $array_obras_sociales)) { echo 'checked="checked"'; } } ?> value="<?php echo $row_R_os['id']; ?>"><?php echo $row_R_os['nombre']; ?>
										</li>
										<?php } while ($row_R_os = mysql_fetch_assoc($R_os)); ?>
									</ul>
									<script>
									$(document).ready(function() {
										$("#os").change(function() {
											var el = $(this);			
											if (el.val()=='1') {
												$("#os_list").css("display", "inline");
											} else {
												$("#os_list").css("display", "none");
											}
										});
									});
									</script>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<button type="submit" class="btn btn-default">Guardar</button>
								<input type="hidden" name="action" value="DoGuardarPerfil" />
							</div>
						</form>
					</div>
					<?php if($totalRows_R_user_publicaciones_e>0){?>
					<div class="tab-pane active" id="edit">
						<h1>Edita la publicación</h1>
						<form name="login_form" id="perfil_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<input name="post_title" placeholder="Título" required type="text" class="form-control" <?php if($_SESSION['nombre']){echo 'value="'.$_SESSION['nombre'].'"';} else { if($edit_title){ echo 'value="'.$edit_title.'"'; } }?>>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<textarea id="summernote_edit" class="form-control" name="post_content"><?php if($edit_content){echo $edit_content;} ?></textarea>
									<script>
										$(document).ready(function() {
											var IMAGE_PATH = 'http://desaludhablamos.com/static/img_publicaciones/';
											$('#summernote_edit').summernote({
												toolbar: [
													// [groupName, [list of button]]
													['style', ['bold', 'italic', 'underline', 'clear']],
													['font', ['strikethrough', 'superscript', 'subscript']],
													['fontsize', ['fontsize']],
													['color', ['color']],
													['para', ['ul', 'ol', 'paragraph']],
													['height', ['height']],
													['insert', ['picture', 'link', 'video', 'table']],
													['misc', ['fullscreen', 'codeview', 'undo', 'redo']]
												],
												lang: 'es-ES',
												placeholder: 'Escribe aquí el contenido de la publicación...',
												height: 400,                 // set editor height
												minHeight: null,             // set minimum height of editor
												maxHeight: null,             // set maximum height of editor
												focus: true,                 // set focus to editable area after initializing summernote
												callbacks : {
													onImageUpload: function(image) {
														uploadImage(image[0]);
													}
												}
											});
										
										function uploadImage(image) {
											var data = new FormData();
											data.append("image",image);
											$.ajax ({
												data: data,
												type: "POST",
												url: "<?php echo $ruta_raiz; ?>includes/procesos/uploadSummernoteImage.php",// this file uploads the picture and 
																 // returns a chain containing the path
												cache: false,
												contentType: false,
												processData: false,
												success: function(url) {
													var image = IMAGE_PATH + url;
													$('#summernote_edit').summernote("insertImage", image);
													},
													error: function(data) {
														console.log(data);
														}
												});
											}
										});
									</script>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<select name="post_target" class="form-control" required>
										<option>Seleccionar a quién va dirigida la publicación</option>
										<?php foreach($tipo_usuarios_array as $tipo_usuarios){ ?>
										<option value="<?php echo $tipo_usuarios['id']; ?>" <?php if($_SESSION['post_target'] && $_SESSION['post_target']==$tipo_usuarios['id']){echo ' selected'; } else { if($post_target==$tipo_usuarios['id']){ echo ' selected'; } } ?>><?php echo $tipo_usuarios['tipo_usuario']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<select name="post_type" class="form-control" required>
										<option>Seleccionar tipo de publicación</option>
										<?php foreach($tipo_publicacion_array as $tipo_publicacion){?>
										<option value="<?php echo $tipo_publicacion['id']; ?>" <?php if($_SESSION['post_type'] && $_SESSION['post_type']==$tipo_publicacion['id']){echo ' selected'; } else { if($post_type==$tipo_publicacion['id']){ echo ' selected'; } }?>><?php echo $tipo_publicacion['tipo_publicacion']; ?></option>
										<?php }  ?>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="post_tags" placeholder="Ingresa las palabras claves de la publicación"><?php if($edit_tags){ echo $edit_tags; } ?></textarea>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<button type="submit" class="btn btn-default btn_publicar">Guardar</button>
								<input type="hidden" name="action" value="DoGuardarPublicacion" />
								<input type="hidden" name="idPublicacionEdit" value="<?php echo $edit; ?>" />
							</div>
						</form>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Eliminar Publicacion -->
<div id="EliminarPublicacion" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<!--Aca el contenido externo-->
    </div>
  </div>
</div>