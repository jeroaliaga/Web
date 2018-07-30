<?php if($estado_proceso){?>
	<div class="row" style="margin-top:20px;">
		<div class="alert <?php echo $estado_proceso[1]; ?>">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <?php echo $estado_proceso[0]; ?>
		</div>
	</div>
<?php } ?>
<?php
	$frstP = '';
	switch ($estoy) {
		case 'herramientas':
			if(isset($_SESSION['tipo_usr']) && ($_SESSION['tipo_usr']==1 || $_SESSION['tipo_usr']==2)){ 
				$title = '<h2>Hacé click en el filtro que buscás</h2>';
			} else {
				$title = '<h2>Hacé click en el filtro que buscás</h2>';
			}
			break;
		case 'actividades':
			if(isset($_SESSION['tipo_usr']) && ($_SESSION['tipo_usr']==1 || $_SESSION['tipo_usr']==2)){ 
				$title = '<h2>Compartí tus actividades</h2>';
			} else {
				$title = '<h2>Encontrá actividades de tu interés</h2>';
			}
			break;
		case 'foros':
			if(isset($_SESSION['tipo_usr']) && ($_SESSION['tipo_usr']==1 || $_SESSION['tipo_usr']==2)){ 
				$title = '<h2>Participá en grupos de tu interés</h2>';
			} else {
				$title = '<h2>Participá en grupos de tu interés</h2>';
			}
			break;
		case 'notas':
			if(isset($_SESSION['tipo_usr']) && $_SESSION['tipo_usr']==1){ 
				$title = '<h2>Accede y publicá tus notas (Contenido exclusivo para profesionales)</h2>';
			} else {
				if(isset($_SESSION['tipo_usr']) && $_SESSION['tipo_usr']==2){ 
					$title = '<h2>Accede y publicá tus notas <span>(Contenido exclusivo para instituciones)</span></h2>';
					$frstP = '<p>Encontrá notas de tu interés</p>';
				} else {
					$title = '<h2>Notas</h2>';
					$frstP = '<p>Encontrá notas de tu interés</p>';
				}
			}
			break;
		default:
			echo '<h1>Haz click sobre la publicación que quieras leer</h1>';
	}
?>
<div class="section_notas <?php echo "$estoy"; ?>">
	<div class="container">
		<?php 
		echo $title; echo $frstP;
		if($totalRows_R_publicaciones_list==0){?>
			<div class="no_content">
				<p>Por el momento no hay información cargada en esta sección.</p>
			</div>
		<?php } else { ?>
			<?php
				//Filtros de la seccion
				mysql_select_db($database_name, $ddbb_naevp);
				mysql_query("SET NAMES 'utf8'");
				$query_R_publicacion_filtro = "select tipo_publicacion_parent.tipo_publicacion as tipo_publicacion_parent, tipo_publicacion.* 
				from tipo_publicacion, tipo_publicacion as tipo_publicacion_parent
				where tipo_publicacion.parent = '$tipo_publicacion_id' 
				and tipo_publicacion_parent.id = tipo_publicacion.parent
				order by tipo_publicacion.orden asc, tipo_publicacion.tipo_publicacion asc";
				$R_publicacion_filtro = mysql_query($query_R_publicacion_filtro, $ddbb_naevp) or die(mysql_error());
				$row_R_publicacion_filtro = mysql_fetch_assoc($R_publicacion_filtro);
				$totalRows_R_publicacion_filtro = mysql_num_rows($R_publicacion_filtro);
				if($totalRows_R_publicacion_filtro>0){
			?>
			<div class="col_filtros">
				<?php if($estoy=='herramientas'){?>
				<div class="bloque_filtros">
					<div class="grupo">
						<span>Material Bibliográfico</span>
						<a href="?filtro=10" title="Libros">Libros</a>
						<a href="?filtro=8" title="Cuestionarios">Cuestionarios</a>
						<a href="?filtro=9" title="Tests">Tests</a>
						<a href="?filtro=14" title="Productos en Venta">Productos en Venta</a>
					</div>
					<a href="?filtro=13" title="Búsquedas Laborales">Búsquedas Laborales</a>
					<a href="?filtro=12" title="Alquiler de Consultorios">Alquiler de Consultorios</a>
				</div>
				<?php } else { ?>
				<div class="bloque_filtros">
					<?php do { ?>
					<a href="?filtro=<?php echo $row_R_publicacion_filtro['id']; ?>" title="<?php echo $row_R_publicacion_filtro['tipo_publicacion']; ?>"><?php echo $row_R_publicacion_filtro['tipo_publicacion']; ?></a>
					<?php } while ($row_R_publicacion_filtro = mysql_fetch_assoc($R_publicacion_filtro)); ?>
				</div>
				<?php } ?>
			</div>
			<div class="cont_publicaciones">
			<?php } else { ?>
			<div class="cont_publicaciones">
			<?php } ?>
				<ul class="publicaciones">
					<?php do { ?>
					<?php if($tipo_publicacion_id==5){ ?>
					<li class="elemento_biblioteca">
						<a href="<?php echo '../'.$row_R_publicaciones_list['path'].'/?id='.$row_R_publicaciones_list['id']; ?>" title="<?php echo $row_R_publicaciones_list['page_title']; ?>">
							<div class="bloque_icono">
								<i class="fa fa-book" aria-hidden="true"></i>
							</div>
							<div class="info_publicacion">
								<span><?php echo $row_R_publicaciones_list['nombre'].' '.$row_R_publicaciones_list['apellido']; ?></span>
								<h3><?php echo $row_R_publicaciones_list['page_title']; ?></h3>
								<p><?php echo $row_R_publicaciones_list['tags']; ?></p>
							</div>
						</a>
					</li><?php }else{ ?><li>
						<a href="<?php echo '../'.$row_R_publicaciones_list['path'].'/?id='.$row_R_publicaciones_list['id']; ?>" title="<?php echo $row_R_publicaciones_list['page_title']; ?>">
							<?php if($tipo_publicacion_id==6){ ?>
							<div class="img_publicacion_foro" style="background: url('<?php if($row_R_publicaciones_list['img']){ echo $row_R_publicaciones_list['img']; } else { echo $default_img_bg_nota; } ?>');"></div>
							<?php } else { ?>
							<div class="img_publicacion" style="background: url('<?php if($row_R_publicaciones_list['publicacion_img']){ echo '../'.'static/img_publicaciones/'.$row_R_publicaciones_list['publicacion_img']; } else { echo $default_img_bg_nota; } ?>');background-size: cover;
    							background-position: center;"></div>
							<?php } ?>
							<?php if($tipo_publicacion_id==6){ ?>
							<span><?php echo $row_R_publicaciones_list['nombre'].' '.$row_R_publicaciones_list['apellido']; ?></span>
							<?php } else { ?>
							<div class="info_publicacion">
								<span><?php echo $row_R_publicaciones_list['nombre'].' '.$row_R_publicaciones_list['apellido']; ?></span>
								<?php } ?>
								<h3><?php echo $row_R_publicaciones_list['page_title']; ?></h3>
								<p><?php echo $row_R_publicaciones_list['tags']; ?></p>
							</div>
							<!--<i class="quote-right fa fa-quote-right" aria-hidden="true"></i>-->
						</a>
					</li><?php } ?><?php } while ($row_R_publicaciones_list = mysql_fetch_assoc($R_publicaciones_list)); ?>
				</ul>
			</div>
		<?php } ?>
	</div>
</div>