<?php
/*
 * Plugin: Accessible Poetry
 * Version: 1.0.0 alpha
 * Author: Amit Moreno
 *
 * Page: Toolbar (inc/acp_toolbar.php)
 */

function acp_toolbar_scripts() { ?>
<!-- Accessible Toolbar -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery( document ).ready(function() {
    	jQuery('body').prepend('<nav role="navigation"><ul id="acp_toolbar"><li><button>A</button><button>a</button></li><li><button>Bright</button><button>Dark</button></li></ul></nav>');
	});
});
</script>
<?php
}
if( get_option( 'acp_rolelink', false ) ) {
	add_action( 'wp_head', 'acp_toolbar_scripts');
}

/* Beautiful friend */