<?php
/**
 * The template to display Admin notices
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0.1
 */

$vixus_theme_obj = wp_get_theme();
?>
<div class="vixus_admin_notice vixus_welcome_notice update-nag">
	<?php
	// Theme image
	$vixus_theme_img = vixus_get_file_url( 'screenshot.jpg' );
	if ( '' != $vixus_theme_img ) {
		?>
		<div class="vixus_notice_image"><img src="<?php echo esc_url( $vixus_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'vixus' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="vixus_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'vixus' ),
				$vixus_theme_obj->name . ( VIXUS_THEME_FREE ? ' ' . esc_html__( 'Free', 'vixus' ) : '' ),
				$vixus_theme_obj->version
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="vixus_notice_text">
		<p class="vixus_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $vixus_theme_obj->description ) );
			?>
		</p>
		<p class="vixus_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'vixus' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="vixus_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=vixus_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'vixus' );
			?>
		</a>
		<?php		
		// Dismiss this notice
		?>
		<a href="#" class="vixus_hide_notice"><i class="dashicons dashicons-dismiss"></i> <span class="vixus_hide_notice_text"><?php esc_html_e( 'Dismiss', 'vixus' ); ?></span></a>
	</div>
</div>
