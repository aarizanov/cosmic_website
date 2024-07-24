<?php
/**
 * ThemeREX Addons Custom post type: Post (add options to the standard WP Post)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.24
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	wp_die( '-1' );
}


// -----------------------------------------------------------------
// -- Post type setup
// -----------------------------------------------------------------

// Add options to the standard WP post
if (!function_exists('vixus_cpt_post_init')) {
	add_action( 'init', 'vixus_cpt_post_init' );
	function vixus_cpt_post_init() {
		
		// Add post's custom fields
		trx_addons_meta_box_register('post', array(
			"icon" => array(
				"title" => esc_html__("Post's icon", 'vixus'),
				"desc" => wp_kses_data( __('Select icon for the current post (used in some shortcodes)', 'vixus') ),
				"std" => '',
				"options" => array(),
				"style" => trx_addons_get_setting('icons_type'),
				"type" => "icons"
			),
			"subscribe_form" => array(
				"title" => esc_html__("Subscribe form", 'vixus'),
				"desc" => wp_kses_data( __('Put shortcode', 'vixus') ),
				"std" => '',
				"options" => array(),
				'allow_html' => true,
				'type'       => 'text'
			)
		));
	}
}
