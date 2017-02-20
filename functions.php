<?php
/**
 * Frameworker Theme functions and definitions
 *
 * @link https://github.com/juddfranklin1/frameworker-theme
 *
 */

/**
 * Frameworker Theme only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}
require_once get_template_directory() . '/code/framework_class.php';

function frameworker_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

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
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
    'header' => 'Header menu',
    'footer' => 'Footer menu'
  ) );

}
add_action( 'after_setup_theme', 'frameworker_theme_setup' );

function add_theme_styles_and_scripts () {
	wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Istok+Web|Lora|Permanent+Marker', false );
	wp_enqueue_style('bootstrap-4.0.0-alpha.6', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css', array(), '4.0.0-alpha.6', false);
	wp_enqueue_style('style.css', get_stylesheet_uri());

	wp_enqueue_style('videojs-css', 'http://vjs.zencdn.net/5.14.1/video-js.css', '5.14.1', false);

	wp_enqueue_script("jquery");
	wp_enqueue_script('videojs', 'http://vjs.zencdn.net/5.14.1/video.js', array(), '5.14.1', true);
	wp_enqueue_script('videojs-youtube', get_template_directory_uri() . '/js/Youtube.min.js', array(), '2.2.0', true);

	// For IE8 support
	wp_enqueue_script('videojs-ie8', 'http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js', array(), '1.1.2', true);

	wp_enqueue_script('tether-1.4.0', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.js', array(), '1.4.0', true);
	wp_enqueue_script('bootstrap-4.0.0-alpha.6', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array(), 'bootstrap-4.0.0-alpha.6', true);

	wp_enqueue_script('scramblr', get_template_directory_uri() . '/js/scramblr.js', array(), '0.1', true);

	return true;
}
add_action('wp_enqueue_scripts','add_theme_styles_and_scripts');

// Get current Page Template
add_filter( 'template_include', 'var_template_include', 1000 );
function var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}

function get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) ) {
			return false;
		}
    if( $echo ) {
			echo $GLOBALS['current_theme_template'];
		}
    else {
			return $GLOBALS['current_theme_template'];
		}
}

// TinyMCE custom styles and formatting
// This will let me make my blog do fun things.

function add_formats_dropdown_tinyMCE($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'add_formats_dropdown_tinyMCE');

function additional_formats( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
		// Each array child is a format with it's own settings
		array(
			'title' => '.technical-aside',
			'block' => 'blockquote',
			'classes' => 'frameworker-theme-callout technical-aside jumbotron',
			'wrapper' => true,

		),
		array(
			'title' => '.personal-aside',
			'block' => 'blockquote',
			'classes' => 'frameworker-theme-callout personal-aside jumbotron',
			'wrapper' => true,
		),
		array(
			'title' => '.social-aside',
			'block' => 'blockquote',
			'classes' => 'frameworker-theme-callout social-aside jumbotron',
			'wrapper' => true,
		),
	);
	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'additional_formats' );

function add_advanced_editor_styles() {
    add_editor_style( 'css/frameworker-theme-editor-styles.css' );
}
add_action( 'admin_init', 'add_advanced_editor_styles' );


//One of the most disappointing parts of wordpress is
//how cumbersome html customization is for automatically generated elements.
//Here is

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="col-xs-6"';
}

add_filter('next_post_link', 'post_link_attributes');
add_filter('previous_post_link', 'post_link_attributes');

function post_link_attributes($output) {
    $code = 'class="col-xs-6"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}

add_filter('nav_menu_css_class', 'bootstrapping_navigation');

function bootstrapping_navigation(){
	$classes = array();
	array_push($classes, "nav-item");
	return $classes;
}

/* function slug_get_post_meta_cb( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name );
}

function slug_update_post_meta_cb( $value, $object, $field_name ) {
    return update_post_meta( $object[ 'id' ], $field_name, $value );
}

function my_rest_prepare_post( $data, $post, $request ) {
	$_data = $data->data;
	$post_meta = get_post_meta( $post->ID, 'Post Detail', true );
	$_data['post_meta'] = $post_meta;
	$data->data = $_data;
	return $data;
}

add_action( 'rest_api_init', function() {
 register_api_field( 'post',
    'Post Detail',
    array(
       'get_callback'    => 'slug_get_post_meta_cb',
       'update_callback' => 'slug_update_post_meta_cb',
       'schema'          => null,
    )
 );
});*/
