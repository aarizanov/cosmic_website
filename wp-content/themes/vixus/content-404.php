<article <?php post_class( 'post_item_single post_item_404' ); ?>>
	<div class="post_content">
		<h1 class="page_title"><?php esc_html_e( '404', 'vixus' ); ?></h1>
		<div class="page_info">
			<h1 class="page_subtitle"><?php esc_html_e( 'Oops...', 'vixus' ); ?></h1>
			<p class="page_description"><?php echo wp_kses_post( __( "We're sorry, but <br>something went wrong.", 'vixus' ) ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="go_home theme_button"><?php esc_html_e( 'Homepage', 'vixus' ); ?></a>
		</div>
	</div>
</article>
