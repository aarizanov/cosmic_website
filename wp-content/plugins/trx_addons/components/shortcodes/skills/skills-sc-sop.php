<?php
/**
 * Shortcode: Skills (SOP support)
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
	class TRX_Addons_SOW_Widget_Skills extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_skills',
				esc_html__('ThemeREX Skills', 'trx_addons'),
				array(
					'classname' => 'widget_skills',
					'description' => __('Display skills chart', 'trx_addons')
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
						'state_emitter' => array(
							'callback' => 'conditional',
							'args'     => array(
								'use_type[pie]: val=="pie"',
								'use_type[hide]: val!="pie"',
							)
						),
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'skills'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					),
					"cutout" => array(
						"label" => esc_html__("Cutout", 'trx_addons'),
						"description" => wp_kses_data( __("Specify pie cutout. You will see border width as 100% - cutout value", 'trx_addons') ),
						'state_handler' => array(
							"use_type[pie]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						"min" => 0,
						"max" => 99,
						"type" => "slider"
					),
					"compact" => array(
						"label" => esc_html__("Compact", 'trx_addons'),
						"description" => wp_kses_data( __("Show all values in one pie or each value in the single pie", 'trx_addons') ),
						'state_handler' => array(
							"use_type[pie]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						"default" => false,
						"type" => "checkbox"
					),
					'color' => array(
						'label' => __('Color', 'trx_addons'),
						'description' => esc_html__( 'Select custom color to fill each item', 'trx_addons' ),
						"default" => '#ff0000',
						'type' => 'color'
					),
					'bg_color' => array(
						'label' => __('Background color', 'trx_addons'),
						'description' => esc_html__( "Select custom color for item's background", 'trx_addons' ),
						'state_handler' => array(
							"use_type[pie]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						'type' => 'color'
					),
					'border_color' => array(
						'label' => __('Border color', 'trx_addons'),
						'description' => esc_html__( "Select custom color for item's border", 'trx_addons' ),
						'state_handler' => array(
							"use_type[pie]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						'type' => 'color'
					),
					"max" => array(
						"label" => esc_html__("Max. value", 'trx_addons'),
						"description" => wp_kses_data( __("Enter max value for all items", 'trx_addons') ),
						"default" => 100,
						"type" => "number"
					),
					"columns" => array(
						"label" => esc_html__("Columns", 'trx_addons'),
						"description" => wp_kses_data( __("Specify number of columns for skills. If empty - auto detect by items number", 'trx_addons') ),
						"type" => "number"
					),
					'values' => array(
						'label' => __('Values', 'trx_addons'),
						'item_name'  => __( 'Skill value', 'trx_addons' ),
						'item_label' => array(
							'selector'     => "[name*='title']",
							'update_event' => 'change',
							'value_method' => 'val'
						),
						'type' => 'repeater',
						'fields' => apply_filters('trx_addons_sc_param_group_fields', array_merge(array(
								'title' => array(
									'label' => __('Title', 'trx_addons'),
									'description' => esc_html__( 'Enter title of the item', 'trx_addons' ),
									'type' => 'text'
								),
								'value' => array(
									'label' => __('Value', 'trx_addons'),
									"description" => wp_kses_data( __("Enter value of this item", 'trx_addons') ),
									'type' => 'text'
								),
								'color' => array(
									'label' => __('Color', 'trx_addons'),
									'description' => esc_html__( "Select custom color of this item", 'trx_addons' ),
									'type' => 'color'
								)
							),
							trx_addons_sow_add_icon_param('')
						), $this->get_sc_name())
					)
				),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_skills', __FILE__, 'TRX_Addons_SOW_Widget_Skills');
}
