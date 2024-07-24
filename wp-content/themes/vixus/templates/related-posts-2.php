<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

$vixus_link        = get_permalink();
$vixus_post_format = get_post_format();
$vixus_post_format = empty( $vixus_post_format ) ? 'standard' : str_replace( 'post-format-', '', $vixus_post_format );
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_2 post_format_' . esc_attr( $vixus_post_format ) ); ?>>
						<?php
						vixus_show_post_featured(
							array(
								'thumb_size'    => apply_filters( 'vixus_filter_related_thumb_size', vixus_get_thumb_size( (int) vixus_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'related' ) ),
								'show_no_image' => vixus_get_theme_setting( 'allow_no_image' ),
								'singular'      => false,
							)
						);
						?>
	<div class="post_header entry-header">
		<?php
		if ( in_array( $vixus_post_format, array( 'quote' ) ) ) {
			the_content();
		}
		?>
		<h5 class="post_title entry-title"><a href="<?php echo esc_url( $vixus_link ); ?>"><?php the_title(); ?></a></h5>
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			?>
			<span class="post_date"><a href="<?php echo esc_url( $vixus_link ); ?>"><?php echo wp_kses_data( vixus_get_date() ); ?></a></span>
			<?php
		}
		?>
	</div>
</div>
