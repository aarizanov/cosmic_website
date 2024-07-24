<?php
/**
 * Shortcode: Display selected widgets area (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.19
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Layouts_Widgets extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_widgets',
				esc_html__('ThemeREX Layouts: Widgets', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_widgets',
					'description' => __('Insert selected widgets area', 'trx_addons')
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
					),
					"widgets" => array(
						"label" => esc_html__("Widgets", 'trx_addons'),
						"description" => wp_kses_data( __("Select previously filled widgets area", 'trx_addons') ),
						"options" => trx_addons_get_list_sidebars(),
						"type" => "select"
					),
					"columns" => array(
						"label" => esc_html__("Columns", 'trx_addons'),
						"description" => wp_kses_data( __("Select number columns to show widgets. If 0 - autodetect by the widgets number", 'trx_addons') ),
						"options" => trx_addons_get_list_range(0, 6),
						"type" => "select"
					)
				),
				trx_addons_sow_add_hide_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_widgets', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Widgets');
}
