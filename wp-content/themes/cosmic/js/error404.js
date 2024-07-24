(function($) {
	'use strict';
	if ( $('.box-404').length ) {
		$(document).on( 'click', '.box-404', function() {
			if ( $(this).hasClass( 'disabled' ) ) {
				return false;
			}
			$(this).find('.normal').css( 'display', 'none' );
			$(this).find('.fired').css( 'display', 'block' );
			$(this).parents('.vc_col-md-3').siblings().find('.normal').css( 'display', 'none' );
			$(this).parents('.vc_col-md-3').siblings().find('.saved').css( 'display', 'block' );
			$(this).addClass('disabled');
			$(this).parents('.vc_col-md-3').siblings().find('.box-404').addClass( 'disabled' );
			$(this).find('.button').removeClass( 'button-ghost' );
			var text = $(this).find('.msg').text();
			$('#mood_msg').text( text ).addClass( 'red' );
			return false;
		})
	}
} (jQuery));