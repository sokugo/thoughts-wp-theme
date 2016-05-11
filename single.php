<?php get_header(); ?>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class('js-gallery'); ?>>

			<?php if ( has_post_thumbnail()) : ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ) ?>
				<a class="post-thumbnail" href="<?php echo $image[0]; ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail('large');  ?>
				</a>
			<?php endif; ?>

			<h1 class="post-title">
				<?php if(is_sticky()) : ?>
					<i class="post-status post-status--large fa fa-star-o"></i>
				<?php endif ?>

				<?php the_title(); ?>
			</h1>

			<div class="post-body js-gallery mb">
				<?php the_content(); ?>
			</div>

			<div class="meta mb+ split split--responsive">
				<div class="split__title">
					<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
						<?php the_date('F dS, Y'); ?></time>
					<span class=""><?php edit_post_link(__('[Edit]', 'thoughtstheme'), ''); ?></span>
				</div>

				<?php if (theme_option('show-social-share')) : ?>
					<div class="post-share social-block">
						<a class="twitter-share-button" href="https://twitter.com/share">Tweet</a>
						<div class="fb-like" data-href="<?php the_permalink() ?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
					</div>
				<?php endif ?>

			</div>
		</article>

		<?php if (theme_option('post-nav')) : ?>

			<div class="pagination mb+">
				<?php
				previous_post_link('%link', '<i class="fa fa-long-arrow-left mr--"></i>Previous');
				next_post_link('%link', 'Next<i class="fa fa-long-arrow-right ml--"></i>');
				?>
			</div>

		<?php endif ?>

		<?php include "partials/articles-list.php" ?>

		</div><!-- /.wrapper -->

		<?php comments_template(); ?>

		<div class="wrapper">

	<?php endwhile; ?>

	<?php else: ?>
		<article>
			<h1><?php _e( 'Sorry, nothing to display.', 'thoughtstheme' ); ?></h1>
		</article>
	<?php endif; ?>

<?php get_footer(); ?>
