<?php
/**
 * Shortcode: Display WooCommerce cart with items number and totals (Gutenberg support)
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
if ( ! function_exists( 'trx_addons_gutenberg_sc_cart_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_cart_editor_assets' );
	function trx_addons_gutenberg_sc_cart_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			if ( function_exists( 'trx_addons_exists_woocommerce' ) && trx_addons_exists_woocommerce() ) {
				wp_enqueue_script(
					'trx-addons-gutenberg-editor-block-cart',
					trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'cart/gutenberg/cart.gutenberg-editor.js' ),
					trx_addons_block_editor_dependencis(),
					filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT_LAYOUTS_SHORTCODES . 'cart/gutenberg/cart.gutenberg-editor.js' ) ),
					true
				);
			}
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_cart_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_cart_add_in_gutenberg' );
	function trx_addons_sc_cart_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			if ( function_exists( 'trx_addons_exists_woocommerce' ) && trx_addons_exists_woocommerce() ) {
				register_block_type(
					'trx-addons/layouts-cart', array(
						'attributes'      => array(
							'type'             => array(
								'type'    => 'string',
								'default' => 'default',
							),
							'market'           => array(
								'type'    => 'title',
								'default' => 'woocommerce',
							),
							'text'             => array(
								'type'    => 'string',
								'default' => '',
							),
							// Hide on devices attributes
							'hide_on_wide'     => array(
								'type'    => 'boolean',
								'default' => false,
							),
							'hide_on_desktop'     => array(
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
						'render_callback' => 'trx_addons_gutenberg_sc_cart_render_block',
					)
				);
			}
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_cart_render_block' ) ) {
	function trx_addons_gutenberg_sc_cart_render_block( $attributes = array() ) {
		$output = trx_addons_sc_layouts_cart( $attributes );
		if ( !empty($output) ) {
			return $output;
		} else {
			return esc_html__( 'Block is cannot be rendered because has not content. Try to change attributes or add a content.', 'trx_addons' );
		}
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_cart_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_cart_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_cart_get_layouts( $array = array() ) {
		$array['sc_cart'] = apply_filters(
			'trx_addons_sc_type', array(
				'default' => esc_html__( 'Default', 'trx_addons' ),
			), 'trx_sc_layouts_cart'
		);
		return $array;
	}
}

// Add shortcode's specific vars to the JS storage
if ( ! function_exists( 'trx_addons_gutenberg_sc_cart_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_gutenberg_sc_cart_params' );
	function trx_addons_gutenberg_sc_cart_params( $vars = array() ) {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Cart market
			$vars['sc_cart_market'] = apply_filters(
				'trx_addons_sc_cart_market', array(
					'woocommerce' => esc_html__( 'WooCommerce', 'trx_addons' ),
				), 'trx_sc_layouts_cart'
			);

			return $vars;
		}
	}
}