<?php
/**
 * Template Name: Full Width Page
 *
 * @package cosmic
*
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile; // End of the loop.
				?>
		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php //(Temporary disabled) if( is_front_page() ) get_template_part('template-parts/popup', 'consultation'); ?>

<?php 
if('hire-us' === get_post_field('post_name', get_post())) {
	get_template_part('template-parts/popup', 'thankyou');
	wp_enqueue_script( 'cosmic-popup-thankyou', get_template_directory_uri() . '/js/dist/popup_thankyou.min.js', array( 'jquery' ), '1.0' );
} ?>

<?php get_footer();
