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
										<li><a href="" class="author">Publicado por <?php the_author(); ?></a></li>
										<li><a href="" class="date"><?php the_date() ?> </a></li>
										<li><a href="#comentarios" class="comments">Agregar comentarios</a></li>
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
					<?php endif; ?>
					
				</div>
				<div class="sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
<?php get_footer(); ?>