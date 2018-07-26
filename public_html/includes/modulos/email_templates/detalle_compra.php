<?php
	$id = $_GET['id'];
	$ruta_raiz = "../../../";
	include($ruta_raiz."includes/sitematrix/gral_data.php");
	
	//consulto los datos del comprador
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_comprador = "select * from transacciones where id_transaccion = '$id'";
	$R_comprador = mysql_query($query_R_comprador, $ddbb_naevp) or die(header($error_mysql));
	$row_R_comprador = mysql_fetch_assoc($R_comprador);
	$totalRows_R_comprador = mysql_num_rows($R_comprador);
	
	//consulto los productos comprados
	mysql_select_db($database_name, $ddbb_naevp);
	mysql_query("SET NAMES 'utf8'");
	$query_R_prod = "select * from producto_x_transaccion where id_transaccion = '$id'";
	$R_prod = mysql_query($query_R_prod, $ddbb_naevp) or die(header($error_mysql));
	$row_R_prod = mysql_fetch_assoc($R_prod);
	$totalRows_R_prod = mysql_num_rows($R_prod);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>La Planchetta - Detalles Compra</title>
</head>

<body bgcolor="#f7f7f7" style="margin: 0;width: 100%;">
	<div style="width: 600px;margin: 15px auto;border: 1px solid #ccc;background-color: #fff;padding: 15px;font-family: arial;">
		<div style="text-align: center;">
			<img width="111" height="40" src="http://laplanchetta.com/static/img/logo_dark.png" alt="La Planchetta">
			<h1 style="margin: 0 0 15px 0;">¡Gracias por tu compra!</h1>
		</div>
		
		<div>
			<div style="border: 1px solid #ccc;margin-bottom: 10px;padding: 10px;font-size: 15px;>">
				<strong>Comprador</strong><br />
				<?php echo $row_R_comprador['comp_nombre'].' '.$row_R_comprador['comp_apellido']; ?><br />
				<?php echo '('.$row_R_comprador['comp_tel_cod'].') '.$row_R_comprador['comp_tel_num']; ?><br />
				<?php echo $row_R_comprador['ship_calle'].' '.$row_R_comprador['ship_numero']; ?>
				<?php if($row_R_comprador['ship_piso']){ echo $row_R_comprador['ship_piso'].' '; } ?>
				<?php if($row_R_comprador['ship_depto']){ echo $row_R_comprador['ship_depto'].' '; } ?>
				<?php echo ' ('.$row_R_comprador['ship_cp'].')'; ?><br />
				<?php echo $row_R_comprador['ship_localidad'].', '.$row_R_comprador['ship_provincia']; ?><br />
				<?php echo $row_R_comprador['comp_dni']; ?>
			</div>
			<?php
			if($row_R_comprador['ship_tipo']=='1'){
			?>
			<br /><br />
			<div style="border: 1px solid #ccc;margin-bottom: 10px;padding: 10px;font-size: 15px;>">
				<strong>Datos del Envío</strong><br />
				Utiliza el siguiente número de tracking para saber cuanto falta para que recibas tu planchetta:<br/>
				<strong><?php echo $row_R_comprador['desp_tracking']; ?></strong><br/><br/>
				Podrás consultarlo haciendo click <a href="http://laplanchetta.com/donde-esta-mi-planchetta/" title="Consultar tracking" target="_blank">AQUÍ</a>
			</div>
			<?php } ?>
			<?php
			if($row_R_comprador['ship_tipo']=='0'){
			?>
			<br /><br />
			<div style="border: 1px solid #ccc;margin-bottom: 10px;padding: 10px;font-size: 15px;>">
				<strong>Datos del Envío</strong><br />
				Tu planchetta se te estará entregando en la siguiente fecha y hora:<br/><br/>
				<strong><?php echo date("d/m/Y H:i",strtotime($row_R_comprador['ship_datetime'])); ?> Hs.</strong><br/><br/>
			</div>
			<?php } ?>
			<br /><br />
		</div>
		
		<div style="margin-top: 10px;">
			<table cellpadding="0" cellspacing="0" width="600" class="w320" style="font-size: 15px;">
				<tr>
				  <td class="item-table">
					<table cellspacing="0" cellpadding="0" width="100%">
					  <tr style="height: 50px;">
						<td class="title-dark" width="360" style="border-bottom:1px solid #ccc;">
							<span style="color: #4d4d4d; font-weight:bold;">Producto/s</span>
						</td>
						<td class="title-dark" width="100" style="border-bottom:1px solid #ccc;text-align: right;">
							<span style="color: #4d4d4d; font-weight:bold;">Cantidad</span>
						</td>
						<td class="title-dark" width="100" style="border-bottom:1px solid #ccc;text-align: right;">
							<span style="color: #4d4d4d; font-weight:bold;">Precio</span>
						</td>
					  </tr>


					  <?php do { ?>
					  <tr style="height: 75px;line-height: 15px;">
						<td class="item-col item" style="border-bottom:1px solid #ccc;">
						  <table cellspacing="0" cellpadding="0" width="100%">
							<tr>
								<?php echo $row_R_prod['nombre']; ?>
							</tr>
						  </table>
						</td>
						<td class="item-col" style="border-bottom:1px solid #ccc;text-align: right;">
						<?php echo $row_R_prod['cantidad']; ?>
						</td>
						<td class="item-col" style="border-bottom:1px solid #ccc;text-align: right;">
						$ <?php echo round($row_R_prod['precio'],0); ?>
						</td>
					  </tr>
					  <?php } while ($row_R_prod = mysql_fetch_assoc($R_prod)); ?>

					  <tr>
						<td class="item-col item mobile-row-padding"></td>
						<td class="item-col price"></td>
						<td class="item-col price"></td>
					  </tr>


					  <tr style="height: 75px;line-height: 15px;">
						<td class="item-col quantity" style="text-align:right;">
						</td>
						<td class="item-col quantity" style="text-align:right;">
						  <span class="total-space" style="font-weight: bold; color: #4d4d4d">Total</span>
						</td>
						<td class="item-col price" style="text-align: right;">
						  <span class="total-space" style="font-weight:bold; color: #4d4d4d">$ <?php echo $row_R_comprador['monto']; ?></span>
						</td>
					</table>
				  </td>
				</tr>
			</table>
		</div>
									
		<div>
			<strong>La Planchetta</strong><br />
			Si tiene alguna duda escríbanos a <strong><a href="mailto:info@laplanchetta.com">info@laplanchetta.com</a></strong><br />
			Mensaje generado automáticamente.  No lo responda ya que nadie lo leerá!
		</div>
	</div>
</body>
</html>