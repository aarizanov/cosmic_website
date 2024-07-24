<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap
<?php
if ( ! vixus_is_inherit( vixus_get_theme_option( 'copyright_scheme' ) ) ) {
	echo ' scheme_' . esc_attr( vixus_get_theme_option( 'copyright_scheme' ) );
}
?>
				">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text">
			<?php
				$vixus_copyright = vixus_get_theme_option( 'copyright' );
			if ( ! empty( $vixus_copyright ) ) {
				// Replace {{Y}} or {Y} with the current year
				$vixus_copyright = str_replace( array( '{{Y}}', '{Y}' ), date( 'Y' ), $vixus_copyright );
				// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
				$vixus_copyright = vixus_prepare_macros( $vixus_copyright );
				// Display copyright
				echo wp_kses( nl2br( $vixus_copyright ), 'vixus_kses_content' );
			}
			?>
			</div>
		</div>
	</div>
</div>
