<?php
/**
 * Shortcode: Blogger (WPBakery support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Add [trx_sc_blogger] in the VC shortcodes list
if (!function_exists('trx_addons_sc_blogger_add_in_vc')) {
	add_action('init', 'trx_addons_sc_blogger_add_in_vc', 20);
	function trx_addons_sc_blogger_add_in_vc() {
		
		if (!trx_addons_exists_vc()) return;
		
		vc_lean_map("trx_sc_blogger", 'trx_addons_sc_blogger_add_in_vc_params');
		class WPBakeryShortCode_Trx_Sc_Blogger extends WPBakeryShortCode {}
	}
}


// Return params
if (!function_exists('trx_addons_sc_blogger_add_in_vc_params')) {
	function trx_addons_sc_blogger_add_in_vc_params() {
		// If open params in VC Editor
		list($vc_edit, $vc_params) = trx_addons_get_vc_form_params('trx_sc_blogger');
		// Prepare lists
		$post_type = $vc_edit && !empty($vc_params['post_type']) ? $vc_params['post_type'] : 'post';
		$taxonomy = $vc_edit && !empty($vc_params['taxonomy']) ? $vc_params['taxonomy'] : 'category';
		$tax_obj = get_taxonomy($taxonomy);
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_sc_blogger",
				"name" => esc_html__("Blogger", 'trx_addons'),
				"description" => wp_kses_data( __("Display posts from specified category in many styles", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_sc_blogger',
				"class" => "trx_sc_blogger",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array_merge(
					array(
						// Attention! It's our custom param's type and it need values list as normal associative array 'key' => 'value'
						// not in VC-style 'value' => 'key'
						// 'style' => 'icons' | 'images'
						// 'mode' => 'inline' | 'dropdown'
						// 'return' => 'slug' | 'full'
/*
						array(
							"param_name" => "type",
							"heading" => esc_html__("Layout", 'trx_addons'),
							"description" => wp_kses_data( __("Select shortcode's layout", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-8',
							"admin_label" => true,
					        'save_always' => true,
							"std" => "default",
							"value" => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'blogger'), 'trx_sc_blogger' ),
							"mode" => 'inline',
							"return" => 'slug',
							"style" => "images",
							"type" => "icons"
						),
*/
						array(
							"param_name" => "type",
							"heading" => esc_html__("Layout", 'trx_addons'),
							"description" => wp_kses_data( __("Select shortcode's layout", 'trx_addons') ),
							"admin_label" => true,
					        'save_always' => true,
							"std" => "default",
							"value" => array_flip(apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'blogger'), 'trx_sc_blogger')),
							"type" => "dropdown"
						),
						array(
							"param_name" => "pagination",
							"heading" => esc_html__("Pagination", 'trx_addons'),
							"description" => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => 'none',
							"value" => array_flip(trx_addons_get_list_sc_paginations()),
							"type" => "dropdown"
						),
						array(
							"param_name" => "hide_excerpt",
							"heading" => esc_html__("Hide excerpt", 'trx_addons'),
							"description" => wp_kses_data( __("Check if you want hide excerpt", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
//							'dependency' => array(
//								'element' => 'type',
//								'value' => array('classic')
//							),
							"std" => "0",
							"value" => array(esc_html__("Hide excerpt", 'trx_addons') => "1" ),
							"type" => "checkbox"
						),
						array(
							"param_name" => "no_links",
							"heading" => esc_html__("Disable links", 'trx_addons'),
							"description" => wp_kses_data( __("Check if you want disable links to the single posts", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => "0",
							"value" => array(esc_html__("Disable links", 'trx_addons') => "1" ),
							"type" => "checkbox"
						),
						array(
							"param_name" => "more_text",
							"heading" => esc_html__("'More' text", 'trx_addons'),
							"description" => wp_kses_data( __("Specify caption of the 'Read more' button. If empty - hide button", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							'dependency' => array(
								'element' => 'no_links',
								'is_empty' => true
							),
							"std" => esc_html__('Read more', 'trx_addons'),
							"type" => "textfield"
						),
						array(
							"param_name" => "post_type",
							"heading" => esc_html__("Post type", 'trx_addons'),
							"description" => wp_kses_data( __("Select post type to show posts", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4 vc_new_row',
							"std" => 'post',
							"value" => array_flip(trx_addons_get_list_posts_types()),
							"type" => "dropdown"
						),
						array(
							"param_name" => "taxonomy",
							"heading" => esc_html__("Taxonomy", 'trx_addons'),
							"description" => wp_kses_data( __("Select taxonomy to show posts", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => 'category',
							"value" => array_flip(trx_addons_get_list_taxonomies(false, $post_type)),
							"type" => "dropdown"
						),
						array(
							"param_name" => "cat",
							"heading" => esc_html__("Category", 'trx_addons'),
							"description" => wp_kses_data( __("Select category to show posts", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => 0,
							"value" => array_flip(trx_addons_array_merge(array(0=>sprintf(__('- %s -', 'trx_addons'), $tax_obj->label)),
																		 $taxonomy == 'category' 
																			? trx_addons_get_list_categories() 
																			: trx_addons_get_list_terms(false, $taxonomy)
																		)),
							"type" => "dropdown"
						),
						array(
							"param_name" => "show_filters",
							"heading" => esc_html__("Show filters", 'trx_addons'),
							"description" => wp_kses_data( __("Check if you want show filters", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => "0",
							"value" => array(esc_html__("Show filters", 'trx_addons') => "1" ),
							"type" => "checkbox"
						),
						array(
							"param_name" => "taxonomy_filters",
							"heading" => esc_html__("Filters taxonomy", 'trx_addons'),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => 'category',
							"value" => array_flip(trx_addons_get_list_taxonomies(false, $post_type)),
							'dependency' => array(
								'element' => 'show_filters',
								'value' => '1'
							),
							"type" => "dropdown"
						),
						array(
							"param_name" => "ids_filters",
							"heading" => esc_html__("Filters taxonomy to show", 'trx_addons'),
							"description" => wp_kses_data( __("Comma separated IDs list to show. IDs have to belong to the selected taxonomy.", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							'dependency' => array(
								'element' => 'show_filters',
								'value' => '1'
							),
							"std" => '',
							"type" => "textfield"
						),
						array(
							"param_name" => "show_all_filters",
							"heading" => esc_html__('Display the "All Filters" tab', 'trx_addons'),
							"description" => wp_kses_data( __("todo add text", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-4',
							"std" => "1",
							"value" => array(esc_html__('Show "All Filters"', 'trx_addons') => "1" ),
							'dependency' => array(
								'element' => 'show_filters',
								'value' => '1'
							),
							"type" => "checkbox"
						),
						array(
							"param_name" => "all_btn_text_filters",
							"heading" => esc_html__('"All Filters" tab text', 'trx_addons'),
							'edit_field_class' => 'vc_col-sm-4',
							'dependency' => array(
											'element' => 'show_filters',
											'value' => '1'
										),
							"std" => esc_html__('All','trx_addons'),
							"type" => "textfield"
						),
					),
					trx_addons_vc_add_query_param(''),
					trx_addons_vc_add_slider_param(),
					trx_addons_vc_add_title_param(),
					trx_addons_vc_add_id_param()
				)
			), 'trx_sc_blogger' );
	}
}
