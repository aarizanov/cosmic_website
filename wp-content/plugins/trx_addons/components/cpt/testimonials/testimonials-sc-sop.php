<?php
/**
 * ThemeREX Addons Custom post type: Testimonials (SOP support)
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
	class TRX_Addons_SOW_Widget_Testimonials extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_testimonials',
				esc_html__('ThemeREX Testimonials', 'trx_addons'),
				array(
					'classname' => 'widget_testimonials',
					'description' => __('Display testimonials', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'testimonials', 'sc'), $this->get_sc_name(), 'sow' ),
						'type' => 'select'
					),
					"cat" => array(
						"label" => esc_html__("Group", 'trx_addons'),
						"description" => wp_kses_data( __("Select testimonials group", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Select group -', 'trx_addons')),
															trx_addons_get_list_terms(false, TRX_ADDONS_CPT_TESTIMONIALS_TAXONOMY)
															),
						"type" => "select"
					)
				),
				trx_addons_sow_add_query_param(''),
				trx_addons_sow_add_slider_param(false, array(
					'slider_pagination' => array(
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array('pagination')
						)
					),
					'slider_pagination_thumbs' => array( 
						"label" => esc_html__("Pagination thumbs", 'trx_addons'),
						"description" => wp_kses_data( __("Show thumbs as pagination bullets", 'trx_addons') ),
						'state_handler' => array(
							"pagination[left]" => array('show'),
							"pagination[right]" => array('show'),
							"pagination[bottom]" => array('show'),
							"_else[pagination]" => array('hide')
						),
						"default" => false,
						"type" => "checkbox"
					)
				)),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_testimonials', __FILE__, 'TRX_Addons_SOW_Widget_Testimonials');
}
