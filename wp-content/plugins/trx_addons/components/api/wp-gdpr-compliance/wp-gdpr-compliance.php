<?php
/**
 * Plugin support: WP GDPR Compliance
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.49
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Check if plugin installed and activated
if ( !function_exists( 'trx_addons_exists_wp_gdpr_compliance' ) ) {
	function trx_addons_exists_wp_gdpr_compliance() {
		return defined( 'WP_GDPR_C_ROOT_FILE' ) || defined( 'WPGDPRC_ROOT_FILE' );
	}
}


// Demo data install
//----------------------------------------------------------------------------

// One-click import support
if ( is_admin() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_API . 'wp-gdpr-compliance/wp-gdpr-compliance-demo-importer.php';
}

// OCDI support
if ( is_admin() && trx_addons_exists_wp_gdpr_compliance() && trx_addons_exists_ocdi() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_API . 'wp-gdpr-compliance/wp-gdpr-compliance-demo-ocdi.php';
}
