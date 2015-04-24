<?php
/*
 * Plugin: Accessible Poetry
 * Version: 1.0.0 alpha
 * Author: Amit Moreno
 *
 * Page: Skiplinks (inc/acp_skiplinks.php)
 */

function acp_register_skiplinks_style() {
	wp_register_style( 'skiplinks', plugins_url( 'accessible-poetry/css/skiplinks.css' ) );
	wp_enqueue_style( 'skiplinks' );
}
function acp_register_skiplinks_menu() {
	register_nav_menu( 'skiplinks', __( 'Skiplinks', 'acp' ) );
}
function acp_skiplinks_after_body() {
	
	$menu_name = 'skiplinks';

    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		
		$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		$menu_items = wp_get_nav_menu_items($menu->term_id);
		$menu_side = get_option( 'acp_skiplinks_side', false );
		$menu_list = '<ul id="acp_skiplinks" role="navigation" class="' . $menu_side . '">';

		foreach ( (array) $menu_items as $key => $menu_item ) {
	    	$title = $menu_item->title;
			$url = $menu_item->url;
			$menu_list .= '<li><a href="' . $url . '" class="skiplinks">' . $title . '</a></li>';
		}
		$menu_list .= '</ul></nav>';
    } else {
		$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
    }
?>
<!-- Accessible Poetry Skiplinks -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery('body').prepend('<?php echo $menu_list; ?>');
	
	jQuery( document ).ready(function() {
        jQuery(".skiplinks").click(function(event){
            var skipTo="#"+this.href.split('#')[1];
    
            jQuery(skipTo).attr('tabindex', -1).on('blur focusout', function () {
                jQuery(this).removeAttr('tabindex');
            }).focus();
        });
    });
});
</script>
<?php
}

if( get_option( 'acp_skiplinks', false ) ) {
	add_action( 'wp_enqueue_scripts', 'acp_register_skiplinks_style' );
	add_action( 'after_setup_theme', 'acp_register_skiplinks_menu' );
	add_action( 'wp_head', 'acp_skiplinks_after_body');
}

/* Beautiful friend */