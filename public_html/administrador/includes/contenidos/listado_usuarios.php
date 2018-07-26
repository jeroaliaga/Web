<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Usuarios</h1>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Email</th>
						<th>Tipo Usuario</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php do { ?>					
					<tr>
						<td><?php echo $row_R_list_usuarios['nombre']; ?></td>
						<td><?php echo $row_R_list_usuarios['apellido']; ?></td>
						<td><?php echo $row_R_list_usuarios['email']; ?></td>
						<td class="center"><?php echo $row_R_list_usuarios['tipo_usuario_n']; ?></td>
						<td class="center"><?php if($row_R_list_usuarios['tipo_usuario']!=3){ echo '<a href="'.$ruta_raiz.'editar_usuario.php?id='.$row_R_list_usuarios['id'].'" title="Editar">Editar</a> | <a href="'.$ruta_raiz.'eliminar_usuario.php?id='.$row_R_list_usuarios['id'].'" title="Eliminar">Eliminar</a>'; } ?></td>
					</tr>
					<?php } while ($row_R_list_usuarios = mysql_fetch_assoc($R_list_usuarios)); ?>
				</tbody>
			</table>
		</div>
	</div>
</div>