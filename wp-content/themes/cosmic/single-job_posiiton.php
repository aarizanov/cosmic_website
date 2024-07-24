<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cosmic
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
				while ( have_posts() ) :
					the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php get_template_part( 'template-parts/page', 'header' ); ?>
						<div class="entry-content">
							<div class="vc_container" id="single-content">
								<div class="vc_col-md-9 content clearfix">
									<?php
									// Echo the content
									the_content();
									// Include author template
									get_template_part( 'template-parts/post-author', 'profile' );
									?>
								</div>
								<div class="vc_col-md-3 sidebar" id="sidebar">
									<?php echo do_shortcode('[contact-form-7 id="1113" title="APPLY"]'); ?>
								</div>
							</div>
							<div class="subscribe" style="background-image:url( <?php echo esc_url( get_template_directory_uri().'/img/subscribe-dots.png' ); ?> )">
								<div class="vc_container">
									<div class="vc_col-md-12">
										<?php get_template_part( 'template-parts/subscribe', 'box' ); ?>
									</div>
								</div>
							</div>
						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->
				<?php endwhile; ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
