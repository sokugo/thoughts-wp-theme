<?php if (have_posts()): ?>
	<?php

	$colors = ColorGenerator::generate(
		theme_option( 'type-start-color', '#0088f3' ),
		theme_option( 'type-end-color', '#1abc9c' ),
		count($wp_query->posts)
	);

	$i = 0;

	?>
	<ul class="posts-list mb+ js-posts">
		<?php while (have_posts()) : the_post(); ?>
			<li class="post">
				<h2 style="color: #<?php echo $colors[$i++] ?>">
					<?php if(is_sticky()) : ?>
						<i class="post-status fa fa-star-o"></i>
					<?php endif ?>

					<a href="<?php the_permalink() ?>">
						<?php the_title() ?>
					</a>
				</h2>

				<div><?php the_time('F dS, Y') ?></div>
			</li>
		<?php endwhile; ?>
	</ul>

<?php else: ?>

	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'thoughtstheme' ); ?></h2>
	</article>

<?php endif; ?>
