<?php

	add_theme_support( 'post-thumbnails' );

	if(function_exists('register_sidebar')){
		//REGISTRAR EL SIDEBAR DERECHO
		register_sidebar(array(
		  'name' 			=> 'Lateral Derecho',
		  'id' 				=> 'right-sidebar',
		  'description' 	=> 'Widgets en esta area se mostraran en la parte derecha.',
		  'before_widget' 	=> '<div class="widget %2$s">',
		  'after_widget' 	=> '</div>',
		  'before_title' 	=> '<h4>',
		  'after_title' 	=> '</h4>'
		));
	}
    
    
    //REGISTRAR MENUS
    add_action('init', 'registrar_menus');
    function registrar_menus() {
        register_nav_menus(array('menu-izquierda' => __( 'Menu Superior Izquierdo' ), 'menu-derecha' => __( 'Menu Superior Derecho' )));
    }
	
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
				<input style="width:100%;" type="text" id="fraseautor" name="fraseautor" value="<?php if($fraseautor){ echo $fraseautor; } ?>" />
				
			</p>
			<p>
				<label for="frasecontenido">Contenido:</label><br />
				<textarea style="width:100%" rows="7" id="frasecontenido" name="frasecontenido"><?php if($frasecontenido){ echo $frasecontenido; } ?></textarea>
			</p>
		<?php
		//form end
	}

	//FUNCION PARA ACTUALIZAR LOS VALORES
	function save_custom_frase( $post_id ) {
		global $post;	

		if($_POST){
			update_post_meta( $post->ID, 'frasecontenido', $_POST['frasecontenido'] );
			update_post_meta( $post->ID, 'fraseautor', $_POST['fraseautor'] );
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