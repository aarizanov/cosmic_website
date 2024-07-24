<?php
class CosmicTextSlider extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Text Slider';
	public $shortcode_slug = 'cosmic_text_slider';

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'register_composer_fields' ) );
		// Use this when creating a shortcode output
		add_shortcode( $this->shortcode_slug, array( $this, 'render_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	// Load Required Css And Js files
	public function enqueue() {
		// Plugin css and js
		wp_enqueue_script( 'slick', get_template_directory_uri().'/vendor/slick/slick.min.js', array( 'jquery' ), '1.8.1', true );
		wp_enqueue_style( 'slick', get_template_directory_uri().'/vendor/slick/slick.css', null, '1.8.1' );
		wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/vendor/slick/slick-theme.css', null, '1.8.1' );
		wp_enqueue_script( $this->shortcode_slug, get_template_directory_uri().'/js/dist/vc_cosmic_text_slider.min.js', array( 'jquery' ), '1.0.0', true );
	}

	public function register_composer_fields() {
		$args = array(
			'name' => __( 'Cosmic Text Slider', 'cosmic' ),
			'base' => $this->shortcode_slug,
			'as_parent' => array( 'only' => 'cosmic_text_slide' ),
			'category' => __( 'Cosmic Widgets', 'cosmic' ),
			'content_element' => true,
			'show_settings_on_create' => false,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'		=> 'checkbox',
					'heading'	  => esc_html__( 'Navigation', 'cosmic' ),
					'param_name'  => 'slider_nav',
					'value' => array(
						'Arrows' => 'arrow',
						'Dots' => 'dots',
					),
					'admin_label' => false,
					'std' => '',
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Slides to show', 'cosmic' ),
					'param_name'  => 'slides_to_show',
					'value' => array(
						'1 slide' => '1',
						'3 slides' => '3',
						'5 slides' => '5',
						'7 slides' => '7',
					),
					'admin_label' => false,
					'std' => '1',
				),
				array(
					'type'		=> 'checkbox',
					'heading'	  => esc_html__( 'Center Mode?', 'cosmic' ),
					'param_name'  => 'slider_center',
					'value' => array(
						'Yes' => 'yes',
					),
					'admin_label' => false,
				),
				array(
					'type'		=> 'checkbox',
					'heading'	  => esc_html__( 'Autoplay?', 'cosmic' ),
					'param_name'  => 'slider_autoplay',
					'value' => array(
						'Yes' => 'yes',
					),
					'admin_label' => false,
				),
				array(
					'type'		=> 'colorpicker',
					'heading'	  => esc_html__( 'Navigation Color', 'cosmic' ),
					'param_name'  => 'nav_color',
					'admin_label' => false,
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Element Class', 'cosmic' ),
					'param_name'  => 'class',
					'admin_label' => false,
					'description' => 'Additional element css class',
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Element Id', 'cosmic' ),
					'param_name'  => 'id',
					'admin_label' => true,
					'description' => 'Additional element css id',
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
			'slider_nav' => '',
			'slides_to_show' => '',
			'slider_center' => '',
			'slider_autoplay' => '',
			'nav_color' => '',
			'css' => '',
			'class' => '',
			'id' => '',
		), $atts ) );

		// Empty and default vars
		$output = $slides = $color = '';
		$arrow = $dots = $center = $autoplay = 'false';
		$slides_num = 1;
		$shortcode_id = str_replace( '.', '', uniqid( $this->shortcode_slug, true ) );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), false , $atts );
		// Additional element id
		if ( $id ) { $shortcode_id = $id; }
		$css_classes = array();

		// Create css classes
		$css_classes[] = 'widget_'.esc_attr( $this->shortcode_slug );
		$css_classes[] = $css_class;
		$css_classes[] = $class;
		ob_start();

		// Stories content
		if ( $content ) {
			$slides = do_shortcode( $content );
		}

		// Define slider data classes
		if ( $slider_nav ) {
			$slider_nav_array = explode( ',' , $slider_nav );
			if ( isset( $slider_nav_array ) && ! empty( $slider_nav_array ) && is_array( $slider_nav_array ) ) {
				if ( in_array( 'arrow', $slider_nav_array, true ) ) {
					$arrow = 'true';
				}
				if ( in_array( 'dots', $slider_nav_array, true ) ) {
					$dots = 'true';
				}
			}
		}
		if ( $slider_center ) {
			if ( 'yes' === $slider_center ) {
				$center = 'true';
				$css_classes[] = 'center_slider';
			}
		}
		if ( $slides_to_show ) {
			$slides_num = intval( $slides_to_show );
		}
		if ( $nav_color ) {
			$color = 'style="color:'.esc_attr( $nav_color ).';"';
		}
		if ( $slider_autoplay ) {
			$autoplay = 'true';
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'" 
				data-arrow="'.esc_attr( $arrow ).'" 
				data-dots="'.esc_attr( $dots ).'" 
				data-center="'.esc_attr( $center ).'" 
				data-slides="'.esc_attr( $slides_num ).'" 
				data-autoplay="'.esc_attr( $autoplay ).'" 
			>
				<div class="widget-inner">
					<div class="cosmic_slider" '.$color.'>
						'.$slides.'
					</div>
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// We must extend WPBakeryShortCodesContainer with newly created class
class WPBakeryShortCode_cosmic_text_slider extends WPBakeryShortCodesContainer {
}
// Finally initialize code
new CosmicTextSlider;
