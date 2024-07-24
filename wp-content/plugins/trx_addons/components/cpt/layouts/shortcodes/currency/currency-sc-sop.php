<?php
/**
 * Shortcode: Display WooCommerce Currency Switcher with items number and totals (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.14
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

	


// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget') 
	//&& function_exists('trx_addons_exists_woocommerce') && trx_addons_exists_woocommerce() && class_exists('WOOCS')
	) {
	class TRX_Addons_SOW_Widget_Layouts_Currency extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_currency',
				esc_html__('ThemeREX Layouts: Currency', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_currency',
					'description' => __('Insert Currency Switcher', 'trx_addons')
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
				trx_addons_sow_add_hide_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_currency', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Currency');
}
