<?php
/**
*	Plugin name: iGoMoon Cookie Banner
*	Description: Displays a cookie disclaimer in accordance with the EU directive.
*	Version: 1.0
*	Plugin URI: https://www.igomoon.com
*	Author: iGoMoon
*	Author URI: https://www.igomoon.com
*	Text Domain: igomoon-cookie-banner
*	License: GPL-2.0+
*/

add_action('wp_enqueue_scripts', 'igm_cookie_script');
function igm_cookie_script()
{
	wp_enqueue_script('js-cookie', plugin_dir_url( __FILE__ ) . 'js.cookie.js', array( 'jquery' ) );
	wp_enqueue_script('cookiescript', plugin_dir_url( __FILE__ ) . 'cookiescript.js', array( 'jquery', 'js-cookie' ) );
	wp_enqueue_style('cookiestyle', plugin_dir_url( __FILE__ ) . 'cookiestyle.css' );
}

add_action( 'admin_enqueue_scripts', 'igm_cookie_enqueue_color_picker' );
function igm_cookie_enqueue_color_picker( $hook_suffix )
{
	if($hook_suffix == 'toplevel_page_igm-cookiejar-settings')
	{
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'cookiepick', plugins_url('cookiepick.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
		wp_enqueue_style('cookie-jar-admin', plugins_url('admin.css', __FILE__));
	}
}

add_action('admin_menu', 'igm_cookiejar_menu');
function igm_cookiejar_menu()
{
	add_menu_page('Cookie Banner Settings', 'Cookie Banner Settings', 'administrator', 'igm-cookiejar-settings', 'igm_cookiejar_settings_page', 'dashicons-admin-generic');
}

function igm_cookiejar_settings_page()
{
	$languages = new IGMLanguages();
	$option = new IGMOption;
	?>

   <div class="wrap">
      <h2>Cookie Banner</h2>

		<h3 class="nav-tab-wrapper">
			<?php
			foreach($languages->getLanguages() as $language)
			{
				?>
				<a class="nav-tab <?php echo $language["active"] ? "active" : ""; ?>" data-tab="<?php echo $language['code'];?>"><?php echo $language['translated_name']; ?></a>
				<?php
			}
			?>
		</h3>

      <form method="post" action="options.php">
         <?php settings_fields( 'igm-cookiejar-settings-group' ); ?>
         <?php do_settings_sections( 'igm-cookiejar-settings-group' ); ?>
			<?php foreach($languages->getLanguages() as $language): ?>
			<?php $option->lang($language['code']); ?>

			<div class="tab-content <?php echo $language['active'] ? 'active' : ''; ?>" data-tab="<?php echo $language['code']; ?>">
	         <table class="form-table">
	            <tr valign="top">
	            	<th scope="row"><?php _e('Content', 'igomoon-cookie-banner'); ?></th>
	            	<td><textarea type="text" row="50" cols="40" name="igm_cookie_data[<?php echo $language['code']; ?>][text_first];"><?php echo esc_attr( $option->get('text_first')); ?></textarea></td>
	            </tr>

					<tr valign="top">
	            	<th scope="row"><?php _e('Content color', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="text" name="igm_cookie_data[<?php echo $language['code']; ?>][content_color];" class="igm-color-field" value="<?php echo esc_attr( $option->get('content_color') ); ?>" /></td>
	            </tr>

	            <tr valign="top">
	            	<th scope="row"><?php _e('Set background', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="text" name="igm_cookie_data[<?php echo $language['code']; ?>][set_bc];" class="igm-color-field" value="<?php echo esc_attr( $option->get('set_bc') ); ?>" /></td>
	            </tr>

	            <tr valign="top">
	            	<th scope="row"><?php _e('Button 1 - Text', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="text" name="igm_cookie_data[<?php echo $language['code']; ?>][button1_text];" value="<?php echo esc_attr( $option->get('button1_text') ); ?>" /></td>
	            </tr>

	            <tr valign="top">
	            	<th scope="row"><?php _e('Button 1 - Color', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="text" name="igm_cookie_data[<?php echo $language['code']; ?>][button1_color];" class="igm-color-field" value="<?php echo esc_attr( $option->get('button1_color') ); ?>" /></td>
	            </tr>

					<tr valign="top">
	            	<th scope="row"><?php _e('Button 1 - Text color', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="text" name="igm_cookie_data[<?php echo $language['code']; ?>][button1_textcolor];" class="igm-color-field" value="<?php echo esc_attr( $option->get('button1_textcolor') ); ?>" /></td>
	            </tr>

	            <tr valign="top">
	            	<th scope="row"><?php _e('Button 2 - Text', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="text" name="igm_cookie_data[<?php echo $language['code']; ?>][button2_text];" value="<?php echo esc_attr( $option->get('button2_text') ); ?>" /></td>
	            </tr>

	            <tr valign="top">
	            	<th scope="row"><?php _e('Button 2 - Color', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="text" name="igm_cookie_data[<?php echo $language['code']; ?>][button2_color];" class="igm-color-field" value="<?php echo esc_attr( $option->get('button2_color') ); ?>" /></td>
	            </tr>

					<tr valign="top">
	            	<th scope="row"><?php _e('Button 2 - Text color', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="text" name="igm_cookie_data[<?php echo $language['code']; ?>][button2_textcolor];" class="igm-color-field" value="<?php echo esc_attr( $option->get('button2_textcolor') ); ?>" /></td>
	            </tr>

	            <tr valign="top">
	            	<th scope="row"><?php _e('Button 2 - Link', 'igomoon-cookie-banner'); ?></th>
		            <td>
							<?php $query_posts = new WP_Query([
								'showposts' => -1,
								'post_type' => ['post']
							]);
							$query_pages = new WP_Query([
								'showposts' => -1,
								'post_type' => ['page']
							]); ?>
							<select name="igm_cookie_data[<?php echo $language['code']; ?>][button2_link];" id="igm-dropdown">
								<optgroup label="Pages">
									<?php foreach( $query_pages->posts as $post ): ?>
										<option <?php echo $post->ID == $option->get('button2_link') ? 'selected' : ''; ?> value="<?php echo $post->ID?>"><?php echo $post->post_title ?></option>
									<?php endforeach; ?>
								</optgroup>

								<optgroup label="Posts">
									<?php foreach( $query_posts->posts as $post ): ?>
										<option <?php echo $post->ID == $option->get('button2_link') ? 'selected' : ''; ?> value="<?php echo $post->ID?>"><?php echo $post->post_title ?></option>
									<?php endforeach; ?>
								</optgroup>
							</select>
						</td>
	            </tr>

	            <tr valign="top">
	            	<th scope="row"><?php _e('Disable', 'igomoon-cookie-banner'); ?></th>
	            	<td><input type="checkbox" name="igm_cookie_data[<?php echo $language['code']; ?>][check_dis]" value="true" <?php if ( $option->get('check_dis') == 'true' ) { echo 'checked'; }?> /></td>
	            </tr>

					<tr valign="top">
	            	<th scope="row"><?php _e('Set position', 'igomoon-cookie-banner'); ?></th>
	            	<td>
							<input type="radio" name="igm_cookie_data[<?php echo $language['code']; ?>][cookie_pos]" value="top" <?php if ( $option->get('cookie_pos') == 'top' ) { echo 'checked'; }?> >Top
							<input type="radio" name="igm_cookie_data[<?php echo $language['code']; ?>][cookie_pos]" value="bottom" <?php if ( $option->get('cookie_pos') == 'bottom' ) { echo 'checked'; }?> >Bottom
						</td>
	            </tr>
	         </table>
			</div>
			<?php endforeach; ?>
         <?php submit_button(); ?>
      </form>
   </div>
<?php
}

add_action( 'admin_init', 'igm_cookiejar_settings' );
function igm_cookiejar_settings()
{
	register_setting('igm-cookiejar-settings-group', 'igm_cookie_data');
}

add_action( 'wp_footer', 'display_igm_cookiejar' );
function display_igm_cookiejar()
{
	$languages = new IGMLanguages();
	$option = (new IGMOption())->lang($languages->currentLanguage());

	if ($option->get('check_dis') == 'true')
	{
		return;
	}
	?>
	<div class="the-cookiejar hide-cookie" style="background-color:<?php echo $option->get('set_bc')?>; <?php echo $option->get('cookie_pos')?>: 0;">
		<div class="cookie-text" style="color:<?php echo $option->get('content_color')?>">
			<?php echo $option->get('text_first'); ?>
		</div>

		<div class="cookie-buttons">
			<button class="button ok-btn cookie-btn" style="background-color:<?php echo $option->get('button1_color') ?>; color: <?php echo $option->get('button1_textcolor') ?>"><?php echo $option->get('button1_text'); ?></button>

			<?php if ($option->get('button2_text') !== '' )
			{
			?>
				<button class="button link-btn cookie-btn" style="margin-right: 10px; margin-left: 10px; background-color:<?php echo $option->get('button2_color') ?>"><a href="<?php echo esc_url( get_permalink($option->get('button2_link'))) ?>" style="color:<?php echo $option->get('button2_textcolor') ?>"><?php echo $option->get('button2_text')?></a></button>
		 	<?php
			}
			?>
		</div>
	</div>
	<?php
}

class IGMOption
{
	private $option;
	private $lang;

	public function __construct()
	{
		$this->option = get_option('igm_cookie_data');
	}
	public function lang($lang_code)
	{
		$this->lang = $lang_code;
		return $this;
	}
	public function get($key)
	{
		return isset($this->option[$this->lang][$key]) ? $this->option[$this->lang][$key] : '';
	}
}

class IGMLanguages
{
	private $activeLanguages;
	private $currentLanguage;

	public function __construct()
	{
		if(defined('ICL_LANGUAGE_CODE'))
		{
			$this->activeLanguages = icl_get_languages();
			$this->currentLanguage = ICL_LANGUAGE_CODE;
		}
		else
		{
			$code = explode('_', get_locale())[0];
			$this->activeLanguages = [
				$code => [
					'code' => $code,
					'translated_name' => 'Default',
					'active' => 1
				]
			];
			$this->currentLanguage = $code;
		}
	}

	public function getLanguages()
	{
		return $this->activeLanguages;
	}

	public function currentLanguage()
	{
		return $this->currentLanguage;
	}
}
