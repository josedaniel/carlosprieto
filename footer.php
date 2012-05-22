		<div class="footer">
			<div style="width:1000px;margin:0 auto">
				<div class="bottombar">
					<div class="twitter">
						<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
						<script>
						new TWTR.Widget({
						  version: 2,
						  type: 'profile',
						  rpp: 5,
						  interval: 30000,
						  width: 320,
						  height: 430,
						  theme: {
						    shell: {
						      background: '#504639',
						      color: '#ffffff'
						    },
						    tweets: {
						      background: '#504639',
						      color: '#ffffff',
						      links: '#ece5d7'
						    }
						  },
						  features: {
						    scrollbar: false,
						    loop: false,
						    live: false,
						    behavior: 'all'
						  }
						}).render().setUser('carlosprieto').start();
						</script>	
					</div>
					<div class="widget disclaimer">
						<h4>Disclaimer</h4>
						<p>
							Todo el contenido publicado en este blog es 
							propiedad de sus autores, y no necesariamente 
							refleja la opinón del editor de este sitio web.
						</p>
					</div>
					<div class="widget navegacion">
						<h4>Carlosprieto.net</h4>
						<ul>
							<li><a href="/">Inicio</a></li>
							<li><a href="http://carlosprieto.net/index.php/category/cine/">Cine</a></li>
							<li><a href="http://carlosprieto.net/index.php/category/entrevistas/">Entrevistas</a></li>
							<li><a href="http://carlosprieto.net/index.php/category/fotos/">Fotos</a></li>

							<li><a href="http://carlosprieto.net/index.php/category/multimedia/">Video</a></li>
							<li><a href="http://carlosprieto.net/index.php/category/noticias/">Noticias</a></li>
							<li><a href="http://carlosprieto.net/index.php/category/libros/">Libros</a></li>
							<li><a href="http://carlosprieto.net/index.php/category/gastronomia/">Gastronomía</a></li>
						</ul>
					</div>
				</div>
				<div class="creditos">
					<div class="left">2012 - Carlos Alfonso Prieto</div>
					<div class="right">Diseño: Daniel 8a - Programación: Desarrollo 22</div>
				</div>
			</div>
			<div class="subir">
				<a href="#wrapper">
					<img src="/wp-content/themes/carlosprieto/img/subir.png" />
				</a>
			</div>
		</div>
	</div>  
	
	<!-- GALLERY LB -->
	<div id="gallery_lb">
		<div class="close"><!-- --></div>
		<div class="lb_content">

			<table>
				<tr>
					<td class="arrow_container">
						<a href="#" class="arrow back"><img src="/wp-content/themes/carlosprieto/img/l.png" /></a>
					</td>
					<td class="img_container loading" id="img_container">
						
					</td>
					<td class="arrow_container">
						<a href="#" class="arrow next"><img src="/wp-content/themes/carlosprieto/img/r.png" /></a>
					</td>
				</tr>
				<tr>
					<td colspan="3" class="description">
						<h3></h3>
						<p></p>
					</td>
				</tr>
			</table>

		</div>
	</div>
	
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php bloginfo('template_url'); ?>/js/libs/jquery-1.7.1.min.js"><\/script>')</script>
	
	<script src="<?php bloginfo('template_url'); ?>/js/less-1.3.0.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/jquery.jcarousel.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/plugins.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/script.js"></script>

	<script>
		/*
		var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		s.parentNode.insertBefore(g,s)}(document,'script'));
		*/
	</script>
</body>
</html>