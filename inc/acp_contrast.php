<?php
/*
 * Plugin: Accessible Poetry
 * Version: 1.0.0 alpha
 * Author: Amit Moreno
 *
 * Page: Image Alt (inc/acp_contrast.php)
 */

function acp_contrast_scripts() { ?>
<!-- Accessible Contrast -->
<style>
body.bright {
	background: #fff !important;
	color: #333 !important;
}
body.bright a {
}
body.dark {
	background: #333 !important;
	color: #fff !important;
}
body.dark a {
	color: #ffff88 !important;
}
</style>
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery(document).ready(function($) {
	 	$( '#dark_class' ).click( function () {
	 		$( 'body' ).removeClass( 'bright' ).addClass( 'dark' );
		});

		$( '#dark_remove' ).click( function () {
			$( 'body' ).removeClass( 'dark' ).addClass( 'bright' );
		});     
	});
});
</script>
<?php
}
if( get_option( 'acp_contrast', false ) ) {
	add_action( 'wp_head', 'acp_contrast_scripts');
}

/* Beautiful friend */