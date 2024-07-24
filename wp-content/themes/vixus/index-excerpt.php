<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

vixus_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	vixus_blog_archive_start();

	?><div class="posts_container">
		<?php

		$vixus_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
		$vixus_sticky_out = vixus_get_theme_option( 'sticky_style' ) == 'columns'
								&& is_array( $vixus_stickies ) && count( $vixus_stickies ) > 0 && get_query_var( 'paged' ) < 1;
		if ( $vixus_sticky_out ) {
			?>
			<div class="sticky_wrap columns_wrap">
			<?php
		}
		while ( have_posts() ) {
			the_post();
			if ( $vixus_sticky_out && ! is_sticky() ) {
				$vixus_sticky_out = false;
				?>
				</div>
				<?php
			}
			$vixus_part = $vixus_sticky_out && is_sticky() ? 'sticky' : 'excerpt';
			get_template_part( apply_filters( 'vixus_filter_get_template_part', 'content', $vixus_part ), $vixus_part );
		}
		if ( $vixus_sticky_out ) {
			$vixus_sticky_out = false;
			?>
			</div>
			<?php
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
