<?php $archive_class = new CosmicArchiveClass; ?>
<div class="post_search">
	<a class="close" href="#">
		<i class="fal fa-times"></i>
	</a>
	<div class="post_search-inner">
		<form autocomplete="off">
			<div class="form-group">
				<input type="search" id="post_search-text" placeholder="keyword to search" autocomplete="off">
				<button type="submit">
					<i class="far fa-search"></i>
				</button>
				<input type="hidden" id="search_nounce" value="<?php echo esc_attr( $archive_class->create_nounce() ); ?>">
			</div>
		</form>
		<div class="tags">
			<?php
			$tags_args = array(
				'smallest' => 10, 
				'largest' => 20,
				'unit' => 'pt', 
				'number' => 20,  
				'format' => 'flat',
				'separator' => "\n",
				'orderby' => 'name', 
				'order' => 'ASC',
				'link' => 'view', 
				'taxonomy' => 'post_tag', 
				'echo' => true,
			);
			wp_tag_cloud( $tags_args );
			?>
		</div>
		<div class="search_results">
			<div class="search_results-inner">
				<ul></ul>
			</div>
		</div>
	</div>
</div>
