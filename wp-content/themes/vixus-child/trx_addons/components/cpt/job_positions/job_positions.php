<?php
/**
 * ThemeREX Addons Custom post type: Services
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}


// -----------------------------------------------------------------
// -- Custom post type registration
// -----------------------------------------------------------------

// Define Custom post type and taxonomy constants
if ( ! defined('TRX_ADDONS_CPT_JOB_POSITIONS_PT') ) define('TRX_ADDONS_CPT_JOB_POSITIONS_PT', trx_addons_cpt_param('job_positions', 'post_type'));
if ( ! defined('TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY') ) define('TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY', trx_addons_cpt_param('job_positions', 'taxonomy'));

// Register post type and taxonomy
if (!function_exists('trx_addons_cpt_job_positions_init')) {
	add_action( 'init', 'trx_addons_cpt_job_positions_init' );
	function trx_addons_cpt_job_positions_init() {
		
		// Add Services parameters to the Meta Box support
		trx_addons_meta_box_register(TRX_ADDONS_CPT_JOB_POSITIONS_PT, array(
			"price" => array(
				"title" => esc_html__("Price",  'trx_addons'),
				"desc" => wp_kses_data( __("The price of the item", 'trx_addons') ),
				"std" => "",
				"type" => "text"
			),
			"product" => array(
				"title" => __('Select linked product',  'trx_addons'),
				"desc" => __("Product linked with this job position item", 'trx_addons'),
				"std" => '',
				"options" => array(),
				"type" => "select2"
			),
			"icon" => array(
				"title" => esc_html__("Item's icon", 'trx_addons'),
				"desc" => '',
				"std" => '',
				"options" => array(),
				"style" => trx_addons_get_setting('icons_type'),
				"type" => "icons"
			),
			"icon_color" => array(
				"title" => esc_html__("Icon's color", 'trx_addons'),
				"desc" => '',
				"std" => '',
				"type" => "color"
			),
			"image" => array(
				"title" => esc_html__("Item's pictogram", 'trx_addons'),
				"desc" => '',
				"std" => '',
				"button_caption" => esc_html__('Choose', 'trx_addons'),
				"type" => "image"
			),
			"link" => array(
				"title" => esc_html__("Alternative link",  'trx_addons'),
				"desc" => wp_kses_data( __("Alternative link to the job position's site. If empty - use this post's permalink", 'trx_addons') ),
				"std" => "",
				"type" => "text"
			),
		));
		
		// Register post type and taxonomy
		register_post_type(
			TRX_ADDONS_CPT_JOB_POSITIONS_PT,
			apply_filters('trx_addons_filter_register_post_type',
				array(
					'label'               => esc_html__( 'Services', 'trx_addons' ),
					'description'         => esc_html__( 'Service Description', 'trx_addons' ),
					'labels'              => array(
						'name'                => esc_html__( 'Services', 'trx_addons' ),
						'singular_name'       => esc_html__( 'Service', 'trx_addons' ),
						'menu_name'           => esc_html__( 'Services', 'trx_addons' ),
						'parent_item_colon'   => esc_html__( 'Parent Item:', 'trx_addons' ),
						'all_items'           => esc_html__( 'All Services', 'trx_addons' ),
						'view_item'           => esc_html__( 'View Service', 'trx_addons' ),
						'add_new_item'        => esc_html__( 'Add New Service', 'trx_addons' ),
						'add_new'             => esc_html__( 'Add New', 'trx_addons' ),
						'edit_item'           => esc_html__( 'Edit Service', 'trx_addons' ),
						'update_item'         => esc_html__( 'Update Service', 'trx_addons' ),
						'search_items'        => esc_html__( 'Search Service', 'trx_addons' ),
						'not_found'           => esc_html__( 'Not found', 'trx_addons' ),
						'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'trx_addons' ),
					),
					'taxonomies'          => array(TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY),
					'supports'            => trx_addons_cpt_param('job_positions', 'supports'),
					'public'              => true,
					'hierarchical'        => false,
					'has_archive'         => true,
					'can_export'          => true,
					'show_in_admin_bar'   => true,
					'show_in_menu'        => true,
                    'show_in_rest'        => true,
					'menu_position'       => '53.6',
					'menu_icon'			  => 'dashicons-hammer',
					'capability_type'     => 'post',
					'rewrite'             => array( 'slug' => trx_addons_cpt_param('job_positions', 'post_type_slug') )
				),
				TRX_ADDONS_CPT_JOB_POSITIONS_PT
			)
		);

		register_taxonomy(
			TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY,
			TRX_ADDONS_CPT_JOB_POSITIONS_PT,
			apply_filters('trx_addons_filter_register_taxonomy',
				array(
					'post_type' 		=> TRX_ADDONS_CPT_JOB_POSITIONS_PT,
					'hierarchical'      => true,
					'labels'            => array(
						'name'              => esc_html__( 'Services Group', 'trx_addons' ),
						'singular_name'     => esc_html__( 'Group', 'trx_addons' ),
						'search_items'      => esc_html__( 'Search Groups', 'trx_addons' ),
						'all_items'         => esc_html__( 'All Groups', 'trx_addons' ),
						'parent_item'       => esc_html__( 'Parent Group', 'trx_addons' ),
						'parent_item_colon' => esc_html__( 'Parent Group:', 'trx_addons' ),
						'edit_item'         => esc_html__( 'Edit Group', 'trx_addons' ),
						'update_item'       => esc_html__( 'Update Group', 'trx_addons' ),
						'add_new_item'      => esc_html__( 'Add New Group', 'trx_addons' ),
						'new_item_name'     => esc_html__( 'New Group Name', 'trx_addons' ),
						'menu_name'         => esc_html__( 'Services Groups', 'trx_addons' ),
					),
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
					'rewrite'           => array( 'slug' => trx_addons_cpt_param('job_positions', 'taxonomy_slug') )
				),
				TRX_ADDONS_CPT_JOB_POSITIONS_PT,
				TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY
			)
		);
	}
}


// Allow Gutenberg as main editor for this post type
if ( ! function_exists( 'trx_addons_cpt_job_positions_add_pt_to_gutenberg' ) ) {
	add_filter( 'trx_addons_filter_add_pt_to_gutenberg', 'trx_addons_cpt_job_positions_add_pt_to_gutenberg', 10, 2 );
	function trx_addons_cpt_job_positions_add_pt_to_gutenberg( $allow, $post_type ) {
		return $allow || $post_type == TRX_ADDONS_CPT_JOB_POSITIONS_PT;
	}
}

// Allow Gutenberg as main editor for taxonomies
if ( ! function_exists( 'trx_addons_cpt_job_positions_add_taxonomy_to_gutenberg' ) ) {
	add_filter( 'trx_addons_filter_add_taxonomy_to_gutenberg', 'trx_addons_cpt_job_positions_add_taxonomy_to_gutenberg', 10, 2 );
	function trx_addons_cpt_job_positions_add_taxonomy_to_gutenberg( $allow, $tax ) {
		return $allow || in_array( $tax, array( TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY ) );
	}
}


// Fill 'options' arrays when its need in the admin mode
if (!function_exists('trx_addons_cpt_job_positions_before_show_options')) {
	add_filter('trx_addons_filter_before_show_options', 'trx_addons_cpt_job_positions_before_show_options', 10, 2);
	function trx_addons_cpt_job_positions_before_show_options($options, $post_type, $group='') {
		if ($post_type == TRX_ADDONS_CPT_JOB_POSITIONS_PT) {
			foreach ($options as $id=>$field) {
				// Recursive call for options type 'group'
				if ($field['type'] == 'group' && !empty($field['fields'])) {
					$options[$id]['fields'] = trx_addons_cpt_courses_before_show_options($field['fields'], $post_type, $id);
					continue;
				}
				// Skip elements without param 'options'
				if (!isset($field['options']) || count($field['options'])>0) {
					continue;
				}
				// Fill the 'product' array
				if ($id == 'product') {
					$options[$id]['options'] = trx_addons_get_list_posts(false, 'product');
				}
			}
		}
		return $options;
	}
}

/* ------------------- Old way - moved to the cpt.php now ---------------------
// Add 'Services' parameters in the ThemeREX Addons Options
if (!function_exists('trx_addons_cpt_job_positions_options')) {
	add_filter( 'trx_addons_filter_options', 'trx_addons_cpt_job_positions_options');
	function trx_addons_cpt_job_positions_options($options) {
		trx_addons_array_insert_after($options, 'cpt_section', trx_addons_cpt_job_positions_get_list_options());
		return $options;
	}
}

// Return parameters list for plugin's options
if (!function_exists('trx_addons_cpt_job_positions_get_list_options')) {
	function trx_addons_cpt_job_positions_get_list_options($add_parameters=array()) {
		return apply_filters('trx_addons_cpt_list_options', array(
			'job_positions_info' => array(
				"title" => esc_html__('Services', 'trx_addons'),
				"desc" => wp_kses_data( __('Settings of the job_positions archive', 'trx_addons') ),
				"type" => "info"
			),
			'job_positions_style' => array(
				"title" => esc_html__('Style', 'trx_addons'),
				"desc" => wp_kses_data( __('Style of the job_positions archive', 'trx_addons') ),
				"std" => 'default_2',
				"options" => apply_filters('trx_addons_filter_cpt_archive_styles', 
											trx_addons_components_get_allowed_layouts('cpt', 'job_positions', 'arh'),
											TRX_ADDONS_CPT_JOB_POSITIONS_PT),
				"type" => "select"
			)
		), 'job_positions');
	}
}
------------------- /Old way --------------------- */

	
// Merge shortcode's specific styles to the single stylesheet
if ( !function_exists( 'trx_addons_cpt_job_positions_merge_styles' ) ) {
	add_filter("trx_addons_filter_merge_styles", 'trx_addons_cpt_job_positions_merge_styles');
	function trx_addons_cpt_job_positions_merge_styles($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT . 'job_positions/_job_positions.scss';
		return $list;
	}
}


