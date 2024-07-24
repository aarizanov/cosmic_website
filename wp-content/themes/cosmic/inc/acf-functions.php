<?php

// Adding options page
if ( function_exists( 'acf_add_options_page' ) ) {
	$options_args = array(
		'page_title' => 'Cosmic Options',
		'capability' => 'edit_posts',
		'icon_url' => 'dashicons-star-filled',
	);
	acf_add_options_page( $options_args );
}

// Populate job position select
// with values from theme options
function acf_load_job_location_choices( $field ) {
	$field['choices'] = array();
	if ( function_exists( 'get_field' ) ) {
		$position_repeater = get_field( 'job_positions_repeater', 'options' );
		if ( isset( $position_repeater ) && ! empty( $position_repeater ) && is_array( $position_repeater ) ) {
			foreach ( $position_repeater as $position_array ) {
				if ( is_array( $position_array ) ) {
					if ( array_key_exists( 'loaction', $position_array ) ) {
						$choice_label = $position_array['loaction'];
						$choice_id = '';
						if ( $choice_label ) {
							$choice_id = strtolower( esc_attr( $choice_label ) );
						}
						if ( $choice_label && $choice_id ) {
							$field['choices'][ $choice_id ] = $choice_label;
						}
					}
				}
			}
		}
	}
	return $field;
}
add_filter( 'acf/load_field/name=location', 'acf_load_job_location_choices' );
