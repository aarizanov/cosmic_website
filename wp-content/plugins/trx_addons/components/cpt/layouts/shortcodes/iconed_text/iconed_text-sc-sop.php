<?php
/**
 * Shortcode: Display icons with two text lines (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.08
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Layouts_Iconed_Text extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			
			parent::__construct(
				'trx_addons_sow_widget_layouts_iconed_text',
				esc_html__('ThemeREX Layouts: Iconed Text', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_iconed_text',
					'description' => __('Insert icon with two text lines to the custom layout', 'trx_addons')
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
						"description" => wp_kses_data( __("Select shortcodes's type", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', array(
							'default' => esc_html__('Default', 'trx_addons')
						), $this->get_sc_name()),
						'type' => 'select'
					)
				),
				trx_addons_sow_add_icon_param(''),
				array(
					"text1" => array(
						"label" => esc_html__("Text line 1", 'trx_addons'),
						"description" => wp_kses_data( __("Text in the first line", 'trx_addons') ),
						"type" => "text"
					),
					"text2" => array(
						"label" => esc_html__("Text line 2", 'trx_addons'),
						"description" => wp_kses_data( __("Text in the second line", 'trx_addons') ),
						"type" => "text"
					),
					"link" => array(
						"label" => esc_html__("Link URL", 'trx_addons'),
						"description" => wp_kses_data( __("Specify link URL. If empty - show plain text without link", 'trx_addons') ),
						"type" => "link"
					),
				),
				trx_addons_sow_add_hide_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_iconed_text', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Iconed_Text');
}
