<?php
/**
 * ThemeREX Addons: Sports Reviews Management (SRM).
 *                  Support different sports, championships, rounds, matches and players.
 *                  (SOP support)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.6.17
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Matches extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_matches',
				esc_html__('ThemeREX Matches', 'trx_addons'),
				array(
					'classname' => 'widget_matches',
					'description' => __('Display matches', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			// Prepare lists
			list($vc_edit, $vc_params) = trx_addons_get_sow_form_params('TRX_Addons_SOW_Widget_Matches');
			// Prepare lists
			$sports_list = trx_addons_get_list_terms(false, TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY);
			$sport_default = trx_addons_get_option('sport_favorite');
			$sport = $vc_edit && !empty($vc_params['sport']) ? $vc_params['sport'] : $sport_default;
			if (empty($sport) && count($sports_list) > 0) {
				$keys = array_keys($sports_list);
				$sport = $keys[0];
			}
			$competitions_list = trx_addons_get_list_posts(false, array(
															'post_type' => TRX_ADDONS_CPT_COMPETITIONS_PT,
															'taxonomy' => TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY,
															'taxonomy_value' => $sport,
															'meta_key' => 'trx_addons_competition_date',
															'orderby' => 'meta_value',
															'order' => 'ASC',
															'not_selected' => false
															));
			$competition = $vc_edit && !empty($vc_params['competition']) ? $vc_params['competition'] : '';
			if ((empty($competition) || !isset($competitions_list[$competition])) && count($competitions_list) > 0) {
				$keys = array_keys($competitions_list);
				$competition = $keys[0];
			}
			$rounds_list = trx_addons_array_merge(array(
												'last' => esc_html__('Last round', 'trx_addons'),
												'next' => esc_html__('Next round', 'trx_addons')
												), trx_addons_get_list_posts(false, array(
															'post_type' => TRX_ADDONS_CPT_ROUNDS_PT,
															'post_parent' => $competition,
															'meta_key' => 'trx_addons_round_date',
															'orderby' => 'meta_value',
															'order' => 'ASC',
															'not_selected' => false
															)
												)
							);
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', array(
							'default' => esc_html__('Default', 'trx_addons')
						), $this->get_sc_name()),
						'type' => 'select'
					),
					"sport" => array(
						"label" => esc_html__("Sport", 'trx_addons'),
						"description" => wp_kses_data( __("Select Sport to display matches", 'trx_addons') ),
						"default" => $sport_default,
						"options" => $sports_list,
						"type" => "select"
					),
					"competition" => array(
						"label" => esc_html__("Competition", 'trx_addons'),
						"description" => wp_kses_data( __("Select competition to display matches", 'trx_addons') ),
						"default" => 0,
						"options" => $competitions_list,
						"type" => "select_dynamic"
					),
					"round" => array(
						"label" => esc_html__("Round", 'trx_addons'),
						"description" => wp_kses_data( __("Select round to display matches", 'trx_addons') ),
						"default" => 0,
						"options" => $rounds_list,
						"type" => "select_dynamic"
					),
					"main_matches" => array(
						"label" => esc_html__("Main matches", 'trx_addons'),
						"description" => wp_kses_data( __("Show large items marked as main match of the round", 'trx_addons') ),
						'state_emitter' => array(
							'callback' => 'conditional',
							'args'     => array(
								'matches[show]: val',
								'matches[hide]: !val',
							)
						),
						"default" => false,
						"type" => "checkbox"
					),
					"position" => array(
						"label" => esc_html__("Position of the matches list", 'trx_addons'),
						"description" => wp_kses_data( __("Select the position of the matches list", 'trx_addons') ),
						'state_handler' => array(
							"matches[show]" => array('show'),
							"matches[hide]" => array('hide')
						),
						"default" => "top",
						"options" => trx_addons_get_list_sc_matches_positions(),
						"type" => "select"
					),
					"slider" => array(
						"label" => esc_html__("Slider", 'trx_addons'),
						"description" => wp_kses_data( __("Show main matches as slider (if two and more)", 'trx_addons') ),
						'state_handler' => array(
							"matches[show]" => array('show'),
							"matches[hide]" => array('hide')
						),
						"default" => false,
						"type" => "checkbox"
					)
				),
				trx_addons_sow_add_query_param('', array(), array('columns')),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_matches', __FILE__, 'TRX_Addons_SOW_Widget_Matches');
}



// SOW Widget
//------------------------------------------------------
if (class_exists('TRX_Addons_SOW_Widget')) {
	class TRX_Addons_SOW_Widget_Points extends TRX_Addons_SOW_Widget {
		
		function __construct() {
			parent::__construct(
				'trx_addons_sow_widget_points',
				esc_html__('ThemeREX Points', 'trx_addons'),
				array(
					'classname' => 'widget_points',
					'description' => __('Display players table with points', 'trx_addons')
				),
				array(),
				false,
				TRX_ADDONS_PLUGIN_DIR
			);
	
		}


		// Return array with all widget's fields
		function get_widget_form() {
			// If open params in SOW Editor
			list($vc_edit, $vc_params) = trx_addons_get_sow_form_params('TRX_Addons_SOW_Widget_Points');
			// Prepare lists
			$sports_list = trx_addons_get_list_terms(false, TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY);
			$sport_default = trx_addons_get_option('sport_favorite');
			$sport = $vc_edit && !empty($vc_params['sport']) ? $vc_params['sport'] : $sport_default;
			if (empty($sport) && count($sports_list) > 0) {
				$keys = array_keys($sports_list);
				$sport = $keys[0];
			}
			$competitions_list = trx_addons_get_list_posts(false, array(
															'post_type' => TRX_ADDONS_CPT_COMPETITIONS_PT,
															'taxonomy' => TRX_ADDONS_CPT_COMPETITIONS_TAXONOMY,
															'taxonomy_value' => $sport,
															'meta_key' => 'trx_addons_competition_date',
															'orderby' => 'meta_value',
															'order' => 'ASC',
															'not_selected' => false
															));
			return apply_filters('trx_addons_sow_map', array_merge(
				array(
					'type' => array(
						'label' => __('Layout', 'trx_addons'),
						"description" => wp_kses_data( __("Select shortcodes's layout", 'trx_addons') ),
						'default' => 'default',
						'options' => apply_filters('trx_addons_sc_type', array(
							'default' => esc_html__('Default', 'trx_addons')
						), $this->get_sc_name()),
						'type' => 'select'
					),
					"sport" => array(
						"label" => esc_html__("Sport", 'trx_addons'),
						"description" => wp_kses_data( __("Select Sport to display points table", 'trx_addons') ),
						"default" => $sport_default,
						"options" => $sports_list,
						"type" => "select"
					),
					"competition" => array(
						"label" => esc_html__("Competition", 'trx_addons'),
						"description" => wp_kses_data( __("Select competition to display points table", 'trx_addons') ),
						"default" => 0,
						"options" => $competitions_list,
						"type" => "select_dynamic"
					),
					"logo" => array(
						"label" => esc_html__("Logo", 'trx_addons'),
						"description" => wp_kses_data( __("Show logo (players photo) in the table", 'trx_addons') ),
						"default" => false,
						"type" => "checkbox"
					),
					"accented_top" => array(
						"label" => esc_html__("Accented top", 'trx_addons'),
						"description" => wp_kses_data( __("How many rows should be accented at the top of the table?", 'trx_addons') ),
						"default" => 3,
						"type" => "number"
					),
					"accented_bottom" => array(
						"label" => esc_html__("Accented bottom", 'trx_addons'),
						"description" => wp_kses_data( __("How many rows should be accented at the bottom of the table?", 'trx_addons') ),
						"default" => 3,
						"type" => "number"
					)
				),
				trx_addons_sow_add_title_param(),
				trx_addons_sow_add_id_param()
			), $this->get_sc_name());
		}

	}
	siteorigin_widget_register('trx_addons_sow_widget_points', __FILE__, 'TRX_Addons_SOW_Widget_Points');
}
