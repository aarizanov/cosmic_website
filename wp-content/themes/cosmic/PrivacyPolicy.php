<?php
/**
 * Template Name: PrivacyPolicy
 *
 * @package cosmic
*
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            
        <div class="privacyPolicy">
            <?php echo get_the_post_thumbnail( $id, 'full' ); ?></div>
             
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', 'page' );
				endwhile; // End of the loop.
				?>
             
        </div>

		</main><!-- #main -->
	</div><!-- #primary -->
	



<?php wp_footer(); ?>

