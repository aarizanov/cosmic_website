<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cosmic
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer top_footer">
		<div class="vc_container">
			<div class="vc_col-md-4">
				<?php dynamic_sidebar( 'top-footer-1' ); ?>
			</div>
			<div class="vc_col-md-2">
				<?php dynamic_sidebar( 'top-footer-2' ); ?>
			</div>
			<div class="vc_col-md-2">
				<?php dynamic_sidebar( 'top-footer-3' ); ?>
			</div>
			<div class="vc_col-md-4">
				<?php dynamic_sidebar( 'top-footer-4' ); ?>
			</div>
		</div>
	</footer><!-- .top_footer -->
    <footer class="site-footer newsletter">
        <div class="message"></div>
        <form class="newsletter-signup">
            <div>
                <span>Get a</span>
                <select name="frequency">
                    <option value="monthly">Monthly</option>
                    <option value="quarterly">Quarterly</option>
                    <option value="yearly">Yearly</option>
                </select>
                <span>email of all new blogs</span>
            </div>
            <div>
                <div>
                    <i class="fal fa-user"></i>
                    <input type="text" name="name" placeholder="Name">
                </div>
                <div>
                    <i class="fal fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email">
                </div>
            </div>
            <div>
                <button>Subscribe</button>
            </div>
        </form>
    </footer>
	<footer class="site-footer bottom_footer">
		<div class="vc_container">
			<div class="vc_col-md-12">
				<?php dynamic_sidebar( 'bottom-footer' ); ?>
			</div>
		</div>
	</footer><!-- .top_footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript"> _linkedin_partner_id = "2144908"; window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || []; window._linkedin_data_partner_ids.push(_linkedin_partner_id); </script><script type="text/javascript"> (function(){var s = document.getElementsByTagName("script")[0]; var b = document.createElement("script"); b.type = "text/javascript";b.async = true; b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js"; s.parentNode.insertBefore(b, s);})(); </script> <noscript> <img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=2144908&fmt=gif" /> </noscript>


</body>
</html>
