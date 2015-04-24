<?php
/*
 * Plugin: Accessible Poetry
 * Version: 1.0.0 alpha
 * Author: Amit Moreno
 *
 * Page: Toolbar (inc/acp_toolbar.php)
 */

function acp_register_toolbar_style() {
	wp_register_style( 'acp_toolbar', plugins_url( 'accessible-poetry/css/toolbar.css' ) );
	wp_enqueue_style( 'acp_toolbar' );
}
function acp_toolbar_scripts() {

	// buttons
	$acp_fontsizer = '<button class="small-letter">' . __('a', 'acp') . '</button>';
	$acp_fontsizer .= '<button class="big-letter">' . __('A', 'acp') . '</button>';

	if( get_option( 'acp_fontsizer', false ) || get_option( 'acp_contrast', false ) ) :
?>
<!-- Accessible Toolbar -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery( document ).ready(function() {
    	jQuery('body').prepend('<?php
	    	
	    $toolbar_side = get_option( 'acp_toolbar_side', false );
	    $toolbar_eye = get_option( 'acp_toolbar_eye', false );
	    
	    echo '<nav id="acp_toolbarWrap" role="navigation"  class="';
	    if( get_option( 'acp_fontsizer', false ) && get_option( 'acp_contrast', false ) ) {
		    echo ' double';
	    }
	    if( $toolbar_side ) {
		    echo ' ' . $toolbar_side;
	    }
	    echo '"><ul id="acp_toolbar">';
	    
	    if( get_option( 'acp_fontsizer', false ) ) {
		    echo '<li id="acp-fontsizer">' . $acp_fontsizer . '</li>';
		}
		if( get_option( 'acp_contrast', false ) ) {
			echo '<li id="acp-contrast"><button>' . __('Bright', 'acp') . '</button><button>' . __('Dark', 'acp') . '</button></li>';
		}
		echo '</ul>';
		if( $toolbar_eye ) {
			echo '<button class="acp_hide_toolbar"></button></nav>';
		}
		?>');
	});
	jQuery( document ).ready(function() {
		jQuery(".acp_hide_toolbar").click(function(event){
			jQuery("#acp_toolbarWrap").toggleClass("close");
		});
	});
});
</script>
<?php
	endif;
}
if( get_option( 'acp_toolbar', false ) ) {
	add_action( 'wp_enqueue_scripts', 'acp_register_toolbar_style' );
	add_action( 'wp_head', 'acp_toolbar_scripts');
}

/* Beautiful friend */