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
	register_setting( 'accessible-poetry', 'acp_rolelink' );
	register_setting( 'accessible-poetry', 'acp_fontsizer' );
	register_setting( 'accessible-poetry', 'acp_removetarget' );
	register_setting( 'accessible-poetry', 'acp_toolbar' );
	register_setting( 'accessible-poetry', 'acp_contrast' );
}
add_action( 'admin_init', 'acp_init' );

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
	
	<div class="acp-panel">
		<h1><?php _e('Welcome to Accessible Poetry!', 'acp');?></h1>
		<p class="lead"><?php _e('Here you can find some general options to perform a better accessibility WordPress website.', 'acp');?></p>
		<p><?php _e('Please visit our', 'acp');?> <a href="#" role="link" aria-label="<?php _e('Go to our Plugin Page', 'acp');?>"><?php _e('Plugin Page', 'acp');?></a> <?php _e('and ', 'acp');?><a href="#" role="link" aria-label="<?php _e('Rate Us on our Plugin Page', 'acp');?>"><?php _e('Rate Us', 'acp');?></a>.</p>
	</div>
	
	<section>
		<form method="post" action="options.php">
			<?php settings_fields( 'accessible-poetry' ); ?>
			<?php do_settings_sections( 'accessible-poetry' ); ?>
			<section class="acp-field">
				<h3><?php _e('Skiplinks', 'acp');?></h3>
				<p><?php _e('Before you start, you should check if your theme has already got Skiplinks (you can check it by pressing the Tab button when you land on your home page, the Skiplinks need to be the first links that will be focused to a keyboard surfer).', 'acp');?></p>
				<div class="acp-field-wrap">
					<input name="acp_skiplinks" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_skiplinks' ) ); ?> />
					<label for="acp_skiplinks"><?php _e('Use Skiplinks', 'acp');?></label>
				</div>
				<p><?php _e('After activating this option a new menu will be registered with your built-in "Menus" of WP. You then will need to add "Links" to it that points the area that you want to target to, for example if the Name of the Skiplink is: "Skip to Content", so the value of the link will probably be "#content".', 'acp');?></p>
			</section>
			
			<section class="acp-field">
				<h3><?php _e('Links', 'acp');?></h3>
				<div class="acp-field-wrap">
					<input name="acp_rolelink" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_rolelink' ) ); ?> />
					<label for="acp_rolelink"><?php _e('Add role="link" to all the &lt;a&gt; tag.', 'acp');?></label>
				</div>
				<div class="acp-field-wrap">
					<input name="acp_removetarget" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_removetarget' ) ); ?> />
					<label for="acp_removetarget"><?php _e('Remove "target" attribute from all links.', 'acp');?></label>
				</div>
			</section>
			
			<section class="acp-field">
				<h3><?php _e('Toolbar', 'acp');?></h3>
				<div class="acp-field-wrap">
					<input name="acp_toolbar" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_toolbar' ) ); ?> />
					<label for="acp_toolbar"><?php _e('Display the ACP Toolbar.', 'acp');?></label>
				</div>
			</section>
			
			<section class="acp-field">
				<h3><?php _e('Font Sizer', 'acp');?></h3>
				<div class="acp-field-wrap">
					<input name="acp_fontsizer" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_fontsizer' ) ); ?> />
					<label for="acp_fontsizer"><?php _e('Include Scripts for changing the font size.', 'acp');?></label>
					<p><?php _e('To display the font size buttons use this code in your theme:', 'acp');?></p>
					<pre><code>&lt;?php ?&gt;</code></pre>
				</div>
			</section>
			
			<section class="acp-field">
				<h3><?php _e('Contrast', 'acp');?></h3>
				<div class="acp-field-wrap">
					<input name="acp_contrast" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast' ) ); ?> />
					<label for="acp_contrast"><?php _e('Include Scripts for changing the Contrast.', 'acp');?></label>
					<p><?php _e('To display the Contrast buttons use this code in your theme:', 'acp');?></p>
					<pre><code>&lt;?php ?&gt;</code></pre>
				</div>
			</section>
			<?php submit_button(); ?>
		</form>
	</section>
	<footer>
		<p>Did you find any problem with this plugin? please <a href="#">Tell Us</a> about it.</p>
	</footer>
</div>
<?php
}

include 'inc/acp_toolbar.php';

include 'inc/acp_skiplinks.php';
include 'inc/acp_rolelinks.php';
include 'inc/acp_removetarget.php';
include 'inc/acp_fontsizer.php';


/* Beautiful friend */