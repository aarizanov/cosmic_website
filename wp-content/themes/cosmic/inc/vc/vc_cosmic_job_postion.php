<?php
class JobPositions extends WPBakeryShortCode {

	public $shortcode_name = 'Job Positions Preview';
	public $shortcode_slug = 'job_positions_preview';

	function __construct() {
		// We safely integrate with VC with this hook
		add_action( 'init', array( $this, 'register_composer_fields' ) );
		// Use this when creating a shortcode output
		add_shortcode( $this->shortcode_slug, array( $this, 'render_shortcode' ) );
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
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of posts', 'cosmic' ),
					'param_name' => 'ppp',
					'admin_label' => true,
					'value' => '3',
				),
				array(
					'type'		=> 'dropdown',
					'heading'		=> esc_html__( 'Jobs per row', 'cosmic' ),
					'param_name'	=> 'div_class',
					'admin_label' => true,
					'value'	=> array(
						'2 Items'	=> 'vc_col-sm-6',
						'3 Items'	=> 'vc_col-md-4 vc_col-sm-6',
						'4 Items'	=> 'vc_col-md-3 vc_col-sm-6',
						'6 Items'	=> 'vc_col-lg-2 vc_col-md-4 vc_col-sm-6',
					),
					'std' => 'vc_col-md-4 vc_col-sm-6',
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
			'ppp' => '',
			'div_class' => '',
			'animation' => '',
			'class' => '',
			'id' => '',
			'css' => '',
		), $atts ) );

		// Empty and default vars
		$output = $items_class = $job_list_items = '';
		$items_class = 'vc_col-md-4 vc_col-sm-6';
		$shortcode_id = str_replace( '.', '', uniqid( $this->shortcode_slug, true ) );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), false , $atts );
		$animation_classes = $this->getCSSAnimation( $animation );
		// Additional element id
		if ( $id ) { $shortcode_id = $id; }

		$css_classes = array();

		// Create css classes
		$css_classes[] = 'widget_'.esc_attr( $this->shortcode_slug );
		$css_classes[] = $css_class;
		$css_classes[] = $animation_classes;
		$css_classes[] = $class;

		ob_start();

		// Posts per page
		if ( $ppp ) {
			$ppp = intval( $ppp );
		} else {
			$ppp = 6;
		}

		if ( $div_class ) {
			$items_class = $div_class;
		}

		$args = array(
			'post_type' => 'job_position',
			'post_status' => 'publish',
			'posts_per_page' => $ppp,
			'ignore_sticky_posts'=> true,
			'no_found_rows' => true,
			'fields' => 'ids',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'expiration',
					'value' => date( 'Ymd' ),
					'compare' => '>=',
					'type' => 'DATE',
				),
				array(
					'key' => 'expiration',
					'compare' => '=',
					'value' => '',
				),
			),
		);
		// The Query
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$tag_list = $meta_list_items = $meta_list = $content = '';
				$id = get_the_ID();
				$title = get_the_title( $id );
				$permalink = get_permalink( $id );
				$job_location_raw = get_post_meta( $id, 'location', true );
				$job_expires_raw = get_post_meta( $id, 'expiration', true );
                $status_add_on = '';
                $status = get_field('status', $id);
				if ($status && $status !== 'active') {
                    $status_add_on = ' (' . $status . ')';
                }
				if ( has_excerpt( $id ) ) {
					$content = get_the_excerpt( $id );
				} else {
					$content_raw = get_the_content( $id );
					$content = mb_strimwidth( wp_strip_all_tags( $content_raw ), 0, 145, '...' );
				}
				$tags_array = wp_get_post_tags( $id );
				if ( is_array( $tags_array ) && ! is_wp_error( $tags_array ) ) {
					foreach ( $tags_array as $tag_object ) {
						if ( $tag_object->name ) {
							$tag_list .= '<span>'.esc_attr( $tag_object->name ).'</span>';
						}
					}
				}
				if ( isset( $job_location_raw ) && ! empty( $job_location_raw ) ) {
					if ( is_array( $job_location_raw ) ) {
						$job_position_items = '';
						foreach ( $job_location_raw as $job ) {
							$job_position_items .= '<span><b>'.esc_html( ucfirst( $job ) ).'</b></span>, ';
						}
						if ( $job_position_items ) {
							$jobs = substr( $job_position_items, 0, -2 );
							$meta_list_items .= '<li class="location"><p>Location:</p> '.wp_kses_post( $jobs ).'</li>';
						}
					} else {
						$meta_list_items .= '<li class="location"><p>Location:</p><span><b>'.esc_html( $job_location_raw ).'</b></span></li>';
					}
				}
				if ( $job_expires_raw ) {
					$exp_date = date( 'd/m/Y', strtotime( $job_expires_raw ) );
					$meta_list_items .= '<li class="expires"><p>Deadline:</p><span><b>'.esc_html( $exp_date ).'</b></span></li>';
				}
				if ( $meta_list_items ) {
					$meta_list = '<div class="meta-list"><ul>'.$meta_list_items.'</ul></div>';
				}
				$job_list_items .= '
					<div class="'.esc_attr( $items_class ).' job_position">
						<div class="job_position-inner">
							<div class="title-area">
								<div class="data">
									<h4 class="title"><a href="'.esc_url( $permalink ).'">'.esc_html( $title ).esc_attr( $status_add_on ).'</a></h4>
									<div class="tags">'.$tag_list.'</div>
								</div>
							</div>
							<div class="content-area">
								<div class="content">
									'.wp_kses_post( $content ).'
								</div>
								<div class="meta">
									'.$meta_list.'
									<div class="link">
										<a href="'.esc_url( $permalink ).'">'.esc_html__( 'View Position', 'cosmic' ).'</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				';
			}
			wp_reset_postdata();
		} else {
			$job_list_items = '<h3 class="default">'.esc_html__( 'Sorry, there are no positions available at this time', 'cosmic' ).'</h3>';
		}

		echo '
			<div class="cosmic_widgets '.esc_attr( return_css_classes( $css_classes ) ).'" id="'.esc_attr( $shortcode_id ).'">
				<div class="widget-inner">
					<div class="vc_row vc_row-fluid vc_row-o-columns-middle vc_row-o-equal-height vc_row-o-content-middle vc_row-flex">
						'.$job_list_items.'
					</div>
				</div>
			</div>
		';

		$output = ob_get_clean();
		return $output;
	}
}
// Finally initialize code
new JobPositions;
