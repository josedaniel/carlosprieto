<?php

	add_theme_support( 'post-thumbnails' );

	if(function_exists('register_sidebar')){
		//REGISTRAR EL SIDEBAR DERECHO
		register_sidebar(array(
		  'name' 			=> 'Lateral Derecho',
		  'id' 				=> 'right-sidebar',
		  'description' 	=> 'Widgets en esta area se mostraran en la parte superior derecha.',
		  'before_widget' 	=> '<div class="widget %2$s">',
		  'after_widget' 	=> '</div>',
		  'before_title' 	=> '<h4>',
		  'after_title' 	=> '</h4>'
		));

		//REGISTRAR EL SIDEBAR INFERIOR
		register_sidebar(array(
		  'name' 			=> 'Inferior Derecho',
		  'id' 				=> 'bottom-sidebar',
		  'description' 	=> 'Widgets en esta area se mostraran en la parte inferior derecha.',
		  'before_widget' 	=> '<div class="widget %2$s">',
		  'after_widget' 	=> '</div>',
		  'before_title' 	=> '<h4>',
		  'after_title' 	=> '</h4>'
		));
	}
    
    
    //REGISTRAR MENUS
    function registrar_menus() {
        register_nav_menus(array(
        	'menu-izquierda' 	=> __( 'Menu Superior Izquierdo' ), 
        	'menu-derecha' 		=> __( 'Menu Superior Derecho' )
        ));
    }
    add_action('init', 'registrar_menus');
	
	//PERMITIR SHORTCODES EN LOS WIDGETS DE TEXTO
	add_filter('widget_text', 'do_shortcode');
	
	
	//AJAX function to serve the next image in the image gallery
	add_action('wp_ajax_gallery_image', 'gallery_image_callback'); 

	function gallery_image_callback(){
		if($_SERVER['HTTP_HOST'] == 'carlosprieto.josepaternina.dev'){
			$gallery_cat = 6;	
		}else{
			$gallery_cat = 4262;
		}		
		
		$args = array(
			'category'		  => $gallery_cat,
			'order_by'		  => 'post_date',
			'order'           => 'DSC',
			'post_type'       => 'post',
			'post_status'     => 'publish' 
		);
		
		$posts = get_posts($args);
		$images = array();

		foreach ($posts as $post) {
			$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
			$this_image = array(
				'image_id'			=> $post->ID,
				'image_src'			=> $src[0],
				'image_title'		=> $post->post_title,
				'image_description'	=> get_post_meta($post->ID, 'subtitulo', $single = true)
			);
			array_push($images, $this_image);
		}

		echo json_encode($images);
		die();
	}

	//AJAX - LISTAR TODOS LOS POSTS DE UN AUTOR
	add_action('wp_ajax_posts_autor', 'posts_autor_callback');
	
	function posts_autor_callback(){
		if($_SERVER['HTTP_HOST'] == 'carlosprieto.josepaternina.dev'){
			$gallery_cat = 6;	
		}else{
			$gallery_cat = 4262;
		}

		$id_autor = $_POST['id_autor'];
		$args = array(
			'numberposts'     => 30,
			'author'		  => $id_autor,
			'order_by'		  => 'post_date',
			'order'           => 'DSC',
			'post_type'       => 'post',
			'post_status'     => 'publish',
			'category'		  => '-'.$gallery_cat 
		);
		$posts = get_posts($args);
		foreach($posts as $post){
			setup_postdata($post);
			?>
				<li>
					<table>
						<tr>
							<td>
								<?php 
									$img = get_post_meta($post->ID, 'screen', $single = true);
									if($img == ''){
										$img = 'http://placehold.it/87x71/4D4131/ffffff/&text=...';
									}else{
										$img = 'http://carlosprieto.net/wp-content/themes/carlosprieto/timthumb.php?src='.$img.'&amp;h=71&amp;w=87';
									} 
								?>
								<img src="<?= $img ?>">
							</td>
							<td>
								<p class="resumen">
									<a href="<?= $post->guid ?>"><?= $post->post_title?></a>: <?php the_excerpt(); ?>
								</p>
								<p class="link">
									<a href="<?= $post->guid ?>">Ver más</a>
								</p>
							</td>
						</tr>
					</table>
				</li>
			<?php
		}
		die();
	} 


	/*
	*  CUSTOM POST TYPE: FRASE DEL DIA
	*  **********************************************************************************
	*/
	//FUNCION PARA INICIALIZAR EL CPT
	function init_frase() {
		
		$labels = array(
			'name' 					=> _x('Frases', 'post type general name'),
			'singular_name' 		=> _x('Frase', 'post type singular name'),
			'add_new' 				=> _x('Agregar', 'Frase'),
			'add_new_item' 			=> __('Agregar nueva Frase'),
			'edit_item' 			=> __('Editar Frase'),
			'new_item' 				=> __('Nueva Frase'),
			'all_items' 			=> __('Todas las Frases'),
			'view_item' 			=> __('Ver Frase'),
			'search_items' 			=> __('Buscar Frases'),
			'not_found' 			=>  __('No se encontraron Frases'),
			'not_found_in_trash' 	=> __('No se encontraron Frases en la papelera'), 
			'parent_item_colon' 	=> '',
			'menu_name' 			=> 'Frases del Día'
		);

		$args = array(
			'labels' 				=> $labels,
			'public' 				=> true,
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true, 
			'show_in_menu' 			=> true, 
			'query_var' 			=> true,
			'rewrite' 				=> true,
			'capability_type' 		=> 'post',
			'has_archive' 			=> true, 
			'hierarchical' 			=> false,
			'menu_position' 		=> null,
			'supports' 				=> array('revisions','title')
		); 

		register_post_type( 'frase', $args );
	}


	//FUNCION PARA ENSAMBLAR EL METABOX DE LA ADMINISTRACION
	function frase_custom_metabox(){
		global $post;
		$frasecontenido = get_post_meta( $post->ID, 'frasecontenido', true );
		$fraseautor 	= get_post_meta( $post->ID, 'fraseautor', true );
		//form
		?>
			<p>
				<label for="fraseautor">Autor:<br /></label>
				<input style="width:100%;" type="text" id="fraseautor" name="fraseautor" value="<?php if($fraseautor){echo $fraseautor;} ?>" />
				
			</p>
			<p>
				<label for="frasecontenido">Contenido:</label><br />
				<textarea style="width:100%" rows="7" id="frasecontenido" name="frasecontenido"><?php if($frasecontenido){echo $frasecontenido;} ?></textarea>
			</p>
		<?php
		//form end
	}

	//FUNCION PARA ACTUALIZAR LOS VALORES
	function save_custom_frase( $post_id ) {
		global $post;	

		if($_POST){
			if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
        		return $post_id;
        	}else{
        		update_post_meta($post->ID, 'frasecontenido', $_POST['frasecontenido'] );
				update_post_meta( $post->ID, 'fraseautor', $_POST['fraseautor'] );	
        	}
		}
	}

	//FUNCIONA PARA AGREGAR EL METABOX A LA ADMINISTRACION DE FRASES
	function add_frase_metabox() {
		add_meta_box( 'frase-metabox', __( 'Información de la Frase' ), 'frase_custom_metabox', 'frase', 'normal', 'high' );
	}

	add_action( 'init', 'init_frase');
	add_action( 'admin_init', 'add_frase_metabox' );
	add_action( 'save_post', 'save_custom_frase' );

	/*
	*  FINAL FRASE DEL DIA
	*  **********************************************************************************
	*/
?>