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
		
		if($row_R_notas['img']){
			$img_bg_nota = $ruta_raiz.'static/img_publicaciones/'.$row_R_notas['img'];
		} else {
			$img_bg_nota = $default_img_bg_nota;
		}
	?>
		<div class="item <?php if($nota_number==1){ echo 'active'; } ?>">
		  <div class="col-xs-12 col-sm-6 col-md-4 noticia_inicio">
			<div class="noticia_inicio_img" style="background: url('<?php echo $img_bg_nota; ?>');background-size: cover;background-position: 50%;">
			</div>
			<div class="noticia_inicio_cuerpo">
				<div class="date">
					<span><?php echo date("d", strtotime($row_R_notas['hoy_ahora'])); ?></span>
					<p><?php echo $meses[$mes_num]; ?></p>
				</div>
				<div class="bloque_info">
					<h2><?php echo $row_R_notas['page_title']; ?></h2>
					<div class="contenedor_notas"><?php echo substr(strip_tags($row_R_notas['page_content']), 0, 200); ?>...</div>
				</div>
				<div class="bloque_link">
					<!--<i class="fa fa-tag" aria-hidden="true"></i>
					<p><?php echo $row_R_notas['tags']; ?></p>-->
					<a href="<?php echo $ruta_raiz; ?>notas/?id=<?php echo $row_R_notas['id']; ?>" title="Leer mas">
						Leer mas <i class="fa fa-angle-right" aria-hidden="true"></i>
					</a>
				</div>
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