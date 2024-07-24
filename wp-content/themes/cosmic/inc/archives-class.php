<?php
class CosmicArchiveClass {

	// Nounce name used in ajax
	public $nounce_name = 'cosmic_archive_nounce';

	function __construct() {
		// Change post navigation markup
		add_filter( 'next_posts_link_attributes', array( $this, 'posts_link_attributes' ) );
		add_filter( 'previous_posts_link_attributes', array( $this, 'posts_link_attributes' ) );

		// Hook up ajax functions
		add_action( 'wp_ajax_cosmic_load_more_archive', array( $this, 'cosmic_load_more_archive' ) );
		add_action( 'wp_ajax_nopriv_cosmic_load_more_archive', array( $this, 'cosmic_load_more_archive' ) );
		add_action( 'wp_ajax_cosmic_search_archive', array( $this, 'cosmic_search_archive' ) );
		add_action( 'wp_ajax_nopriv_cosmic_search_archive', array( $this, 'cosmic_search_archive' ) );
	}

	// Get archive header image
	public function image_header() {
		if ( function_exists( 'get_field' ) ) {
			$field = array();
			if ( is_archive() ) {
				$term = get_queried_object();
				if ( $term ) {
					$field = get_field( 'cat_image', $term );
				}
			}
			if ( ! $field ) {
				$field = get_field( 'archive_header_image', 'options' );
			}
			if ( isset( $field ) && ! empty( $field ) && is_array( $field ) ) {
				if ( array_key_exists( 'url', $field ) ) {
					return $field['url'];
				}
			}
		} else {
			return null;
		}
	}

	// Get archive top stories cover image
	public function image_top_stories() {
		if ( function_exists( 'get_field' ) ) {
			$field = array();
			if ( is_archive() ) {
				$term = get_queried_object();
				if ( $term ) {
					$field = get_field( 'cover_image', $term );
				}
			}
			if ( ! $field ) {
				$field = get_field( 'archive_cover_image', 'options' );
			}
			if ( isset( $field ) && ! empty( $field ) && is_array( $field ) ) {
				if ( array_key_exists( 'url', $field ) ) {
					return $field['url'];
				}
			}
		} else {
			return null;
		}
	}

	// Check if category is active ( current ) one
	// by comparing category url's
	public function is_active_category( $current_url ) {
		$url = '';
		if ( is_category() ) {
			$term = get_queried_object();
			if ( $term ) {
				$url = get_term_link( $term );
			}
		}
		if ( $current_url === $url ) {
			return true;
		} else {
			return false;
		}
	}

	// Add button class to prev/next page navigation
	public function posts_link_attributes() {
		return 'class="button button-primary button-ghost" style="display:inline-block"';
	}

	// Add data tags used for ajax to post containers
	public function archive_data_types() {
		$queried_object = get_queried_object();
		if ( isset( $queried_object ) && ! empty( $queried_object ) && ! is_wp_error( $queried_object ) && is_object( $queried_object ) ) {
			$term_name = $term_type = $term_id = '';
			$term_name = get_class( $queried_object );
			if ( 'WP_User' === $term_name ) {
				$term_id = $queried_object->ID;
			} else {
				$term_type = $queried_object->taxonomy;
				$term_id = $queried_object->term_id;
			}
			$p_type = get_post_type();
			echo ' data-name="'.esc_attr( $term_name ).'" data-type="'.esc_attr( $term_type ).'" data-id="'.esc_attr( $term_id ).'" data-ptype="'.esc_attr( $p_type ).'"';
		}
	}

	// Create ajax nounce for later usage
	public function create_nounce() {
		$nounce = wp_create_nonce( $this->nounce_name );
		return $nounce;
	}

