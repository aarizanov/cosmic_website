<?php
class CosmicJumpArrow extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Jump Arrow';
	public $shortcode_slug = 'cosmic_jump_arrow';

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

	}

	public function register_composer_fields() {
		$args = array(
			'name' => $this->shortcode_name,
			'base' => $this->shortcode_slug,
			'content_element' => true,
			'class' => '',
			'category' => __( 'Cosmic Widgets', 'cosmic' ),
			'params' => array(
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Button url', 'cosmic' ),
					'param_name'  => 'link',
					'admin_label' => true,
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
					'heading'	  => esc_html__( 'Arrow Class', 'cosmic' ),
					'param_name'  => 'class',
					'admin_label' => false,
					'description' => 'Additional css class',
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Arrow Id', 'cosmic' ),
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
			'css' => '',
			'link' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
		), $atts ) );

		// Empty and default vars
		$output = $btn = '';
		$shortcode_id = str_replace( '.', '', uniqid( $this->shortcode_slug, true ) );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), false , $atts );
		$animation_classes = $this->getCSSAnimation( $animation );
		$css_classes = array();
		
		// Create css classes
		$css_classes[] = 'widget_'.esc_attr( $this->shortcode_slug );
		$css_classes[] = $css_class;
		$css_classes[] = $animation_classes;
		$css_classes[] = $class;
		ob_start();

		if ( $link ) {
			$btn = '<a href="'.esc_url( $link ).'"><i class="fal fa-angle-double-down"></i></a>';
		}
		
		if ( $id ) {
			$shortcode_id = $id;
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'">
				<div class="widget-inner">
					'.$btn.'
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicJumpArrow;
