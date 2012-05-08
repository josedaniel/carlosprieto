<?php
/*
Template Name: Ajax
*/
?>
 
<?php 
	$carousel_args = array(
		'numberposts'     => 20,
		'order'           => 'DSC',
		'post_type'       => 'post',
		'post_status'     => 'publish' 
	);
	
	echo json_encode(get_posts($carousel_args));
?>