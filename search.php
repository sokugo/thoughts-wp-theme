<?php get_header(); ?>

	<?php $count = $wp_query->found_posts; ?>

	<h1 class="page-title mb-">
		<?php _e('Search Results for:', 'thoughtstheme') ?>
		<b>&ldquo;<?php echo get_search_query(); ?>&rdquo;</b>
	</h1>

	<p class="meta"><?php printf( _n( 'Displaying %d post', 'Displaying %d posts', $count, 'thoughtstheme' ), $count); ?></p>

	<?php get_template_part('loop-collapsed'); ?>

	<?php get_template_part('pagination'); ?>

<?php get_footer(); ?>
