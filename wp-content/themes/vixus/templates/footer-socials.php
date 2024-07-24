<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.10
 */


// Socials
if ( vixus_is_on( vixus_get_theme_option( 'socials_in_footer' ) ) ) {
	$vixus_output = vixus_get_socials_links();
	if ( '' != $vixus_output ) {
		?>
		<div class="footer_socials_wrap socials_wrap">
			<div class="footer_socials_inner">
				<?php vixus_show_layout( $vixus_output ); ?>
			</div>
		</div>
		<?php
	}
}
