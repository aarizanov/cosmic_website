<?php
/* Timeline Widget Addon For Elementor support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'vixus_timeline_widget_addon_for_elementor_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'vixus_timeline_widget_addon_for_elementor_theme_setup9', 9 );
	function vixus_timeline_widget_addon_for_elementor_theme_setup9() {
		if ( vixus_exists_timeline_widget_addon_for_elementor() ) {
			add_action( 'wp_enqueue_scripts', 'vixus_timeline_widget_addon_for_elementor_frontend_scripts', 1100 );
			add_action( 'wp_enqueue_scripts', 'vixus_timeline_widget_addon_for_elementor_responsive_styles', 2000 );
			add_filter( 'vixus_filter_merge_styles', 'vixus_timeline_widget_addon_for_elementor_merge_styles' );
			add_filter( 'vixus_filter_merge_styles_responsive', 'vixus_timeline_widget_addon_for_elementor_merge_styles_responsive' );
		}
		if ( is_admin() ) {
			add_filter( 'vixus_filter_tgmpa_required_plugins', 'vixus_timeline_widget_addon_for_elementor_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'vixus_timeline_widget_addon_for_elementor_tgmpa_required_plugins' ) ) {
	
	function vixus_timeline_widget_addon_for_elementor_tgmpa_required_plugins( $list = array() ) {
		if ( vixus_storage_isset( 'required_plugins', 'timeline-widget-addon-for-elementor' ) && vixus_storage_get_array( 'required_plugins', 'timeline-widget-addon-for-elementor', 'install' ) !== false ) {
			$list[] = array(
				'name'     => vixus_storage_get_array( 'required_plugins', 'timeline-widget-addon-for-elementor' ),
				'slug'     => 'timeline-widget-addon-for-elementor',
				'required' => false,
			);
		}
		return $list;
	}
}

// Check if this plugin installed and activated
if ( ! function_exists( 'vixus_exists_timeline_widget_addon_for_elementor' ) ) {
	function vixus_exists_timeline_widget_addon_for_elementor() {
		return class_exists( 'Timeline_Widget_Addon' );
	}
}

// Enqueue styles for frontend
if ( ! function_exists( 'vixus_timeline_widget_addon_for_elementor_frontend_scripts' ) ) {
	
	function vixus_timeline_widget_addon_for_elementor_frontend_scripts() {
		if ( vixus_is_on( vixus_get_theme_option( 'debug_mode' ) ) ) {
			$vixus_url = vixus_get_file_url( 'plugins/timeline-widget-addon-for-elementor/timeline-widget-addon-for-elementor.scss' );
			if ( '' != $vixus_url ) {
				wp_enqueue_style( 'vixus-timeline-widget-addon-for-elementor', $vixus_url, array(), null );
			}
		}
	}
}

// Enqueue Cool Timeline responsive styles
if ( ! function_exists( 'vixus_timeline_widget_addon_for_elementor_responsive_styles' ) ) {
	
	function vixus_timeline_widget_addon_for_elementor_responsive_styles() {
		if ( vixus_is_on( vixus_get_theme_option( 'debug_mode' ) ) ) {
			$vixus_url = vixus_get_file_url( 'plugins/timeline-widget-addon-for-elementor/timeline-widget-addon-for-elementor-responsive.css' );
			if ( '' != $vixus_url ) {
				wp_enqueue_style( 'vixus-timeline-widget-addon-for-elementor-responsive', $vixus_url, array(), null );
			}
		}
	}
}

// Merge custom styles
if ( ! function_exists( 'vixus_timeline_widget_addon_for_elementor_merge_styles' ) ) {
	
	function vixus_timeline_widget_addon_for_elementor_merge_styles( $list ) {
		$list[] = 'plugins/timeline-widget-addon-for-elementor/timeline-widget-addon-for-elementor.scss';
		return $list;
	}
}

// Merge responsive styles
if ( ! function_exists( 'vixus_timeline_widget_addon_for_elementor_merge_styles_responsive' ) ) {
	
	function vixus_timeline_widget_addon_for_elementor_merge_styles_responsive( $list ) {
		$list[] = 'plugins/timeline-widget-addon-for-elementor/timeline-widget-addon-for-elementor-responsive.scss';
		return $list;
	}
}

/* Import Options */
// Set plugin's specific importer options
if ( !function_exists( 'vixus_timeline_widget_addon_for_elementor_importer_set_options' ) ) {
    add_filter( 'trx_addons_filter_importer_options',	'vixus_timeline_widget_addon_for_elementor_importer_set_options' );
    function vixus_timeline_widget_addon_for_elementor_importer_set_options($options=array()) {
        if ( vixus_exists_timeline_widget_addon_for_elementor() && vixus_storage_isset( 'required_plugins', 'timeline-widget-addon-for-elementor' ) ) {
            $options['additional_options'][]	= 'wp_options';
        }
        return $options;
    }
}

// Add plugin-specific colors and fonts to the custom CSS
if ( vixus_exists_timeline_widget_addon_for_elementor() ) {
	require_once VIXUS_THEME_DIR . 'plugins/timeline-widget-addon-for-elementor/timeline-widget-addon-for-elementor-style.php';
}
