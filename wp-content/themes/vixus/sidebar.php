<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

if ( vixus_sidebar_present() ) {
	ob_start();
	$vixus_sidebar_name = vixus_get_theme_option( 'sidebar_widgets' . ( is_single() ? '_single' : '' ) );
	vixus_storage_set( 'current_sidebar', 'sidebar' );
	if ( is_active_sidebar( $vixus_sidebar_name ) ) {
		dynamic_sidebar( $vixus_sidebar_name );
	}
	$vixus_out = trim( ob_get_contents() );
	ob_end_clean();
	if ( ! empty( $vixus_out ) ) {
		$vixus_sidebar_position = vixus_get_theme_option( 'sidebar_position' . ( is_single() ? '_single' : '' ) );
		$vixus_sidebar_mobile   = vixus_get_theme_option( 'sidebar_position_mobile' . ( is_single() ? '_single' : '' ) );
		?>
		<div class="sidebar widget_area
			<?php
			echo ' ' . esc_attr( $vixus_sidebar_position );
			echo ' sidebar_' . esc_attr( $vixus_sidebar_mobile );

			if ( 'above' == $vixus_sidebar_mobile ) {
			} else if ( 'float' == $vixus_sidebar_mobile ) {
				echo ' sidebar_float';
			}
			if ( ! vixus_is_inherit( vixus_get_theme_option( 'sidebar_scheme' ) ) ) {
				echo ' scheme_' . esc_attr( vixus_get_theme_option( 'sidebar_scheme' ) );
			}
			?>
		" role="complementary">
			<?php
			// Single posts banner before sidebar
			vixus_show_post_banner( 'sidebar' );
			// Button to show/hide sidebar on mobile
			if ( in_array( $vixus_sidebar_mobile, array( 'above', 'float' ) ) ) {
				$vixus_title = apply_filters( 'vixus_filter_sidebar_control_title', 'float' == $vixus_sidebar_mobile ? esc_html__( 'Show Sidebar', 'vixus' ) : '' );
				$vixus_text  = apply_filters( 'vixus_filter_sidebar_control_text', 'above' == $vixus_sidebar_mobile ? esc_html__( 'Show Sidebar', 'vixus' ) : '' );
				?>
				<a href="#" class="sidebar_control" title="<?php echo esc_attr( $vixus_title ); ?>"><?php echo esc_html( $vixus_text ); ?></a>
				<?php
			}
			?>
			<div class="sidebar_inner">
				<?php
				do_action( 'vixus_action_before_sidebar' );
				vixus_show_layout( preg_replace( "/<\/aside>[\r\n\s]*<aside/", '</aside><aside', $vixus_out ) );
				do_action( 'vixus_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<div class="clearfix"></div>
		<?php
	}
}
