<?php 
//Chequeo que el archivo sea el correcto
$celda_g3_check = mysql_real_escape_string($data->sheets[0]['cells'][3][7]);
$celda_j3_check = mysql_real_escape_string($data->sheets[0]['cells'][3][10]);
$celda_l3_check = mysql_real_escape_string($data->sheets[0]['cells'][3][12]);

if($celda_g3_check=="Marca" && $celda_j3_check=="Costo" && $celda_l3_check=="Margen"){

	///Comienzo a procesar los jugadores a partir de la fila 4
	for($i=4;$i<=5000;$i++){
		
		$id_producto = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][2]));
		$nombre = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][5]));
		$rango_precio = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][8]));
		$precio = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][9]));
		$costo = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][10]));
		$costo_siva = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][11]));
		$margen = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][12]));
		$margen_porcentaje = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][13]));
		$active = trim(mysql_real_escape_string($data->sheets[0]['cells'][$i][14]));
					
		///consulto si el producto existe y en tal caso lo actualizo
		mysql_select_db($database_name, $ddbb_naevp);
		$query_R_aaa = "SELECT * from productos WHERE id = '$id_producto'";
		$R_aaa = mysql_query($query_R_aaa, $ddbb_naevp) or die(mysql_error());
		$row_R_aaa = mysql_fetch_assoc($R_aaa);
		$totalRows_R_aaa = mysql_num_rows($R_aaa);
		
		if($totalRows_R_aaa>0){
		///aca actualizo
		mysql_select_db($database_name, $ddbb_naevp);
			$sql="UPDATE productos SET precio = '$precio', 
			active = '$active', 
			costo = '$costo', 
			costo_siva = '$costo_siva', 
			margen = '$margen', 
			margen_porcentaje = '$margen_porcentaje' 
			WHERE id = '$id_producto'; ";
			mysql_query($sql);
		}
	}
	$estado_proceso = array('Archivo procesado correctamente.', 'alert-success'); //mensaje del alerta, tipo de alerta
	
} else {
	$estado_proceso = array('El archivo seleccionado tiene una configuracion interna incorrecta.  Por favor revise y vuelva a intentarlo.', 'alert-warning'); //mensaje del alerta, tipo de alerta
}
?>