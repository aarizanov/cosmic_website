<?php
/**
 * Shortcode: Display Search form (SOP support)
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
	class TRX_Addons_SOW_Widget_Layouts_Search extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_search',
				esc_html__('ThemeREX Layouts: Search', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_search',
					'description' => __('Insert search form to the custom layout', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {

			$post_types = trx_addons_get_list_posts_types();

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
					"style" => array(
						"label" => esc_html__("Style", 'trx_addons'),
						"description" => wp_kses_data( __("Select form's style", 'trx_addons') ),
						"options" => apply_filters('trx_addons_sc_style', trx_addons_get_list_sc_layouts_search(), $this->get_sc_name()),
						"default" => "default",
						"type" => "select"
					),
					'ajax' => array(
						'label' => __('AJAX search', 'trx_addons'),
						"description" => wp_kses_data( __("Use AJAX incremental search", 'trx_addons') ),
						'default' => false,
						'type' => 'checkbox'
					),
					'post_types' =>	array(
						"label" => esc_html__("Search in post types", 'trx_addons'),
						"description" => wp_kses_data( __("Select the types of posts you want to search", 'trx_addons') ),
						"default" => "",
						"multiple" => true,
						"options" => $post_types,
						"type" => "select"
					),
				),
				trx_addons_sow_add_hide_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_search', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Search');
}
