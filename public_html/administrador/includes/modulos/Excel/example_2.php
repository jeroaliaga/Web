<?php
ini_set('max_execution_time',9000); //tiempo limite de ejecucion de un escript en segundos.
ini_set("memory_limit","1900M"); // aumentamos la memoria a 1,9GB
ini_set("buffering ","0"); // desactivando el buffer a salida estandar
ob_start();

require_once('../Connections/sap_naevp.php'); 

require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');

///identifico el archivo
$data->read('A1_B1_Request_and_Claim_status_2011.08.04.xls');

error_reporting(E_ALL ^ E_NOTICE);
$rows = count($data->sheets[0]['cells']);

///aca levanto la celda A1 (encabezado) y lo voy a utilizar para comparar con algun otro valor de manera que pueda
///corroborar si el archivo es el indicado
$celda_a1 = mysql_escape_string($data->sheets[0]['cells'][1][1]);

///aca hago la comparacion.  Si esta ok sigo sino creo la variable con el error.
if($celda_a1=="Region"){

//Hago un for comenzando desde la fila 2, ya que la primera tiene el encabezado
for($i=2;$i<=$rows;$i++){
		///Tomo la columna Region y reviso si los datos estan actualizados
		$celda_a = mysql_escape_string($data->sheets[0]['cells'][$i][1]);
		
		mysql_select_db($database_sap_naevp, $sap_naevp); 
		$query_R_a ="SELECT * from partner_region where region_name = '$celda_a' and id_region_father = 0"; 
		$R_a = mysql_query($query_R_a, $sap_naevp) or die(mysql_error()); 
		$row_R_a = mysql_fetch_assoc($R_a); 
		$totalRows_R_a = mysql_num_rows($R_a); 

		if($totalRows_R_a == "0") {
		mysql_select_db($database_sap_naevp, $sap_naevp);
  		$sql="INSERT INTO partner_region (id_region, region_name, id_region_father) VALUES (NULL, '$celda_a', '0');";
		mysql_query($sql);
		}
}
//Vuelvo a hacer un for comenzando desde la fila 2, ya que la primera tiene el encabezado
//Esta vez para revisar los datos de la tabla partner_region utilizando la columna market unit (B)
for($i=2;$i<=$rows;$i++){
		///Tomo la columna Market Unit y reviso si los datos estan actualizados
		$celda_a = mysql_escape_string($data->sheets[0]['cells'][$i][1]);
		$celda_b_ex = mysql_escape_string($data->sheets[0]['cells'][$i][2]);
		
		if($celda_b_ex == "ANDINE" || $celda_b_ex == "SUR"){
		$celda_b = "SSSA";
		} else {
		$celda_b = $celda_b_ex;
		}
		
		mysql_select_db($database_sap_naevp, $sap_naevp); 
		$query_R_b ="SELECT * from partner_region where region_name = '$celda_b' and id_region_father not in (0)"; 
		$R_b = mysql_query($query_R_b, $sap_naevp) or die(mysql_error()); 
		$row_R_b = mysql_fetch_assoc($R_b); 
		$totalRows_R_b = mysql_num_rows($R_b); 
		
		$id_region = $row_R_b['id_region'];

		if($totalRows_R_b == "0") {
		
		//consulto la base de datos para tomar el id_region_father
		mysql_select_db($database_sap_naevp, $sap_naevp); 
		$query_R_1 ="SELECT * from partner_region where region_name = '$celda_a' and id_region_father = '0'"; 
		$R_1 = mysql_query($query_R_1, $sap_naevp) or die(mysql_error()); 
		$row_R_1 = mysql_fetch_assoc($R_1); 
		$totalRows_R_1 = mysql_num_rows($R_1); 
		
		$id_region_father = $row_R_1['id_region'];
		
		//Inserto la region si es que no la encontro
		mysql_select_db($database_sap_naevp, $sap_naevp);
  		$sql="INSERT INTO partner_region (id_region, region_name, id_region_father) VALUES (NULL, '$celda_b', '$id_region_father');";
		mysql_query($sql);
		} else {
		
		//consulto la base de datos para tomar el id_region_father
		mysql_select_db($database_sap_naevp, $sap_naevp); 
		$query_R_1 ="SELECT * from partner_region where region_name = '$celda_a' and id_region_father = 0"; 
		$R_1 = mysql_query($query_R_1, $sap_naevp) or die(mysql_error()); 
		$row_R_1 = mysql_fetch_assoc($R_1); 
		$totalRows_R_1 = mysql_num_rows($R_1); 
		
		$id_region_father = $row_R_1['id_region'];
		
		//Actualizo la region si la encontro.
		mysql_select_db($database_sap_naevp, $sap_naevp);
  		$sql="UPDATE partner_region SET region_name = '$celda_b', id_region_father = '$id_region_father' WHERE id_region = '$id_region';";
		mysql_query($sql);
		
		}
}

//Vuelvo a hacer un for comenzando desde la fila 2, ya que la primera tiene el encabezado
//Esta vez para revisar los datos de la tabla partner_country utilizando la columna Country Name (C)
for($i=2;$i<=$rows;$i++){
		///Tomo la columna Market Unit y reviso si los datos estan actualizados
		$celda_b_ex = mysql_escape_string($data->sheets[0]['cells'][$i][2]);
		$celda_c = mysql_escape_string($data->sheets[0]['cells'][$i][3]);
		
		if($celda_b_ex == "ANDINE" || $celda_b_ex == "SUR"){
		$celda_b = "SSSA";
		} else {
		$celda_b = $celda_b_ex;
		}
		
		mysql_select_db($database_sap_naevp, $sap_naevp); 
		$query_R_c ="SELECT * from partner_country where country_name = '$celda_c'"; 
		$R_c = mysql_query($query_R_c, $sap_naevp) or die(mysql_error()); 
		$row_R_c = mysql_fetch_assoc($R_c); 
		$totalRows_R_c = mysql_num_rows($R_c); 
		
		$id_country = $row_R_c['id_country'];
		
		mysql_select_db($database_sap_naevp, $sap_naevp); 
		$query_R_1 ="SELECT * from partner_region where region_name = '$celda_b'"; 
		$R_1 = mysql_query($query_R_1, $sap_naevp) or die(mysql_error()); 
		$row_R_1 = mysql_fetch_assoc($R_1); 
		$totalRows_R_1 = mysql_num_rows($R_1); 
		
		$id_region = $row_R_1['id_region'];
		
		//actualizo el campo id_region en la tabla partner_country
		
		mysql_select_db($database_sap_naevp, $sap_naevp);
  		$sql="UPDATE partner_country SET id_region = '$id_region', country_name = '$celda_c' WHERE id_country = '$id_country';";
		mysql_query($sql);
}

//Vuelvo a hacer un for comenzando desde la fila 2, ya que la primera tiene el encabezado
//Esta vez para revisar los datos de la tabla activity_status_prm utilizando la columna Current Request / Claim Status (K)
for($i=2;$i<=$rows;$i++){
		///Tomo la columna Current Request / Claim Status y reviso si los datos estan actualizados
		$celda_k = mysql_escape_string($data->sheets[0]['cells'][$i][11]);
		
		mysql_select_db($database_sap_naevp, $sap_naevp); 
		$query_R_k ="SELECT * from activity_status_prm where status_prm_name = '$celda_k'"; 
		$R_k = mysql_query($query_R_k, $sap_naevp) or die(mysql_error()); 
		$row_R_k = mysql_fetch_assoc($R_k); 
		$totalRows_R_k = mysql_num_rows($R_k); 
		
		if($totalRows_R_k == "0") {		
		mysql_select_db($database_sap_naevp, $sap_naevp);
  		$sql="INSERT INTO activity_status_prm (id_status_prm, status_prm_name) VALUES (NULL, '$celda_k');";
		mysql_query($sql);
		}
}

//Vuelvo a hacer un for comenzando desde la fila 2, ya que la primera tiene el encabezado
//Esta vez para revisar los datos de la tabla activity_main_act utilizando la columna Activity Type (G)
for($i=2;$i<=$rows;$i++){
		///Tomo la columna Activity Type y reviso si los datos estan actualizados
		$celda_g = mysql_escape_string($data->sheets[0]['cells'][$i][7]);
		
		mysql_select_db($database_sap_naevp, $sap_naevp); 
		$query_R_g ="SELECT * from activity_main_act where main_activity_name = '$celda_g'"; 
		$R_g = mysql_query($query_R_g, $sap_naevp) or die(mysql_error()); 
		$row_R_g = mysql_fetch_assoc($R_g); 
		$totalRows_R_g = mysql_num_rows($R_g); 
		
		$main_activity_event_box = "";
		$main_activity_description = "";

		if($totalRows_R_g == "0") {		
		mysql_select_db($database_sap_naevp, $sap_naevp);
  		$sql="INSERT INTO activity_main_act (id_main_activity, main_activity_name, main_activity_description, main_activity_event_box) VALUES (NULL, '$celda_g', '$main_activity_description', '$main_activity_event_box');";
		mysql_query($sql);
		}
}

///si no cumple con la validacion del archivo aca creo la variable con el error.
} else {
$error = "1";
}
?>