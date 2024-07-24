<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cosmic
 */

get_header();
wp_enqueue_script( 'error404', get_template_directory_uri().'/js/dist/error404.min.js', array( 'jquery' ), '1.0.0', true );
?>

	<div id="primary" class="content-area"  style="background-image:url( <?php echo esc_url( get_template_directory_uri().'/img/404/bg.jpg' ); ?> )">
		<main id="main" class="site-main">
			<div class="vc_container">
				<section class="error-404 not-found">
					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Whoops!', 'cosmic' ); ?></h1>
						<h2 class="page-title"><?php esc_html_e( '404 - Page not found', 'cosmic' ); ?></h2>
					</header><!-- .page-header -->
					<div class="page-content">
						<div class="content-404">
							<div class="description">
								<p class="big">One of our developers must be punished for this gruesome mistake.</p>
								<h2>Pick who to <span style="color:#f62954">fire !!!</span></h2>
							</div>
							<div class="vc_row">
								<div class="vc_col-md-3 vc_col-sm-6">
									<div class="box-404">
										<img class="normal" src="<?php echo esc_url( get_template_directory_uri().'/img/404/mare_profile.jpg' ); ?>" >
										<img class="saved" src="<?php echo esc_url( get_template_directory_uri().'/img/404/mare_saved.jpg' ); ?>" >
										<img class="fired" src="<?php echo esc_url( get_template_directory_uri().'/img/404/mare_fired.jpg' ); ?>" >
										<div class="name button button-ghost">Marko Pavlovic</div>
										<div class="msg">You've made a right choice. Everyone knows that it's always a designers fault.</div>
									</div>
								</div>
								<div class="vc_col-md-3 vc_col-sm-6">
									<div class="box-404">
										<img class="normal" src="<?php echo esc_url( get_template_directory_uri().'/img/404/mile_profile.jpg' ); ?>" >
										<img class="saved" src="<?php echo esc_url( get_template_directory_uri().'/img/404/mile_saved.jpg' ); ?>" >
										<img class="fired" src="<?php echo esc_url( get_template_directory_uri().'/img/404/mile_fired.jpg' ); ?>" >
										<div class="name button button-ghost">Mile Milosheski</div>
										<div class="msg">He started reading the code saying "What morone wrote this", and half way through realized it was him.</div>
									</div>
								</div>
								<div class="vc_col-md-3 vc_col-sm-6">
									<div class="box-404">
										<img class="normal" src="<?php echo esc_url( get_template_directory_uri().'/img/404/zarko_profile.jpg' ); ?>" >
										<img class="saved" src="<?php echo esc_url( get_template_directory_uri().'/img/404/zare_saved.jpg' ); ?>" >
										<img class="fired" src="<?php echo esc_url( get_template_directory_uri().'/img/404/zare_fired.jpg' ); ?>" >
										<div class="name button button-ghost">Zarko Mirceski</div>
										<div class="msg">Zarko is usually not a revengeful person, but we would suggest that you change your IP just in case.</div>
									</div>
								</div>
								<div class="vc_col-md-3 vc_col-sm-6">
									<div class="box-404">
										<img class="normal" src="<?php echo esc_url( get_template_directory_uri().'/img/404/grcha_profile.jpg' ); ?>" >
										<img class="saved" src="<?php echo esc_url( get_template_directory_uri().'/img/404/grcha_saved.jpg' ); ?>" >
										<img class="fired" src="<?php echo esc_url( get_template_directory_uri().'/img/404/grcha_fired.jpg' ); ?>" >
										<div class="name button button-ghost">Marko Grcic</div>
										<div class="msg">It worked fine in his browser. He probably doesn't have an idea what he's doing.</div>
									</div>
								</div>
							</div>
						</div>
					</div><!-- .page-content -->
					<footer class="page-footer">
						<div class="mood">
							<p class="big" id="mood_msg">In a forgiving mood? Let them all keep their jobs.</p>
							<a href="<?php echo esc_url( get_home_url()); ?>" class="button button-md">Back to home</a>
						</div>
					</footer><!-- .page-header -->
				</section><!-- .error-404 -->
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
