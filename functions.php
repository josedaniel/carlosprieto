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
?>