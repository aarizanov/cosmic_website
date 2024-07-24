(function ($) {
	'use strict';
	if ( $('.cosmic_widgets.widget_cosmic_posts_carousel').length ) {
		var slider_id = '',
			arrows = '',
			dots = '',
			slides = '',
			autoplay = '';
		$('.widget_cosmic_posts_carousel').map( function() {
			slider_id = $(this).attr('id');
			arrows = $(this).data('arrows');
			dots = $(this).data('dots');
			slides = parseInt( $(this).data('num') );
			console.log(slides);
			autoplay = $(this).data('autoplay');
			$('#'+slider_id+' .cosmic_slider').slick({
				dots: dots,
				arrows: arrows,
				infinite: true,
				autoplay: autoplay,
				autoplaySpeed: 3000,
				slidesToShow: slides,
				slidesToScroll: 1,
				speed: 1000,
				prevArrow: '<button type="button" class="slick-prev"><i class="fal fa-chevron-left"></i></button>',
				nextArrow: '<button type="button" class="slick-next"><i class="fal fa-chevron-right"></i></button>',
				responsive: [
					{
						breakpoint: 1484,
						settings: {
							dots: true,
							arrows: false,
						}
					},
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
							dots: true,
							arrows: false,
						}
					},
					{
						breakpoint: 700,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
							arrows: false,
						}
					},
					{
						breakpoint: 560,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
							arrows: false,
						}
					}
				]
			});
		});
	}
} (jQuery));