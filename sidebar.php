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
		<input type="text" name="s" id="s" <?= $value; ?> />
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
			<img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?= $src[0] ?>&amp;w=311" />
		</div>
		<div class="img_bottom">
			<img src="http://carlosprieto.net/wp-content/themes/carlosprieto/img/galeria_bottom_bg.png" />
		</div>
	</div>
	<a href="#show_images" id="link_show_images">Ver las otras <?= count($gallery_qty) - 1 ?> imágenes.</a>	
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




<?php 
	/*DYNAMIC SIDEBAR
	 ***********************************************************/ 
	 dynamic_sidebar('right-sidebar'); 
?>