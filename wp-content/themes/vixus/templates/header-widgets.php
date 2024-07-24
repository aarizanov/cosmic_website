<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

// Header sidebar
$vixus_header_name    = vixus_get_theme_option( 'header_widgets' );
$vixus_header_present = ! vixus_is_off( $vixus_header_name ) && is_active_sidebar( $vixus_header_name );
if ( $vixus_header_present ) {
	vixus_storage_set( 'current_sidebar', 'header' );
	$vixus_header_wide = vixus_get_theme_option( 'header_wide' );
	ob_start();
	if ( is_active_sidebar( $vixus_header_name ) ) {
		dynamic_sidebar( $vixus_header_name );
	}
	$vixus_widgets_output = ob_get_contents();
	ob_end_clean();
	if ( ! empty( $vixus_widgets_output ) ) {
		$vixus_widgets_output = preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $vixus_widgets_output );
		$vixus_need_columns   = strpos( $vixus_widgets_output, 'columns_wrap' ) === false;
		if ( $vixus_need_columns ) {
			$vixus_columns = max( 0, (int) vixus_get_theme_option( 'header_columns' ) );
			if ( 0 == $vixus_columns ) {
				$vixus_columns = min( 6, max( 1, substr_count( $vixus_widgets_output, '<aside ' ) ) );
			}
			if ( $vixus_columns > 1 ) {
				$vixus_widgets_output = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $vixus_columns ) . ' widget', $vixus_widgets_output );
			} else {
				$vixus_need_columns = false;
			}
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo ! empty( $vixus_header_wide ) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php
				if ( ! $vixus_header_wide ) {
					?>
					<div class="content_wrap">
					<?php
				}
				if ( $vixus_need_columns ) {
					?>
					<div class="columns_wrap">
					<?php
				}
				do_action( 'vixus_action_before_sidebar' );
				vixus_show_layout( $vixus_widgets_output );
				do_action( 'vixus_action_after_sidebar' );
				if ( $vixus_need_columns ) {
					?>
					</div>	<!-- /.columns_wrap -->
					<?php
				}
				if ( ! $vixus_header_wide ) {
					?>
					</div>	<!-- /.content_wrap -->
					<?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
