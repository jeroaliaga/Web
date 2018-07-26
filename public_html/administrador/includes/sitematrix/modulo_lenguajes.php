<?php
	///de manera predeterminada toma pred.php
		$lang = $_COOKIE['lang'];
	} else {
		$lang = "1";
	}

	if ($lang==1){
	include($ruta_raiz."includes/lang/pred.php"); //pred.php
	}
	else { 
	if ($lang==2){
	include($ruta_raiz."includes/lang/eng.php");
	} else {
	include($ruta_raiz."includes/lang/por.php");
	}
	}
?>
<script>
function iLoveCookies1(){
days=30; // numero de dias que mantendra la cookie
myDate = new Date();
myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
document.cookie = 'lang=1; expires=' + myDate.toGMTString();//castellano
}

function iLoveCookies2(){
days=30; // numero de dias que mantendra la cookie
myDate = new Date();
myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
document.cookie = 'lang=2; expires=' + myDate.toGMTString();//english
}

function iLoveCookies3(){
days=30; // numero de dias que mantendra la cookie
myDate = new Date();
myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
document.cookie = 'lang=3; expires=' + myDate.toGMTString();//portugues
}
</script>