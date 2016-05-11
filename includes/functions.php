<?php
/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if ( ! isset( $content_width ) ) {
	$content_width = 900;
}

if ( function_exists( 'add_theme_support' ) ) {
	// Add Menu Support
	add_theme_support( 'menus' );

	// Add Thumbnail Theme Support
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'large', 700, '', true ); // Large Thumbnail
	add_image_size( 'medium', 250, '', true ); // Medium Thumbnail
	add_image_size( 'small', 120, '', true ); // Small Thumbnail
	add_image_size( 'avatar', 64, 64, true ); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	// Enables post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	load_theme_textdomain( 'thoughtstheme', get_template_directory() . '/languages' );
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' )
{
	$args['container'] = false;

	return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var )
{
	return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist )
{
	return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class( $classes )
{
	global $post;
	if ( is_home() ) {
		$key = array_search( 'blog', $classes );
		if ( $key > - 1 ) {
			unset( $classes[ $key ] );
		}
	} elseif ( is_page() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	} elseif ( is_singular() ) {
		$classes[] = sanitize_html_class( $post->post_name );
	}

	return $classes;
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html )
{
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );

	return $html;
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
	global $wp_widget_factory;
	remove_action( 'wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	) );
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
	global $wp_query;
	$big = 999999999;
	echo paginate_links( array(
		'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
		'format'    => '?paged=%#%',
		'current'   => max( 1, get_query_var( 'paged' ) ),
		'total'     => $wp_query->max_num_pages,
		'prev_text' => '<i class="fa fa-caret-left"></i>',
		'next_text' => '<i class="fa fa-caret-right"></i>'
	) );
}

// Custom Excerpts
function html5wp_index( $length ) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
	return - 1;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post( $length )
{
	return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt( $length_callback = '', $more_callback = '' )
{
	echo get_the_content();
}

// Custom View Article link to Post
function html5_blank_view_article( $more )
{
	global $post;

	return '</p><p><a class="view-article" href="' . get_permalink( $post->ID ) . '">' . __( 'Read more', 'thoughtstheme' ) . '</a></p>';
}


function custom_protected_title( $title )
{
	return '<i class=\'fa fa-lock\'></i> %s';
}

// Remove Admin bar
function remove_admin_bar()
{
	return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove( $tag )
{
	return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );

	return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar( $avatar_defaults )
{
	$myavatar                     = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[ $myavatar ] = "Custom Gravatar";

	return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
	if ( ! is_admin() ) {
		if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1 ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

// Custom Comments Callback
function html5blankcomments( $comment, $args, $depth )
{
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );

	if ( 'div' == $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	} ?>

	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

	<?php if ( 'div' != $args['style'] ) : ?>
	<div class="comment__inner" id="div-comment-<?php comment_ID() ?>">
<?php endif; ?>

	<div class="media media--small">
		<div class="media__img avatar">
			<?php if ( $args['avatar_size'] != 0 ) {
				echo get_avatar( $comment, '32' );
			} ?>
		</div>
		<div class="media__body">
			<div class="comment-author">
				<?php echo get_comment_author_link() ?>
			</div>
			<div class="comment-date">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"
				   title="<?php printf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() ); ?>">
					<?php echo human_time_diff( get_comment_date( 'U' ), current_time( 'timestamp' ) ) . ' ago'; ?>
				</a>
			</div>
			<div class="comment-actions">
				<?php edit_comment_link( '<i class="fa fa-edit"></i>', '  ', '' ); ?>
				<?php comment_reply_link(
					array_merge( $args, array(
						'add_below'  => $add_below,
						'depth'      => $depth,
						'reply_text' => '<i class="fa fa-reply ml--"></i>',
						'max_depth'  => $args['max_depth']
					) ) ) ?>
			</div>

			<div class="comment-body">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="mb-">
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
					</p>
				<?php endif; ?>

				<?php comment_text() ?>
			</div>
		</div>
	</div>

	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
<?php endif; ?>
<?php
}

function custom_reply_fields( $fields )
{
	$fields['author'] =
		'<p class="comment-form-author mb--"><input class="text-input 1/1" id="author" name="author" type="text" value="" size="30" aria-required="true" placeholder="' . __( 'Author', 'thoughtstheme' ) . '"/></p>';

	$fields['email'] =
		'<p class="comment-form-email mb--"><input class="text-input 1/1" id="email" name="email" type="text" value="" size="30" aria-required="true" placeholder="' . __( 'Email', 'thoughtstheme' ) . '"/></p>';

	$fields['url'] =
		'<p class="comment-form-url mb--"><input class="text-input 1/1" id="url" name="url" type="text" value="" size="30" placeholder="' . __( 'Website', 'thoughtstheme' ) . '" /></p>';

	return $fields;
}

function custom_reply_textarea( $field )
{
	$field = '<p class="comment-form-comment mb--"><textarea class="text-input 1/1" id="comment" name="comment" rows="8" aria-required="true" placeholder="' . __( 'Comment', 'thoughtstheme' ) . '"></textarea></p>';

	return $field;
}

function get_posts_count_by_tag( $tag )
{
	$term = get_term_by( 'slug', $tag, 'post_tag' );

	return $term->count;
}

function theme_option( $name, $default = false )
{
	$options = ( get_option( 'type_theme_options' ) ) ? get_option( 'type_theme_options' ) : null;
	// return the option if it exists
	if ( isset( $options[ $name ] ) && ! empty( $options[ $name ] ) ) {
		return apply_filters( 'type_theme_options_$name', $options[ $name ] );
	}

	// return default if nothing else
	return apply_filters( 'type_theme_options_$name', $default );
}

function getPostViews( $postID )
{
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );

		return 0;
	}

	return $count;
}

// function to count views.
function setPostViews( $postID )
{
	$count_key = 'post_views_count';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $count_key, $count );
	}
}

