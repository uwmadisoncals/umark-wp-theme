<?php
/**
 * UW-Madison functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'uwmadison_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 *
 * @package WordPress
 * @subpackage UW_Madison
 * @since UW-Madison 1.0
 */

/**
 * Tell WordPress to run uwmadison_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'uwmadison_setup' );

if ( ! function_exists( 'uwmadison_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override uwmadison_setup() in a child theme, add your own uwmadison_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since UW-Madison 1.0
 */
function uwmadison_setup() {

	/* Make UW-Madison available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on UW-Madison, use a find and replace
	 * to change 'uw-madison-160' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'uw-madison-160', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( array( 'css/editor-style.css' ) );

	// Defines the Customizer options for the theme
	require( get_template_directory() . '/inc/theme-customizer.php' );

	// Include Aria_Walker_Nav_Menu class
	require_once get_template_directory() . '/inc/aria-walker-nav-menu.php';

	require( get_template_directory() . '/inc/metabox.use-sidebar.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'main_menu', __( 'Main Menu', 'uw-madison-160' ) );
	register_nav_menu( 'utility_menu', __( 'Utility Menu', 'uw-madison-160' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// $theme_options = uwmadison_get_theme_options();

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// WP 4.1 title tag support
	add_theme_support( 'title-tag' );

	// add edit_theme_options to Editor role
	$editor_role = get_role( 'editor' );
	$editor_role->add_cap( 'edit_theme_options' );

  // Custom image sizes
  add_image_size( 'uw-hero', 1600, 500, true );
}
endif; // uwmadison_setup

/**
 * Custom template tags for this uwmadison-160.
 */
require get_template_directory() . '/inc/template-tags.php';


if ( ! function_exists( 'uwmadison_widgets_init' ) ) :
	/**
	 * Register our widgetized sidebar.
	 *
	 * @return void
	 */
	function uwmadison_widgets_init() {

		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'uw-madison-160' ),
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => "</aside>",
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		) );

	}
endif;
add_action( 'widgets_init', 'uwmadison_widgets_init' );


if ( ! function_exists( 'uwmadison_widgets_classes' ) ) :
	/**
	 * Add the uw-content-box class to sidebar widgets
	 *
	 * @param Array $params The widget's params
	 * @return Array The filtered params
	 **/
	function uwmadison_widgets_classes($params) {
	  global $widget_classes;

	  if ( $params[0]['name'] == "Main Sidebar" ) {
		  $before_widget_string = $params[0]['before_widget'];
		  $params[0]['before_widget'] = str_replace('class="', 'class="uw-content-box ' . $widget_classes[$params[0]['widget_id']], $before_widget_string);
	  }
	   
	  return $params;
	}
	add_filter( 'dynamic_sidebar_params', 'uwmadison_widgets_classes', 10);
endif; // uwmadison_widgets_classes


