<?php
/**
 * Shortcode: Socials (SOP support)
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
	class TRX_Addons_SOW_Widget_Socials extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_socials',
				esc_html__('ThemeREX Socials (Custom)', 'trx_addons'),
				array(
					'classname' => 'widget_socials',
					'description' => __('Links to your favorite social networks', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'socials'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					),
					'icons_type' => array(
						'label' => __('Icons type', 'trx_addons'),
						"description" => wp_kses_data( __("Select links type: to the social profiles or share links", 'trx_addons') ),
						'default' => 'socials',
						'options' => trx_addons_get_list_sc_socials_types(),
						'type' => 'select'
					),
					'align' => array(
						'label' => __('Icons alignment', 'trx_addons'),
						"description" => wp_kses_data( __("Select alignment of the icons", 'trx_addons') ),
						'default' => 'default',
						'options' => trx_addons_get_list_sc_aligns(),
						'type' => 'select'
					),
					'icons' => array(
						'label' => __('Icons', 'trx_addons'),
						'item_name'  => __( 'Social network params', 'trx_addons' ),
						'item_label' => array(
							'selector'     => "[name*='title']",
							'update_event' => 'change',
							'value_method' => 'val'
						),
						'type' => 'repeater',
						'fields' => apply_filters('trx_addons_sc_param_group_fields', array_merge(array(
								'title' => array(
									'label' => __('Title', 'trx_addons'),
									'description' => esc_html__( 'Name of the social network', 'trx_addons' ),
									'type' => 'text'
								),
								'link' => array(
									'label' => __('Link', 'trx_addons'),
									'description' => esc_html__( 'URL to your profile in this network', 'trx_addons' ),
									'type' => 'text'
								)
							),
							trx_addons_sow_add_icon_param('', true)
						), $this->get_sc_name())
					)
				),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_socials', __FILE__, 'TRX_Addons_SOW_Widget_Socials');
}
