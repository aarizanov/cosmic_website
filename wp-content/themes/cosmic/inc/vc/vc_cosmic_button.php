<?php
class CosmicButton extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Button';
	public $shortcode_slug = 'cosmic_button';

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
					'heading'	  => esc_html__( 'Button Text', 'cosmic' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Button Size', 'cosmic' ),
					'param_name'  => 'size',
					'value' => array(
						'Small' => 'btn-sm',
						'Medium' => 'btn-md',
						'Large' => 'btn-lg',
						'Extra Large' => 'btn-xl',
					),
					'admin_label' => false,
					'std' => 'btn-md',
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Button Type', 'cosmic' ),
					'param_name'  => 'type',
					'value' => array(
						'Default' => 'button-primary',
						'Ghost' => 'button-ghost',
						'Ghost White' => 'button-ghost button-ghost-white',
					),
					'admin_label' => false,
					'std' => 'button-primary',
				),
				array(
					'type'		=> 'vc_link',
					'heading'	  => esc_html__( 'Set up button', 'cosmic' ),
					'param_name'  => 'link',
					'admin_label' => false,
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
			'css' => '',
			'title' => '',
			'size' => '',
			'link' => '',
			'type' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
		), $atts ) );

		// Empty and default vars
		$output = $btn_title = $btn = '';
		$btn_size = 'btn-md';
		$btn_type = 'button-primary';
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

		// Button type
		if ( $title ) {
			$btn_title = $title;
		}
		// Bail early if no title is present
		if ( ! $title ) {
			return;
		}

		// Button size
		if ( $size ) {
			$btn_size = $size;
		}

		// Button type
		if ( $type ) {
			$btn_type = $type;
		}

		// Additional button id
		if ( $id ) {
			$shortcode_id = $id;
		}

		// Create link
		if ( $link ) {
			$link_array = vc_build_link( $link );
			$link_url = $link_title = $link_target = $link_rel = '';
			if ( ! empty( $link_array ) && is_array( $link_array ) ) {
				if ( array_key_exists( 'url', $link_array ) ) {
					$link_url = $link_array['url'];
				}
				if ( array_key_exists( 'title', $link_array ) ) {
					if ( $link_array['title'] ) {
						$link_title = ' alt = "'.esc_attr( $link_array['title'] ).'" ';
					}
				}
				if ( array_key_exists( 'target', $link_array ) ) {
					if ( $link_array['target'] ) {
						$link_target = ' target = "'.esc_attr( $link_array['target'] ).'" ';
					}
				}
				if ( array_key_exists( 'rel', $link_array ) ) {
					if ( $link_array['rel'] ) {
						$link_rel = ' rel = "'.esc_attr( $link_array['rel'] ).'" ';
					}
				}
				// Check for url and title, and build a button
				if ( $link_url && $btn_title ) {
					$btn .= '<a class="button '.esc_attr( $btn_type ).' '.esc_attr( $btn_size ).'" href="'.esc_url( $link_url ).'" '.$link_title.$link_target.$link_rel.'>'.esc_html( $btn_title ).'</a>';
				}
			}
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
new CosmicButton;