if ( ! function_exists( 'uwmadison_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to 40 words.
	 *
	 * @return Integer The excerpt word count
	 **/
	function uwmadison_excerpt_length( $length ) {
		return 40;
	}
endif;
add_filter( 'excerpt_length', 'uwmadison_excerpt_length' );


if ( ! function_exists( 'uwmadison_auto_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and uwmadison_continue_reading_link().
	 *
	 * @return String HTML for Continue reading link
	 **/
	function uwmadison_auto_excerpt_more( $more ) {
		return ' &hellip;' . uwmadison_continue_reading_link();
	}
endif;
add_filter( 'excerpt_more', 'uwmadison_auto_excerpt_more' );


if ( ! function_exists( 'uwmadison_custom_excerpt_more' ) ) :
	/**
	 * Adds a "Continue Reading" link to custom post excerpts.
	 *
	 * @return String HTML for excerpt
	 **/
	function uwmadison_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= uwmadison_continue_reading_link();
		}
		return $output;
	}
endif;
add_filter( 'get_the_excerpt', 'uwmadison_custom_excerpt_more' );


if ( ! function_exists( 'uwmadison_page_menu_args' ) ) :
	/**
	 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
	 *
	 * @return Array Options array for wp_page_menu
	 * @link https://codex.wordpress.org/Function_Reference/wp_page_menu
	 **/
	function uwmadison_page_menu_args( $args ) {
		$args['show_home'] = true;
		$args['menu_class'] = $args['container_class'];
		return $args;
	}
endif;
add_filter( 'wp_page_menu_args', 'uwmadison_page_menu_args' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * (NOTE: This is not used in the uwmadiosn-160 theme but 
 * is included to satisfy Wordpress theme requirements.)
 *
 * @global int $content_width
 * @link https://codex.wordpress.org/Content_Width
 */
function uwmadison_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uwmadison_width', 640 );
}
add_action( 'after_setup_theme', 'uwmadison_content_width', 0 );


if ( ! function_exists( 'set_uwmadison_body_classes' ) ) :
	/**
	 * Adds classes to the array of body classes based on.
	 * - column number
	 * - column order
	 * - background color
	 * - author type
	 * - singular post
	 * Applies the uwmadison_layout_classes() filter
	 *
	 * @param Array $classes the classes currently set for the body element
	 * @return Array the classes to set on <body>
	 */
	function set_uwmadison_body_classes( $classes ) {
		global $post;

		$current_layout = get_theme_mod('uwmadison_theme_layout','content-sidebar');

		// set column number class
		$uwmadison_use_sidebar = get_post_meta( $post->ID, '_uwmadison_use_sidebar', true );

		// default to use sidebar if it has not been set on a page
		if ( !is_numeric( $uwmadison_use_sidebar ) )
			$uwmadison_use_sidebar = 1;

		// we have a two-column layout if the theme option is set and
		// it's either not a page or the use_sidebar meta option is 
		// set on the page
		if ( in_array( $current_layout, array( 'content-sidebar', 'sidebar-content' ) ) && ( !is_singular() || $uwmadison_use_sidebar ))
			$classes[] = 'two-column';
		else
			$classes[] = 'one-column';

		// set column order class
		if ( 'content-sidebar' == $current_layout )
			$classes[] = 'right-sidebar';
		elseif ( 'sidebar-content' == $current_layout )
			$classes[] = 'left-sidebar';
		else
			$classes[] = $current_layout;

		// set body background color option class
	  $body_bgcolor_class = (get_theme_mod('uwmadison_body_bg','uw-white-bg') == "uw-white-bg") ? "uw-white-bg" : "uw-light-gray-bg";
	  $classes[] = $body_bgcolor_class;

		// set author class
		if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
			$classes[] = 'single-author';

		// set singular class
		if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
			$classes[] = 'singular';

    /**
     * Filter the classes array
     *
     * @param Array $classes The current classes set for <body>
     * @param Array $current_layout The theme option value for current_layout
     */
		$classes = apply_filters( 'uwmadison_body_classes', $classes, $current_layout );

		return $classes;
	}
endif;
add_filter( 'body_class', 'set_uwmadison_body_classes' );


if ( ! function_exists( 'uwmadison_frontend_assets' ) ) :

	/**
	 * Enqueues our frontend assets
	 *
	 * @return void
	 **/
	function uwmadison_frontend_assets() {

		// enqueue fonts CSS
		$use_verlag = get_theme_mod( 'uwmadison_use_official_uw_type', false ); 
		$production_type = get_theme_mod( 'uwmadison_type_production', false ); 
		if ( $use_verlag ) { 
			if ( $production_type ) {
				// production fonts
				// TODO: Enqueu final production CloudTypography CSS link
				wp_enqueue_style( 'uwmadison-production-fonts', 'https://cloud.typography.com/6462674/7207552/css/fonts.css', array(), '2.0.0' );
			} else {
				// development fonts
				wp_enqueue_style( 'uwmadison-dev-fonts', 'https://cloud.typography.com/6462674/6639152/css/fonts.css', array(), '2.0.0' );
			}
		}

		wp_enqueue_script( 'uwmadison-theme', get_template_directory_uri().'/js/uwmadison-theme.min.js', array('jquery'), '2.0.0', TRUE );

		// enqueue CSS based om environment; defaults to minified
		// uncomment the line below if you want unminified CSS
		// Define WP_ENV in wp-config.php to be "development" if 
		// you want sourcemapped CSS
		$css_file = "style.min.css";
		// $css_file = "style.css";
		if ( defined('WP_ENV') && WP_ENV == "development") {
			$css_file = "style-sourcemapped.css";
		}
		wp_enqueue_style( 'uwmadison-theme', get_template_directory_uri()."/$css_file", array(), '2.0.0' );

		if ( get_theme_mod( 'uwmadison-lightbox-images', true ) ) {
			wp_enqueue_script( 'uwmadison-lightbox', get_template_directory_uri().'/js/uwmadison-lightbox.min.js', array('jquery'), '2.0.0', TRUE );
			wp_enqueue_style( 'uwmadison-lightbox', get_template_directory_uri().'/css/uwmadison-lightbox.min.css', array('uwmadison-theme'), '2.0.0' );
		}
		
		wp_enqueue_style( 'uwmadison-theme-print', get_template_directory_uri()."/css/print.css", array(), '2.0.0', 'print' );

	}
endif;
add_action('wp_enqueue_scripts', 'uwmadison_frontend_assets');

