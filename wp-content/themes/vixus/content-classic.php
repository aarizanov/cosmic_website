<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

$vixus_template_args = get_query_var( 'vixus_template_args' );
if ( is_array( $vixus_template_args ) ) {
	$vixus_columns    = empty( $vixus_template_args['columns'] ) ? 2 : max( 1, $vixus_template_args['columns'] );
	$vixus_blog_style = array( $vixus_template_args['type'], $vixus_columns );
} else {
	$vixus_blog_style = explode( '_', vixus_get_theme_option( 'blog_style' ) );
	$vixus_columns    = empty( $vixus_blog_style[1] ) ? 2 : max( 1, $vixus_blog_style[1] );
}
$vixus_expanded   = ! vixus_sidebar_present() && vixus_is_on( vixus_get_theme_option( 'expand_content' ) );
$vixus_animation  = vixus_get_theme_option( 'blog_animation' );
$vixus_components = vixus_array_get_keys_by_value( vixus_get_theme_option( 'meta_parts' ) );
$vixus_counters   = vixus_array_get_keys_by_value( vixus_get_theme_option( 'counters' ) );

$vixus_post_format = get_post_format();
$vixus_post_format = empty( $vixus_post_format ) ? 'standard' : str_replace( 'post-format-', '', $vixus_post_format );

?><div class="
<?php
if ( ! empty( $vixus_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( 'classic' == $vixus_blog_style[0] ? 'column' : 'masonry_item masonry_item' ) . '-1_' . esc_attr( $vixus_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
		post_class(
			'post_item post_format_' . esc_attr( $vixus_post_format )
					. ' post_layout_classic post_layout_classic_' . esc_attr( $vixus_columns )
					. ' post_layout_' . esc_attr( $vixus_blog_style[0] )
					. ' post_layout_' . esc_attr( $vixus_blog_style[0] ) . '_' . esc_attr( $vixus_columns )
		);
		echo ( ! vixus_is_off( $vixus_animation ) && empty( $vixus_template_args['slider'] ) ? ' data-animation="' . esc_attr( vixus_get_animation_classes( $vixus_animation ) ) . '"' : '' );
		?>
	>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$vixus_hover = ! empty( $vixus_template_args['hover'] ) && ! vixus_is_inherit( $vixus_template_args['hover'] )
						? $vixus_template_args['hover']
						: vixus_get_theme_option( 'image_hover' );
	vixus_show_post_featured(
		array(
			'thumb_size' => vixus_get_thumb_size(
				'classic' == $vixus_blog_style[0]
						? ( strpos( vixus_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $vixus_columns > 2 ? 'big' : 'huge' )
								: ( $vixus_columns > 2
									? ( $vixus_expanded ? 'med' : 'small' )
									: ( $vixus_expanded ? 'big' : 'med' )
									)
							)
						: ( strpos( vixus_get_theme_option( 'body_style' ), 'full' ) !== false
								? ( $vixus_columns > 2 ? 'masonry-big' : 'full' )
								: ( $vixus_columns <= 2 && $vixus_expanded ? 'masonry-big' : 'masonry' )
							)
			),
			'hover'      => $vixus_hover,
			'no_links'   => ! empty( $vixus_template_args['no_links'] ),
			'singular'   => false,
		)
	);

	if ( ! in_array( $vixus_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			do_action( 'vixus_action_before_post_title' );

			// Post title
			if ( empty( $vixus_template_args['no_links'] ) ) {
				the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );
			} else {
				the_title( '<h4 class="post_title entry-title">', '</h4>' );
			}

			do_action( 'vixus_action_before_post_meta' );

			// Post meta
			if ( ! empty( $vixus_components ) && ! in_array( $vixus_hover, array( 'border', 'pull', 'slide', 'fade' ) ) ) {
				vixus_show_post_meta(
					apply_filters(
						'vixus_filter_post_meta_args', array(
							'components' => $vixus_components,
							'counters'   => $vixus_counters,
							'seo'        => false,
						), $vixus_blog_style[0], $vixus_columns
					)
				);
			}

			do_action( 'vixus_action_after_post_meta' );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>

	<div class="post_content entry-content">
	<?php
	if ( empty( $vixus_template_args['hide_excerpt'] ) ) {
		?>
			<div class="post_content_inner">
			<?php
			if ( has_excerpt() ) {
				the_excerpt();
			} elseif ( strpos( get_the_content( '!--more' ), '!--more' ) !== false ) {
				the_content( '' );
			} elseif ( in_array( $vixus_post_format, array( 'link', 'aside', 'status' ) ) ) {
				the_content();
			} elseif ( 'quote' == $vixus_post_format ) {
				$quote = vixus_get_tag( get_the_content(), '<blockquote>', '</blockquote>' );
				if ( ! empty( $quote ) ) {
					vixus_show_layout( wpautop( $quote ) );
				} else {
					the_excerpt();
				}
			} elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' ) {
				the_excerpt();
			}
			?>
			</div>
			<?php
	}
		// Post meta
	if ( in_array( $vixus_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		if ( ! empty( $vixus_components ) ) {
			vixus_show_post_meta(
				apply_filters(
					'vixus_filter_post_meta_args', array(
						'components' => $vixus_components,
						'counters'   => $vixus_counters,
					), $vixus_blog_style[0], $vixus_columns
				)
			);
		}
	}
		// More button
	if ( false && empty( $vixus_template_args['no_links'] ) && ! in_array( $vixus_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
			<p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'vixus' ); ?></a></p>
			<?php
	}
	?>
	</div><!-- .entry-content -->

</article></div><?php
// Need opening PHP-tag above, because <div> is a inline-block element (used as column)!
