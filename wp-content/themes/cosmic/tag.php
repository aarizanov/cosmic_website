<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cosmic
 */
$archive_class = new CosmicArchiveClass;
$header_url = $archive_class->image_header();
if ( $header_url ) {
	$header_img = '<div class="img" style="background-image:url( '.esc_url( $header_url ).' )"></div>';
}
// Enqueue ajax script
wp_enqueue_script( 'cosmic_archive_scripts', get_template_directory_uri().'/js/dist/cosmic_archive_scripts.min.js', array( 'jquery' ), '1.0.0' );
wp_localize_script( 'cosmic_archive_scripts', 'cosmic_values', array(
	'ajaxurl' => esc_url( admin_url( 'admin-ajax.php' ) ),
	'spinner' => esc_url( get_template_directory_uri().'/img/spinner.gif' ),
));
get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php get_template_part( 'template-parts/page', 'header' ); ?>
			<?php get_template_part( 'template-parts/menu', 'category' ); ?>
			<?php if ( have_posts() ) : ?>
			<div class="vc_col-md-12">
				<?php echo do_shortcode( '[cosmic_section_title bg_img="red" title="Recent Posts" title_color="#2c3f70"]' ); ?>
			</div>
			<div class="vc_container post_boxes" <?php $archive_class->archive_data_types(); ?> >
				<?php while ( have_posts() ) :
						the_post(); ?>
						<div class="vc_col-lg-3 vc_col-md-4 vc_col-sm-6 box_wrap">
							<?php get_template_part( 'template-parts/box/content', get_post_type() ); ?>
						</div>
				<?php endwhile; ?>
			</div>
			<div class="vc_container">
				<div class="vc_col-md-12 post_navigation load_more_navigation">
					<?php
					// Replace post_navigation with load more button
					if ( get_the_posts_navigation() ) : ?>
						<a href="#" class="button button-ghost button-load-more btn-lg">Load More</a>
						<input type="hidden" id="load_more_nounce" value="<?php echo esc_attr( $archive_class->create_nounce() ); ?>">
						<input type="hidden" id="load_more_page" value="2">
					<?php endif; ?>
				</div>
			</div>
			<?php else :
				get_template_part( 'template-parts/box/content', 'none' );
			endif;
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_template_part( 'template-parts/post', 'search' ); ?>
<?php get_footer();
