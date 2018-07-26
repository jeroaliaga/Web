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
			<?php if($totalRows_R_list_publicaciones==0){?>
			<div class="row">
				<h1 class="page-header">Por el momento esta sección no tiene publicaciones activas.</h1>
			</div>
			<?php } else { ?>
			<div class="row">
				<h1 class="page-header">Seleccione la publicacion que desea editar o eliminar</h1>
			</div>
			<div class='col-md-12 col-xs-12'>
				<ul class="listado_publicaciones">
					<?php
					do { 
					$page_title = (strlen($row_R_list_publicaciones['page_title']) > 28) ? substr($row_R_list_publicaciones['page_title'],0,25).'...' : $row_R_list_publicaciones['page_title'];
					?>
					<li>
						<i class="quote-left fa fa-quote-left" aria-hidden="true"></i>
						<div class="img_publicacion" style="background: url('<?php echo $sitio_url.'static/img_publicaciones/'.$row_R_list_publicaciones['img']; ?>');"></div>
						<h2><?php echo $page_title; ?></h2>
						<span><?php echo date("d/m/Y", strtotime($row_R_list_publicaciones['hoy_ahora'])); ?></span>
						<a href="<?php echo $ruta_raiz; ?>editar_publicacion.php?id=<?php echo $id; ?>&idPublicacion=<?php echo $row_R_list_publicaciones['id']; ?>" title="Editar Publicacion"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href="<?php echo $ruta_raiz; ?>eliminar_publicacion.php?id=<?php echo $id; ?>&idPublicacion=<?php echo $row_R_list_publicaciones['id']; ?>" title="Eliminar Publicacion"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
						<i class="quote-right fa fa-quote-right" aria-hidden="true"></i>
					</li>
					<?php } while ($row_R_list_publicaciones = mysql_fetch_assoc($R_list_publicaciones)); ?>
				</ul>
			</div>
			<?php } ?>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->