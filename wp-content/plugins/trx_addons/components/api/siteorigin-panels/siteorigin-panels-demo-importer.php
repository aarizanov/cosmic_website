<?php
/**
 * Plugin support: SiteOrigin Panels (Importer support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.30
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Check plugin in the required plugins
if ( !function_exists( 'trx_addons_sop_importer_required_plugins' ) ) {
	add_filter( 'trx_addons_filter_importer_required_plugins',	'trx_addons_sop_importer_required_plugins', 10, 2 );
	function trx_addons_sop_importer_required_plugins($not_installed='', $list='') {
		if (strpos($list, 'siteorigin-panels')!==false && !trx_addons_exists_vc())
			$not_installed .= '<br>' . esc_html__('SiteOrigin Panels', 'trx_addons');
		return $not_installed;
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'trx_addons_sop_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options',	'trx_addons_sop_importer_set_options' );
	function trx_addons_sop_importer_set_options($options=array()) {
		if ( trx_addons_exists_sop() && in_array('siteorigin-panels', $options['required_plugins']) ) {
			$options['additional_options'][] = 'siteorigin_panels_settings';
			$options['additional_options'][] = 'siteorigin_widgets_active';
		}
		return $options;
	}
}

// Prevent import plugin's specific options if plugin is not installed
if ( !function_exists( 'trx_addons_sop_importer_check_options' ) ) {
	add_filter( 'trx_addons_filter_import_theme_options', 'trx_addons_sop_importer_check_options', 10, 4 );
	function trx_addons_sop_importer_check_options($allow, $k, $v, $options) {
		if ($allow && strpos($k, 'siteorigin_')===0) {
			$allow = trx_addons_exists_sop() && in_array('siteorigin-panels', $options['required_plugins']);
		}
		return $allow;
	}
}
