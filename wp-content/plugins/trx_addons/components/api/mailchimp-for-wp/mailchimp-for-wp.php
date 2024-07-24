<?php
/**
 * Plugin support: Mail Chimp
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.5
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Check if plugin installed and activated
if ( !function_exists( 'trx_addons_exists_mailchimp' ) ) {
	function trx_addons_exists_mailchimp() {
		return function_exists('__mc4wp_load_plugin') || defined('MC4WP_VERSION');
	}
}

// Hack for MailChimp - disable scroll to form, because it broke layout in the Chrome 
if ( !function_exists( 'trx_addons_mailchimp_scroll_to_form' ) ) {
	add_filter( 'mc4wp_form_auto_scroll', 'trx_addons_mailchimp_scroll_to_form' );
	function trx_addons_mailchimp_scroll_to_form($scroll) {
		return false;
	}
}


// Demo data install
//----------------------------------------------------------------------------

// One-click import support
if ( is_admin() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_API . 'mailchimp-for-wp/mailchimp-for-wp-demo-importer.php';
}

// OCDI support
if ( is_admin() && trx_addons_exists_mailchimp() && trx_addons_exists_ocdi() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_API . 'mailchimp-for-wp/mailchimp-for-wp-demo-ocdi.php';
}
