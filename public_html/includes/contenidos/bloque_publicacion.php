<?php
	$mes_num = date("m", strtotime($row_R_publicacion['hoy_ahora']))-1;

	//determino, de acuerdo a los tags, las notas relacionadas
	$tags = explode(',', $row_R_publicacion['tags']);
	$publicaciones_relacionadas = array();
	$publicaciones_list = array();
	foreach($tags as $tag){
		mysql_select_db($database_name, $ddbb_naevp);
		mysql_query("SET NAMES 'utf8'");
		$query_R_publicaciones_relacionadas = "select * from publicaciones where page_type = '0' and active = 1 and id <> '$id' and tags like '%$tag%'";
		$R_publicaciones_relacionadas = mysql_query($query_R_publicaciones_relacionadas, $ddbb_naevp) or die(header($error_mysql));
		$row_R_publicaciones_relacionadas = mysql_fetch_assoc($R_publicaciones_relacionadas);
		$totalRows_R_publicaciones_relacionadas = mysql_num_rows($R_publicaciones_relacionadas);
		if($totalRows_R_publicaciones_relacionadas>0){
			$insert_in_array = TRUE;
			foreach($publicaciones_relacionadas as $id_presente){
				if($row_R_publicaciones_relacionadas['id'] == $id_presente["id"]){
					$insert_in_array = FALSE;
				}
			}
			if($insert_in_array==TRUE){
				do {
				$publicaciones_relacionadas[] = array("id" => $row_R_publicaciones_relacionadas['id'],
										"page_title" => $row_R_publicaciones_relacionadas['page_title']);
			   } while($row_R_publicaciones_relacionadas = mysql_fetch_assoc($R_publicaciones_relacionadas));
		   }
		}
	}
