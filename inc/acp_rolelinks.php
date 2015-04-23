<?php
/*
 * Plugin: Accessible Poetry
 * Version: 1.0.0 alpha
 * Author: Amit Moreno
 *
 * Page: Role Links (inc/acp_rolelinks.php)
 */

function acp_rolelink_scripts() { ?>
<!-- Accessible Poetry Role Link -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery( document ).ready(function() {
    	jQuery('a').attr('role', 'link');
	});
});
</script>
<?php
}
if( get_option( 'acp_rolelink', false ) ) {
	add_action( 'wp_head', 'acp_rolelink_scripts');
}

/* Beautiful friend */