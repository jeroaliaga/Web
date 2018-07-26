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
		<ul class="bloque_resultados_profesionales">
			<li>
				<div class="col-xs-12 col_head">
					<h1><?php echo $row_R_user_basic['nombre'].' '.$row_R_user_basic['apellido']; ?></h1>
					<a href="<?php echo $ruta_raiz.'includes/procesos/DoContactarProfesional.php?id='.$row_R_user_basic['id']; ?>" data-toggle="modal" data-target="#EnviarMensaje" title="Contactar a <?php echo $row_R_user_basic['nombre'].' '.$row_R_user_basic['apellido']; ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i></a>
					<?php 
						if($_SESSION['id_usuario']){
						$id_usr_check = $_SESSION['id_usuario'];
						$id_prof_check = $row_R_user_basic['id'];
						mysql_select_db($database_name, $ddbb_naevp);
						mysql_query("SET NAMES 'utf8'");
						$query_R_fav_already = "select * from profesionales_favoritos where id_usuario='".$id_usr_check."' and id_profesional='".$id_prof_check."'";
						$R_fav_already = mysql_query($query_R_fav_already, $ddbb_naevp) or die(header($error_mysql));
						$row_R_fav_already = mysql_fetch_assoc($R_fav_already);
						$totalRows_RR_fav_already = mysql_num_rows($R_fav_already);
					?>
					<a id="<?php echo $row_R_user_basic['id']; ?>" class="fav_prof<?php if($totalRows_RR_fav_already>0){ echo ' fav_on'; } ?>" title="Agregar a <?php echo $row_R_user_basic['nombre'].' '.$row_R_user_basic['apellido']; ?> a favoritos"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
					<script>
						$('.fav_prof').click(function() {
							var id_prof = $(this).attr('id');
							$.ajax({
								type: "POST",
								url: "<?php echo $ruta_raiz; ?>includes/procesos/DoFavProfesional.php",
								data: {id_profesional: id_prof,action: 'fav',id_usuario:<?php echo $_SESSION['id_usuario']; ?>},
								//data: $('form.register').serialize(),
								success: function(msg){
									alertas = JSON.parse(msg);
									if(alertas[0]=='1'){
										alert(alertas[1]);
									};
									if(alertas[0]=='2'){
										$('#'+id_prof).addClass('fav_on')
									};
									if(alertas[0]=='3'){
										$('#'+id_prof).removeClass('fav_on')
									};
								},
								error: function(){
									alert('Algo salio mal.  Por favor vuelva a intentarlo.');
								}
							});
						});
					</script>
					<?php } ?>
					<?php if($row_R_user_basic['is_verified']==1){?><span><i class="fa fa-check-square-o" aria-hidden="true"></i> Profesional Verificado</span><?php } ?>
				</div>
				<div class="row bloque_presentacion">
					<div class="col-xs-12 col-md-2 col_imagen_perfil">
						<div class="img_perfil" style="background: url('<?php if($row_R_user_basic['img']){ echo $row_R_user_basic['img']; } else { echo $default_user_image; } ?>');"></div>
						<!--<h3><?php echo $total_publicaciones; ?><br/><i class="fa fa-comments-o" aria-hidden="true"></i></h3>-->
					</div>
					<div class="col-xs-12 col-md-8 col_contenido_detalle col_presentacion_personal">
						<?php if($row_R_user_perfil['presentacion_personal']){ ?>
						<span>Presentación Personal</span>
						<p><?php echo $row_R_user_perfil['presentacion_personal']; ?></p>
						<?php } ?>
					</div>
				</div>
				<div class="col-xs-12 col-md-4 col_contenido_detalle">					
					<?php if($row_R_user_perfil['www']){ ?>
					<span>Sitio web</span>
					<p><?php echo $row_R_user_perfil['www']; ?></p>
					<?php } ?>
					
					<?php 
					if($totalRows_R_user_cons>0){ 
					$cons_n = 0;
					do {
					$cons_n = $cons_n + 1;
					if($totalRows_R_user_cons>1){
						echo '<span>Dirección Consultorio #'.$cons_n.'</span>';
					} else {
						echo '<span>Dirección Consultorio</span>';
					}
					?>
					<p>
						<?php //echo 'Dirección: '.$row_R_user_cons['direccion']; ?>
						<?php //if($row_R_user_cons['telefono']){ echo 'Teléfono: '.$row_R_user_cons['telefono'].'<br/>'; } ?>
						<?php //if($row_R_user_cons['cp']){ echo 'Código Postal: '.$row_R_user_cons['cp'].'<br/>'; } ?>
						<?php echo $row_R_user_cons['ciudad'].' ('.$row_R_user_cons['partido'].')<br/>'; ?>
						<?php echo $row_R_user_cons['estado']; ?><br/>
						<?php echo $row_R_user_cons['pais']; ?>
					</p>
					<?php } while ($row_R_user_cons = mysql_fetch_assoc($R_user_cons)); } ?>
					
					<?php if($row_R_user_perfil['matricula']){ ?>
					<span>Matrícula</span>
					<p><?php echo $row_R_user_perfil['matricula']; ?></p>
					<?php } ?>
					
					<?php if($row_R_user_perfil['honorarios']){ ?>
					<span>Honorarios</span>
					<?php if($row_R_user_perfil['honorarios']>0){?>
					<p>$ <?php echo $row_R_user_perfil['honorarios']; ?></p>
					<?php } else { ?>
					<p>A convenir</p>
					<?php } ?>
					<?php } ?>
					
					<?php 
					//consulto las fa_x_usuario
					mysql_select_db($database_name, $ddbb_naevp);
					mysql_query("SET NAMES 'utf8'");
					$query_R_user_fa = "select * from fa_x_usuario where id_usuario = '".$row_R_user_basic['id']."' order by anio desc";
					$R_user_fa = mysql_query($query_R_user_fa, $ddbb_naevp) or die(header($error_mysql));
					$row_R_user_fa = mysql_fetch_assoc($R_user_fa);
					$totalRows_R_user_fa = mysql_num_rows($R_user_fa);
					if($totalRows_R_user_fa>0){
					?>
					<div class="bloque_fa">
					<span>Formación Académica</span>
					<ul class="experiencia_laboral">
						<?php do { ?>
						<li>
							<span><?php echo $row_R_user_fa['anio']; ?></span>
							<strong><?php echo $row_R_user_fa['institucion']; ?></strong>
							<p><?php echo $row_R_user_fa['titulo']; ?></p>
						</li>
						<?php } while ($row_R_user_fa = mysql_fetch_assoc($R_user_fa)); ?>
					</ul>
					</div>
					<?php } ?>
					
					<?php 
					//consulto las experiencia_x_usuario
					mysql_select_db($database_name, $ddbb_naevp);
					mysql_query("SET NAMES 'utf8'");
					$query_R_user_experiencia = "select * from experiencia_x_usuario where id_usuario = '".$row_R_user_basic['id']."' order by anio desc";
					$R_user_experiencia = mysql_query($query_R_user_experiencia, $ddbb_naevp) or die(header($error_mysql));
					$row_R_user_experiencia = mysql_fetch_assoc($R_user_experiencia);
					$totalRows_R_user_experiencia = mysql_num_rows($R_user_experiencia);
					if($totalRows_R_user_experiencia>0){
					?>
					<div class="bloque_fa">
					<span>Experiencia Laboral</span>
					<ul class="experiencia_laboral">
						<?php do { ?>
						<li>
							<span><?php echo $row_R_user_experiencia['anio']; ?></span>
							<strong><?php echo $row_R_user_experiencia['institucion']; ?></strong>
							<p><?php echo $row_R_user_experiencia['titulo']; ?></p>
						</li>
						<?php } while ($row_R_user_experiencia = mysql_fetch_assoc($R_user_experiencia)); ?>
					</ul>
					</div>
					<?php } ?>
					
					<?php if($row_R_user_perfil['asociacion_institucion']){ ?>
					<span>Organizaciones y/o Instituciones en las que colabora</span>
					<p><?php echo $row_R_user_perfil['asociacion_institucion']; ?></p>
					<?php } ?>
					
					
					
				</div>
				<div class="col-xs-12 col-md-4 col_contenido_detalle">
					<span>Disponible para emergencias</span>
					<p><?php if($row_R_user_perfil['disponible_emergencias']==1){ echo 'Si'; } else { echo 'No'; } ?></p>
					
					<span>Primera consulta sin cargo</span>
					<p><?php if($row_R_user_perfil['pesc']==1){ echo 'Si'; } else { echo 'No'; } ?></p>
					
					<?php 
					//especialidades
					if($totalRows_R_oxu_esp>0){
						echo '<span>Especialidades</span>';
						do {
							echo '<p class="no_margin">'.$row_R_oxu_esp['nombre'].'</p>';
						} while ($row_R_oxu_esp = mysql_fetch_assoc($R_oxu_esp));
						echo '<br/>';
					}
					
					//Idiomas
					if($totalRows_R_oxu_idi>0){
						echo '<span>Idiomas</span>';
						do {
							echo '<p class="no_margin">'.$row_R_oxu_idi['nombre'].'</p>';
						} while ($row_R_oxu_idi = mysql_fetch_assoc($R_oxu_idi));
						echo '<br/>';
					}
					
					//Modalidad Atencion
					if($totalRows_R_oxu_mat>0){
						echo '<span>Modalidad de Atención</span>';
						do {
							echo '<p class="no_margin">'.$row_R_oxu_mat['nombre'].'</p>';
						} while ($row_R_oxu_mat = mysql_fetch_assoc($R_oxu_mat));
						echo '<br/>';
					}
					
					//Obras Sociales
					echo '<span>Atiende por obra social</span>';
					if($row_R_user_perfil['os']==1){ 
						echo '<p>Si</p>'; 
						echo '<span>Reintegros Obra Social</span>';
						echo '<p>';
						if($row_R_user_perfil['reintegros_os']==1){
							echo 'Si';
						} else {
							echo 'No';
						}
						echo '</p>';
					} else { 
						echo '<p>No</p>'; 
					}
					
					if($totalRows_R_oxu_oso>0){
						echo '<span>Obras Sociales</span>';
						do {
							echo '<p class="no_margin">'.$row_R_oxu_oso['nombre'].'</p>';
						} while ($row_R_oxu_oso = mysql_fetch_assoc($R_oxu_oso));
						echo '<br/>';
					}
					
					//Poblacion Clinica
					if($totalRows_R_oxu_pcl>0){
						echo '<span>Población Clínica</span>';
						do {
							echo '<p class="no_margin">'.$row_R_oxu_pcl['nombre'].'</p>';
						} while ($row_R_oxu_pcl = mysql_fetch_assoc($R_oxu_pcl));
						echo '<br/>';
					}
					
					//Temáticas
					if($totalRows_R_oxu_tem>0){
						echo '<span>Temáticas que trabaja</span>';
						do {
							echo '<p class="no_margin">'.$row_R_oxu_tem['nombre'].'</p>';
						} while ($row_R_oxu_tem = mysql_fetch_assoc($R_oxu_tem));
						echo '<br/>';
					}
					
					//Orientación Clínica
					if($totalRows_R_oxu_ocl>0){
						echo '<span>Orientación Clínica</span>';
						do {
							echo '<p class="no_margin">'.$row_R_oxu_ocl['nombre'].'</p>';
						} while ($row_R_oxu_ocl = mysql_fetch_assoc($R_oxu_ocl));
						echo '<br/>';
					}
					
					//Modalidad de Trabajo
					if($totalRows_R_oxu_mt>0){
						echo '<span>Modalidad de Trabajo</span>';
						do {
							echo '<p class="no_margin">'.$row_R_oxu_mt['nombre'].'</p>';
						} while ($row_R_oxu_mt = mysql_fetch_assoc($R_oxu_mt));
						echo '<br/>';
					}
					?>
				</div>
				<div class="col-xs-12 col-md-4 col_contenido_detalle">
					
					<?php
					mysql_select_db($database_name, $ddbb_naevp);
					mysql_query("SET NAMES 'utf8'");
					$query_R_proa = "select users.nombre, users.apellido, users.img, users.id
					from users, profesionales_favoritos
					where users.id = profesionales_favoritos.id_profesional 
					and profesionales_favoritos.id_usuario = '".$_GET['id']."'";
					$R_proa = mysql_query($query_R_proa, $ddbb_naevp) or die(header($error_mysql));
					$row_R_proa = mysql_fetch_assoc($R_proa);
					$totalRows_R_proa = mysql_num_rows($R_proa);
					if($totalRows_R_proa>0){
						echo '<div class="amigos_proa">';
						echo '<h3>Profesionales amigos</h3>';
						echo '<ul>';
						do {
						?>
							<li style="background: url('<?php echo $row_R_proa['img']; ?>');background-size: cover;background-position: 50%;">
								<a href="http://desaludhablamos.com/profesionales/?id=<?php echo $row_R_proa['id']; ?>" title="<?php echo $row_R_proa['nombre'].' '.$row_R_proa['apellido']; ?>"></a>
							</li>
						<?php 
						} while ($row_R_proa = mysql_fetch_assoc($R_proa));
						echo '</ul>';
						echo '</div>';
					}
					?>
					
					
					<span>Calificaciones</span>
					<ul class="calificaciones">
						<?php
							$array_calificaciones = array(
								array('Calidez y empatia',1),
								array('Capacidad de escucha',2),
								array('Dominio de la especialidad',3),
								array('Instalaciones',4)
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
								$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$row_R_user_basic['id']."' and value = '1'";
								$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
								$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
								$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
								if($totalRows_R_user_cal>0){
									$cal = $totalRows_R_user_cal;
								} else {
									$cal = '0';
								}
							?>
							<strong><?php echo $cal; ?> usuarios</strong>
							</div>
							<div>
							<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
							<?php
								mysql_select_db($database_name, $ddbb_naevp);
								mysql_query("SET NAMES 'utf8'");
								$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$row_R_user_basic['id']."' and value = '2'";
								$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
								$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
								$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
								if($totalRows_R_user_cal>0){
									$cal = $totalRows_R_user_cal;
								} else {
									$cal = '0';
								}
							?>
							<strong><?php echo $cal; ?> usuarios</strong>
							</div>
							<div>
							<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
							<?php
								mysql_select_db($database_name, $ddbb_naevp);
								mysql_query("SET NAMES 'utf8'");
								$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$row_R_user_basic['id']."' and value = '3'";
								$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
								$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
								$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
								if($totalRows_R_user_cal>0){
									$cal = $totalRows_R_user_cal;
								} else {
									$cal = '0';
								}
							?>
							<strong><?php echo $cal; ?> usuarios</strong>
							</div>
							<div>
							<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-o" aria-hidden="true"></i>
							<?php
								mysql_select_db($database_name, $ddbb_naevp);
								mysql_query("SET NAMES 'utf8'");
								$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$row_R_user_basic['id']."' and value = '4'";
								$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
								$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
								$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
								if($totalRows_R_user_cal>0){
									$cal = $totalRows_R_user_cal;
								} else {
									$cal = '0';
								}
							?>
							<strong><?php echo $cal; ?> usuarios</strong>
							</div>
							<div>
							<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>
							<?php
								mysql_select_db($database_name, $ddbb_naevp);
								mysql_query("SET NAMES 'utf8'");
								$query_R_user_cal = "select *from calificacion_x_usuario where item = '".$calif[1]."' and id_usuario = '".$row_R_user_basic['id']."' and value = '5'";
								$R_user_cal = mysql_query($query_R_user_cal, $ddbb_naevp) or die(header($error_mysql));
								$row_R_user_cal = mysql_fetch_assoc($R_user_cal);
								$totalRows_R_user_cal = mysql_num_rows($R_user_cal);
								if($totalRows_R_user_cal>0){
									$cal = $totalRows_R_user_cal;
								} else {
									$cal = '0';
								}
							?>
							<strong><?php echo $cal; ?> usuarios</strong>
							</div>
						</li>
						<?php } ?>
					</ul>
					<?php
						//consulto si ya voto al usuario
						mysql_select_db($database_name, $ddbb_naevp);
						mysql_query("SET NAMES 'utf8'");
						$query_R_user_v = "select * from calificacion_x_usuario where id_calificador = '".$_SESSION['id_usuario']."' and id_usuario = '".$row_R_user_basic['id']."'";
						$R_user_v = mysql_query($query_R_user_v, $ddbb_naevp) or die(header($error_mysql));
						$row_R_user_cv = mysql_fetch_assoc($R_user_v);
						$totalRows_R_user_v = mysql_num_rows($R_user_v);
						if($totalRows_R_user_v==0){
					?>
					<a class="btn_califica_profesional" href="<?php echo $ruta_raiz.'includes/procesos/DoCalificarProfesional.php?id='.$row_R_user_basic['id']; ?>" data-toggle="modal" data-target="#CalificarProfesional" title="Califica a <?php echo $row_R_user_basic['nombre'].' '.$row_R_user_basic['apellido']; ?>">Califica a <?php echo $row_R_user_basic['nombre'].' '.$row_R_user_basic['apellido']; ?></a>
					<?php } ?>
				</div>
			</li>
		</ul>
						
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

<!-- Modal Calificar Profesional -->
<div id="CalificarProfesional" class="modal fade" role="dialog">
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