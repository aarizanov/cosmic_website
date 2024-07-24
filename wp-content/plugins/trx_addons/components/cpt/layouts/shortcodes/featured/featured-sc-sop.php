<?php
/**
 * Shortcode: Display post/page featured image (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.13
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}

	


// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Layouts_Featured extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_featured',
				esc_html__('ThemeREX Layouts: Featured', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_featured',
					'description' => __('Insert post/page featured image', 'trx_addons')
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
					"height" => array(
						"label" => esc_html__("Height of the block", 'trx_addons'),
						"description" => wp_kses_data( __("Specify height of this block. If empty - use default height", 'trx_addons') ),
						"type" => "measurement"
					),
					"align" => array(
						"label" => esc_html__("Content alignment", 'trx_addons'),
						"description" => wp_kses_data( __("Select alignment of the inner content in this block", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_aligns(true, false),
						"default" => "inherit",
						"type" => "select"
					),
				),
				trx_addons_sow_add_hide_param(false, true),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_featured', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Featured');
}
