<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

$vixus_args = get_query_var( 'vixus_logo_args' );

// Site logo
$vixus_logo_type   = isset( $vixus_args['type'] ) ? $vixus_args['type'] : '';
$vixus_logo_image  = vixus_get_logo_image( $vixus_logo_type );
$vixus_logo_text   = vixus_is_on( vixus_get_theme_option( 'logo_text' ) ) ? get_bloginfo( 'name' ) : '';
$vixus_logo_slogan = get_bloginfo( 'description', 'display' );
if ( ! empty( $vixus_logo_image ) || ! empty( $vixus_logo_text ) ) {
	?><a class="sc_layouts_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		<?php
		if ( ! empty( $vixus_logo_image ) ) {
			if ( empty( $vixus_logo_type ) && function_exists( 'the_custom_logo' ) && is_numeric( $vixus_logo_image ) && (int)$vixus_logo_image > 0 ) {
				the_custom_logo();
			} else {
				$vixus_attr = vixus_getimagesize( $vixus_logo_image );
				echo '<img src="' . esc_url( $vixus_logo_image ) . '" alt="' . esc_attr( $vixus_logo_text ) . '"' . ( ! empty( $vixus_attr[3] ) ? ' ' . wp_kses_data( $vixus_attr[3] ) : '' ) . '>';
			}
		} else {
			vixus_show_layout( vixus_prepare_macros( $vixus_logo_text ), '<span class="logo_text">', '</span>' );
			vixus_show_layout( vixus_prepare_macros( $vixus_logo_slogan ), '<span class="logo_slogan">', '</span>' );
		}
		?>
	</a>
	<?php
}
