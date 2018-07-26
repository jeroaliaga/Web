<div class='contGallery' class="vh100">
	<div class='contImgs'>
		<div>
			<h2>Un espacio de integración entre pacientes y profesionales</h2>
		</div><div>
			<h2>Un espacio de integración entre pacientes y profesionales 2</h2>
		</div><div>
			<h2>Un espacio de integración entre pacientes y profesionales 3</h2>
		</div>
	</div>
	<div class="otherGallery">
		<div>
			<span>-</span><p>La salud cerca tuyo</p><span>-</span>
		</div>
		<a href="../login" class='login'>Registrarse / Ingresar</a>
		<ul class="ulGallery">
			<li><a href="javascript:void(0)" class="selected">1</a></li><li><a href="javascript:void(0)">2</a></li><li><a href="javascript:void(0)">3</a></li>
		</ul>
	</div>
</div>
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
</div>
<div class="tres_botones_inicio">
	<div class="container">
		<ul>
			<li>
				<div><img src="../static/img/icons/search.png" alt="Busca un especialista" /></div>
				<span>Buscá un especialista</span>
			</li><li>
				<div><img src="../static/img/icons/user.png" alt="Encontrá el profesional que mejor se adapte a tus necesidades" /></div>
				<span class="middle">Encontrá tu profesional</span>
			</li><li>
				<div><img src="../static/img/icons/devices.png" alt="Contactate" /></div>
				<span>Contactate</span>
			</li>
		</ul>
	</div>
</div>
<div class='sumate'>
	<h2>Sumate</h2>
	<div class='cont'>
		<div>
			<h3>Sos paciente</h3>
			<ul>
				<li>
					<img src="../static/img/icons/clock.png" alt="Reloj">
					<p>Ahorrá tiempo</p>
				</li>
				<li>
					<img src="../static/img/icons/megusta.png" alt="Me gusta">
					<p>Buscá profesionales con confianza: revisa perfiles verificados y recomendaciones de otros pacientes</p>
				</li>
				<li>
					<img src="../static/img/icons/heart.png" alt="Corazón">
					<p>Elegí en base a tus necesidades</p>
				</li>
				<li>
					<img src="../static/img/icons/cross.png" alt="Salud">
					<p>Informate sobre temas de salud de tu interés</p>
				</li>
				<li>
					<img src="../static/img/icons/paper.png" alt="Favoritos">
					<p>Armá tu agenda de favoritos</p>
				</li>
				<li>
					<img src="../static/img/icons/comment.png" alt="Compartí experiencias">
					<p>Compartí tus experiencias</p>
				</li>
			</ul>
		</div><div>
			<h3>Sos profesional</h3>
			<ul>
				<li>
					<img src="../static/img/icons/user2.png" alt="Usuario">
					<p>Date a conocer de forma rápida y fácil: detallá tu perfil para captar nuevos pacientes</p>
				</li>
				<li>
					<img src="../static/img/icons/2users.png" alt="Contactos">
					<p>Conectate con otros profesionales: derivá con confianza y arma tu agenda de contactos</p>
				</li>
				<li>
					<img src="../static/img/icons/volume.png" alt="Publicar">
					<p>Compartí tus actividades: publicá tus notas, talleres y cursos para ganar mayor visibilidad</p>
				</li>
				<li>
					<img src="../static/img/icons/2papers.png" alt="Material académico">
					<p>Accedé a material académico de tu interés</p>
				</li>
				<li>
					<img src="../static/img/icons/share.png" alt="Compartí experiencias">
					<p>Armá grupos de supervisión y compartí tus experiencias</p>
				</li>
			</ul>
		</div>
	</div>
</div>