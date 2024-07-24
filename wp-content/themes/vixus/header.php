<?php
/**
 * The Header: Logo and main menu
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js
									<?php
										// Class scheme_xxx need in the <html> as context for the <body>!
										echo ' scheme_' . esc_attr( vixus_get_theme_option( 'color_scheme' ) );
									?>
										">
<head>
	<?php wp_head(); ?>
</head>

<body <?php	body_class(); ?>>
	<?php wp_body_open(); ?>
	<?php do_action( 'vixus_action_before_body' ); ?>

	<div class="body_wrap">

		<div class="page_wrap">
			<?php
			// Desktop header
			$vixus_header_type = vixus_get_theme_option( 'header_type' );
			if ( 'custom' == $vixus_header_type && ! vixus_is_layouts_available() ) {
				$vixus_header_type = 'default';
			}
			get_template_part( apply_filters( 'vixus_filter_get_template_part', "templates/header-{$vixus_header_type}" ) );

			// Side menu
			if ( in_array( vixus_get_theme_option( 'menu_style' ), array( 'left', 'right' ) ) ) {
				get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-navi-side' ) );
			}

			// Mobile menu
			get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-navi-mobile' ) );
			
			// Single posts banner after header
			vixus_show_post_banner( 'header' );
			?>

			<div class="page_content_wrap">
				<?php
				// Single posts banner on the background
				if ( is_singular( 'post' ) ) {

					vixus_show_post_banner( 'background' );

					$vixus_post_thumbnail_type  = vixus_get_theme_option( 'post_thumbnail_type' );
					$vixus_post_header_position = vixus_get_theme_option( 'post_header_position' );
					$vixus_post_header_align    = vixus_get_theme_option( 'post_header_align' );

					// Boxed post thumbnail
					if ( in_array( $vixus_post_thumbnail_type, array( 'boxed', 'fullwidth') ) ) {
						?>
						<div class="header_content_wrap header_align_<?php echo esc_attr( $vixus_post_header_align ); ?>">
							<?php
							if ( 'boxed' === $vixus_post_thumbnail_type ) {
								?>
								<div class="content_wrap">
								<?php
							}

							// Post title and meta
							if ( 'above' === $vixus_post_header_position ) {
								vixus_show_post_title_and_meta();
							}

							// Featured image
							vixus_show_post_featured_image();

							// Post title and meta
							if ( in_array( $vixus_post_header_position, array( 'under', 'on_thumb' ) ) ) {
								vixus_show_post_title_and_meta();
							}

							if ( 'boxed' === $vixus_post_thumbnail_type ) {
								?>
								</div>
								<?php
							}
							?>
						</div>
						<?php
					}
				}

				if ( 'fullscreen' != vixus_get_theme_option( 'body_style' ) ) {
					?>
					<div class="content_wrap">
						<?php
				}

				// Widgets area above page content
				vixus_create_widgets_area( 'widgets_above_page' );
				?>

				<div class="content">
					<?php
					// Widgets area inside page content
					vixus_create_widgets_area( 'widgets_above_content' );
