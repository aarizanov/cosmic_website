<?php
/**
 * Shortcode: Yandex Map (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.51
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {

	class TRX_Addons_SOW_Widget_Yandexmap extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_yandexmap',
				esc_html__('ThemeREX Yandex Map', 'trx_addons'),
				array(
					'classname' => 'widget_yandexmap',
					'description' => __('Display Yandex map', 'trx_addons')
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
						'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('sc', 'yandexmap'), $this->get_sc_name(), 'sow'),
						'type' => 'select'
					),
					'style' => array(
						'label' => __('Style', 'trx_addons'),
						"description" => wp_kses_data( __("Map's custom style", 'trx_addons') ),
						'default' => 'default',
						'options' => trx_addons_get_list_sc_yandexmap_styles(),
						'type' => 'select'
					),
					"zoom" => array(
						"label" => esc_html__("Zoom", 'trx_addons'),
						"description" => wp_kses_data( __("Map zoom factor from 1 to 20. If 0 or empty - fit bounds to markers", 'trx_addons') ),
						"min" => 0,
						"max" => 20,
						"type" => "slider"
					),
					"center" => array(
						"label" => esc_html__("Center", 'trx_addons'),
						"description" => wp_kses_data( __("Lat,Lng coordinates of the map's center. If empty - use coordinates of the first marker (or specified address in the field below)", 'trx_addons') ),
						"value" => "",
						"type" => "text"
					),
					"width" => array(
						"label" => esc_html__("Width", 'trx_addons'),
						"description" => wp_kses_data( __("Width of the map", 'trx_addons') ),
						"default" => "100%",
						"type" => "measurement"
					),
					"height" => array(
						"label" => esc_html__("Height", 'trx_addons'),
						"description" => wp_kses_data( __("Height of the map", 'trx_addons') ),
						"default" => "350px",
						"type" => "measurement"
					),
					'address' => array(
						'label' => __('Address', 'trx_addons'),
						'description' => esc_html__( "Specify address in this field if you don't need unique marker, title or latlng coordinates. Otherwise, leave this field empty and fill markers below", 'trx_addons' ),
						'type' => 'text'
					),
					'cluster' => array(
						'label' => __('Cluster icon', 'trx_addons'),
						'description' => esc_html__( "Select or upload image for markers clusterer", 'trx_addons' ),
						'type' => 'media'
					),
					'markers' => array(
						'label' => __('Markers', 'trx_addons'),
						'item_name'  => __( 'Marker', 'trx_addons' ),
						'item_label' => array(
							'selector'     => "[name*='title']",
							'update_event' => 'change',
							'value_method' => 'val'
						),
						'type' => 'repeater',
						'fields' => apply_filters('trx_addons_sc_param_group_fields', array(
							'address' => array(
								'label' => __('Address', 'trx_addons'),
								"description" => wp_kses_data( __("Address of this marker", 'trx_addons') ),
								'type' => 'text'
							),
							'latlng' => array(
								'label' => __('or Latitude and Longitude', 'trx_addons'),
								"description" => wp_kses_data( __("Comma separated coorditanes of the marker (instead Address above)", 'trx_addons') ),
								'type' => 'text'
							),
							'icon' => array(
								'label' => __('Marker image', 'trx_addons'),
								'description' => esc_html__( "Select or upload image of this marker", 'trx_addons' ),
								'type' => 'media'
							),
							'icon_retina' => array(
								'label' => __('Marker image for Retina', 'trx_addons'),
								'description' => esc_html__( "Select or upload image of this marker for Retina device", 'trx_addons' ),
								'type' => 'media'
							),
							'icon_width' => array(
								'label' => __('Marker width', 'trx_addons'),
								'description' => esc_html__( 'Width of the marker. If empty - use original size', 'trx_addons' ),
								'type' => 'text'
							),
							'icon_height' => array(
								'label' => __('Marker height', 'trx_addons'),
								'description' => esc_html__( 'Height of the marker. If empty - use original size', 'trx_addons' ),
								'type' => 'text'
							),
							'title' => array(
								'label' => __('Title', 'trx_addons'),
								'description' => esc_html__( 'Title of the marker', 'trx_addons' ),
								'type' => 'text'
							),
							'description' => array(
								'rows' => 10,
								'label' => __('Description', 'trx_addons'),
								'description' => esc_html__( 'Description of the marker', 'trx_addons' ),
								'type' => 'tinymce'
							)
						), $this->get_sc_name())
					)
				),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_yandexmap', __FILE__, 'TRX_Addons_SOW_Widget_Yandexmap');
}
