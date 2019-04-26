jQuery(document).ready(function ($) {

	$("p").each(function(){
	    if ($(this).html().length < 2) {
	        $(this).remove();
	    }
	});
	
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function(e) {
		  e.preventDefault();
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
		 
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html,body').animate({
	          scrollTop: target.offset().top - 40
	        }, 1000);
	        return false;
	      }
	    }
	  });
	});
	
	
	
	
});




jQuery(document).ready(function ($) {
	var theLang = $('html').attr('lang');
	var french = 'fr-FR';
	if ( theLang == french) {
		$('#reply-title').html('Laissez nouz un message');
		$('.comment-notes').html('Votre adresse email ne sera pas publiée. Champs obligatoires*');
		$('label[for=email]').html('Email*');
	}
	
	$('.entry-author-name').html('Eletta');

});

