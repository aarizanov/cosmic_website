<?php
/**
 * Shortcode: Button (SOP support)
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
	class TRX_Addons_SOW_Widget_Button extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_button',
				esc_html__('ThemeREX Button', 'trx_addons'),
				array(
					'classname' => 'widget_button',
					'description' => __('Display button', 'trx_addons')
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
						'state_emitter' => array(
							'callback' => 'conditional',
							'args'     => array(
								'use_type[default]: val=="default"',
								'use_type[hide]: val!="default"',
							)
						),
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'button'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					),
					"size" => array(
						"label" => esc_html__("Size", 'trx_addons'),
						"description" => wp_kses_data( __("Size of the button", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_button_sizes(),
						"default" => "normal",
						"type" => "select"
					),
					"link" => array(
						"label" => esc_html__("Button URL", 'trx_addons'),
						"description" => wp_kses_data( __("Link URL for the button", 'trx_addons') ),
						"type" => "link"
					),
					"title" => array(
						"label" => esc_html__("Title", 'trx_addons'),
						"description" => wp_kses_data( __("Title of the button.", 'trx_addons') ),
						"type" => "text"
					),
					"subtitle" => array(
						"label" => esc_html__("Subtitle", 'trx_addons'),
						"description" => wp_kses_data( __("Subtitle for the button", 'trx_addons') ),
						"type" => "text"
					),
					"align" => array(
						"label" => esc_html__("Button alignment", 'trx_addons'),
						"description" => wp_kses_data( __("Select button alignment", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_aligns(),
						"default" => "none",
						"type" => "select"
					),
					"text_align" => array(
						"label" => esc_html__("Text alignment", 'trx_addons'),
						"description" => wp_kses_data( __("Select text alignment", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_aligns(),
						"default" => "none",
						"type" => "select"
					),
					"bg_image" => array(
						"label" => esc_html__("Button's background image", 'trx_addons'),
						"description" => wp_kses_data( __("Select the image from the library for this button's background", 'trx_addons') ),
						'state_handler' => array(
							"use_type[default]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						"type" => "media"
					)
				),
				trx_addons_sow_add_icon_param(''),
				array(
					"image" => array(
						"label" => esc_html__("or select an image", 'trx_addons'),
						"description" => wp_kses_data( __("Select the image instead the icon (if need)", 'trx_addons') ),
						"type" => "media"
					),
					"icon_position" => array(
						"label" => esc_html__("Icon position", 'trx_addons'),
						"description" => wp_kses_data( __("Place the image to the left or to the right or to the top of the button", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_icon_positions(),
						"default" => "left",
						"type" => "select"
					),
				),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_button', __FILE__, 'TRX_Addons_SOW_Widget_Button');
}
