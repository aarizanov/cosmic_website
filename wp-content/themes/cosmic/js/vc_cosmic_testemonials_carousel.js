(function ($) {
	'use strict';
	if ( $('.cosmic_widgets.widget_cosmic_testemonials_carousel').length ) {
		var slider_id = '',
			arrows = '',
			dots = '';
		$('.widget_cosmic_testemonials_carousel').map( function() {
			slider_id = $(this).attr('id'),
			arrows = $(this).data('arrows'),
			dots = $(this).data('dots');
			$('#'+slider_id+' .cosmic_slider').slick({
				dots: dots,
				arrows: arrows,
				infinite: true,
//				autoplay: true,
				autoplaySpeed: 5000,
				slidesToScroll: 1,
				centerMode: true,
				centerPadding: '0',
				slidesToShow: 3,
				speed: 1000,
				prevArrow: '<button type="button" class="slick-prev"><i class="fal fa-chevron-left"></i></button>',
				nextArrow: '<button type="button" class="slick-next"><i class="fal fa-chevron-right"></i></button>',
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							infinite: true,
							dots: true,
							arrows: false,
						}
					}
				]
			});
		});
	}
} (jQuery));