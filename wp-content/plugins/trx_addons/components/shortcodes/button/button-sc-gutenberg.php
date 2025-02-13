<?php
/**
 * Shortcode: Button (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_button_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_button_editor_assets' );
	function trx_addons_gutenberg_sc_button_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-button',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_SHORTCODES . 'button/gutenberg/button.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_SHORTCODES . 'button/gutenberg/button.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_button_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_button_add_in_gutenberg' );
	function trx_addons_sc_button_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/button', array(
					'attributes'      => array(
						// Button attributes
						'type'           => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'size'           => array(
							'type'    => 'string',
							'default' => 'normal',
						),
						'link'           => array(
							'type'    => 'string',
							'default' => '#',
						),
						'new_window'     => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'title'          => array(
							'type'    => 'string',
							'default' => __( 'Button', 'trx_addons' ),
						),
						'subtitle'       => array(
							'type'    => 'string',
							'default' => '',
						),
						'align'          => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'text_align'     => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'back_image'     => array(
							'type'    => 'number',
							'default' => 0,
						),
						'back_image_url' => array(
							'type'    => 'string',
							'default' => '',
						),
						'icon'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'icon_position'  => array(
							'type'    => 'string',
							'default' => 'left',
						),
						'image'          => array(
							'type'    => 'number',
							'default' => 0,
						),
						'image_url'      => array(
							'type'    => 'string',
							'default' => '',
						),
						// ID, Class, CSS attributes
						'id'             => array(
							'type'    => 'string',
							'default' => '',
						),
						'class'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'css'            => array(
							'type'    => 'string',
							'default' => '',
						),
					),
					'render_callback' => 'trx_addons_gutenberg_sc_button_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_button_render_block' ) ) {
	function trx_addons_gutenberg_sc_button_render_block( $attributes = array() ) {
		return trx_addons_sc_button( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_button_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_button_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_button_get_layouts( $array = array() ) {
		$array['sc_button'] = apply_filters( 'trx_addons_sc_type', trx_addons_components_get_allowed_layouts( 'sc', 'button' ), 'trx_sc_button' );
		return $array;
	}
}

// Add shortcode's specific lists to the JS storage
if ( ! function_exists( 'trx_addons_sc_button_gutenberg_sc_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_sc_button_gutenberg_sc_params' );
	function trx_addons_sc_button_gutenberg_sc_params( $vars = array() ) {

		// Size of the button
		$vars['sc_button_sizes'] = trx_addons_get_list_sc_button_sizes();

		return $vars;
	}
}
