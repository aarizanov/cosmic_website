<?php
/**
 * Shortcode: Accordion posts (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_accordionposts_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_accordionposts_editor_assets' );
	function trx_addons_gutenberg_sc_accordionposts_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-accordionposts',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/gutenberg/accordionposts.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_SHORTCODES . 'accordionposts/gutenberg/accordionposts.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_accordionposts_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_accordionposts_add_in_gutenberg' );
	function trx_addons_sc_accordionposts_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/accordionposts', array(
					'attributes'      => array(
						'type'               => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'accordions'		=> array(
							'type'    => 'string',
							'default' => '',
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
						// Rerender
						'reload'             => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_accordionposts_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_accordionposts_render_block' ) ) {
	function trx_addons_gutenberg_sc_accordionposts_render_block( $attributes = array() ) {
		if ( ! empty( $attributes['accordions'] ) ) {
			$attributes['accordions'] = json_decode( $attributes['accordions'], true );
			return trx_addons_sc_accordionposts( $attributes );
		} else {
			return esc_html__( 'Add at least one item', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_accordionposts_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_accordionposts_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_accordionposts_get_layouts( $array = array() ) {
		$array['sc_accordionposts'] = apply_filters( 'trx_addons_sc_type', trx_addons_components_get_allowed_layouts( 'sc', 'accordionposts' ), 'trx_sc_accordionposts' );
		return $array;
	}
}
