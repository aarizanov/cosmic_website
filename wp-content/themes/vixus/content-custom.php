<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.50
 */

$vixus_template_args = get_query_var( 'vixus_template_args' );
if ( is_array( $vixus_template_args ) ) {
	$vixus_columns    = empty( $vixus_template_args['columns'] ) ? 2 : max( 1, $vixus_template_args['columns'] );
	$vixus_blog_style = array( $vixus_template_args['type'], $vixus_columns );
} else {
	$vixus_blog_style = explode( '_', vixus_get_theme_option( 'blog_style' ) );
	$vixus_columns    = empty( $vixus_blog_style[1] ) ? 2 : max( 1, $vixus_blog_style[1] );
}
$vixus_blog_id       = vixus_get_custom_blog_id( join( '_', $vixus_blog_style ) );
$vixus_blog_style[0] = str_replace( 'blog-custom-', '', $vixus_blog_style[0] );
$vixus_expanded      = ! vixus_sidebar_present() && vixus_is_on( vixus_get_theme_option( 'expand_content' ) );
$vixus_animation     = vixus_get_theme_option( 'blog_animation' );
$vixus_components    = vixus_array_get_keys_by_value( vixus_get_theme_option( 'meta_parts' ) );
$vixus_counters      = vixus_array_get_keys_by_value( vixus_get_theme_option( 'counters' ) );

$vixus_post_format   = get_post_format();
$vixus_post_format   = empty( $vixus_post_format ) ? 'standard' : str_replace( 'post-format-', '', $vixus_post_format );

$vixus_blog_meta     = vixus_get_custom_layout_meta( $vixus_blog_id );
$vixus_custom_style  = ! empty( $vixus_blog_meta['scripts_required'] ) ? $vixus_blog_meta['scripts_required'] : 'none';

if ( ! empty( $vixus_template_args['slider'] ) || $vixus_columns > 1 || ! vixus_is_off( $vixus_custom_style ) ) {
	?><div class="
		<?php
		if ( ! empty( $vixus_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo ( vixus_is_off( $vixus_custom_style ) ? 'column' : sprintf( '%1$s_item %1$s_item', $vixus_custom_style ) ) . '-1_' . esc_attr( $vixus_columns );
		}
		?>
	">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" 
<?php
	post_class(
			'post_item post_format_' . esc_attr( $vixus_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $vixus_columns )
					. ' post_layout_' . esc_attr( $vixus_blog_style[0] )
					. ' post_layout_' . esc_attr( $vixus_blog_style[0] ) . '_' . esc_attr( $vixus_columns )
					. ( ! vixus_is_off( $vixus_custom_style )
						? ' post_layout_' . esc_attr( $vixus_custom_style )
							. ' post_layout_' . esc_attr( $vixus_custom_style ) . '_' . esc_attr( $vixus_columns )
						: ''
						)
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
	// Custom header's layout
	do_action( 'vixus_action_show_layout', $vixus_blog_id );
	?>
</article><?php
if ( ! empty( $vixus_template_args['slider'] ) || $vixus_columns > 1 || ! vixus_is_off( $vixus_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
