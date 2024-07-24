<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

$vixus_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$vixus_post_format = get_post_format();
$vixus_post_format = empty( $vixus_post_format ) ? 'standard' : str_replace( 'post-format-', '', $vixus_post_format );
$vixus_animation   = vixus_get_theme_option( 'blog_animation' );

?><div class="column-1_<?php echo esc_attr( $vixus_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $vixus_post_format ) ); ?>
	<?php echo ( ! vixus_is_off( $vixus_animation ) ? ' data-animation="' . esc_attr( vixus_get_animation_classes( $vixus_animation ) ) . '"' : '' ); ?>
	>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	vixus_show_post_featured(
		array(
			'thumb_size' => vixus_get_thumb_size( 1 == $vixus_columns ? 'big' : ( 2 == $vixus_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $vixus_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			vixus_show_post_meta( apply_filters( 'vixus_filter_post_meta_args', array(), 'sticky', $vixus_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php

// div.column-1_X is a inline-block and new lines and spaces after it are forbidden
