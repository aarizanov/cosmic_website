(function($) {
	'use strict';
	//Set cookie name, value and time duration for popup
	function setCookie(cookie_name, cookie_value, expires_days) {
	    var date = new Date();
	    date.setTime(date.getTime() + (expires_days * 24 * 60 * 60 * 1000));
	    var expires = "expires="+date.toUTCString();
	    document.cookie = cookie_name + "=" + cookie_value + ";" + expires + ";path=/";
	}
	//Search for specific cookie (subscribeshow) in the list of decoded cookies
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
	//Check cookie status
	function popupStatus() {
		//Here for demo
		$('.cosmic-popup.newsletter').fadeIn(300);
		var subscribe_show = getCookie("subscribeshow");
		//If cookie is not set, show the popup, then set cookie
		if (subscribe_show == "") {
		    //$('.cosmic-popup.newsletter').fadeIn(300);
		    setCookie("subscribeshow", "yes", 14);
		}
	}
	$(document).ready( function() {
		//Execute function after 5 seconds have passed (demo)
		setTimeout( popupStatus, 5000 );
		//Close popup
		$('.cosmic-popup.newsletter .close-button').on('click', function(){
			$('.cosmic-popup.newsletter').fadeOut(300);
		});
	})
} (jQuery));