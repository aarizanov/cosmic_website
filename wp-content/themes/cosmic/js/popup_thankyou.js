(function($) {
	'use strict';
	$(document).ready( function() {
		//If mail is sent successfully, show thank you popup
		$('.wpcf7').on('wpcf7:mailsent', function() {
			$('.blur-background').css("visibility", "visible");
		});
		//Close popup
		$('.cosmic-popup.thankyou .close-button').on('click', function(){
			$('.blur-background').fadeOut(300);
		});
	})
} (jQuery));