(function ($) {
	'use strict';
	if ( $('.cosmic_widgets.widget_cosmic_text_slider').length ) {
		var slider_id = '',
			arrows = '',
			dots = '',
			slides = '',
			center = '',
			autoplay = '';
		$('.widget_cosmic_text_slider').map( function() {
			slider_id = $(this).attr('id'),
			arrows = $(this).data('arrow'),
			dots = $(this).data('dots');
			center = $(this).data('center');
			slides = $(this).data('slides');
			autoplay = $(this).data('autoplay');
			$('#'+slider_id+' .cosmic_slider').slick({
				dots: dots,
				arrows: arrows,
				infinite: true,
				autoplay: autoplay,
				autoplaySpeed: 3000,
				slidesToShow: parseInt( slides ),
				centerMode: center,
				centerPadding: '150px',
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
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							centerPadding: '0',
							centerMode: false,
							dots: true,
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
							centerPadding: '20px',
							centerMode: false,
							dots: true,
						}
					}
				]
			});
		});
	}
} (jQuery));