?>
<div class="note_container">
		<div class="container_info">
			<?php 
			echo "<h2>$titulo_seccion</h2>";
			if($estado_proceso){?>
			<div class="row" style="margin-top:20px;">
				<div class="alert <?php echo $estado_proceso[1]; ?>">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <?php echo $estado_proceso[0]; ?>
				</div>
			</div>
			<?php } ?>
			<div class='first_info'>
				<h3><?php echo $row_R_publicacion['page_title']; ?></h3>
				<?php if($row_R_publicacion['publicacion_img']){ ?>
					<div>
						<div class="date">
							<p><?php echo date("d", strtotime($row_R_notas['hoy_ahora'])); ?></p>
							<p><?php echo $meses[$mes_num]; ?></p>
						</div>
						<div class='img' style="background: url(<?php echo "'../static/img_publicaciones/" . $row_R_publicacion['publicacion_img'] . "'"; ?>);background-size: cover;
    background-position: center;">
							
						</div><?php  }else{

							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_adjuntos = "select * from adjuntos_x_publicacion where id_publicacion = '$id' and active = '1' order by orden asc";
							$R_adjuntos = mysql_query($query_R_adjuntos, $ddbb_naevp) or die(mysql_error());
							$row_R_adjuntos = mysql_fetch_assoc($R_adjuntos);
							$totalRows_R_adjuntos = mysql_num_rows($R_adjuntos);
							//$row_R_adjuntos['file_url'] $row_R_adjuntos['file_name']
							if($totalRows_R_adjuntos>0){
							
							
						 ?>
						
						<div>
						<div class="date">
							<p><?php echo date("d", strtotime($row_R_notas['hoy_ahora'])); ?></p>
							<p><?php echo $meses[$mes_num]; ?></p>
						</div>
						<div class='img' style="background: url(<?php echo $row_R_adjuntos['file_url']; ?>);background-size: cover;
    background-position: center;">
							
						</div>

						<?php }}?>
					</div>
				
				<?php
				//cosulto los archivos adjuntos
				if($totalRows_R_adjuntos>0){

				do { ?>

				<?php } while ($row_R_adjuntos = mysql_fetch_assoc($R_adjuntos)); 

				}?>
					<div class='social'>
					<div>
						<!-- Go to www.addthis.com/dashboard to customize your tools -->
						<div class="addthis_inline_share_toolbox"></div>
						
						<!--<div class="widgets no-margin">
							<h4>Categorias</h4>
							<a href="#" title="">
								<i class="fa fa-tag" aria-hidden="true"></i>Psicologia
							</a>
							<a href="#" title="">
								<i class="fa fa-tag" aria-hidden="true"></i>Psicologia
							</a>
							<a href="#" title="">
								<i class="fa fa-tag" aria-hidden="true"></i>Psicologia
							</a>
							<a href="#" title="">
								<i class="fa fa-tag" aria-hidden="true"></i>Psicologia
							</a>
							<a href="#" title="">
								<i class="fa fa-tag" aria-hidden="true"></i>Psicologia
							</a>
						</div>-->
						<?php 
							if($row_R_publicacion['menu_parent']==6&&$_SESSION['id_usuario']){ 
							//consulto si estoy siguiendo este grupo de discusion
							$idu=$_SESSION['id_usuario'];
							mysql_select_db($database_name, $ddbb_naevp);
							mysql_query("SET NAMES 'utf8'");
							$query_R_fdj = "select * from grupos_discusion where id_usuario = '$idu' and id_publicacion = '$id'";
							$R_fdj = mysql_query($query_R_fdj, $ddbb_naevp) or die(header($error_mysql));
							$row_R_fdj = mysql_fetch_assoc($R_fdj);
							$totalRows_R_fdj = mysql_num_rows($R_fdj);
							if($totalRows_R_fdj>0){
								$style_join_foro = 'display:none;';
								$style_unjoin_foro = 'display:inline;';
							} else {
								$style_join_foro = 'display:inline;';
								$style_unjoin_foro = 'display:none;';
							}
						?>
							<div id="join_foro" class="widgets no-margin no-border" style="<?php echo $style_join_foro; ?>">
								<a class="join_foro" id="<?php echo $id; ?>" title="Unirme a este grupo de discusión"><i class="fa fa-commenting-o" aria-hidden="true"></i><span>Unirme a este grupo de discusión</span></a>
							</div>
							<div id="unjoin_foro" class="widgets no-margin no-border" style="<?php echo $style_unjoin_foro; ?>">
								<a class="join_foro" id="<?php echo $id; ?>" title="Abandonar este grupo de discusión"><i class="fa fa-commenting-o" aria-hidden="true"></i><span>Abandonar a este grupo de discusión</span></a>
							</div>
							<script>
								$('#join_foro .join_foro').click(function() {
									var id_publicacion = $(this).attr('id');
									$.ajax({
										type: "POST",
										url: "<?php echo $ruta_raiz; ?>includes/procesos/join_foro.php",
										data: {id_publicacion: id_publicacion,action: 'join',id_usuario:<?php echo $_SESSION['id_usuario']; ?>},
										//data: $('form.register').serialize(),
										success: function(msg){
											alertas = JSON.parse(msg);
											if(alertas[0]=='1'){
												alert(alertas[1]);
											};
											if(alertas[0]=='2'){
												document.getElementById('join_foro').style.display = "none";
												document.getElementById('unjoin_foro').style.display = "inline";
											};
										},
										error: function(){
											alert('Algo salio mal.  Por favor vuelva a intentarlo.');
										}
									});
								});
								$('#unjoin_foro .join_foro').click(function() {
									var id_publicacion = $(this).attr('id');
									$.ajax({
										type: "POST",
										url: "<?php echo $ruta_raiz; ?>includes/procesos/join_foro.php",
										data: {id_publicacion: id_publicacion,action:'unjoin',id_usuario:<?php echo $_SESSION['id_usuario']; ?>},
										//data: $('form.register').serialize(),
										success: function(msg){
											alertas = JSON.parse(msg);
											if(alertas[0]=='1'){
												alert(alertas[1]);
											};
											if(alertas[0]=='2'){
												document.getElementById('join_foro').style.display = "inline";
												document.getElementById('unjoin_foro').style.display = "none";
											};
										},
										error: function(){
											alert('Algo salio mal.  Por favor vuelva a intentarlo.');
										}
									});
								});
							</script>
						<?php } ?>
						<?php if($rs_facebook){?>
						<div class="widgets">
							<h4><a href="<?php echo $rs_facebook; ?>" target="_blank" title="Buscanos en Facebook">Buscanos en Facebook</a></h4>
						</div>
						<?php } ?>
						<?php if($rs_twitter){?>
						<div class="widgets">
							<h4><a href="<?php echo $rs_twitter; ?>" target="_blank" title="Seguinos en Twitter">Seguinos en Twitter</a></h4>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="sobre_autor">
						<div class="img_autor">
							<?php
								if($row_R_publicacion['user_img']==''){
									echo '<img src="'.$ruta_raiz.'static/img/default-user-image.png" alt="'.$row_R_publicacion['nombre'].' '.$row_R_publicacion['apellido'].'" />'; 
								} else {
									echo '<img src="'.$row_R_publicacion['user_img'].'" alt="'.$row_R_publicacion['nombre'].' '.$row_R_publicacion['apellido'].'" />'; 
								}
							?>
						</div><div class="datos">
							<h3>Sobre el autor</h3>
							<a href="<?php echo $ruta_raiz; ?>profesionales/?id=<?php echo $row_R_publicacion['page_author']; ?>" title="<?php echo 'Ver perfil de '.$row_R_publicacion['nombre'].' '.$row_R_publicacion['apellido']; ?>">Ver perfil</a>
							<p><?php echo $row_R_publicacion['nombre'].' '.$row_R_publicacion['apellido']; ?></p>
							<?php if($totalRows_R_page_author_extra_info>0){
								echo '<p>'.$row_R_page_author_extra_info['presentacion_personal'].'</p>';
							} ?>
						</div>
				</div>
			</div>
			<?php if($row_R_publicacion['link_compra']){?>
			<a href="<?php echo $row_R_publicacion['link_compra']; ?>" class="btn_comprar" target="_blank" title="Comprar <?php echo $row_R_publicacion['page_title']; ?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
			<?php } ?>
		</div>
		<div class="content">
			<div class="contenido">
				<?php echo $row_R_publicacion['page_content']; ?>
			</div>
			<?php if(count($publicaciones_relacionadas)>0){?>
				<div class="widgets">
					<h4>También te puede interesar</h4>
					<?php foreach($publicaciones_relacionadas as $publicacion_relacionada){?>
						<a href="<?php echo $ruta_raiz; ?>notas/?id=<?php echo $publicacion_relacionada['id']; ?>" title="<?php echo $publicacion_relacionada['page_title']; ?>"><?php echo $publicacion_relacionada['page_title']; ?></a>
					<?php } ?>
				</div>
			<?php } ?>
			<?php if($id){?>
				<?php if($totalRows_R_publicacion_com>0){ ?>
				<div class="bloque_comentarios">
					<div class="container">
						<span class="numero_comentarios"><?php echo $totalRows_R_publicacion_com; ?> <?php if($totalRows_R_publicacion_com>1){ echo 'Comentarios'; } else { echo 'Comentario'; } ?></span>
						<?php do { ?>
						<div class="comentario">
							<?php
								if($row_R_publicacion_com['img']==''){
									echo '<img src="'.$ruta_raiz.'static/img/default-user-image.png" alt="'.$row_R_publicacion_com['nombre'].' '.$row_R_publicacion_com['apellido'].'" />'; 
								} else {
									echo '<img src="'.$row_R_publicacion_com['img'].'" alt="'.$row_R_publicacion_com['nombre'].' '.$row_R_publicacion_com['apellido'].'" />'; 
								}
							?>
							<h3><?php echo $row_R_publicacion_com['nombre'].' '.$row_R_publicacion_com['apellido']; ?></h3>
							<span><?php echo date("d/m/Y h:i A", strtotime($row_R_publicacion_com['hoy_ahora'])); ?></span>
							<?php echo $row_R_publicacion_com['page_content']; ?>
						</div>
						<?php } while ($row_R_publicacion_com = mysql_fetch_assoc($R_publicacion_com)); ?>
					</div>
				</div>
				<?php } ?>

				<?php if($_SESSION['id_usuario']){?>
					<div class="comentarios">
						<h4>Enviá tu comentario</h4>
						<div class="comentario">
							<form name="login_form" id="perfil_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
								<textarea name="post_content" required placeholder="Escribe aquí tu comentario"></textarea>
								<input type="submit" name="submit" value="Enviar Comentario como <?php echo $_SESSION['fullname']; ?>" />
								<input type="hidden" name="action" value="publish" />
								<input type="hidden" name="post_parent" value="<?php echo $id; ?>" />
							</form>
						</div>
					</div>
				<?php } else { ?>
					<div class="comentarios">
						<h4>Enviá tu comentario</h4>
						<div class="comentario">
							<p>Debes estar logueado como <a href="<?php echo $ruta_raiz; ?>login/" title="Ingreso como profesional">profesional</a> o como usuario con tu cuenta de <a href="<?php echo $loginUrl; ?>" title="Ingreso con cuenta de Faceboo">Facebook</a> para poder comentar.</p>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>