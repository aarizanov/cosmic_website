<?php
/**
 * ThemeREX Addons Custom post type: Services (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Services extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_services',
				esc_html__('ThemeREX Services', 'trx_addons'),
				array(
					'classname' => 'widget_services',
					'description' => __('Display services', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			// Prepare lists
			list($vc_edit, $vc_params) = trx_addons_get_sow_form_params('TRX_Addons_SOW_Widget_Services');
			// Prepare lists
			$post_type = $vc_edit && !empty($vc_params['post_type']) ? $vc_params['post_type'] : TRX_ADDONS_CPT_SERVICES_PT;
			$taxonomy = $vc_edit && !empty($vc_params['taxonomy']) ? $vc_params['taxonomy'] : TRX_ADDONS_CPT_SERVICES_TAXONOMY;
			$tax_obj = get_taxonomy($taxonomy);
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'services', 'sc'), $this->get_sc_name(), 'sow' ),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array('type')
						),
						'type' => 'select'
					),
					"featured" => array(
						"label" => esc_html__("Featured", 'trx_addons'),
						"description" => wp_kses_data( __("What to use as featured element?", 'trx_addons') ),
						"default" => 'image',
						"options" => trx_addons_get_list_sc_services_featured(),
						"type" => "select"
					),
					"featured_position" => array(
						"label" => esc_html__("Featured position", 'trx_addons'),
						"description" => wp_kses_data( __("Select the position of the featured element. Attention! Use 'Bottom' only with 'Callouts' or 'Timeline'", 'trx_addons') ),
						'state_handler' => array(
							"type[default]" => array('show'),
							"type[callouts]" => array('show'),
							"type[light]" => array('show'),
							"type[list]" => array('show'),
							"type[tabs_simple]" => array('show'),
							"type[timeline]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => 'top',
						"options" => trx_addons_get_list_sc_services_featured_positions(),
						"type" => "select"
					),
					"tabs_effect" => array(
						"label" => esc_html__("Tabs change effect", 'trx_addons'),
						"description" => wp_kses_data( __("Select the tabs change effect", 'trx_addons') ),
						'state_handler' => array(
							"type[tabs]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => 'fade',
						"options" => trx_addons_get_list_sc_services_tabs_effects(),
						"type" => "select"
					),
					"hide_excerpt" => array(
						"label" => esc_html__("Hide excerpt", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want hide excerpt", 'trx_addons') ),
						'state_handler' => array(
							"type[hover]" => array('hide'),
							"_else[type]" => array('show')
						),
						"default" => false,
						"type" => "checkbox"
					),
					"no_links" => array(
						"label" => esc_html__("Disable links", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want disable links to the single posts", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox",
						'state_emitter' => array(
							'callback' => 'conditional',
							'args'     => array(
								'use_links[default]: val==true',
								'use_links[hide]: val!=true',
							)
						),
					),
					"more_text" => array(
						"label" => esc_html__("'More' text", 'trx_addons'),
						"description" => wp_kses_data( __("Specify caption of the 'Read more' button. If empty - hide button", 'trx_addons') ),
						"default" => esc_html__('Read more', 'trx_addons'),
						"type" => "text",
						'state_handler' => array(
							"use_links[default]" => array('show'),
							"use_links[hide]" => array('hide')
						),
					),
					"no_margin" => array(
						"label" => esc_html__("Remove margin", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want remove spaces between columns", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox"
					),
					"icons_animation" => array(
						"label" => esc_html__("Icons animation", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want animate icons. Attention! Animation enabled only if in your theme exists .SVG icon with same name as selected icon", 'trx_addons') ),
						'state_handler' => array(
							"type[default]" => array('show'),
							"type[callouts]" => array('show'),
							"type[light]" => array('show'),
							"type[list]" => array('show'),
							"type[iconed]" => array('show'),
							"type[tabs]" => array('show'),
							"type[tabs_simple]" => array('show'),
							"type[timeline]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => false,
						"type" => "checkbox"
					),
					"hide_bg_image" => array(
						"label" => esc_html__("Hide bg image", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want hide background image on the front item", 'trx_addons') ),
						'state_handler' => array(
							"type[hover]" => array('show'),
							"_else[type]" => array('hide')
						),
						"default" => false,
						"type" => "checkbox"
					),
					"popup" => array(
						"label" => esc_html__("Open in the popup", 'trx_addons'),
						"description" => wp_kses_data( __("Open details in the popup or navigate to the single post (default)", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox"
					),
					"pagination" => array(
						"label" => esc_html__("Pagination", 'trx_addons'),
						"description" => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
						"default" => 'none',
						"options" => trx_addons_get_list_sc_paginations(),
						"type" => "select"
					),
					"post_type" => array(
						"label" => esc_html__("Post type", 'trx_addons'),
						"description" => wp_kses_data( __("Select post type to show posts", 'trx_addons') ),
						"default" => TRX_ADDONS_CPT_SERVICES_PT,
						"options" => trx_addons_get_list_posts_types(),
						"type" => "select"
					),
					"taxonomy" => array(
						"label" => esc_html__("Taxonomy", 'trx_addons'),
						"description" => wp_kses_data( __("Select taxonomy to show posts", 'trx_addons') ),
						"default" => TRX_ADDONS_CPT_SERVICES_TAXONOMY,
						"options" => trx_addons_get_list_taxonomies(false, $post_type),
						"type" => "select_dynamic"
					),
					"cat" => array(
						"label" => esc_html__("Group", 'trx_addons'),
						"description" => wp_kses_data( __("Services group to show posts", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0=>sprintf(__('- %s -', 'trx_addons'), $tax_obj->label)),
																	 $taxonomy == 'category' 
																		? trx_addons_get_list_categories() 
																		: trx_addons_get_list_terms(false, $taxonomy)
																	),
						"type" => "select_dynamic"
					)
				),
				trx_addons_sow_add_query_param('', array(
					'columns' => array( 
									'state_handler' => array(
										"type[default]" => array('show'),
										"type[callouts]" => array('show'),
										"type[light]" => array('show'),
										"type[list]" => array('show'),
										"type[iconed]" => array('show'),
										"type[hover]" => array('show'),
										"type[chess]" => array('show'),
										"type[timeline]" => array('show'),
										"_else[type]" => array('hide')
									)
								)
				)),
				trx_addons_sow_add_slider_param(false, array(
					'slider' => array( 
									'state_handler' => array(
										"type[default]" => array('show'),
										"type[callouts]" => array('show'),
										"type[light]" => array('show'),
										"type[list]" => array('show'),
										"type[iconed]" => array('show'),
										"type[hover]" => array('show'),
										"type[chess]" => array('show'),
										"type[timeline]" => array('show'),
										"_else[type]" => array('hide')
									)
								)
				)),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_services', __FILE__, 'TRX_Addons_SOW_Widget_Services');
}
