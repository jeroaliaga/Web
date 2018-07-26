<!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
      <div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $ruta_raiz; ?>">
			<img src="<?php echo $ruta_raiz; ?>static/img/logo_head.png" alt="De Salud Hablamos" />
		  </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        <div class="searchContainer">
        	<div>
        		<p>Filtrá tu búsqueda eligiendo uno o más criterios</p>
				<?php if($estado_proceso){?>
				<div class="row" style="margin-top:20px;">
					<div class="alert <?php echo $estado_proceso[1]; ?>">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  <?php echo $estado_proceso[0];?>
					</div>
				</div>
				<?php } ?>
				<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
					<input type="text" name="profesional_nombre" placeholder="Nombre del profesional" />
					<select name="especialidad">
						<option value="">Especialidad</option>
						<?php 
							foreach($arr_especialidades as $especialidad){
								echo '<option value="'.$especialidad['id'].'" required>'.$especialidad['nombre'].'</option>';
							}
						?>
					</select>
					<?php if($totalRows_R_listado_ciudades>0){?>
					<select name="ciudad_nombre" class="ciudad_nombre">
						<option value="">Ciudad</option>
						
						<?php foreach($arr_ciudades_profesionales as $list_ciudad){ ?>
							<option value="<?php echo $list_ciudad['id_ciudad']; ?>"><?php echo $list_ciudad['ciudad'].' ('.$list_ciudad['estado'].', '.$list_ciudad['pais'].')'; ?></option>
						<?php } ?>
						
					</select>
					<?php } ?>
					<button type="submit" class="submit_buscador_inicio"><i class="fa fa-search" aria-hidden="true"></i></button>
					<input type="hidden" name="action" value="DoBuscarProfesional" />
				</form>
			</div>
			<a href="javascript:void(0)" class="closeSearch"><i class="fa fa-close"></i></a>
        </div>
          <ul class="nav navbar-nav menu_head">
          	<li><a href="javascript:void(0)"><i class="fa fa-search"></i></a></li>
			<li <?php if($estoy == "quienes-somos"){ echo ' class="active"'; } ?>><a href="<?php echo $ruta_raiz; ?>quienes-somos" >Quienes Somos</a></li>
			<li <?php if($estoy == "biblioteca"){ echo ' class="active"'; } ?>><a href="<?php echo $ruta_raiz; ?>notas" >Notas</a></li>
			<li <?php if($estoy == "actividades-foros"){ echo ' class="active"'; } ?>><a href="<?php echo $ruta_raiz; ?>actividades" >Actividades</a></li>
            <li <?php if($estoy == "herramientas"){ echo ' class="active"'; } ?>><a href="<?php echo $ruta_raiz; ?>herramientas" >Herramientas</a></li>
			<li <?php if($estoy == "actividades-foros"){ echo ' class="active"'; } ?>><a href="<?php echo $ruta_raiz; ?>foros" >Foros</a></li>
			<li <?php if($estoy == "contacto"){ echo ' class="active"'; } ?>><a href="<?php echo $ruta_raiz; ?>contacto" >Contacto</a></li>
			<?php if($_SESSION['id_usuario'] || $_SESSION['facebook_access_token']){ ?>
				<?php if($_SESSION['id_usuario'] && !$_SESSION['facebook_access_token']) { ?>
				<li class="btn_registro<?php if($estoy == "mi-perfil"){ echo ' active'; } ?>"><a href="<?php echo $ruta_raiz; ?>mi-perfil">Mi perfil</a></li>
				<?php } else { ?>
				<li class="btn_registro<?php if($estoy == "invitado"){ echo ' active'; } ?>"><a href="<?php echo $ruta_raiz; ?>invitado">Mis Preferencias</a></li>
				<?php } ?>
			<?php } else { ?>
				<li class="btn_registro"><a href="<?php echo $ruta_raiz; ?>login">Registrarse/Ingresar</a></li>
			<?php } ?>
			<li class="social">
				<ul>
					<?php if($_SESSION['id_usuario'] || $_SESSION['facebook_access_token']){?>
					<li><a href="<?php echo $ruta_raiz; ?>?exit=yes" title="Log Out"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
					<?php } ?>
					<?php if($rs_facebook){?><li><a href="<?php echo $rs_facebook; ?>" title="Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a><?php } ?>
					<?php if($rs_twitter){?><li><a href="<?php echo $rs_twitter; ?>" title="Twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a><?php } ?>
					<?php if($rs_linkedin){?><li><a href="<?php echo $rs_linkedin; ?>" title="LinkedIn" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a><?php } ?>
				</ul>
			</li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>