// Merge shortcode's specific styles to the single stylesheet (responsive)
if ( !function_exists( 'trx_addons_cpt_job_positions_merge_styles_responsive' ) ) {
	add_filter("trx_addons_filter_merge_styles_responsive", 'trx_addons_cpt_job_positions_merge_styles_responsive');
	function trx_addons_cpt_job_positions_merge_styles_responsive($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT . 'job_positions/_job_positions.responsive.scss';
		return $list;
	}
}

	
// Merge shortcode's specific scripts to the single file
if ( !function_exists( 'trx_addons_cpt_job_positions_merge_scripts' ) ) {
	add_action("trx_addons_filter_merge_scripts", 'trx_addons_cpt_job_positions_merge_scripts');
	function trx_addons_cpt_job_positions_merge_scripts($list) {
		$list[] = TRX_ADDONS_PLUGIN_CPT . 'job_positions/job_positions.js';
		return $list;
	}
}


// Return true if it's job_positions page
if ( !function_exists( 'trx_addons_is_job_positions_page' ) ) {
	function trx_addons_is_job_positions_page() {
		return defined('TRX_ADDONS_CPT_JOB_POSITIONS_PT') 
					&& !is_search()
					&& (
						(is_single() && get_post_type()==TRX_ADDONS_CPT_JOB_POSITIONS_PT)
						|| is_post_type_archive(TRX_ADDONS_CPT_JOB_POSITIONS_PT)
						|| is_tax(TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY)
						);
	}
}