	// Archives load more ajax
	public function cosmic_load_more_archive() {

		// Check nounce
		check_ajax_referer( $this->nounce_name, 'security' );

		$output = $cur_page = $archive_name = $archive_type = $archive_id = $list_items = '';
		$post_type = 'post';
		$post_counter = 0;
		$status = 'ok';

		if ( isset( $_POST['ptype'] ) && ! empty( $_POST['ptype'] ) ) {
			$post_type = sanitize_text_field( wp_unslash( $_POST['ptype'] ) );
		}
		if ( isset( $_POST['cur_page'] ) && ! empty( $_POST['cur_page'] ) ) {
			$cur_page = (int) sanitize_text_field( wp_unslash( $_POST['cur_page'] ) );
		}
		if ( isset( $_POST['archive_name'] ) && ! empty( $_POST['archive_name'] ) ) {
			$archive_name = sanitize_text_field( wp_unslash( $_POST['archive_name'] ) );
		}
		if ( isset( $_POST['archive_type'] ) && ! empty( $_POST['archive_type'] ) ) {
			$archive_type = sanitize_text_field( wp_unslash( $_POST['archive_type'] ) );
		}
		if ( isset( $_POST['archive_id'] ) && ! empty( $_POST['archive_id'] ) ) {
			$archive_id = (int) sanitize_text_field( wp_unslash( $_POST['archive_id'] ) );
		}

		$ppp = (int) get_option( 'posts_per_page' );

		// WP Query
		$args = array(
			'post_type' => $post_type,
			'posts_per_page' => $ppp,
			'post_status' => 'publish',
			'paged' => $cur_page,
		);

		// Add author, category, tag
		// or custom taxonomy to query args
		if ( $archive_name ) {
			if ( 'WP_User' === $archive_name ) {
				if ( $archive_id ) {
					$args['author'] = $archive_id;
				}
			} else {
				if ( $archive_type && $archive_id ) {
					if ( 'category' === $archive_type ) {
						$args['cat'] = $archive_id;
					} elseif ( 'tag' === $archive_type ) {
						$args['tag_id'] = $archive_id;
					} else {
						$args['tax_query'] = array(
							'taxonomy' => $archive_type,
							'field' => 'term_id',
							'terms' => array( $archive_id ),
						);
					}
				}
			}
		}

		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				// Post counter
				$post_counter++;
				// Post vars
				$id = get_the_ID();
				ob_start(); ?>
				<div class="vc_col-lg-3 vc_col-md-4 vc_col-sm-6 box_wrap">
					<?php get_template_part( 'template-parts/box/content', get_post_type() ); ?>
				</div>
				<?php $list_items .= ob_get_clean();
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			$list_items = '';
			$status = 'empty';
		}

		if ( $post_counter < $ppp ) {
			$status = 'stop';
		}

		$response = array(
			'status' => $status,
			'data' => $list_items,
		);

		$output = wp_json_encode( $response );
		// Return output
		wp_die( $output );
	}

	// Archives load more ajax
	public function cosmic_search_archive() {

		// Check nounce
		check_ajax_referer( $this->nounce_name, 'security' );

		$output = $search_term = $list_items = '';
		$status = 'ok';

		if ( isset( $_POST['search_term'] ) && ! empty( $_POST['search_term'] ) ) {
			$search_term = sanitize_text_field( wp_unslash( $_POST['search_term'] ) );
		}

		// WP Query
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => '30',
			'post_status' => 'publish',
			's' => $search_term,
		);

		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				// Post vars
				$id = get_the_ID();
				$url = get_permalink( $id );
				$title = get_the_title( $id );
				$date = get_the_date( '', $id );
				$featured_url = get_the_post_thumbnail_url( $id, 'thumbnail' );
				if ( ! $featured_url ) {
					$featured_url = get_template_directory_uri().'/img/default_post_box.jpg';
				}
				$list_items .= '
				<li class="result post">
					<a href="'.esc_url( $url ).'">
						<div class="img">
							<div class="bg" style="background-image:url( '.esc_url( $featured_url ).' )"></div>
						</div>
						<div class="content">
							<h4>'.esc_html( $title ).'</h4>
							<span>'.esc_html( $date ).'</span>
						</div>
					</a>
				</li>
				';
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		} else {
			$list_items = '
				<li class="result error">
					<a>No results found</a>
				</li>
			';
			$status = 'empty';
		}

		$response = array(
			'status' => $status,
			'data' => $list_items,
		);

		$output = wp_json_encode( $response );
		// Return output
		wp_die( $output );
	}
}
// Run new instance of our class to kick off the whole thing
new CosmicArchiveClass;
