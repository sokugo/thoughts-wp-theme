<?php
$args = array(
	'post_type'      => 'post',
	'posts_per_page' => 3,
	'post__not_in'   => array(get_the_ID()),
	'order'          => 'DESC',
	'orderby'        => 'rand',
	'ignore_sticky_posts' => true
);

query_posts( $args );

$colors = ColorGenerator::generate(
	theme_option( 'type-start-color', '#0088f3' ),
	theme_option( 'type-end-color', '#1abc9c' ),
	count($wp_query->posts)
);

$i = 0;
?>

<?php if (have_posts()) : ?>
	<ul class="posts-list mb+">
		<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<h2 style="color: #<?php echo $colors[$i++] ?>">
					<a href="<?php the_permalink() ?>">
						<?php the_title() ?>
					</a>
				</h2>

				<div><?php the_time('F dS, Y') ?></div>
			</li>
		<?php endwhile ?>
	</ul>
<?php endif; ?>

<?php wp_reset_query(); ?>
