<div class="suscripcion">
	<div class="container">
		<h3>Suscribite</h3>
		<p>Recibí todas las novedades en tu correo</p>
		<form name="login_newsletter" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF']; ?>">
			<input name="news_nombre" placeholder="Nombre" type="text" required />
			<input name="news_email" placeholder="E-mail" type="emai" required />
			<button type="submit" ><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
			<input type="hidden" name="action" value="DoRegisterNewsletter" />
		</form>
	</div>
</div>
<!-- Modal -->
<div id="ModalNewsletter" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Suscripción al newsletter</h4>
      </div>
      <div class="modal-body">
        <p><?php echo $estado_suscripcion; ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>