<?php
/**
 * Shortcode: Display site Logo (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.08
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_logo_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_logo_editor_assets' );
	function trx_addons_gutenberg_sc_logo_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			if ( function_exists( 'trx_addons_exists_woocommerce' ) && trx_addons_exists_woocommerce() ) {
				wp_enqueue_script(
					'trx-addons-gutenberg-editor-block-logo',
					trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'logo/gutenberg/logo.gutenberg-editor.js' ),
					trx_addons_block_editor_dependencis(),
					filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'logo/gutenberg/logo.gutenberg-editor.js' ) ),
					true
				);
			}
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_logo_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_logo_add_in_gutenberg' );
	function trx_addons_sc_logo_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			if ( function_exists( 'trx_addons_exists_woocommerce' ) && trx_addons_exists_woocommerce() ) {
				register_block_type(
					'trx-addons/layouts-logo', array(
						'attributes'      => array(
							'type'             => array(
								'type'    => 'string',
								'default' => 'default',
							),
							'logo_height'      => array(
								'type'    => 'string',
								'default' => '',
							),
							'logo'             => array(
								'type'    => 'number',
								'default' => 0,
							),
							'logo_url'         => array(
								'type'    => 'string',
								'default' => '',
							),
							'logo_retina'      => array(
								'type'    => 'number',
								'default' => 0,
							),
							'logo_retina_url'  => array(
								'type'    => 'string',
								'default' => '',
							),
							'logo_text'        => array(
								'type'    => 'string',
								'default' => '',
							),
							'logo_slogan'      => array(
								'type'    => 'string',
								'default' => '',
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
						'render_callback' => 'trx_addons_gutenberg_sc_logo_render_block',
					)
				);
			}
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_logo_render_block' ) ) {
	function trx_addons_gutenberg_sc_logo_render_block( $attributes = array() ) {
		$output = trx_addons_sc_layouts_logo( $attributes );
		if ( ! empty( $output ) ) {
			return $output;
		} else {
			return esc_html__( 'Block is cannot be rendered because has not content. Try to change attributes or add a content.', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_logo_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_logo_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_logo_get_layouts( $array = array() ) {
		$array['sc_logo'] = apply_filters(
			'trx_addons_sc_type', array(
				'default' => esc_html__( 'Default', 'trx_addons' ),
			), 'trx_sc_layouts_logo'
		);
		return $array;
	}
}
