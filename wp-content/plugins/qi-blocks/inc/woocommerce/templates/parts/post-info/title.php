<?php
$title_tag = isset( $titleTag ) && ! empty( $titleTag ) ? $titleTag : 'h4';
?>
<<?php echo sanitize_key( $title_tag ); ?> itemprop="name" class="qodef-e-product-title qodef-e-title entry-title">
	<a itemprop="url" class="qodef-e-product-title-link" href="<?php the_permalink(); ?>">
		<?php the_title(); ?>
	</a>
</<?php echo sanitize_key( $title_tag ); ?>>
