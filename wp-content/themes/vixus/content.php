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

	do_action( 'vixus_action_before_post_content' );

	// Post content
	?>
	<div class="post_content post_content_single entry-content" itemprop="mainEntityOfPage">
		<?php
		the_content();

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
</article>
