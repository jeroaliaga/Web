<?php if($totalRows_R_notas>0){ ?>
<div class="bloque_notas">
		<div class="container">
			<h1>Notas</h1>
			

<div class="carousel carousel-showmanymoveone slide" id="carouselABC">
  <div class="carousel-inner">
    <?php 
		$nota_number = 0;
		do { 
		$nota_number = $nota_number + 1;
		$mes_num = date("m", strtotime($row_R_notas['hoy_ahora']))-1;
		$dia = date("d", strtotime($row_R_notas['hoy_ahora']));
		
		if($row_R_notas['img']){
			$img_bg_nota = $ruta_raiz.'static/img_publicaciones/'.$row_R_notas['img'];
		} else {
			$img_bg_nota = $default_img_bg_nota;
		}

	?>
		<div class="item <?php if($nota_number==1){ echo 'active'; } ?>">
		  <div class="col-xs-12 col-sm-6 col-md-4 noticia_inicio">
			<div class="noticia_img" style="background: url('<?php echo $img_bg_nota; ?>');background-size: cover;background-position: 70%;">
				<p>Imagen de nota</p>
			</div>
			<div class="cuerpo">
				<div class="date">
					<p><?php echo $dia; ?></p>
					<p><?php echo $meses[$mes_num]; ?></p>
				</div>
				<div class="info">
					<h2><?php echo $row_R_notas['page_title']; ?></h2>
					<div class="contenedor_notas"><?php echo substr(strip_tags($row_R_notas['page_content']), 0, 200); ?>...</div>
				</div>
				<a class='link' href="<?php echo $ruta_raiz; ?>notas/?id=<?php echo $row_R_notas['id']; ?>" title="Leer más">
					Leer más
				</a>
			</div>
		  </div>
		</div>
	<?php } while ($row_R_notas = mysql_fetch_assoc($R_notas)); ?>

  </div>
  <a class="left carousel-control" href="#carouselABC" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
  <a class="right carousel-control" href="#carouselABC" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
</div>


		</div>
	</div>
<?php } ?>