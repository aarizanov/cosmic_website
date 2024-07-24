<?php
/* Cool Timeline support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'vixus_cool_timeline_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'vixus_cool_timeline_theme_setup9', 9 );
	function vixus_cool_timeline_theme_setup9() {
		if ( vixus_exists_cool_timeline() ) {
			add_action( 'wp_enqueue_scripts', 'vixus_cool_timeline_frontend_scripts', 1100 );
			add_filter( 'vixus_filter_merge_styles', 'vixus_cool_timeline_merge_styles' );
		}
		if ( is_admin() ) {
			add_filter( 'vixus_filter_tgmpa_required_plugins', 'vixus_cool_timeline_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'vixus_cool_timeline_tgmpa_required_plugins' ) ) {
	
	function vixus_cool_timeline_tgmpa_required_plugins( $list = array() ) {
		if ( vixus_storage_isset( 'required_plugins', 'cool-timeline' ) && vixus_storage_get_array( 'required_plugins', 'cool-timeline', 'install' ) !== false ) {
			$list[] = array(
				'name'     => vixus_storage_get_array( 'required_plugins', 'cool-timeline' ),
				'slug'     => 'cool-timeline',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'vixus_exists_cool_timeline' ) ) {
	function vixus_exists_cool_timeline() {
		return class_exists( 'CoolTimeline' );
	}
}


// Enqueue styles for frontend
if ( ! function_exists( 'vixus_cool_timeline_frontend_scripts' ) ) {
	
	function vixus_cool_timeline_frontend_scripts() {
		if ( vixus_is_on( vixus_get_theme_option( 'debug_mode' ) ) ) {
			$vixus_url = vixus_get_file_url( 'plugins/cool-timeline/cool-timeline.css' );
			if ( '' != $vixus_url ) {
				wp_enqueue_style( 'vixus-cool-timeline', $vixus_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'vixus_cool_timeline_merge_styles' ) ) {
	
	function vixus_cool_timeline_merge_styles( $list ) {
		$list[] = 'plugins/cool-timeline/cool-timeline.scss';
		return $list;
	}
}

/* Import Options */
// Set plugin's specific importer options
if ( !function_exists( 'vixus_cool_timeline_importer_set_options' ) ) {
    add_filter( 'trx_addons_filter_importer_options',	'vixus_cool_timeline_importer_set_options' );
    function vixus_cool_timeline_importer_set_options($options=array()) {
        if ( vixus_exists_cool_timeline() && vixus_storage_isset( 'required_plugins', 'cool-timeline' ) ) {
            $options['additional_options'][]	= 'wp_options';
        }
        return $options;
    }
}

// Add plugin-specific colors and fonts to the custom CSS
if ( vixus_exists_cool_timeline() ) {
	require_once VIXUS_THEME_DIR . 'plugins/cool-timeline/cool-timeline-style.php';
}
