<?php
/* Font Sizer */

function acp_fontsizer_nav() {
	if( get_option( 'acp_fontsizer', false ) ) : ?>
<nav id="acp_fontsizer_nav" role="navigation">
	<ul id="acp_fontsizer">
		<div id="acp-fontsizer" class="item">
			<label for="acp-fontsizer">Font Size:</label>
			<button class="small-letter">a</button>
			<button class="big-letter">A</button>
		</div>
	</ul>
</nav>
<?php endif;
}

function acp_fontsizer_scripts() { ?>
<!-- Accessible Poetry Font Sizer -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery(function($){
		jQuery("#acp-fontsizer button.big-letter").click(function () {
			jQuery('p, h1, h2, h3').each(function () {
				var fontsize;
				fontsize = parseInt(jQuery(this).css('font-size'));
				jQuery(this).css({
					'font-size': (fontsize + 1) + 'px'
         		});
     		});
 		});
 		jQuery("#acp-fontsizer button.small-letter").click(function () {
 			jQuery('p, h1, h2, h3').each(function () {
 				var fontsize;
 				fontsize = parseInt($(this).css('font-size'));
 				jQuery(this).css({
 					'font-size': (fontsize - 1) + 'px'
         		});
     		});
		});
	});
});
</script>
<?php
}
if( get_option( 'acp_fontsizer', false ) ) {
	add_action( 'wp_head', 'acp_fontsizer_scripts');
	add_shortcode( 'acp_fontsizer', 'acp_fontsizer_nav' );
}