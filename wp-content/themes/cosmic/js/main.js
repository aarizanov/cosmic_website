(function($) {
	'use strict';

	// Select all links with hashes
	$('a[href*="#"]')
	// Remove links that don't actually link to anything
	.not('[href="#"]')
	.not('[href="#0"]')
	.click( function(event) {
		// On-page links
		if ( location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')  && location.hostname == this.hostname ) {
			// Figure out element to scroll to
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			// Does a scroll target exist?
			if (target.length) {
				// Only prevent default if animation is actually gonna happen
				event.preventDefault();
				$('html, body').animate({
					scrollTop: target.offset().top - 100
				}, 1000, function() {

				});
			}
		}
	});

	// Back to top button
	$(window).scroll(function() {
		var scroll = $(window).scrollTop();
		if ( scroll >= 350 ) {
			$("#back_to_top").removeClass("hidden");
		} else {
			$("#back_to_top").addClass("hidden");
		}
	});
	$(document).on( 'click', '#back_to_top a', function() {
		$(this).blur();
	})

	// Catch window hash and scroll to item id
	function cosm_scroll_to_id() {
		if( window.location.hash ) {
			var cur_hash = window.location.hash;
			// Object exists on the page
			if ( $( cur_hash ).length ) {
				$('html, body').animate({
					scrollTop: $( cur_hash ).offset().top - 180
				}, 1500, function() {

				});
			}
		}
	}

	$(document).ready( function() {
		// Add opacity to full height rows
		if ( $('.vc_row-o-full-height').length ) {
			$('.vc_row-o-full-height').each( function() {
				$(this).css( 'opacity', '1' );
			})
		}
		// Catch hash and scroll to it
		cosm_scroll_to_id();

		$(function() {
			console.log($('.hire-us > select').length);
			if($('.hire-us > select').length) {
				$('.hire-us > select').selectize({
					plugins: ['remove_button'],
					placeholder: 'Positions',
					'create': true,
				})
			}
		})



		var i = 1;
		var sampleMessages = [ "DEDICATED", "REMOTE", "SCALABLE", "TOP-NOTCH" ];
		setInterval(function() {
		  var newText = sampleMessages[i++ % sampleMessages.length];
		  jQuery("#homepage_text_rotate").fadeOut(500, function () {
		    jQuery(this).text(newText).fadeIn(500);
		  });
		}, 5 * 1000);

		
	});

	// MailChimp
	$('.newsletter-signup').submit(function(e) {
		e.preventDefault();
		let $form = $(e.target);
		let $message = $('.newsletter .message');
		let email = $form.find("input[name='email']").val();
		let name = $form.find("input[name='name']").val();
		let frequency = $form.find("select[name='frequency']").children("option:selected").val();
		let error = function(response) {
			let html = '<p>' + response.message + '</p>';
			setMessage(html, true);
		};
		let success = function(response) {
			let html = '<p>' + response.message + '</p>';
			setMessage(html);
		};
		let setMessage = function(html, close = false) {
			$message.html(html);
			if(close) {
				let $close = $('<div class="close">try again</div>');
				$close.on('click', function(){
					$message.css({'display':'none'});
				});
				$message.append($close);
			}
		};
		(function() {
			$message.html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>')
				.css({'display':'flex'});
		}());

		let data = {
			action: 'mailchimp',
			email: email,
			name: name,
			frequency: frequency
		};

		$.post(ajaxurl, data)
			.success(function(response) {
				success(response);
				console.log(response);
			})
			.error(function(xhr) {
				error(xhr.responseJSON.data);
				console.log(xhr.responseJSON.data);
			});

	});
} (jQuery));
