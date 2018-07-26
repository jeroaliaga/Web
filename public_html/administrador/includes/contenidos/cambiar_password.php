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
					<h1 class="page-header">Cambiar contraseña</h1>
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
                            Ingrese su nueva contraseña
                        </div>
							<form id="alta_inmueble" name="alta_inmueble" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
												<div class="form-group">
													<label>Nueva contraseña</label>
													<input name="password" class="form-control" type="password" required>
												</div>
										</div>
										<!-- /.col-lg-6 (nested) -->
										<div class="col-lg-6">
												<div class="form-group">
													<label>Repita la nueva contraseña</label>
													<input name="repassword" class="form-control" type="password" required data-validation-matches-message="Las contraseñas no coinciden" data-validation-matches-match="password" >
												</div>
										</div>
										<!-- /.col-lg-6 (nested) -->
										<div class="col-lg-12">
											<input type='hidden' name="id_usuario_p" value="<?php echo $id_usuario; ?>" />
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