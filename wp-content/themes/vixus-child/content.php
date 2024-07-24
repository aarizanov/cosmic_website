<?php
/**
 * The default template to display the content of the single post, page or attachment
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

$vixus_seo = vixus_is_on( vixus_get_theme_option( 'seo_snippets' ) );
$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
?>
<article id="post-<?php the_ID(); ?>" 
	<?php
	post_class('post_item_single post_type_' . esc_attr( get_post_type() ) 
		. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
	);
	if ( $vixus_seo ) {
		?>
		itemscope="itemscope" 
		itemprop="articleBody" 
		itemtype="//schema.org/<?php echo esc_attr( vixus_get_markup_schema() ); ?>" 
		itemid="<?php echo esc_url( get_the_permalink() ); ?>"
		content="<?php the_title_attribute(); ?>"
		<?php
	}
	?>
>
<?php

	do_action( 'vixus_action_before_post_data' );

	// Structured data snippets
	if ( $vixus_seo ) {
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/seo' ) );
	}

	if ( is_singular( 'post' ) || is_singular( 'attachment' ) ) {
		$vixus_post_thumbnail_type  = vixus_get_theme_option( 'post_thumbnail_type' );
		$vixus_post_header_position = vixus_get_theme_option( 'post_header_position' );
		$vixus_post_header_align    = vixus_get_theme_option( 'post_header_align' );

		if ( 'default' === $vixus_post_thumbnail_type ) {
			?>
			<div class="header_content_wrap header_align_<?php echo esc_attr( $vixus_post_header_align ); ?>">
				<?php
				// Post title and meta
				if ( 'above' === $vixus_post_header_position ) {
					vixus_show_post_title_and_meta();
				}

				// Featured image
				vixus_show_post_featured_image();

				// Post title and meta
				if ( 'above' !== $vixus_post_header_position ) {
					vixus_show_post_title_and_meta();
				}
				?>
			</div>
			<?php
		} elseif ( 'default' === $vixus_post_header_position ) {
			// Post title and meta
			vixus_show_post_title_and_meta();
		}
	}


	if( is_singular( 'job_position' ) ){
		
		$id = get_the_ID();
        $title = get_the_title( $id );
        $status = get_field('status', $id);
        if ($status && $status !== 'active') {
           $title .= ' (' . $status . ')';
        }
		$header_url = $job_location = $job_expires = '';
		$job_location_raw = get_post_meta( $id, 'location', true );
		$job_expires_raw = get_post_meta( $id, 'expiration', true );
		if ( $job_location_raw ) {
			if ( is_array( $job_location_raw ) ) {
				$job_list_items = $separator = '';
				foreach ( $job_location_raw as $job ) {
					$job_list_items .= '<b class="location">'.esc_html( ucfirst( $job ) ).'</b>, ';
				}
				if ( $job_list_items ) {
					$jobs = substr( $job_list_items, 0, -2 );
					$job_location = '<li><i>Job Location</i>: '.wp_kses_post( $jobs ).'<br></li>';
				}
			} else {
				if ( isset( $job_location_raw ) && ! empty( $job_location_raw ) ) {
					$job_location = '<li><i>Job Location</i>: <b class="location">'.esc_html( ucfirst( $job_location_raw ) ).'</b><br></li>';
				}
			}
		}
		if ( $job_expires_raw ) {
			$cur_date = date( 'Ymd' );
			$job_date = date( 'd/m/Y', strtotime( $job_expires_raw ) );
			if ( $cur_date > $job_expires_raw ) {
				$job_date = '<span style="color:#f62954">Expired</span>';
			}
			$job_expires = '<li><i>Deadline</i>: <b class="expires">'.wp_kses_post( $job_date ).'</b></li>';
		}
		if ( $job_location || $job_expires ) {
			$description = '
				<div class="description">
					<ul>'.$job_location.$job_expires.'</ul>
				</div>
			';
		}


		?>
		<div class="header_content_wrap header_align_<?php echo esc_attr( $vixus_post_header_align ); ?>">
			<div class="page-header-inner">
				<h1 class="title big">
					<?php echo $title; ?>
				</h1>
				<?php echo $description; ?>	
			</div>
		</div>
		<?php
	}


	do_action( 'vixus_action_before_post_content' );

	// Post content
	?>
	<div class="post_content post_content_single entry-content" itemprop="mainEntityOfPage">
		<?php
		the_content();


		if( get_field( "book_free_consultation" ) ) {
		    echo '<a class="elementor-button elementor-button-link elementor-size-sm" href="/contact">
						<span class="elementor-button-content-wrapper">
							<span class="elementor-button-text">Book Free Consultation</span>
						</span>
					</a>';
		}

		if( get_field( "join_our_team" ) ) {
		    echo '<a class="elementor-button elementor-button-link elementor-size-sm" href="/open-job-positions">
						<span class="elementor-button-content-wrapper">
							<span class="elementor-button-text">Join Our Team</span>
						</span>
					</a>';
		}


		do_action( 'vixus_action_before_post_pagination' );

		wp_link_pages(
			array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'vixus' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'vixus' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			)
		);




		// Taxonomies and share
		if ( is_single() && ! is_attachment() ) {

			do_action( 'vixus_action_before_post_meta' );

			// Post rating
			do_action(
				'trx_addons_action_post_rating', array(
					'class'                => 'single_post_rating',
					'rating_text_template' => esc_html__( 'Post rating: {{X}} from {{Y}} (according {{V}})', 'vixus' ),
				)
			);

			?>
			<div class="post_meta post_meta_single">
				<?php

				// Post taxonomies
				the_tags( '<span class="post_meta_item post_tags"><span class="post_meta_label">' . esc_html__( 'Tags:', 'vixus' ) . '</span> ', ' ', '</span>' );

				if( is_singular('job_position') ){
					echo do_shortcode('[contact-form-7 id="1113" title="APPLY"]');
				}


				// Share
				if ( vixus_is_on( vixus_get_theme_option( 'show_share_links' ) ) ) {
					vixus_show_share_links(
						array(
							'type'    => 'block',
							'caption' => 'Like it? Share it!',
							'before'  => '<span class="post_meta_item post_share">',
							'after'   => '</span>',
						)
					);
				}
				?>
			</div>
			<?php

			do_action( 'vixus_action_after_post_meta' );
		}


		?>
	</div><!-- .entry-content -->


	<?php
	do_action( 'vixus_action_after_post_content' );

	// Author bio
	if ( vixus_get_theme_option( 'show_author_info' ) == 1 && is_single() && ! is_attachment() && get_the_author_meta( 'description' ) ) {
		do_action( 'vixus_action_before_post_author' );
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/author-bio' ) );
		do_action( 'vixus_action_after_post_author' );
	}

	do_action( 'vixus_action_after_post_data' );
	?>
	<?php if (is_array($meta) && isset($meta['subscribe_form'])){echo do_shortcode(  esc_html($meta["subscribe_form"])  ); }	 ?>
	<?php /*
		if( is_singular('job_position') ){
			echo do_shortcode('[mc4wp_form id=742]');
		}	 */
	?>
</article>
