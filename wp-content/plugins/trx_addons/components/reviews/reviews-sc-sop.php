<?php
/**
 * ThemeREX Addons Posts and Comments Reviews (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.47
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}




// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Reviews extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_reviews',
				esc_html__('ThemeREX Reviews', 'trx_addons'),
				array(
					'classname' => 'widget_reviews',
					'description' => __('Display post reviews block', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', array(
														'default' => esc_html__('Default', 'trx_addons')
													), 'trx_sc_reviews'),
						'type' => 'select'
					),
					'title' => array(
						'label' => __('Title', 'trx_addons'),
						'description' => esc_html__( 'Title of the block', 'trx_addons' ),
						'type' => 'text'
					),
					'rating_max_level' => array(
						'label' => __('Max rating level', 'trx_addons'),
						'description' => esc_html__( 'Maximum level for grading marks', 'trx_addons' ),
						"default" => 'inherit',
						"options" => array(
								__( 'Inherit', 'trx_addons' ) => 'inherit',
								__( '5 stars', 'trx_addons' ) => '5',
								__( '10 stars', 'trx_addons' ) => '10',
								__( '100%', 'trx_addons' ) => '100'
							),
						"type" => "select"
					),
					'rating_style' => array(
						'label' => __('Show rating as', 'trx_addons'),
						'description' => esc_html__( 'Show rating as icons or as progress bars or as text', 'trx_addons' ),
						"default" => 'inherit',
						"options" => array(
								__( 'Inherit', 'trx_addons' ) => 'inherit',
								__( 'As icons', 'trx_addons' ) => 'icons',
								__( 'As progress bar', 'trx_addons' ) => 'bar',
								__( 'As text (for example: 7.5 / 10)', 'trx_addons' ) => 'text'
							),
						"type" => "select"
					),
					"rating_color" => array(
						"label" => esc_html__("Color", 'trx_addons'),
						"description" => wp_kses_data( __("Specify color for rating icons/bar", 'trx_addons') ),
						"type" => "color"
					)
				),
				trx_addons_sow_add_icon_param('', false, 'icons'),
				array(
					'rating_text_template' => array(
						'label' => __('Text template', 'trx_addons'),
						'description' => esc_html__( 'Write text template, where {{X}} - is a current value, {{Y}} - is a max value, , {{V}} - is a number of votes. For example "Rating {{X}} from {{Y}} (according {{V}})"', 'trx_addons' ),
						'type' => 'text'
					),
					'allow_voting' => array(
						'label' => __('Allow voting', 'trx_addons'),
						'description' => esc_html__( 'Allow users to vote the post', 'trx_addons' ),
						"default" => true,
						"type" => "checkbox"
					)
				),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_reviews', __FILE__, 'TRX_Addons_SOW_Widget_Reviews');
}
