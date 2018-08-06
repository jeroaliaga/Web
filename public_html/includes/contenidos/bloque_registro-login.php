<div class="login">
	<div class="container">
		<?php if($estado_proceso){?>
		<div class="row" style="margin-top:20px;">
			<div class="alert <?php echo $estado_proceso[1]; ?>">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <?php echo $estado_proceso[0]; ?>
			</div>
		</div>
		<?php } ?>
		<div class="cont_login">
			<h2>Ingreso Profesionales / Instituciones</h2>
			<form name="login_form" id="login_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<input name="email" required type="email" class="form-control" id="email" placeholder="E-mail">
				<input name="password" required type="password" class="form-control" id="pwd" placeholder="Contraseña">
				<input type="checkbox" class="remember_me" name="remember_me" value="yes">
				<p>Recordarme en este dispositivo</p>
				<a href="#" class="forgot_pass" data-toggle="modal" data-target="#ModalRecuperoPassword" title="Olvidé mi contraseña">Olvidé mi contraseña</a>
				<button type="submit" class="btn btn-default">Ingresar</button>
				<input type="hidden" name="action" value="login" />
			</form>
			<div class="acceso_pacientes">
				<h2>Ingreso Pacientes</h2>
				<!-- $loginUrl; -->
				<a href="javascript:void(0)" title="Ingreso con cuenta de Facebook" id="fb-btn">Ingresar con mis datos de Facebook</a>
			</div>
		</div>
		<div class="div_registro">
			<h2>Registro</h2>
			<p>¿Sos profesional y te gustaría darte a conocer?</p>
			<a href="#" class="registrate_ahora" title="Registrate ahora" data-toggle="modal" data-target="#ModalRegistro">Registrate ahora</a>
		</div>
	</div>
</div>
	
	<!-- Modal Registro -->
	<div id="ModalRegistro" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h2 class="modal-title">Formulario de registro</h2>
		  </div>
		  <form name="register_form" id="register_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			  <div class="modal-body">
				<div class="form-group width50">
					<input name="nombre" required placeholder="Nombre *" type="text" class="form-control" <?php if($_SESSION['nombre']){echo 'value="'.$_SESSION['nombre'].'"';}?>>
				</div>
				<div class="form-group width50">
					<input name="apellido" placeholder="Apellido (Obligatorio para profesional)" type="text" class="form-control" <?php if($_SESSION['apellido']){echo 'value="'.$_SESSION['apellido'].'"';}?>>
				</div>
				<div class="form-group width50">
					<input name="email" required placeholder="Email" type="email" class="form-control" id="email" <?php if($_SESSION['email']){echo 'value="'.$_SESSION['email'].'"';}?>>
				</div>
				<div class="form-group width50">
					<input name="reemail" required placeholder="Repita su Email" type="email" class="form-control" id="reemail" <?php if($_SESSION['reemail']){echo 'value="'.$_SESSION['reemail'].'"';}?>>
				</div>
				<div class="form-group width50">
					<input name="password" required placeholder="Contraseña" type="password" class="form-control" id="pwd">
				</div>
				<div class="form-group width50">
					<input name="repassword" required placeholder="Repita su contraseña" type="password" class="form-control" id="rpwd">
				</div>
				<div class="form-group width50">
					<select name="tipo_registro" class="form-control" required>
						<option value='0'>Tipo de registro</option>
						<?php do { ?>
						<option value="<?php echo $row_R_tipo_usuario['id']; ?>" <?php if($_SESSION['tipo_registro'] && $_SESSION['tipo_registro']==$row_R_tipo_usuario['id']){echo ' selected'; }?>><?php echo $row_R_tipo_usuario['tipo_usuario']; ?></option>
						<?php } while ($row_R_tipo_usuario = mysql_fetch_assoc($R_tipo_usuario)); ?>
					</select>
				</div>
			  </div>
			  <div class="modal-footer">
				<button type="submit" class="btn btn-default">Registrarme</button>
			  </div>
			  <input type="hidden" name="action" value="register" />
		  </form>
		</div>

	  </div>
	</div>
	
	<!-- Modal Recupero Password-->
	<div id="ModalRecuperoPassword" class="modal fade" role="dialog">
	  <div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Recuperar contraseña</h4>
		  </div>
		  <form name="register_form" id="register_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			  <div class="modal-body" style="display: inline-block;width: 100%;">
				<div class="form-group width50">
					<label for="email">Email:</label>
					<input name="email" required type="email" class="form-control" id="email" <?php if($_SESSION['email']){echo 'value="'.$_SESSION['email'].'"';}?>>
				</div>
			  </div>
			  <div class="modal-footer">			
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-default">Recuperar</button>
			  </div>
			  <input type="hidden" name="action" value="recupero" />
		  </form>
		</div>

	  </div>
	</div>