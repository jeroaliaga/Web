<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
	$(function() {
		$('input[name="fecha_nacimiento"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end, label) {
			/*var years = moment().diff(start, 'years');
			alert("You are " + years + " years old.");*/
		});
	});
	
	//hago que el campo MATRICULA sea obligatorio para las especialidades:
	/*Medicina todas las ramas (psiquiatra, clinico, neurologo, pediatra, homeopata)
	Psicologia
	Nutrición
	Kinesiologos
	Fonaudiologos
	Psicopedagogos
	Trabajador Social
	Terapista Ocupacional*/
	$('.checkbox_especialidades').change(function() {
		//document.getElementById("envio_cp_ci").required = false;
		//alert ( $(this).val() );
		$(".checkbox_especialidades:checked").each(function(){
			//yourArray.push($(this).val());
			var EspMatOb = ["12","11","14","13","50","8","47","5","25","26","27","51","52","29","30","31","32","33","34","35","36","37","38","39","40","41","42","43","44"]; //Cardiologo, Clinico, Neurologo, Pediatria, Homeopata, Nutricion, Psicopedagogía, Kinesiologos, Fonaudiologos, Enfermeros, Trabajador Social, Terapista Ocupacional
			var arraycontainsturtles = (EspMatOb.indexOf($(this).val()) > -1);
			if(arraycontainsturtles){
				document.getElementById("matricula").required = true;
				return false;
			} else {
				document.getElementById("matricula").required = false;
			}
		});
	});
</script>

<?php if($estado_suscripcion){?>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#ModalNewsletter').modal('show');
    });
</script>
<?php } ?>

<?php if($estoy=='inicio'){?>
<script src='<?php echo $ruta_raiz; ?>static/js/bootstrap3-showmanyslideonecarousel.min.js'></script>
<script>
(function(){
  $('#carouselABC').carousel({ interval: 3600 });
}());
</script>
<script type="text/javascript">
    $(document).ready(function() {
		//$("#element-to-animate").addClass("animation"); 
		$(".select2-selection__rendered").css("text-align","left");
    });
   </script>
<?php } ?>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58e95a46d5510523"></script>
	