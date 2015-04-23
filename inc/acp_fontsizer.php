<?php
/* Font Sizer */

function acp_fontsizer_scripts() { ?>
<!-- Accessible Poetry Font Sizer -->
<script type="text/javascript">
jQuery(window).load(function(){
	jQuery(function($){
		$("#acp-fontsizer li.big-letter input").click(function () {
			$('p, h1, h2, h3').each(function () {
				var fontsize;
				fontsize = parseInt($(this).css('font-size'));
				$(this).css({
					'font-size': (fontsize + 1) + 'px'
         		});
     		});
 		});
 		$(".fontSize-nav li.small-letter input").click(function () {
 			$('p, h1, h2, h3').each(function () {
 				var fontsize;
 				fontsize = parseInt($(this).css('font-size'));
 				$(this).css({
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
}