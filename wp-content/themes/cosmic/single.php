<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cosmic
 */

get_header();
//Temporary disabled
//wp_enqueue_script( 'cosmic-popup-blog', get_template_directory_uri() . '/js/dist/popup_blog.min.js', array( 'jquery' ), '1.0' );
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_type() );
				endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php //(Temporary disabled) get_template_part('template-parts/popup', 'blog'); ?>

<?php get_footer();
