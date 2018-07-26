<?php
	//consultas de la seccion
	
	/*
	mysql_select_db($database_name, $ddbb_naevp);
	$query_R_aaa = "SELECT * from perfiles_usuarios order by perfil ASC";
	$R_aaa = mysql_query($query_R_aaa, $ddbb_naevp) or die(mysql_error());
	$row_R_aaa = mysql_fetch_assoc($R_aaa);
	$totalRows_R_aaa = mysql_num_rows($R_aaa);*/
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
					<h1 class="page-header">Está editando el usuario <?php echo $row_R_list_usuarios['nombre']; ?><?php if($row_R_list_usuarios['apellido']){ echo ' '.$row_R_list_usuarios['apellido']; } ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<?php if($estado_proceso){?>
				<div class="col-lg-12">
					<div class="alert <?php echo $estado_proceso[1]; ?> alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $estado_proceso[0]; ?>
					</div>
				</div>
				<?php } ?>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Modifique los datos y luego presione GUARDAR
                        </div>
							<form id="alta_inmueble" name="alta_inmueble" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
												<div class="form-group">
													<label>Nombre</label>
													<input name="nombre" class="form-control" type="text" value="<?php echo $row_R_list_usuarios['nombre']; ?>" required>
												</div>
												<div class="form-group">
													<label>Apellido</label>
													<input name="apellido" class="form-control" type="text" value="<?php echo $row_R_list_usuarios['apellido']; ?>" required>
												</div>
												<div class="form-group">
													<label>Email</label>
													<input name="email" class="form-control" type="text" value="<?php echo $row_R_list_usuarios['email']; ?>" required>
												</div>
										</div>
										<!-- /.col-lg-6 (nested) -->
										<div class="col-lg-6">
												<div class="form-group">
													<label>Tipo usuario</label>
													<input disabled name="tipo_usuario" class="form-control" type="text" value="<?php echo $row_R_list_usuarios['tipo_usuario_n']; ?>">
												</div>
												<?php if($row_R_list_usuarios['img']){?>
												<div class="form-group">
													<label>Foto de perfil</label>
													<img style="display: block;" src="<?php echo $row_R_list_usuarios['img']; ?>" alt="<?php echo $row_R_list_usuarios['nombre']; ?>" />
												</div>
												<?php } ?>
												<div class="form-group">
													<label>Tipo usuario</label>
													<select class="form-control" name="tipo_usuario">
														<option value="1" <?php if($row_R_list_usuarios['tipo_usuario']=='1'){ echo 'selected'; } ?>>Profesional</option>
														<option value="2" <?php if($row_R_list_usuarios['tipo_usuario']=='2'){ echo 'selected'; } ?>>Institucion</option>
														<option value="3" <?php if($row_R_list_usuarios['tipo_usuario']=='3'){ echo 'selected'; } ?>>Paciente</option>
													</select>
												</div>
												<div class="form-group">
													<label>Estado</label>
													<select class="form-control" name="active">
														<option value="0" <?php if($row_R_list_usuarios['active']=='0'){ echo 'selected'; } ?>>Inactivo</option>
														<option value="1" <?php if($row_R_list_usuarios['active']=='1'){ echo 'selected'; } ?>>Activo</option>
													</select>
												</div>
												
										</div>
										<!-- /.col-lg-6 (nested) -->
										<div class="col-lg-12">
											<input type='hidden' name="id_usuario_save" value="<?php echo $id; ?>" />
											<input type='hidden' name="action" value="DoGuardarPerfil" />
											<input type='submit' name="submit_guardar_password" class="btn btn-primary btn-lg btn-block" value="Guardar" />
										</div>
									</div>
									<!-- /.row (nested) -->
								</div>
							</form>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>