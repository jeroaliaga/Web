<?php
	$idProfesional = $_GET['id'];	
?>
	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Califica al profesional</h4>
		</div>
		<div class="modal-body">
			<p>Utilice el siguiente formulario para calificar al profesional</p>
			<?php
				$array_calificaciones = array(
					array('Calidez y empatia',1),
					array('Capacidad de escucha',1),
					array('Dominio de la especialidad',1),
					array('Instalaciones',1)
				);
				foreach($array_calificaciones as $calif){
			?>
			<div class="form-group">
				<label for="exampleInputEmail1"><?php echo $calif[0]; ?></label>
				<div class="form-group">
					<select name="calificacion[]" class="form-control" required>
						<option value="">Seleccione su calificación</option>
						<option value="1">Mala</option>
						<option value="2">Regular</option>
						<option value="3">Buena</option>
						<option value="4">Muy buena</option>
						<option value="5">Excelente</option>
					</select>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-default" >Calificar</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<input type="hidden" name="action" value="DoCalificarProfesionalAction" />
			<input type="hidden" name="idProfesional" value="<?php echo $idProfesional; ?>" />
		</div>
	</form>