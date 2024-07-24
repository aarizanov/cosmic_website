<?php
/**
 * Shortcode: Blogger (SOP support)
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
	class TRX_Addons_SOW_Widget_Blogger extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_blogger',
				esc_html__('ThemeREX Blogger', 'trx_addons'),
				array(
					'classname' => 'widget_blogger',
					'description' => __('Display blog posts', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			// Prepare lists
			list($vc_edit, $vc_params) = trx_addons_get_sow_form_params('TRX_Addons_SOW_Widget_Blogger');
			$post_type = $vc_edit && !empty($vc_params['post_type']) ? $vc_params['post_type'] : 'post';
			$taxonomy = $vc_edit && !empty($vc_params['taxonomy']) ? $vc_params['taxonomy'] : 'category';
			$tax_obj = get_taxonomy($taxonomy);
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'blogger'), $this->get_sc_name(), 'sow' ),
						'state_emitter' => array(
							'callback' => 'conditional',
							'args'     => array(
								'use_type[default]: val=="default"',
								'use_type[hide]: val!="default"',
							)
						),
						"mode" => 'inline',
						"return" => 'slug',
						"style" => "images",
						'type' => 'icons'
					),
					"hide_excerpt" => array(
						"label" => esc_html__("Hide excerpt", 'trx_addons'),
						"description" => wp_kses_data( __("Check if you want hide excerpt", 'trx_addons') ),
//						'state_handler' => array(
//							"use_type[default]" => array('show'),
//							"use_type[hide]" => array('hide')
//						),
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
						"default" => 'post',
						"options" => trx_addons_get_list_posts_types(),
						"type" => "select"
					),
					"taxonomy" => array(
						"label" => esc_html__("Taxonomy", 'trx_addons'),
						"description" => wp_kses_data( __("Select taxonomy to show posts", 'trx_addons') ),
						"default" => 'category',
						"options" => trx_addons_get_list_taxonomies(false, $post_type),
						"type" => "select_dynamic"
					),
					"cat" => array(
						"label" => esc_html__("Category", 'trx_addons'),
						"description" => wp_kses_data( __("Select category to show posts", 'trx_addons') ),
						"default" => 0,
						"options" => trx_addons_array_merge(array(0=>sprintf(__('- %s -', 'trx_addons'), $tax_obj->label)),
																	 $taxonomy == 'category' 
																		? trx_addons_get_list_categories() 
																		: trx_addons_get_list_terms(false, $taxonomy)
																	),
						"type" => "select_dynamic"
					)
				),
				trx_addons_sow_add_query_param(''),
				trx_addons_sow_add_slider_param(),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_blogger', __FILE__, 'TRX_Addons_SOW_Widget_Blogger');
}
