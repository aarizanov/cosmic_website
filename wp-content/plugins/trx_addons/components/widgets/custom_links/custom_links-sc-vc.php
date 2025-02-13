<?php
/**
 * Widget: Custom links (WPBakery support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0.46
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Add [trx_widget_custom_links] in the VC shortcodes list
if (!function_exists('trx_addons_sc_widget_custom_links_add_in_vc')) {
	function trx_addons_sc_widget_custom_links_add_in_vc() {
		
		if (!trx_addons_exists_vc()) return;
		
		vc_lean_map("trx_widget_custom_links", 'trx_addons_sc_widget_custom_links_add_in_vc_params');
		class WPBakeryShortCode_Trx_Widget_Custom_Links extends WPBakeryShortCode {}
	}
	add_action('init', 'trx_addons_sc_widget_custom_links_add_in_vc', 20);
}


// Return params
if (!function_exists('trx_addons_sc_widget_custom_links_add_in_vc_params')) {
	function trx_addons_sc_widget_custom_links_add_in_vc_params() {
		return apply_filters('trx_addons_sc_map', array(
				"base" => "trx_widget_custom_links",
				"name" => esc_html__("Widget: Custom Links", 'trx_addons'),
				"description" => wp_kses_data( __("Insert widget with list of the custom links", 'trx_addons') ),
				"category" => esc_html__('ThemeREX', 'trx_addons'),
				"icon" => 'icon_trx_widget_custom_links',
				"class" => "trx_widget_custom_links",
				"content_element" => true,
				"is_container" => false,
				"show_settings_on_create" => true,
				"params" => array_merge(
					array(
						array(
							"param_name" => "title",
							"heading" => esc_html__("Widget title", 'trx_addons'),
							"description" => wp_kses_data( __("Title of the widget", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							"admin_label" => true,
							"type" => "textfield"
						),
						array(
							"param_name" => "icons_animation",
							"heading" => esc_html__("Animation", 'trx_addons'),
							"description" => wp_kses_data( __("Check if you want animate icons. Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon", 'trx_addons') ),
							'edit_field_class' => 'vc_col-sm-6',
							"std" => "0",
							"value" => array(esc_html__("Animate icons", 'trx_addons') => "1" ),
							"type" => "checkbox"
						),
						array(
							'type' => 'param_group',
							'param_name' => 'links',
							'heading' => esc_html__( 'Links', 'trx_addons' ),
							"description" => wp_kses_data( __("List of the custom links", 'trx_addons') ),
							'value' => urlencode( json_encode( apply_filters('trx_addons_sc_param_group_value', array(
								array(
									'title' => esc_html__( 'One', 'trx_addons' ),
									'description' => '',
									'image' => '',
									'url' => '',
									'new_window' => '0',
									'caption' => '',
									'icon' => '',
									'icon_fontawesome' => 'empty',
									'icon_openiconic' => 'empty',
									'icon_typicons' => 'empty',
									'icon_entypo' => 'empty',
									'icon_linecons' => 'empty'
								),
							), 'trx_widget_custom_links') ) ),
							'params' => apply_filters('trx_addons_sc_param_group_params', array_merge(array(
									array(
										'param_name' => 'title',
										'heading' => esc_html__( 'Title', 'trx_addons' ),
										'description' => esc_html__( 'Enter title for this item', 'trx_addons' ),
										'admin_label' => true,
										'type' => 'textfield',
									),
									array(
										'param_name' => 'url',
										'heading' => esc_html__( 'Link URL', 'trx_addons' ),
										'description' => esc_html__( 'URL to link this item', 'trx_addons' ),
										'edit_field_class' => 'vc_col-sm-6',
										'type' => 'textfield',
									),
									array(
										'param_name' => 'caption',
										'heading' => esc_html__( 'Caption', 'trx_addons' ),
										'description' => esc_html__( 'Caption to create button', 'trx_addons' ),
										'edit_field_class' => 'vc_col-sm-6',
										'type' => 'textfield',
									),
									array(
										"param_name" => "image",
										"heading" => esc_html__("Image", 'trx_addons'),
										"description" => wp_kses_data( __("Select or upload image or specify URL from other site", 'trx_addons') ),
										'edit_field_class' => 'vc_col-sm-6',
										"type" => "attach_image"
									),
									array(
										"param_name" => "new_window",
										"heading" => esc_html__("Open link in a new window", 'trx_addons'),
										"description" => wp_kses_data( __("Check if you want open this link in a new window (tab)", 'trx_addons') ),
										'edit_field_class' => 'vc_col-sm-6',
										"std" => "0",
										"value" => array(esc_html__("New window", 'trx_addons') => "1" ),
										"type" => "checkbox"
									),
								),
								trx_addons_vc_add_icon_param(''),
								array(
									array(
										'param_name' => 'description',
										'heading' => esc_html__( 'Description', 'trx_addons' ),
										'description' => esc_html__( 'Enter short description for this item', 'trx_addons' ),
										'type' => 'textarea_safe',
									),
								)
							), 'trx_widget_custom_links')
						)
					),
					trx_addons_vc_add_id_param()
				)
			), 'trx_widget_custom_links' );
	}
}
