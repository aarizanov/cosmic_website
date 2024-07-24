<?php
/**
 * The template for homepage posts with custom style
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.50
 */

vixus_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	$vixus_blog_style = vixus_get_theme_option( 'blog_style' );
	$vixus_parts      = explode( '_', $vixus_blog_style );
	$vixus_columns    = ! empty( $vixus_parts[1] ) ? max( 1, min( 6, (int) $vixus_parts[1] ) ) : 1;
	$vixus_blog_id    = vixus_get_custom_blog_id( $vixus_blog_style );
	$vixus_blog_meta  = vixus_get_custom_layout_meta( $vixus_blog_id );
	if ( ! empty( $vixus_blog_meta['margin'] ) ) {
		vixus_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( vixus_prepare_css_value( $vixus_blog_meta['margin'] ) ) ) );
	}
	$vixus_custom_style = ! empty( $vixus_blog_meta['scripts_required'] ) ? $vixus_blog_meta['scripts_required'] : 'none';

	vixus_blog_archive_start();

	$vixus_classes    = 'posts_container blog_custom_wrap' 
							. ( ! vixus_is_off( $vixus_custom_style )
								? sprintf( ' %s_wrap', $vixus_custom_style )
								: ( $vixus_columns > 1 
									? ' columns_wrap columns_padding_bottom' 
									: ''
									)
								);
	$vixus_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$vixus_sticky_out = vixus_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $vixus_stickies ) && count( $vixus_stickies ) > 0 && get_query_var( 'paged' ) < 1;
	if ( $vixus_sticky_out ) {
		?>
		<div class="sticky_wrap columns_wrap">
		<?php
	}
	if ( ! $vixus_sticky_out ) {
		if ( vixus_get_theme_option( 'first_post_large' ) && ! is_paged() && ! in_array( vixus_get_theme_option( 'body_style' ), array( 'fullwide', 'fullscreen' ) ) ) {
			the_post();
			get_template_part( apply_filters( 'vixus_filter_get_template_part', 'content', 'excerpt' ), 'excerpt' );
		}
		?>
		<div class="<?php echo esc_attr( $vixus_classes ); ?>">
		<?php
	}
	while ( have_posts() ) {
		the_post();
		if ( $vixus_sticky_out && ! is_sticky() ) {
			$vixus_sticky_out = false;
			?>
			</div><div class="<?php echo esc_attr( $vixus_classes ); ?>">
			<?php
		}
		$vixus_part = $vixus_sticky_out && is_sticky() ? 'sticky' : 'custom';
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'content', $vixus_part ), $vixus_part );
	}
	?>
	</div>
	<?php

	vixus_show_pagination();

	vixus_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
