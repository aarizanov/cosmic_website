<?php
/**
 * Shortcode: Icons (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Icons extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_icons',
				esc_html__('ThemeREX Icons', 'trx_addons'),
				array(
					'classname' => 'widget_icons',
					'description' => __('Display set of icons', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'icons'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					),
					"align" => array(
						"label" => esc_html__("Align", 'trx_addons'),
						"description" => wp_kses_data( __("Select alignment of this item", 'trx_addons') ),
						"default" => "center",
						"options" => trx_addons_get_list_sc_aligns(),
						"type" => "select"
					),
					"size" => array(
						"label" => esc_html__("Size", 'trx_addons'),
						"description" => wp_kses_data( __("Select icon's size", 'trx_addons') ),
						"default" => "medium",
						"options" => trx_addons_get_list_sc_icon_sizes(),
						"type" => "select"
					),
					"color" => array(
						"label" => esc_html__("Color", 'trx_addons'),
						"description" => wp_kses_data( __("Select custom color for each icon", 'trx_addons') ),
						"type" => "color"
					),
					"columns" => array(
						"label" => esc_html__("Columns", 'trx_addons'),
						"description" => wp_kses_data( __("Specify number of columns for icons. If empty - auto detect by items number", 'trx_addons') ),
						"type" => "number"
					),
					"icons_animation" => array(
						"label" => esc_html__("Animation", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want animate icons. Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox"
					),
					'icons' => array(
						'label' => __('Icons', 'trx_addons'),
						'item_name'  => __( 'Icon', 'trx_addons' ),
						'item_label' => array(
							'selector'     => "[name*='title']",
							'update_event' => 'change',
							'value_method' => 'val'
						),
						'type' => 'repeater',
						'fields' => apply_filters('trx_addons_sc_param_group_fields', array_merge(array(
								'title' => array(
									'label' => __('Title', 'trx_addons'),
									'description' => esc_html__( 'Enter title of the item', 'trx_addons' ),
									'type' => 'text'
								),
								'link' => array(
									'label' => __('Link', 'trx_addons'),
									'description' => esc_html__( 'URL to link this item', 'trx_addons' ),
									'type' => 'link'
								),
								'description' => array(
									'rows' => 10,
									'label' => __('Item description', 'trx_addons'),
									'description' => esc_html__( 'Enter short description of the item', 'trx_addons' ),
									'type' => 'tinymce'
								),
								'color' => array(
									'label' => __('Color', 'trx_addons'),
									"description" => wp_kses_data( __("Select custom color for this item", 'trx_addons') ),
									'type' => 'color'
								),
								'char' => array(
									'label' => __('Character', 'trx_addons'),
									'description' => esc_html__( 'Single character instead image or icon', 'trx_addons' ),
									'type' => 'text'
								),
								'image' => array(
									'label' => __('Image', 'trx_addons'),
									"description" => wp_kses_data( __("Select or upload imageto show it above title (instead icon)", 'trx_addons') ),
									'type' => 'media'
								)
							),
							trx_addons_sow_add_icon_param('')
						), $this->get_sc_name())
					)
				),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_icons', __FILE__, 'TRX_Addons_SOW_Widget_Icons');
}
