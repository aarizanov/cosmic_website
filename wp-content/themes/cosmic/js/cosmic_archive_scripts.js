(function ($) {
	'use strict';

	// Increase page number on load more
	function increase_page_number() {
		var page_container = $( '.load_more_navigation #load_more_page' ),
			cur_number = parseInt( page_container.val() ),
			new_number = cur_number + 1;
		page_container.val( new_number );
	}

	// Load more ajax
	function load_more_ajax( cur_page, post_type, archive_name, archive_type, archive_id, nounce ) {
		// vars
		var spinner = $('<img class="spinner">'),
			response_object = '',
			data = '',
			status = '';

		spinner.attr( 'src', cosmic_values.spinner );
		// Ajax
		$.ajax({
			type: 'post',
			url: cosmic_values.ajaxurl,
			data: {
				action: 'cosmic_load_more_archive',
				security: nounce,
				cur_page : cur_page,
				post_type : post_type,
				archive_name : archive_name,
				archive_type : archive_type,
				archive_id : archive_id,
			},
			beforeSend: function() {
				$('.load_more_navigation .button-load-more').addClass('disabled').after(spinner);
			},
			success: function(response) {
				if( response ) {
					response_object = $.parseJSON( response );
					data = response_object['data'];
					status = response_object['status'];
					$('.load_more_navigation .button-load-more').removeClass('disabled').after(spinner);
					$('.load_more_navigation').find('.spinner').remove();
					increase_page_number();
					if ( status ) {
						if ( status === 'stop' ) {
							$('.load_more_navigation .button-load-more').hide('fast');
						} else if ( status === 'ok' ) {
							$('.load_more_navigation .button-load-more').show('fast');
						} else {
							$('.load_more_navigation .button-load-more').hide('fast');
						}
					}
					$('.vc_container.post_boxes').append(data);
				}
			}
		});
	}

	// On click load more do ajax stuff
	$(document).on( 'click', '.load_more_navigation .button-load-more', function() {
		if ( ! $(this).hasClass('disabled') ) {
			var cur_page = $('#load_more_page').val(),
				nounce = $('#load_more_nounce').val(),
				post_type = $('.post_boxes').data('ptype'),
				archive_name = $('.post_boxes').data('name'),
				archive_type = $('.post_boxes').data('type'),
				archive_id = $('.post_boxes').data('id');
			load_more_ajax( cur_page, post_type, archive_name, archive_type, archive_id, nounce  );
		}
		return false;
	});

	// Load more ajax
	function search_posts() {
		// vars
		var spinner = $('<img class="spinner">'),
			response_object = '',
			data = '',
			status = '',
			search_nounce = $('#search_nounce').val(),
			search_term = $('#post_search-text').val(),
			search_container = $('.post_search .post_search-inner .search_results ul');

		spinner.attr( 'src', cosmic_values.spinner );
		// Ajax
		$.ajax({
			type: 'post',
			url: cosmic_values.ajaxurl,
			data: {
				action: 'cosmic_search_archive',
				security: search_nounce,
				search_term : search_term,
			},
			beforeSend: function() {
				search_container.addClass('loading');
			},
			success: function(response) {
				if( response ) {
					response_object = $.parseJSON( response );
					data = response_object['data'];
					status = response_object['status'];
					search_container.removeClass('loading');
					search_container.empty().append(data);
				}
			}
		});
	}

	// On click search button open ajax modal
	$(document).on( 'click', '.sub_menu .search', function() {
		$('body').toggleClass('search_opened');
		return false;
	});

	// On click X button close ajax modal
	$(document).on( 'click', '.post_search .close', function() {
		$('body').toggleClass('search_opened');
		return false;
	});

	// On form submit run ajax
	$(document).on( 'submit', '.post_search .post_search-inner form', function() {
		if ( ! $('#post_search-text').val() ) {
			$('.search_results .search_results-inner ul').empty();
		} else {
			search_posts();
		}
		return false;
	})

} (jQuery));