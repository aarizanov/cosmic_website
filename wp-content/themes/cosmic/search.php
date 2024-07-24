<?php
/**
 * The template for displaying search results pages
 *
 *
 * @package cosmic
 */
$archive_class = new CosmicArchiveClass;
$header_url = $archive_class->image_header();
if ( $header_url ) {
	$header_img = '<div class="img" style="background-image:url( '.esc_url( $header_url ).' )"></div>';
}
get_header();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php get_template_part( 'template-parts/page', 'header' ); ?>
			<?php get_template_part( 'template-parts/menu', 'category' ); ?>
			<?php get_template_part( 'template-parts/top', 'stories' ); ?>
			<?php if ( have_posts() ) : ?>
			<div class="vc_col-md-12">
				<?php echo do_shortcode( '[cosmic_section_title bg_img="red" title="Search Results" title_color="#2c3f70"]' ); ?>
			</div>
			<div class="vc_container post_boxes">
				<?php while ( have_posts() ) :
						the_post(); ?>
						<div class="vc_col-lg-3 vc_col-md-4 vc_col-sm-6 box_wrap">
							<?php get_template_part( 'template-parts/box/content', get_post_type() ); ?>
						</div>
				<?php endwhile; ?>
			</div>
			<div class="vc_container">
				<div class="vc_col-md-12 post_navigation">
					<?php the_posts_navigation(); ?>
				</div>
			</div>
			<?php else :
				get_template_part( 'template-parts/box/content', 'none' );
			endif;
			?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer();
