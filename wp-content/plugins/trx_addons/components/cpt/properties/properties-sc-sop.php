<?php
/**
 * ThemeREX Addons Custom post type: Properties (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.22
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Properties extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_properties',
				esc_html__('ThemeREX Properties', 'trx_addons'),
				array(
					'classname' => 'widget_properties',
					'description' => __('Display properties', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			// Prepare lists
			list($vc_edit, $vc_params) = trx_addons_get_sow_form_params('TRX_Addons_SOW_Widget_Properties');
			// Prepare lists
			$country = $vc_edit && !empty($vc_params['properties_country']) ? $vc_params['properties_country'] : 0;
			$state = $vc_edit && !empty($vc_params['properties_state']) ? $vc_params['properties_state'] : 0;
			$city = $vc_edit && !empty($vc_params['properties_city']) ? $vc_params['properties_city'] : 0;
			$neighborhood = $vc_edit && !empty($vc_params['properties_neighborhood']) ? $vc_params['properties_neighborhood'] : 0;
			// List of states
			$list_states = trx_addons_array_merge(array(0 => esc_html__('- State -', 'trx_addons')),
											$country == 0
												? array()
												: trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_STATE, array(
													'meta_key' => 'country',
													'meta_value' => $country
													))
											);
			// List of cities
			$args = array();
			if ($state > 0)
				$args = array(
							'meta_key' => 'state',
							'meta_value' => $state
							);
			else if ($country > 0)
				$args = array(
							'meta_key' => 'country',
							'meta_value' => $country
							);
			$list_cities = trx_addons_array_merge(array(0 => esc_html__('- City -', 'trx_addons')),
											count($args) == 0
												? array()
												: trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_CITY, $args)
											);
			// List of neighborhoods
			$list_neighborhoods = trx_addons_array_merge(array(0 => esc_html__('- Neighborhood -', 'trx_addons')),
											$city == 0
												? array()
												: trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_NEIGHBORHOOD, array(
														'meta_key' => 'city',
														'meta_value' => $city
														))
											);
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'properties', 'sc'), $this->get_sc_name(), 'sow' ),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array('type')
						),
						'type' => 'select'
					),
					"map_height" => array(
						"label" => esc_html__("Map height", 'trx_addons'),
						"description" => wp_kses_data( __("Specify height of the map with properties", 'trx_addons') ),
						'state_handler' => array(
							"type[map]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => "350px",
						"type" => "measurement"
					),
					"more_text" => array(
						"label" => esc_html__("'More' text", 'trx_addons'),
						"description" => wp_kses_data( __("Specify caption of the 'Read more' button. If empty - hide button", 'trx_addons') ),
						"default" => esc_html__('Read more', 'trx_addons'),
						"type" => "text",
					),
					"pagination" => array(
						"label" => esc_html__("Pagination", 'trx_addons'),
						"description" => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
						"default" => 'none',
						"options" => trx_addons_get_list_sc_paginations(),
						"type" => "select"
					),
					"properties_type" => array(
						"label" => esc_html__("Type", 'trx_addons'),
						"description" => wp_kses_data( __("Select the type to show properties that have it", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Type -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_TYPE)),
						"type" => "select"
					),
					"properties_status" => array(
						"label" => esc_html__("Labels", 'trx_addons'),
						"description" => wp_kses_data( __("Select the label to show properties that have it", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Label -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_LABELS)),
						"type" => "select"
					),
					"properties_labels" => array(
						"label" => esc_html__("Status", 'trx_addons'),
						"description" => wp_kses_data( __("Select the status to show properties that have it", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Status -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_STATUS)),
						"type" => "select"
					),
					"properties_country" => array(
						"label" => esc_html__("Country", 'trx_addons'),
						"description" => wp_kses_data( __("Select the country to show properties from", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Country -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_PROPERTIES_TAXONOMY_COUNTRY)),
						"type" => "select"
					),
					"properties_state" => array(
						"label" => esc_html__("State", 'trx_addons'),
						"description" => wp_kses_data( __("Select the county/state to show properties from", 'trx_addons') ),
						"default" => 0,
						"options" => $list_states,
						"type" => "select_dynamic"
					),
					"properties_city" => array(
						"label" => esc_html__("City", 'trx_addons'),
						"description" => wp_kses_data( __("Select the city to show properties from", 'trx_addons') ),
						"default" => 0,
						"options" => $list_cities,
						"type" => "select_dynamic"
					),
					"properties_neighborhood" => array(
						"label" => esc_html__("Neighborhood", 'trx_addons'),
						"description" => wp_kses_data( __("Select the neighborhood to show properties from", 'trx_addons') ),
						"default" => 0,
						"options" => $list_neighborhoods,
						"type" => "select_dynamic"
					),
				),
				trx_addons_sow_add_query_param('', array(
					'orderby' => array( 
									"options" => trx_addons_get_list_sc_query_orderby('none', 'none,ID,post_date,price,title,rand')
								),
					'columns' => array( 
									'state_handler' => array(
										"type[default]" => array('show'),
										"type[slider]" => array('show'),
										"_else[type]" => array('hide')
									)
								)
				)),
				trx_addons_sow_add_slider_param(false, array(
					'slider' => array( 
									'state_handler' => array(
										"type[default]" => array('show'),
										"type[slider]" => array('show'),
										"_else[type]" => array('hide')
									)
								),
					'slider_pagination' => array(
									"options" => trx_addons_array_merge(trx_addons_get_list_sc_slider_paginations(), array(
										'bottom_outside' => esc_html__('Bottom Outside', 'trx_addons')
									))
								)
				)),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_properties', __FILE__, 'TRX_Addons_SOW_Widget_Properties');
}
