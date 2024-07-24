<?php
class CosmicButtonContainer extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Button Container';
	public $shortcode_slug = 'cosmic_button_container';

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
			'name' => __( 'Button Container', 'cosmic' ),
			'base' => $this->shortcode_slug,
			'as_parent' => array( 'only' => 'cosmic_button' ),
			'category' => __( 'Cosmic Widgets', 'cosmic' ),
			'content_element' => true,
			'show_settings_on_create' => false,
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Align Buttons', 'cosmic' ),
					'param_name'  => 'align',
					'value' => array(
						'Left' => 'left',
						'Center' => 'center',
						'Right' => 'right',
					),
					'admin_label' => false,
					'std' => 'left',
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Space Between Buttons', 'cosmic' ),
					'param_name'  => 'space_between',
					'value' => array(
						'Normal' => 'normal',
						'Large' => 'large',
						'Huge' => 'huge',
					),
					'admin_label' => false,
					'std' => 'normal',
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
			'align' => '',
			'space_between' => '',
		), $atts ) );

		// Empty and default vars
		$output = '';
		$align_items = 'align_left';
		$spacer = 'space_normal';
		$shortcode_id = str_replace( '.', '', uniqid( $this->shortcode_slug, true ) );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), false , $atts );

		$css_classes = array();

		// Create css classes
		$css_classes[] = 'widget_'.esc_attr( $this->shortcode_slug );
		$css_classes[] = $css_class;
		ob_start();

		// Align items class
		if ( $align ) {
			$align_items = 'align_'.$align;
		}
		$css_classes[] = $align_items;

		// Space between buttons class
		if ( $space_between ) {
			$spacer = 'space_'.$space_between;
		}
		$css_classes[] = $spacer;

		$buttons = do_shortcode( $content );

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'">
				<div class="widget-inner">
					'.$buttons.'
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// We must extend WPBakeryShortCodesContainer with newly created class
class WPBakeryShortCode_cosmic_Button_Container extends WPBakeryShortCodesContainer {
}
// Finally initialize code
new CosmicButtonContainer;
