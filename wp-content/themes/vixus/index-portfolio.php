<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

vixus_storage_set( 'blog_archive', true );

get_header();

if ( have_posts() ) {

	vixus_blog_archive_start();

	$vixus_stickies   = is_home() ? get_option( 'sticky_posts' ) : false;
	$vixus_sticky_out = vixus_get_theme_option( 'sticky_style' ) == 'columns'
							&& is_array( $vixus_stickies ) && count( $vixus_stickies ) > 0 && get_query_var( 'paged' ) < 1;

	// Show filters
	$vixus_cat          = vixus_get_theme_option( 'parent_cat' );
	$vixus_post_type    = vixus_get_theme_option( 'post_type' );
	$vixus_taxonomy     = vixus_get_post_type_taxonomy( $vixus_post_type );
	$vixus_show_filters = vixus_get_theme_option( 'show_filters' );
	$vixus_tabs         = array();
	if ( ! vixus_is_off( $vixus_show_filters ) ) {
		$vixus_args           = array(
			'type'         => $vixus_post_type,
			'child_of'     => $vixus_cat,
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 1,
			'hierarchical' => 0,
			'taxonomy'     => $vixus_taxonomy,
			'pad_counts'   => false,
		);
		$vixus_portfolio_list = get_terms( $vixus_args );
		if ( is_array( $vixus_portfolio_list ) && count( $vixus_portfolio_list ) > 0 ) {
			$vixus_tabs[ $vixus_cat ] = esc_html__( 'All', 'vixus' );
			foreach ( $vixus_portfolio_list as $vixus_term ) {
				if ( isset( $vixus_term->term_id ) ) {
					$vixus_tabs[ $vixus_term->term_id ] = $vixus_term->name;
				}
			}
		}
	}
	if ( count( $vixus_tabs ) > 0 ) {
		$vixus_portfolio_filters_ajax   = true;
		$vixus_portfolio_filters_active = $vixus_cat;
		$vixus_portfolio_filters_id     = 'portfolio_filters';
		?>
		<div class="portfolio_filters vixus_tabs vixus_tabs_ajax">
			<ul class="portfolio_titles vixus_tabs_titles">
				<?php
				foreach ( $vixus_tabs as $vixus_id => $vixus_title ) {
					?>
					<li><a href="<?php echo esc_url( vixus_get_hash_link( sprintf( '#%s_%s_content', $vixus_portfolio_filters_id, $vixus_id ) ) ); ?>" data-tab="<?php echo esc_attr( $vixus_id ); ?>"><?php echo esc_html( $vixus_title ); ?></a></li>
					<?php
				}
				?>
			</ul>
			<?php
			$vixus_ppp = vixus_get_theme_option( 'posts_per_page' );
			if ( vixus_is_inherit( $vixus_ppp ) ) {
				$vixus_ppp = '';
			}
			foreach ( $vixus_tabs as $vixus_id => $vixus_title ) {
				$vixus_portfolio_need_content = $vixus_id == $vixus_portfolio_filters_active || ! $vixus_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr( sprintf( '%s_%s_content', $vixus_portfolio_filters_id, $vixus_id ) ); ?>"
					class="portfolio_content vixus_tabs_content"
					data-blog-template="<?php echo esc_attr( vixus_storage_get( 'blog_template' ) ); ?>"
					data-blog-style="<?php echo esc_attr( vixus_get_theme_option( 'blog_style' ) ); ?>"
					data-posts-per-page="<?php echo esc_attr( $vixus_ppp ); ?>"
					data-post-type="<?php echo esc_attr( $vixus_post_type ); ?>"
					data-taxonomy="<?php echo esc_attr( $vixus_taxonomy ); ?>"
					data-cat="<?php echo esc_attr( $vixus_id ); ?>"
					data-parent-cat="<?php echo esc_attr( $vixus_cat ); ?>"
					data-need-content="<?php echo ( false === $vixus_portfolio_need_content ? 'true' : 'false' ); ?>"
				>
					<?php
					if ( $vixus_portfolio_need_content ) {
						vixus_show_portfolio_posts(
							array(
								'cat'        => $vixus_id,
								'parent_cat' => $vixus_cat,
								'taxonomy'   => $vixus_taxonomy,
								'post_type'  => $vixus_post_type,
								'page'       => 1,
								'sticky'     => $vixus_sticky_out,
							)
						);
					}
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		vixus_show_portfolio_posts(
			array(
				'cat'        => $vixus_cat,
				'parent_cat' => $vixus_cat,
				'taxonomy'   => $vixus_taxonomy,
				'post_type'  => $vixus_post_type,
				'page'       => 1,
				'sticky'     => $vixus_sticky_out,
			)
		);
	}

	vixus_blog_archive_end();

} else {

	if ( is_search() ) {
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'content', 'none-search' ), 'none-search' );
	} else {
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'content', 'none-archive' ), 'none-archive' );
	}
}

get_footer();