function posts_column_views( $defaults )
{
	$defaults['post_views'] = __( 'Views' );

	return $defaults;
}

function posts_custom_column_views( $column_name, $id )
{
	if ( $column_name === 'post_views' ) {
		echo getPostViews( get_the_ID() );
	}
}

function post_like()
{
	// Check for nonce security
	$nonce = $_POST['nonce'];

	if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
		die ( 'Busted!' );
	}

	if ( isset( $_POST['post_like'] ) ) {
		// Retrieve user IP address
		$ip      = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];

		// Get voters'IPs for the current post
		$meta_IP  = get_post_meta( $post_id, "voted_IP" );
		$voted_IP = $meta_IP[0];

		if ( ! is_array( $voted_IP ) ) {
			$voted_IP = array();
		}

		// Get votes count for the current post
		$meta_count = get_post_meta( $post_id, "votes_count", true );

		// Use has already voted ?
		if ( ! likesPost( $post_id ) ) {
			$voted_IP[ $ip ] = time();

			// Save IP and increase votes count
			update_post_meta( $post_id, "voted_IP", $voted_IP );
			update_post_meta( $post_id, "votes_count", ++ $meta_count );

			// Display count (ie jQuery return value)
			echo $meta_count;
		} else {
			echo "already";
		}
	}
	exit;
}

function likesPost( $post_id )
{
	$timebeforerevote = 10080;

	// Retrieve post votes IPs
	$meta_IP  = get_post_meta( $post_id, "voted_IP" );
	$voted_IP = $meta_IP[0];

	if ( ! is_array( $voted_IP ) ) {
		$voted_IP = array();
	}

	// Retrieve current user IP
	$ip = $_SERVER['REMOTE_ADDR'];

	// If user has already voted
	if ( in_array( $ip, array_keys( $voted_IP ) ) ) {
		$time = $voted_IP[ $ip ];
		$now  = time();

		// Compare between current time and vote time
		if ( round( ( $now - $time ) / 60 ) > $timebeforerevote ) {
			return false;
		}

		return true;
	}

	return false;
}

function getPostLikes( $post_id )
{
	$meta = get_post_meta( $post_id, "votes_count", true );

	return $meta ? $meta : 0;
}

function add_fb_open_graph_tags()
{
	if ( is_single() or is_page() ) {
		global $post;
		if ( get_the_post_thumbnail( $post->ID, 'thumbnail' ) ) {
			$thumbnail_id     = get_post_thumbnail_id( $post->ID );
			$thumbnail_object = get_post( $thumbnail_id );
			$image            = $thumbnail_object->guid;
		} else {
			$image = get_bloginfo( 'url' ) . '/opengraph.png'; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		$description = get_bloginfo( 'description' );
		$description = my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags( $description );
		$description = str_replace( "\"", "'", $description );
		?>

		<meta property="og:title" content="<?php the_title(); ?>"/>
		<meta property="og:type" content="article"/>
		<meta property="og:image" content="<?php echo $image; ?>"/>
		<meta property="og:url" content="<?php the_permalink(); ?>"/>
		<meta property="og:description" content="<?php echo $description ?>"/>
		<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>"/>

	<?php } elseif ( is_home() ) { ?>

		<meta property="og:title" content="<?php bloginfo( 'name' ); ?>"/>
		<meta property="og:image" content="<?php echo get_bloginfo( 'url' ); ?>/opengraph.png"/>
		<meta property="og:description" content="<?php bloginfo( 'description' ); ?>"/>
		<meta property="og:type" content="website"/>
		<meta property="og:url" content="<?php echo get_bloginfo( 'url' ); ?>"/>

	<?php
	}
}

/**
 * Infinite Scroll
 */
function custom_infinite_scroll_js()
{
	?>
	<script>
		var infinite_scroll = {
			loading: {
				img: '<?php echo get_template_directory_uri(); ?>/assets/img/ajax-loader.gif',
				msgText: '',
				finishedMsg: ''
			},
			nextSelector: '.js-next a',
			navSelector: '.js-pagination',
			itemSelector: '.post',
			contentSelector: '.js-posts'
		};
	</script>
<?php
}

function my_excerpt($text, $excerpt){

	if ($excerpt) return $excerpt;

	$text = strip_shortcodes( $text );

	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = strip_tags($text);
	$excerpt_length = apply_filters('excerpt_length', 55);
	$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
	$words = preg_split("/[\n
     ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	if ( count($words) > $excerpt_length ) {
		array_pop($words);
		$text = implode(' ', $words);
		$text = $text . $excerpt_more;
	} else {
		$text = implode(' ', $words);
	}

	return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

function custom_password_form()
{
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o     = '<p></p><p>' . __( 'This content is password protected. To view it please enter your password below:', 'thoughtstheme' ) . '</p>' .
	         '<form class="mb" action="' . site_url( "wp-login.php?action=postpass", "login_post" ) . '" method="post">' .
	         '<div class="go-input">' .
	         '<div class="go-input__text">' .
	         '<input class="text-input mr-" name="post_password" id="' . $label . '" type="password" size="20" placeholder="Password" />' .
	         '</div><div class="go-input__go">' .
	         '<input type="submit" name="Submit" class="btn btn--primary btn--small" value="' . esc_attr__( "Submit" ) . '" />' .
	         '</div></div></form>';

	return $o;
}
