<?php
/**
 * Shortcode: Display Login link (SOP support)
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
	class TRX_Addons_SOW_Widget_Layouts_Login extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_login',
				esc_html__('ThemeREX Layouts: Login', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_login',
					'description' => __('Insert Login/Logout link to the custom layout', 'trx_addons')
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
					"text_login" => array(
						"label" => esc_html__("Login text", 'trx_addons'),
						"description" => wp_kses_data( __("Text of the Login link", 'trx_addons') ),
						"type" => "text"
					),
					"text_logout" => array(
						"label" => esc_html__("Logout text", 'trx_addons'),
						"description" => wp_kses_data( __("Text of the Logout link", 'trx_addons') ),
						"type" => "text"
					),
					'user_menu' => array(
						'label' => __('User menu', 'trx_addons'),
						"description" => wp_kses_data( __("Show user menu on mouse hover", 'trx_addons') ),
						'default' => false,
						'type' => 'checkbox'
					)
				),
				trx_addons_sow_add_hide_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_login', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Login');
}