// Return current page title
if ( !function_exists( 'trx_addons_cpt_job_positions_get_blog_title' ) ) {
	add_filter( 'trx_addons_filter_get_blog_title', 'trx_addons_cpt_job_positions_get_blog_title');
	function trx_addons_cpt_job_positions_get_blog_title($title='') {
		if ( defined('TRX_ADDONS_CPT_JOB_POSITIONS_PT') ) {
			if (is_single() && get_post_type()==TRX_ADDONS_CPT_JOB_POSITIONS_PT) {
				$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
				$title = array(
					'text' => get_the_title(),
					'class' => 'job_positions_page_title'
				);
				if (!empty($meta['product']) && (int) $meta['product'] > 0) {
					$title['link'] = get_permalink($meta['product']);
					$title['link_text'] = esc_html__('Order now', 'trx_addons');
				}
/*
			} else if ( is_post_type_archive(TRX_ADDONS_CPT_JOB_POSITIONS_PT) ) {
				$obj = get_post_type_object(TRX_ADDONS_CPT_JOB_POSITIONS_PT);
				$title = $obj->labels->all_items;
*/
			}

		}
		return $title;
	}
}



// Replace standard theme templates
//-------------------------------------------------------------

// Change standard single template for job_positions posts
if ( !function_exists( 'trx_addons_cpt_job_positions_single_template' ) ) {
	add_filter('single_template', 'trx_addons_cpt_job_positions_single_template');
	function trx_addons_cpt_job_positions_single_template($template) {
		global $post;
		if (is_single() && $post->post_type == TRX_ADDONS_CPT_JOB_POSITIONS_PT)
			$template = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_CPT . 'job_positions/tpl.single.php');
		return $template;
	}
}

