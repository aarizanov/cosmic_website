<?php
/* Contact Form 7 support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if ( ! function_exists( 'vixus_cf7_theme_setup9' ) ) {
	add_action( 'after_setup_theme', 'vixus_cf7_theme_setup9', 9 );
	function vixus_cf7_theme_setup9() {

		add_filter( 'vixus_filter_merge_scripts', 'vixus_cf7_merge_scripts' );
		add_filter( 'vixus_filter_merge_styles', 'vixus_cf7_merge_styles' );

		if ( vixus_exists_cf7() ) {
			add_action( 'wp_enqueue_scripts', 'vixus_cf7_frontend_scripts', 1100 );
		}

		if ( is_admin() ) {
			add_filter( 'vixus_filter_tgmpa_required_plugins', 'vixus_cf7_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( ! function_exists( 'vixus_cf7_tgmpa_required_plugins' ) ) {
	
	function vixus_cf7_tgmpa_required_plugins( $list = array() ) {
		if ( vixus_storage_isset( 'required_plugins', 'contact-form-7' ) ) {
			// CF7 plugin
			$list[] = array(
				'name'     => vixus_storage_get_array( 'required_plugins', 'contact-form-7' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			);
		}
		return $list;
	}
}



// Check if cf7 installed and activated
if ( ! function_exists( 'vixus_exists_cf7' ) ) {
	function vixus_exists_cf7() {
		return class_exists( 'WPCF7' );
	}
}

// Enqueue custom scripts
if ( ! function_exists( 'vixus_cf7_frontend_scripts' ) ) {
	
	function vixus_cf7_frontend_scripts() {
		if ( vixus_exists_cf7() ) {
			if ( vixus_is_on( vixus_get_theme_option( 'debug_mode' ) ) ) {
				$vixus_url = vixus_get_file_url( 'plugins/contact-form-7/contact-form-7.js' );
				if ( '' != $vixus_url ) {
					wp_enqueue_script( 'vixus-cf7', $vixus_url, array( 'jquery' ), null, true );
				}
			}
		}
	}
}

// Merge custom scripts
if ( ! function_exists( 'vixus_cf7_merge_scripts' ) ) {
	
	function vixus_cf7_merge_scripts( $list ) {
		if ( vixus_exists_cf7() ) {
			$list[] = 'plugins/contact-form-7/contact-form-7.js';
		}
		return $list;
	}
}

// Merge custom styles
if ( ! function_exists( 'vixus_cf7_merge_styles' ) ) {
	
	function vixus_cf7_merge_styles( $list ) {
		$list[] = 'plugins/contact-form-7/_contact-form-7.scss';
		return $list;
	}
}

