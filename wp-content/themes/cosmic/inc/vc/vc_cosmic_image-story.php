<?php
class CosmicImageStory extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Image Story';
	public $shortcode_slug = 'cosmic_image_story';

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
			'as_child' => array( 'only' => 'cosmic_image_story_container' ),
			'class' => '',
			'category' => __( 'Cosmic Widgets', 'cosmic' ),
			'params' => array(
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Content Sizing', 'cosmic' ),
					'param_name'  => 'content_size',
					'value' => array(
						'1/2 + 1/2' => 'even',
						'1/3 + 2/3 ( small image )' => 'img_small',
						'1/3 + 2/3 ( small text )' => 'img_big',
					),
					'admin_label' => true,
					'std' => 'even',
				),
				array(
					'type'		=> 'dropdown',
					'heading'	  => esc_html__( 'Shadow on image', 'cosmic' ),
					'param_name'  => 'img_shadow',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes',
					),
					'admin_label' => true,
					'std' => 'no',
				),
				array(
					'type'		=> 'attach_image',
					'heading'	  => esc_html__( 'Image', 'cosmic' ),
					'param_name'  => 'image',
					'admin_label' => true,
				),
				array(
					'type' => 'param_group',
					'param_name' => 'story_repeater',
					'save_always' => true,
					'heading'	  => esc_html__( 'Add Stories', 'cosmic' ),
					'params' => array(
						array(
							'type'		=> 'textfield',
							'heading'	  => esc_html__( 'Title', 'cosmic' ),
							'param_name'  => 'title',
							'admin_label' => true,
						),
						array(
							'type'		=> 'textarea',
							'heading'	  => esc_html__( 'Text Content', 'cosmic' ),
							'param_name'  => 'text',
							'admin_label' => false,
						),
					),
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
			'image' => '',
			'story_repeater' => '',
			'content_size' => '',
			'img_shadow' => '',
			'css' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
		), $atts ) );

		// Empty and default vars
		$output = $story_content_items = $story_items = $image_area = $story_content_items_column = $img_class = $content_class = $shadow_class = '';
		$shortcode_id = str_replace( '.', '', uniqid( $this->shortcode_slug, true ) );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), false , $atts );
		$animation_classes = $this->getCSSAnimation( $animation );
		// Additional button id
		if ( $id ) { $shortcode_id = $id; }
		ob_start();

		$css_classes = array();

		// Create css classes
		$css_classes[] = 'widget_'.esc_attr( $this->shortcode_slug );
		$css_classes[] = $css_class;
		$css_classes[] = $animation_classes;
		$css_classes[] = $class;

		// Define sizes
		if ( ! $content_size ) {
			$content_size = 'even';
		}
		if ( 'even' === $content_size ) {
			$img_class = $content_class = 'vc_col-sm-6';
		} elseif ( 'img_small' === $content_size ) {
			$img_class = 'vc_col-sm-4';
			$content_class = 'vc_col-sm-8';
		} elseif ( 'img_big' === $content_size ) {
			$img_class = 'vc_col-sm-8';
			$content_class = 'vc_col-sm-4';
		} else {
			$img_class = $content_class = 'vc_col-sm-6';
		}
		
		// Define image shadow
		if ( ! $img_shadow ) {
			$img_shadow = 'no';
		}
		if ( 'yes' === $img_shadow ) {
			$shadow_class = 'img_shadow';
		}

		// Define image
		if ( $image ) {
			$img_array = wp_get_attachment_image_src( intval( $image ), 'large' );
			if ( is_array( $img_array ) ) {
				if ( array_key_exists( 0, $img_array ) ) {
					$image_area = '
						<div class="'.esc_attr( $img_class ).' '.esc_attr( $shadow_class ).' image_column">
							<img src="'.esc_url( $img_array[0] ).'">
						</div>';
				}
			}
		}

		// Define story elements
		if ( $story_repeater ) {
			$story_array = vc_param_group_parse_atts( $story_repeater );
			if ( isset( $story_array ) && ! empty( $story_array ) && is_array( $story_array ) ) {
				foreach ( $story_array as $story ) {
					if ( isset( $story ) && ! empty( $story ) && is_array( $story ) ) {
						$title = $text = '';
						if ( array_key_exists( 'title', $story ) ) {
							if ( $story['title'] ) {
								$title = '<div class="title"><h3>'.esc_html( $story['title'] ).'</h3></div>';
							}
						}
						if ( array_key_exists( 'text', $story ) ) {
							if ( $story['text'] ) {
								$text = '<div class="content"><p>'.wp_kses_post( $story['text'] ).'</p></div>';
							}
						}
						if ( $title || $text ) {
							$story_content_items .= '
							<div class="story-content">
								'.$title.$text.'
							</div>
							';
						}
					}
				}
			}
		}

		if ( $story_content_items ) {
			$story_content_items_column = '
				<div class="story_column '.esc_attr( $content_class ).'">'.$story_content_items.'</div>
			';
		}
		
		if ( $image_area || $story_content_items ) {
			$story_items = '
				<div class="vc_row story_item">
					'.$image_area.$story_content_items_column.'
				</div>';
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'">
				<div class="widget-inner">
					'.$story_items.'
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicImageStory;
