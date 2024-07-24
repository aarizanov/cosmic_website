<?php
/**
 * The Gallery template to display posts
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
$vixus_post_format = get_post_format();
$vixus_post_format = empty( $vixus_post_format ) ? 'standard' : str_replace( 'post-format-', '', $vixus_post_format );
$vixus_animation   = vixus_get_theme_option( 'blog_animation' );
$vixus_image       = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

?><div class="
<?php
if ( ! empty( $vixus_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo 'masonry_item masonry_item-1_' . esc_attr( $vixus_columns );
}
?>
"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_format_' . esc_attr( $vixus_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $vixus_columns )
		. ' post_layout_gallery'
		. ' post_layout_gallery_' . esc_attr( $vixus_columns )
	);
	echo ( ! vixus_is_off( $vixus_animation ) && empty( $vixus_template_args['slider'] ) ? ' data-animation="' . esc_attr( vixus_get_animation_classes( $vixus_animation ) ) . '"' : '' );
	?>
	data-size="
		<?php
		if ( ! empty( $vixus_image[1] ) && ! empty( $vixus_image[2] ) ) {
			echo intval( $vixus_image[1] ) . 'x' . intval( $vixus_image[2] );}
		?>
	"
	data-src="
		<?php
		if ( ! empty( $vixus_image[0] ) ) {
			echo esc_url( $vixus_image[0] );}
		?>
	"
>
<?php

	// Sticky label
if ( is_sticky() && ! is_paged() ) {
	?>
		<span class="post_label label_sticky"></span>
		<?php
}

	// Featured image
	$vixus_image_hover = 'icon';
if ( in_array( $vixus_image_hover, array( 'icons', 'zoom' ) ) ) {
	$vixus_image_hover = 'dots';
}
$vixus_components = vixus_array_get_keys_by_value( vixus_get_theme_option( 'meta_parts' ) );
$vixus_counters   = vixus_array_get_keys_by_value( vixus_get_theme_option( 'counters' ) );
vixus_show_post_featured(
	array(
		'hover'         => $vixus_image_hover,
		'singular'      => false,
		'no_links'      => ! empty( $vixus_template_args['no_links'] ),
		'thumb_size'    => vixus_get_thumb_size( strpos( vixus_get_theme_option( 'body_style' ), 'full' ) !== false || $vixus_columns < 3 ? 'masonry-big' : 'masonry-big' ),
		'thumb_only'    => true,
		'show_no_image' => true,
		'post_info'     => '<div class="post_details">'
						. '<h2 class="post_title">'
							. ( empty( $vixus_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'
								: esc_html( get_the_title() )
								)
						. '</h2>'
						. '<div class="post_description">'
							. ( ! empty( $vixus_components )
								? vixus_show_post_meta(
									apply_filters(
										'vixus_filter_post_meta_args', array(
											'components' => $vixus_components,
											'counters' => $vixus_counters,
											'seo'      => false,
											'echo'     => false,
										), $vixus_blog_style[0], $vixus_columns
									)
								)
								: ''
								)
							. ( empty( $vixus_template_args['hide_excerpt'] )
								? '<div class="post_description_content">' . get_the_excerpt() . '</div>'
								: ''
								)
							. ( empty( $vixus_template_args['no_links'] )
								? '<a href="' . esc_url( get_permalink() ) . '" class="theme_button post_readmore"><span class="post_readmore_label">' . esc_html__( 'Learn more', 'vixus' ) . '</span></a>'
								: ''
								)
						. '</div>'
					. '</div>',
	)
);
?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
