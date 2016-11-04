<?php
/**
 * pho functions and definitions
 *
 * @package pho
 */

/**
 * For child theme authors: To disable the styles and layouts from pho properly,
 * add the following code to your child theme functions.php file:
 *
 * <?php
 * add_action( 'wp_enqueue_scripts', 'dequeue_parent_theme_styles', 11 );
 * function dequeue_parent_theme_styles() {
 *     wp_dequeue_style( 'pho-parent-style' );
 *     wp_dequeue_style( 'pho-layout' );
 * }
 *
 */

if ( ! function_exists( 'pho_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pho_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on pho, use a find and replace
	 * to change 'pho' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pho', get_template_directory() . '/languages' );

	/**
	* Set the content width based on the theme's design and stylesheet.
	*/
	if ( ! isset( $content_width ) ) {
		   $content_width = 840; /* pixels */
	}

	// This theme styles the visual editor to resemble the theme style.
	$font_url = '//fonts.googleapis.com/css?family=Lato';
	add_editor_style( array( 'inc/editor-style.css', str_replace( ',', '%2C', $font_url ) ) );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	// Featured image sizes for responsive display
	add_image_size('large-thumb', 1280, 9999);
	add_image_size('medium-thumb', 1024, 9999);
	add_image_size('post-thumbnail', 880, 9999);
	add_image_size('small-thumb', 440, 9999);

	// Featured image size for portfolio view
	add_image_size('portfolio-thumb', 700, 700, true);


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'pho' ),
	) );

	// Reverse the order of the menu items
	//add_filter( 'wp_nav_menu_objects', create_function( '$menu', 'return array_reverse( $menu );' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pho_custom_background_args', array(
		'default-color' => 'b2b2b2',
		'default-image' => get_template_directory_uri() . '/images/pattern.svg',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
        'caption',
	) );

	// Enable support for jetpack's portfolio custom type
	add_theme_support( 'jetpack-portfolio' );

}
endif; // pho_setup
add_action( 'after_setup_theme', 'pho_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function pho_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'pho' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

    register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'pho' ),
        'description'   => __( 'Footer widgets area appears, not surprisingly, in the footer of the site.', 'pho' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'pho_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pho_scripts() {

        // Load parent theme stylesheet even when child theme is active
        if ( is_child_theme() ) {
                wp_enqueue_style( 'pho-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
        } else {
                wp_enqueue_style( 'pho-style', get_stylesheet_uri() );
        }

        if (is_page_template('page-templates/page-nosidebar.php')
        	|| is_page_template('page-templates/portfolio.php')
        	|| is_page_template('page-templates/slideshow.php')
        	|| ! is_active_sidebar( 'sidebar-1' )) {
            wp_enqueue_style( 'pho-layout' , get_template_directory_uri() . '/layouts/no-sidebar.css' );
        } else {
            wp_enqueue_style( 'pho-layout' , get_template_directory_uri() . '/layouts/content-sidebar.css' );
        }

        // Load child theme stylesheet
        if ( is_child_theme() ) {
                wp_enqueue_style( 'pho-style', get_stylesheet_uri() );
        }

        // Inlude Google Webfonts
        wp_enqueue_style( 'pho-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto' );

        // FontAwesome
        wp_enqueue_style( 'pho_fontawesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css');

	    wp_enqueue_script( 'pho-functions', get_template_directory_uri() . '/js/functions.js', array(), '20161103', true );

	    wp_enqueue_script( 'pho-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

        wp_enqueue_script( 'pho-search', get_template_directory_uri() . '/js/hide-search.js', array(), '20120206', true );

        wp_enqueue_script( 'pho-superfish', get_template_directory_uri() . '/js/superfish.min.js', array('jquery'), '20140328', true );
        wp_enqueue_script( 'pho-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array('jquery'), '20140328', true );

		// Masonry is already shipped with Wordpress, it even includes imagesLoaded
        wp_enqueue_script( 'pho-masonry', get_template_directory_uri() . '/js/masonry-settings.js', array('masonry'), '20140401', true );

        wp_enqueue_script( 'pho-enquire', get_template_directory_uri() . '/js/enquire.min.js', false, '20140429', true );

        if (is_single() || is_author() ) {
            	wp_enqueue_script( 'pho-hide', get_template_directory_uri() . '/js/hide.js', array('jquery'), '20140310', true );
        }

	    wp_enqueue_script( 'pho-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if (!is_admin()) {

			// Enqueue Supersized JavaScript
			wp_register_script('jquery_supersized', get_template_directory_uri(). '/js/supersized.min.js', array('jquery') );
			wp_enqueue_script('jquery_supersized');

			// Enqueue Supersized Stylesheet
			wp_register_style( 'supersized-style', get_template_directory_uri() . '/inc/supersized.css', 'all' );
			wp_enqueue_style( 'supersized-style' );
		}
}
add_action( 'wp_enqueue_scripts', 'pho_scripts' );

/**
 * Include custom Post Type fml_photo for Flickr media on archive pages
 */
function pho_add_custom_post_types_to_query( $query ) {
	if ( !is_admin() && is_archive() && $query->is_main_query() && empty( $query->query_vars['suppress_filters'] )) {
		$query->set( 'post_type', array(
			'post',
			'fml_photo')
		);
	}
}
add_filter( 'pre_get_posts', 'pho_add_custom_post_types_to_query' );

/**
 * Force IE out its compatibility mode. Either use IE=11 oder IE=edge.
 */
function pho_ie_compatibility_header() {
    ?>
    	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php
}
add_action( 'send_headers', 'pho_ie_compatibility_header', 1);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Get social widget
 */
require get_template_directory() . '/inc/social-widget.php' ;
