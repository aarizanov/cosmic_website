<?php
/**
 * Forminator cross-sell notice for module listing pages (free users only).
 *
 * @package Hustle
 * @since 7.8.13
 */

?>
<div
	class="sui-box sui-margin-bottom hustle-dismissible-admin-notice"
	data-name="forminator_cross_sell"
>

	<div class="sui-box-header">

		<h3 class="sui-box-title">
			<span class="sui-icon-forminator" aria-hidden="true"></span>
			<?php esc_html_e( 'Forminator', 'hustle' ); ?>
		</h3>

		<button class="sui-button-icon sui-button-icon--right dismiss-notice" style="margin-left: auto;">
			<span class="sui-icon-close" aria-hidden="true"></span>
			<span class="sui-screen-reader-text"><?php esc_html_e( 'Dismiss', 'hustle' ); ?></span>
		</button>

	</div>

	<div class="sui-box-body">

		<div class="sui-upsell-notice">

			<div class="sui-upsell-notice__image" style="align-self: start;">
				<img
					src="<?php echo esc_url( Opt_In::$plugin_url . 'free/assets/images/forminator.png' ); ?>"
					alt="<?php esc_attr_e( 'Forminator', 'hustle' ); ?>"
				/>
			</div>

			<div class="sui-upsell-notice__content">

				<p><?php esc_html_e( 'Want drag-and-drop forms, polls, and quizzes on your site? Get Forminator – our free WordPress form builder plugin!', 'hustle' ); ?></p>

				<a
					href="https://wordpress.org/plugins/forminator/?utm_source=hustle&utm_campaign=cross-sell_plugin_forminator"
					class="sui-button sui-button-blue"
					target="_blank"
					rel="noopener noreferrer"
				>
					<?php esc_html_e( 'Install Forminator', 'hustle' ); ?>
				</a>

			</div>

		</div>

	</div>

</div>
