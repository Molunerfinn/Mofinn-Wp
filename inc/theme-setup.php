<?php  

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 790; /* pixels */
}

if( !function_exists('everbox_setup') ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function everbox_theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on EverBox, use a find and replace
	 * to change 'everbox' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'everbox', get_template_directory() . '/languages' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 320, 320, true );
	add_image_size( '120x100', 120, 100, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'everbox' ),
		'footer' => __( 'Sidebar Menu', 'everbox' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

}
endif;
add_action( 'after_setup_theme', 'everbox_theme_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function everbox_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'everbox' ),
		'id'            => 'sidebar-default',
		'description'   => __( 'Default sidebar.', 'everbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-head"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => __( 'Post Sidebar', 'everbox' ),
		'id'            => 'sidebar-alter',
		'description'   => __( 'Sidebar replace default sidebar for single post & page.', 'everbox' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-head"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_widget( 'Everbox_Popular_Widget' );
}
add_action( 'widgets_init', 'everbox_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function everbox_scripts() {

	wp_enqueue_style( 'everbox-style', get_stylesheet_uri() );
	wp_enqueue_script('velocity-js', EVERBOX_URL . '/js/velocity.js', array('jquery'), null, false );
	wp_enqueue_script('velocity-ui-js', EVERBOX_URL . '/js/velocity.ui.js', array('jquery'), null, false );
	wp_enqueue_script('fastclick-js', EVERBOX_URL . '/js/fastclick.js', array('jquery'), null, false );
	wp_enqueue_script('site-js', EVERBOX_URL . '/js/site.js', array('jquery'), null, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'everbox_scripts' );

/**
 * Add editor style
 */
function everbox_add_editor_styles() {
    add_editor_style( EVERBOX_URL . '/css/editor-style.css' );
}
add_action( 'admin_init', 'everbox_add_editor_styles' );
?>