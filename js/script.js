/* Author: jose.paternina@desarrollo22.com */

//MENU HELPERS ***************************************************
function hide_menu(node){
	node = $(node);
	node.removeClass("hover");
	$('ul:first',node).css('visibility', 'hidden');
}

function doOpen() {
    $(this).addClass("hover");
    $('ul:first',this).css('visibility', 'visible');
}

function doClose() {
    $(this).removeClass("hover");
    $('ul:first',this).css('visibility', 'hidden');
}

//MENU HELPERS END *************************************************

$(document).ready(function(){
	if($('#post_carrusel').length){
		jQuery('#post_carrusel').jcarousel();
	}
	
	//Navigation Menu
	if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i)) || (navigator.userAgent.match(/iPad/i))) {
		
		$("ul.dropdown li").click(function(){
			$(this).addClass("hover");
		  	$('ul:first',this).css('visibility', 'visible');
		},function(){
		  	$(this).removeClass("hover");
		  	$('ul:first',this).css('visibility', 'hidden');
		});	
		$("ul.dropdown li").hover(function(){
		  	$(this).addClass("hover");
		  	$('ul:first',this).css('visibility', 'visible');
		},function(){
		  	$(this).removeClass("hover");
		  	$('ul:first',this).css('visibility', 'hidden');
		});
	  
    }else{

		var config = {    
		     sensitivity: 3, // number = sensitivity threshold (must be 1 or higher)    
		     interval: 50,  // number = milliseconds for onMouseOver polling interval    
		     over: doOpen,   // function = onMouseOver callback (REQUIRED)    
		     timeout: 50,   // number = milliseconds delay before onMouseOut    
		     out: doClose    // function = onMouseOut callback (REQUIRED)    
		};
		
		$("ul.dropdown li").hoverIntent(config);
		$("ul.dropdown li ul li:has(ul)").find("a:first");	  	
	}
	
	//GALERIA DE IMAGENES
	
	$('#next_img,#back_img').click(function(){
		
		
		var data = {
			action :'gallery_image',
			event  : $(this).attr('id')
		};
		$.post('/wp-admin/admin-ajax.php',data,function(r){
			log(r);
		},'json');
	});
		
});