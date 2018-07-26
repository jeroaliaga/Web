<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
ini_set('memory_limit', '1024M'); // or you could use 1G
$hoy = date('Y-m-d');
$anio = date('Y');
$ahora = date("H:i:s");
$numero_dia = date("N");

/// datos para conectar la ddbb
$hostname_ddbb = "localhost";
$database_name = "desaludhablemos";
$username_ddbb = "uv027484_naevp";
$password_user = "6eLAkaKESX";
$ddbb_naevp = mysql_pconnect($hostname_ddbb, $username_ddbb, $password_user) or trigger_error(mysql_error(),E_USER_ERROR);	

//Sistem configuration
$img_logo = array('logo.png','De Salud Hablamos','190','150'); //filename, title, height, width
$panel_name = 'CMS De Salud Hablamos';
$panel_url = 'http://desaludhablamos.com/administrador/';
$sitio_url = 'http://desaludhablamos.com/';
$directorio_imagen_user = $ruta_raiz.'../beta/static/img_productos/';

$normalizeChars = array(
    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
    'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
    'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
    'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T', ' '=>'_',
);
//Output: E A I A I A I A I C O E O E O E O O e U e U i U i U o Y o a u a y c
//echo strtr($string, $normalizeChars);

$array_secciones = array(
	array("id" => 1, "name" => "Notas"),
	array("id" => 7, "name" => "Actividades", "grupos" => array(
		array("id" => 4, "name" => "Seminario"),
		array("id" => 3, "name" => "Taller"),
		array("id" => 2, "name" => "Curso")
	)),
	array("id" => 5, "name" => "Biblioteca", "grupos" => array(
		array("id" => 8, "name" => "Cuestionario"),
		array("id" => 9, "name" => "Test"),
		array("id" => 10, "name" => "Libro")
	)),
	array("id" => 6, "name" => "Foros")
);

function normaliza ($cadena){
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    return utf8_encode($cadena);
}
?>