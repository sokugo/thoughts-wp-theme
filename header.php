<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title><?php wp_title( '' ); ?><?php if ( wp_title( '', false ) ) {
			echo ' : ';
		} ?><?php bloginfo( 'name' ); ?></title>

	<link href="//www.google-analytics.com" rel="dns-prefetch">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">

	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,900' rel='stylesheet' type='text/css'>

	<?php wp_head(); ?>

	<style>
		<?php
			$startColor = theme_option('type-start-color', '#ecd078');
			$endColor = theme_option('type-end-color', '#c02942');
		?>

		.post [rel="gallery"]:after {
			background: <?php echo $startColor ?>;
		}

		.post [rel="gallery"]:after {
			background: <?php echo $endColor ?>;
			background: -moz-linear-gradient(top,  <?php echo $startColor ?> 0%, <?php echo $endColor ?> 100%);
			background: -webkit-gradient(linear, top center, bottom center, color-stop(0%,<?php echo $startColor ?>), color-stop(100%,<?php echo $endColor ?>));
			background: -webkit-linear-gradient(top,  <?php echo $startColor ?> 0%,<?php echo $endColor ?> 100%);
			background: -o-linear-gradient(top,  <?php echo $startColor ?> 0%,<?php echo $endColor ?> 100%);
			background: -ms-linear-gradient(top,  <?php echo $startColor ?> 0%,<?php echo $endColor ?> 100%);
			background: linear-gradient(to bottom,  <?php echo $startColor ?> 0%,<?php echo $endColor ?> 100%);
		}

		.wpcf7-text:focus,
		.wpcf7-number:focus,
		.wpcf7-select:focus,
		.wpcf7-textarea:focus,
		.text-input:focus {
			border-color: <?php echo $startColor ?>;
		}

		[id="submit"],
		.wpcf7-submit,
		.btn--primary {
			background: <?php echo $startColor ?>;
		}

		.post-status {
			color: <?php echo $startColor ?>;
		}

		a {
			color: <?php echo $startColor ?>;
		}

		<?php echo theme_option('custom-css', '') ?>
	</style>
</head>

<?php

$options = array(
	'fancy-captions',
	'format-lede',
	'round-avatars'
);

$classes = array();

foreach ( $options as $option ) {
	if ( theme_option( $option ) ) {
		$classes[] = $option;
	}
}

$classes = implode( ' ', $classes );

?>

<body <?php body_class( $classes ); ?>>

<header class="page-head wrapper" role="banner">

	<div class="split page-head__section">
		<?php if ( $blogName = get_option( 'blogname' ) ) : ?>
			<div class="split__title">
				<?php if ( is_home() ) : ?>
					<h1 class="page-head__blog-name milli">
						<a href="<?php echo home_url() ?>"><?php echo $blogName ?></a>
					</h1>
				<?php else : ?>
					<p class="page-head__blog-name milli">
						<a href="<?php echo home_url() ?>"><?php echo $blogName ?></a>
					</p>
				<?php endif ?>
			</div>
		<?php endif ?>

		<?php if (theme_option('show-search')) : ?>
			<i class=" js-toggle-search fa fa-search"></i>
		<?php endif ?>
	</div>

	<?php if ( is_home() && $blogDescription = get_option( 'blogdescription' ) ) : ?>
		<h2 class="page-head__blog-desc lap-and-up-2/3">
			<?php echo $blogDescription ?>
		</h2>
	<?php endif ?>
</header>

<div class="wrapper">
