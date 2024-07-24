<?php
/**
 * Shortcode: Promo block (SOP support)
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
	class TRX_Addons_SOW_Widget_Promo extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_promo',
				esc_html__('ThemeREX Promo', 'trx_addons'),
				array(
					'classname' => 'widget_promo',
					'description' => __('Display promo block', 'trx_addons')
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
								'use_type[modern]: val=="modern"',
								'use_type[hide]: val!="modern"',
							)
						),
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'promo'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					)
				),
				trx_addons_sow_add_icon_param(''),
				trx_addons_sow_add_title_param(''),
				array(
					'link2' => array(
						'label' => __('Second link URL', 'trx_addons'),
						'description' => esc_html__( 'URL for the second button (at the side of the image)', 'trx_addons' ),
						'state_handler' => array(
							"use_type[modern]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						'type' => 'link'
					),
					'link2_text' => array(
						'label' => __('Link text', 'trx_addons'),
						"description" => wp_kses_data( __("Caption for the second button (at the side of the image)", 'trx_addons') ),
						'state_handler' => array(
							"use_type[modern]" => array('show'),
							"use_type[hide]" => array('hide')
						),
						'type' => 'text'
					),
					'text_bg_color' => array(
						'label' => __('Text bg color', 'trx_addons'),
						'description' => esc_html__( 'Select custom color, used as background of the text area', 'trx_addons' ),
						'type' => 'color'
					),
					'sow_section_image' => array(
						'label' => __('Image', 'trx_addons'),
						'hide' => true,
						'type' => 'section',
						'fields' => array(
							'image' => array(
								'label' => __('Image', 'trx_addons'),
								"description" => wp_kses_data( __("Select the promo image from the library for this section. Show slider if you select 2+ images", 'trx_addons') ),
								'state_emitter' => array(
									'callback' => 'conditional',
									'args'     => array(
										'use_image[show]: val',
										'use_image[hide]: ! val',
									)
								),
								'type' => 'media'
							),
							'image_bg_color' => array(
								'label' => __('Image bg color', 'trx_addons'),
								'description' => esc_html__( 'Select custom color, used as background of the image', 'trx_addons' ),
								'state_handler' => array(
									"use_image[show]" => array('show'),
									"use_image[hide]" => array('hide')
								),
								'type' => 'color'
							),
							"image_cover" => array(
								"label" => esc_html__("Cover area", 'trx_addons'),
								"description" => wp_kses_data( __("Fit image into area or cover it", 'trx_addons') ),
								'state_handler' => array(
									"use_image[show]" => array('show'),
									"use_image[hide]" => array('hide')
								),
								"default" => true,
								"type" => "checkbox"
							),
							'image_position' => array(
								'label' => __('Image position', 'trx_addons'),
								"description" => wp_kses_data( __("Place the image to the left or to the right from the text block", 'trx_addons') ),
								'state_handler' => array(
									"use_image[show]" => array('show'),
									"use_image[hide]" => array('hide')
								),
								'default' => 'left',
								'options' => trx_addons_get_list_sc_icon_positions(),
								'type' => 'select'
							),
							'image_width' => array(
								'label' => __('Image width', 'trx_addons'),
								"description" => wp_kses_data( __("Width (in pixels or percents) of the block with image", 'trx_addons') ),
								'state_handler' => array(
									"use_image[show]" => array('show'),
									"use_image[hide]" => array('hide')
								),
								'default' => '50%',
								'type' => 'measurement'
							),
							'video_url' => array(
								'label' => __('Video URL', 'trx_addons'),
								"description" => wp_kses_data( __("Enter link to the video (Note: read more about available formats at WordPress Codex page)", 'trx_addons') ),
								'state_handler' => array(
									"use_image[show]" => array('show'),
									"use_image[hide]" => array('hide')
								),
								'type' => 'text'
							),
							'video_embed' => array(
								'label' => __('Video embed code', 'trx_addons'),
								"description" => wp_kses_data( __("or paste the HTML code to embed video in this block", 'trx_addons') ),
								'state_handler' => array(
									"use_image[show]" => array('show'),
									"use_image[hide]" => array('hide')
								),
								'type' => 'textarea'
							),
							"video_in_popup" => array(
								"label" => esc_html__("Video in the popup", 'trx_addons'),
								"description" => wp_kses_data( __("Open video in the popup window or insert it instead image", 'trx_addons') ),
								'state_handler' => array(
									"use_image[show]" => array('show'),
									"use_image[hide]" => array('hide')
								),
								"default" => false,
								"type" => "checkbox"
							)
						)
					),
					'sow_section_dimensions' => array(
						'label' => __('Dimensions', 'trx_addons'),
						'hide' => true,
						'type' => 'section',
						'fields' => array(
							'size' => array(
								'label' => __('Size', 'trx_addons'),
								"description" => wp_kses_data( __("Size of the promo block: normal - one in the row, tiny - only image and title, small - insize two or greater columns, large - fullscreen height", 'trx_addons') ),
								'default' => 'normal',
								'options' => trx_addons_get_list_sc_promo_sizes(),
								'type' => 'select'
							),
							"full_height" => array(
								"label" => esc_html__("Full height", 'trx_addons'),
								"description" => wp_kses_data( __("Stretch the height of the element to the full screen's height", 'trx_addons') ),
								"default" => false,
								"type" => "checkbox"
							),
							'text_width' => array(
								'label' => __('Text width', 'trx_addons'),
								"description" => wp_kses_data( __("Select width of the text block", 'trx_addons') ),
								'default' => 'none',
								'options' => trx_addons_get_list_sc_promo_widths(),
								'type' => 'select'
							),
							'text_float' => array(
								'label' => __('Text block floating', 'trx_addons'),
								"description" => wp_kses_data( __("Select alignment (floating position) of the text block", 'trx_addons') ),
								'default' => 'none',
								'options' => trx_addons_get_list_sc_aligns(),
								'type' => 'select'
							),
							'text_align' => array(
								'label' => __('Text alignment', 'trx_addons'),
								"description" => wp_kses_data( __("Align text to the left or to the right side inside the block", 'trx_addons') ),
								'default' => 'none',
								'options' => trx_addons_get_list_sc_aligns(),
								'type' => 'select'
							),
							"text_paddings" => array(
								"label" => esc_html__("Text paddings", 'trx_addons'),
								"description" => wp_kses_data( __("Add horizontal paddings from the text block", 'trx_addons') ),
								"default" => false,
								"type" => "checkbox"
							),
							'text_margins' => array(
								'label' => __('Text margins', 'trx_addons'),
								"description" => wp_kses_data( __("Margins for the all sides of the text block (Example: 30px 10px 40px 30px = top right botton left OR 30px = equal for all sides)", 'trx_addons') ),
								'type' => 'text'
							),
							'gap' => array(
								'label' => __('Gap', 'trx_addons'),
								"description" => wp_kses_data( __("Gap between text and image (in percent)", 'trx_addons') ),
								'type' => 'measurement'
							),
						)
					)
				),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_promo', __FILE__, 'TRX_Addons_SOW_Widget_Promo');
}
