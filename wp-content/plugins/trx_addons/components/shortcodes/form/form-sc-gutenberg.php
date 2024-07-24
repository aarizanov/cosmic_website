<?php
/**
 * Shortcode: Form (Gutenberg support)
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
if ( ! function_exists( 'trx_addons_gutenberg_sc_form_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_form_editor_assets' );
	function trx_addons_gutenberg_sc_form_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-form',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_SHORTCODES . 'form/gutenberg/form.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_SHORTCODES . 'form/gutenberg/form.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_form_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_form_add_in_gutenberg' );
	function trx_addons_sc_form_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/form', array(
					'attributes'      => array(
						'type'               => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'style'              => array(
							'type'    => 'string',
							'default' => 'inherit',
						),
						'align'              => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'email'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'phone'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'address'            => array(
							'type'    => 'string',
							'default' => '',
						),
						'button_caption'     => array(
							'type'    => 'string',
							'default' => '',
						),
						'labels'             => array(
							'type'    => 'boolean',
							'default' => false,
						),
						// Title attributes
						'title_style'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_tag'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_align'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_color'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'title_color2'       => array(
							'type'    => 'string',
							'default' => '',
						),
						'gradient_direction' => array(
							'type'    => 'string',
							'default' => '0',
						),
						'title'              => array(
							'type'    => 'string',
							'default' => esc_html__( 'Action', 'trx_addons' ),
						),
						'subtitle'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'description'        => array(
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
					),
					'render_callback' => 'trx_addons_gutenberg_sc_form_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_form_render_block' ) ) {
	function trx_addons_gutenberg_sc_form_render_block( $attributes = array() ) {
		return trx_addons_sc_form( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_form_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_form_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_form_get_layouts( $array = array() ) {
		$array['sc_form'] = apply_filters( 'trx_addons_sc_type', trx_addons_components_get_allowed_layouts( 'sc', 'form' ), 'trx_sc_form' );
		return $array;
	}
}
