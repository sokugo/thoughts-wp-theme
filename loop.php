<div class="js-posts">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail()) : ?>
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail('large');  ?>
				</a>
			<?php endif; ?>

			<h2 class="post-title">
				<?php if(is_sticky()) : ?>
					<i class="fa fa-star-o"></i>
				<?php endif ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h2>

			<div class="meta">
				<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
					<?php the_date(); ?> <?php the_time(); ?>
				</time>
				<?php if(has_category()) : ?>
					, <?php the_category(', '); ?>
				<?php endif ?>
			</div>

			<div class="post-body js-gallery">
				<?php the_content(__('Read more', 'thoughtstheme')); ?>
			</div>

			<div class="rule rule--ornament mt+ mb+">
				<i class="fa fa-file-o rule__ornament"></i>
			</div>

		</article>
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		<article>
			<h2><?php _e( 'Sorry, nothing to display.', 'thoughtstheme' ); ?></h2>
		</article>
		<!-- /article -->

	<?php endif; ?>
</div>
