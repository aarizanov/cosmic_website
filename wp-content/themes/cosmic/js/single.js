(function($) {
	'use strict';
	// Sticky sidebar
	if ( $('#sidebar').length ) {
		$('#sidebar').theiaStickySidebar({
			additionalMarginTop: 80,
			additionalMarginBottom : 180,
		});
	}
	// Trigger fancybox
	$('a[href$=".gif"], a[href$=".jpg"], a[href$=".png"], a[href$=".bmp"]').fancybox({
		animationEffect: "zoom",
	});
	$(document).ready( function() {
		if ( $('.single .cosmic_widgets.widget_cosmic_posts_carousel').length ) {
			$('.widget_cosmic_posts_carousel').each( function() {
				$(this).css({
					'opacity' : 1,
					'visibility' : 'visible',
				})
			});
		}
	})
} (jQuery));