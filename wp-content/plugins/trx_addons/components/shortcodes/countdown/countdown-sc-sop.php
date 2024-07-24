<?php
/**
 * Shortcode: Countdown (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4.3
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}




// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Countdown extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_countdown',
				esc_html__('ThemeREX Countdown', 'trx_addons'),
				array(
					'classname' => 'widget_countdown',
					'description' => __('Display countdown to/from specified event', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'countdown'), $this->get_sc_name(), 'sow' ),
						'type' => 'select'
					),
					"align" => array(
						"label" => esc_html__("Block alignment", 'trx_addons'),
						"description" => wp_kses_data( __("Select alignment of the countdown", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_aligns(),
						"default" => "none",
						"type" => "select"
					),
					'date' => array(
						'label' => __('Date', 'trx_addons'),
						'description' => esc_html__( 'Target date. Attention! Write the date in the format: yyyy-mm-dd', 'trx_addons' ),
						'type' => 'text'
					),
					'time' => array(
						'label' => __('Time', 'trx_addons'),
						'description' => esc_html__( 'Target time. Attention! Put the time in the 24-hours format: HH:mm:ss', 'trx_addons' ),
						'type' => 'text'
					)
				),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_countdown', __FILE__, 'TRX_Addons_SOW_Widget_Countdown');
}
