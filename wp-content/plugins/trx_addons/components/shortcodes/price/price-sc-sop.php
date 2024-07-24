<?php
/**
 * Shortcode: Price block (SOP support)
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
	class TRX_Addons_SOW_Widget_Price extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_price',
				esc_html__('ThemeREX Price', 'trx_addons'),
				array(
					'classname' => 'widget_price',
					'description' => __('Display price table', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'price'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					),
					"columns" => array(
						"label" => esc_html__("Columns", 'trx_addons'),
						"description" => wp_kses_data( __("Specify number of columns for icons. If empty - auto detect by items number", 'trx_addons') ),
						"type" => "number"
					),
					'prices' => array(
						'label' => __('Prices', 'trx_addons'),
						'item_name'  => __( 'Price', 'trx_addons' ),
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
								'subtitle' => array(
									'label' => __('Subtitle', 'trx_addons'),
									'description' => esc_html__( 'Enter subtitle of the item', 'trx_addons' ),
									'type' => 'text'
								),
								'label' => array(
									'label' => __('Label', 'trx_addons'),
									'description' => esc_html__( 'If not empty - colored band with this text is showed at the top corner of price block', 'trx_addons' ),
									'type' => 'text'
								),
								'description' => array(
									'rows' => 5,
									'label' => __('Description', 'trx_addons'),
									'description' => esc_html__( 'Enter short description of the item', 'trx_addons' ),
									'type' => 'tinymce'
								),
								'before_price' => array(
									'label' => __('Before price', 'trx_addons'),
									'description' => esc_html__( 'Any text before the price value', 'trx_addons' ),
									'type' => 'text'
								),
								'price' => array(
									'label' => __('Price', 'trx_addons'),
									'description' => esc_html__( 'Price value', 'trx_addons' ),
									'type' => 'text'
								),
								'after_price' => array(
									'label' => __('After price', 'trx_addons'),
									'description' => esc_html__( 'Any text after the price value', 'trx_addons' ),
									'type' => 'text'
								),
								'details' => array(
									'rows' => 5,
									'label' => __('Details', 'trx_addons'),
									'description' => esc_html__( 'Price details', 'trx_addons' ),
									'type' => 'tinymce'
								),
								'link' => array(
									'label' => __('Link', 'trx_addons'),
									'description' => esc_html__( 'Specify URL of the button under details', 'trx_addons' ),
									'type' => 'link'
								),
								'link_text' => array(
									'label' => __('Link text', 'trx_addons'),
									"description" => wp_kses_data( __("Specify caption of the button under details", 'trx_addons') ),
									'type' => 'text'
								),
								'new_window' => array(
									"label" => esc_html__("Open in the new tab", 'trx_addons'),
									"description" => wp_kses_data( __("Open this link in the new browser's tab", 'trx_addons') ),
									"default" => false,
									"type" => "checkbox"
								),
							),
							trx_addons_sow_add_icon_param(''),
							array(
								'image' => array(
									'label' => __('or Icon image', 'trx_addons'),
									"description" => wp_kses_data( __("Select or upload image to display it at top of this item", 'trx_addons') ),
									'type' => 'media'
								),
								'bg_image' => array(
									'label' => __('Background image', 'trx_addons'),
									"description" => wp_kses_data( __("Select or upload image to use it as background of this item", 'trx_addons') ),
									'type' => 'media'
								),
								'bg_color' => array(
									'label' => __('Background color', 'trx_addons'),
									'description' => esc_html__( 'Select custom background color of this item', 'trx_addons' ),
									'type' => 'color'
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
	siteorigin_widget_register('trx_addons_sow_widget_price', __FILE__, 'TRX_Addons_SOW_Widget_Price');
}
