<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.10
 */

// Logo
if ( vixus_is_on( vixus_get_theme_option( 'logo_in_footer' ) ) ) {
	$vixus_logo_image = vixus_get_logo_image( 'footer' );
	$vixus_logo_text  = get_bloginfo( 'name' );
	if ( ! empty( $vixus_logo_image ) || ! empty( $vixus_logo_text ) ) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if ( ! empty( $vixus_logo_image ) ) {
					$vixus_attr = vixus_getimagesize( $vixus_logo_image );
					echo '<a href="' . esc_url( home_url( '/' ) ) . '">'
							. '<img src="' . esc_url( $vixus_logo_image ) . '"'
								. ' class="logo_footer_image"'
								. ' alt="' . esc_attr__( 'Site logo', 'vixus' ) . '"'
								. ( ! empty( $vixus_attr[3] ) ? ' ' . wp_kses_data( $vixus_attr[3] ) : '' )
							. '>'
						. '</a>';
				} elseif ( ! empty( $vixus_logo_text ) ) {
					echo '<h1 class="logo_footer_text">'
							. '<a href="' . esc_url( home_url( '/' ) ) . '">'
								. esc_html( $vixus_logo_text )
							. '</a>'
						. '</h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
