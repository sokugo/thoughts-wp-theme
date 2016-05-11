<?php get_header(); ?>

	<article id="post-404">

		<h1 class="mb-">404</h1>

		<p>
			<?php _e('We haven\'t found the page you were looking for. Perhaps, you should try the search below, or just', 'thoughtstheme'); ?>
			<a href="<?php echo home_url(); ?>"><?php _e('return to homepage', 'thoughtstheme') ?></a>.
		</p>

		<form class="search-form mb+" method="get" action="<?php echo home_url(); ?>" role="search">
			<div class="search-form__inner">
				<p class="micro mb-"><?php _e('Use the field below to search the site...', 'thoughtstheme') ?></p>
				<div>
					<i class="fa fa-search"></i>
					<input class="text-input" type="search" name="s" placeholder="<?php _e('Enter keyword...', 'thoughtstheme') ?>">
				</div>
			</div>
		</form>

		<?php include 'partials/popular-articles.php' ?>

	</article>

<?php get_footer(); ?>
