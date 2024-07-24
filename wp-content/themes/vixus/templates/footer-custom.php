<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.10
 */

$vixus_footer_id = vixus_get_custom_footer_id();
$vixus_footer_meta = get_post_meta( $vixus_footer_id, 'trx_addons_options', true );
if ( ! empty( $vixus_footer_meta['margin'] ) ) {
	vixus_add_inline_css( sprintf( '.page_content_wrap{padding-bottom:%s}', esc_attr( vixus_prepare_css_value( $vixus_footer_meta['margin'] ) ) ) );
}
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr( $vixus_footer_id ); ?> footer_custom_<?php echo esc_attr( sanitize_title( get_the_title( $vixus_footer_id ) ) ); ?>
						<?php
						if ( ! vixus_is_inherit( vixus_get_theme_option( 'footer_scheme' ) ) ) {
							echo ' scheme_' . esc_attr( vixus_get_theme_option( 'footer_scheme' ) );
						}
						?>
						">
	<?php
	// Custom footer's layout
	do_action( 'vixus_action_show_layout', $vixus_footer_id );
	?>
</footer><!-- /.footer_wrap -->
