<?php
/*
* @subpackage Microblog
* @since Microblog
*/

/*to max oEmbed content*/
if ( ! isset( $content_width ) ) {
	$content_width = 625;
}

/*general setup theme*/
function mcrblg_custom_theme_setup() {
	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style();
	/*translate support*/
	load_theme_textdomain( 'microblog', get_template_directory() . '/languages' );
	/*enable featured images*/
	add_theme_support( 'post-thumbnails' );
	/*to manage document title*/
	add_theme_support( 'title-tag' );
	/*add rss links to head*/
	add_theme_support( 'automatic-feed-links' );
	/*enable customizing background*/
	add_theme_support( 'custom-background' );
	/*register menu to sidebar*/
	register_nav_menus(array(
			'sidebar' => __( 'sidebar menu', 'microblog' ),
	));
	/*add tha ability to change image in sidebar*/
	add_theme_support( 'custom-header', array(
			'flex-width'    => true,
			'width'         => 625,
			'flex-height'   => true,
			'height'        => 200,
			'default-image' => get_template_directory_uri() . '/images/1_pixel.png',
			'uploads'				=> true,
	));
}

/*widgets setup*/
function mcrblg_theme_widgets_init() {
	register_sidebar( array(
			'name'          => 'Sidebar',
			'before_widget' => '<div class="mcrblg-widget-container">',
			'after_widget'  => '</div><!--.mcrblg-widget-container--><div class="mcrblg-sidebar-line"></div><!--.sidebar-line-->',
			'before_title'  => '<div class="mcrblg-widget-title">',
			'after_title'   => '</div><!--.mcrblg-widget-title-->',
			'id'			=> 'sidebar-1',
	) );
}

/*register scripts*/
function mcrblg_scripts_method() {
	/*styler for select form*/
	wp_enqueue_script( 'mcrblg_select_style', get_template_directory_uri() . '/js/jquery.formstyler.min.js', array( 'jquery', ), '', true );

	/*main script*/
	wp_enqueue_script( 'mcrblg_script', get_template_directory_uri() . '/js/script.js', array( 'jquery', 'mcrblg_select_style', ), '', true );

	/*comment reply support. need add ID to comment div*/
	wp_enqueue_script( 'comment-reply' );

	/*translations in JS, add additional data*/
	$translation_array = array(
			'placeholder_string'  => __( 'Enter your search keyword', 'microblog' ),
			'mcrblg_template_url'	=> esc_url( get_template_directory_uri() ),
	);

	/*css reset*/
	wp_enqueue_style( 'mcrblg-theme-style', get_stylesheet_uri() );

	wp_localize_script( 'mcrblg_script', 'microblog_localization', $translation_array );
}

/*custom excerpt settings*/
function mcrblg_excerpt_more( $more ) {

	return '...';
}

/*add span to archives link (custom background on counter)*/
function mcrblg_archives_link( $archives ) {

	/*move a-tag and wrap in li*/
	if ( strpos( $archives, '<option ' ) === false ) {
		$archives = str_replace( '</a>', '', $archives ) . '</a>';
		$archives = str_replace( '</li>', '', $archives ) . '</li>';
		$archives = str_replace( '<a ', '<a class="mcrblg-archives-link" ', $archives );

		/*add span for background only in widget. not in select*/
		if ( strpos( $archives, '(' ) !== false && strpos( $archives, ')' ) !== false ) {
			$archives = str_replace( '(', '<span class="mcrblg-count-categories">', $archives );
			$archives = str_replace( ')', '</span>', $archives );
		}
	}

	return $archives;
}

/*show comments*/
function microblog_comment( $comment, $args, $depth ) {
	$GLOBALS[ 'comment' ] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		/* Display trackbacks differently than normal comments.*/
		?>
			<li class="post pingback">
				<p><?php _e( 'Pingback:', 'microblog' ); comment_author_link(); edit_comment_link( __( 'Edit', 'microblog' ), ' ' ); ?></p>
				<?php break;
		default :
		?>
		<li>
			<div id="comment-<?php comment_ID(); ?>">
				<div class="mcrblg-comment">
					<div class="mcrblg-comment-author">
						<?php echo get_avatar( $comment, 64 );  /* avatar 64x64 px?>*/ ?>
					</div><!--.mcrblg-comment-author-->
					<div class="mcrblg-author-meta">
						<span>
							<?php echo get_comment_author_link(); ?>
						</span>
					</div><!--.mcrblg-author-meta-->
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="mcrblg-comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'microblog' ); ?></em>
						<br />
					<?php endif; ?>
					<div class="mcrblg-comment-meta"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php /* translators: 1: date, 2: time */
							printf( '%1$s ' . __( 'at', 'microblog' ) . ' %2$s', get_comment_date(), get_comment_time() ); ?></a>
					</div><!-- .mcrblg-comment-meta -->
					<div class="mcrblg-comment-body"><?php comment_text(); ?></div><!--.mcrblg-comment-body-->
					<div class="mcrblg-reply">
						<p><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], ) ) );
						edit_comment_link( __( 'Edit', 'microblog' ), ' ' ); ?></p>
					</div><!-- .reply -->
				</div><!--.mcrblg-comment-->
			</div><!--#comment-id-->
		<?php break;
	endswitch;
}

/* backwards compatibility title-tag */
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	/* customize title */
	function mcrblg_wp_title( $title, $sep = '|' ) {
		global $page, $paged;

		if ( is_feed() ) {
			return $title;
		}

		/* Add the blog name*/
		$title .= get_bloginfo( 'name' );

		/* Add the blog description for the home/front page.*/
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description ";
		}

		/* Add a page number if necessary:*/
		if ( $paged >= 2 || $page >= 2 ) {
			$title .= " $sep " . sprintf( __( 'Page %s', 'microblog' ), max( $paged, $page ) );
		}

		return $title;
	}

	add_filter( 'wp_title', 'mcrblg_wp_title' );

	/* render title in wp_head */
	function mcrblg_render_title() { ?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php }

	add_action( 'wp_head', 'mcrblg_render_title' );
}
/* end backwards compatibility */

/*change styles in blog name and description from admin panel*/
function mcrblg_customize_css() {
	if ( get_header_textcolor() == '' ) {
		return;
	}
	?>
	<style type="text/css">
		.mcrblg-customize-header,
		.mcrblg-customize-description {
			color:<?php echo '#' . get_header_textcolor(); ?> !important;
		}
	</style>
<?php
}

/*custom support: add translate support, enable thumbnails etc*/
add_action( 'after_setup_theme', 'mcrblg_custom_theme_setup' );
/*init widgets. wrap all widgets to div*/
add_action( 'widgets_init', 'mcrblg_theme_widgets_init' );
/*enqueue users scripts, add translation array to js*/
add_action( 'wp_enqueue_scripts', 'mcrblg_scripts_method' );
/*change styles in blog name and description from admin panel*/
add_action( 'wp_head', 'mcrblg_customize_css');
/*custom excerpt*/
add_filter( 'excerpt_more', 'mcrblg_excerpt_more' );
/*wrap archives counters to span and customize it*/
add_filter( 'get_archives_link', 'mcrblg_archives_link' );
