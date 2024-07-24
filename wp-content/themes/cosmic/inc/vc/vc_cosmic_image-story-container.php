<?php
class CosmicImageStoryContainer extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Image Story Container';
	public $shortcode_slug = 'cosmic_image_story_container';

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'register_composer_fields' ) );
		// Use this when creating a shortcode output
		add_shortcode( $this->shortcode_slug, array( $this, 'render_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	// Load Required Css And Js files
	public function enqueue() {

	}

	public function register_composer_fields() {
		$args = array(
			'name' => __( 'Image Story Container', 'cosmic' ),
			'base' => $this->shortcode_slug,
			'as_parent' => array( 'only' => 'cosmic_image_story' ),
			'category' => __( 'Cosmic Widgets', 'cosmic' ),
			'content_element' => true,
			'show_settings_on_create' => false,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'First image on', 'cosmic' ),
					'param_name'  => 'image_start',
					'value' => array(
						'Left' => 'left',
						'Right' => 'right',
					),
					'admin_label' => true,
					'std' => 'left',
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
			'css' => '',
			'class' => '',
			'id' => '',
			'image_start' => '',
		), $atts ) );

		// Empty and default vars
		$output = $stories = '';
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
			$stories = do_shortcode( $content );
		}

		// Starting image position class
		if ( $image_start ) {
			$css_classes[] = 'align_'.esc_attr( $image_start );
		} else {
			$css_classes[] = 'align_left';
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'">
				<div class="widget-inner">
					'.$stories.'
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// We must extend WPBakeryShortCodesContainer with newly created class
class WPBakeryShortCode_cosmic_image_story_container extends WPBakeryShortCodesContainer {
}
// Finally initialize code
new CosmicImageStoryContainer;
