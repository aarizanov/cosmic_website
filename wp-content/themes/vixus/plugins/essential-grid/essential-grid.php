<?php
/* Essential Grid support functions
------------------------------------------------------------------------------- */


// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'vixus_essential_grid_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'vixus_essential_grid_theme_setup9', 9 );
	function vixus_essential_grid_theme_setup9() {

		add_filter( 'vixus_filter_merge_styles', 'vixus_essential_grid_merge_styles' );

		if ( is_admin() ) {
			add_filter( 'vixus_filter_tgmpa_required_plugins', 'vixus_essential_grid_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'vixus_essential_grid_tgmpa_required_plugins' ) ) {
	
	function vixus_essential_grid_tgmpa_required_plugins( $list = array() ) {
		if ( vixus_storage_isset( 'required_plugins', 'essential-grid' ) && vixus_is_theme_activated() ) {
			$path = vixus_get_plugin_source_path( 'plugins/essential-grid/essential-grid.zip' );
			if ( ! empty( $path ) || vixus_get_theme_setting( 'tgmpa_upload' ) ) {
				$list[] = array(
					'name'     => vixus_storage_get_array( 'required_plugins', 'essential-grid' ),
					'slug'     => 'essential-grid',
					'source'   => ! empty( $path ) ? $path : 'upload://essential-grid.zip',
					'required' => false,
				);
			}
		}
		return $list;
	}
}

// Check if plugin installed and activated
if ( ! function_exists( 'vixus_exists_essential_grid' ) ) {
	function vixus_exists_essential_grid() {
		return defined('EG_PLUGIN_PATH') || defined( 'ESG_PLUGIN_PATH' );
	}
}

// Merge custom styles
if ( ! function_exists( 'vixus_essential_grid_merge_styles' ) ) {
	
	function vixus_essential_grid_merge_styles( $list ) {
		$list[] = 'plugins/essential-grid/_essential-grid.scss';
		return $list;
	}
}

