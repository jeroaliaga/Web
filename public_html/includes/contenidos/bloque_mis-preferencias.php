<?php
	$id_user_i = $_SESSION['id_usuario'];
	
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
					<li <?php if(!$DoGuardarPerfil&&!$DoPublish&&!$edit){echo 'class="active"'; } ?>><a href="#profesionales" data-toggle="tab"><i class="fa fa-heart" aria-hidden="true"></i> Mis profesionales</a></li>
					<li <?php if($DoPublish){echo 'class="active"'; } ?>><a href="#grupos" data-toggle="tab"><i class="fa fa-comments" aria-hidden="true"></i> Mis grupos</a></li>
				</ul>
				<div id="my-tab-content" class="tab-content">
					<div class="tab-pane active" id="profesionales">
						<?php if($totalRows_R_fprof==0){?>
							<h1>Aun no tienes profesionales como favoritos.</h1>
						<?php } else { ?>
							<h1>Estos son tus profesionales favoritos.</h1>
							<ul class="bloque_resultados_profesionales">
								<?php do { ?>
								<li>
									<!--<div class="col-xs-12 col-md-1 col_comentarios">
										<h3>Calificaciones<br/><i class="fa fa-star" aria-hidden="true"></i></h3>
									</div>-->
									<div class="col-xs-12 col-md-2 col_imagen_perfil">
										<div class="img_perfil" style="background: url('<?php if($row_R_fprof['img']){ echo $row_R_fprof['img']; } else { echo $default_user_image; } ?>');"></div>
									</div>
									<div class="col-xs-12 col-md-9 col_contenido">
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
				</div>
			</div>
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

<script type="text/javascript">
$('.modal').on('hidden.bs.modal', function(e)
    { 
        $(this).removeData();
    }) ;
</script>