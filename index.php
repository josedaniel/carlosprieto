<?php
if($_SERVER['HTTP_HOST'] == 'carlosprieto.josepaternina.dev'){
	$gallery_cat = 6;	
}else{
	$gallery_cat = 4262;
}
?>
<?php get_header(); ?>
	<div class="content">
		<div class="featured_posts">
			<div class="carrusel_container">
				<ul id="post_carrusel" class="jcarousel-skin-laundry">
					<?php 
						$carousel_args = array(
							'numberposts'     => 50,
							'order'           => 'DSC',
							'post_type'       => 'post',
							'post_status'     => 'publish' 
						);
						
						$carousel = get_posts($carousel_args);
					?>
					
					<?php 
						foreach($carousel as $post){
							$screen = get_post_meta($post->ID, 'screen', $single = true); 
							if($screen != ''){
					?>
							<li>
								<a href="<?php the_permalink(); ?>" class="img_container"><img src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo $screen; ?>&amp;h=82&amp;w=137&amp;zc=1&f=2" alt=""/></a>
								<a href="<?php the_permalink(); ?>" class="link"><?= $post->post_title; ?></a>
							</li>						
					<?php 
							}
						} 
					?>
				</ul>
			</div>
		</div>
		
		<div style="width:1000px;margin: 25px auto 0 auto;">
			<div class="posts" id="posts">
				<?php if(isset($_GET['s'])){ ?>
					<div style="width:100%;float:left;margin-bottom:20px;border-top: 1px solid #B7AC9C;border-bottom: 1px solid #B7AC9C;text-align: center;">
						<p>
							<em>Resultados de la búsqueda para 'test':</em>
						</p>
					</div>
				<?php } ?>
				<?php query_posts($query_string . '&cat=-'.$gallery_cat); ?>
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="this_post">
							<h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="post_info">
								<ul>
									<li><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" class="author">Por: <?php the_author(); ?></a></li>
									<li><a href="#" class="date"><?php the_date() ?></a></li>
									<li><a href="<?php the_permalink(); ?>#comentarios" class="comments">Agregar comentarios</a></li>
									<li><?php edit_post_link('EDITAR'); ?></li>
								</ul>
							</div>
							<?php 
								$subtitulo = get_post_meta($post->ID, 'subtitulo', $single = true); 
								if($subtitulo != ''){
							?>
								<div class="tagline">
									<p><?= $subtitulo; ?></p>
								</div>
							<?php } ?>
							<div class="post_content">
								<?php the_content(); ?>
							</div>
							<div class="relacionados">
								<p>
									<strong>Enlaces relacionados:</strong> <?php the_category(', '); ?>
								</p>
							</div>
						</div>
					<?php endwhile; ?>
					<div class="navigation_tool" style="margin-top:-20px;">
						<ul>
							<li class="left_li"><?php next_posts_link('Posts Anteriores','') ?></li>
							<li class="right_li"><?php if(previous_posts_link('Posts Siguientes') != ''){previous_posts_link('Posts Siguientes');} ?></li>
						</ul>
					</div>
				<?php }else{ ?>
					<div class="no_posts">
					<?php if(isset($_GET['s']) && $_GET['s'] != ''){ ?>
						<p style="text-align:center;">Hum... no hay resultados para '<?= $_GET['s']?>'.</p>
						<p style="text-align:center;">
							Vuelve a la <a href="http://carlosprieto.net">página de inicio</a> o utiliza el menú 
							de navegación de la parte superior para descubrir contenido interesante.
						</p>
					<?php }else{ ?>
						<p style="text-align:center;">¡Whoa! No hay entradas publicadas aún.</p>
						<p style="text-align:center;">
							Vuelve a la <a href="http://carlosprieto.net">página de inicio</a> o utiliza el menú 
							de navegación de la parte superior para descubrir contenido interesante.
						</p>
					<?php } ?>
					</div>
				<?php } ?>
			
				<div class="autores_widget">
					<h3>Listado de entradas por Autor</h3>
					<div class="autores_container">
						<div class="navegacion">
							<h4>Autores</h4>
							<ul>
								<?php 
									$autores_args = array(
										'blog_id' 	=> $GLOBALS['blog_id'],
										'orderby' 	=> 'email',
										'order'		=> 'ASC',
										'who'		=> 'authors'
									);

									$autores = get_users($autores_args);

									foreach ($autores as $autor) {
										?><li><a href="#<?= $autor->user_nicename ?>" id="<?= $autor->ID ?>"><?= $autor->display_name ?></a></li><?php
									}
								?>
							</ul>
						</div>
						<div class="contenido">
							<h4>Seleccione un autor...</h4>
							<ul>
								<!-- ajax -->
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="sidebar">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>