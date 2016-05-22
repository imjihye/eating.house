<?php
/*
 * Hey
 * Only edit this file if you know what you're doing or make a backup before editing it
 * Happy Blogging
*/

include get_template_directory() . "/inc/customizer/customizer.php";

if (!function_exists('photos_setup')) {
	function photos_setup() {

		global $content_width;
		if (!isset($content_width)) {
			$content_width = 750;
		}

		// Takes care of the <title> tag. https://codex.wordpress.org/Title_Tag
		add_theme_support('title-tag');
		
		// Loads texdomain. https://codex.wordpress.org/Function_Reference/load_theme_textdomain
		load_theme_textdomain('photos', get_template_directory() . '/languages');

		// Add automatic feed links support. https://codex.wordpress.org/Automatic_Feed_Links
		add_theme_support('automatic-feed-links');

		// Add post thumbnails support. https://codex.wordpress.org/Post_Thumbnails
		add_theme_support('post-thumbnails');

		// Add custom background support. https://codex.wordpress.org/Custom_Backgrounds
		add_theme_support('custom-background', array(
			// Default color
			'default-color' => 'FFF',
		));

		// Add custom header support. https://codex.wordpress.org/Custom_Headers
		add_theme_support('custom-header', array(
			// Flex height
			'flex-height' => true,
			// Header image
			'default-image' => get_template_directory_uri() . '/assets/images/header.jpg',
			// Header text
			'header-text' => false,
		));

		// This theme uses wp_nav_menu(). https://codex.wordpress.org/Function_Reference/register_nav_menu
		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'photos' ),
		));
	}

	add_action( 'after_setup_theme', 'photos_setup' );
}
// To add backwards compatibility for titles
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function photos_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'photos_render_title' );
}

// Registering and enqueuing scripts/stylesheets to header/footer.
function photos_scripts() {
	wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'photos_style', get_stylesheet_uri());
	wp_enqueue_style( 'photos_latto', '//fonts.googleapis.com/css?family=Lato:400,700,400italic');
	wp_enqueue_style( 'photos_open_sans', '//fonts.googleapis.com/css?family=Open+Sans:400,300,600');

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ),'',true);
	wp_enqueue_script( 'masonry', get_template_directory_uri() . '/assets/js/masonry.pkgd.min.js', array( 'jquery' ),'',true);
	wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ),'',true);
	wp_enqueue_script( 'classie', get_template_directory_uri() . '/assets/js/classie.js', array( 'jquery' ),'',true);
	wp_enqueue_script( 'photos_scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ),'',true);
}

add_action( 'wp_enqueue_scripts', 'photos_scripts' );

// Custom comments style
function photos_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case 'pingback' :
	
	
		case 'trackback' :
		?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'photos' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'photos' ), ' ' ); ?></p>
		<?php
		break;

	
		default :
		?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment-body">
					<footer>
						<div class="comment-author vcard" >
							<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
							<?php printf( __( '<span>%s </span><span class="says">says:</span>', 'photos' ), sprintf( '<b class="fn">%s</b>', get_comment_author_link() ) ); ?>
						</div><!-- .comment-author .vcard -->
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php _e( 'Your comment is awaiting moderation.', 'photos' ); ?></em>
							<br />
						<?php endif; ?>
						<div class="comment-metadata">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-permalink">
								<time class="comment-published" datetime="<?php comment_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?php comment_time( _x( 'l, F j, Y, g:i a', 'comment time format', 'photos' ) ); ?>" itemprop="commentTime">
									<?php printf( __( '%1$s at %2$s', 'photos' ), get_comment_date(), get_comment_time() ); ?>
								</time>
							</a>
							<?php edit_comment_link( __( '(Edit)', 'photos' ), ' ' );?>
						</div><!-- .comment-meta .commentmetadata -->
					</footer>

					<div class="comment-content"><?php comment_text(); ?></div>

					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div><!-- .reply -->
				</article><!-- #comment-## -->

<?php
		break;
	
	endswitch;
}
?>
