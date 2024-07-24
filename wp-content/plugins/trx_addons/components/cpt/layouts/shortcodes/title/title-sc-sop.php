<?php
/**
 * Shortcode: Display site meta and/or title and/or breadcrumbs (SOP support)
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
	class TRX_Addons_SOW_Widget_Layouts_Title extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_title',
				esc_html__('ThemeREX Layouts: Title', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_title',
					'description' => __('Insert post/page title, meta and/or breadcrumbs', 'trx_addons')
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
					'title' => array(
						'label' => __('Show title', 'trx_addons'),
						"description" => wp_kses_data( __("Show post/page title", 'trx_addons') ),
						'default' => true,
						'type' => 'checkbox'
					),
					'meta' => array(
						'label' => __('Show post meta', 'trx_addons'),
						"description" => wp_kses_data( __("Show post/page meta - publish date, author, categories, etc.", 'trx_addons') ),
						'default' => true,
						'type' => 'checkbox'
					),
					'breadcrumbs' => array(
						'label' => __('Show breadcrumbs', 'trx_addons'),
						"description" => wp_kses_data( __("Show breadcrumbs", 'trx_addons') ),
						'default' => true,
						'type' => 'checkbox'
					),
					'image' => array(
						'label' => __('Background image', 'trx_addons'),
						"description" => wp_kses_data( __("Background image of the block", 'trx_addons') ),
						'type' => 'media'
					),
					'use_featured_image' => array(
						'label' => __('Replace with featured image', 'trx_addons'),
						"description" => wp_kses_data( __("Use post's featured image as background of the block instead image above (if present)", 'trx_addons') ),
						'default' => false,
						'type' => 'checkbox'
					),
					"height" => array(
						"label" => esc_html__("Height of the block", 'trx_addons'),
						"description" => wp_kses_data( __("Specify height of this block. If empty - use default height", 'trx_addons') ),
						"type" => "measurement"
					),
					"align" => array(
						"label" => esc_html__("Alignment", 'trx_addons'),
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
	siteorigin_widget_register('trx_addons_sow_widget_layouts_title', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Title');
}
