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
		
		echo $celda_a."<br>";
}


///si no cumple con la validacion del archivo aca creo la variable con el error.
} else {
$error = "1";
}
?>