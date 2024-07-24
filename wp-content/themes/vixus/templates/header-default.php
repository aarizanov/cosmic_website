<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

$vixus_header_css   = '';
$vixus_header_image = get_header_image();
$vixus_header_video = vixus_get_header_video();
if ( ! empty( $vixus_header_image ) && vixus_trx_addons_featured_image_override( is_singular() || vixus_storage_isset( 'blog_archive' ) || is_category() ) ) {
	$vixus_header_image = vixus_get_current_mode_image( $vixus_header_image );
}

?><header class="top_panel top_panel_default
	<?php
	echo ! empty( $vixus_header_image ) || ! empty( $vixus_header_video ) ? ' with_bg_image' : ' without_bg_image';
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

	// Main menu
	if ( vixus_get_theme_option( 'menu_style' ) == 'top' ) {
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-navi' ) );
	}

	// Mobile header
	if ( vixus_is_on( vixus_get_theme_option( 'header_mobile_enabled' ) ) ) {
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-mobile' ) );
	}

	// Page title and breadcrumbs area
	get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-title' ) );

	// Header widgets area
	get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-widgets' ) );

	// Display featured image in the header on the single posts
	// Comment next line to prevent show featured image in the header area
	// and display it in the post's content
	get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-single' ) );

	?>
</header>
