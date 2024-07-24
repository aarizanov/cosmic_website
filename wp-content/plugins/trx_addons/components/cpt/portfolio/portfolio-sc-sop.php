<?php
/**
 * ThemeREX Addons Custom post type: Portfolio (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.5
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}




// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Portfolio extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_portfolio',
				esc_html__('ThemeREX Portfolio', 'trx_addons'),
				array(
					'classname' => 'widget_portfolio',
					'description' => __('Display portfolio posts', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'portfolio', 'sc'), $this->get_sc_name(), 'sow' ),
						'type' => 'select'
					),
					"more_text" => array(
						"label" => esc_html__("'More' text", 'trx_addons'),
						"description" => wp_kses_data( __("Specify caption of the 'Read more' button. If empty - hide button", 'trx_addons') ),
						"default" => esc_html__('Read more', 'trx_addons'),
						"type" => "text",
					),
					"post_type" => array(
						"label" => esc_html__("Post type", 'trx_addons'),
						"description" => wp_kses_data( __("Select post type to show posts", 'trx_addons') ),
						"default" => 'post',
						"options" => trx_addons_get_list_posts_types(),
						"type" => "select"
					),
					"cat" => array(
						"label" => esc_html__("Group", 'trx_addons'),
						"description" => wp_kses_data( __("Select portfolio group", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Select category -', 'trx_addons')),
															trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PORTFOLIO_TAXONOMY)
															),
						"type" => "select"
					)
				),
				trx_addons_sow_add_query_param(''),
				trx_addons_sow_add_slider_param(),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_portfolio', __FILE__, 'TRX_Addons_SOW_Widget_Portfolio');
}
