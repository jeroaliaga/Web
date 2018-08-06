<?php
//date_default_timezone_set('America/Argentina/Buenos_Aires');
$hoy = date('Y-m-d');
$anio = date('Y');
$mes = date('m');
$ahora = date("H:i:s");
$numero_dia = date("N");
$hoy_y_ahora = date("Y-m-d H:i:s");
$hoy_ahora_epoch = strtotime($hoy_y_ahora);
$meses = array('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
error_reporting(0);
$ruta_absoluta = 'http://www.desaludhablamos.com/';

$nombre_cliente = 'De Salud Hablamos';

/*Emails*/
$destinatario_contact_form = 'info@desaludhablamos.com';
//$destinatario_contact_form = 'lucianomdq@gmail.com';

/// datos para conectar la ddbb
$hostname_ddbb = "localhost";
$database_name = "desaludhablemos";
$username_ddbb = "uv027484_naevp";
$password_user = "6eLAkaKESX";
$ddbb_naevp = mysql_pconnect($hostname_ddbb, $username_ddbb, $password_user) or trigger_error(mysql_error(),E_USER_ERROR);

$rs_facebook = 'https://www.facebook.com/Desaludhablamos/';
$rs_twitter = '';
$rs_linkedin = '';

$default_user_image = $ruta_absoluta.'static/img/default-user-image.png';
$default_img_bg_nota = 'http://www.desaludhablamos.com/static/img/fb_og.jpg';

$protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === 
FALSE ? 'http' : 'https';            // Get protocol HTTP/HTTPS
$host     = $_SERVER['HTTP_HOST'];   // Get  www.domain.com
$script   = $_SERVER['SCRIPT_NAME']; // Get folder/file.php
$params   = $_SERVER['QUERY_STRING'];// Get Parameters occupation=odesk&name=ashik

$currentUrl = $protocol . '://' . $host . $script . '?' . $params; // Adding all;

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

//Google Recaptcha
$clave_sitio = '6LfoRS0UAAAAAID2BwUGrhS14EasVQPy3H4QeJsr';
$clave_secreta = '6LfoRS0UAAAAABJbDM10YAFjxPo_KRGJkANHmA42';
?>