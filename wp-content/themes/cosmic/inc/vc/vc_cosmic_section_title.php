<?php
class CosmicSectionTitle extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Section Title';
	public $shortcode_slug = 'cosmic_section_title';

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
					'heading'	  => esc_html__( 'Title', 'cosmic' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'type'		=> 'colorpicker',
					'heading'	  => esc_html__( 'Title Color', 'cosmic' ),
					'param_name'  => 'title_color',
					'admin_label' => false,
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Align Item', 'cosmic' ),
					'param_name'  => 'align',
					'value' => array(
						'Left' => 'left',
						'Center' => 'center',
						'Right' => 'right',
					),
					'admin_label' => false,
					'std' => 'center',
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Background', 'cosmic' ),
					'param_name'  => 'bg_img',
					'value' => array(
						'Blue' => 'blue',
						'Gray' => 'gray',
						'Red' => 'red',
					),
					'admin_label' => false,
					'std' => 'blue',
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
					'heading'	  => esc_html__( 'Button Class', 'cosmic' ),
					'param_name'  => 'class',
					'admin_label' => false,
					'description' => 'Additional button css class',
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Button Id', 'cosmic' ),
					'param_name'  => 'id',
					'admin_label' => true,
					'description' => 'Additional button css id',
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
			'title' => '',
			'title_color' => '',
			'align' => '',
			'bg_img' => '',
			'css' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
		), $atts ) );

		// Empty and default vars
		$output = $el_title = $el_img = '';
		$shortcode_id = str_replace( '.', '', uniqid( $this->shortcode_slug, true ) );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), false , $atts );
		$animation_classes = $this->getCSSAnimation( $animation );
		ob_start();

		$css_classes = array();

		// Create css classes
		$css_classes[] = 'widget_'.esc_attr( $this->shortcode_slug );
		$css_classes[] = $css_class;
		$css_classes[] = $animation_classes;
		$css_classes[] = $class;

		// Additional element id
		if ( $id ) {
			$shortcode_id = $id;
		}

		// Align class
		if ( $align ) {
			$css_classes[] = 'align_'.esc_attr( $align );
		} else {
			$css_classes[] = 'align_center';
		}

		// Element image
		if ( $bg_img ) {
			$img_url = get_stylesheet_directory_uri().'/img/vc_cosmic_section_title/bg-'.esc_attr( $bg_img ).'.png';
		} else {
			$img_url = get_stylesheet_directory_uri().'/img/vc_cosmic_section_title/bg-blue.png';
		}
		$el_img = '<img class="img" src="'.esc_url( $img_url ).'">';

		// Title element
		if ( $title ) {
			$styles = '';
			if ( $title_color ) {
				$styles = ' style="color:'.esc_attr( $title_color ).'" ';
			}
			$el_title = '
				<div class="title">
					<h3'.$styles.'>'.$el_img.'<span>'.esc_html( $title ).'</span></h3>
				</div>';
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'">
				<div class="widget-inner">
					'.$el_title.'
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicSectionTitle;
