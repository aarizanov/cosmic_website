<div class="front_page_section front_page_section_contacts<?php
	$vixus_scheme = vixus_get_theme_option( 'front_page_contacts_scheme' );
	if ( ! vixus_is_inherit( $vixus_scheme ) ) {
		echo ' scheme_' . esc_attr( $vixus_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( vixus_get_theme_option( 'front_page_contacts_paddings' ) );
?>"
		<?php
		$vixus_css      = '';
		$vixus_bg_image = vixus_get_theme_option( 'front_page_contacts_bg_image' );
		if ( ! empty( $vixus_bg_image ) ) {
			$vixus_css .= 'background-image: url(' . esc_url( vixus_get_attachment_url( $vixus_bg_image ) ) . ');';
		}
		if ( ! empty( $vixus_css ) ) {
			echo ' style="' . esc_attr( $vixus_css ) . '"';
		}
		?>
>
<?php
	// Add anchor
	$vixus_anchor_icon = vixus_get_theme_option( 'front_page_contacts_anchor_icon' );
	$vixus_anchor_text = vixus_get_theme_option( 'front_page_contacts_anchor_text' );
if ( ( ! empty( $vixus_anchor_icon ) || ! empty( $vixus_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_contacts"'
									. ( ! empty( $vixus_anchor_icon ) ? ' icon="' . esc_attr( $vixus_anchor_icon ) . '"' : '' )
									. ( ! empty( $vixus_anchor_text ) ? ' title="' . esc_attr( $vixus_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_contacts_inner
	<?php
	if ( vixus_get_theme_option( 'front_page_contacts_fullheight' ) ) {
		echo ' vixus-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$vixus_css      = '';
			$vixus_bg_mask  = vixus_get_theme_option( 'front_page_contacts_bg_mask' );
			$vixus_bg_color_type = vixus_get_theme_option( 'front_page_contacts_bg_color_type' );
			if ( 'custom' == $vixus_bg_color_type ) {
				$vixus_bg_color = vixus_get_theme_option( 'front_page_contacts_bg_color' );
			} elseif ( 'scheme_bg_color' == $vixus_bg_color_type ) {
				$vixus_bg_color = vixus_get_scheme_color( 'bg_color', $vixus_scheme );
			} else {
				$vixus_bg_color = '';
			}
			if ( ! empty( $vixus_bg_color ) && $vixus_bg_mask > 0 ) {
				$vixus_css .= 'background-color: ' . esc_attr(
					1 == $vixus_bg_mask ? $vixus_bg_color : vixus_hex2rgba( $vixus_bg_color, $vixus_bg_mask )
				) . ';';
			}
			if ( ! empty( $vixus_css ) ) {
				echo ' style="' . esc_attr( $vixus_css ) . '"';
			}
			?>
	>
		<div class="front_page_section_content_wrap front_page_section_contacts_content_wrap content_wrap">
			<?php

			// Title and description
			$vixus_caption     = vixus_get_theme_option( 'front_page_contacts_caption' );
			$vixus_description = vixus_get_theme_option( 'front_page_contacts_description' );
			if ( ! empty( $vixus_caption ) || ! empty( $vixus_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				// Caption
				if ( ! empty( $vixus_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<h2 class="front_page_section_caption front_page_section_contacts_caption front_page_block_<?php echo ! empty( $vixus_caption ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( $vixus_caption, 'vixus_kses_content' );
					?>
					</h2>
					<?php
				}

				// Description
				if ( ! empty( $vixus_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
					?>
					<div class="front_page_section_description front_page_section_contacts_description front_page_block_<?php echo ! empty( $vixus_description ) ? 'filled' : 'empty'; ?>">
					<?php
						echo wp_kses( wpautop( $vixus_description ), 'vixus_kses_content' );
					?>
					</div>
					<?php
				}
			}

			// Content (text)
			$vixus_content = vixus_get_theme_option( 'front_page_contacts_content' );
			$vixus_layout  = vixus_get_theme_option( 'front_page_contacts_layout' );
			if ( 'columns' == $vixus_layout && ( ! empty( $vixus_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_columns front_page_section_contacts_columns columns_wrap">
					<div class="column-1_3">
				<?php
			}

			if ( ( ! empty( $vixus_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				<div class="front_page_section_content front_page_section_contacts_content front_page_block_<?php echo ! empty( $vixus_content ) ? 'filled' : 'empty'; ?>">
				<?php
					echo wp_kses( $vixus_content, 'vixus_kses_content' );
				?>
				</div>
				<?php
			}

			if ( 'columns' == $vixus_layout && ( ! empty( $vixus_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div><div class="column-2_3">
				<?php
			}

			// Shortcode output
			$vixus_sc = vixus_get_theme_option( 'front_page_contacts_shortcode' );
			if ( ! empty( $vixus_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_contacts_output front_page_block_<?php echo ! empty( $vixus_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					vixus_show_layout( do_shortcode( $vixus_sc ) );
				?>
				</div>
				<?php
			}

			if ( 'columns' == $vixus_layout && ( ! empty( $vixus_content ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) ) {
				?>
				</div></div>
				<?php
			}
			?>

		</div>
	</div>
</div>
