<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Suscriptores</h1>
		</div>
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<ul>
				<?php do { ?>
				<li><?php echo $row_R_list_publicaciones['mail']; ?></li>
				<?php } while ($row_R_list_publicaciones = mysql_fetch_assoc($R_list_publicaciones)); ?>
			</ul>
		</div>
	</div>
</div>