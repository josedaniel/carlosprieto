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

<?php dynamic_sidebar('right-sidebar'); ?>



<?php
	$images_args = array('category' => 4262, 'post_status' => 'publish');
	$gallery_qty = get_posts($images_args);
	$src =  wp_get_attachment_image_src(get_post_thumbnail_id($gallery_qty[0]->ID));
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
	<form id="galery_form">
		<input type="text" name="img_qty" id="img_qty" value="<?= count($gallery_qty) ?>" />
		<input type="text" name="offset" value="1" />
		<input type="button" id="next_img" value="Imagen siguiente" />
		<input type="button" id="back_img" value="Imagen Anterior" /> lalal
	</form>	
</div>