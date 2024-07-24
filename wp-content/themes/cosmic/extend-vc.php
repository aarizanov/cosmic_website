<?php

// Remove full width param
vc_remove_param( 'vc_row', 'full_width' );

// Add params
vc_add_param( 'vc_row', array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => esc_html__( 'Type', 'cosmic' ),
	'param_name' => 'row_type',
	'value' => array(
		esc_html__( 'Full Width', 'cosmic' ) => 'full',
		esc_html__( 'Boxed', 'cosmic' ) => 'box',
	),
	'weight' => 1,
));
vc_add_param( 'vc_row', array(
	'type' => 'checkbox',
	'class' => '',
	'heading' => esc_html__( 'Change row display', 'cosmic' ),
	'description' => esc_html__( 'Change display type from static to relative. Can help with jump arrows positioning.', 'cosmic' ),
	'param_name' => 'row_display_type',
));
vc_add_param( 'vc_row_inner', array(
	'type' => 'dropdown',
	'class' => '',
	'heading' => esc_html( __( 'Type', 'cosmic' ) ),
	'param_name' => 'inner_row_type',
	'value' => array(
		esc_html__( 'Full Width', 'cosmic' ) => 'full',
		esc_html__( 'Boxed', 'cosmic' ) => 'box',
	),
	'weight' => 1,
));
