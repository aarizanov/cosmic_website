<?php
/**
 * ThemeREX Addons Custom post type: Team (Widget)
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.2
 */

// Don't load directly
if ( ! defined( 'TRX_ADDONS_VERSION' ) ) {
	die( '-1' );
}



// TRX_Addons Widget
//------------------------------------------------------
if ( ! class_exists('TRX_Addons_SOW_Widget') ) {

	class TRX_Addons_SOW_Widget_Team extends TRX_Addons_Widget {
	
		function __construct() {
			$widget_ops = array('classname' => 'widget_team', 'description' => esc_html__('Show Team members', 'trx_addons'));
			parent::__construct( 'trx_addons_sow_widget_team', esc_html__('ThemeREX Team members', 'trx_addons'), $widget_ops );
		}
	
		// Show widget
		function widget($args, $instance) {
			extract($args);
	
			$widget_title = apply_filters('widget_title', isset($instance['widget_title']) ? $instance['widget_title'] : '');
	
			$output = trx_addons_sc_team(apply_filters('trx_addons_filter_widget_args',
														$instance,
														$instance, 'trx_addons_sow_widget_team')
														);
	
			if (!empty($output)) {
		
				// Before widget (defined by themes)
				trx_addons_show_layout($before_widget);
				
				// Display the widget title if one was input (before and after defined by themes)
				if ($widget_title) trx_addons_show_layout($before_title . $widget_title . $after_title);
		
				// Display widget body
				trx_addons_show_layout($output);
				
				// After widget (defined by themes)
				trx_addons_show_layout($after_widget);
			}
		}
	
		// Update the widget settings
		function update($new_instance, $instance) {
			$instance = array_merge($instance, $new_instance);
			$instance['no_links'] = isset( $new_instance['no_links'] ) ? 1 : 0;
			$instance['slider'] = isset( $new_instance['slider'] ) ? 1 : 0;
			$instance['slides_centered'] = isset( $new_instance['slides_centered'] ) ? 1 : 0;
			$instance['slides_overflow'] = isset( $new_instance['slides_overflow'] ) ? 1 : 0;
			$instance['slider_mouse_wheel'] = isset( $new_instance['slider_mouse_wheel'] ) ? 1 : 0;
			$instance['slider_autoplay'] = isset( $new_instance['slider_autoplay'] ) ? 1 : 0;
			return apply_filters('trx_addons_filter_widget_args_update', $instance, $new_instance, 'trx_addons_sow_widget_team');
		}
	
		// Displays the widget settings controls on the widget panel
		function form($instance) {
			// Set up some default widget settings
			$instance = wp_parse_args( (array) $instance, apply_filters('trx_addons_filter_widget_args_default', array(
				'widget_title' => '',
				// Layout params
				"type" => "default",
				"no_links" => 0,
				"more_text" => __('Read more', 'trx_addons'),
				// Query params
				'pagination' => 'none',
				"cat" => "",
				"columns" => "",
				"count" => 3,
				"offset" => 0,
				"orderby" => '',
				"order" => '',
				"ids" => '',
				// Slider params
				"slider" => 0,
				"slider_pagination" => "none",
				"slider_controls" => "none",
				"slides_space" => 0,
				"slides_centered" => 0,
				"slides_overflow" => 0,
				"slider_mouse_wheel" => 0,
				"slider_autoplay" => 1,
				// Title params
				"title" => "",
				"subtitle" => "",
				"description" => "",
				"link" => '',
				"link_style" => 'default',
				"link_image" => '',
				"link_text" => esc_html__('Learn more', 'trx_addons'),
				"title_align" => "left",
				"title_style" => "default",
				"title_tag" => '',
				"title_color" => '',
				"title_color2" => '',
				"gradient_direction" => '',
				// Common params
				"id" => "",
				"class" => "",
				"css" => ""
				), 'trx_addons_sow_widget_team')
			);
		
			do_action('trx_addons_action_before_widget_fields', $instance, 'trx_addons_sow_widget_team');
			
			$this->show_field(array('name' => 'widget_title',
									'title' => __('Widget title:', 'trx_addons'),
									'value' => $instance['widget_title'],
									'type' => 'text'));
		
			do_action('trx_addons_action_after_widget_title', $instance, 'trx_addons_sow_widget_team');
			
			$this->show_field(array('name' => 'type',
									'title' => __('Layout:', 'trx_addons'),
									'value' => $instance['type'],
									'options' => apply_filters('trx_addons_sc_type', trx_addons_components_get_allowed_layouts('cpt', 'team', 'sc'), 'trx_widget_team'),
									'type' => 'select'));

			$this->show_field(array('name' => 'no_links',
									'title' => '',
									'label' => __('Disable links', 'trx_addons'),
									'value' => (int) $instance['no_links'],
									'type' => 'checkbox'));
			
			$this->show_field(array('name' => 'more_text',
									'title' => __("'More' text", 'trx_addons'),
									'value' => (int) $instance['more_text'],
									'type' => 'text'));
			
			$this->show_field(array('title' => __('Query parameters', 'trx_addons'),
									'type' => 'info'));

			$this->show_field(array('name' => 'pagination',
									'title' => __('Pagination:', 'trx_addons'),
									'value' => $instance['pagination'],
									'options' => trx_addons_get_list_sc_paginations(),
									'type' => 'select'));

			$this->show_field(array('name' => 'cat',
									'title' => __('Team Group:', 'trx_addons'),
									'value' => $instance['cat'],
									'options' => trx_addons_array_merge(
													array(0 => esc_html__('- Select group -', 'trx_addons')),
													trx_addons_get_list_terms(false, TRX_ADDONS_CPT_TEAM_TAXONOMY)
													),
									'type' => 'select'));
			
			$this->show_fields_query_param($instance, '');
			$this->show_fields_slider_param($instance);
			$this->show_fields_title_param($instance);
			$this->show_fields_id_param($instance);
		
			do_action('trx_addons_action_after_widget_fields', $instance, 'trx_addons_sow_widget_team');
		}
	}

	// Load widget
	if (!function_exists('trx_addons_sow_widget_team_load')) {
		add_action( 'widgets_init', 'trx_addons_sow_widget_team_load' );
		function trx_addons_sow_widget_team_load() {
			register_widget('TRX_Addons_SOW_Widget_Team');
		}
	}
}
