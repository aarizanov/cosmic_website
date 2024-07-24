<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

						// Widgets area inside page content
						vixus_create_widgets_area( 'widgets_below_content' );
						?>
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					$vixus_body_style = vixus_get_theme_option( 'body_style' );
					if ( 'fullscreen' != $vixus_body_style ) {
						?>
						</div><!-- </.content_wrap> -->
						<?php
					}

					// Widgets area below page content and related posts below page content
					$vixus_widgets_name = vixus_get_theme_option( 'widgets_below_page' );
					$vixus_show_widgets = ! vixus_is_off( $vixus_widgets_name ) && is_active_sidebar( $vixus_widgets_name );
					$vixus_show_related = is_single() && vixus_get_theme_option( 'related_position' ) == 'below_page';
					if ( $vixus_show_widgets || $vixus_show_related ) {
						if ( 'fullscreen' != $vixus_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $vixus_show_related ) {
							do_action( 'vixus_action_related_posts' );
						}

						// Widgets area below page content
						if ( $vixus_show_widgets ) {
							vixus_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $vixus_body_style ) {
							?>
							</div><!-- </.content_wrap> -->
							<?php
						}
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Single posts banner before footer
			if ( is_singular( 'post' ) ) {
				vixus_show_post_banner('footer');
			}
			// Footer
			$vixus_footer_type = vixus_get_theme_option( 'footer_type' );
			if ( 'custom' == $vixus_footer_type && ! vixus_is_layouts_available() ) {
				$vixus_footer_type = 'default';
			}
			get_template_part( apply_filters( 'vixus_filter_get_template_part', "templates/footer-{$vixus_footer_type}" ) );
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php wp_footer(); ?>

</body>
</html>