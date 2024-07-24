(function ($) {
	'use strict';
	if ( $('.cosmic_widgets.widget_cosmic_clients_carousel').length ) {
		var slider_id = '',
			arrows = '',
			dots = '';
		$('.widget_cosmic_clients_carousel').map( function() {
			slider_id = $(this).attr('id'),
			arrows = $(this).data('arrows'),
			dots = $(this).data('dots');
			$('#'+slider_id+' .cosmic_slider').slick({
				dots: dots,
				arrows: arrows,
				infinite: true,
				autoplay: true,
				autoplaySpeed: 3000,
				slidesToShow: 6,
				slidesToScroll: 1,
				speed: 1000,
				prevArrow: '<button type="button" class="slick-prev"><i class="fal fa-chevron-left"></i></button>',
				nextArrow: '<button type="button" class="slick-next"><i class="fal fa-chevron-right"></i></button>',
				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
							infinite: true,
							dots: true
						}
					},
					{
						breakpoint: 600,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1
						}
					}
				]
			});
		});
	}
} (jQuery));