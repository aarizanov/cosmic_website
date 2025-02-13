<?php
/**
 * Plugin support: Contact Form 7 (Importer support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.5
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

// Check plugin in the required plugins
if ( !function_exists( 'trx_addons_cf7_importer_required_plugins' ) ) {
	add_filter( 'trx_addons_filter_importer_required_plugins',	'trx_addons_cf7_importer_required_plugins', 10, 2 );
	function trx_addons_cf7_importer_required_plugins($not_installed='', $list='') {
		if (strpos($list, 'contact-form-7')!==false && !trx_addons_exists_cf7() )
			$not_installed .= '<br>' . esc_html__('Contact Form 7', 'trx_addons');
		return $not_installed;
	}
}

// Set plugin's specific importer options
if ( !function_exists( 'trx_addons_cf7_importer_set_options' ) ) {
	add_filter( 'trx_addons_filter_importer_options',	'trx_addons_cf7_importer_set_options' );
	function trx_addons_cf7_importer_set_options($options=array()) {
		if ( trx_addons_exists_cf7() && in_array('contact-form-7', $options['required_plugins']) ) {
			$options['additional_options'][] = 'wpcf7';
		}
		return $options;
	}
}

// Prevent import plugin's specific options if plugin is not installed
if ( !function_exists( 'trx_addons_cf7_importer_check_options' ) ) {
	add_filter( 'trx_addons_filter_import_theme_options', 'trx_addons_cf7_importer_check_options', 10, 4 );
	function trx_addons_cf7_importer_check_options($allow, $k, $v, $options) {
		if ($allow && $k == 'wpcf7') {
			$allow = trx_addons_exists_cf7() && in_array('contact-form-7', $options['required_plugins']);
		}
		return $allow;
	}
}

// Add checkbox to the one-click importer
if ( !function_exists( 'trx_addons_cf7_importer_show_params' ) ) {
	add_action( 'trx_addons_action_importer_params',	'trx_addons_cf7_importer_show_params', 10, 1 );
	function trx_addons_cf7_importer_show_params($importer) {
		if ( trx_addons_exists_cf7() && in_array('contact-form-7', $importer->options['required_plugins']) ) {
			$importer->show_importer_params(array(
				'slug' => 'contact-form-7',
				'title' => esc_html__('Import Contact Form 7', 'trx_addons'),
				'part' => 1
			));
		}
	}
}

// Check if the row will be imported
if ( !function_exists( 'trx_addons_cf7_importer_check_row' ) ) {
	add_filter('trx_addons_filter_importer_import_row', 'trx_addons_cf7_importer_check_row', 9, 4);
	function trx_addons_cf7_importer_check_row($flag, $table, $row, $list) {
		if ($flag || strpos($list, 'contact-form-7')===false) return $flag;
		if ( trx_addons_exists_cf7() ) {
			if ($table == 'posts')
				$flag = $row['post_type']==WPCF7_ContactForm::post_type;
		}
		return $flag;
	}
}
