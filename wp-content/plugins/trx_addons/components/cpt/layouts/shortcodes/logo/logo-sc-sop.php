<?php
/**
 * Shortcode: Display site Logo (SOP support)
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
	class TRX_Addons_SOW_Widget_Layouts_Logo extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_logo',
				esc_html__('ThemeREX Layouts: Logo', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_logo',
					'description' => __('Insert the site logo to the custom layout', 'trx_addons')
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
					'logo' => array(
						'label' => __('Logo', 'trx_addons'),
						"description" => wp_kses_data( __("Select or upload image for site's logo", 'trx_addons') ),
						'type' => 'media'
					),
					'logo_retina' => array(
						'label' => __('Logo Retina', 'trx_addons'),
						"description" => wp_kses_data( __("Select or upload image for site's logo on the Retina displays", 'trx_addons') ),
						'type' => 'media'
					),
					"logo_height" => array(
						"label" => esc_html__("Max height", 'trx_addons'),
						"description" => wp_kses_data( __("Max height of the logo image. If empty - theme default value is used", 'trx_addons') ),
						"type" => "text"
					),
					"logo_text" => array(
						"label" => esc_html__("Logo text", 'trx_addons'),
						"description" => wp_kses_data( __("Site name (used if logo is empty). If not specified - use blog name", 'trx_addons') ),
						"type" => "text"
					),
					"logo_slogan" => array(
						"label" => esc_html__("Logo slogan", 'trx_addons'),
						"description" => wp_kses_data( __("Slogan or description below site name (used if logo is empty). If not specified - use blog description", 'trx_addons') ),
						"type" => "text"
					),
				),
				trx_addons_sow_add_hide_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_logo', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Logo');
}
