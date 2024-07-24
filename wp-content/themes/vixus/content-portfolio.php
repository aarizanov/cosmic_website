<?php
/**
 * The Portfolio template to display the content
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
		. ( is_sticky() && ! is_paged() ? ' sticky' : '' )
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

	$vixus_image_hover = ! empty( $vixus_template_args['hover'] ) && ! vixus_is_inherit( $vixus_template_args['hover'] )
								? $vixus_template_args['hover']
								: vixus_get_theme_option( 'image_hover' );
	// Featured image
	vixus_show_post_featured(
		array(
			'singular'      => false,
			'hover'         => $vixus_image_hover,
			'no_links'      => ! empty( $vixus_template_args['no_links'] ),
			'thumb_size'    => vixus_get_thumb_size(
				strpos( vixus_get_theme_option( 'body_style' ), 'full' ) !== false || $vixus_columns < 3
								? 'masonry-big'
				: 'masonry-big'
			),
			'show_no_image' => true,
			'class'         => 'icon' == $vixus_image_hover ? 'hover_with_info' : '',
			'post_info'     => 'icon' == $vixus_image_hover ? '<div class="post_info">' . esc_html( get_the_title() ) . '</div>' : '',
		)
	);
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!