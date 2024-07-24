<?php
/**
 * Shortcode: Anchor (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }




// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Anchor extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_anchor',
				esc_html__('ThemeREX Anchor', 'trx_addons'),
				array(
					'classname' => 'widget_anchor',
					'description' => __('Add anchor to the page', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			return apply_filters('trx_addons_sow_map', array_merge(array(
					'id' => array(
						'label' => __('Anchor ID', 'trx_addons'),
						"description" => wp_kses_data( __("ID of this anchor", 'trx_addons') ),
						'type' => 'text'
					),
					'title' => array(
						'label' => __('Title', 'trx_addons'),
						'description' => esc_html__( 'Anchor title', 'trx_addons' ),
						'type' => 'text'
					),
					'url' => array(
						'type' => 'link',
						'label' => __('URL to navigate. If empty - use ID to create anchor', 'trx_addons'),
						'description' => esc_html__( "URL to navigate. If empty - use id to create anchor", 'trx_addons' ),
						'type' => 'text'
					)
				),
				trx_addons_sow_add_icon_param('')
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_anchor', __FILE__, 'TRX_Addons_SOW_Widget_Anchor');
}