// Change standard archive template for job_positions posts
if ( !function_exists( 'trx_addons_cpt_job_positions_archive_template' ) ) {
	add_filter('archive_template',	'trx_addons_cpt_job_positions_archive_template');
	function trx_addons_cpt_job_positions_archive_template( $template ) {
		if ( is_post_type_archive(TRX_ADDONS_CPT_JOB_POSITIONS_PT) )
			$template = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_CPT . 'job_positions/tpl.archive.php');
		return $template;
	}	
}

// Change standard category template for job_positions categories (groups)
if ( !function_exists( 'trx_addons_cpt_job_positions_taxonomy_template' ) ) {
	add_filter('taxonomy_template',	'trx_addons_cpt_job_positions_taxonomy_template');
	function trx_addons_cpt_job_positions_taxonomy_template( $template ) {
		if ( is_tax(TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY) )
			$template = trx_addons_get_file_dir(TRX_ADDONS_PLUGIN_CPT . 'job_positions/tpl.archive.php');
		return $template;
	}	
}

// Show related posts
if ( !function_exists( 'trx_addons_cpt_job_positions_related_posts_after_article' ) ) {
	add_action('trx_addons_action_after_article', 'trx_addons_cpt_job_positions_related_posts_after_article', 20, 1);
	function trx_addons_cpt_job_positions_related_posts_after_article( $mode ) {
		if ($mode == 'job_positions.single' && apply_filters('trx_addons_filter_show_related_posts_after_article', true)) {
			do_action('trx_addons_action_related_posts', $mode);
		}
	}
}

if ( !function_exists( 'trx_addons_cpt_job_positions_related_posts_show' ) ) {
	add_filter('trx_addons_filter_show_related_posts', 'trx_addons_cpt_job_positions_related_posts_show');
	function trx_addons_cpt_job_positions_related_posts_show( $show ) {
		if (!$show && is_single() && get_post_type() == TRX_ADDONS_CPT_JOB_POSITIONS_PT) {
			do_action('trx_addons_action_related_posts', 'job_positions.single');
			$show = true;
		}
		return $show;
	}
}

if ( !function_exists( 'trx_addons_cpt_job_positions_related_posts' ) ) {
	add_action('trx_addons_action_related_posts', 'trx_addons_cpt_job_positions_related_posts', 10, 1);
	function trx_addons_cpt_job_positions_related_posts( $mode ) {
		if ($mode == 'job_positions.single') {
			$trx_addons_related_style   = explode('_', trx_addons_get_option('job_positions_style'));
			$trx_addons_related_type    = $trx_addons_related_style[0];
			$trx_addons_related_columns = empty($trx_addons_related_style[1]) ? 1 : max(1, $trx_addons_related_style[1]);

			trx_addons_get_template_part('templates/tpl.posts-related.php',
												'trx_addons_args_related',
												apply_filters('trx_addons_filter_args_related', array(
																	'class' => 'job_positions_page_related sc_job_positions sc_job_positions_'.esc_attr($trx_addons_related_type),
																	'posts_per_page' => $trx_addons_related_columns,
																	'columns' => $trx_addons_related_columns,
																	'template' => TRX_ADDONS_PLUGIN_CPT . 'job_positions/tpl.'.trim($trx_addons_related_type).'-item.php',
																	'template_args_name' => 'trx_addons_args_sc_job_positions',
																	'post_type' => TRX_ADDONS_CPT_JOB_POSITIONS_PT,
																	'taxonomies' => array(TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY)
																	)
															)
											);
		}
	}
}



