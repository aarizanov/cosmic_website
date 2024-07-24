<?php
/**
 * The template for homepage posts with "Classic" style
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

vixus_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	vixus_blog_archive_start();
	
	$vixus_classes    = 'posts_container '
						. ( substr( vixus_get_theme_option( 'blog_style' ), 0, 7 ) == 'classic'
							? 'columns_wrap columns_padding_bottom'
							: 'masonry_wrap'
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
		$vixus_part = $vixus_sticky_out && is_sticky() ? 'sticky' : 'classic';
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
