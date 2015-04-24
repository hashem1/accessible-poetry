<?php
/*
 * Plugin: Accessible Poetry
 * Version: 1.0.0 alpha
 * Author: Amit Moreno
 *
 * Page: Image Alt (inc/acp_imagealt.php)
 */

function acp_imagealt_scripts() { ?>
<!-- Accessible Image Alt -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery( document ).ready(function() {
		jQuery("img").each(function() {
			var img = jQuery(this);
			if (!img.attr("alt") || img.attr("alt") == "")
				img.attr("alt", " ");
		});
	});
});
</script>
<?php
}
if( get_option( 'acp_imagealt', false ) ) {
	add_action( 'wp_head', 'acp_imagealt_scripts');
}

/* Beautiful friend */