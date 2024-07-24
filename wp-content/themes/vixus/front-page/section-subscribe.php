<div class="front_page_section front_page_section_subscribe<?php
	$vixus_scheme = vixus_get_theme_option( 'front_page_subscribe_scheme' );
	if ( ! vixus_is_inherit( $vixus_scheme ) ) {
		echo ' scheme_' . esc_attr( $vixus_scheme );
	}
	echo ' front_page_section_paddings_' . esc_attr( vixus_get_theme_option( 'front_page_subscribe_paddings' ) );
?>"
		<?php
		$vixus_css      = '';
		$vixus_bg_image = vixus_get_theme_option( 'front_page_subscribe_bg_image' );
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
	$vixus_anchor_icon = vixus_get_theme_option( 'front_page_subscribe_anchor_icon' );
	$vixus_anchor_text = vixus_get_theme_option( 'front_page_subscribe_anchor_text' );
if ( ( ! empty( $vixus_anchor_icon ) || ! empty( $vixus_anchor_text ) ) && shortcode_exists( 'trx_sc_anchor' ) ) {
	echo do_shortcode(
		'[trx_sc_anchor id="front_page_section_subscribe"'
									. ( ! empty( $vixus_anchor_icon ) ? ' icon="' . esc_attr( $vixus_anchor_icon ) . '"' : '' )
									. ( ! empty( $vixus_anchor_text ) ? ' title="' . esc_attr( $vixus_anchor_text ) . '"' : '' )
									. ']'
	);
}
?>
	<div class="front_page_section_inner front_page_section_subscribe_inner
	<?php
	if ( vixus_get_theme_option( 'front_page_subscribe_fullheight' ) ) {
		echo ' vixus-full-height sc_layouts_flex sc_layouts_columns_middle';
	}
	?>
			"
			<?php
			$vixus_css      = '';
			$vixus_bg_mask  = vixus_get_theme_option( 'front_page_subscribe_bg_mask' );
			$vixus_bg_color_type = vixus_get_theme_option( 'front_page_subscribe_bg_color_type' );
			if ( 'custom' == $vixus_bg_color_type ) {
				$vixus_bg_color = vixus_get_theme_option( 'front_page_subscribe_bg_color' );
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
		<div class="front_page_section_content_wrap front_page_section_subscribe_content_wrap content_wrap">
			<?php
			// Caption
			$vixus_caption = vixus_get_theme_option( 'front_page_subscribe_caption' );
			if ( ! empty( $vixus_caption ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<h2 class="front_page_section_caption front_page_section_subscribe_caption front_page_block_<?php echo ! empty( $vixus_caption ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( $vixus_caption, 'vixus_kses_content' ); ?></h2>
				<?php
			}

			// Description (text)
			$vixus_description = vixus_get_theme_option( 'front_page_subscribe_description' );
			if ( ! empty( $vixus_description ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_description front_page_section_subscribe_description front_page_block_<?php echo ! empty( $vixus_description ) ? 'filled' : 'empty'; ?>"><?php echo wp_kses( wpautop( $vixus_description ), 'vixus_kses_content' ); ?></div>
				<?php
			}

			// Content
			$vixus_sc = vixus_get_theme_option( 'front_page_subscribe_shortcode' );
			if ( ! empty( $vixus_sc ) || ( current_user_can( 'edit_theme_options' ) && is_customize_preview() ) ) {
				?>
				<div class="front_page_section_output front_page_section_subscribe_output front_page_block_<?php echo ! empty( $vixus_sc ) ? 'filled' : 'empty'; ?>">
				<?php
					vixus_show_layout( do_shortcode( $vixus_sc ) );
				?>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
