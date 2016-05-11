<div class="pagination mb+ js-pagination">
	<?php if(theme_option('infinite-scroll')): ?>
		<div class="js-next pagination__load"><?php next_posts_link(__('Load more posts&hellip;', 'thoughtstheme')); ?></div>
	<?php else : ?>
		<?php
			previous_posts_link('<i class="fa fa-long-arrow-left mr--"></i>Previous');
			next_posts_link('Next<i class="fa fa-long-arrow-right ml--"></i>');
		?>
	<?php endif ?>
</div>
