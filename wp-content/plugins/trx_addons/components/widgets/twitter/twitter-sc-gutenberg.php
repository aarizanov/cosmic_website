<?php
/**
 * Widget: Twitter (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.0
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_twitter_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_twitter_editor_assets' );
	function trx_addons_gutenberg_sc_twitter_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-twitter',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_WIDGETS . 'twitter/gutenberg/twitter.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_WIDGETS . 'twitter/gutenberg/twitter.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_twitter_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_twitter_add_in_gutenberg' );
	function trx_addons_sc_twitter_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/twitter', array(
					'attributes'      => array(
						'type'               => array(
							'type'    => 'string',
							'default' => 'list',
						),
						'title'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'count'              => array(
							'type'    => 'number',
							'default' => 2,
						),
						'columns'            => array(
							'type'    => 'number',
							'default' => 1,
						),
						'follow'             => array(
							'type'    => 'boolean',
							'default' => true,
						),
						'back_image'         => array(
							'type'    => 'number',
							'default' => 0,
						),
						'back_image_url'     => array(
							'type'    => 'string',
							'default' => '',
						),
						'username'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'consumer_key'       => array(
							'type'    => 'string',
							'default' => '',
						),
						'consumer_secret'    => array(
							'type'    => 'string',
							'default' => '',
						),
						'token_key'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'token_secret'       => array(
							'type'    => 'string',
							'default' => '',
						),
						// Slider attributes
						'slider'             => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slides_space'       => array(
							'type'    => 'number',
							'default' => 0,
						),
						'slides_centered'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slides_overflow'    => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slider_mouse_wheel' => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'slider_autoplay'    => array(
							'type'    => 'boolean',
							'default' => true,
						),
						'slider_controls'    => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'slider_pagination'  => array(
							'type'    => 'string',
							'default' => 'none',
						),
						// ID, Class, CSS attributes
						'id'                 => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'                => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_twitter_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_twitter_render_block' ) ) {
	function trx_addons_gutenberg_sc_twitter_render_block( $attributes = array() ) {
		return trx_addons_sc_widget_twitter( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_twitter_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_twitter_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_twitter_get_layouts( $array = array() ) {
		$array['sc_twitter'] = apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('widgets', 'twitter'), 'trx_widget_twitter');
		return $array;
	}
}
