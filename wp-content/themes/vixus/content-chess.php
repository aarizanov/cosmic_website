<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage VIXUS
 * @since VIXUS 1.0
 */

$vixus_template_args = get_query_var( 'vixus_template_args' );
if ( is_array( $vixus_template_args ) ) {
	$vixus_columns    = empty( $vixus_template_args['columns'] ) ? 1 : max( 1, min( 3, $vixus_template_args['columns'] ) );
	$vixus_blog_style = array( $vixus_template_args['type'], $vixus_columns );
} else {
	$vixus_blog_style = explode( '_', vixus_get_theme_option( 'blog_style' ) );
	$vixus_columns    = empty( $vixus_blog_style[1] ) ? 1 : max( 1, min( 3, $vixus_blog_style[1] ) );
}
$vixus_expanded    = ! vixus_sidebar_present() && vixus_is_on( vixus_get_theme_option( 'expand_content' ) );
$vixus_post_format = get_post_format();
$vixus_post_format = empty( $vixus_post_format ) ? 'standard' : str_replace( 'post-format-', '', $vixus_post_format );
$vixus_animation   = vixus_get_theme_option( 'blog_animation' );

?><article id="post-<?php the_ID(); ?>" 
									<?php
									post_class(
										'post_item'
										. ' post_layout_chess'
										. ' post_layout_chess_' . esc_attr( $vixus_columns )
										. ' post_format_' . esc_attr( $vixus_post_format )
										. ( ! empty( $vixus_template_args['slider'] ) ? ' slider-slide swiper-slide' : '' )
									);
									echo ( ! vixus_is_off( $vixus_animation ) && empty( $vixus_template_args['slider'] ) ? ' data-animation="' . esc_attr( vixus_get_animation_classes( $vixus_animation ) ) . '"' : '' );
									?>
	>

	<?php
	// Add anchor
	if ( 1 == $vixus_columns && ! is_array( $vixus_template_args ) && shortcode_exists( 'trx_sc_anchor' ) ) {
		echo do_shortcode( '[trx_sc_anchor id="post_' . esc_attr( get_the_ID() ) . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '" icon="' . esc_attr( vixus_get_post_icon() ) . '"]' );
	}

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	$vixus_hover = ! empty( $vixus_template_args['hover'] ) && ! vixus_is_inherit( $vixus_template_args['hover'] )
						? $vixus_template_args['hover']
						: vixus_get_theme_option( 'image_hover' );
	vixus_show_post_featured(
		array(
			'class'         => 1 == $vixus_columns && ! is_array( $vixus_template_args ) ? 'vixus-full-height' : '',
			'singular'      => false,
			'hover'         => $vixus_hover,
			'no_links'      => ! empty( $vixus_template_args['no_links'] ),
			'show_no_image' => true,
			'thumb_ratio'   => '1:1',
			'thumb_bg'      => true,
			'thumb_size'    => vixus_get_thumb_size(
				strpos( vixus_get_theme_option( 'body_style' ), 'full' ) !== false
										? ( 1 < $vixus_columns ? 'huge' : 'original' )
										: ( 2 < $vixus_columns ? 'big' : 'huge' )
			),
		)
	);

	?>
	<div class="post_inner"><div class="post_inner_content"><div class="post_header entry-header">
		<?php
			do_action( 'vixus_action_before_post_title' );

			// Post title
		if ( empty( $vixus_template_args['no_links'] ) ) {
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		} else {
			the_title( '<h3 class="post_title entry-title">', '</h3>' );
		}

			do_action( 'vixus_action_before_post_meta' );

			// Post meta
			$vixus_components = vixus_array_get_keys_by_value( vixus_get_theme_option( 'meta_parts' ) );
			$vixus_counters   = vixus_array_get_keys_by_value( vixus_get_theme_option( 'counters' ) );
			$vixus_post_meta  = empty( $vixus_components ) || in_array( $vixus_hover, array( 'border', 'pull', 'slide', 'fade' ) )
										? ''
										: vixus_show_post_meta(
											apply_filters(
												'vixus_filter_post_meta_args', array(
													'components' => $vixus_components,
													'counters' => $vixus_counters,
													'seo'  => false,
													'echo' => false,
												), $vixus_blog_style[0], $vixus_columns
											)
										);
			vixus_show_layout( $vixus_post_meta );
			?>
		</div><!-- .entry-header -->

		<div class="post_content entry-content">
		<?php
		if ( empty( $vixus_template_args['hide_excerpt'] ) ) {
			?>
				<div class="post_content_inner">
				<?php
				if ( has_excerpt() ) {
					the_excerpt();
				} elseif ( strpos( get_the_content( '!--more' ), '!--more' ) !== false ) {
					the_content( '' );
				} elseif ( in_array( $vixus_post_format, array( 'link', 'aside', 'status' ) ) ) {
					the_content();
				} elseif ( 'quote' == $vixus_post_format ) {
					$quote = vixus_get_tag( get_the_content(), '<blockquote>', '</blockquote>' );
					if ( ! empty( $quote ) ) {
						vixus_show_layout( wpautop( $quote ) );
					} else {
						the_excerpt();
					}
				} elseif ( substr( get_the_content(), 0, 4 ) != '[vc_' ) {
					the_excerpt();
				}
				?>
				</div>
				<?php
		}
			// Post meta
		if ( in_array( $vixus_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			vixus_show_layout( $vixus_post_meta );
		}
			// More button
		if ( empty( $vixus_template_args['no_links'] ) && ! in_array( $vixus_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
			?>
				<p><a class="more-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'vixus' ); ?></a></p>
				<?php
		}
		?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!
