<?php
/**
 * Shortcode: Table (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.3
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Table extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_table',
				esc_html__('ThemeREX Table', 'trx_addons'),
				array(
					'classname' => 'widget_table',
					'description' => __('Insert table from any table-generator', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'table'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					),
					"align" => array(
						"label" => esc_html__("Table alignment", 'trx_addons'),
						"description" => wp_kses_data( __("Select alignment of the table", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_aligns(),
						"default" => "none",
						"type" => "select"
					),
					"width" => array(
						"label" => esc_html__("Width", 'trx_addons'),
						"description" => wp_kses_data( __("Width of the table", 'trx_addons') ),
						"type" => "measurement"
					),
					"content" => array(
						"label" => esc_html__("Content", 'trx_addons'),
						"description" => wp_kses_data( __("Content, created with any table-generator, for example: http://www.impressivewebs.com/html-table-code-generator/ or http://html-tables.com/", 'trx_addons') ),
						"type" => "textarea"
					)
				),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_table', __FILE__, 'TRX_Addons_SOW_Widget_Table');
}
