<?php
class CosmicGoogleMaps extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Google Maps';
	public $shortcode_slug = 'cosmic_google_maps';

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'register_composer_fields' ) );
		// Use this when creating a shortcode output
		add_shortcode( $this->shortcode_slug, array( $this, 'render_shortcode' ) );
		// Register CSS and JS
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	// Load Required Css And Js files
	public function enqueue() {
		wp_enqueue_script( 'cosmic_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDtDu1MUxs-HpclBFj2357bNMaSQYdAF2U', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( $this->shortcode_slug, get_template_directory_uri().'/js/dist/vc_cosmic_google_maps.min.js', array( 'jquery' ), '1.0.0', true );
	}

	public function register_composer_fields() {
		$args = array(
			'name' => $this->shortcode_name,
			'base' => $this->shortcode_slug,
			'class' => '',
			'category' => __( 'Cosmic Widgets', 'cosmic' ),
			'params' => array(
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Zoom Level ', 'cosmic' ),
					'param_name'  => 'map_zoom',
					'admin_label' => false,
					'save_always' => true,
					'value'	=> array(
						esc_html( '0' )	=> '0',
						esc_html( '1' )	=> '1',
						esc_html( '2' )	=> '2',
						esc_html( '3' )	=> '3',
						esc_html( '4' )	=> '4',
						esc_html( '5' )	=> '5',
						esc_html( '6' )	=> '6',
						esc_html( '7' )	=> '7',
						esc_html( '8' )	=> '8',
						esc_html( '9' )	=> '9',
						esc_html( '10' )	=> '10',
						esc_html( '11' )	=> '11',
						esc_html( '12' )	=> '12',
						esc_html( '13' )	=> '13',
						esc_html( '14' )	=> '14',
						esc_html( '15' )	=> '15',
						esc_html( '16' )	=> '16',
						esc_html( '17' )	=> '17',
					),
					'std'		 => '8',
					'group' => esc_html__( 'Map options', 'cosmic' ),
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Map position ( Latitude and Longitude )', 'cosmic' ),
					'param_name'  => 'map_latlong',
					'admin_label' => false,
					'save_always' => true,
					'value'		 => '40.6700, -73.9400',
					'group' => esc_html__( 'Map options', 'cosmic' ),
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Marker Title', 'cosmic' ),
					'param_name'  => 'map_marker_title',
					'admin_label' => true,
					'save_always' => true,
					'group' => esc_html__( 'Map options', 'cosmic' ),
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Marker Position ( Latitude and Longitude )', 'cosmic' ),
					'param_name'  => 'map_marker_latlong',
					'admin_label' => true,
					'save_always' => true,
					'value'		 => '40.6700, -73.9400',
					'group' => esc_html__( 'Map options', 'cosmic' ),
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Map Height ( in px )', 'cosmic' ),
					'param_name'  => 'map_marker_height',
					'admin_label' => true,
					'save_always' => true,
					'group' => esc_html__( 'Map options', 'cosmic' ),
				),array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Iframe map location (If this option is used, it will be used "Maps Embed API" and the previous options will be ignored )', 'cosmic' ),
					'param_name'  => 'map_iframe_location',
					'admin_label' => true,
					'save_always' => true,
					'group' => esc_html__( 'Map options', 'cosmic' ),
				),
				array(
					'type'		=> 'checkbox',
					'heading'	  => esc_html__( 'Enable box mode?', 'cosmic' ),
					'param_name'  => 'map_box_enable',
					'admin_label' => true,
					'group' => esc_html__( 'Box options', 'cosmic' ),
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Bot title', 'cosmic' ),
					'param_name'  => 'map_box_title',
					'admin_label' => true,
					'dependency' => array(
						'element' => 'map_box_enable',
						'value' => 'true',
					),
					'group' => esc_html__( 'Box options', 'cosmic' ),
				),
				array(
					'type'		=> 'textarea_html',
					'heading'	  => esc_html__( 'Bot content', 'cosmic' ),
					'param_name'  => 'content',
					'admin_label' => true,
					'dependency' => array(
						'element' => 'map_box_enable',
						'value' => 'true',
					),
					'group' => esc_html__( 'Box options', 'cosmic' ),
				),
				array(
					'type' => 'animation_style',
					'heading' => __( 'Animation Style', 'cosmic' ),
					'param_name' => 'animation',
					'description' => __( 'Choose your animation style', 'cosmic' ),
					'admin_label' => false,
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Additional Class', 'cosmic' ),
					'param_name'  => 'class',
					'admin_label' => false,
					'description' => 'Additional css class',
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Additional Id', 'cosmic' ),
					'param_name'  => 'id',
					'admin_label' => true,
					'description' => 'Additional css id',
				),
				array(
					'type' => 'css_editor',
					'heading' => esc_html__( 'Css', 'cosmic' ),
					'param_name' => 'css',
					'group' => esc_html__( 'Design options', 'cosmic' ),
				),
			),
		);
		vc_map( $args );
	}

	// Shortcode logic how it should be rendered
	public function render_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'map_zoom' => '',
			'map_latlong' => '',
			'map_marker_title' => '',
			'map_marker_latlong' => '',
			'map_marker_height' => '',
			'map_iframe_location' => '',
			'map_box_enable' => '',
			'map_box_title' => '',
			'css' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
		), $atts ) );

		// Empty and default vars
		$output = $m_zoom = $m_location = $m_mark_title = $m_mark_location = $map_box = '';
		$shortcode_id = str_replace( '.', '', uniqid( $this->shortcode_slug, true ) );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), false , $atts );
		$animation_classes = $this->getCSSAnimation( $animation );
		$css_classes = array();

		// Create css classes
		$css_classes[] = 'widget_'.esc_attr( $this->shortcode_slug );
		$css_classes[] = $css_class;
		$css_classes[] = $animation_classes;
		$css_classes[] = $class;
		if ( $id ) {
			$shortcode_id = $id;
		}
		ob_start();

		if ( $map_zoom ) {
			$m_zoom = $map_zoom;
		}
		if ( $map_latlong ) {
			$m_location = $map_latlong;
		}
		if ( $map_marker_title ) {
			$m_mark_title = $map_marker_title;
		}
		if ( $map_marker_latlong ) {
			$m_mark_location = $map_marker_latlong;
		}
		if ( ! $map_marker_height ) {
			$map_marker_height = '500';
		}
		
		if ( $map_box_enable ) {
			if ( 'true' == $map_box_enable ) {
				$css_classes[] = 'boxed_map';
				$b_title = $b_contentn = '';
				if ( $map_box_title ) {
					$b_title = '<div class="title"><div class="title-inner"><h5>'.esc_html( $map_box_title ).'</h5></div></div>';
				}
				if ( $content ) {
					$b_contentn = '<div class="content"><div class="content-inner">'.wp_kses_post( $content ).'</div></div>';
				}
				if ( $b_title || $b_contentn ) {
					$map_box = '<div class="map_box"><div class="map_box-inner">'.$b_title.$b_contentn.'</div></div>';
				}
			}
		}
		
		if ( $map_iframe_location ) {
			$map = '<iframe width="312" height="300" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:' . $map_iframe_location . '&key=AIzaSyDtDu1MUxs-HpclBFj2357bNMaSQYdAF2U" allowfullscreen></iframe>';
		} else {
			$map = '<div id="'.esc_attr( $shortcode_id ).'" class="cosmic-maps-wrap" data-zoom = "'.esc_attr( $m_zoom ).'" data-loc = "'.esc_attr( $m_location ).'" data-mtitle = "'.esc_attr( $m_mark_title ).'" data-mloc = "'.esc_attr( $m_mark_location ).'" data-marker="'.esc_url( get_template_directory_uri().'/img/marker.png' ).'" style="height:'.esc_attr( $map_marker_height ).'px;"></div>';
		}


		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" >
				<div class="widget-inner">
					'.$map.$map_box.'
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicGoogleMaps;
