<?php
//* Start the engine
require_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Epik Theme', 'epik' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/epik/' );

//* Enqueue Lato Google font
add_action( 'wp_enqueue_scripts', 'genesis_sample_google_fonts' );
function genesis_sample_google_fonts() {
	wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700', array(), PARENT_THEME_VERSION );
	wp_enqueue_script('custom_script',get_stylesheet_directory_uri() . '/scripts.js',array('jquery'));
}

//* Add HTML5 markup structure
add_theme_support( 'html5' );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom background
add_theme_support( 'custom-background' );

/* FREDDES SHORTCODE */

add_shortcode('dokument', 'dokument_shortcode');

function get_page_by_slug($page_slug, $output = OBJECT, $post_type = 'page' ) { 
	global $wpdb; 
	$page = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= %s AND post_status = 'publish'", $page_slug, $post_type ) ); 
		if ( $page ) 
			return get_post($page, $output); 
	return null; 
}

function dokument_shortcode($attributes) {
	extract( shortcode_atts( array(
			'slug' => 'm-serien',
		), $attributes ) );
		
	$page = get_page_by_slug($slug);

	$documents = get_field('dokument', $page->ID);
	$output = '';
	if($documents != '') {
		$output .= '<table id="document-list" style="border-collapse: collapse;" width="100%">';
		if(ICL_LANGUAGE_CODE=='en') {
			$output .= '<thead><tr><td width="40%">'.get_field('dokumentnamn_en', $page->ID).'</td><td width="60%">'.get_field('tillgangliga_sprakversioner_en', $page->ID).'</td></tr></thead>';
		} elseif(ICL_LANGUAGE_CODE=='fr') {
			$output .= '<thead><tr><td width="40%">'.get_field('dokumentnamn_fr', $page->ID).'</td><td width="60%">'.get_field('tillgangliga_sprakversioner_fr', $page->ID).'</td></tr></thead>';
		} elseif(ICL_LANGUAGE_CODE=='de') {
			$output .= '<thead><tr><td width="40%">'.get_field('dokumentnamn_de', $page->ID).'</td><td width="60%">'.get_field('tillgangliga_sprakversioner_de', $page->ID).'</td></tr></thead>';
		} else {
			$output .= '<thead><tr><td width="40%">'.get_field('dokumentnamn_sv', $page->ID).'</td><td width="60%">'.get_field('tillgangliga_sprakversioner_sv', $page->ID).'</td></tr></thead>';
		}
		
		
		
		foreach($documents as $document) {
			$output .= '<tr>';
				$output .= '<td>';
					if(ICL_LANGUAGE_CODE=='en') {
						$output .= $document['dokumentnamn_en'];
					} elseif(ICL_LANGUAGE_CODE=='fr') {
						$output .= $document['dokumentnamn_fr'];
					} elseif(ICL_LANGUAGE_CODE=='de') {
						$output .= $document['dokumentnamn_de'];
					} else {
						$output .= $document['dokumentnamn'];
					}
				$output .= '</td>';
			$output .= '<td>';
				
				foreach($document['filer'] as $fil) {
					switch ($fil['country']) {
					    case 'Sverige':
					        $flag_class = 'flag-se';
					        break;
					    case 'England':
					        $flag_class = 'flag-uk';
					        break;
					    case 'Finland':
					        $flag_class = 'flag-fi';
					        break;
					    case 'Spanien':
					        $flag_class = 'flag-es';
					        break;
					    case 'Frankrike':
					        $flag_class = 'flag-fr';
					        break;
					    case 'Tyskland':
					        $flag_class = 'flag-de';
					        break;
						case 'Schweiz':
					        $flag_class = 'flag-ch';
					        break;
					    case 'Polen':
					        $flag_class = 'flag-pl';
					        break;
					    case 'Italien':
					        $flag_class = 'flag-it';
					        break;
					    case 'Portugal':
					        $flag_class = 'flag-pt';
					        break;
					    case 'Nederländerna':
					        $flag_class = 'flag-nl';
					        break;
					    case 'Grekland':
					        $flag_class = 'flag-gr';
					        break;
					    case 'Ryssland':
					        $flag_class = 'flag-ru';
					        break;
					    case 'USA':
					        $flag_class = 'flag-us';
					        break;
					    case 'Kina':
					        $flag_class = 'flag-cn';
					        break;
					    case 'Japan':
					        $flag_class = 'flag-jp';
					        break;
					    case 'EU':
					        $flag_class = 'flag-eu';
					        break;
					    case 'Disk':
					        $flag_class = 'disk-icon';
					        break;
					    case 'Link':
					        $flag_class = 'link-icon';
					        break;
					    default:
					        $flag_class = '';
					        break;
					}
								
					
					if($fil['url']) {
						$output .= '<a target="_blank" class="flag '.$flag_class.'" href="'.$fil['url'].'"></a>';
					} else {
						$output .= '<a target="_blank" class="flag '.$flag_class.' flag-disable"></a>';
					}
					
					
				}
				
			$output .= '</td>';
			$output .= '</tr>';
		}
		$output .= '</table>';
	}
	return $output;
}

