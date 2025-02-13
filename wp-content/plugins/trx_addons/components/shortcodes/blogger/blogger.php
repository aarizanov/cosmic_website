<?php
/**
 * Shortcode: Blogger
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Merge shortcode's specific styles to the single stylesheet
if ( !function_exists( 'trx_addons_sc_blogger_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_sc_blogger_merge_styles');
	function trx_addons_sc_blogger_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/_blogger.scss';
		return $list;
	}
}


// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_sc_blogger_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_sc_blogger_merge_styles_responsive');
	function trx_addons_sc_blogger_merge_styles_responsive($list) {
		$list[] = TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/_blogger.responsive.scss';
		return $list;
	}
}


// Removes terms count in the string
if ( !function_exists( 'trx_addons_sc_blogger_remove_terms_counter' ) ) {
	function trx_addons_sc_blogger_remove_terms_counter($str, $replacement = '' ) {
		return preg_replace( array( '/\(\d+\)$/', '/^\-/' ), $replacement, $str);
	}
}


// trx_sc_blogger
//-------------------------------------------------------------
/*
[trx_sc_blogger id="unique_id" type="default" cat="category_slug or id" count="3" columns="3" slider="0|1"]
*/
if ( !function_exists( 'trx_addons_sc_blogger' ) ) {
	function trx_addons_sc_blogger($atts, $content=null) {	

		// Exit to prevent recursion
		if (trx_addons_sc_stack_check('trx_sc_blogger')) return '';

		$atts = trx_addons_sc_prepare_atts('trx_sc_blogger', $atts, trx_addons_sc_common_atts('id,title,slider,query', array(
			// Individual params
			"type" => 'default',
			"hide_excerpt" => 0,
			"no_links" => 0,
			'post_type' => 'post',
			'taxonomy' => 'category',

			"show_filters" => 0,
			"taxonomy_filters" => 'category',
			"filters_active" => '',
			"ids_filters" => '',
			"show_all_filters" => '1',
			"all_btn_text_filters" => '',

			"more_text" => esc_html__('Read more', 'trx_addons'),
			"pagination" => "none",
			"page" => 1,
			))
		);

		if (!empty($atts['ids'])) {
			$atts['ids'] = str_replace(array(';', ' '), array(',', ''), $atts['ids']);
			$atts['count'] = count(explode(',', $atts['ids']));
		}
		if (!is_array($atts['ids_filters'])) {
			$atts['ids_filters'] = trim($atts['ids_filters']);
			$atts['ids_filters'] = empty($atts['ids_filters']) ? array() : explode(',', $atts['ids_filters']);
		}

		$atts['count'] = $atts['count'] < 0 ? -1 : max(1, (int) $atts['count']);
		$atts['offset'] = max(0, (int) $atts['offset']);
		if (empty($atts['orderby'])) $atts['orderby'] = 'date';
		if (empty($atts['order'])) $atts['order'] = 'desc';
		$atts['slider'] = max(0, (int) $atts['slider']);
		if ($atts['slider'] > 0 && (int) $atts['slider_pagination'] > 0) $atts['slider_pagination'] = 'bottom';
		if ($atts['slider'] > 0) $atts['pagination'] = 'none';

		ob_start();
		trx_addons_get_template_part(array(
										TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/tpl.'.trx_addons_esc($atts['type']).'.php',
										TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/tpl.default.php'
										),
                                        'trx_addons_args_sc_blogger', 
                                        $atts
                                    );
		$output = ob_get_contents();
		ob_end_clean();
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_blogger', $atts, $content);
	}
}


// Add shortcode [trx_sc_blogger]
if (!function_exists('trx_addons_sc_blogger_add_shortcode')) {
	add_action('init', 'trx_addons_sc_blogger_add_shortcode', 20);
	function trx_addons_sc_blogger_add_shortcode() {
		add_shortcode("trx_sc_blogger", "trx_addons_sc_blogger");
	}
}


// Add shortcodes
//----------------------------------------------------------------------------

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/blogger-sc-elementor.php';
}

// Add shortcodes to Gutenberg
if ( trx_addons_exists_gutenberg() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/blogger-sc-gutenberg.php';
}

// Add shortcodes to VC
if ( trx_addons_exists_vc() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/blogger-sc-vc.php';
}

// Add shortcodes to SOP
if ( trx_addons_exists_sop() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/blogger-sc-sop.php';

// Or create our widget
} else {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_SHORTCODES . 'blogger/blogger-widget.php';
}
