<?php
	$idProfesional = $_GET['id'];	
	$ruta_raiz = "../../";
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	//Obtengo los datos del profesional
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_user_email = "select * from users where id = '$idProfesional' and active = 1 and tipo_usuario IN (1,2)";
	$R_user_email = mysql_query($query_R_user_email, $ddbb_naevp) or die(header($error_mysql));
	$row_R_user_email = mysql_fetch_assoc($R_user_email);
	$totalRows_R_user_email = mysql_num_rows($R_user_email);
	if($totalRows_R_user_email==0){
?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title">Contactar al profesional</h4>
	</div>
	<div class="modal-body">
		<p>El perfil del profesional ya no existe.</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div>
<?php } else { ?>
	<form id="contactform" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Contactar al profesional</h4>
		</div>
		<div class="modal-body">
			<p>Utilice el siguiente formulario para enviarle un mensaje al profesional.</p>
			<div class="form-group">
				<label for="exampleInputEmail1">Tu nombre</label>
				<input type="text" class="form-control" name="nombre_origen" placeholder="Escribe tu nombre" required>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Tu email</label>
				<input type="email" class="form-control" name="email_origen" placeholder="Escribe tu email" required>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Tu teléfono (Optativo)</label>
				<input type="text" class="form-control" name="telefono_origen" placeholder="Escribe tu teléfono con el código de área">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Mensaje o Consulta</label>
				<textarea class="form-control" name="mensaje" placeholder="Escribe aquí tu mensaje o consulta"></textarea>
			</div>
			<!--<div class="form-group">
				<label for="exampleInputEmail1">Demuéstranos que no eres un robot.  </label>
				<div id="captcha2"></div>
			</div>-->
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-default" >Enviar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<input type="hidden" name="email_destino" value="<?php echo $row_R_user_email['email']; ?>" />
			<input type="hidden" name="action" value="DoContactarProfesionalAction" />
		</div>
	</form>
<?php } ?>
