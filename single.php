<?php get_header(); ?>

		<!-- facebook commets load start -->
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=129229465380";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
		</script>
		<!-- facebook comments load end-->
		
		<div class="content">
		
			<div style="width:1000px;margin: 25px auto 0 auto;">
				<div class="posts">
					
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="this_post">
								<h2 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="post_info">
									<ul>
										<li><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>" class="author">Por: <?php the_author(); ?></a></li>
										<li><a href="#" class="date"><?php the_date() ?> </a></li>
										<li><a href="#comentarios" class="comments">Agregar comentarios</a></li>
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
										<strong>Enlaces relacionados:</strong> <a href="">Columnistas</a>, <a href="">Cine</a>, <a href="">Actualidad</a>
									</p>
								</div>
								<div id="comentarios" class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="5" data-width="610"></div>
							</div>
						<?php endwhile; ?>
						<div class="navigation_tool" style="margin-top:-20px;">
							<ul>
								<li class="left_li"><?php previous_post_link('%link','Anterior',false,'4262'); ?></li>
								<li class="right_li"><?php next_post_link('%link','Siguiente',false,'4262'); ?></li>
							</ul>
						</div>
					<?php endif; ?>

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