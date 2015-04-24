<?php
/**
 * Plugin Name: Accessible Poetry
 * Plugin URI: http://acp.amitmoreno.com/
 * Description: Accessibility plugin for WordPress.
 * Version: 1.0.0 alpha
 * Author: Amit Moreno
 * Author URI: http://www.amitmoreno.com/
 * Text Domain: acp
 * License: GPL2
 */

// Plugin Init

function acp_init() {
	wp_register_style( 'accessible-poetry', plugins_url('style.css', __FILE__) );
	
	register_setting( 'accessible-poetry', 'acp_skiplinks' );
	register_setting( 'accessible-poetry', 'acp_skiplinks_side' );
	register_setting( 'accessible-poetry', 'acp_rolelink' );
	register_setting( 'accessible-poetry', 'acp_fontsizer' );
	register_setting( 'accessible-poetry', 'acp_removetarget' );
	register_setting( 'accessible-poetry', 'acp_toolbar' );
	register_setting( 'accessible-poetry', 'acp_toolbar_special' );
	register_setting( 'accessible-poetry', 'acp_toolbar_side' );
	register_setting( 'accessible-poetry', 'acp_toolbar_eye' );
	register_setting( 'accessible-poetry', 'acp_contrast' );
	register_setting( 'accessible-poetry', 'acp_contrast_bright' );
	register_setting( 'accessible-poetry', 'acp_contrast_bright_bg' );
	register_setting( 'accessible-poetry', 'acp_contrast_bright_text' );
	register_setting( 'accessible-poetry', 'acp_contrast_bright_link' );
	register_setting( 'accessible-poetry', 'acp_contrast_disable_bright' );
	register_setting( 'accessible-poetry', 'acp_contrast_dark' );
	register_setting( 'accessible-poetry', 'acp_contrast_dark_bg' );
	register_setting( 'accessible-poetry', 'acp_contrast_dark_text' );
	register_setting( 'accessible-poetry', 'acp_contrast_dark_link' );
	register_setting( 'accessible-poetry', 'acp_contrast_disable_dark' );
	register_setting( 'accessible-poetry', 'acp_imagealt' );
	
}
add_action( 'admin_init', 'acp_init' );

function acp_locale() {
  load_plugin_textdomain('acp', FALSE, dirname(plugin_basename(__FILE__)).'/lang/'); 
}
add_action( 'plugins_loaded', 'acp_locale' );
/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
 */


// Add the setting Sub Page

function acp_setting_page() {
	add_submenu_page(
		'tools.php',
		'Accessible Poetry',
		'Accessible Poetry',
		'manage_options',
		'accessible-poetry',
		'acp_page_callback' );
}

if ( is_admin() ){
	add_action('admin_menu', 'acp_setting_page');
	add_action( 'admin_init', 'acp_init' );
}

