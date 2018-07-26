

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo $ruta_raiz; ?>static/js/plugins/metisMenu/metisMenu.min.js"></script>
	
	<!-- Morris Charts JavaScript 
    <script src="<?php echo $ruta_raiz; ?>static/js/plugins/morris/raphael.min.js"></script>
    <script src="<?php echo $ruta_raiz; ?>static/js/plugins/morris/morris.min.js"></script>
    <script src="<?php echo $ruta_raiz; ?>static/js/plugins/morris/morris-data.js"></script>-->

	<!-- DataTables JavaScript -->
    <script src="<?php echo $ruta_raiz; ?>static/js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo $ruta_raiz; ?>static/js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo $ruta_raiz; ?>static/js/sb-admin-2.js"></script>

	<!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>	
	$(document).ready(function() {
		$('#dataTables-example').dataTable( {
			"language": {
				"lengthMenu": "Mostrar _MENU_ resultados por página",
				"zeroRecords": "Nada encontrado",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "Sin resultados",
				"infoFiltered": "(filtrado de _MAX_ resultados)",
				"paginate": {
					"first": "Primera página",
					"next": "Siguiente",
					"last": "Ultima página",
					"previous": "Anterior"
				},
				"search": "Buscar:"
			}
		} );
	} );
    </script>
	
	<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
	<script type="text/javascript">
	$(function() {
		$('input[name="fecha_publicacion"]').daterangepicker({
			singleDatePicker: true,
			showDropdowns: true
		}, 
		function(start, end, label) {
			/*var years = moment().diff(start, 'years');
			alert("You are " + years + " years old.");*/
		});
	});
	</script>
