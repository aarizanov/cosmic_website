<?php
/**
 * Shortcode: Display any previously created layout (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.06
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Layouts extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_layouts',
				esc_html__('ThemeREX Layouts', 'trx_addons'),
				array(
					'classname' => 'widget_layouts',
					'description' => __('Display previously created layout (header, footer, etc.)', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}

		// Return array with all widget's fields
		function get_widget_form() {
			// If open params in SOW Editor
			list($vc_edit, $vc_params) = trx_addons_get_sow_form_params('TRX_Addons_SOW_Widget_Layouts');
			// Prepare lists
			$layouts = trx_addons_array_merge(	array(
													0 => __('- Use content -', 'trx_addons')
													),
												trx_addons_get_list_posts(false, array(
															'post_type' => TRX_ADDONS_CPT_LAYOUTS_PT,
															'meta_key' => 'trx_addons_layout_type',
															'meta_value' => 'custom',
															'not_selected' => false
															)));
			$default = trx_addons_array_get_first($layouts);
			$layout = $vc_edit && !empty($vc_params['layout']) ? $vc_params['layout'] : $default;
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Type', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's type", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', trx_addons_get_list_sc_layouts_type(), $this->get_sc_name()),
						'type' => 'select',
						'state_emitter' => array(
							'callback' => 'conditional',
							'args'     => array(
								'use_side[default]: val!="panel"',
								'use_side[hide]: val=="panel"',
							)
						)
					),
					"layout" => array(
						"label" => esc_html__("Layout", 'trx_addons'),
						"description" => wp_kses_post( __("Select any previously created layout to insert to this page", 'trx_addons')
															. '<br>'
															. sprintf('<a href="%1$s" class="trx_addons_post_editor'.(intval($layout)==0 ? ' trx_addons_hidden' : '').'" target="_blank">%2$s</a>',
																		admin_url( sprintf( "post.php?post=%d&amp;action=edit", $layout ) ),
																		__("Open selected layout in a new tab to edit", 'trx_addons')
																	)
														),
						"options" => $layouts,
						"type" => "select"
					),
					"position" => array(
						"label" => esc_html__("Panel position", 'trx_addons'),
						'description' => wp_kses_data( __("Dock the panel to the specified side of the window", 'trx_addons') ),
						"options" => trx_addons_get_list_sc_layouts_panel_positions(),
						"default" => "right",
						"type" => "select",
						'state_handler' => array(
							"use_side[default]" => array('show'),
							"use_side[hide]" => array('hide')
						),
					),
					"size" => array(
						"label" => esc_html__("Size of the panel", 'trx_addons'),
						"description" => wp_kses_data( __("Size (width or height) of the panel", 'trx_addons') ),
						"default" => "300px",
						"type" => "measurement",
						'state_handler' => array(
							"use_side[default]" => array('show'),
							"use_side[hide]" => array('hide')
						),
					),
					"modal" => array(
						"label" => esc_html__("Modal", 'trx_addons'),
						"description" => wp_kses_data( __("Disable clicks on the rest window area", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox",
						'state_handler' => array(
							"use_side[default]" => array('show'),
							"use_side[hide]" => array('hide')
						),
					),
					"content" => array(
						"label" => esc_html__("Content", 'trx_addons'),
						"description" => wp_kses_data( __("Alternative content to be used instead of the selected layout", 'trx_addons') ),
						"type" => "textarea"
					)
				),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_layouts', __FILE__, 'TRX_Addons_SOW_Widget_Layouts');
}
