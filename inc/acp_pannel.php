<?php

function acp_panel_init() {	
	// Skiplinks Settings
	register_setting( 'accessible-poetry', 'acp_skiplinks' );
	register_setting( 'accessible-poetry', 'acp_skiplinks_side' );
	// Toolbar Settings
	register_setting( 'accessible-poetry', 'acp_toolbar' );
	register_setting( 'accessible-poetry', 'acp_toolbar_fixed' );
	register_setting( 'accessible-poetry', 'acp_toolbar_side' );
	register_setting( 'accessible-poetry', 'acp_toolbar_eye' );
	// Contrast Settings
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
	// Font Sizer Settings
	register_setting( 'accessible-poetry', 'acp_fontsizer' );
	// Add role to to all links
	register_setting( 'accessible-poetry', 'acp_rolelink' );
	// Remove target Setting
	register_setting( 'accessible-poetry', 'acp_removetarget' );
	// Add alt to all images
	register_setting( 'accessible-poetry', 'acp_imagealt' );
	
}
add_action( 'admin_init', 'acp_panel_init' );

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
	add_action( 'admin_init', 'acp_panel_init' );
}

function acp_page_callback() {
	wp_enqueue_style( 'accessible-poetry' );
?>
<div id="accessible-poetry" class="wrap">
	
	<header class="acp-field" tabindex="0">
		<h1><?php _e('Welcome to Accessible Poetry!', 'acp');?></h1>
		<div class="plugin-version"><span><?php _e('Version', 'acp');?>: 1.0.0</span></div>
		<p class="lead"><?php _e('Here you will find options to perform a better accessibility WordPress website.', 'acp');?></p>
		<p>This plugin is provided by <a href="http://www.Amitmoreno.com/">Amit Moreno.</a> <?php _e('Please visit our', 'acp');?> <a href="#" role="link" aria-label="<?php _e('Go to our Plugin Page', 'acp');?>"><?php _e('Plugin Page', 'acp');?></a> <?php _e('and ', 'acp');?><a href="#" role="link" aria-label="<?php _e('Rate Us on our Plugin Page', 'acp');?>"><?php _e('Rate Us', 'acp');?></a>.</p>
	</header>
	
	<section>
		<form method="post" action="options.php">
			
			<?php settings_fields( 'accessible-poetry' ); ?>
			<?php do_settings_sections( 'accessible-poetry' ); ?>
			
			<section class="acp-field" tabindex="0">
				<h2><?php _e('Skiplinks', 'acp');?></h2>
				<p><?php _e('Before you start, you should check if your theme has already got Skiplinks (you can check it by pressing the Tab button when you land on your home page, the Skiplinks need to be the first links that will be focused to a keyboard surfer).', 'acp');?></p>
				<div class="acp-field-wrap">
					<input name="acp_skiplinks" id="acp_skiplinks" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_skiplinks' ) ); ?> />
					<label for="acp_skiplinks"><?php _e('Enable Skiplinks', 'acp');?></label>
				</div>
				<section id="acp_skiplinks_active" class="hidden">
					<p><?php _e('After activating this option a new menu will be registered with your built-in "Menus" of WP. You then will need to create custom menu and add to it "Links" that points to the area you want to target to, for example if the Name of the Skiplink is: "Skip to Content", so the value of the link will probably be "#content".', 'acp');?></p>
					<div class="acp-field-wrap">
						<label for="acp_skiplinks_side"><?php _e('Skiplinks Side', 'acp');?></label>
						<select id="acp_skiplinks_side" name="acp_skiplinks_side">
							<option value="none" <?php if ( get_option('acp_skiplinks_side') == 'none' ) echo 'selected="selected"'; ?>>Center (default)</option>
							<option value="left" <?php if ( get_option('acp_skiplinks_side') == 'left' ) echo 'selected="selected"'; ?>>Left</option>
							<option value="right" <?php if ( get_option('acp_skiplinks_side') == 'right' ) echo 'selected="selected"'; ?>>Right</option>
						</select>
					</div>
				</section>
			</section>
			<section class="acp-field" tabindex="0">
				<h2><?php _e('Font Sizer', 'acp');?></h2>
				<div class="acp-field-wrap">
					<input name="acp_fontsizer" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_fontsizer' ) ); ?> />
					<label for="acp_fontsizer"><?php _e('Enable Font-Sizer', 'acp');?></label>
					<p>If you wish to use only the Font Sizer wherever you want, you can use the shortcode: <code>[acp_fontsizer]</code> or a direct request to the php function: <code>&lt;?php acp_fontsizer_nav(); ?&gt;</code>.</p>
				</div>
			</section>	
			<section class="acp-field">
				<h2>Contrast</h2>
				<div class="acp-field-wrap">
					<input name="acp_contrast" id="acp_contrast" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast' ) ); ?> />
					<label for="acp_contrast"><?php _e('Enable Contrast', 'acp');?></label>
				</div>
				
				<section id="acp-contrast_options" tabindex="0" class="hidden">
					<h3>Bright Contrast</h3>
					<div class="acp-field-wrap">
							<input name="acp_contrast_disable_bright" id="acp_contrast_disable_bright" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast_disable_bright' ) ); ?> />
							<label for="acp_contrast_disable_bright"><?php _e('Don\'t use any style for the Bright option.', 'acp');?></label>
						</div>
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
						
					</section>
					<h3>Dark Contrast</h3>
					<div class="acp-field-wrap">
							<input name="acp_contrast_disable_dark" id="acp_contrast_disable_dark" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_contrast_disable_dark' ) ); ?> />
							<label for="acp_contrast_disable_dark"><?php _e('Don\'t use any style for the Dark option.', 'acp');?></label>
						</div>
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
						
					</section>
					<hr />
					<p>If you wish to use only the Contrast Navigation wherever you want, you can use the shortcode: <code>[acp_contrast]</code> or a direct request to the php function: <code>&lt;?php acp_contrast_nav(); ?&gt;</code>.</p>
				</section>
			</section>
			
			<section class="acp-field" tabindex="0">
				<h2><?php _e('Toolbar', 'acp');?></h2>
				<p>With the Toolbar you can display the Contrast & the Font Sizer options.</p>
				<div class="acp-field-wrap">
					<input name="acp_toolbar" id="acp_toolbar" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_toolbar' ) ); ?> />
					<label for="acp_toolbar"><?php _e('Enable Toolbar Options', 'acp');?></label>
					
				</div>
				
				<section id="acp-fixed_toolbar" class="hidden">
					
					<h3>Fixed Toolbar</h3>
					<div class="acp-field-wrap">
						<label for="acp_toolbar_side"><?php _e('Choose Side: ', 'acp');?></label>
						<select id="acp_toolbar_side" name="acp_toolbar_side">
							<option value="left" <?php if ( get_option('acp_toolbar_side') == 'left' ) echo 'selected="selected"'; ?>>Left</option>
							<option value="right" <?php if ( get_option('acp_toolbar_side') == 'right' ) echo 'selected="selected"'; ?>>Right</option>
						</select>
					</div>
					<div class="acp-field-wrap">
						<input name="acp_toolbar_fixed" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_toolbar_fixed' ) ); ?> />
						<label for="acp_toolbar_fixed"><?php _e('Display the Fixed Toolbar?', 'acp');?></label>
					</div>
					<div class="acp-field-wrap">
						<input name="acp_toolbar_eye" type="checkbox" value="1" <?php checked( '1', get_option( 'acp_toolbar_eye' ) ); ?> />
						<label for="acp_toolbar_eye"><?php _e('Disable the eye button? (this will disable the option to hide the Fixed Toolbar)', 'acp');?></label>
					</div>
					
					<h3>Shortcode Toolbar</h3>
					<p>If you don't want to use the Fixed Toolbar you can embed an accessibility menu to everywhere you want with the shortcode: <code>[acp_toolbar]</code>, or with the php function: <code>&lt;?php acp_toolbar_nav(); ?&gt;</code>.</p>
					
				</section>
			</section>
			
			<section class="acp-field" tabindex="0">
				<h2><?php _e('Links', 'acp');?></h2>
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
				<h2><?php _e('Images', 'acp');?></h2>
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

	$('#acp_skiplinks').click(function() {
  		$('#acp_skiplinks_active').fadeToggle(400);
	});
	if ($('#acp_skiplinks:checked').val() !== undefined) {
		$('#acp_skiplinks_active').show();
	}
	
	$('#acp_toolbar').click(function() {
  		$('#acp-fixed_toolbar').fadeToggle(400);
	});
	if ($('#acp_toolbar:checked').val() !== undefined) {
		$('#acp-fixed_toolbar').show();
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
