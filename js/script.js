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
	$('#link_show_images').click(function(e){
		e.preventDefault();
		$('#gallery_lb').show();
		var data = {action :'gallery_image'};
		
		$.post('/wp-admin/admin-ajax.php',data,function(r){
			
			localStorage['img_qty']				= r.length;
			localStorage['current_page']		= 1;

			$(r).each(function(i){
				i 								= i + 1;
				localStorage[i+'_id']			= this.image_id;
				localStorage[i+'_src']			= this.image_src;
				localStorage[i+'_title']		= this.image_title;
				localStorage[i+'_description']	= this.image_description;
			});

			var img = new Image();

			$(img).load(function (){    
				$(this).hide();
				$('#img_container').append(this);
				$(this).fadeIn();
				$('.lb_content .description h3').html(localStorage['0_title']);
				$('.lb_content .description p').html(localStorage['0_description']);
				if(parseInt(localStorage['img_qty']) > 1){
					$('.arrow_container .next').show();
					$('.arrow_container .back').hide();	
				}else{
					$('.arrow_container .back').hide();
					$('.arrow_container .next').hide();
				}
			}).attr('src', localStorage['0_src']).addClass('the_image');

		},'json');	
	});

	$('#gallery_lb .close').click(function(e){
		e.preventDefault();
		$('.lb_content .image_container').hide();
		$('.lb_content .loading').show();
		$('#gallery_lb').hide();
	});

	$('.arrow').click(function(e){
		e.preventDefault();

		$('#img_container').empty();

		if($(this).hasClass('next')){
			var index = 1;
		}else{
			var index = -1;
		}

		var current_page = parseInt(localStorage['current_page']);
		var limit		 = parseInt(localStorage['img_qty']);

		var next_page	 = current_page + index;
		if(next_page >= 1 && next_page <= limit){
			localStorage['current_page'] = next_page;

			var img = new Image();

			$(img).load(function (){    
				$(this).hide();
				$('#img_container').append(this);
				$(this).fadeIn();
				$('.lb_content .description h3').html(localStorage[next_page+'_title']);
				$('.lb_content .description p').html(localStorage[next_page+'_description']);
			}).attr('src', localStorage[next_page+'_src']).addClass('the_image');

			if(next_page >= limit){
				$('.arrow_container .back').show();
				$('.arrow_container .next').hide();
			}else if(next_page == 1){
				$('.arrow_container .next').show();
				$('.arrow_container .back').hide();
			}else{
				$('.arrow_container .next').show();
				$('.arrow_container .back').show();	
			}
			
		}
	});
		
});