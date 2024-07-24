<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.10
 */

// Footer sidebar
$vixus_footer_name    = vixus_get_theme_option( 'footer_widgets' );
$vixus_footer_present = ! vixus_is_off( $vixus_footer_name ) && is_active_sidebar( $vixus_footer_name );
if ( $vixus_footer_present ) {
	vixus_storage_set( 'current_sidebar', 'footer' );
	$vixus_footer_wide = vixus_get_theme_option( 'footer_wide' );
	ob_start();
	if ( is_active_sidebar( $vixus_footer_name ) ) {
		dynamic_sidebar( $vixus_footer_name );
	}
	$vixus_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $vixus_out ) ) {
		$vixus_out          = preg_replace( "/<\\/aside>[\r\n\s]*<aside/", '</aside><aside', $vixus_out );
		$vixus_need_columns = true;
		if ( $vixus_need_columns ) {
			$vixus_columns = max( 0, (int) vixus_get_theme_option( 'footer_columns' ) );
			if ( 0 == $vixus_columns ) {
				$vixus_columns = min( 4, max( 1, substr_count( $vixus_out, '<aside ' ) ) );
			}
			if ( $vixus_columns > 1 ) {
				$vixus_out = preg_replace( '/<aside([^>]*)class="widget/', '<aside$1class="column-1_' . esc_attr( $vixus_columns ) . ' widget', $vixus_out );
			} else {
				$vixus_need_columns = false;
			}
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo ! empty( $vixus_footer_wide ) ? ' footer_fullwidth' : ''; ?> sc_layouts_row sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php
				if ( ! $vixus_footer_wide ) {
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
				vixus_show_layout( $vixus_out );
				do_action( 'vixus_action_after_sidebar' );
				if ( $vixus_need_columns ) {
					?>
					</div><!-- /.columns_wrap -->
					<?php
				}
				if ( ! $vixus_footer_wide ) {
					?>
					</div><!-- /.content_wrap -->
					<?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
