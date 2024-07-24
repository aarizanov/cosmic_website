<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr( vixus_get_theme_option( 'menu_mobile_fullscreen' ) > 0 ? 'fullscreen' : 'narrow' ); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a>
		<?php

		// Logo
		set_query_var( 'vixus_logo_args', array( 'type' => 'mobile' ) );
		get_template_part( apply_filters( 'vixus_filter_get_template_part', 'templates/header-logo' ) );
		set_query_var( 'vixus_logo_args', array() );

		// Mobile menu
		$vixus_menu_mobile = vixus_get_nav_menu( 'menu_mobile' );
		if ( empty( $vixus_menu_mobile ) ) {
			$vixus_menu_mobile = apply_filters( 'vixus_filter_get_mobile_menu', '' );
			if ( empty( $vixus_menu_mobile ) ) {
				$vixus_menu_mobile = vixus_get_nav_menu( 'menu_main' );
			}
			if ( empty( $vixus_menu_mobile ) ) {
				$vixus_menu_mobile = vixus_get_nav_menu();
			}
		}
		if ( ! empty( $vixus_menu_mobile ) ) {
			$vixus_menu_mobile = str_replace(
				array( 'menu_main',   'id="menu-',        'sc_layouts_menu_nav', 'sc_layouts_menu ', 'sc_layouts_hide_on_mobile', 'hide_on_mobile' ),
				array( 'menu_mobile', 'id="menu_mobile-', '',                    ' ',                '',                          '' ),
				$vixus_menu_mobile
			);
			if ( strpos( $vixus_menu_mobile, '<nav ' ) === false ) {
				$vixus_menu_mobile = sprintf( '<nav class="menu_mobile_nav_area">%s</nav>', $vixus_menu_mobile );
			}
			vixus_show_layout( apply_filters( 'vixus_filter_menu_mobile_layout', $vixus_menu_mobile ) );
		}

		// Search field
		do_action(
			'vixus_action_search',
			array(
				'style' => 'normal',
				'class' => 'search_mobile',
				'ajax'  => false
			)
		);

		// Social icons
		vixus_show_layout( vixus_get_socials_links(), '<div class="socials_mobile">', '</div>' );
		?>
	</div>
</div>
