(function($) {
	'use strict';
	var show_position = $('.hire-home-container').offset().top;
	var window_height = $(window).height();
	var consultation_show = getCookie("consultationshow");
	$(window).scroll(function() {
		var scroll = $(window).scrollTop() + window_height;
		//When user scrolls to designated point, check cookie
		if ( scroll >= show_position ) {
			$('.cosmic-popup.consultation').fadeIn(300);
			//If cookie is not set, show the popup, then set cookie
			if (consultation_show == "") {
				//$('.cosmic-popup.consultation').fadeIn(300);
			    setCookie("consultationshow", "yes", 14);
			}	
		} 
	});
	//Popup commands
	$(document).ready( function() {
		//Close popup
		$('.cosmic-popup.consultation .close-button').on('click', function(){
			$('.cosmic-popup.consultation').fadeOut(300);
		});
		//Show services
		$('.cosmic-popup.consultation .services-button').on('click', function(){
			$('.step-2').fadeIn(300);
		});
		//Go back to step 1
		$('.cosmic-popup.consultation .step-back').on('click', function(){
			$('.step-2').fadeOut(300);
			$('.step-2 .wpcf7-not-valid-tip').remove();
		});
		//Check if any of the services are checked
		$('.cosmic-popup.consultation .services-confirm').on('click', function(){
			var checkbox = $('.company_services input[name="hire-us[]"]');
			$('.step-2 .wpcf7-not-valid-tip').remove();
			//If nothing is checked display error message
			if(!checkbox.is(':checked')) {
				$(`<span role="alert" class="wpcf7-not-valid-tip">
					Please select service.</span>`).appendTo($('.step-2 .hire-us'));
			} else {
				//If all is good, close the services section and return to step 1
				$('.step-2').fadeOut(300);	
			}
		});
		//If mail is sent successfully, close consultation popup and show success message popup
		$('.cosmic-popup.consultation .wpcf7').on('wpcf7:mailsent', function() {
			$('.cosmic-popup.consultation').fadeOut(300);
			$('.cosmic-popup.success-message').fadeIn(300);
		});
		//Close success message popup
		$('.cosmic-popup.success-message').on('click', '.close-button, .close-popup', function() {
			$('.cosmic-popup.success-message').fadeOut(300);
		});
	})
	//Set cookie name, value and time duration for popup
	function setCookie(cookie_name, cookie_value, expires_days) {
	    var date = new Date();
	    date.setTime(date.getTime() + (expires_days * 24 * 60 * 60 * 1000));
	    var expires = "expires="+date.toUTCString();
	    document.cookie = cookie_name + "=" + cookie_value + ";" + expires + ";path=/";
	}
	//Search for specific cookie (consultationshow) in the list of decoded cookies
	function getCookie(cookie_name) {
	    var name = cookie_name + "=";
	    var decodedCookie = decodeURIComponent(document.cookie);
	    var cookie_array = decodedCookie.split(';');
	    for(var i = 0; i < cookie_array.length; i++) {
	    	var cookie = cookie_array[i];
		    while (cookie.charAt(0) == ' ') {
		    	cookie = cookie.substring(1);
		    }
		    if (cookie.indexOf(cookie_name) == 0) {
		    	return cookie.substring(cookie_name.length, cookie.length);
		    }
	  	}
		return "";
	}
} (jQuery));