// Admin utils
// -----------------------------------------------------------------

// Show <select> with job_positions categories in the admin filters area
if (!function_exists('trx_addons_cpt_job_positions_admin_filters')) {
	add_action( 'restrict_manage_posts', 'trx_addons_cpt_job_positions_admin_filters' );
	function trx_addons_cpt_job_positions_admin_filters() {
		trx_addons_admin_filters(TRX_ADDONS_CPT_JOB_POSITIONS_PT, TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY);
	}
}
  
// Clear terms cache on the taxonomy save
if (!function_exists('trx_addons_cpt_job_positions_admin_clear_cache')) {
	add_action( 'edited_'.TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY, 'trx_addons_cpt_job_positions_admin_clear_cache', 10, 1 );
	add_action( 'delete_'.TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY, 'trx_addons_cpt_job_positions_admin_clear_cache', 10, 1 );
	add_action( 'created_'.TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY, 'trx_addons_cpt_job_positions_admin_clear_cache', 10, 1 );
	function trx_addons_cpt_job_positions_admin_clear_cache( $term_id=0 ) {  
		trx_addons_admin_clear_cache_terms(TRX_ADDONS_CPT_JOB_POSITIONS_TAXONOMY);
	}
}


// AJAX details
// ------------------------------------------------------------
if ( !function_exists( 'trx_addons_callback_ajax_job_positions_details' ) ) {
	add_action('wp_ajax_trx_addons_post_details_in_popup',			'trx_addons_callback_ajax_job_positions_details');
	add_action('wp_ajax_nopriv_trx_addons_post_details_in_popup',	'trx_addons_callback_ajax_job_positions_details');
	function trx_addons_callback_ajax_job_positions_details() {
		if ( !wp_verify_nonce( trx_addons_get_value_gp('nonce'), admin_url('admin-ajax.php') ) )
			die();

		if (($post_type = $_REQUEST['post_type']) == TRX_ADDONS_CPT_JOB_POSITIONS_PT) {
			$post_id = $_REQUEST['post_id'];

			$response = array('error'=>'', 'data' => '');
	
			if (!empty($post_id)) {
				global $post;
				$post = get_post($post_id);
				setup_postdata( $post );
				ob_start();
				trx_addons_get_template_part(TRX_ADDONS_PLUGIN_CPT . 'job_positions/tpl.details.php');
				$response['data'] = ob_get_contents();
				ob_end_clean();
			} else {
				$response['error'] = '<article class="job_positions_page">' . esc_html__('Invalid query parameter!', 'trx_addons') . '</article>';
			}
		
			echo json_encode($response);
			die();
		}
	}
}


// Add shortcodes
//----------------------------------------------------------------------------
require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT . 'job_positions/job_positions-sc.php';

// Add shortcodes to Elementor
if ( trx_addons_exists_elementor() && function_exists('trx_addons_elm_init') ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT . 'job_positions/job_positions-sc-elementor.php';
}

// Add shortcodes to Gutenberg
if ( trx_addons_exists_gutenberg() && function_exists( 'trx_addons_gutenberg_get_param_id' ) ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT . 'job_positions/job_positions-sc-gutenberg.php';
}

// Add shortcodes to VC
if ( trx_addons_exists_vc() && function_exists( 'trx_addons_vc_add_id_param' ) ) {
	require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT . 'job_positions/job_positions-sc-vc.php';
}

// Create our widget
require_once TRX_ADDONS_PLUGIN_DIR . TRX_ADDONS_PLUGIN_CPT . 'job_positions/job_positions-widget.php';
