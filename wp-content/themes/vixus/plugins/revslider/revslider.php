<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'vixus_revslider_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'vixus_revslider_theme_setup9', 9 );
	function vixus_revslider_theme_setup9() {

		add_filter( 'vixus_filter_merge_styles', 'vixus_revslider_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'vixus_filter_tgmpa_required_plugins', 'vixus_revslider_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'vixus_revslider_tgmpa_required_plugins' ) ) {
	
	function vixus_revslider_tgmpa_required_plugins( $list = array() ) {
		if ( vixus_storage_isset( 'required_plugins', 'revslider' ) && vixus_is_theme_activated() ) {
			$path = vixus_get_plugin_source_path( 'plugins/revslider/revslider.zip' );
			if ( ! empty( $path ) || vixus_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => vixus_storage_get_array( 'required_plugins', 'revslider' ),
					'slug'     => 'revslider',
					'source'   => ! empty( $path ) ? $path : 'upload://revslider.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if RevSlider installed and activated
if ( ! function_exists( 'vixus_exists_revslider' ) ) {
	function vixus_exists_revslider() {
		return function_exists( 'rev_slider_shortcode' );
	}
}

// Merge custom styles
if ( ! function_exists( 'vixus_revslider_merge_styles' ) ) {
	
	function vixus_revslider_merge_styles( $list ) {
		$list[] = 'plugins/revslider/_revslider.scss';
		return $list;
	}
}

