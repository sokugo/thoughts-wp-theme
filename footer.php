</div><!-- /.wrapper -->

	<div class="fat-footer">
		<div class="wrapper">

			<?php if(is_single()) : ?>
				<hr class="rule mb+">
			<?php endif ?>

			<div class="layout layout--center">
				<div class="layout__item lap-and-up-6/8 palm-mb">
					<div class="media">
						<?php if ( $avatar = theme_option('avatar', false) ) : ?>
							<img class="media__img avatar" src="<?php echo  $avatar ?>" alt="" width="44" height="44"/>
						<?php endif ?>
						<div class="media__body">
							<h4><?php echo theme_option('about-section-caption', __('About ', 'thoughtstheme') . get_bloginfo( 'name' ) ) ?></h4>
							<p><?php echo theme_option('about-section-content', get_bloginfo('description')) ?></p>
						</div>
					</div>
				</div><?php

				?><div class="layout__item lap-and-up-2/8">
					<div class="fat-footer__social">
						<ul class="list-bare list-inline">
							<?php if(theme_option('type-facebook')): ?>
								<li><a href="http://facebook.com/<?php echo theme_option('type-facebook') ?>/"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-twitter')):  ?>
								<li><a href="http://twitter.com/<?php echo theme_option('type-twitter') ?>"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-instagram')): ?>
								<li><a href="http://instagram.com/<?php echo theme_option('type-instagram') ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-flickr')):  ?>
								<li><a href="https://www.flickr.com/photos/<?php echo theme_option('type-flickr') ?>"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-linkedin')): ?>
								<li><a href="http://linkedin.com/in/<?php echo theme_option('type-linkedin') ?>"><i class="fa  fa-linkedin-square"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-dribbble')):  ?>
								<li><a href="http://dribbble.com/<?php echo theme_option('type-dribbble') ?>"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-deviantart')): ?>
								<li><a href="http://<?php echo theme_option('type-deviantart') ?>.deviantart.com"><i class="fa fa-deviantart" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-reddit')):  ?>
								<li><a href="http://www.reddit.com/user/<?php echo theme_option('type-reddit') ?>"><i class="fa fa-reddit-square" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-github')): ?>
								<li><a href="https://github.com//<?php echo theme_option('type-github') ?>"><i class="fa fa-github-square" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-behance')):  ?>
								<li><a href="https://www.behance.net/<?php echo theme_option('type-behance') ?>"><i class="fa fa-behance-square" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-vimeo')): ?>
								<li><a href="https://www.vimeo.com/<?php echo theme_option('type-vimeo') ?>"><i class="fa fa-vimeo-square" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-pinterest')): ?>
								<li><a href="https://www.pinterest.com/<?php echo theme_option('type-pinterest') ?>"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-youtube')): ?>
								<li><a href="https://www.youtube.com/channel/<?php echo theme_option('type-youtube') ?>"><i class="fa fa-youtube-square" aria-hidden="true"></i></a></li>
							<?php endif ?>

							<?php if(theme_option('type-skype')): ?>
								<li><a href="skype:<?php echo theme_option('type-skype') ?>?call"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
							<?php endif ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!--/.wrapper-->

<footer class="footer" role="contentinfo">

	<div class="wrapper wrapper--wide split split--responsive">
		<div class="split__title">
			<?php printf(__('&copy; %d by %s. All rights reserved.', 'thoughtstheme'), date('Y'), get_option('blogname' ) ) ?>
		</div>
		<?php _e('Theme:', 'thoughtstheme') ?>
		<a href="http://pixelrevel.com/themes/wordpress/thoughts">Thoughts</a> by
		<a href="http://pixelrevel.com">Pixel Revel</a>
	</div>

</footer>

<?php if (theme_option('show-search')) : ?>
	<form class="js-search search-form search-form--modal" method="get" action="<?php echo home_url(); ?>" role="search">
		<div class="search-form__inner">
			<div>
				<p class="micro mb-"><?php _e('Use the field below to search the site...', 'thoughtstheme') ?></p>
				<i class="fa fa-search"></i>
				<input class="text-input" type="search" name="s" placeholder="<?php _e('Enter keyword...', 'thoughtstheme') ?>">
			</div>
		</div>
	</form>
<?php endif ?>

<?php wp_footer(); ?>

<?php if ($analyticsID = theme_option('analytics-id')) : ?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', '<?php echo $analyticsID ?>', 'auto');
    ga('send', 'pageview');
</script>
<?php endif ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&appId=193051410826007&version=v2.0";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<script type="text/javascript">
		window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));
	</script>
</body>
</html>
