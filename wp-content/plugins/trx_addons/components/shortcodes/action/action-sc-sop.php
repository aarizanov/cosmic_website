<?php
/**
 * Shortcode: Action (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Action extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_action',
				esc_html__('ThemeREX Action', 'trx_addons'),
				array(
					'classname' => 'widget_action',
					'description' => __('Display action', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'action'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					),
					"columns" => array(
						"label" => esc_html__("Columns", 'trx_addons'),
						"description" => wp_kses_data( __("Specify number of columns for icons. If empty - auto detect by items number", 'trx_addons') ),
						"type" => "number"
					),
					"full_height" => array(
						"label" => esc_html__("Full height", 'trx_addons'),
						"description" => wp_kses_data( __("Stretch the height of the element to the full screen's height", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox"
					),
					'actions' => array(
						'label' => __('Actions', 'trx_addons'),
						'item_name'  => __( 'Action', 'trx_addons' ),
						'item_label' => array(
							'selector'     => "[name*='title']",
							'update_event' => 'change',
							'value_method' => 'val'
						),
						'type' => 'repeater',
						'fields' => apply_filters('trx_addons_sc_param_group_fields', array_merge(array(
								'position' => array(
									'label' => __('Text position inside item', 'trx_addons'),
									"description" => wp_kses_data( __("Select position of the titles", 'trx_addons') ),
									'default' => 'mc',
									'options' => trx_addons_get_list_sc_positions(),
									'type' => 'select'
								),
								'title' => array(
									'label' => __('Item title', 'trx_addons'),
									'description' => esc_html__( 'Enter title of the item', 'trx_addons' ),
									'type' => 'text'
								),
								'subtitle' => array(
									'label' => __('Item subtitle', 'trx_addons'),
									'description' => esc_html__( 'Enter subtitle of the item', 'trx_addons' ),
									'type' => 'text'
								),
								'date' => array(
									'label' => __('Action date', 'trx_addons'),
									'description' => esc_html__( 'Specify date (and/or time) of this event', 'trx_addons' ),
									'type' => 'text'
								),
								'info' => array(
									'label' => __('Brief info', 'trx_addons'),
									'description' => esc_html__( 'Additional info for this item', 'trx_addons' ),
									'type' => 'text'
								),
								'description' => array(
									'rows' => 10,
									'label' => __('Item description', 'trx_addons'),
									'description' => esc_html__( 'Enter short description of the item', 'trx_addons' ),
									'type' => 'tinymce'
								),
								'link' => array(
									'label' => __('Link', 'trx_addons'),
									'description' => esc_html__( 'URL to link this item', 'trx_addons' ),
									'type' => 'link'
								),
								'link_text' => array(
									'label' => __('Link text', 'trx_addons'),
									"description" => wp_kses_data( __("Caption of the link", 'trx_addons') ),
									'type' => 'text'
								)
							),
							trx_addons_sow_add_icon_param(''),
							array(
								'image' => array(
									'label' => __('or Icon image', 'trx_addons'),
									"description" => wp_kses_data( __("Select or upload image or specify URL from other site to use it as icon", 'trx_addons') ),
									'type' => 'media'
								),
								'color' => array(
									'label' => __('Text color', 'trx_addons'),
									'description' => esc_html__( 'Select custom color of this item', 'trx_addons' ),
									'type' => 'color'
								),
								'bg_color' => array(
									'label' => __('Background color', 'trx_addons'),
									'description' => esc_html__( 'Select custom background color of this item', 'trx_addons' ),
									'type' => 'color'
								),
								'bg_image' => array(
									'label' => __('or Background image', 'trx_addons'),
									"description" => wp_kses_data( __("Select or upload image or specify URL from other site to use it as background of this item", 'trx_addons') ),
									'type' => 'media'
								),
								'height' => array(
									'label' => __('Item height', 'trx_addons'),
									"description" => wp_kses_data( __("Height of the block", 'trx_addons') ),
									'type' => 'measurement'
								)
							)
						), $this->get_sc_name())
					)
				),
				trx_addons_sow_add_slider_param(),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_action', __FILE__, 'TRX_Addons_SOW_Widget_Action');
}
