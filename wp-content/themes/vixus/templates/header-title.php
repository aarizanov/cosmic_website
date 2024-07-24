<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

// Page (category, tag, archive, author) title

if ( vixus_need_page_title() ) {
	vixus_sc_layouts_showed( 'title', true );
	vixus_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								vixus_show_post_meta(
									apply_filters(
										'vixus_filter_post_meta_args', array(
											'components' => vixus_array_get_keys_by_value( vixus_get_theme_option( 'meta_parts' ) ),
											'counters'   => vixus_array_get_keys_by_value( vixus_get_theme_option( 'counters' ) ),
											'seo'        => vixus_is_on( vixus_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$vixus_blog_title           = vixus_get_blog_title();
							$vixus_blog_title_text      = '';
							$vixus_blog_title_class     = '';
							$vixus_blog_title_link      = '';
							$vixus_blog_title_link_text = '';
							if ( is_array( $vixus_blog_title ) ) {
								$vixus_blog_title_text      = $vixus_blog_title['text'];
								$vixus_blog_title_class     = ! empty( $vixus_blog_title['class'] ) ? ' ' . $vixus_blog_title['class'] : '';
								$vixus_blog_title_link      = ! empty( $vixus_blog_title['link'] ) ? $vixus_blog_title['link'] : '';
								$vixus_blog_title_link_text = ! empty( $vixus_blog_title['link_text'] ) ? $vixus_blog_title['link_text'] : '';
							} else {
								$vixus_blog_title_text = $vixus_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $vixus_blog_title_class ); ?>">
								<?php
								$vixus_top_icon = vixus_get_category_icon();
								if ( ! empty( $vixus_top_icon ) ) {
									$vixus_attr = vixus_getimagesize( $vixus_top_icon );
									?>
									<img src="<?php echo esc_url( $vixus_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'vixus' ); ?>"
										<?php
										if ( ! empty( $vixus_attr[3] ) ) {
											vixus_show_layout( $vixus_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_post( $vixus_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $vixus_blog_title_link ) && ! empty( $vixus_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $vixus_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $vixus_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						?>
						<div class="sc_layouts_title_breadcrumbs">
							<?php
							do_action( 'vixus_action_breadcrumbs' );
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
