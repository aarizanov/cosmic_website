<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.14
 */
$vixus_header_video = vixus_get_header_video();
$vixus_embed_video  = '';
if ( ! empty( $vixus_header_video ) && ! vixus_is_from_uploads( $vixus_header_video ) ) {
	if ( vixus_is_youtube_url( $vixus_header_video ) && preg_match( '/[=\/]([^=\/]*)$/', $vixus_header_video, $matches ) && ! empty( $matches[1] ) ) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr( $matches[1] ); ?>"></div>
		<?php
	} else {
		?>
		<div id="background_video"><?php vixus_show_layout( vixus_get_embed_video( $vixus_header_video ) ); ?></div>
		<?php
	}
}
