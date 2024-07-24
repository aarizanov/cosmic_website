<?php
/**
 * Shortcode: Display WPML Language Selector (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.18
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')
	//&& function_exists('trx_addons_exists_wpml') && trx_addons_exists_wpml()
	) {
		
	class TRX_Addons_SOW_Widget_Layouts_Language extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_language',
				esc_html__('ThemeREX Layouts: Language', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_language',
					'description' => __('Insert WPML Language Selector', 'trx_addons')
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
					"flag" => array(
						"label" => esc_html__("Show flag", 'trx_addons'),
						"description" => wp_kses_data( __("Where do you want to show flag?", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_layouts_language_positions(),
						"default" => "both",
						"type" => "select"
					),
					"title_link" => array(
						"label" => esc_html__("Show link's title", 'trx_addons'),
						"description" => wp_kses_data( __("Select link's title type", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_layouts_language_parts(),
						"default" => "name",
						"type" => "select"
					),
					"title_menu" => array(
						"label" => esc_html__("Show menu item's title", 'trx_addons'),
						"description" => wp_kses_data( __("Select menu item's title type", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_layouts_language_parts(),
						"default" => "name",
						"type" => "select"
					)
				),
				trx_addons_sow_add_hide_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_language', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Language');
}
