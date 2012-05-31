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
	<h4>Frase destacada</h4>
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
	<h4>Fotos</h4>
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

<div class="widget videos">
	<h4>Vídeos</h4>
	<iframe width="334" height="251" src="http://www.youtube.com/embed/videoseries?list=PL5D753F4A9BEA24D9&amp;hl=es_ES&amp;wmode=transparent" frameborder="0" allowfullscreen></iframe>
	<a href="http://www.youtube.com/playlist?list=PL5D753F4A9BEA24D9&feature=plcp" target="_blank">Ver la lista completa en YouTube</a>
</div>

<div class="widget musica">
	<h4>Música</h4>
	<object width="335" height="450" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="gsPlaylist191012487" name="gsPlaylist191012487"><param name="movie" value="http://grooveshark.com/widget.swf" /><param name="wmode" value="window" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="hostname=cowbell.grooveshark.com&playlistID=19101248&bbg=ede6d8&bth=ede6d8&pfg=ede6d8&lfg=ede6d8&bt=665845&pbg=665845&pfgh=665845&si=665845&lbg=665845&lfgh=665845&sb=665845&bfg=ffffff&pbgh=ffffff&lbgh=ffffff&sbh=ffffff&p=0" /><object type="application/x-shockwave-flash" data="http://grooveshark.com/widget.swf" width="335" height="450"><param name="wmode" value="window" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="hostname=cowbell.grooveshark.com&playlistID=19101248&bbg=ede6d8&bth=ede6d8&pfg=ede6d8&lfg=ede6d8&bt=665845&pbg=665845&pfgh=665845&si=665845&lbg=665845&lfgh=665845&sb=665845&bfg=ffffff&pbgh=ffffff&lbgh=ffffff&sbh=ffffff&p=0" /><span><a href="http://grooveshark.com/playlist/Pochoprieto+s+Widget+1/19101248" title="Musica Recomendada by Carlos Alfonso Prieto Paternina on Grooveshark">Musica Recomendada by Carlos Alfonso Prieto Paternina on Grooveshark</a></span></object></object>
</div>


<?php
	//ENTRADAS RECIENTES 
	$recientes_args = array(
		'numberposts'     => 50,
		'order'           => 'DSC',
		'post_type'       => 'post',
		'post_status'     => 'publish',
		'category'		  => '-4262'
	);
	
	$recientes = get_posts($recientes_args);
?>
<div class="widget widget_recent_entries">
	<h4>Entradas recientes</h4>
	<ul>
<?php 
	foreach($recientes as $post){
?>
		<li>
			<a href="<?php the_permalink(); ?>" class="link"><?= $post->post_title; ?></a>
		</li>						
<?php 
		}
?>
	</ul>
</div>