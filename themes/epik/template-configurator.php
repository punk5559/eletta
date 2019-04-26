<?php
/*
	
	Template Name: Configurator

*/

remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );


add_action( 'genesis_meta', function() {
	
	?>
	
	<script src="http://www.eletta.se/pkg/js/polyfills.js"></script>
    <script src="http://www.eletta.se/pkg/js/react-with-addons.js"></script>
    <script src="http://www.eletta.se/pkg/js/react-dom.js"></script>
    <script src="http://www.eletta.se/pkg/js/react-slider.js"></script>
    <script src="http://www.eletta.se/pkg/js/react-colorpicker.min.js"></script>
    <script src="http://www.eletta.se/pkg/js/fastclick.min.js"></script>
    <script src="http://www.eletta.se/pkg/js/hammer.min.js"></script>
    <script src="http://www.eletta.se/pkg/js/playcanvas-latest.js"></script>
    <script src="http://www.eletta.se/pkg/data/rules.js"></script>
    <link rel="stylesheet" href="http://www.eletta.se/pkg/css/application.css">
	<style>.site-inner { display:none; }</style>
	
	<?php
	
});


add_action( 'genesis_after_header', function() {
	
	//if ( ! post_password_required() ) {
	
		if (ICL_LANGUAGE_CODE == 'sv') {
			echo '<iframe src="https://www.eletta.se/pkg/?locale=sv" style="height: calc(100vh - 120px);" width="100%" frameborder="0">You need an iframes capable browser to view this content.</iframe>';
		}
		
		if (ICL_LANGUAGE_CODE == 'en') {
			echo '<iframe src="https://www.eletta.se/pkg/?locale=en" style="height: calc(100vh - 120px);" width="100%" frameborder="0">You need an iframes capable browser to view this content.</iframe>';
		}
		
		if (ICL_LANGUAGE_CODE == 'de') {
			echo '<iframe src="https://www.eletta.se/pkg/?locale=de" style="height: calc(100vh - 120px);" width="100%" frameborder="0">You need an iframes capable browser to view this content.</iframe>';
		}
		
		if (ICL_LANGUAGE_CODE == 'fr') {
			echo '<iframe src="https://www.eletta.se/pkg/?locale=fr" style="height: calc(100vh - 120px);" width="100%" frameborder="0">You need an iframes capable browser to view this content.</iframe>';
		}
	
	//}

});


genesis();
