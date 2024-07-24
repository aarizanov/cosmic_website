<?php
class CosmicPostsCarousel extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Posts Carousel';
	public $shortcode_slug = 'cosmic_posts_carousel';

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
		wp_enqueue_script( $this->shortcode_slug, get_template_directory_uri().'/js/dist/vc_cosmic_posts_carousel.min.js', array( 'jquery' ), '1.0.0', true );
	}

	// Get all category items
	public function cat_list_autocomplete( $cat = '' ) {
		$result = array();
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC',
		) );
		foreach ( $categories as $category ) {
			$category_name = $category->name;
			$category_id = $category->term_id;
			$result[] = array(
				'value' => $category_id,
				'label' => $category_name,
			);
		}
		return $result;
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
					'type'		=> 'dropdown',
					'heading'		=> esc_html__( 'Number of posts', 'cosmic' ),
					'param_name'	=> 'slider_ppp',
					'admin_label' => true,
					'value'	=> array(
						'4'	=> '4',
						'8'	=> '8',
						'12'	=> '12',
						esc_html__( 'All', 'cosmic' )	=> '-1',
					),
				),
				array(
					'type'		=> 'dropdown',
					'heading'		=> esc_html__( 'Number of slides', 'cosmic' ),
					'param_name'	=> 'slider_num',
					'admin_label' => true,
					'value'	=> array(
						'3'	=> '3',
						'4'	=> '4',
						'5'	=> '5',
						'6'	=> '6',
					),
				),
				array(
					'type'		=> 'dropdown',
					'heading'		=> esc_html__( 'Autoplay:', 'cosmic' ),
					'param_name'	=> 'slider_autoplay',
					'admin_label' => true,
					'value'	=> array(
						'No'	=> 'false',
						'Yes'	=> 'true',
					),
				),
				array(
					'type'		=> 'autocomplete',
					'heading'		=> esc_html__( 'Category', 'cosmic' ),
					'param_name'	=> 'slider_cat',
					'admin_label' => false,
					'settings'    => array(
						'multiple'      => true,
						'sortable'      => true,
						'unique_values' => true,
						'values' => $this->cat_list_autocomplete(),
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
			'slider_ppp' => '',
			'slider_num' => '',
			'slider_autoplay' => '',
			'slider_cat' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
			'css' => '',
		), $atts ) );

		// Empty and default vars
		$output = $list_items = $color = $slider_items = '';
		$dots = $arrows = $autoplay = 'false';
		$ppp = 4;
		$no_slides = 3;
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

		// Slider navigation
		if ( $nav_color ) {
			$color = ' style="color:'.esc_attr( $nav_color ).';border-color:'.esc_attr( $nav_color ).'"';
		}

		// Slider posts per page
		if ( $slider_ppp ) {
			$ppp = (int) $slider_ppp;
		}

		// Number of slides
		if ( $slider_num ) {
			$no_slides = (int) $slider_num;
		}

		// Slider autoplay
		if ( $slider_autoplay ) {
			$autoplay = $slider_autoplay;
		}

		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $ppp,
		);

		// Add categories to $args
		if ( $slider_cat ) {
			$cats = explode( ', ', $slider_cat );
			$args['category__in'] = $cats;
		}

		// The Query
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				ob_start();
				echo '
				<div class="slider_item">
					<div class="slider_item-inner">';
				get_template_part( 'template-parts/box/content', get_post_type() );
				echo '
					</div>
				</div>';
				$slider_items .= ob_get_clean();
			}
			wp_reset_postdata();
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'" 
				data-dots = "'.esc_attr( $dots ).'" 
				data-arrows = "'.esc_attr( $arrows ).'" 
				data-num = "'.esc_attr( $no_slides ).'" 
				data-autoplay = "'.esc_attr( $autoplay ).'" 
			>
				<div class="widget-inner">
					<div class="cosmic_slider" '.$color.'>
						'.$slider_items.'
					</div>
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicPostsCarousel;
