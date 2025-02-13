<?php
/**
 * Shortcode: Display menu in the Layouts Builder
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.08
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}
	
// Load required styles and scripts for the frontend
if ( !function_exists( 'trx_addons_sc_layouts_menu_load_scripts_front' ) ) {
	add_action("wp_enqueue_scripts", 'trx_addons_sc_layouts_menu_load_scripts_front');
	function trx_addons_sc_layouts_menu_load_scripts_front() {
		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/superfish.js'), array('jquery'), null, true );
		if (trx_addons_is_on(trx_addons_get_option('debug_mode'))) {
			wp_enqueue_script( 'trx_addons-sc_layouts_menu', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/menu.js'), array('jquery'), null, true );
		}
	}
}

	
// Merge shortcode specific styles into single stylesheet
if ( !function_exists( 'trx_addons_sc_layouts_menu_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_sc_layouts_menu_merge_styles');
	add_filter("trx_addons_filter_merge_styles_layouts", 'trx_addons_sc_layouts_menu_merge_styles');
	function trx_addons_sc_layouts_menu_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/_menu.scss';
		return $list;
	}
}


// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_sc_layouts_menu_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_sc_layouts_menu_merge_styles_responsive');
	add_filter("trx_addons_filter_merge_styles_responsive_layouts", 'trx_addons_sc_layouts_menu_merge_styles_responsive');
	function trx_addons_sc_layouts_menu_merge_styles_responsive($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/_menu.responsive.scss';
		return $list;
	}
}

	
// Merge shortcode's specific scripts into single file
if ( !function_exists( 'trx_addons_sc_layouts_menu_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_sc_layouts_menu_merge_scripts');
	function trx_addons_sc_layouts_menu_merge_scripts($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/menu.js';
		$list[] = TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/jquery.slidemenu.js';
		return $list;
	}
}


// Load shortcode's specific scripts if current mode is Preview in the PageBuilder
if ( !function_exists( 'trx_addons_sc_layouts_menu_load_scripts' ) ) {
	add_action("trx_addons_action_pagebuilder_preview_scripts", 'trx_addons_sc_layouts_menu_load_scripts', 10, 1);
	function trx_addons_sc_layouts_menu_load_scripts($editor='') {
		if (trx_addons_is_on(trx_addons_get_option('debug_mode')) && $editor!='gutenberg') {
			wp_enqueue_script( 'slidemenu', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/jquery.slidemenu.js'), array('jquery'), null, true );
		}
	}
}


// Add menu layout to the mobile menu
if ( !function_exists( 'trx_addons_sc_layouts_menu_add_to_mobile_menu' ) ) {
	function trx_addons_sc_layouts_menu_add_to_mobile_menu($menu) {
		global $TRX_ADDONS_STORAGE;
		// Get menu items
		$tmp_pos1 = strpos($menu, '<ul');
		$tmp_pos1 = strpos($menu, '>', $tmp_pos1) + 1;
		$tmp_pos2 = strrpos($menu, '</ul>');
		$menu = substr($menu, $tmp_pos1, $tmp_pos2 - $tmp_pos1);
		// Add to the mobile menu
		if (!isset($TRX_ADDONS_STORAGE['menu_mobile'])) $TRX_ADDONS_STORAGE['menu_mobile'] = '';
		$TRX_ADDONS_STORAGE['menu_mobile'] .= $menu;
	}
}
	
// Return stored items as mobile menu
if ( !function_exists( 'trx_addons_sc_layouts_menu_get_mobile_menu' ) ) {
	add_filter("trx_addons_filter_get_mobile_menu", 'trx_addons_sc_layouts_menu_get_mobile_menu');
	function trx_addons_sc_layouts_menu_get_mobile_menu($menu) {
		global $TRX_ADDONS_STORAGE;
		return empty($TRX_ADDONS_STORAGE['menu_mobile']) 
					? '' 
					: "<ul id=\"menu_mobile_".esc_attr(mt_rand())."\">{$TRX_ADDONS_STORAGE['menu_mobile']}</ul>";
	}
}

// Add description to the menu item
if (!function_exists('trx_addons_sc_layouts_menu_add_menu_item_description')) {
	add_filter( 'nav_menu_item_title', 'trx_addons_sc_layouts_menu_add_menu_item_description', 10, 4 );
	function trx_addons_sc_layouts_menu_add_menu_item_description($title, $item, $args, $depth) {
		if (!empty($item->description)) {
			$title .= '<span class="sc_layouts_menu_item_description">' . trim($item->description) . '</span>';
		}
		return $title;
	}
}


// trx_sc_layouts_menu
//-------------------------------------------------------------
/*
[trx_sc_layouts_menu id="unique_id" menu="menu_id" location="menu_location" burger="0|1" mobile="0|1"]
*/
if ( !function_exists( 'trx_addons_sc_layouts_menu' ) ) {
	function trx_addons_sc_layouts_menu($atts, $content=null){	
		$atts = trx_addons_sc_prepare_atts('trx_sc_layouts_menu', $atts, trx_addons_sc_common_atts('id', array(
			// Individual params
			"type" => "default",
			"direction" => "horizontal",
			"location" => "",
			"menu" => "",
			"mobile_menu" => "0",
			"mobile_button" => "0",
			"animation_in" => "",
			"animation_out" => "",
			"hover" => "fade",
			"hide_on_mobile" => "0",
			))
		);

		if (trx_addons_is_off($atts['menu'])) $atts['menu'] = '';
		if (trx_addons_is_off($atts['location'])) $atts['location'] = '';
		$atts['direction'] = $atts['direction'] == 'vertical' ? 'vertical' : 'horizontal';

		// Slide menu support
		if (trx_addons_is_on(trx_addons_get_option('debug_mode')) && in_array($atts['hover'], array('slide_line', 'slide_box')) ) {
			wp_enqueue_script( 'slidemenu', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/jquery.slidemenu.js'), array('jquery'), null, true );
		}

		ob_start();
		trx_addons_get_template_part(array(
										TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/tpl.'.trx_addons_esc($atts['type']).'.php',
										TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/tpl.default.php'
										),
										'trx_addons_args_sc_layouts_menu',
										$atts
									);
		$output = ob_get_contents();
		ob_end_clean();
		
		return apply_filters('trx_addons_sc_output', $output, 'trx_sc_layouts_menu', $atts, $content);
	}
}


// Add shortcode [trx_sc_layouts_menu]
if (!function_exists('trx_addons_sc_layouts_menu_add_shortcode')) {
	function trx_addons_sc_layouts_menu_add_shortcode() {
		
		//if (!trx_addons_cpt_layouts_sc_required()) return;

		add_shortcode("trx_sc_layouts_menu", "trx_addons_sc_layouts_menu");
	}
	add_action('init', 'trx_addons_sc_layouts_menu_add_shortcode', 15);
}


// Add shortcodes
//----------------------------------------------------------------------------

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/menu-sc-elementor.php';
}

// Add shortcodes to Gutenberg
if ( trx_addons_exists_gutenberg() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/menu-sc-gutenberg.php';
}

// Add shortcodes to VC
if ( trx_addons_exists_vc() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/menu-sc-vc.php';
}

// Add shortcodes to SOP
if ( trx_addons_exists_sop() ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'menu/menu-sc-sop.php';
}
