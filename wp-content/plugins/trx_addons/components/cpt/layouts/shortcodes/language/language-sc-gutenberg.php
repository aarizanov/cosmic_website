<?php
/**
 * Shortcode: Display WPML Language Selector (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.18
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_language_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_language_editor_assets' );
	function trx_addons_gutenberg_sc_language_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			if ( trx_addons_exists_wpml() && function_exists( 'icl_get_languages' ) ) {
				wp_enqueue_script(
					'trx-addons-gutenberg-editor-block-language',
					trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'language/gutenberg/language.gutenberg-editor.js' ),
					trx_addons_block_editor_dependencis(),
					filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'language/gutenberg/language.gutenberg-editor.js' ) ),
					true
				);
			}
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_language_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_language_add_in_gutenberg' );
	function trx_addons_sc_language_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			if ( trx_addons_exists_wpml() && function_exists( 'icl_get_languages' ) ) {
				register_block_type(
					'trx-addons/layouts-language', array(
						'attributes'      => array(
							'type'             => array(
								'type'    => 'string',
								'default' => 'default',
							),
							'flag'             => array(
								'type'    => 'title',
								'default' => '',
							),
							'title_link'       => array(
								'type'    => 'string',
								'default' => 'name',
							),
							'title_menu'       => array(
								'type'    => 'string',
								'default' => 'name',
							),
							// Hide on devices attributes
							'hide_on_wide'     => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_desktop'  => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_notebook' => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_tablet'   => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_mobile'   => array(
								'type'    => 'boolean',
								'default' => false,
							),
							// ID, Class, CSS attributes
							'id'               => array(
								'type'    => 'string',
								'default' => '',
							),
							'class'            => array(
								'type'    => 'string',
								'default' => '',
							),
							'css'              => array(
								'type'    => 'string',
								'default' => '',
							),
						),
						'render_callback' => 'trx_addons_gutenberg_sc_language_render_block',
					)
				);
			}
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_language_render_block' ) ) {
	function trx_addons_gutenberg_sc_language_render_block( $attributes = array() ) {
		$output = trx_addons_sc_layouts_language( $attributes );
		if ( ! empty( $output ) ) {
			return $output;
		} else {
			return esc_html__( 'Block is cannot be rendered because has not content. Try to change attributes or add a content.', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_language_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_language_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_language_get_layouts( $array = array() ) {
		$array['sc_language'] = apply_filters(
			'trx_addons_sc_type', array(
				'default' => esc_html__( 'Default', 'trx_addons' ),
			), 'trx_sc_layouts_language'
		);
		return $array;
	}
}

// Add shortcode's specific vars to the JS storage
if ( ! function_exists( 'trx_addons_gutenberg_sc_language_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_gutenberg_sc_language_params' );
	function trx_addons_gutenberg_sc_language_params( $vars = array() ) {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Language positions
			$vars['sc_layouts_language_positions'] = trx_addons_get_list_sc_layouts_language_positions();

			// Language parts
			$vars['sc_layouts_language_parts'] = trx_addons_get_list_sc_layouts_language_parts();

			return $vars;
		}
	}
}