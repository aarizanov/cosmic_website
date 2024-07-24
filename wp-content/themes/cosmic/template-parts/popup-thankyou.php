<div class="blur-background">
	<div class="cosmic-popup thankyou">
		<span class="close-button"><i class="fa fa-times" aria-hidden="true"></i></span>
		<div class="vc_col-sm-12 img-container">
			<div class="img" style="background-image:url(<?php echo get_template_directory_uri() ?>/img/popups/blog.png)">
				<div class="content-wrapper">
					<h2>Thank you!</h2>
					<p>We are glad you onnected with us. Our team of experts will reqch you within 2-3 business days.</p>
					<h3>RECOMMENDED CONTENT</h3>
					<div class="content-wrap">
						<?php echo do_shortcode( '[cosmic_posts_carousel slider_ppp="3" slider_num="3"]' ); ?>
						<div class="vc_col-sm-12 newsletter">
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
					                <button>Subscribe Now</button>
					            </div>
					        </form>
					    </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>