/*
add_filter( 'upload_size_limit', 'b5f_increase_upload' );

function b5f_increase_upload( $bytes )
{
    return 20554432; // 32 megabytes
}
*/


// Eletta settings
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page( array(
	 
	'page_title'	=> 'Eletta settings',
	'menu_title'	=> 'Eletta settings',
	'menu_slug'		=> 'elletta-settings',
	'capability'	=> 'edit_posts',
	'icon_url'		=> 'dashicons-star-filled',
	'position'		=> 99
	 
	) );
}



// Create additional color style options
add_theme_support( 'genesis-style-selector', array( 
	'epik-black' 		=>	__( 'Black', 'epik' ),	
	'epik-blue' 		=>	__( 'Blue', 'epik' ),
	'epik-darkblue'		=>	__( 'Dark Blue', 'epik' ),
	'epik-gray' 		=> 	__( 'Gray', 'epik' ),	
	'epik-green' 		=> 	__( 'Green', 'epik' ),
	'epik-orange' 		=> 	__( 'Orange', 'epik' ), 
	'epik-pink' 		=> 	__( 'Pink', 'epik' ),
	'epik-purple' 		=> 	__( 'Purple', 'epik' ), 
	'epik-red' 			=> 	__( 'Red', 'epik' ),	 
) );

// Add support for custom header
add_theme_support( 'genesis-custom-header', array(
	'width' => 360,
	'height' => 93
) );


// Add new image sizes 
add_image_size( 'featured-img', 730, 420, TRUE );
add_image_size( 'featured-page', 341, 173, TRUE );
add_image_size( 'portfolio-thumbnail', 264, 200, TRUE );

// Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

// Reposition the Secondary Navigation
remove_action( 'genesis_after_header', 'genesis_do_subnav' ) ;
add_action( 'genesis_before_header', 'genesis_do_subnav' );

// Before Header Wrap
add_action( 'genesis_before_header', 'before_header_wrap' );
function before_header_wrap() {
	echo '<div class="head-wrap">';
}

// Reposition the Primary Navigation
remove_action( 'genesis_after_header', 'genesis_do_nav' ) ;
add_action( 'genesis_after_header', 'genesis_do_nav' );

// After Header Wrap
add_action( 'genesis_after_header', 'after_header_wrap' );
function after_header_wrap() {
	echo '</div>';
}

// Customize search form input box text
add_filter( 'genesis_search_text', 'custom_search_text' );
function custom_search_text($text) {
    return esc_attr( 'Search...' );
}

add_action( 'admin_menu', 'epik_theme_settings_init', 15 ); 
/** 
 * This is a necessary go-between to get our scripts and boxes loaded 
 * on the theme settings page only, and not the rest of the admin 
 */ 
