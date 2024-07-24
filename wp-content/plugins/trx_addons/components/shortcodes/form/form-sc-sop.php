<?php
/**
 * Shortcode: Form (SOP support)
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
	class TRX_Addons_SOW_Widget_Form extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_form',
				esc_html__('ThemeREX Form', 'trx_addons'),
				array(
					'classname' => 'widget_form',
					'description' => __('Display contact form', 'trx_addons')
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
						"description" => wp_kses_data( __("Select form's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'form'), $this->get_sc_name(), 'sow' ),
						'state_emitter' => array(
							'callback' => 'conditional',
							'args'     => array(
								'use_type[details]: val!="default"',
								'use_type[hide]: val=="default"',
							)
						),
						'type' => 'select'
					),
					"style" => array(
						"label" => esc_html__("Style", 'trx_addons'),
						"description" => wp_kses_data( __("Select input's style", 'trx_addons') ),
						"default" => "inherit",
						"options" => trx_addons_get_list_input_hover(true),
						"type" => "select"
					),
					"align" => array(
						"label" => esc_html__("Fields alignment", 'trx_addons'),
						"description" => wp_kses_data( __("Select alignment of the field's text", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_aligns(),
						"default" => "none",
						"type" => "select"
					),
					"labels" => array(
						"label" => esc_html__("Field labels", 'trx_addons'),
						"description" => wp_kses_data( __("Show field's labels", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox"
					),
					'button_caption' => array(
						'label' => esc_html__( 'Button caption', 'trx_addons' ),
						'description' => esc_html__( 'Caption of the "Send" button', 'trx_addons' ),
						'type' => 'text',
					),
					'email' => array(
						'label' => esc_html__( 'Your E-mail', 'trx_addons' ),
						'description' => esc_html__( 'This address will be used to send you filled form data. If empty - admin e-mail will be used', 'trx_addons' ),
						'type' => 'text',
					),
					'phone' => array(
						'label' => esc_html__( 'Your phone', 'trx_addons' ),
						'description' => esc_html__( 'Specify your phone for the detailed form', 'trx_addons' ),
						'state_handler' => array(
							"use_type[details]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						'type' => 'text',
					),
					'address' => array(
						'label' => esc_html__( 'Your address', 'trx_addons' ),
						'description' => esc_html__( 'Specify your address for the detailed form', 'trx_addons' ),
						'state_handler' => array(
							"use_type[details]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						'type' => 'text',
					)
				),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_form', __FILE__, 'TRX_Addons_SOW_Widget_Form');
}
