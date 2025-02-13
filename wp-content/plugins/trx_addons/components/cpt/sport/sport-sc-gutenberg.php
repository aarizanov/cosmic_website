<?php
/**
 * ThemeREX Addons: Sports Reviews Management (SRM).
 *                  Support different sports, championships, rounds, matches and players.
 *                  (Gutenberg support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.17
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_matches_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_matches_editor_assets' );
	function trx_addons_gutenberg_sc_matches_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-matches',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT . 'sport/gutenberg/matches.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT . 'sport/gutenberg/matches.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_matches_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_matches_add_in_gutenberg' );
	function trx_addons_sc_matches_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/matches', array(
					'attributes'      => array(
						'type'               => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'sport'              => array(
							'type'    => 'string',
							'default' => trx_addons_get_option( 'sport_favorite' ),
						),
						'competition'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'round'              => array(
							'type'    => 'string',
							'default' => '',
						),
						'main_matches'       => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'position'           => array(
							'type'    => 'string',
							'default' => 'top',
						),
						'slider'             => array(
							'type'    => 'boolean',
							'default' => false,
						),
						// Query attributes
						'ids'                => array(
							'type'    => 'string',
							'default' => '',
						),
						'count'              => array(
							'type'    => 'number',
							'default' => 2,
						),
						'columns'            => array(
							'type'    => 'number',
							'default' => 2,
						),
						'offset'             => array(
							'type'    => 'number',
							'default' => 0,
						),
						'orderby'            => array(
							'type'    => 'string',
							'default' => 'none',
						),
						'order'              => array(
							'type'    => 'string',
							'default' => 'asc',
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
							'default' => esc_html__( 'Matches', 'trx_addons' ),
						),
						'subtitle'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'description'        => array(
							'type'    => 'string',
							'default' => '',
						),
						// Button attributes
						'link'               => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_text'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_style'         => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_image'         => array(
							'type'    => 'number',
							'default' => 0,
						),
						'link_image_url'     => array(
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
					'render_callback' => 'trx_addons_gutenberg_sc_matches_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_matches_render_block' ) ) {
	function trx_addons_gutenberg_sc_matches_render_block( $attributes = array() ) {
		return trx_addons_sc_matches( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_matches_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_matches_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_matches_get_layouts( $array = array() ) {
		$array['trx_sc_matches'] = apply_filters(
			'trx_addons_sc_type', array(
				'default' => esc_html__( 'Default', 'trx_addons' ),
			), 'trx_sc_matches'
		);

		return $array;
	}
}



// Gutenberg Block
//------------------------------------------------------

// Add scripts and styles for the editor
if ( ! function_exists( 'trx_addons_gutenberg_sc_points_editor_assets' ) ) {
	add_action( 'enqueue_block_editor_assets', 'trx_addons_gutenberg_sc_points_editor_assets' );
	function trx_addons_gutenberg_sc_points_editor_assets() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			// Scripts
			wp_enqueue_script(
				'trx-addons-gutenberg-editor-block-points',
				trx_addons_get_file_url( TRX_ADDONS_PLUGIN_CPT . 'sport/gutenberg/points.gutenberg-editor.js' ),
				trx_addons_block_editor_dependencis(),
				filemtime( trx_addons_get_file_dir( TRX_ADDONS_PLUGIN_CPT . 'sport/gutenberg/points.gutenberg-editor.js' ) ),
				true
			);
		}
	}
}

// Block register
if ( ! function_exists( 'trx_addons_sc_points_add_in_gutenberg' ) ) {
	add_action( 'init', 'trx_addons_sc_points_add_in_gutenberg' );
	function trx_addons_sc_points_add_in_gutenberg() {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {
			register_block_type(
				'trx-addons/points', array(
					'attributes'      => array(
						'type'               => array(
							'type'    => 'string',
							'default' => 'default',
						),
						'sport'              => array(
							'type'    => 'string',
							'default' => trx_addons_get_option( 'sport_favorite' ),
						),
						'competition'        => array(
							'type'    => 'string',
							'default' => '',
						),
						'logo'               => array(
							'type'    => 'boolean',
							'default' => false,
						),
						'accented_top'       => array(
							'type'    => 'number',
							'default' => 3,
						),
						'accented_bottom'    => array(
							'type'    => 'number',
							'default' => 3,
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
							'default' => esc_html__( 'Points', 'trx_addons' ),
						),
						'subtitle'           => array(
							'type'    => 'string',
							'default' => '',
						),
						'description'        => array(
							'type'    => 'string',
							'default' => '',
						),
						// Button attributes
						'link'               => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_text'          => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_style'         => array(
							'type'    => 'string',
							'default' => '',
						),
						'link_image'         => array(
							'type'    => 'number',
							'default' => 0,
						),
						'link_image_url'     => array(
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
					'render_callback' => 'trx_addons_gutenberg_sc_points_render_block',
				)
			);
		} else {
			return;
		}
	}
}

// Block render
if ( ! function_exists( 'trx_addons_gutenberg_sc_points_render_block' ) ) {
	function trx_addons_gutenberg_sc_points_render_block( $attributes = array() ) {
		return trx_addons_sc_points( $attributes );
	}
}

// Return list of allowed layouts
if ( ! function_exists( 'trx_addons_gutenberg_sc_points_get_layouts' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_layouts', 'trx_addons_gutenberg_sc_points_get_layouts', 10, 1 );
	function trx_addons_gutenberg_sc_points_get_layouts( $array = array() ) {
		$array['trx_sc_points'] = apply_filters(
			'trx_addons_sc_type', array(
				'default' => esc_html__( 'Default', 'trx_addons' ),
			), 'trx_sc_points'
		);

		return $array;
	}
}



// Add shortcode's specific vars to the JS storage
if ( ! function_exists( 'trx_addons_gutenberg_sc_sport_params' ) ) {
	add_filter( 'trx_addons_filter_gutenberg_sc_params', 'trx_addons_gutenberg_sc_sport_params' );
	function trx_addons_gutenberg_sc_sport_params( $vars = array() ) {
		if ( trx_addons_exists_gutenberg() && trx_addons_get_setting( 'allow_gutenberg_blocks' ) ) {

			$vars['sc_sport_default'] = trx_addons_get_option( 'sport_favorite' );

			// Return list of sports
			$vars['sc_sports_list'] = trx_addons_get_list_terms( false, TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY );

			// Return list of competition
			$rounds_list                        = array();
			$vars['sc_sport_competitions_list'] = array();
			foreach ( $vars['sc_sports_list'] as $key => $value ) {
				$vars['sc_sport_competitions_list'][ $key ] = trx_addons_get_list_posts(
					false, array(
						'post_type'      => TRX_ADDONS_CPT_COMPETITIONS_PT,
						'taxonomy'       => TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY,
						'taxonomy_value' => $key,
						'meta_key'       => 'trx_addons_competition_date',
						'orderby'        => 'meta_value',
						'order'          => 'ASC',
						'not_selected'   => false,
					)
				);

				foreach ( $vars['sc_sport_competitions_list'][ $key ] as $key2 => $value2 ) {
					$rounds_list[ $key2 ] = trx_addons_get_list_posts(
						false, array(
							'post_type'    => TRX_ADDONS_CPT_ROUNDS_PT,
							'post_parent'  => $key2,
							'meta_key'     => 'trx_addons_round_date',
							'orderby'      => 'meta_value',
							'order'        => 'ASC',
							'not_selected' => false,
						)
					);
				}
			}

			// Return list of rounds
			$vars['sc_sport_rounds_list'] = array(
				'last' => esc_html__( 'Last round', 'trx_addons' ),
				'next' => esc_html__( 'Next round', 'trx_addons' ),
			);
			$vars['sc_sport_rounds_list'] = trx_addons_array_merge( $vars['sc_sport_rounds_list'], $rounds_list );

			// Return list of positions
			$vars['sc_sport_positions'] = trx_addons_get_list_sc_matches_positions();

			return $vars;
		}
	}
}