function epik_theme_settings_init() { 
    global $_genesis_admin_settings; 
     
    add_action( 'load-' . $_genesis_admin_settings->pagehook, 'epik_add_portfolio_settings_box', 20 ); 
} 

// Add Portfolio Settings box to Genesis Theme Settings 
function epik_add_portfolio_settings_box() { 
    global $_genesis_admin_settings; 
     
    add_meta_box( 'genesis-theme-settings-epik-portfolio', __( 'Portfolio Page Settings', 'epik' ), 'epik_theme_settings_portfolio',     $_genesis_admin_settings->pagehook, 'main' ); 
}  
	
/** 
 * Adds Portfolio Options to Genesis Theme Settings Page
 */ 	
function epik_theme_settings_portfolio() { ?>

	<p><?php _e("Display which category:", 'genesis'); ?>
	<?php wp_dropdown_categories(array('selected' => genesis_get_option('epik_portfolio_cat'), 'name' => GENESIS_SETTINGS_FIELD.'[epik_portfolio_cat]', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("All Categories", 'genesis'), 'hide_empty' => '0' )); ?></p>
	
	<p><?php _e("Exclude the following Category IDs:", 'genesis'); ?><br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[epik_portfolio_cat_exclude]" value="<?php echo esc_attr( genesis_get_option('epik_portfolio_cat_exclude') ); ?>" size="40" /><br />
	<small><strong><?php _e("Comma separated - 1,2,3 for example", 'genesis'); ?></strong></small></p>
	
	<p><?php _e('Number of Posts to Show', 'genesis'); ?>:
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[epik_portfolio_cat_num]" value="<?php echo esc_attr( genesis_option('epik_portfolio_cat_num') ); ?>" size="2" /></p>
	
	<p><span class="description"><?php _e('<b>NOTE:</b> The Portfolio Page displays the "Portfolio Page" image size plus the excerpt or full content as selected below.', 'epik'); ?></span></p>
	
	<p><?php _e("Select one of the following:", 'genesis'); ?>
	<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[epik_portfolio_content]">
		<option style="padding-right:10px;" value="full" <?php selected('full', genesis_get_option('epik_portfolio_content')); ?>><?php _e("Display post content", 'genesis'); ?></option>
		<option style="padding-right:10px;" value="excerpts" <?php selected('excerpts', genesis_get_option('epik_portfolio_content')); ?>><?php _e("Display post excerpts", 'genesis'); ?></option>
	</select></p>
	
	<p><label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[epik_portfolio_content_archive_limit]"><?php _e('Limit content to', 'genesis'); ?></label> <input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[epik_portfolio_content_archive_limit]" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[epik_portfolio_content_archive_limit]" value="<?php echo esc_attr( genesis_option('epik_portfolio_content_archive_limit') ); ?>" size="3" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[epik_portfolio_content_archive_limit]"><?php _e('characters', 'genesis'); ?></label></p>
	
	<p><span class="description"><?php _e('<b>NOTE:</b> Using this option will limit the text and strip all formatting from the text displayed. To use this option, choose "Display post content" in the select box above.', 'genesis'); ?></span></p>
<?php
}	

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

