<?php
	$servicio="http://webservice.oca.com.ar/oep_tracking/Oep_Track.asmx?WSDL"; //url del servicio
	
	$params = array('PesoTotal' => '50',
	'VolumenTotal' => '0.027',
	'CodigoPostalDestino' => '1005487',
	'CodigoPostalOrigen' => '7600',
	'CantidadPaquetes' => '1',
	'Cuit' => '30-69257726-0',
	'Operativa' => '251876'); 
	
	$client = new SoapClient($servicio, array('trace' => true));
	
	$response = $client->Tarifar_Envio_Corporativo($params);
	$requestAsString = $client->__getLastRequest();
	$responseAsString = $client->__getLastResponse();
	
	$doc = new DOMDocument();
	$doc->loadXML($responseAsString);
	$Tarifador = $doc->getElementsByTagName('Tarifador')->item(0)->nodeValue;
	$Precio = $doc->getElementsByTagName('Precio')->item(0)->nodeValue;
	$idTiposervicio = $doc->getElementsByTagName('idTiposervicio')->item(0)->nodeValue;
	$Ambito = $doc->getElementsByTagName('Ambito')->item(0)->nodeValue;
	$PlazoEntrega = $doc->getElementsByTagName('PlazoEntrega')->item(0)->nodeValue;
	$Adicional = $doc->getElementsByTagName('Adicional')->item(0)->nodeValue;
	$Total = $doc->getElementsByTagName('Total')->item(0)->nodeValue;
	
	echo $Tarifador.' es el tarifador<br/>';
	echo $Precio.' es el precio<br/>';
	echo $idTiposervicio.' es el id del servicio<br/>';
	echo $Ambito.' es el ambito<br/>';
	echo $PlazoEntrega.' es el plazo de entrega<br/>';
	echo $Adicional.' es el adicional<br/>';
	echo $Total.' es el total<br/>';
?>