function acp_page_callback() {
	wp_enqueue_style( 'accessible-poetry' );
?>
<div id="accessible-poetry" class="wrap">
	<header class="plugin-header">
		<h2>Accessible Poetry</h2>
		<div class="plugin-version"><?php _e('Version', 'acp');?>: 1.0.0</div>
		<div class="plugin-author"><?php _e('Author', 'acp');?>: <a href="http://www.amitmoreno.com/" target="_blank" aria-label="Open the Author Page in a new window">Amit Moreno</a></div>
	</header>
	
	<section class="acp-panel" tabindex="0">
		<h1><?php _e('Welcome to Accessible Poetry!', 'acp');?></h1>
		<p class="lead"><?php _e('Here you can find some general options to perform a better accessibility WordPress website.', 'acp');?></p>
		<p><?php _e('Please visit our', 'acp');?> <a href="#" role="link" aria-label="<?php _e('Go to our Plugin Page', 'acp');?>"><?php _e('Plugin Page', 'acp');?></a> <?php _e('and ', 'acp');?><a href="#" role="link" aria-label="<?php _e('Rate Us on our Plugin Page', 'acp');?>"><?php _e('Rate Us', 'acp');?></a>.</p>
	</section>
	
	<section>
		<form method="post" action="options.php">
			
			<?php settings_fields( 'accessible-poetry' ); ?>
			<?php do_settings_sections( 'accessible-poetry' ); ?>
			
			<section class="acp-field" tabindex="0">
				<h3><?php _e('Skiplinks', 'acp');?></h3>
				<p><?php _e('Before you start, you should check if your theme has already got Skiplinks (you can check it by pressing the Tab button when you land on your home page, the Skiplinks need to be the first links that will be focused to a keyboard surfer).', 'acp');?></p>
				<div class="acp-field-wrap">
					<input name="acp_skiplinks" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_skiplinks' ) ); ?> />
					<label for="acp_skiplinks"><?php _e('Use Skiplinks', 'acp');?></label>
				</div>
				<p><?php _e('After activating this option a new menu will be registered with your built-in "Menus" of WP. You then will need to add "Links" to it that points the area that you want to target to, for example if the Name of the Skiplink is: "Skip to Content", so the value of the link will probably be "#content".', 'acp');?></p>
				<div class="acp-field-wrap">
					<label for="acp_skiplinks_side"><?php _e('Skiplinks Side', 'acp');?></label>
					<select id="acp_skiplinks_side" name="acp_skiplinks_side">
						<option value="none" <?php if ( get_option('acp_skiplinks_side') == 'none' ) echo 'selected="selected"'; ?>>Center (default)</option>
						<option value="left" <?php if ( get_option('acp_skiplinks_side') == 'left' ) echo 'selected="selected"'; ?>>Left</option>
						<option value="right" <?php if ( get_option('acp_skiplinks_side') == 'right' ) echo 'selected="selected"'; ?>>Right</option>
					</select>
				</div>
			</section>
			
			<section class="acp-field" tabindex="0">
				<h3><?php _e('Font Sizer', 'acp');?></h3>
				<div class="acp-field-wrap">
					<input name="acp_fontsizer" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_fontsizer' ) ); ?> />
					<label for="acp_fontsizer"><?php _e('Include the scripts for changing the font size?', 'acp');?></label>
				</div>
			</section>	
			<section class="acp-field">
				<h3>Contrast</h3>
				<div class="acp-field-wrap">
					<input name="acp_contrast" id="acp_contrast" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast' ) ); ?> />
					<label for="acp_contrast"><?php _e('Include the scripts for changing the Contrast?', 'acp');?></label>
				</div>
				
				<section id="acp-contrast_options" tabindex="0" class="hidden">
					<hr />
					<div class="acp-field-wrap">
						<input name="acp_contrast_bright" id="acp_contrast_bright" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast_bright' ) ); ?> />
						<label for="acp_contrast_bright"><?php _e('Use custom colors for the Bright option.', 'acp');?></label>
					</div>
					<section id="acp-bright-set" class="hidden">
						<div class="acp-field-wrap">
							<input name="acp_contrast_bright_bg" type="text" value=<?php if( get_option( 'acp_contrast_bright_bg' ) ){echo get_option( 'acp_contrast_bright_bg' );} ?> placeholder="default: #fff"  />
							<label for="acp_contrast_bright_bg"><?php _e('Custom Color for the Background in the Bright option.', 'acp');?></label>
						</div>
						<div class="acp-field-wrap">
							<input name="acp_contrast_bright_text" type="text" value="<?php if( get_option( 'acp_contrast_bright_text' ) ){echo get_option( 'acp_contrast_bright_text' );} ?>" placeholder="default: #333"  />
							<label for="acp_contrast_bright_text"><?php _e('Custom Color for the Text in the Bright option.', 'acp');?></label>
						</div>
						<div class="acp-field-wrap">
							<input name="acp_contrast_bright_link" type="text" value="<?php if( get_option( 'acp_contrast_bright_link' ) ){echo get_option( 'acp_contrast_bright_link' );} ?>" placeholder="default: website defaults"  />
							<label for="acp_contrast_bright_link"><?php _e('Custom Color for the Link in the Bright option.', 'acp');?></label>
						</div>
						<div class="acp-field-wrap">
							<input name="acp_contrast_disable_bright" id="acp_contrast_disable_bright" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast_disable_bright' ) ); ?> />
							<label for="acp_contrast_disable_bright"><?php _e('Don\'t use any style for the Bright option.', 'acp');?></label>
						</div>
					</section>
					<hr />
					<div class="acp-field-wrap">
						<input name="acp_contrast_dark" id="acp_contrast_dark" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast_dark' ) ); ?> />
						<label for="acp_contrast_dark"><?php _e('Use custom colors for the Dark option.', 'acp');?></label>
					</div>
					<section id="acp-dark-set" class="hidden">
						<div class="acp-field-wrap">
							<input name="acp_contrast_dark_bg" type="text" value="<?php if( get_option( 'acp_contrast_dark_bg' ) ){echo get_option( 'acp_contrast_dark_bg' );} ?>" placeholder="default: #333"  />
							<label for="acp_contrast_dark_bg"><?php _e('Custom Color for the Background in the Dark option.', 'acp');?></label>
						</div>
						<div class="acp-field-wrap">
							<input name="acp_contrast_dark_text" type="text" value="<?php if( get_option( 'acp_contrast_dark_text' ) ){echo get_option( 'acp_contrast_dark_text' );} ?>" placeholder="default: #fff"  />
							<label for="acp_contrast_dark_text"><?php _e('Custom Color for the Text in the Dark option.', 'acp');?></label>
						</div>
						<div class="acp-field-wrap">
							<input name="acp_contrast_dark_link" type="text" value="<?php if( get_option( 'acp_contrast_dark_link' ) ){echo get_option( 'acp_contrast_dark_link' );} ?>" placeholder="default: #ffff88"  />
							<label for="acp_contrast_dark_link"><?php _e('Custom Color for the Link in the Dark option.', 'acp');?></label>
						</div>
						<div class="acp-field-wrap">
							<input name="acp_contrast_disable_dark" id="acp_contrast_disable_dark" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast_disable_dark' ) ); ?> />
							<label for="acp_contrast_disable_dark"><?php _e('Don\'t use any style for the Dark option.', 'acp');?></label>
						</div>
					</section>
				</section>
			</section>
			
			<section class="acp-field" tabindex="0">
				<h3><?php _e('Toolbar', 'acp');?></h3>
				<div class="acp-field-wrap">
					<input name="acp_toolbar" id="acp_toolbar" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_toolbar' ) ); ?> />
					<label for="acp_toolbar"><?php _e('Enable the Toolbar.', 'acp');?></label>
				</div>
				
				<section id="acp-special_toolbar" class="hidden">
					
					<h4>Special Toolbar</h4>
					<div class="acp-field-wrap">
						<input name="acp_toolbar_special" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_toolbar_special' ) ); ?> />
						<label for="acp_toolbar_special"><?php _e('Display the Special Toolbar?', 'acp');?></label>
					</div>
					<div class="acp-field-wrap">
						<input name="acp_toolbar_eye" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_toolbar_eye' ) ); ?> />
						<label for="acp_toolbar_eye"><?php _e('Include the eye button?', 'acp');?></label>
					</div>
					<div class="acp-field-wrap">
						<label for="acp_toolbar_side"><?php _e('Special Toolbar Side', 'acp');?></label>
						<select id="acp_toolbar_side" name="acp_toolbar_side">
							<option value="left" <?php if ( get_option('acp_toolbar_side') == 'left' ) echo 'selected="selected"'; ?>>Left</option>
							<option value="right" <?php if ( get_option('acp_toolbar_side') == 'right' ) echo 'selected="selected"'; ?>>Right</option>
						</select>
					</div>
					<hr />
					<p>If you don't want to use the Special Toolbar you can embed an accessibility menu to everywhere you want with the shortcode: <code>[acp_toolbar]</code>, or with the php function: <code>&lt;?php acp_toolbar_nav(); ?&gt;</code>.</p>
					
				</section>
			</section>
			
			<section class="acp-field" tabindex="0">
				<h3><?php _e('Links', 'acp');?></h3>
				<div class="acp-field-wrap">
					<input name="acp_rolelink" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_rolelink' ) ); ?> />
					<label for="acp_rolelink"><?php _e('Add role="link" to all the &lt;a&gt; tag.', 'acp');?></label>
				</div>
				<div class="acp-field-wrap">
					<input name="acp_removetarget" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_removetarget' ) ); ?> />
					<label for="acp_removetarget"><?php _e('Force Open links in current tab (Remove the "target" attribute from all links).', 'acp');?></label>
				</div>
			</section>
			
			<section class="acp-field" tabindex="0">
				<h3><?php _e('Images', 'acp');?></h3>
				<div class="acp-field-wrap">
					<input name="acp_imagealt" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_imagealt' ) ); ?> />
					<label for="acp_imagealt"><?php _e('Force alt="" to all Images.', 'acp');?></label>
				</div>
			</section>
			<?php submit_button(); ?>
		</form>
	</section>
	<footer>
		<p>Did you find any problem with this plugin? please <a href="#">Tell Us</a> about it.</p>
	</footer>
<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#acp_toolbar').click(function() {
  		$('#acp-special_toolbar').fadeToggle(400);
	});
	if ($('#acp_toolbar:checked').val() !== undefined) {
		$('#acp-special_toolbar').show();
	}
	
	$('#acp_contrast').click(function() {
  		$('#acp-contrast_options').fadeToggle(400);
	});
	if ($('#acp_contrast:checked').val() !== undefined) {
		$('#acp-contrast_options').show();
	}
	
	$('#acp_contrast_bright').click(function() {
  		$('#acp-bright-set').fadeToggle(400);
	});
	if ($('#acp_contrast_bright:checked').val() !== undefined) {
		$('#acp-bright-set').show();
	}
	
	$('#acp_contrast_dark').click(function() {
  		$('#acp-dark-set').fadeToggle(400);
	});
	if ($('#acp_contrast_dark:checked').val() !== undefined) {
		$('#acp-dark-set').show();
	}

});
</script>
</div>
<?php
}

include 'inc/acp_toolbar.php';

include 'inc/acp_skiplinks.php';
include 'inc/acp_rolelinks.php';
include 'inc/acp_removetarget.php';
include 'inc/acp_fontsizer.php';
include 'inc/acp_imagealt.php';
include 'inc/acp_contrast.php';


/* Beautiful friend */