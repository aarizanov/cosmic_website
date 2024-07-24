<?php
class CosmicImageWithText extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Image With Text';
	public $shortcode_slug = 'cosmic_image_with_text';

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
					'type'		=> 'attach_image',
					'heading'	  => esc_html__( 'Select Image', 'cosmic' ),
					'param_name'  => 'img',
					'admin_label' => true,
				),
				array(
					'type'		=> 'textfield',
					'heading'	  => esc_html__( 'Title', 'cosmic' ),
					'param_name'  => 'title',
					'admin_label' => true,
				),
				array(
					'type'		=> 'textarea',
					'heading'	  => esc_html__( 'Text', 'cosmic' ),
					'param_name'  => 'text',
					'admin_label' => true,
				),
				array(
					'type'		=> 'vc_link',
					'heading'	  => esc_html__( 'Link', 'cosmic' ),
					'param_name'  => 'href',
					'admin_label' => false,
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Align Items', 'cosmic' ),
					'param_name'  => 'align',
					'value' => array(
						'Left' => 'left',
						'Center' => 'center',
						'Right' => 'right',
					),
					'admin_label' => false,
					'std' => 'center',
					'group' => esc_html__( 'Styles', 'cosmic' ),
				),
				array(
					'type'		=> 'colorpicker',
					'heading'	  => esc_html__( 'Title Color', 'cosmic' ),
					'param_name'  => 'title_color',
					'admin_label' => false,
					'group' => esc_html__( 'Styles', 'cosmic' ),
				),
				array(
					'type'		=> 'colorpicker',
					'heading'	  => esc_html__( 'Text Color', 'cosmic' ),
					'param_name'  => 'text_color',
					'admin_label' => false,
					'group' => esc_html__( 'Styles', 'cosmic' ),
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
			'img' => '',
			'title' => '',
			'text' => '',
			'href' => '',
			'align' => '',
			'title_color' => '',
			'text_color' => '',
			'css' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
		), $atts ) );

		// Empty and default vars
		$output = $img_el = $title_el = $text_el = $attr = '';
		$tag = 'div';
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

		// Add alignment class
		if ( $align ) {
			$css_classes[] = 'align_'.$align;
		} else {
			$css_classes[] = 'align_center';
		}

		// Image element
		if ( $img ) {
			$img_url = wp_get_attachment_url( $img );
			if ( $img_url ) {
				$img_el = '<div class="image"><img src="'.esc_url( $img_url ).'"></div>';
			}
		}

		// Title element
		if ( $title ) {
			$styles = '';
			if ( $title_color ) {
				$styles = ' style="color:'.esc_attr( $title_color ).'" ';
			}
			$title_el = '<div class="title"><h5'.$styles.'>'.esc_html( $title ).'</h5></div>';
		}

		// Text element
		if ( $text ) {
			$styles = '';
			if ( $text_color ) {
				$styles = ' style="color:'.esc_attr( $text_color ).'" ';
			}
			$text_el = '<div class="text"><p'.$styles.'>'.esc_html( $text ).'</p></div>';
		}

		if ( $href ) {
			$href_array = vc_build_link( $href );
			$link_url = $link_title = $link_target = $link_rel = '';
			if ( ! empty( $href_array ) && is_array( $href_array ) ) {
				if ( array_key_exists( 'url', $href_array ) ) {
					$link_url = ' href="'.esc_url( $href_array['url'] ).'"';
				}
				if ( array_key_exists( 'title', $href_array ) ) {
					if ( $href_array['title'] ) {
						$link_title = ' alt = "'.esc_attr( $href_array['title'] ).'" ';
					}
				}
				if ( array_key_exists( 'target', $href_array ) ) {
					if ( $href_array['target'] ) {
						$link_target = ' target = "'.esc_attr( $href_array['target'] ).'" ';
					}
				}
				if ( array_key_exists( 'rel', $href_array ) ) {
					if ( $href_array['rel'] ) {
						$link_rel = ' rel = "'.esc_attr( $href_array['rel'] ).'" ';
					}
				}
			}
			$tag = 'a';
			$attr = $link_url.$link_title.$link_target.$link_rel;
		}
		
		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'">
				<'.$tag.$attr.'>
					<div class="widget-inner">
						'.$img_el.$title_el.$text_el.'
					</div>
				</'.$tag.'>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new cosmicImageWithText;
