<?php
class CosmicTestemonialsCarousel extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Testemonials Carousel';
	public $shortcode_slug = 'cosmic_testemonials_carousel';

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
		wp_enqueue_script( $this->shortcode_slug, get_template_directory_uri().'/js/dist/vc_cosmic_testemonials_carousel.min.js', array( 'jquery' ), '1.0.0', true );
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
					'type'		=> 'checkbox',
					'heading'	  => esc_html__( 'Navigation', 'cosmic' ),
					'param_name'  => 'slider_nav',
					'value' => array(
						'Arrows' => 'arrow',
						'Dots' => 'dots',
					),
					'admin_label' => false,
					'std' => 'arrows',
				),
				array(
					'type'		=> 'colorpicker',
					'heading'	  => esc_html__( 'Navigation Color', 'cosmic' ),
					'param_name'  => 'nav_color',
					'admin_label' => false,
				),
				array(
					'type' => 'param_group',
					'param_name' => 'slider_repeater',
					'save_always' => true,
					'heading'	  => esc_html__( 'Add slider items', 'cosmic' ),
					'params' => array(
						array(
							'type'		=> 'textarea',
							'heading'	  => esc_html__( 'Text', 'cosmic' ),
							'param_name'  => 'text',
							'admin_label' => false,
							'save_always' => true,
						),
						array(
							'type'		=> 'textfield',
							'heading'	  => esc_html__( 'First and Last name', 'cosmic' ),
							'param_name'  => 'p_name',
							'admin_label' => true,
							'save_always' => true,
						),
						array(
							'type'		=> 'textfield',
							'heading'	  => esc_html__( 'Job Title', 'cosmic' ),
							'param_name'  => 'p_title',
							'admin_label' => true,
							'save_always' => true,
						),
						array(
							'type'		=> 'attach_image',
							'heading'	  => esc_html__( 'Person Image', 'cosmic' ),
							'param_name'  => 'p_img',
							'admin_label' => false,
							'save_always' => true,
						),
						array(
							'type'		=> 'attach_image',
							'heading'	  => esc_html__( 'Company Image', 'cosmic' ),
							'param_name'  => 'c_img',
							'admin_label' => false,
							'save_always' => true,
						),
						array(
							'type'		=> 'vc_link',
							'heading'	  => esc_html__( 'Link', 'cosmic' ),
							'param_name'  => 'link',
							'admin_label' => false,
							'save_always' => true,
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
			'slider_nav' => '',
			'nav_color' => '',
			'slider_repeater' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
			'css' => '',
		), $atts ) );

		// Empty and default vars
		$output = $list_items = $color = '';
		$dots = $arrows = 'false';
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

		// Additional element id
		if ( $id ) {
			$shortcode_id = $id;
		}

		// Defining vars
		if ( $slider_nav ) {
			if ( strpos( $slider_nav, 'arrow' ) !== false ) {
				$arrows = 'true';
			}
			if ( strpos( $slider_nav, 'dots' ) !== false ) {
				$dots = 'true';
			}
		}

		if ( $nav_color ) {
			$color = ' style="color:'.esc_attr( $nav_color ).';border-color:'.esc_attr( $nav_color ).'"';
		}

		if ( $slider_repeater ) {
			$slider_array = vc_param_group_parse_atts( $slider_repeater );
			if ( $slider_array ) {
				foreach ( $slider_array as $slide ) {
					$text = $attr = $p_name = $p_title = $p_image = $c_img = $person = '';
					$tag = 'div';
					$link_target = '_self';
					$keys = array( 'text', 'p_name', 'p_title', 'p_img', 'c_img', 'link' );
					if ( array_keys_exists( $keys, $slide ) ) {
						$text_raw = $slide['text'];
						$p_name_raw = $slide['p_name'];
						$p_title_raw = $slide['p_title'];
						$p_image_raw = $slide['p_img'];
						$c_img_raw = $slide['c_img'];
						$link_raw = $slide['link'];
						if ( $link_raw ) {
							$link_array = vc_build_link( $link_raw );
							$link_url = $link_title = $link_target = $link_rel = '';
							if ( ! empty( $link_array ) && is_array( $link_array ) ) {
								if ( array_key_exists( 'url', $link_array ) ) {
									$link_url = ' href="'.esc_url( $link_array['url'] ).'"';
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
							}
							$tag = 'a';
							$attr = $link_url.$link_title.$link_target.$link_rel;
						}
						// Main text
						if ( $text_raw ) {
							$text = '<div class="content"><p>'.esc_html( $text_raw ).'</p></div>';
						}
						// Build person element
						if ( $p_name_raw ) {
							$p_name = '<h5>'.esc_html( $p_name_raw ).'</h5>';
						}
						if ( $p_title_raw ) {
							$p_title = '<span>'.esc_html( $p_title_raw ).'</span>';
						}
						if ( $p_name || $p_title ) {
							$person = '<div class="name">'.$p_name.$p_title.'</div>';
						}
						if ( $p_image_raw ) {
							$img_array = wp_get_attachment_image_src( $p_image_raw, 'medium' );
							if ( $img_array ) {
								$img_url = $img_array[0];
								$p_image = '<'.$tag.$attr.' class="person_image"><div class="img" style="background-image:url( '.esc_url( $img_url ).' )"></div></'.$tag.'>';
							}
						}
						if ( $c_img_raw ) {
							$img_array = wp_get_attachment_image_src( $c_img_raw, 'medium' );
							if ( $img_array ) {
								$img_url = $img_array[0];
								$c_img = '<'.$tag.$attr.' class="company_logo"><img src="'.esc_url( $img_url ).'"></'.$tag.'>';
							}
						}
						$list_items .= '
							<div class="slider_item">
								<div class="slider_item-inner">
									'.$text.'
									<div class="devider"><div class="img" style="background-image:url( '.esc_url( get_stylesheet_directory_uri().'/img/testemonials_line.png' ).' )"></div></div>
									'.$person.$p_image.$c_img.'
								</div>
							</div>';
					}
				}
			}
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'" 
				data-dots = "'.esc_attr( $dots ).'" 
				data-arrows = "'.esc_attr( $arrows ).'" 
			>
				<div class="widget-inner">
					<div class="cosmic_slider" '.$color.'>
						'.$list_items.'
					</div>
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicTestemonialsCarousel;
