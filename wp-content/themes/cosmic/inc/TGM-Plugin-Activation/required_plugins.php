<?php
function cosmic_register_required_plugins() {
	$plugins = array(
			array(
				'name'			   => esc_html( 'WPBakery Page Builder' ),
				'slug'			   => 'js_composer',
				'source'			 => 'js_composer.zip',
				'required'		   => true,
				'version'			=> '5.5.4',
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'			   => esc_html( 'Advanced Custom Fields Pro' ),
				'slug'			   => 'advanced-custom-fields-pro',
				'source'			 => 'advanced-custom-fields-pro.zip',
				'required'		   => true,
				'version'			=> '5.7.6',
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'			   => esc_html( 'Contact Form 7' ),
				'slug'			   => 'contact-form-7',
			),
			array(
				'name'			   => esc_html( 'MailChimp for WordPress' ),
				'slug'			   => 'mailchimp-for-wp',
			),
		);
		$config = array(
			'id'		   => 'cosmic_theme',
			'default_path' => get_template_directory() . '/inc/TGM-Plugin-Activation/plugins/',
			'menu'		 => 'cosmic-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'	  => '',
		);

		tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'cosmic_register_required_plugins' );
