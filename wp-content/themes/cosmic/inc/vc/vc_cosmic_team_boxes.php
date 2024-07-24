<?php
class CosmicTeamQuoteBoxes extends WPBakeryShortCode {

	public $shortcode_name = 'Cosmic Team Quote Boxes';
	public $shortcode_slug = 'cosmic_team_quote_boxes';

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
					'type' => 'param_group',
					'param_name' => 'team_repeater',
					'save_always' => true,
					'heading'	  => esc_html__( 'Add team members', 'cosmic' ),
					'params' => array(
						array(
							'type'		=> 'textfield',
							'heading'	  => esc_html__( 'First and Last name', 'cosmic' ),
							'param_name'  => 'name',
							'admin_label' => true,
							'save_always' => true,
						),
						array(
							'type'		=> 'attach_image',
							'heading'	  => esc_html__( 'Profile Image', 'cosmic' ),
							'param_name'  => 'image',
							'admin_label' => false,
							'save_always' => true,
						),
						array(
							'type'		=> 'textfield',
							'heading'	  => esc_html__( 'Position', 'cosmic' ),
							'param_name'  => 'position',
							'admin_label' => true,
							'save_always' => true,
						),
						array(
							'type'		=> 'textarea',
							'heading'	  => esc_html__( 'Qoute', 'cosmic' ),
							'param_name'  => 'quote',
							'admin_label' => false,
							'save_always' => true,
						),
						array(
							'type'		=> 'textfield',
							'heading'	  => esc_html__( 'Author', 'cosmic' ),
							'param_name'  => 'author',
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
			'team_repeater' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
			'css' => '',
		), $atts ) );

		// Empty and default vars
		$output = $team_items = '';
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
		if ( $team_repeater ) {
			$team_array = vc_param_group_parse_atts( $team_repeater );
			if ( isset( $team_array ) && ! empty( $team_array ) && is_array( $team_array ) ) {
				foreach ( $team_array as $team ) {
					if ( is_array( $team ) ) {
						$keys = array( 'name', 'image', 'position', 'quote', 'author' );
						if ( array_keys_exists( $keys, $team ) ) {
							$name = $image = $position = $quote = $author = $title_area = $image_area = $quote_area = $content_area = '';
							$name = $team['name'];
							$image = $team['image'];
							$position = $team['position'];
							$quote = $team['quote'];
							$author = $team['author'];
							// Defining variables
							if ( $name || $position ) {
								$title_name = $title_position = $separator = '';
								if ( $name ) {
									$title_name = '<h5 class="name">'.esc_html( $name ).'</h5>';
								}
								if ( $position ) {
									$title_position = '<h5 class="position">'.esc_html( $position ).'</h5>';
								}
								if ( $name && $position ) {
									$separator = ', ';
								}
								$title_area = '<div class="title_area"><div class="title_area-inner">'.$title_name.$separator.$title_position.'</div></div>';
							}
							if ( $image ) {
								$img_array = wp_get_attachment_image_src( intval( $image ), 'medium' );
								if ( is_array( $img_array ) ) {
									if ( array_key_exists( 0, $img_array ) ) {
										$image_area = '
											<div class="image">
												<div class="image-inner">
													<div class="bg" style="background-image:url( '.esc_url( $img_array[0] ).' )"></div>
												</div>
											</div>';
									}
								}
							}
							if ( $quote || $author ) {
								$quote_text = $quote_author = $separator = '';
								if ( $quote ) {
									$quote_text = '<i class="quote_text">'.esc_html( $quote ).'</i>';
								}
								if ( $author ) {
									$quote_author = '<i class="quote_author">'.esc_html( $author ).'</i>';
								}
								if ( $quote && $author ) {
									$separator = ' - ';
								}
								$quote_area = '<div class="quote_area">'.$quote_text.$separator.$quote_author.'</div>';
							}
							if ( $title_area || $quote_area ) {
								$content_area = '<div class="content">'.$title_area.$quote_area.'</div>';
							}
							$team_items .= '
								<div class="team_members">
									<div class="team_members-inner">
										'.$image_area.$content_area.'
									</div>
								</div>
							';
						}
					}
				}
			}
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'" >
				<div class="widget-inner">
					'.$team_items.'
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new CosmicTeamQuoteBoxes;
