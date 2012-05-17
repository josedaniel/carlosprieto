<?php 
	/*SEARCH WIDGET
	 ***********************************************************/ 
?>
<div class="widget search">
	<?php 
		if(isset($_GET['s']) && $_GET['s'] != ''){
			$value = 'value="'.$_GET['s'].'"';
		}else{
			$value = 'value=""';
		}
	?>
	<form method="get" role="search" id="searchform" action="http://carlosprieto.net">
		<input type="text" name="s" id="s" <?= $value; ?> placeholder="Buscar..." />
	</form>
</div>




<?php 
	/*GALLERY WIDGET
	 ***********************************************************/ 
	if($_SERVER['HTTP_HOST'] == 'carlosprieto.josepaternina.dev'){
		$gallery_cat = 6;	
	}else{
		$gallery_cat = 4262;
	}

	$images_args = array('category' => $gallery_cat, 'post_status' => 'publish', 'orderby'=>'rand');
	$gallery_qty = get_posts($images_args);
	$src =  wp_get_attachment_image_src(get_post_thumbnail_id($gallery_qty[0]->ID),'full');
?>
<div class="widget imagenes">
	<h4>Galería de Imágenes</h4>
	<div class="img_container">
		<div class="img_top">
			<img src="http://carlosprieto.net/wp-content/themes/carlosprieto/img/galeria_top_bg_a.png" />
		</div>
		<div class="img_placeholder">
			<img id="img_show_images" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?= $src[0] ?>&amp;w=311" />
		</div>
		<div class="img_bottom">
			<img src="http://carlosprieto.net/wp-content/themes/carlosprieto/img/galeria_bottom_bg.png" />
		</div>
	</div>
	<a href="#show_images" id="link_show_images">Ver todas las imágenes (<?= count($gallery_qty) ?> en total).</a>	
</div>

<?php 
	/*FRASES WIDGET
	 ***********************************************************/ 
	$frase_args = array(
		'numberposts'	=> 1,
		'offset'		=> 0,
		'orderby'		=> 'post_date',
		'order'			=> 'DESC',
		'post_type'		=> 'frase',
		'post_status'	=> 'publish'
	);

	$frases = get_posts($frase_args);
?>
<div class="widget frase">
	<h4>Frase del día</h4>
	<blockquote>
		<p class="frase"><?php echo get_post_meta($frases[0]->ID,'frasecontenido',true) ?></p>
		<p class="autor">- <?php echo get_post_meta($frases[0]->ID,'fraseautor',true) ?></p>
	</blockquote>
</div>

<div class="widget videos">
	<h4>Vídeos Destacados</h4>
	<iframe width="334" height="251" src="http://www.youtube.com/embed/videoseries?list=FLEgEFTUBn1RfIoebgG1IYeA&amp;hl=es_ES&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>
	<a href="http://www.youtube.com/playlist?list=FLEgEFTUBn1RfIoebgG1IYeA&feature=plcp" target="_blank">Ver la lista completa en YouTube</a>
</div>




<?php 
	/*DYNAMIC SIDEBAR
	 ***********************************************************/ 
	 dynamic_sidebar('right-sidebar'); 
?>