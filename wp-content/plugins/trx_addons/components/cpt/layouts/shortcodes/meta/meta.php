<?php
/**
 * Shortcode: Single Post Meta
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.49
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}
	
// Merge shortcode specific styles into single stylesheet
if ( !function_exists( 'trx_addons_sc_layouts_meta_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_sc_layouts_meta_merge_styles');
	add_filter("trx_addons_filter_merge_styles_layouts", 'trx_addons_sc_layouts_meta_merge_styles');
	function trx_addons_sc_layouts_meta_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'meta/_meta.scss';
		return $list;
	}
}


// trx_sc_layouts_meta
//-------------------------------------------------------------
/*
[trx_sc_layouts_meta id="unique_id"]
*/
if ( !function_exists( 'trx_addons_sc_layouts_meta' ) ) {
	function trx_addons_sc_layouts_meta($atts, $content=null){
		$atts = trx_addons_sc_prepare_atts('trx_sc_layouts_meta', $atts, trx_addons_sc_common_atts('id', array(
				// Individual params
				"type" => "",
				"components" => "",
				"counters" => "",
				"share_type" => 'drop',
				"seo" => "",
				"post_type" => array(),
			))
		);
		
		$output = '';

		if ( empty($atts['post_type']) || in_array( get_post_type(), $atts['post_type'] ) ) {
			ob_start();
			trx_addons_get_template_part( array(
												TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'meta/tpl.'.trx_addons_esc($atts['type']).'.php',
												TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'meta/tpl.default.php'
											),
											'trx_addons_args_sc_layouts_meta',
											$atts
										);
			$output = ob_get_contents();
			ob_end_clean();
		}
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_layouts_meta', $atts, $content);
	}
}


// Add shortcode [trx_sc_layouts_meta]
if (!function_exists('trx_addons_sc_layouts_meta_add_shortcode')) {
	function trx_addons_sc_layouts_meta_add_shortcode() {
		
		if (!trx_addons_cpt_layouts_sc_required()) return;
		
		add_shortcode("trx_sc_layouts_meta", "trx_addons_sc_layouts_meta");
	}
	add_action('init', 'trx_addons_sc_layouts_meta_add_shortcode', 15);
}


// Add shortcodes
//----------------------------------------------------------------------------

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'meta/meta-sc-elementor.php';
}

// Add shortcodes to Gutenberg
if ( trx_addons_exists_gutenberg() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'meta/meta-sc-gutenberg.php';
}

// Add shortcodes to VC
if ( trx_addons_exists_vc() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'meta/meta-sc-vc.php';
}
