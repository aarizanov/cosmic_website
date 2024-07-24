<?php
/**
 * Shortcode: Display menu in the Layouts Builder (SOP support)
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
	class TRX_Addons_SOW_Widget_Layouts_Menu extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts_menu',
				esc_html__('ThemeREX Layouts: Menu', 'trx_addons'),
				array(
					'classname' => 'widget_layouts_menu',
					'description' => __('Insert any menu to the custom layout', 'trx_addons')
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
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array('type')
						),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_get_list_sc_layouts_menu(), $this->get_sc_name()),
						'type' => 'select'
					),
					'direction' => array(
						'label' => __('Direction', 'trx_addons'),
						"description" => wp_kses_data( __("Select direction of the menu items", 'trx_addons') ),
						'default' => 'horizontal',
						'options' => trx_addons_get_list_sc_directions(),
						'type' => 'select'
					),
					'location' => array(
						'label' => __('Location', 'trx_addons'),
						"description" => wp_kses_data( __("Select menu location to insert to the layout", 'trx_addons') ),
						'state_emitter' => array(
							'callback' => 'select',
							'args'     => array('location')
						),
						'options' => trx_addons_get_list_menu_locations(),
						'type' => 'select'
					),
					'menu' => array(
						'label' => __('Menu', 'trx_addons'),
						"description" => wp_kses_data( __("Select menu to insert to the layout. If empty - use menu assigned in the field 'Location'", 'trx_addons') ),
						'state_handler' => array(
							"location[none]" => array('show'),
							"_else[location]" => array('hide')
						),
						'options' => trx_addons_get_list_menus(),
						'type' => 'select'
					),
					'hover' => array(
						'label' => __('Hover', 'trx_addons'),
						"description" => wp_kses_data( __("Select the menu items hover", 'trx_addons') ),
						'state_handler' => array(
							"type[default]" => array('show'),
							"_else[type]" => array('hide')
						),
						'default' => 'fade',
						'options' => trx_addons_get_list_menu_hover(),
						'type' => 'select'
					),
					'animation_in' => array(
						'label' => __('Submenu animation in', 'trx_addons'),
						"description" => wp_kses_data( __("Select animation to show submenu", 'trx_addons') ),
						'state_handler' => array(
							"type[default]" => array('show'),
							"_else[type]" => array('hide')
						),
						'default' => 'fadeIn',
						'options' => trx_addons_get_list_animations_in(),
						'type' => 'select'
					),
					'animation_out' => array(
						'label' => __('Submenu animation out', 'trx_addons'),
						"description" => wp_kses_data( __("Select animation to hide submenu", 'trx_addons') ),
						'state_handler' => array(
							"type[default]" => array('show'),
							"_else[type]" => array('hide')
						),
						'default' => 'fadeOut',
						'options' => trx_addons_get_list_animations_out(),
						'type' => 'select'
					),
					'mobile_button' => array(
						'label' => __('Mobile button', 'trx_addons'),
						"description" => wp_kses_data( __("Add menu button instead menu on mobile devices. When it clicked - open menu", 'trx_addons') ),
						'default' => false,
						'type' => 'checkbox'
					),
					'mobile_menu' => array(
						'label' => __('Add to the mobile menu', 'trx_addons'),
						"description" => wp_kses_data( __("Use this menu items as mobile menu (if mobile menu not selected in the theme)", 'trx_addons') ),
						'default' => false,
						'type' => 'checkbox'
					),
					'hide_on_mobile' => array(
						'label' => __('Hide on mobile devices', 'trx_addons'),
						"description" => wp_kses_data( __("Hide this menu on mobile devices", 'trx_addons') ),
						'state_handler' => array(
							"type[default]" => array('show'),
							"_else[type]" => array('hide')
						),
						'default' => false,
						'type' => 'checkbox'
					)
				),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts_menu', __FILE__, 'TRX_Addons_SOW_Widget_Layouts_Menu');
}
