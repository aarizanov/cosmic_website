<?php
/**
 * Shortcode: Table
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.3
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

	
// Merge shortcode's specific styles into single stylesheet
if ( !function_exists( 'trx_addons_sc_table_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_sc_table_merge_styles');
	function trx_addons_sc_table_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . 'table/_table.scss';
		return $list;
	}
}


// trx_sc_table
//-------------------------------------------------------------
/*
[trx_sc_table id="unique_id" style="default" aligh="left"]
*/
if ( !function_exists( 'trx_addons_sc_table' ) ) {
	function trx_addons_sc_table($atts, $content=null){	
		$atts = trx_addons_sc_prepare_atts('trx_sc_table', $atts, trx_addons_sc_common_atts('id,title', array(
			// Individual params
			"type" => "default",
			"width" => "100%",
			"align" => "none",
			"content" => '',
			))
		);
		
		if (!empty($content))
			$atts['content'] = do_shortcode(str_replace(
												array('<p><table', 'table></p>', '><br />'),
												array('<table', 'table>', '>'),
												html_entity_decode($content, ENT_COMPAT, 'UTF-8')
												)
								);
		
		ob_start();
		trx_addons_get_template_part(array(
										TRX_ADDONS_PLUGIN_SHORTCODES . 'table/tpl.'.trx_addons_esc($atts['type']).'.php',
										TRX_ADDONS_PLUGIN_SHORTCODES . 'table/tpl.default.php'
										),
										'trx_addons_args_sc_table', 
										$atts
									);
		$output = ob_get_contents();
		ob_end_clean();

		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_table', $atts, $content);
	}
}


// Add shortcode [trx_sc_table]
if (!function_exists('trx_addons_sc_table_add_shortcode')) {
	function trx_addons_sc_table_add_shortcode() {
		add_shortcode("trx_sc_table", "trx_addons_sc_table");
	}
	add_action('init', 'trx_addons_sc_table_add_shortcode', 20);
}


// Add shortcodes
//----------------------------------------------------------------------------

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'table/table-sc-elementor.php';
}

// Add shortcodes to Gutenberg
if ( trx_addons_exists_gutenberg() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'table/table-sc-gutenberg.php';
}

// Add shortcodes to VC
if ( trx_addons_exists_vc() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'table/table-sc-vc.php';
}

// Add shortcodes to SOP
if ( trx_addons_exists_sop() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'table/table-sc-sop.php';
}
