<div class="sidebar-inner">
    <?php if ('job_position' === get_post_type()) {
    echo '<div class="apply-form">' .
        do_shortcode('[contact-form-7 id="1113" title="APPLY"]') .
        '</div>';
    } ?>
	<div class="sidebar_item">
		<?php get_template_part( 'template-parts/post-related', 'posts' ); ?>
	</div>
	<div class="sidebar_item">
		<h4>SHARE POST</h4>
		<?php get_template_part( 'template-parts/sharing', 'icons' ); ?>
	</div>
	<div class="sidebar_item">
		<h4>TAGS</h4>
		<?php the_tags( '<div class="post_tags"><div class="post_tags-inner">', '', '</div></div>' ); ?>
	</div>
    <div class="sidebar_item">
        <?php
        // Include author template
        get_template_part( 'template-parts/post-author', 'profile' );
        ?>
    </div>
</div>