<?php
/**
 * Widget: Flickr (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.1
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_flickr_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_flickr_editor_assets' );
	function trx_addons_gutenberg_sc_flickr_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-flickr',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_WIDGETS . 'flickr/gutenberg/flickr.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_WIDGETS . 'flickr/gutenberg/flickr.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_flickr_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_flickr_add_in_gutenberg' );
	function trx_addons_sc_flickr_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/flickr', array(
					'attributes'      => array(
						'title'           => array(
							'type'    => 'string',
							'default' => esc_html__( 'Flickr photos', 'trx_addons' ),
						),
						'flickr_api_key'  => array(
							'type'    => 'string',
							'default' => '',
						),
						'flickr_username' => array(
							'type'    => 'string',
							'default' => '',
						),
						'flickr_count'    => array(
							'type'    => 'number',
							'default' => 8,
						),
						'flickr_columns'  => array(
							'type'    => 'number',
							'default' => 4,
						),
						'flickr_columns_gap' => array(
							'type'    => 'number',
							'default' => 0,
						),
						// ID, Class, CSS attributes
						'id'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'             => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_flickr_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_flickr_render_block' ) ) {
	function trx_addons_gutenberg_sc_flickr_render_block( $attributes = array() ) {
		if (!empty($attributes['flickr_username']) ) {
			return trx_addons_sc_widget_flickr( $attributes );
		} else {
			return '<h4>' . esc_html__( 'Add flickr username', 'trx_addons' ) . '</h4>';
		}
	}
}
