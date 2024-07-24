<?php if ( has_post_thumbnail() ) { ?>
	<div class="qodef-e-media-image">
		<a href="<?php the_permalink(); ?>">
			<?php echo qi_blocks_get_post_image( get_the_id(), $imagesProportion, intval( $customImageWidth ), intval( $customImageHeight ) ); ?>
		</a>
	</div>
<?php } ?>
