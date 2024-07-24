<?php
/**
 * ThemeREX Addons Custom post type: Team (SOP support)
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
	class TRX_Addons_SOW_Widget_Team extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_team',
				esc_html__('ThemeREX Team members', 'trx_addons'),
				array(
					'classname' => 'widget_team',
					'description' => __('Display team', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'team', 'sc'), $this->get_sc_name(), 'sow' ),
						'type' => 'select'
					),
					"pagination" => array(
						"label" => esc_html__("Pagination", 'trx_addons'),
						"description" => wp_kses_data( __("Add pagination links after posts. Attention! If using slider - pagination not allowed!", 'trx_addons') ),
						"default" => 'none',
						"options" => trx_addons_get_list_sc_paginations(),
						"type" => "select"
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
					"cat" => array(
						"label" => esc_html__("Group", 'trx_addons'),
						"description" => wp_kses_data( __("Select team group", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0 => esc_html__('- Select group -', 'trx_addons')),
															trx_addons_get_list_terms(false, TRX_ADDONS_CPT_TEAM_TAXONOMY)
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
	siteorigin_widget_register('trx_addons_sow_widget_team', __FILE__, 'TRX_Addons_SOW_Widget_Team');
}
