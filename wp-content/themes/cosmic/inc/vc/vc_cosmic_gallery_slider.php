<?php
class CosmicGallerySlider extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Gallery Slider';
	public $shortcode_slug = 'cosmic_gallery_slider';

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
		// Plugin css and js
		wp_enqueue_script( 'slick', get_template_directory_uri().'/vendor/slick/slick.min.js', array( 'jquery' ), '1.8.1', true );
		wp_enqueue_style( 'slick', get_template_directory_uri().'/vendor/slick/slick.css', null, '1.8.1' );
		wp_enqueue_style( 'slick-theme', get_template_directory_uri().'/vendor/slick/slick-theme.css', null, '1.8.1' );
		wp_enqueue_script( 'fancybox' );
		wp_enqueue_style( 'fancybox' );
		wp_enqueue_script( $this->shortcode_slug, get_template_directory_uri().'/js/dist/vc_cosmic_gallery_slider.min.js', array( 'jquery' ), '1.0.0', true );
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
					'type'		=> 'attach_images',
					'heading'	  => esc_html__( 'Select images', 'cosmic' ),
					'param_name'  => 'images',
					'admin_label' => true,
				),
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
						'3 slides' => '3',
						'5 slides' => '5',
						'7 slides' => '7',
					),
					'admin_label' => false,
					'std' => '5',
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
			'images' => '',
			'slider_nav' => '',
			'nav_color' => '',
			'slider_center' => '',
			'slides_to_show' => '',
			'slider_autoplay' => '',
			'css' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
		), $atts ) );

		// Empty and default vars
		$output = $image_list_items = $color = $center_class = '';
		$arrow = $dots = $center = $autoplay = 'false';
		$slides_num = 5;
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

		if ( $images ) {
			$img_array = explode( ',' , $images );
			if ( ! empty( $img_array ) && is_array( $img_array ) ) {
				foreach ( $img_array as $img_id ) {
					if ( $img_id ) {
						$img_url_large = $img_url_full = '';
						$image_array_large = wp_get_attachment_image_src( intval( $img_id ), 'medium-large' );
						if ( isset( $image_array_large ) && ! empty( $image_array_large ) && is_array( $image_array_large ) ) {
							if ( array_key_exists( 0, $image_array_large ) ) {
								$img_url_large = $image_array_large[0];
							}
						}
						$image_array_full = wp_get_attachment_image_src( intval( $img_id ), 'full' );
						if ( isset( $image_array_full ) && ! empty( $image_array_full ) && is_array( $image_array_full ) ) {
							if ( array_key_exists( 0, $image_array_full ) ) {
								$img_url_full = $image_array_full[0];
							}
						}
					}
					$image_list_items .= '
						<div class="gallery_slide">
							<a class="bg" data-fancybox="gallery" href="'.esc_url( $img_url_full ).'" style="background-image:url( '.esc_url( $img_url_large ).' )"></a>
						</div>';
				}
			}
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
					<div class="hidden">
						<div class="text-center fa fa-spinner fa-spin"></div>
					</div>
					<div class="cosmic_slider" '.$color.'>
						'.$image_list_items.'
					</div>
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicGallerySlider;
