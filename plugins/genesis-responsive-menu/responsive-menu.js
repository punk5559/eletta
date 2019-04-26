jQuery(function( $ ){

	$("#nav_menu-2").addClass("responsive-menu").before('<div id="responsive-menu-icon"></div>');
	
	$("#responsive-menu-icon").click(function(){
		$("#nav_menu-2").slideToggle();
	});
	
	$(window).resize(function(){
		if(window.innerWidth > 841) {
			$("#nav_menu-2").removeAttr("style");
		}
	});
	if($(window).width() < 840){
		$('.genesis-nav-menu .sub-menu').hide();
		$('.sub-menu').parent().bind("click", function( event ) {
		   	$(this).children('.sub-menu').slideToggle();
		   	event.preventDefault(); 
			$(this).unbind( event );
		});
	}
	
	
});