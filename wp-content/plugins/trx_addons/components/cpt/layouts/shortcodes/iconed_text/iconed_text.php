<?php
/**
 * Shortcode: Display icons with two text lines
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.08
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

	
// trx_sc_layouts_iconed_text
//-------------------------------------------------------------
/*
[trx_sc_layouts_iconed_text id="unique_id" icon="hours" text1="Opened hours" text2="8:00am - 5:00pm"]
*/
if ( !function_exists( 'trx_addons_sc_layouts_iconed_text' ) ) {
	function trx_addons_sc_layouts_iconed_text($atts, $content=null){	
		$atts = trx_addons_sc_prepare_atts('trx_sc_layouts_iconed_text', $atts, trx_addons_sc_common_atts('id,icon,hide', array(
			// Individual params
			"type" => "default",
			"text1" => "",
			"text2" => "",
			"link" => "",
			))
		);

		if (empty($atts['icon'])) {
			$atts['icon'] = isset( $atts['icon_' . $atts['icon_type']] ) && $atts['icon_' . $atts['icon_type']] != 'empty' 
								? $atts['icon_' . $atts['icon_type']] 
								: '';
			trx_addons_load_icons($atts['icon_type']);
		} else if (strtolower($atts['icon']) == 'none')
			$atts['icon'] = '';

		ob_start();
		trx_addons_get_template_part(array(
										TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'iconed_text/tpl.'.trx_addons_esc($atts['type']).'.php',
										TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'iconed_text/tpl.default.php'
										),
										'trx_addons_args_sc_layouts_iconed_text',
										$atts
									);
		$output = ob_get_contents();
		ob_end_clean();
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_layouts_iconed_text', $atts, $content);
	}
}


// Add shortcode [trx_sc_layouts_iconed_text]
if (!function_exists('trx_addons_sc_layouts_iconed_text_add_shortcode')) {
	function trx_addons_sc_layouts_iconed_text_add_shortcode() {
		
		if (!trx_addons_cpt_layouts_sc_required()) return;

		add_shortcode("trx_sc_layouts_iconed_text", "trx_addons_sc_layouts_iconed_text");
	}
	add_action('init', 'trx_addons_sc_layouts_iconed_text_add_shortcode', 15);
}


// Add shortcodes
//----------------------------------------------------------------------------

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'iconed_text/iconed_text-sc-elementor.php';
}

// Add shortcodes to Gutenberg
if ( trx_addons_exists_gutenberg() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'iconed_text/iconed_text-sc-gutenberg.php';
}

// Add shortcodes to VC
if ( trx_addons_exists_vc() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'iconed_text/iconed_text-sc-vc.php';
}

// Add shortcodes to SOP
if ( trx_addons_exists_sop() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'iconed_text/iconed_text-sc-sop.php';
}
