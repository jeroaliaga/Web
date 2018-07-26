<?php
	//consultas para obtener los proveedores
	/*mysql_select_db($database_name, $ddbb_naevp);
	$query_R_aaa = "SELECT * FROM proveedores order by nombre asc";
	$R_aaa = mysql_query($query_R_aaa, $ddbb_naevp) or die(mysql_error());
	$row_R_aaa = mysql_fetch_assoc($R_aaa);
	$totalRows_R_aaa = mysql_num_rows($R_aaa);*/
?>
<div id="page-wrapper">
	<div class="row">
		<?php if($estado_proceso){?>
		<div class="col-lg-12 margin-top-20">
			<div class="alert <?php echo $estado_proceso[1]; ?> alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $estado_proceso[0]; ?>
			</div>
		</div>
		<?php } ?>
		<div class="col-lg-12">

			<form id="nuevo_regalo" name="nuevo_regalo" enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
				<div class="row">
					<h1 class="page-header">¿Está seguro que desea eliminar contenido de "<?php echo $row_R_info_publicacion['page_title']; ?>" de la sección "<?php echo $row_R_section['menu']; ?>"?</h1>
				</div>
				<div class='col-md-12 col-xs-12'>
					<div class="form-group">
						<label>Nombre</label>
						<input disabled name="page_title" <?php if(isset($_SESSION['page_title'])){ echo 'value="'.$_SESSION['page_title'].'"'; } else { if($row_R_info_publicacion['page_title']){echo 'value="'.$row_R_info_publicacion['page_title'].'"';}}?> class="form-control" required>
					</div>
					<div class="form-group">
						<label for="email">Imagen destacada</label>
						<input disabled name="file" id="input-2" type="file" class="file" data-show-upload="false" data-show-caption="true">
						<div id="errorBlock43" class="help-block"></div>
						<script>
						$("#input-2").fileinput({
							maxFileSize: 2000,
							allowedFileExtensions: ["jpg", "png", "gif", "jpeg"],
							elErrorContainer: "#errorBlock43",
							<?php if($_SESSION['img']){?>
							initialPreview: [
								"<img style='height:160px' src='<?php echo $_SESSION['img']; ?>'>",
							],
							initialCaption: 'Initial-Image.jpg',
							initialPreviewShowDelete: false,
							showRemove: false,
							showClose: false,
							<?php 
								} else { 
								if($row_R_info_publicacion['img']){
							?>
							initialPreview: [
								"<img style='height:160px' src='<?php echo $sitio_url.'static/img_publicaciones/'.$row_R_info_publicacion['img']; ?>'>",
							],
							initialCaption: 'Initial-Image.jpg',
							initialPreviewShowDelete: false,
							showRemove: false,
							showClose: false,
							<?php } } ?>
							browseLabel: "Buscar imagen..."
						});
						</script>
					</div>					
					<div class="form-group">
						<label>Contenido</label>
						<textarea disabled id="summernote" class="form-control" name="page_content" required><?php if($_SESSION['page_content']){echo $_SESSION['page_content']; } else { if($row_R_info_publicacion['page_content']){ echo $row_R_info_publicacion['page_content']; } } ?></textarea>
						<script>
							$(document).ready(function() {
								var IMAGE_PATH = 'http://www.lafleboestetica.com.ar/beta/static/img_publicaciones/';
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
					<div class="form-group">
						<label for="email">Fecha de publicación:</label>
						<input disabled type="text" name="fecha_publicacion" class="form-control" required <?php if($_SESSION['fecha_publicacion']){echo 'value="'.$_SESSION['fecha_publicacion'].'"';} else { if($row_R_info_publicacion['hoy_ahora']){echo 'value="'.date("m/d/Y", strtotime($row_R_info_publicacion['hoy_ahora'])).'"';} }?> />
					</div>
					
				</div>
				<div class='col-md-12'>
					<input type="hidden" name="action" value="DoDelete" />
					<input type="hidden" name="idPublicacion" value="<?php echo $idPublicacion; ?>" />
					<input type="hidden" name="parent" value="<?php echo $id; ?>" />
					<input type='submit' id="submit_btn" name="submit_crear" class="btn btn-primary btn-lg btn-block" value="Si! Eliminar!" style="margin-bottom: 30px;"/>
				</div>
			</form>

		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->