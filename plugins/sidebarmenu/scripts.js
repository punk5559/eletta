jQuery(document).ready(function ($) {
	
	$('.sidebar .menu-item-has-children').each(function () {
		if($(this).hasClass('current-page-ancestor')) {
			$(this).prepend('<img class="menuuu-btn" src="/wp-content/plugins/sidebarmenu/images/arrow-white.png" />');
		}
		else if($(this).hasClass('current-menu-item')) {
			$(this).prepend('<img class="menuuu-btn" src="/wp-content/plugins/sidebarmenu/images/arrow-white.png" />');
		}
		else {
			$(this).prepend('<img class="menuuu-btn" src="/wp-content/plugins/sidebarmenu/images/arrow-red.png" />');
		}
	});

	$('.menuuu-btn').on('click',function () {
		$(this).siblings('.sub-menu').slideToggle();
		$(this).toggleClass('nav-menu-ost-active', 300);
	});
	
	$('.current-menu-item ').parent('.sub-menu').show();
	
	
	/*
	$('.menu-item-has-children > a').bind("click", function( event ) {
	   	
	   	$(this).siblings('.sub-menu').slideToggle();
	   	$(this).siblings('.menuuu-btn').toggleClass('nav-menu-ost-active', 300);
	   	event.preventDefault(); 
		$(this).unbind( event );
	
	});
	*/
		 
	
		

});