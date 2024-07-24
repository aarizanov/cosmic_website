<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cosmic
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( 'template-parts/page', 'header' ); ?>
	<?php get_template_part( 'template-parts/post', 'menu' ); ?>
	<div class="entry-content">
		<div class="vc_container" id="single-content">
			<div class="vc_col-md-8 content clearfix">
				<?php
				// Echo the content
				the_content();
				// Include auhor template
				//get_template_part( 'template-parts/post-author', 'profile' );
				?>
			</div>
			<div class="vc_col-md-4 sidebar" id="sidebar">
				<?php get_template_part( 'template-parts/post', 'sidebar' ); ?>
			</div>
			<div class="vc_col-md-12">
				<div class="vc_row">
					<?php
					// Section title shortcode
					echo do_shortcode( '[cosmic_section_title bg_img="red" title="Recent Posts" title_color="#2c3f70"]' );
					// Recent posts shortcode
					echo do_shortcode( '[cosmic_posts_carousel slider_nav="arrow" slider_ppp="8" slider_num="4" nav_color="#a6a6a6"]' );
					?>
				</div>
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
