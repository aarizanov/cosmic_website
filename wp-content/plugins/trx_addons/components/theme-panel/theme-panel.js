/* global jQuery:false */
/* global TRX_ADDONS_STORAGE:false */

jQuery(document).ready(function(){

	"use strict";

	// Button 'Go Back'
	jQuery('.trx_addons_theme_panel_prev_step').on('click', function(e) {
		var section = jQuery(this).parents('.trx_addons_tabs_section'),
			tabs = jQuery(this).parents('.trx_addons_tabs'),
			tabs_li = tabs.find('> ul > li'),
			tab_active = section.index('.trx_addons_tabs_section');	//tabs.find('.ui-state-active').index();
		tabs_li.removeClass('trx_addons_panel_wizard_active trx_addons_panel_wizard_finished');
		if (tab_active > 1) {
			tabs_li.each(function(idx) {
				if (idx < tab_active-1) {
					jQuery(this).addClass('trx_addons_panel_wizard_finished');
				}
			});
		}
		tabs_li.eq(tab_active-1).addClass('trx_addons_panel_wizard_active').find('> a').trigger('click');
		trx_addons_document_animate_to('trx_addons_theme_panel');
		if (tab_active == 1) {
			tabs.removeClass('trx_addons_panel_wizard');
		}
		e.preventDefault();
		return false;
	});

	// Button 'Next Step'
	jQuery('.trx_addons_theme_panel_next_step').on('click', function(e) {
		if (jQuery(this).attr('href') == '#') {
			var section = jQuery(this).parents('.trx_addons_tabs_section'),
				tabs = jQuery(this).parents('.trx_addons_tabs'),
				tabs_li = tabs.find('> ul > li'),
				tab_active = section.index('.trx_addons_tabs_section');	//tabs.find('.ui-state-active').index();
			if (!tabs.hasClass('trx_addons_panel_wizard')) {
				tabs.addClass('trx_addons_panel_wizard');
			}
			tabs_li.removeClass('trx_addons_panel_wizard_active trx_addons_panel_wizard_finished');
			tabs_li.each(function(idx) {
				if (idx < tab_active+1) {
					jQuery(this).addClass('trx_addons_panel_wizard_finished');
				}
			});
			tabs_li.eq(tab_active+1 >= tabs_li.length ? 0 : tab_active+1).addClass('trx_addons_panel_wizard_active').find('> a').trigger('click');
			trx_addons_document_animate_to('trx_addons_theme_panel');
			e.preventDefault();
			return false;
		}
	});
	// Continue after page reloaded
	var last_section = trx_addons_get_cookie('trx_addons_theme_panel_wizard_section');
	if (last_section) {
		trx_addons_del_cookie('trx_addons_theme_panel_wizard_section');
		setTimeout(function() {
			jQuery('#'+last_section+' .trx_addons_theme_panel_next_step').trigger('click');
		});
	}

	// Select / Deselect all plugins
	jQuery('.trx_addons_theme_panel_plugins_buttons').on('click', 'a', function(e) {
		if (jQuery(this).hasClass('trx_addons_theme_panel_plugins_button_select')) {
			var items = jQuery(this).parents('.trx_addons_theme_panel_plugins_installer').find('.trx_addons_theme_panel_plugins_list_item > a:not([data-state="deactivate"])');
			if (items.length > 0) {
				items.parent().addClass('trx_addons_theme_panel_plugins_list_item_checked');
				jQuery(this).parents('.trx_addons_theme_panel_plugins_installer').find('.trx_addons_theme_panel_plugins_install').removeAttr('disabled');
			}
		} else {
			jQuery(this).parents('.trx_addons_theme_panel_plugins_installer').find('.trx_addons_theme_panel_plugins_list_item').removeClass('trx_addons_theme_panel_plugins_list_item_checked');
			jQuery(this).parents('.trx_addons_theme_panel_plugins_installer').find('.trx_addons_theme_panel_plugins_install').attr('disabled', 'disabled');
		}
		e.preventDefault();
		return false;
	});
	// Select all plugins when page is loaded
	jQuery('.trx_addons_theme_panel_plugins_buttons .trx_addons_theme_panel_plugins_button_select').trigger('click');

	// Select / Deselect one plugin
	jQuery('.trx_addons_theme_panel_plugins_list_item').on('click', 'a', function(e) {
		if (jQuery(this).data('state')!='deactivate') {
			var item = jQuery(this).parent();
			item.toggleClass('trx_addons_theme_panel_plugins_list_item_checked');
			if (item.parents('.trx_addons_theme_panel_plugins_installer').find('.trx_addons_theme_panel_plugins_list_item_checked').length > 0) {
				item.parents('.trx_addons_theme_panel_plugins_installer').find('.trx_addons_theme_panel_plugins_install').removeAttr('disabled');
			} else {
				item.parents('.trx_addons_theme_panel_plugins_installer').find('.trx_addons_theme_panel_plugins_install').attr('disabled', 'disabled');
			}
		}
		e.preventDefault();
		return false;
	});

	//Run installation
	jQuery('.trx_addons_theme_panel_plugins_install').on('click', function(e) {
		var bt = jQuery(this);
		if (bt.attr('disabled') !== 'disabled') {
			if ( jQuery( this ).parents( '.trx_addons_theme_panel_plugins_installer' ).find( '.trx_addons_theme_panel_plugins_list_item_checked' ).length > 0 ) {
				bt.attr('disabled', 'disabled').data('need-reload', '1');
				jQuery('.trx_addons_theme_panel').addClass('trx_addons_theme_panel_busy');
				trx_addons_plugins_installer();
			}
		}
		e.preventDefault();
		return false;
	});

	// Installer
	var attempts = 0;
	function trx_addons_plugins_installer() {
		var items = jQuery( '.trx_addons_theme_panel_plugins_installer' ).find( '.trx_addons_theme_panel_plugins_list_item_checked' );
		if (items.length == 0) {
			if ( jQuery('.trx_addons_theme_panel_plugins_install').data('need-reload') == '1' ) {
				if (jQuery('.trx_addons_theme_panel .trx_addons_tabs').hasClass('trx_addons_panel_wizard')) {
					trx_addons_set_cookie('trx_addons_theme_panel_wizard_section', 'trx_addons_theme_panel_section_plugins');
				} else {
					if ( location.hash != 'trx_addons_theme_panel_section_plugins' ) {
						trx_addons_document_set_location( location.href.split('#')[0] + '#' + 'trx_addons_theme_panel_section_plugins' );
					}
				}
				location.reload( true );
			}
			jQuery('.trx_addons_theme_panel').removeClass('trx_addons_theme_panel_busy');
			return;
		}
		var item  = items.eq(0),
			link  = item.find('a'),
			url   = link.attr('href'),
			label = link.find('span'),
			state = link.data('state'),
			text  = link.data(state+'-progress');
		label.html(text).addClass('trx_addons_loading');
		//Request plugin activation
		attempts++;
		if ( attempts > 3 ) {
			attempts = 0;
			item.removeClass('trx_addons_theme_panel_plugins_list_item_checked');
			trx_addons_plugins_installer();
		}
		jQuery.get(url).done(
			function(response) {
				// Send the empty query to the server after the plugin activation to skip welcome screen (if present)
				if (state == 'activate') {
					jQuery.get(TRX_ADDONS_STORAGE['admin_url']);
				}
				// Check current state of the plugin
				setTimeout(function() {
					jQuery.post(
                        trx_addons_add_to_url( TRX_ADDONS_STORAGE['ajax_url'], { 'activate-multi': 1 } ), {
							'action': 'trx_addons_check_plugin_state',
							'nonce': TRX_ADDONS_STORAGE['ajax_nonce'],
							'slug': link.data('slug')
						},
						function(response){
							var rez = { error: '', state: '' };
							if (response != '' &&  response != 0) {
								try {
									rez = JSON.parse( response );
								} catch (e) {
									rez = { error: TRX_ADDONS_STORAGE['msg_get_pro_error'] };
									console.log( response );
								}
							}
							if (rez.error != '') {
								item.removeClass('trx_addons_theme_panel_plugins_list_item_checked');
								attempts = 0;
							} else {
								if (rez.state == 'activate' ) {
									if (state == 'install') {
										state = 'activate';
										link.attr('href', link.data('activate-nonce'));
										attempts = 0;
									} else {
										attempts++;
									}
								} else if (rez.state == 'deactivate') {
									if (state == 'activate') {
										state = 'deactivate';
										item.removeClass('trx_addons_theme_panel_plugins_list_item_checked');								
										attempts = 0;
									} else {
										attempts++;
									}
								} else {
									attempts++;
								}
								if (state != '' && state != 0) {
									link.data('state', state).attr('data-state', state);
									label.html(link.data(state+'-label')).removeClass('trx_addons_loading');
								}
								// Doing next step
								trx_addons_plugins_installer();
							}
						}
					);
				}, state == 'activate' ? 1000 : 0);
			}
		);
	}
});
