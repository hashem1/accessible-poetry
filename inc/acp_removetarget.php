<?php


/* Remove Target _blank */

function acp_removetarget_scripts() { ?>
<!-- Accessible Poetry Remove Target _blank -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery( document ).ready(function() {
    	jQuery('a[target="_blank"]').removeAttr('target');
	});
});
</script>
<?php
}
if( get_option( 'acp_removetarget', false ) ) {
	add_action( 'wp_head', 'acp_removetarget_scripts');
}

/* Beautiful friend */