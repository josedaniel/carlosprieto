<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset=utf-8>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
  <meta name="description" content="">

  <meta name="viewport" content="width=device-width">
  <link href='http://fonts.googleapis.com/css?family=Allan:bold' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Vollkorn:400italic,700italic,400,700' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/style.css">
  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/laundry/skin.css">
  <link rel="stylesheet/less" href="<?php bloginfo('template_url'); ?>/css/less.css">

  <script src="<?php bloginfo('template_url'); ?>/js/libs/modernizr-2.5.3.min.js"></script>
  <script charset="utf-8" type="text/javascript">
	var switchTo5x=true;
  </script>
  <script charset="utf-8" type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
  <script type="text/javascript">
	stLight.options({publisher:'225fd447-d692-457e-850b-ec56d2fdb264'});
	var st_type='wordpress3.3.1';
  </script>
</head>
<body>
	<div id="wrapper">
		<div class="header">
			
			<!-- -->
			<div class="header_image">
				<div class="back_layer"><!-- --></div>
				<div class="front_layer"><!-- --></div>
			</div>
			<!-- -->
			
			<div class="logo">
				<a href="/">
					<img src="<?php bloginfo('template_url'); ?>/img/logo.png" alt="" />
				</a>
			</div>
			<div class="navigation">
				<div class="navigation_wrapper">
					<?php wp_nav_menu( array('theme_location' => 'menu-izquierda','menu_class' => 'dropdown left_sections') ); ?>
					<?php wp_nav_menu( array('theme_location' => 'menu-derecha','menu_class' => 'dropdown right_sections') ); ?>
				</div>
			</div>
			<div class="tagline">
				<div class="tagline_wrapper">
					<p>
					   "No hay verdades absolutas; todas las verdades son medias verdades. 
						El mal surge de quererlas tratar como verdades absolutas"
						<span>-</span> Alfred North Whitehead
					</p>
				</div>
			</div>
		</div>
