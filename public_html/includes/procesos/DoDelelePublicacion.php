<?php
	$idPublicacionEdit = $_GET['id'];
	$id_user_i = $_GET['id_user_i'];
	
	$ruta_raiz = "../../";
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	//Consulto que la publicacion exista y que sea del usuario
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_publicaciones_e = "select publicaciones.*, tipo_publicacion.path 
	from publicaciones, tipo_publicacion 
	where publicaciones.page_author = '$id_user_i' 
	and publicaciones.parent = '0' 
	and publicaciones.id = '$idPublicacionEdit' 
	and publicaciones.menu_parent = tipo_publicacion.id 
	order by publicaciones.hoy_ahora desc";
	$R_user_publicaciones_e = mysql_query($query_R_user_publicaciones_e, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_publicaciones_e = mysql_fetch_assoc($R_user_publicaciones_e);
	$totalRows_R_user_publicaciones_e = mysql_num_rows($R_user_publicaciones_e);
	if($totalRows_R_user_publicaciones_e==0){
?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Eliminar Publicacion</h4>
	</div>
	<div class="modal-body">
		<p>Ud. no tiene permiso para editar o eliminar esta publicación</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div>
<?php } else { ?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">¿Está seguro que quiere eliminar la publicación?</h4>
	</div>
	<div class="modal-body">
		<p><?php echo $row_R_user_publicaciones_e['page_title']; ?></p>
	</div>
	<div class="modal-footer">
		<form method="post" action="<?php echo $ruta_raiz; ?>mi-perfil/index.php">
			<button type="submit" class="btn btn-danger" >Si! Eliminar</button>
			<input type="hidden" name="idPublicacionEdit" value="<?php echo $idPublicacionEdit; ?>" />
			<input type="hidden" name="action" value="DoDeletePublicacionAction" />
		</form>
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div>
<?php } ?>