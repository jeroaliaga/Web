<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if($estoy == "notas" || $estoy == "actividades" ||  $estoy == "biblioteca" ||  $estoy == "foros"){?>
		<title>
		<?php 
			if($row_R_publicacion['page_title']){ echo $row_R_publicacion['page_title'].' - '; } 
			echo $page_title;
		?></title>
		<meta name="description" content="<?php echo substr(strip_tags($row_R_publicacion['page_content']),0,140); ?>"/>
	<?php } else { ?>
		<title><?php echo $page_title; ?></title>
		<meta name="description" content="<?php echo $page_content; ?>"/>
	<?php } ?>
	<meta name="keywords" content="<?php echo $page_keywords; ?>"/>
    <meta name="author" content="<?php echo $page_author; ?>">
	<link rel="shortcut icon" href="<?php echo $page_favicon; ?>">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $ruta_raiz; ?>static/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="<?php echo $ruta_raiz; ?>static/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	
	<!--Fuentes-->
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700|Oswald:300,400,700|Mrs+Saint+Delafield" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $ruta_raiz; ?>static/css/font-awesome-4.6.3/css/font-awesome.min.css">
	<?php if($estoy=='inicio'){?>
	<link rel="stylesheet" href="<?php echo $ruta_raiz; ?>static/css/bootstrap3-showmanyslideonecarousel.css">
	<?php } ?>
	
    <!-- Custom styles for this template -->
    <link href="<?php echo $ruta_raiz; ?>static/css/dsh.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo $ruta_raiz; ?>static/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
	
	<link href="<?php echo $ruta_raiz; ?>static/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="<?php echo $ruta_raiz; ?>static/js/fileinput.min.js" type="text/javascript"></script>
	

	<!-- include summernote -->
	<link rel="stylesheet" href="<?php echo $ruta_raiz; ?>static/css/summernote.css">
	
		
	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	
	<script>window.jQuery || document.write('<script src="<?php echo $ruta_raiz; ?>static/js/jquery.min.js"><\/script>')</script>
	<script src="../static/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="<?php echo $ruta_raiz; ?>static/js/ie10-viewport-bug-workaround.js"></script>
	
	<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo $ruta_raiz; ?>static/js/summernote.js"></script>
	<script src="<?php echo $ruta_raiz; ?>static/js/summernote/lang/summernote-es-ES.js"></script>
	
	<script type="text/javascript">
		function showDiv() {
		   document.getElementById('showHideDiv').style.display = "block";
		}
	</script>
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.ciudad_nombre').select2();
		});
	</script>
	
	<?php if($estoy == "notas" || $estoy == "actividades" ||  $estoy == "biblioteca" ||  $estoy == "foros"){?>
		<meta property="og:title" content="<?php if($row_R_publicacion['page_title']){ echo $row_R_publicacion['page_title'].' - '; }?>De Salud Hablamos"/>
		<meta property="og:description" content="<?php echo substr(strip_tags($row_R_publicacion['page_content']),0,140); ?>"/>
		<meta property="og:image" content="<?php echo $ruta_absoluta.'static/img_publicaciones/'.$row_R_publicacion['publicacion_img']; ?>"/>
	<?php } else { ?>
		<meta property="og:title" content="De Salud Hablamos"/>
		<meta property="og:description" content="Desaludhablamos.com ofrece un punto de encuentro entre profesionales, un espacio donde conectarse entre sí y compartir experiencias enriqueciéndose mutuamente."/>
		<meta property="og:image" content="http://www.desaludhablamos.com/static/img/fb_og.jpg"/>
	<?php } ?>
	<meta property="og:url" content="<?php echo $currentUrl; ?>"/>
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="De Salud Hablamos"/>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-96017171-1', 'auto');
	  ga('send', 'pageview');

	</script>
	<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?render=explicit&amp;hl=es"></script>
	<script src="<?php echo $ruta_raiz; ?>static/js/vunit.js"></script>
	<script>
       new vUnit({
            CSSMap: {
                '.vh': {
                    property: 'height',
                    reference: 'vh'
                },
                '.vw': {
                    property: 'width',
                    reference: 'vw'
                },
                '.vwfs': {
                    property: 'font-size',
                    reference: 'vw'
                },
                '.vmin_margin-top': {
                    property: 'margin-top',
                    reference: 'vmin'
                },
                '.vminw': {
                    property: 'width',
                    reference: 'vmin'
                },
                '.vmaxw': {
                    property: 'width',
                    reference: 'vmax'
                }
            }
        }).init();
    </script>
  </head>