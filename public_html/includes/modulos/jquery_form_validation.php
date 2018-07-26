<script src="<?php echo $ruta_raiz; ?>static/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $ruta_raiz; ?>static/js/jquery.validate.js"></script>
	
	<script>
	$().ready(function() {

	$("#customForm").validate({
		rules: {
			email: {
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength: 5
			},
			repassword: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},

			dp_saludo: "required",
			dp_nombre: "required",
			dp_apellido_paterno: "required",
			dp_domicilio: "required",
			dp_ciudad: "required",
			dp_pais: "required",
			dp_estado: "required",
			dp_telefono: "required",
			dp_telefono_movil: "required",

			dl_lugar_de_trabajo: "required",
			dl_detalle_lugar_de_trabajo: {
				  required: function(element) {
					return $("#dl_lugar_de_trabajo").val() =="Otro"
				  }
			},			
			dl_funcion: "required"
		},
		messages: {
			email: "Por favor ingrese una dirección de email válida",
			password: {
				required: "Por favor ingrese una contraseña.",
				minlength: "Su contraseña debe ser al menos de 5 caracteres."
			},
			repassword: {
				required: "Por favor retipee su contraseña.",
				minlength: "Su contraseña debe ser al menos de 5 caracteres.",
				equalTo: "No coincide con la ingresada en el campo anterior."
			},
			dp_saludo: "Por favor complete este campo.",
			dp_nombre: "Por favor complete este campo.",
			dp_apellido_paterno: "Por favor complete este campo.",
			dp_apellido_materno: "Por favor complete este campo.",
			dp_domicilio: "Por favor complete este campo.",
			dp_ciudad: "Por favor complete este campo.",
			dp_pais: "Por favor complete este campo.",
			dp_estado: "Por favor complete este campo.",
			dp_telefono: "Por favor complete este campo.",
			dp_telefono_movil: "Por favor complete este campo.",

			dl_lugar_de_trabajo: "Por favor complete este campo.",
			dl_detalle_lugar_de_trabajo: "Por favor complete este campo.",
			dl_funcion: "Por favor complete este campo."
		}
	});

});
</script>