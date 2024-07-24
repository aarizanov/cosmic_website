<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.06
 */

$vixus_header_css   = '';
$vixus_header_image = get_header_image();
$vixus_header_video = vixus_get_header_video();
if ( ! empty( $vixus_header_image ) && vixus_trx_addons_featured_image_override( is_singular() || vixus_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$vixus_header_image = vixus_get_current_mode_image( $vixus_header_image );
}

$vixus_header_id = vixus_get_custom_header_id();
$vixus_header_meta = get_post_meta( $vixus_header_id, 'trx_addons_options', true );
if ( ! empty( $vixus_header_meta['margin'] ) ) {
	vixus_add_inline_css( sprintf( '.page_content_wrap{padding-top:%s}', esc_attr( vixus_prepare_css_value( $vixus_header_meta['margin'] ) ) ) );
}

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr( $vixus_header_id ); ?> top_panel_custom_<?php echo esc_attr( sanitize_title( get_the_title( $vixus_header_id ) ) ); ?>
				<?php
				echo ! empty( $vixus_header_image ) || ! empty( $vixus_header_video )
					? ' with_bg_image'
					: ' without_bg_image';
				if ( '' != $vixus_header_video ) {
					echo ' with_bg_video';
				}
				if ( '' != $vixus_header_image ) {
					echo ' ' . esc_attr( vixus_add_inline_css_class( 'background-image: url(' . esc_url( $vixus_header_image ) . ');' ) );
				}
				if ( is_single() && has_post_thumbnail() ) {
					echo ' with_featured_image';
				}
				if ( vixus_is_on( vixus_get_theme_option( 'header_fullheight' ) ) ) {
					echo ' header_fullheight vixus-full-height';
				}
				if ( ! vixus_is_inherit( vixus_get_theme_option( 'header_scheme' ) ) ) {
					echo ' scheme_' . esc_attr( vixus_get_theme_option( 'header_scheme' ) );
				}
				?>
">
	<?php

	// Background video
	if ( ! empty( $vixus_header_video ) ) {
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-video' ) );
	}

	// Custom header's layout
	do_action( 'vixus_action_show_layout', $vixus_header_id );

	// Header widgets area
	get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-widgets' ) );

	?>
</header>