// Register widget areas
genesis_register_sidebar( array(
	'id'			=> 'slider-wide',
	'name'			=> __( 'Slider Wide', 'epik' ),
	'description'	=> __( 'This is the wide slider section of the homepage.', 'epik' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'welcome-feature-1',
	'name'			=> __( 'Welcome Feature #1', 'epik' ),
	'description'	=> __( 'This is the first column of the Welcome feature section of the homepage.', 'epik' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'welcome-feature-2',
	'name'			=> __( 'Welcome Feature #2', 'epik' ),
	'description'	=> __( 'This is the second column of the Welcome feature section of the homepage.', 'epik' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'welcome-feature-3',
	'name'			=> __( 'Welcome Feature #3', 'epik' ),
	'description'	=> __( 'This is the third column of the Welcome feature section of the homepage.', 'epik' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'welcome-feature-4',
	'name'			=> __( 'Welcome Feature #4', 'epik' ),
	'description'	=> __( 'This is the third column of the Welcome feature section of the homepage.', 'epik' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'welcome-wide',
	'name'			=> __( 'Welcome Wide', 'epik' ),
	'description'	=> __( 'This is the Wide (full width) section of the Welcome area.', 'epik' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-feature-1',
	'name'			=> __( 'Home Feature #1 (Left)', 'epik' ),
	'description'	=> __( 'This is the first column of the feature section of the homepage.', 'epik' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-feature-2',
	'name'			=> __( 'Home Feature #2 (Middle)', 'epik' ),
	'description'	=> __( 'This is the second column of the feature section of the homepage.', 'epik' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-feature-3',
	'name'			=> __( 'Home Feature #3 (Right)', 'epik' ),
	'description'	=> __( 'This is the 3rd column of the feature section of the homepage.', 'epik' ),
) );

add_shortcode('resellers', 'resellers_shortcode');

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function resellers_shortcode($atts){

	//We extract all shortcode attributes in to $variable, so if the customer types [co-workers columns="3"] we will have a varibale called $columns with the value of 4.
	extract( shortcode_atts( array(
	'columns' => '1',
	), $atts ) );
	//We use a switch to get what class we will echo out later dependent on what the customer input. 
	switch ($columns) {
	    case 1:
	        $colum_type = '';
	        break;
	    case 2:
	        $colum_type = 'one-half';
	        break;
	    case 3:
	        $colum_type = 'one-third';
	        break;
	    case 4:
	        $colum_type = 'one-fourth';
	        break;
	    case 5:
	        $colum_type = 'one-fifth';
	        break;
		default:
			$colum_type = 'one-fourth';
	}

	if(function_exists('get_field')) {
		
		$resellers = get_field('resellers');
		
		$output = '';
			
				if($resellers) {
					$country_counter = 1;
					
					$count = 0;
					foreach($resellers as $country) {
						if($country['country']) {
							++$count;
						}
					}
					
					$colum_checker = intval(
											ceil(
												(floatval($count)/floatval(3))
											)
										);
										
					$output .= '<div class="one-third first">';
					foreach($resellers as $country){
						if($country_counter >= $colum_checker && $country['country']) {
							if($country['country']){
								$output .= '<a href="#'. clean($country['country']) .'">'. $country['country'].'</a><br/>';	
							}
							$output .= '</div>';
							$output .= '<div class="one-third">';
							$country_counter = 1;
						} else {
							if($country['country']){
								$output .= '<a href="#'. clean($country['country']) .'">'. $country['country'].'</a><br/>';
								++$country_counter;
							}
						}
					}
					$output .= '<br clear="all"></div><br clear="all">';
					$counter = $columns - 1;
		            
					foreach($resellers as $reseller) {
						
							if($columns != 1 && $counter == $columns - 1) {
								$output .= '<div class="full-block reseller" id="'. clean($reseller['country']) .'">';
								
								$output .= '<div class="full-block country"><h3>' . $reseller['country'] . '</h3></div>';
								$output .= '<div class="one-third first name-address"><p>' . $reseller['name-address'] . '</p></div>';
								$output .= '<div class="one-third number"><p>' . $reseller['number'] . '</p></div>';
								$output .= '<div class="one-third email-web"><p>' . $reseller['email-web'] . '</p></div>';
								
								$output .= '<br clear="all"></div>';
								
								$counter = 0;
	
							
							} else {
								$output .= '
											<div class="full-block reseller" id="'. clean($reseller['country']) .'">';
								
								$output .= '<div class="full-block country"><h3>' . $reseller['country'] . '</h3></div>';
								$output .= '<div class="one-third first name-address"><p>' . $reseller['name-address'] . '</p></div>';
								$output .= '<div class="one-third number"><p>' . $reseller['number'] . '</p></div>';
								$output .= '<div class="one-third email-web"><p>' . $reseller['email-web'] . '</p></div>';
								
								$output .= '<br clear="all"></div>';
								
								$counter++;
							}
					
					}
					
				}
				
				$output .= '<br clear="all">';
				
			
		return $output;
	}
}


/** Force full width layout on all archive pages*/
add_filter( 'genesis_pre_get_option_site_layout', 'full_width_layout_archives' );
/**
* @author Brad Dalton
* @link http://wpsites.net/web-design/change-layout-genesis/
*/
function full_width_layout_archives( $opt ) {
if ( is_single() ) {
    $opt = 'full-width-content'; 
    return $opt;
 
    } 
}


// Contacts
add_action('genesis_entry_content','contactses');
function contactses() {
	if ( get_field('top_contacts') ) {
		echo '<div style="clear:both;display:block">';
		foreach ( get_field('top_contacts') as $top ) {
			echo '<div class="thirds">';
				if ( $top['headline'] ) {
					echo '<strong>'.$top['headline'].'</strong><br>';
				}
				if ( $top['text'] ) {
					echo $top['text'];
				}
				if ( $top['links'] ) {
					foreach ( $top['links'] as $link ) {
						if( $link['link_type'] == 'tel') {
							echo 'Tel <a href="tel:'.$link['link'].'">';
						}
						if( $link['link_type'] == 'fax') {
							echo 'Fax ';
						}
						if( $link['link_type'] == 'mail') {
							echo 'Email <a href="mailto:'.$link['link'].'">';
						}
						
						
						echo $link['link'];
						
						if( $link['link_type'] == 'tel') {
							echo '</a>';
						}
						if( $link['link_type'] == 'mail') {
							echo '</a>';
						}
						echo '<br>';
					}
				}
			echo '</div>';
		}
		echo '<hr>'; 
		echo '</div>';
	}
	
	if ( get_field('bottom_contacts') ) {
		echo '<div style="clear:both;display:block">';
		foreach ( get_field('bottom_contacts') as $bottop ) {
			echo '<div class="thirds">';
				
				if ( $bottop['headline'] ) {
					echo '<strong>'.$bottop['headline'].'</strong><br>';
				}
				
				if ( $bottop['name'] ) {
					echo $bottop['name'].'<br>';
				}
				
				if ( $bottop['links'] ) {
					foreach ( $bottop['links'] as $botlink ) {
						echo $botlink['left_field'].' ';
						if( $botlink['link_type'] == 'tel') {
							echo '<a href="tel:'.$botlink['right_field'].'">';
						}
						if( $botlink['link_type'] == 'mail') {
							echo '<a href="mailto:'.$botlink['right_field'].'">';
						}
						
						echo $botlink['right_field'];
						
						if( $botlink['link_type'] == 'tel') {
							echo '</a>';
						}
						if( $botlink['link_type'] == 'mail') {
							echo '</a>';
						}
						echo '<br>';
					}
				}
				
			echo '</div>';
		}
		echo '<hr>'; 
		echo '</div>';
	}
	
}


add_action( 'genesis_site_title', function() {
	
	if(ICL_LANGUAGE_CODE=='sv') {
		
		?>
		
		<img class="anniversary" src="<?php echo site_url(); ?>/wp-content/uploads/eletta_70_en.png" />
		
		<?php
	
	}
	
	if(ICL_LANGUAGE_CODE=='en') {
		
		?>
		
		<img class="anniversary" src="<?php echo site_url(); ?>/wp-content/uploads/eletta_70_en.png" />
		
		<?php
		
	}
	
	if(ICL_LANGUAGE_CODE=='de') {
		
		?>
		
		<img class="anniversary" src="<?php echo site_url(); ?>/wp-content/uploads/eletta_70_de.png" />
		
		<?php
	
	}
	
	if(ICL_LANGUAGE_CODE=='fr') {
		
		?>
		
		<img class="anniversary" src="<?php echo site_url(); ?>/wp-content/uploads/eletta_70_fr.png" />
		
		<?php
		
	}
	
});

