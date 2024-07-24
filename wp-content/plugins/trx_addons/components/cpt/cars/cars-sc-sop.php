<?php
/**
 * ThemeREX Addons Custom post type: Cars (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.25
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Cars extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_cars',
				esc_html__('ThemeREX Cars', 'trx_addons'),
				array(
					'classname' => 'widget_cars',
					'description' => __('Display cars', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}

		// Return array with all widget's fields
		function get_widget_form() {
			// Prepare lists
			list($vc_edit, $vc_params) = trx_addons_get_sow_form_params('TRX_Addons_SOW_Widget_Cars');
			// Prepare lists                                                          
			$maker = $vc_edit && !empty($vc_params['cars_maker']) ? $vc_params['cars_maker'] : 0;
			$model = $vc_edit && !empty($vc_params['cars_model']) ? $vc_params['cars_model'] : 0;
			// List of models
			$list_models = trx_addons_array_merge(array(0 => esc_html__('- Model -', 'trx_addons')),
											$maker == 0
												? array()
												: trx_addons_get_list_terms(false, TRX_ADDONS_CPT_CARS_TAXONOMY_MODEL, array(
													'meta_key' => 'maker',
													'meta_value' => $maker
													))
											);
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'cars', 'sc'), $this->get_sc_name(), 'sow' ),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array('type')
						),
						'type' => 'select'
					),
					"cars_type" => array(
						"label" => esc_html__("Type", 'trx_addons'),
						"description" => wp_kses_data( __("Select the type to show cars that have it", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Type -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_CARS_TAXONOMY_TYPE)),
						"type" => "select"
					),
					"cars_maker" => array(
						"label" => esc_html__("Manufacturer", 'trx_addons'),
						"description" => wp_kses_data( __("Select the car's manufacturer", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Manufacturer -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_CARS_TAXONOMY_MAKER)),
						"type" => "select"
					),
					"cars_model" => array(
						"label" => esc_html__("Model", 'trx_addons'),
						"description" => wp_kses_data( __("Select the car's model", 'trx_addons') ),
						"default" => 0,
						"options" => $list_models,
						"type" => "select_dynamic"
					),
					"cars_status" => array(
						"label" => esc_html__("Status", 'trx_addons'),
						"description" => wp_kses_data( __("Select the status to show cars that have it", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Status -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_CARS_TAXONOMY_STATUS)),
						"type" => "select"
					),
					"cars_labels" => array(
						"label" => esc_html__("Label", 'trx_addons'),
						"description" => wp_kses_data( __("Select the label to show cars that have it", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Label -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_CARS_TAXONOMY_LABELS)),
						"type" => "select"
					),
					"cars_city" => array(
						"label" => esc_html__("City", 'trx_addons'),
						"description" => wp_kses_data( __("Select the city to show cars that have it", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- City -', 'trx_addons')), trx_addons_get_list_terms(false, TRX_ADDONS_CPT_CARS_TAXONOMY_CITY)),
						"type" => "select"
					),
					"cars_transmission" => array(
						"label" => esc_html__("Transmission", 'trx_addons'),
						"description" => wp_kses_data( __("Select type of the transmission", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Transmission -', 'trx_addons')), trx_addons_cpt_cars_get_list_transmission()),
						"type" => "select"
					),
					"cars_type_drive" => array(
						"label" => esc_html__("Type of drive", 'trx_addons'),
						"description" => wp_kses_data( __("Select type of drive", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Type drive -', 'trx_addons')), trx_addons_cpt_cars_get_list_type_of_drive()),
						"type" => "select"
					),
					"cars_fuel" => array(
						"label" => esc_html__("Fuel", 'trx_addons'),
						"description" => wp_kses_data( __("Select type of the fuel", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Fuel -', 'trx_addons')), trx_addons_cpt_cars_get_list_fuel()),
						"type" => "select"
					),
					"more_text" => array(
						"label" => esc_html__("'More' text", 'trx_addons'),
						"description" => wp_kses_data( __("Specify caption of the 'Read more' button. If empty - hide button", 'trx_addons') ),
						"default" => esc_html__('Read more', 'trx_addons'),
						"type" => "text"
					),
					"pagination" => array(
						"label" => esc_html__("Pagination", 'trx_addons'),
						"description" => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
						"default" => 'none',
						"options" => trx_addons_get_list_sc_paginations(),
						"type" => "select"
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
	siteorigin_widget_register('trx_addons_sow_widget_cars', __FILE__, 'TRX_Addons_SOW_Widget_Cars');
}
