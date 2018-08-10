<?php
	$id_user_i = $_SESSION['id_usuario'];
	//consultas extra para el perfil
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_i = "select * 
	from users_info, users 
	where users_info.id_usuario = '$id_user_i'
	and users_info.id_usuario = users.id";
	$R_user_info_i = mysql_query($query_R_user_info_i, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_i = mysql_fetch_assoc($R_user_info_i);
	$totalRows_R_user_info_i = mysql_num_rows($R_user_info_i);
	
	//consulto las experiencia_x_usuario
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_experiencia = "select * from experiencia_x_usuario where id_usuario = '$id_user_i' order by anio desc";
	$R_user_experiencia = mysql_query($query_R_user_experiencia, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_experiencia = mysql_fetch_assoc($R_user_experiencia);
	$totalRows_R_user_experiencia = mysql_num_rows($R_user_experiencia);
	
	//consulto las formaciones academicas x usuario
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_fa = "select * from fa_x_usuario where id_usuario = '$id_user_i' order by anio desc";
	$R_user_fa = mysql_query($query_R_user_fa, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_fa = mysql_fetch_assoc($R_user_fa);
	$totalRows_R_user_fa = mysql_num_rows($R_user_fa);
	
	//consulto los consultorios x usuario
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_cons = "select * from consultorio_x_usuario where id_usuario = '$id_user_i'";
	$R_user_cons = mysql_query($query_R_user_cons, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_cons = mysql_fetch_assoc($R_user_cons);
	$totalRows_R_user_cons = mysql_num_rows($R_user_cons);
	
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
	
	//consultas tematicas
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_tem = "select * from opciones_x_usuario where id_usuario = '$id_user_i' and grupo_opciones = '7'";
	$R_user_info_tem = mysql_query($query_R_user_info_tem, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_tem = mysql_fetch_assoc($R_user_info_tem);
	$totalRows_R_user_info_tem = mysql_num_rows($R_user_info_tem);
	if($totalRows_R_user_info_tem>0){
		$array_tematicas = array();
		do {
			$array_tematicas[] = $row_R_user_info_tem['id_opcion'];
		} while ($row_R_user_info_tem = mysql_fetch_assoc($R_user_info_tem));
	}
	
	//consultas orientaciones clinicas
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_ocl = "select * from opciones_x_usuario where id_usuario = '$id_user_i' and grupo_opciones = '8'";
	$R_user_info_ocl = mysql_query($query_R_user_info_ocl, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_ocl = mysql_fetch_assoc($R_user_info_ocl);
	$totalRows_R_user_info_ocl = mysql_num_rows($R_user_info_ocl);
	if($totalRows_R_user_info_ocl>0){
		$array_orientaciones_clinicas = array();
		do {
			$array_orientaciones_clinicas[] = $row_R_user_info_ocl['id_opcion'];
		} while ($row_R_user_info_ocl = mysql_fetch_assoc($R_user_info_ocl));
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
	
	//consultas Modalidad Trabajo
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_info_mt = "select * from opciones_x_usuario where id_usuario = '$id_user_i' and grupo_opciones = '6'";
	$R_user_info_mt = mysql_query($query_R_user_info_mt, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_info_mt = mysql_fetch_assoc($R_user_info_mt);
	$totalRows_R_user_info_mt = mysql_num_rows($R_user_info_mt);
	if($totalRows_R_user_info_mt>0){
		$array_modalidad_trabajo = array();
		do {
			$array_modalidad_trabajo[] = $row_R_user_info_mt['id_opcion'];
		} while ($row_R_user_info_mt = mysql_fetch_assoc($R_user_info_mt));
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
	and publicaciones.active = '1' 
	and publicaciones.menu_parent = tipo_publicacion.id 
	order by publicaciones.hoy_ahora desc";
	$R_user_publicaciones = mysql_query($query_R_user_publicaciones, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_publicaciones = mysql_fetch_assoc($R_user_publicaciones);
	$totalRows_R_user_publicaciones = mysql_num_rows($R_user_publicaciones);
	
	//consulta para los profesionales favoritos
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_fprof = "select users.* 
	from users, profesionales_favoritos 
	where profesionales_favoritos.id_usuario = '$id_user_i' 
	and profesionales_favoritos.id_profesional = users.id 
	order by users.apellido asc, users.nombre asc";
	$R_fprof = mysql_query($query_R_fprof, $ddbb_naevp) or die(header($error_mysql));
	$row_R_fprof = mysql_fetch_assoc($R_fprof);
	$totalRows_R_fprof = mysql_num_rows($R_fprof);
	
	//consulta para obtener las conversaciones donde participo
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_conv = "select publicaciones.*, tipo_publicacion.path 
	from publicaciones, grupos_discusion, tipo_publicacion
	where grupos_discusion.id_usuario = '$id_user_i' 
	and grupos_discusion.id_publicacion = publicaciones.id 
	and tipo_publicacion.id = publicaciones.menu_parent 
	order by publicaciones.hoy_ahora desc";
	$R_conv = mysql_query($query_R_conv, $ddbb_naevp) or die(header($error_mysql));
	$row_R_conv = mysql_fetch_assoc($R_conv);
	$totalRows_R_conv = mysql_num_rows($R_conv);
	
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
			$link_compra = $row_R_user_publicaciones_e['link_compra'];
			$visibilidad = $row_R_user_publicaciones_e['visibilidad'];
		} while ($row_R_user_publicaciones_e = mysql_fetch_assoc($R_user_publicaciones_e));
	}
?>
<div class="mi-perfil">
	<div class="container">
		<?php if($estado_proceso){?>
		<div class="row" style="margin-top:20px;">
			<div class="alert <?php echo $estado_proceso[1]; ?>">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <?php echo $estado_proceso[0]; ?>
			</div>
		</div>
		<?php } ?>
		<h2>Mi Perfil</h2>
		<div class="contenido">
			<div class="bloque_tabs">
				<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
					<li <?php if($DoGuardarPerfil||!$DoPublish&&!$edit&&!$DoCerrarCuenta){echo 'class="active"'; } ?>><a href="#perfil" data-toggle="tab"><span>Mi Perfil</span></a></li>
					<li ><a href="#material" data-toggle="tab"> <span>Publicaciones</span></a></li>
					<li <?php if($DoPublish){echo 'class="active"'; } ?>><a href="#nueva_publicacion" data-toggle="tab"><span>Nueva Publicación</span></a></li>
					<li ><a href="#profesionales" data-toggle="tab"><span>Mis profesionales</span></a></li>
					<li ><a href="#grupos" data-toggle="tab"><span>Mis grupos</span></a></li>
					<?php if($totalRows_R_user_publicaciones_e>0){?>
					<li class="active"><a href="#edit" data-toggle="tab"><?php echo substr($edit_title, 0, 15); ?>...</a></li>
					<?php } ?>
					<li <?php if($DoCerrarCuenta){ echo 'class="active"'; } ?>><a href="#baja" data-toggle="tab"><span>Cerrar Cuenta</span></a></li>
					<li <?php if($DoGetPro){ echo 'class="active"'; } ?>><a href="#pro" data-toggle="tab"><span>Cuenta PRO</span></a></li>
				</ul>
				<div id="my-tab-content" class="tab-content">
					<div class="tab-pane" id="material">
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
										<a href="<?php echo $ruta_raiz.'mi-perfil/?edit='.$row_R_user_publicaciones['id']; ?>" title="Editar">Editar<i class="fa fa-pencil" aria-hidden="true"></i></a>
										<a href="<?php echo $ruta_raiz.'includes/procesos/DoDelelePublicacion.php?id='.$row_R_user_publicaciones['id'].'&id_user_i='.$id_user_i; ?>" data-toggle="modal" data-target="#EliminarPublicacion" title="Eliminar">Eliminar<i class="fa fa-trash" aria-hidden="true"></i></a>
										<a href="<?php echo $ruta_raiz.$row_R_user_publicaciones['path'].'/?id='.$row_R_user_publicaciones['id']; ?>" title="Ver nota completa">Ver<i class="fa fa-eye" aria-hidden="true"></i></a>
									</div>
								</li>
								<?php } while ($row_R_user_publicaciones = mysql_fetch_assoc($R_user_publicaciones)); ?>
							</ul>
						<?php } ?>
					</div>
					<div class="tab-pane<?php if($DoPublish){echo ' active'; } ?>" id="nueva_publicacion">
						<h1>Ingresa el contenido de la nueva publicación</h1>
						<form name="login_form" id="perfil_form" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>">
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
													//['style', ['bold', 'italic', 'underline', 'clear']],
													//['font', ['strikethrough', 'superscript', 'subscript']],
													//['fontsize', ['fontsize']],
													//['color', ['color']],
													['para', ['ul', 'ol', 'paragraph']],
													//['height', ['height']],
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
													},
													onPaste: function (e) {
														var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
														e.preventDefault();
														document.execCommand('insertText', false, bufferText);
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
										<option value="3">Seleccionar quienes podrán ver esta publicación (Pacientes es la opción predeterminada)</option>
										<?php foreach($tipo_usuarios_array as $tipo_usuarios){ ?>
										<option value="<?php echo $tipo_usuarios['id']; ?>" <?php if($_SESSION['post_target'] && $_SESSION['post_target']==$tipo_usuarios['id']){echo ' selected'; } ?>><?php echo $tipo_usuarios['tipo_usuario']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<select id="post_type" name="post_type" class="form-control" required>
										<option>Seleccionar tipo de publicación</option>
										<?php 
										foreach($tipo_publicacion_array as $tipo_publicacion){
											$parent_tipo_p = $tipo_publicacion['id'];
											mysql_select_db($database_name, $ddbb_naevp);
											mysql_query("SET NAMES 'utf8'");
											$query_R_tipo_pp = "select * from tipo_publicacion where parent = $parent_tipo_p order by tipo_publicacion asc";
											$R_tipo_pp = mysql_query($query_R_tipo_pp, $ddbb_naevp) or die(mysql_error());
											$row_R_tipo_pp = mysql_fetch_assoc($R_tipo_pp);
											$totalRows_R_tipo_pp = mysql_num_rows($R_tipo_pp);
											if($totalRows_R_tipo_pp>0){
												do { ?>
												<option value="<?php echo $row_R_tipo_pp['id']; ?>" <?php if($_SESSION['post_type'] && $_SESSION['post_type']==$row_R_tipo_pp['id']){echo ' selected'; } ?>><?php echo $row_R_tipo_pp['tipo_publicacion']; ?></option>
												<?php } while ($row_R_tipo_pp = mysql_fetch_assoc($R_tipo_pp));
											} else { ?>
												<option value="<?php echo $tipo_publicacion['id']; ?>" <?php if($_SESSION['post_type'] && $_SESSION['post_type']==$tipo_publicacion['id']){echo ' selected'; } ?>><?php echo $tipo_publicacion['tipo_publicacion']; ?></option>
											<?php }
										} 
										?>
									</select>
									<script type="text/javascript">
										$('#post_type').on('change', function() {
											//alert( this.value );
											if( this.value == '6'){
												$('#post_visibility').css('display', 'inline-block');
											} else {
												if( this.value == '14'){
													$('#prod_serv').css('display', 'inline-block');
												} else {
													$('#post_visibility').css('display', 'none');
													$('#prod_serv').css('display', 'none');
												}
											}
										})
									</script>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="post_tags" placeholder="Ingresa las palabras claves de la publicación"></textarea>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<label for="email">Archivos de la publicación</label>
									<input name="archivos[]" id="input-3" type="file" class="file" multiple="true" data-show-upload="false" data-show-caption="true">
									<div id="errorBlock43" class="help-block"></div>
									<script>
									$("#input-3").fileinput({
										maxFileSize: 2000,
										elErrorContainer: "#errorBlock43",
										browseLabel: "Buscar archivos..."
									});
									</script>
								</div>
							</div>
							<div class="col-xs-12 col-md-12" id="prod_serv" style="<?php if($_SESSION['post_type'] && $_SESSION['post_type']==6){ echo 'display:inline-block;'; } else { echo 'display:none;'; } ?>">
								<div class="form-group">
									<input name="link_compra" placeholder="Link de venta" type="text" class="form-control" <?php if($_SESSION['link_compra']){echo 'value="'.$_SESSION['link_compra'].'"';}?>>
								</div>
							</div>
							<div class="col-xs-12 col-md-12" id="post_visibility" style="<?php if($_SESSION['post_type'] && $_SESSION['post_type']==6){ echo 'display:inline-block;'; } else { echo 'display:none;'; } ?>">
								<div class="form-group">
									<select name="post_visibility" class="form-control" required>
										<option value="0">Visibilidad de la publicación</option>
										<option value="0" <?php if($_SESSION['post_visibility'] && $_SESSION['post_visibility']=='0'){echo ' selected'; } ?>>Publica (profesionales y pacientes)</option>
										<option value="2" <?php if($_SESSION['post_visibility'] && $_SESSION['post_visibility']=='2'){echo ' selected'; } ?>>Publica (solo profesionales, no la verán los pacientes)</option>
										<option value="1" <?php if($_SESSION['post_visibility'] && $_SESSION['post_visibility']=='1'){echo ' selected'; } ?>>Privada (solo la verán quienes tengan el link de la pagina)</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<button type="submit" class="btn btn-default btn_publicar">Publicar</button>
								<input type="hidden" name="action" value="publish" />
							</div>
						</form>
					</div>
					<a class="ver_version_online" target="_blank" href="<?php echo $ruta_raiz; ?>profesionales/?id=<?php echo $_SESSION['id_usuario']; ?>" title="Ver como lo ven los visitantes del sitio">
						<span>Ver perfil como lo ven los visitantes del sitio</span>
						<i class="fa fa-eye" aria-hidden="true"></i>
					</a>
					<div class="tab-pane<?php if(!$DoPublish&&!$edit&&!$DoCerrarCuenta){echo ' active'; } ?>" id="perfil">
						<h1>Mantén tu perfil actualizado</h1>
						<form name="login_form" id="perfil_form" enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="email">Nombre*</label>
									<input name="nombre" required type="text" class="form-control" <?php if($_SESSION['nombre']){echo 'value="'.$_SESSION['nombre'].'"';} else { echo 'value="'.$_SESSION['nombre_usr'].'"'; }?>>
								</div>
								<?php if($_SESSION['tipo_usuario']==1){?>
								<div class="form-group">
									<label for="email">Apellido*</label>
									<input name="apellido" required type="text" class="form-control" <?php if($_SESSION['apellido']){echo 'value="'.$_SESSION['apellido'].'"';} else { echo 'value="'.$_SESSION['apellido_usr'].'"'; }?>>
								</div>
								<?php } ?>
								<div class="form-group">
									<label for="email">Email*:</label>
									<input name="email" required type="email" class="form-control" id="email" <?php if($_SESSION['email']){echo 'value="'.$_SESSION['email'].'"';} else { echo 'value="'.$_SESSION['email_usr'].'"'; }?>>
								</div>
								<?php if($_SESSION['tipo_usuario']==1){?>
								<div class="form-group">
									<label for="email">Fecha de Nacimiento*:</label>
									<input type="text" name="fecha_nacimiento" class="form-control" required <?php if($_SESSION['fecha_nacimiento']){echo 'value="'.$_SESSION['fecha_nacimiento'].'"';} else { if($row_R_user_info_i['fecha_nacimiento']){echo 'value="'.date("m/d/Y", strtotime($row_R_user_info_i['fecha_nacimiento'])).'"';} }?> />
								</div>
								<?php } ?>
								
								<div class="form-group">
									<label for="email">Consultorio</label>
									<?php 
										if($_SESSION['formacion_academica']){
											echo $_SESSION['formacion_academica'];
										} else { if($row_R_user_info_i['formacion_academica']){echo $row_R_user_info_i['formacion_academica'];} }
									?>
									<div id="contenedor_consultorio">
										<?php 
										$n_consultorio = 0;
										do { 
										$n_consultorio = $n_consultorio + 1;
										?>
										<div class="bloque_consultorio">
											<input placeholder="Dirección" name="consultorio_direccion[]" type="text" class="form-control" <?php if($row_R_user_cons['direccion']){echo 'value="'.$row_R_user_cons['direccion'].'"';} ?>>
											<input placeholder="Teléfono" name="consultorio_telefono[]" type="text" class="form-control" <?php if($row_R_user_cons['telefono']){echo 'value="'.$row_R_user_cons['telefono'].'"';} ?>>
											<input placeholder="Código Postal" name="consultorio_cp[]" type="text" class="form-control" <?php if($row_R_user_cons['cp']){echo 'value="'.$row_R_user_cons['cp'].'"';} ?>>
											<select id="consultorio_pais_<?php echo $n_consultorio; ?>" name="consultorio_pais[]" class="form-control select_consultorio_pais" required>
												<option selected>País</option>
												<?php foreach($array_paises as $pais){ ?>
												<option value="<?php echo $pais['id']; ?>" <?php if($row_R_user_cons['id_pais']==$pais['id']){ echo 'selected'; } ?>><?php echo $pais['name']; ?></option>
												<?php }  ?>
											</select>
											<select disabled id="consultorio_estado_<?php echo $n_consultorio; ?>" name="consultorio_estado[]" class="form-control select_consultorio_estado" required>
												<option selected>Provincia / Estado</option>
											</select>
											<select disabled id="consultorio_partido_<?php echo $n_consultorio; ?>" name="consultorio_partido[]" class="form-control select_consultorio_partido" required>
												<option selected>Partido / Municipio / Colonia</option>
											</select>
											<select disabled id="consultorio_ciudad_<?php echo $n_consultorio; ?>" name="consultorio_ciudad[]" class="form-control select_consultorio_ciudad" required>
												<option selected>Ciudad</option>
											</select>
											<input type="hidden" name="pais_txt[]" id="pais_txt_<?php echo $n_consultorio; ?>" value="<?php if($row_R_user_cons['pais']){ echo $row_R_user_cons['pais']; } ?>" />
											<input type="hidden" name="estado_txt[]" id="estado_txt_<?php echo $n_consultorio; ?>" value="<?php if($row_R_user_cons['estado']){ echo $row_R_user_cons['estado']; } ?>" />
											<input type="hidden" name="partido_txt[]" id="partido_txt_<?php echo $n_consultorio; ?>" value="<?php if($row_R_user_cons['partido']){ echo $row_R_user_cons['partido']; } ?>" />
											<input type="hidden" name="ciudad_txt[]" id="ciudad_txt_<?php echo $n_consultorio; ?>" value="<?php if($row_R_user_cons['ciudad']){ echo $row_R_user_cons['ciudad']; } ?>" />
											<input type="hidden" name="numero_bloque" id="numero_bloque" value="<?php echo $n_consultorio; ?>" />
										</div>
										<script>
										$( document ).ready(function(e) {
											//levanto los datos de los estados
											$.ajax({
												url: 'http://api.geonames.org/childrenJSON?',
												dataType: 'json',
												type: 'GET',
												data: {"geonameId": <?php echo $row_R_user_cons['id_pais']; ?>, "username": "desaludhablamos"},
												success: function(response) {
													//console.log(response.geonames);
													if(response.totalResultsCount>0){
														var data_response = response.geonames;
														var options = '<option value="">Seleccione</option>';
														for (var i = 0; i < data_response.length; i++) {
															options += '<option ';
															if(data_response[i].geonameId == <?php echo $row_R_user_cons['id_estado']; ?>){
															options += 'selected ';
															}
															options += 'value="' + data_response[i].geonameId + '">' + data_response[i].name + '</option>';
														}
														$("#consultorio_estado_<?php echo $n_consultorio; ?>").html(options);
														$("#consultorio_estado_<?php echo $n_consultorio; ?>").prop('disabled', false);
													} else {
														$("#consultorio_estado_<?php echo $n_consultorio; ?>").html('<option value="0">Seleccione otro país</option>');
														$("#consultorio_estado_<?php echo $n_consultorio; ?>").prop('disabled', true);
													}
												},
												error: function(x, e) {
													alert("Error en la carga de datos");
												}
											});
											//levanto los datos de los partidos
											$.ajax({
												url: 'http://api.geonames.org/childrenJSON?',
												dataType: 'json',
												type: 'GET',
												data: {"geonameId": <?php echo $row_R_user_cons['id_estado']; ?>, "username": "desaludhablamos"},
												success: function(response) {
													//console.log(response.geonames);
													if(response.totalResultsCount>0){
														var data_response = response.geonames;
														var options = '<option value="">Seleccione</option>';
														for (var i = 0; i < data_response.length; i++) {
															options += '<option ';
															if(data_response[i].geonameId == <?php echo $row_R_user_cons['id_partido']; ?>){
															options += 'selected ';
															}
															options += 'value="' + data_response[i].geonameId + '">' + data_response[i].name + '</option>';
														}
														$("#consultorio_partido_<?php echo $n_consultorio; ?>").html(options);
														$("#consultorio_partido_<?php echo $n_consultorio; ?>").prop('disabled', false);
													} else {
														$("#consultorio_partido_<?php echo $n_consultorio; ?>").html('<option value="0">Seleccione otro estado</option>');
														$("#consultorio_partido_<?php echo $n_consultorio; ?>").prop('disabled', true);
													}
												},
												error: function(x, e) {
													alert("Error en la carga de datos");
												}
											});
											//levanto los datos de las ciudadess
											$.ajax({
												url: 'http://api.geonames.org/childrenJSON?',
												dataType: 'json',
												type: 'GET',
												data: {"geonameId": <?php echo $row_R_user_cons['id_partido']; ?>, "username": "desaludhablamos"},
												success: function(response) {
													//console.log(response.geonames);
													if(response.totalResultsCount>0){
														var data_response = response.geonames;
														var options = '<option value="">Seleccione</option>';
														for (var i = 0; i < data_response.length; i++) {
															options += '<option ';
															if(data_response[i].geonameId == <?php echo $row_R_user_cons['id_ciudad']; ?>){
															options += 'selected ';
															}
															options += 'value="' + data_response[i].geonameId + '">' + data_response[i].name + '</option>';
														}
														$("#consultorio_ciudad_<?php echo $n_consultorio; ?>").html(options);
														$("#consultorio_ciudad_<?php echo $n_consultorio; ?>").prop('disabled', false);
													} else {
														$("#consultorio_ciudad_<?php echo $n_consultorio; ?>").html('<option value="0">Seleccione otro partido</option>');
														$("#consultorio_ciudad_<?php echo $n_consultorio; ?>").prop('disabled', true);
													}
												},
												error: function(x, e) {
													alert("Error en la carga de datos");
												}
											});
										});
										</script>
										<?php } while ($row_R_user_cons = mysql_fetch_assoc($R_user_cons)); ?>
									</div>
									<a id="add_bloque_consultorio"><i class="fa fa-plus-circle" aria-hidden="true"></i><span>Agregar consultorio</span></a>
									<script>
										$('#add_bloque_consultorio').click(function() {
											var nuevo_bloque =  parseFloat($('input#numero_bloque').val())+1;
											$('input#numero_bloque').val(nuevo_bloque);											
											$("#contenedor_consultorio").append('<div class="bloque_consultorio"><input placeholder="Dirección" name="consultorio_direccion[]" type="text" class="form-control" ><input placeholder="Teléfono" name="consultorio_telefono[]" type="text" class="form-control" ><input placeholder="Código Postal" name="consultorio_cp[]" type="text" class="form-control" ><select id="consultorio_pais_'+nuevo_bloque+'" name="consultorio_pais[]" class="form-control select_consultorio_pais" required><option selected>País</option><?php foreach($array_paises as $pais){ ?><option value="<?php echo $pais['id']; ?>"><?php echo $pais['name']; ?></option><?php }  ?></select><select disabled id="consultorio_estado_'+nuevo_bloque+'" name="consultorio_estado[]" class="form-control select_consultorio_estado" required><option selected>Provincia / Estado</option></select><select disabled id="consultorio_partido_'+nuevo_bloque+'" name="consultorio_partido[]" class="form-control select_consultorio_partido" required><option selected>Partido / Municipio / Colonia</option></select><select disabled id="consultorio_ciudad_'+nuevo_bloque+'" name="consultorio_ciudad[]" class="form-control select_consultorio_ciudad" required><option selected>Ciudad</option></select><input type="hidden" name="numero_bloque" id="numero_bloque" value="'+nuevo_bloque+'" /><input type="hidden" name="pais_txt[]" id="pais_txt_'+nuevo_bloque+'" value="" /><input type="hidden" name="estado_txt[]" id="estado_txt_'+nuevo_bloque+'" value="" /><input type="hidden" name="partido_txt[]" id="partido_txt_'+nuevo_bloque+'" value="" /><input type="hidden" name="ciudad_txt[]" id="ciudad_txt_'+nuevo_bloque+'" value="" /></div>');
										});

										$(document).on('change', '.select_consultorio_pais', function (e) {
											//alert( this.value );
											//alert($(this).attr('id'));
											var consultorio_pais = this.id.match(/\d+/);
											var consultorio_pais_value = (this.value);
											$('input#pais_txt_'+consultorio_pais).val($("#consultorio_pais_"+consultorio_pais+" option:selected").text());
											$.ajax({
												url: 'http://api.geonames.org/childrenJSON?',
												dataType: 'json',
												type: 'GET',
												data: {"geonameId": consultorio_pais_value, "username": "desaludhablamos"},
												success: function(response) {
													//console.log(response.geonames);
													if(response.totalResultsCount>0){
														var data_response = response.geonames;
														var options = '<option value="">Seleccione</option>';
														for (var i = 0; i < data_response.length; i++) {
															options += '<option value="' + data_response[i].geonameId + '">' + data_response[i].name + '</option>';
														}
														$("#consultorio_estado_"+consultorio_pais).html(options);
														$("#consultorio_estado_"+consultorio_pais).prop('disabled', false);
														$("#consultorio_partido_"+consultorio_pais).prop('disabled', true);
														$("#consultorio_ciudad_"+consultorio_pais).prop('disabled', true);
														$("#consultorio_partido_"+consultorio_pais).html('<option value="">Seleccione</option>');
														$("#consultorio_ciudad_"+consultorio_pais).html('<option value="">Seleccione</option>');
													} else {
														$("#consultorio_estado_"+consultorio_pais).html('<option value="0">Seleccione otro país</option>');
														$("#consultorio_estado_"+consultorio_pais).prop('disabled', true);
													}
												},
												error: function(x, e) {
													alert("Error en la carga de datos");
												}
											});
										})
										$(document).on('change', '.select_consultorio_estado', function (e) {
											//alert( this.value );
											//alert($(this).attr('id'));
											var consultorio_estado = this.id.match(/\d+/);
											var consultorio_estado_value = (this.value);
											$('input#estado_txt_'+consultorio_estado).val($("#consultorio_estado_"+consultorio_estado+" option:selected").text());
											$.ajax({
												url: 'http://api.geonames.org/childrenJSON?',
												dataType: 'json',
												type: 'GET',
												data: {"geonameId": consultorio_estado_value, "username": "desaludhablamos"},
												success: function(response) {
													//console.log(response.geonames);
													if(response.totalResultsCount>0){
														var data_response = response.geonames;
														var options = '<option value="">Seleccione</option>';
														for (var i = 0; i < data_response.length; i++) {
															options += '<option value="' + data_response[i].geonameId + '">' + data_response[i].name + '</option>';
														}
														$("#consultorio_partido_"+consultorio_estado).html(options);
														$("#consultorio_partido_"+consultorio_estado).prop('disabled', false);
														$("#consultorio_ciudad_"+consultorio_estado).prop('disabled', true);
														$("#consultorio_ciudad_"+consultorio_estado).html('<option value="">Seleccione</option>');
													} else {
														$("#consultorio_partido_"+consultorio_estado).html('<option value="0">Seleccione otro estado / provincia</option>');
														$("#consultorio_partido_"+consultorio_estado).prop('disabled', true);
													}
												},
												error: function(x, e) {
													alert("Error en la carga de datos");
												}
											});
										})
										$(document).on('change', '.select_consultorio_partido', function (e) {
											//alert( this.value );
											//alert($(this).attr('id'));
											var consultorio_partido = this.id.match(/\d+/);
											var consultorio_partido_value = (this.value);
											$('input#partido_txt_'+consultorio_partido).val($("#consultorio_partido_"+consultorio_partido+" option:selected").text());
											$.ajax({
												url: 'http://api.geonames.org/childrenJSON?',
												dataType: 'json',
												type: 'GET',
												data: {"geonameId": consultorio_partido_value, "username": "desaludhablamos"},
												success: function(response) {
													//console.log(response.geonames);
													if(response.totalResultsCount>0){
														var data_response = response.geonames;
														var options = '<option value="">Seleccione</option>';
														for (var i = 0; i < data_response.length; i++) {
															options += '<option value="' + data_response[i].geonameId + '">' + data_response[i].name + '</option>';
														}
														$("#consultorio_ciudad_"+consultorio_partido).html(options);
														$("#consultorio_ciudad_"+consultorio_partido).prop('disabled', false);
													} else {
														$("#consultorio_ciudad_"+consultorio_partido).html('<option value="0">Seleccione otro partido / municipio / colonia</option>');
														$("#consultorio_ciudad_"+consultorio_partido).prop('disabled', true);
													}
												},
												error: function(x, e) {
													alert("Error en la carga de datos");
												}
											});
										})
										$(document).on('change', '.select_consultorio_ciudad', function (e) {
											//alert( this.value );
											//alert($(this).attr('id'));
											var consultorio_ciudad = this.id.match(/\d+/);
											var consultorio_ciudad_value = (this.value);
											$('input#ciudad_txt_'+consultorio_ciudad).val($("#consultorio_ciudad_"+consultorio_ciudad+" option:selected").text());
										})
									</script>
								</div>
								
								<?php if($_SESSION['tipo_usuario']==1){?>
								<div class="form-group">
									<label for="email">Número de matrícula nacional/provincial*:</label>
									<input name="matricula" type="text" class="form-control" id="matricula" <?php if($_SESSION['matricula']){echo 'value="'.$_SESSION['matricula'].'"';} else { if($row_R_user_info_i['matricula']){echo 'value="'.$row_R_user_info_i['matricula'].'"';} }?>>
									<small>Sin matricula la pagina no verifica el perfil del profesional.  Además es obligatoria para las siguientes especialidades: Medicina todas las ramas (psiquiatra, clinico, neurologo, pediatra, homeopata), Psicologia, Nutrición, Kinesiologos, Fonaudiologos, Trabajador Social, Terapista Ocupacional</small>
								</div>
								<?php } ?>
								<?php if($_SESSION['tipo_usuario']==1){?>
								<div class="form-group">
									<label for="email">Honorarios:</label><br/>
									<small>Si dejas en blanco este campo aparecerá la leyenda "A convenir"</small>
									<input name="honorarios" type="text" class="form-control" id="honorarios" <?php if($_SESSION['honorarios']){echo 'value="'.$_SESSION['honorarios'].'"';} else { if($row_R_user_info_i['honorarios']){echo 'value="'.$row_R_user_info_i['honorarios'].'"';} }?>>
								</div>
								<?php } ?>
								<?php if($_SESSION['tipo_usuario']==1){?>
								<div class="form-group">
									<label for="email">Realiza la primera entrevista sin cargo*:</label>
									<select name="pesc" class="form-control" required>
										<option value="2">Seleccionar</option>
										<option value="1" <?php if($_SESSION['pesc']&&$_SESSION['pesc']==1){echo 'selected'; } else { if($row_R_user_info_i['pesc']=='1'){echo 'selected';} }?>>Si</option>
										<option value="2" <?php if($_SESSION['pesc']&&$_SESSION['pesc']==2){echo 'selected'; } else { if($row_R_user_info_i['pesc']=='2'){echo 'selected';} }?>>No</option>
									</select>
								</div>
								<?php } ?>
								<!--<div class="form-group">
									<label for="email">Formación académica: Estudios secundarios y universitarios, cursos, etc.</label>
									<textarea name="formacion_academica" class="form-control"><?php 
										if($_SESSION['formacion_academica']){
											echo $_SESSION['formacion_academica'];
										} else { if($row_R_user_info_i['formacion_academica']){echo $row_R_user_info_i['formacion_academica'];} }
										?></textarea>
								</div>-->
								<?php if($_SESSION['tipo_usuario']==1){?>
								<div class="form-group">
									<label for="email">Formación académica: Estudios secundarios y universitarios, cursos, etc.</label>
									<!--<textarea name="experiencia_laboral" class="form-control"><?php 
										if($_SESSION['formacion_academica']){
											echo $_SESSION['formacion_academica'];
										} else { if($row_R_user_info_i['formacion_academica']){echo $row_R_user_info_i['formacion_academica'];} }
										?></textarea>-->
									<div id="contenedor_formacion_academica">
										<?php do { ?>
										<div class="bloque_formacion_academica">
											<input placeholder="Año" name="fa_anio[]" type="text" class="form-control" <?php if($row_R_user_fa['anio']){echo 'value="'.$row_R_user_fa['anio'].'"';} ?>>
											<input placeholder="Institución" name="fa_institucion[]" type="text" class="form-control" <?php if($row_R_user_fa['institucion']){echo 'value="'.$row_R_user_fa['institucion'].'"';} ?>>
											<input placeholder="Título" name="fa_titulo[]" type="text" class="form-control" <?php if($row_R_user_fa['titulo']){echo 'value="'.$row_R_user_fa['titulo'].'"';} ?>>
										</div>
										<?php } while ($row_R_user_fa = mysql_fetch_assoc($R_user_fa)); ?>
									</div>
									<a id="add_bloque_formacion_academica"><i class="fa fa-plus-circle" aria-hidden="true"></i><span>Agregar bloque de formación académica</span></a>
									<script>
										$('#add_bloque_formacion_academica').click(function() {
											$("#contenedor_formacion_academica").append('<div class="bloque_formacion_academica"><input placeholder="Año" name="fa_anio[]" type="text" class="form-control"><input placeholder="Institución" name="fa_institucion[]" type="text" class="form-control"><input placeholder="Título" name="fa_titulo[]" type="text" class="form-control"></div>');
										});
									</script>
								</div>
								<?php } ?>
								<?php if($_SESSION['tipo_usuario']==1){?>
								<div class="form-group">
									<label for="email">Experiencia laboral</label>
									<!--<textarea name="experiencia_laboral" class="form-control"><?php 
										if($_SESSION['experiencia_laboral']){
											echo $_SESSION['experiencia_laboral'];
										} else { if($row_R_user_info_i['experiencia_laboral']){echo $row_R_user_info_i['experiencia_laboral'];} }
										?></textarea>-->
									<div id="contenedor_experiencia_laboral">
										<?php do { ?>
										<div class="bloque_experiencia_laboral">
											<input placeholder="Año" name="experiencia_anio[]" type="text" class="form-control" <?php if($row_R_user_experiencia['anio']){echo 'value="'.$row_R_user_experiencia['anio'].'"';} ?>>
											<input placeholder="Institución" name="experiencia_institucion[]" type="text" class="form-control" <?php if($row_R_user_experiencia['institucion']){echo 'value="'.$row_R_user_experiencia['institucion'].'"';} ?>>
											<input placeholder="Título" name="experiencia_titulo[]" type="text" class="form-control" <?php if($row_R_user_experiencia['titulo']){echo 'value="'.$row_R_user_experiencia['titulo'].'"';} ?>>
										</div>
										<?php } while ($row_R_user_experiencia = mysql_fetch_assoc($R_user_experiencia)); ?>
									</div>
									<a id="add_bloque_experiencia_laboral"><i class="fa fa-plus-circle" aria-hidden="true"></i><span>Agregar bloque de experiencia laboral</span></a>
									<script>
										$('#add_bloque_experiencia_laboral').click(function() {
											$("#contenedor_experiencia_laboral").append('<div class="bloque_experiencia_laboral"><input placeholder="Año" name="experiencia_anio[]" type="text" class="form-control"><input placeholder="Institución" name="experiencia_institucion[]" type="text" class="form-control"><input placeholder="Título" name="experiencia_titulo[]" type="text" class="form-control"></div>');
										});
									</script>
								</div>
								<?php } ?>
								<?php if($_SESSION['tipo_usuario']==1){?>
								<div class="form-group">
									<label for="email">¿Es parte de alguna asociación o institución?</label>
									<textarea name="asociacion_institucion" class="form-control"><?php 
										if($_SESSION['asociacion_institucion']){
											echo $_SESSION['asociacion_institucion'];
										} else { if($row_R_user_info_i['asociacion_institucion']){echo $row_R_user_info_i['asociacion_institucion'];} }
										?></textarea>
								</div>
								<?php } ?>
								<div class="form-group">
									<label for="email">Página web personal:</label>
									<input name="www" type="text" class="form-control" id="www" <?php if($_SESSION['www']){echo 'value="'.$_SESSION['www'].'"';} else { if($row_R_user_info_i['www']){echo 'value="'.$row_R_user_info_i['www'].'"';} }?>>
								</div>
								<div class="form-group">
									<label for="email">Presentación personal</label>
									<textarea name="presentacion_personal" class="form-control" placeholder="Esta es la primera información que verán los usuarios" ><?php 
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
								<div class="form-group">
									<label>Contraseña (solo en caso que quiera cambiar la actual)</label>
									<div>
										<div class="bloque_formacion_academica">
											<input placeholder="Escriba la nueva contraseña" name="password" type="password" class="form-control" >
											<input placeholder="Repita la nueva contraseña" name="repassword" type="password" class="form-control" >
										</div>
									</div>
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
											$query_R_sesp = "select * from especialidades where active = 1 and parent = '$id_especialidad_parent' order by orden asc, nombre asc";
											$R_sesp = mysql_query($query_R_sesp, $ddbb_naevp) or die(header($error_mysql));
											$row_R_sesp = mysql_fetch_assoc($R_sesp);
											$totalRows_R_sesp = mysql_num_rows($R_sesp);
											
											if($totalRows_R_sesp>0){
												//hay subespecialidades
												echo '<p class="subesp_title">'.$row_R_esp['nombre'].'</p>';
												echo '<ul class="subesp">';
												do {
													echo '<li>';
													echo '<input class="checkbox_especialidades" type="checkbox" name="especialidades[]" ';
													if($_SESSION['especialidades']){
														if (in_array($row_R_sesp['id'], $_SESSION['especialidades'])) { 
															echo 'checked="checked"'; 
														}
													} else {
														if (in_array($row_R_sesp['id'], $array_especialidades)) { 
															echo 'checked="checked"'; 
														}
													}													
													echo 'value="'.$row_R_sesp['id'].'" id="checkbox_especialidades_'.$row_R_sesp['id'].'">'.$row_R_sesp['nombre'];
													echo '</li>';
												} while ($row_R_sesp = mysql_fetch_assoc($R_sesp));
												echo '</ul>';
											} else {
												//no hay subespecialidades
												echo '<li>';
												echo '<input class="checkbox_especialidades" type="checkbox" name="especialidades[]" ';
												if($_SESSION['especialidades']){
													if (in_array($row_R_esp['id'], $_SESSION['especialidades'])) { 
														echo 'checked="checked"'; 
													}
												} else {
													if (in_array($row_R_esp['id'], $array_especialidades)) { 
														echo 'checked="checked"'; 
													}
												}
												echo 'value="'.$row_R_esp['id'].'" id="checkbox_especialidades_'.$row_R_esp['id'].'">'.$row_R_esp['nombre'];
												echo '</li>';
											}
										} while ($row_R_esp = mysql_fetch_assoc($R_esp)); ?>
										</ul>
								</div>
								<div class="form-group">
									<label for="especialidades">Temáticas*:</label>
										<ul class="especialidades">
										<?php 
											do {
												echo '<li>';
												echo '<input class="checkbox_especialidades" type="checkbox" name="tematicas[]" ';
												if($_SESSION['tematicas']){
													if (in_array($row_R_tem['id'], $_SESSION['tematicas'])) { 
														echo 'checked="checked"'; 
													}
												} else {
													if (in_array($row_R_tem['id'], $array_tematicas)) { 
														echo 'checked="checked"'; 
													}
												}
												echo 'value="'.$row_R_tem['id'].'">'.$row_R_tem['nombre'];
												echo '</li>';

										} while ($row_R_tem = mysql_fetch_assoc($R_tem)); ?>
										</ul>
								</div>
								<?php
								mysql_select_db($database_name, $ddbb_naevp);
								mysql_query("SET NAMES 'utf8'");
								$query_R_eoc = "SELECT * FROM especialidades where parent = 2 or parent = 3";
								$R_eoc = mysql_query($query_R_eoc, $ddbb_naevp) or die(header($error_mysql));
								$row_R_eoc = mysql_fetch_assoc($R_eoc);
								$totalRows_R_eoc = mysql_num_rows($R_eoc);
								if($totalRows_R_eoc>0){?>
									<script>
										$('.checkbox_especialidades').change(function() {
											var mostrar_bloque_oc = false;
											<?php do { ?>
												if ($('#checkbox_especialidades_<?php echo $row_R_eoc['id']; ?>').is(":checked")){
													var mostrar_bloque_oc = true;
												}
											<?php } while ($row_R_eoc = mysql_fetch_assoc($R_eoc)); ?>
											if(mostrar_bloque_oc == true){
												$('#bloque_orientacion_clinica').attr('style','display: inline;');
											}
										});
									</script>
								<?php } ?>
								<div class="form-group" id="bloque_orientacion_clinica" <?php if(!$array_orientaciones_clinicas){ ?>style="display:none;"<?php } ?>>
									<label for="especialidades">Orientación Clínica:</label>
										<ul class="especialidades">
										<?php 
											do {
												echo '<li>';
												echo '<input type="checkbox" name="orientaciones_clinicas[]" ';
												if($_SESSION['orientaciones_clinicas']){
													if (in_array($row_R_ocl['id'], $_SESSION['orientaciones_clinicas'])) { 
														echo 'checked="checked"'; 
													}
												} else {
													if (in_array($row_R_ocl['id'], $array_orientaciones_clinicas)) { 
														echo 'checked="checked"'; 
													}
												}
												echo 'value="'.$row_R_ocl['id'].'">'.$row_R_ocl['nombre'];
												echo '</li>';

										} while ($row_R_ocl = mysql_fetch_assoc($R_ocl)); ?>
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
									<label for="especialidades">Modalidad Trabajo*:</label>
										<ul class="especialidades">
										<?php do { ?>
										<li>
										<input type="checkbox" name="modalidad_trabajo[]" <?php if($_SESSION['modalidad_trabajo']){if (in_array($row_R_mt['id'], $_SESSION['modalidad_trabajo'])) { echo 'checked="checked"'; } } else { if (in_array($row_R_mt['id'], $array_modalidad_trabajo)) { echo 'checked="checked"'; } }?> value="<?php echo $row_R_mt['id']; ?>"><?php echo $row_R_mt['modalidad_trabajo']; ?>
										</li>
										<?php } while ($row_R_mt = mysql_fetch_assoc($R_mt)); ?>
										</ul>
								</div>
								<div class="form-group">
									<label for="especialidades">Disponible en Emergencias*:</label>
									<select name="disponible_emergencias" id="disponible_emergencias" class="form-control" required>
										<option value="2">Seleccionar</option>
										<option value="1" <?php if($_SESSION['disponible_emergencias']&&$_SESSION['disponible_emergencias']=='1'){ echo 'selected'; } else { if($row_R_user_info_i['disponible_emergencias']=='1'){echo 'selected';} }?>>Si</option>
										<option value="2" <?php if($_SESSION['disponible_emergencias']&&$_SESSION['disponible_emergencias']=='2'){ echo 'selected'; } else { if($row_R_user_info_i['disponible_emergencias']=='2'){echo 'selected';} }?>>No</option>
									</select>
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
										<option value="2">Seleccionar</option>
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
								<div class="form-group">
									<label for="especialidades">Reintegros Obra Social:</label>
									<select name="reintegros_os" id="reintegros_os" class="form-control" required>
										<option value="2">Seleccionar</option>
										<option value="1" <?php if($_SESSION['reintegros_os']&&$_SESSION['reintegros_os']=='1'){ echo 'selected'; } else { if($row_R_user_info_i['reintegros_os']=='1'){echo 'selected';} }?>>Si</option>
										<option value="2" <?php if($_SESSION['reintegros_os']&&$_SESSION['reintegros_os']=='2'){ echo 'selected'; } else { if($row_R_user_info_i['reintegros_os']=='2'){echo 'selected';} }?>>No</option>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<button type="submit" class="btn btn-default">Guardar</button>
								<input type="hidden" name="action" value="DoGuardarPerfil" />
							</div>
						</form>
					</div>
					
					<div class="tab-pane" id="profesionales">
						<?php if($totalRows_R_fprof==0){?>
							<h1>Aun no tienes profesionales como favoritos.</h1>
						<?php } else { ?>
							<h1>Estos son tus profesionales favoritos.</h1>
							<ul class="bloque_resultados_profesionales">
								<?php 
								do { 
								
								$id_prof_fav = $row_R_fprof['id'];
								mysql_select_db($database_name, $ddbb_naevp);
								mysql_query("SET NAMES 'utf8'");
								$query_R_user_perfil = "select * from users_info where id_usuario = '$id_prof_fav'";
								$R_user_perfil = mysql_query($query_R_user_perfil, $ddbb_naevp) or die(mysql_error());
								$row_R_user_perfil = mysql_fetch_assoc($R_user_perfil);
								$totalRows_R_user_perfil = mysql_num_rows($R_user_perfil);
								
								?>
								<li>
									<!--<div class="col-xs-12 col-md-1 col_comentarios">
										<h3>Calificaciones<br/><i class="fa fa-star" aria-hidden="true"></i></h3>
									</div>-->
									<div class="col-xs-4 col-md-2 col_imagen_perfil">
										<div class="img_perfil" style="background: url('<?php if($row_R_fprof['img']){ echo $row_R_fprof['img']; } else { echo $default_user_image; } ?>');"></div>
									</div>
									<div class="col-xs-8 col-md-9 col_contenido">
										<h2><?php echo $row_R_fprof['nombre'].' '.$row_R_fprof['apellido']; ?></h2>
										<?php if($row_R_fprof['is_verified']==1){?><span><i class="fa fa-check-square-o" aria-hidden="true"></i> Profesional Verificado</span><?php } ?>
										<?php 
										if($row_R_user_perfil['presentacion_personal']){
											echo '<div class="parrafo">'.$row_R_user_perfil['presentacion_personal'].'</div>';
										} else {
											echo '<div class="parrafo">Presentación no cargada por el usuario.</div>';
										}
										?>
									</div>
									<div class="col-xs-12 col-md-1 col_actions">
										<a href="<?php echo $ruta_raiz.'includes/procesos/DoContactarProfesional.php?id='.$row_R_fprof['id']; ?>" data-toggle="modal" data-target="#EnviarMensaje" title="Contactar">Contactar<i class="fa fa-envelope-o" aria-hidden="true"></i></a>
										<a href="<?php echo $ruta_raiz.'profesionales/?id='.$row_R_fprof['id']; ?>" title="Ver perfil completo">Ver perfil<i class="fa fa-eye" aria-hidden="true"></i></a>
									</div>
								</li>
								<?php } while ($row_R_fprof = mysql_fetch_assoc($R_fprof)); ?>
							</ul>
						<?php } ?>
					</div>
					<div class="tab-pane" id="grupos">
						<?php if($totalRows_R_conv==0){?>
							<h1>Aun no participaste en ningún grupo de discusión.</h1>
						<?php } else { ?>
							<h1>Estos son los grupos de discusión en los que estás participando.</h1>
							<ul class="bloque_mis_comentarios">
								<?php do { ?>
								<li>
									<div class="col-xs-12 col-md-11 col_contenido">
										<h2><?php echo $row_R_conv['page_title']; ?></h2>
										<div class="parrafo"><?php echo substr($row_R_conv['page_content'], 0, 500); ?>...</div>
										<span><?php echo date("d/m/Y h:i A", strtotime($row_R_conv['hoy_ahora'])); ?></span>
									</div>
									<div class="col-xs-12 col-md-1 col_actions">
										<a href="<?php echo $ruta_raiz.$row_R_conv['path'].'/?id='.$row_R_conv['id']; ?>" title="Ver nota completa">Ver<i class="fa fa-eye" aria-hidden="true"></i></a>
									</div>
								</li>
								<?php } while ($row_R_conv = mysql_fetch_assoc($R_conv)); ?>
							</ul>
						<?php } ?>
					</div>
					
					<?php if($totalRows_R_user_publicaciones_e>0){?>
					<div class="tab-pane active" id="edit">
						<h1>Edita la publicación</h1>
						<form name="login_form" id="perfil_form" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>">
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
													//['style', ['bold', 'italic', 'underline', 'clear']],
													//['font', ['strikethrough', 'superscript', 'subscript']],
													//['fontsize', ['fontsize']],
													//['color', ['color']],
													['para', ['ul', 'ol', 'paragraph']],
													//['height', ['height']],
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
										<option>Seleccionar quienes podrán ver esta publicación</option>
										<?php foreach($tipo_usuarios_array as $tipo_usuarios){ ?>
										<option value="<?php echo $tipo_usuarios['id']; ?>" <?php if($_SESSION['post_target'] && $_SESSION['post_target']==$tipo_usuarios['id']){echo ' selected'; } else { if($post_target==$tipo_usuarios['id']){ echo ' selected'; } } ?>><?php echo $tipo_usuarios['tipo_usuario']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<select id="post_type_e" name="post_type" class="form-control" required>
										<option>Seleccionar tipo de publicación</option>
										<?php 
										foreach($tipo_publicacion_array as $tipo_publicacion){
											$parent_tipo_p = $tipo_publicacion['id'];
											mysql_select_db($database_name, $ddbb_naevp);
											mysql_query("SET NAMES 'utf8'");
											$query_R_tipo_pp = "select * from tipo_publicacion where parent = $parent_tipo_p order by tipo_publicacion asc";
											$R_tipo_pp = mysql_query($query_R_tipo_pp, $ddbb_naevp) or die(mysql_error());
											$row_R_tipo_pp = mysql_fetch_assoc($R_tipo_pp);
											$totalRows_R_tipo_pp = mysql_num_rows($R_tipo_pp);
											if($totalRows_R_tipo_pp>0){
												do { ?>
												<option value="<?php echo $row_R_tipo_pp['id']; ?>" <?php if($_SESSION['post_type'] && $_SESSION['post_type']==$row_R_tipo_pp['id']){ echo ' selected'; } else {if($row_R_tipo_pp['id']==$post_type){ echo ' selected'; }}?>><?php echo $row_R_tipo_pp['tipo_publicacion']; ?></option>
												<?php } while ($row_R_tipo_pp = mysql_fetch_assoc($R_tipo_pp));
											} else { ?>
												<option value="<?php echo $tipo_publicacion['id']; ?>" <?php if($_SESSION['post_type'] && $_SESSION['post_type']==$tipo_publicacion['id']){echo ' selected'; } else {if($tipo_publicacion['id']==$post_type){ echo ' selected'; }}?>><?php echo $tipo_publicacion['tipo_publicacion']; ?></option>
											<?php }
										} 
										?>
									</select>
									<script type="text/javascript">
										$('#post_type_e').on('change', function() {
											//alert( this.value );
											if( this.value == '6'){
												$('#post_visibility_e').css('display', 'inline-block');
											} else {
												if( this.value == '14'){
													$('#prod_serv_e').css('display', 'inline-block');
												} else {
													$('#post_visibility_e').css('display', 'none');
													$('#prod_serv_e').css('display', 'none');
												}
											}
										})
									</script>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="post_tags" placeholder="Ingresa las palabras claves de la publicación"><?php if($edit_tags){ echo $edit_tags; } ?></textarea>
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<div class="form-group">
									<label for="email">Archivos de la publicación</label>
									<input name="archivos[]" id="input-4" type="file" class="file" multiple="true" data-show-upload="false" data-show-caption="true">
									<div id="errorBlock43" class="help-block"></div>
									<script>
									$("#input-4").fileinput({
										maxFileSize: 2000,
										elErrorContainer: "#errorBlock43",
										browseLabel: "Buscar archivos..."
									});
									</script>
								</div>
							<?php
								//cosulto los archivos adjuntos
								mysql_select_db($database_name, $ddbb_naevp);
								mysql_query("SET NAMES 'utf8'");
								$query_R_adjuntos = "select * from adjuntos_x_publicacion where id_publicacion = '$edit' and active = '1' order by orden asc";
								$R_adjuntos = mysql_query($query_R_adjuntos, $ddbb_naevp) or die(mysql_error());
								$row_R_adjuntos = mysql_fetch_assoc($R_adjuntos);
								$totalRows_R_adjuntos = mysql_num_rows($R_adjuntos);
								if($totalRows_R_adjuntos>0){
								do { ?>
								<div id="del_<?php echo $row_R_adjuntos['id']; ?>" class="file_adjunto">
									<a id="<?php echo $row_R_adjuntos['id']; ?>" class="delete_adjunto" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a>
									<a href="<?php echo $row_R_adjuntos['file_url']; ?>" title="<?php echo $row_R_adjuntos['file_name']; ?>" target="_blank"><i class="fa fa-file" aria-hidden="true"></i><?php echo $row_R_adjuntos['file_name']; ?></a>
								</div>
								<?php } while ($row_R_adjuntos = mysql_fetch_assoc($R_adjuntos)); ?>
								<script>
									$('.delete_adjunto').click(function() {
										var delete_file = $(this).attr('id');
										$.ajax({
										type: "POST",
										url: "<?php echo $ruta_raiz; ?>includes/procesos/delete_file.php",
										data: {delete_file: delete_file},
										//data: $('form.register').serialize(),
										success: function(msg){
											//window.location.replace("alta_equipo.html");
											//alertas = JSON.parse(msg);
											//alert(alertas[1]);
											alertas = JSON.parse(msg);
											if(alertas[0]=='1'){
												alert(alertas[1]);
											};
											if(alertas[0]=='2'){
												document.getElementById('del_'+delete_file).style.display = "none";
											};
										},
										error: function(){
											alert('Algo salio mal.  Por favor vuelva a intentarlo.');
										}
									});
									});
								</script>
							<?php } ?>
							</div>
							<div class="col-xs-12 col-md-12" id="post_visibility_e" style="<?php if($_SESSION['post_type'] && $_SESSION['post_type']==6){ echo 'display:inline-block;'; } else { echo 'display:none;'; } ?>">
								<div class="form-group">
									<select name="post_visibility" class="form-control" required>
										<option value="0">Visibilidad de la publicación</option>
										<option value="0" <?php if($_SESSION['post_visibility'] && $_SESSION['post_visibility']=='0'){echo ' selected'; } else {if($visibilidad=='0'){ echo ' selected'; }}?>>Publica</option>
										<option value="1" <?php if($_SESSION['post_visibility'] && $_SESSION['post_visibility']=='1'){echo ' selected'; } else {if($visibilidad=='1'){ echo ' selected'; }} ?>>Privada</option>
									</select>
								</div>
							</div>
							
							<div class="col-xs-12 col-md-12" id="prod_serv_e" style="<?php if($_SESSION['post_type'] && $_SESSION['post_type']==14){ echo 'display:inline-block;'; } else { if($post_type==14){ echo 'display:inline-block;'; } else { echo 'display:none;'; } } ?>">
								<div class="form-group">
									<input name="link_compra" placeholder="Link de venta" type="text" class="form-control" <?php if($_SESSION['link_compra']){echo 'value="'.$_SESSION['link_compra'].'"';} else { echo 'value="'.$link_compra.'"'; }?>>
								</div>
							</div>
							<div class="col-xs-12 col-md-12" id="post_visibility" style="<?php if($_SESSION['post_type'] && $_SESSION['post_type']==6){ echo 'display:inline-block;'; } else { if($post_type==6){ echo 'display:inline-block;'; } else { echo 'display:none;'; } } ?>">
								<div class="form-group">
									<select name="post_visibility" class="form-control" required>
										<option value="0">Visibilidad de la publicación</option>
										<option value="0" <?php if($_SESSION['post_visibility'] && $_SESSION['post_visibility']=='0'){echo ' selected'; } ?>>Publica (profesionales y pacientes)</option>
										<option value="2" <?php if($_SESSION['post_visibility'] && $_SESSION['post_visibility']=='2'){echo ' selected'; } ?>>Publica (solo profesionales, no la verán los pacientes)</option>
										<option value="1" <?php if($_SESSION['post_visibility'] && $_SESSION['post_visibility']=='1'){echo ' selected'; } ?>>Privada (solo la verán quienes tengan el link de la pagina)</option>
									</select>
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
					
					<div class="tab-pane<?php if($DoCerrarCuenta){ echo ' active'; } ?>" id="baja">
						<h1>Cerrar tu cuenta</h1>
						<form name="login_form" id="perfil_form" enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="email">Ingresa tu contraseña para cerrar tu cuenta</label>
									<input name="password" type="password" class="form-control" >
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<button type="submit" class="btn btn-default">Cerrar Cuenta</button>
								<input type="hidden" name="action" value="DoCerrarCuenta" />
							</div>
						</form>
					</div>
					
					<div class="tab-pane<?php if($DoGetPro){ echo ' active'; } ?>" id="pro">
						<h1>Cuenta Profesional</h1>
						<p>Ingresa tus datos para hacer el upgrade a cuenta profesional y te beneficiarás con:</p>
						<ul>
							<li>
								<strong>Primero en los resultados</strong>
								<span>Tus notas, actividades y todo el contenido que subas al sitio aparecerá primero y destacado en los resultados de la búsqueda.</span>
							</li>
							<li>
								<strong>Profesionales destacados</strong>
								<span>Tu perfil aparecerá destacado junto a las notas relacionadas con tus especialidades.</span>
							</li>
						</ul>
						<!--<form name="login_form" id="perfil_form" enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
							<div class="col-xs-12 col-md-6">
								<div class="form-group">
									<label for="email">Ingresa tu contraseña para cerrar tu cuenta</label>
									<input name="password" type="password" class="form-control" >
								</div>
							</div>
							<div class="col-xs-12 col-md-12">
								<button type="submit" class="btn btn-default">Cerrar Cuenta</button>
								<input type="hidden" name="action" value="DoCerrarCuenta" />
							</div>
						</form>-->
					</div>
					
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

<!-- Modal Enviar Mensaje -->
<div id="EnviarMensaje" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
		<!--Aca el contenido externo-->
    </div>
  </div>
</div>