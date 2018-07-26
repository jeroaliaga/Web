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
		<div class="col-xs-12 col-md-6">
			<h1>Ingreso Profesionales / Instituciones</h1>
			<form name="login_form" id="login_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label for="email">Email:</label>
					<input name="email" required type="email" class="form-control" id="email">
				</div>
				<div class="form-group">
					<label for="pwd">Contraseña:</label>
					<input name="password" required type="password" class="form-control" id="pwd">
				</div>
				<div class="form-group">
					<label for="pwd">Recordarme en este dispositivo</label>
					<input type="checkbox" class="remember_me" name="remember_me" value="yes">
				</div>
				<button type="submit" class="btn btn-default">Ingresar</button>
				<input type="hidden" name="action" value="login" />
			</form>
			<a href="#" class="olvide_password" data-toggle="modal" data-target="#ModalRecuperoPassword" title="Olvidé mi contraseña">Olvidé mi contraseña</a>
			<div class="bloque_acceso_visitantes">
				<h1>Ingreso Pacientes</h1>
				<a href="<?php echo $loginUrl; ?>" title="Ingreso con cuenta de Faceboo">Ingresar con mis datos de Facebook</a>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<h1>Registro</h1>
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
			<h4 class="modal-title">Formulario de registro</h4>
		  </div>
		  <form name="register_form" id="register_form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
			  <div class="modal-body">
				<div class="form-group width50">
					<label for="email">Nombre*</label>
					<input name="nombre" required type="text" class="form-control" <?php if($_SESSION['nombre']){echo 'value="'.$_SESSION['nombre'].'"';}?>>
				</div>
				<div class="form-group width50">
					<label for="email">Apellido (Obligatorio para registro como profesional)</label>
					<input name="apellido" type="text" class="form-control" <?php if($_SESSION['apellido']){echo 'value="'.$_SESSION['apellido'].'"';}?>>
				</div>
				<div class="form-group width50">
					<label for="email">Email:</label>
					<input name="email" required type="email" class="form-control" id="email" <?php if($_SESSION['email']){echo 'value="'.$_SESSION['email'].'"';}?>>
				</div>
				<div class="form-group width50">
					<label for="email">Repita su Email:</label>
					<input name="reemail" required type="email" class="form-control" id="reemail" <?php if($_SESSION['reemail']){echo 'value="'.$_SESSION['reemail'].'"';}?>>
				</div>
				<div class="form-group width50">
					<label for="pwd">Contraseña:</label>
					<input name="password" required type="password" class="form-control" id="pwd">
				</div>
				<div class="form-group width50">
					<label for="pwd">Repita su contraseña:</label>
					<input name="repassword" required type="password" class="form-control" id="rpwd">
				</div>
				<div class="form-group width50">
					<label for="email">Tipo de registro*</label>
					<select name="tipo_registro" class="form-control" required>
						<option value='0'>Seleccionar</option>
						<?php do { ?>
						<option value="<?php echo $row_R_tipo_usuario['id']; ?>" <?php if($_SESSION['tipo_registro'] && $_SESSION['tipo_registro']==$row_R_tipo_usuario['id']){echo ' selected'; }?>><?php echo $row_R_tipo_usuario['tipo_usuario']; ?></option>
						<?php } while ($row_R_tipo_usuario = mysql_fetch_assoc($R_tipo_usuario)); ?>
					</select>
				</div>
			  </div>
			  <div class="modal-footer">			
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-default">Continuar</button>
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