<?php
/**
 * Forminator block for free users.
 *
 * @uses ./../../global/sui-components/sui-box-header
 *
 * @package Hustle
 * @since 7.8.13
 */

?>
<div class="sui-box sui-box-blue">

	<div class="sui-box-header">

		<h3 class="sui-box-title">
			<span class="sui-icon-forminator" aria-hidden="true"></span>
			<?php esc_html_e( 'Forminator', 'forminator' ); ?>
		</h3>

	</div>

	<div class="sui-box-body">

		<p><?php esc_html_e( "Did you know that you can embed Forminator forms, polls & quizzes in your Hustle modules to extend it's capabilities?", 'forminator' ); ?></p>

		<ol class="sui-upsell-list">
			<li><span class="sui-icon-check sui-md" style="color: #17a8e3;" aria-hidden="true"></span> <?php esc_html_e( 'Accept subscription and recurring payments', 'forminator' ); ?></li>
			<li><span class="sui-icon-check sui-md" style="color: #17a8e3;" aria-hidden="true"></span> <?php esc_html_e( 'Unlock Advanced form features with Pro Add-ons', 'forminator' ); ?></li>
			<li><span class="sui-icon-check sui-md" style="color: #17a8e3;" aria-hidden="true"></span> <?php esc_html_e( 'Access pre-made form templates and save custom form templates in the cloud', 'forminator' ); ?></li>
			<li><span class="sui-icon-check sui-md" style="color: #17a8e3;" aria-hidden="true"></span> <?php esc_html_e( 'Generate, download, and share PDFs on form submissions', 'forminator' ); ?></li>
		</ol>

	</div>

	<div class="sui-box-footer" style="padding-top: 0; border-top: 0;">

		<a
			href="https://wordpress.org/plugins/forminator/?utm_source=forminator&utm_campaign=cross-sell_plugin_forminator"
			class="sui-button sui-button-blue"
			target="_blank"
		>
			<?php esc_html_e( 'Install', 'forminator' ); ?>
		</a>

	</div>

</div>