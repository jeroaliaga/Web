<?php
	//consultas para obtener los proveedores
	/*mysql_select_db($database_name, $ddbb_naevp);
	$query_R_aaa = "SELECT * FROM proveedores order by nombre asc";
	$R_aaa = mysql_query($query_R_aaa, $ddbb_naevp) or die(mysql_error());
	$row_R_aaa = mysql_fetch_assoc($R_aaa);
	$totalRows_R_aaa = mysql_num_rows($R_aaa);*/
?>
<div id="page-wrapper">
	<!--
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Nuevo regalo</h1>
		</div>
	</div>
	-->
	<div class="row">
		<?php if($estado_proceso){?>
		<div class="col-lg-12 margin-top-20">
			<div class="alert <?php echo $estado_proceso[1]; ?> alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<?php echo $estado_proceso[0]; ?>
			</div>
		</div>
		<?php } ?>
		<div class="col-lg-12">

			<form id="nuevo_regalo" name="nuevo_regalo" enctype="multipart/form-data" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
				<div class="row">
					<h1 class="page-header">Ingrese el nombre de la nueva marca</h1>
				</div>
				<div class='col-md-6 col-xs-12'>
					<div class="form-group">
						<label>Nombre</label>
						<input name="cat_nombre" <?php if(isset($_SESSION['cat_nombre'])){ echo 'value="'.$_SESSION['cat_nombre'].'"'; } ?> class="form-control" required>
					</div>
				</div>
				
				<div class='col-md-6 col-xs-12'>
					<div class="form-group">
						<label>Proveedor</label>
						<select name="id_proveedor" class="form-control" required>
							<option value="" >Seleccione</option>
							<?php do { ?>
							<option value="<?php echo $row_R_aaa['id']; ?>" <?php if(isset($_SESSION['id_proveedor']) && $_SESSION['id_proveedor']==$row_R_aaa['id']){ echo ' selected'; } ?> ><?php echo $row_R_aaa['nombre']; ?></option>
							<?php } while ($row_R_aaa = mysql_fetch_assoc($R_aaa)); ?>
						</select>
					</div>
				</div>
				
				<div class='col-md-12'>
					<input type="hidden" name="action" value="nueva_marca" />
					<input type='submit' id="submit_btn" name="submit_crear" class="btn btn-primary btn-lg btn-block" value="Crear" style="margin-bottom: 30px;"/>
				</div>
			</form>

		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
</div>
<!-- /#page-wrapper -->