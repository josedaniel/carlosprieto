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
		$event 	= $_POST['event'];
		$offset = $_POST['offset'];
		
		
		$args = array(
			'numberposts'     => 1,
			'offset'		  => $offset,
			'category'		  => 4262,
			'order_by'		  => 'post_date',
			'order'           => 'DSC',
			'post_type'       => 'post',
			'post_status'     => 'publish' 
		);
		
		$image = get_posts($args);
		
		$data = $_POST;
		echo json_encode($data);
		die();
	}
?>