<?php
/**
 * Shortcode: Single Post Meta (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.49
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}
	


// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_meta_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_meta_editor_assets' );
	function trx_addons_gutenberg_sc_meta_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-meta',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'meta/gutenberg/meta.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'meta/gutenberg/meta.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_meta_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_meta_add_in_gutenberg' );
	function trx_addons_sc_meta_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/layouts-meta', array(
					'attributes'      => array(
						'type'       => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'components' => array(
							'type'    => 'string',
							'default' => 'date,',
						),
						'counters'   => array(
							'type'    => 'string',
							'default' => '',
						),
						'share_type' => array(
							'type'    => 'string',
							'default' => '',
						),
						// ID, Class, CSS attributes
						'id'         => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'      => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'        => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_meta_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_meta_render_block' ) ) {
	function trx_addons_gutenberg_sc_meta_render_block( $attributes = array() ) {
		$output = trx_addons_sc_layouts_meta( $attributes );
		if ( ! empty( $output ) ) {
			return $output;
		} else {
			return esc_html__( 'Block is cannot be rendered because has not content. Try to change attributes or add a content.', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_meta_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_meta_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_meta_get_layouts( $array = array() ) {
		$array['sc_meta'] = apply_filters( 'trx_addons_sc_type', trx_addons_get_list_sc_layouts_meta(), 'trx_sc_layouts_meta' );
		return $array;
	}
}

// Add shortcode's specific vars to the JS storage
if ( ! function_exists( 'trx_addons_gutenberg_sc_meta_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_gutenberg_sc_meta_params' );
	function trx_addons_gutenberg_sc_meta_params( $vars = array() ) {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Meta components
			$vars['sc_meta_components'] = apply_filters( 'trx_addons_filter_get_list_meta_parts', array() );

			// Meta counters
			$vars['sc_meta_counters'] = apply_filters( 'trx_addons_filter_get_list_counters', array() );

			// Share types
			$vars['sc_share_types'] = trx_addons_get_list_sc_share_types();

			return $vars;
		}
	}
}
