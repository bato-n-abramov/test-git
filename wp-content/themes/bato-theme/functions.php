<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/* defines START */
define( '_TP_', get_stylesheet_directory_uri() ); //theme path
define( '_IMAGES_', _TP_.'/images' ); //images path
/* defines END */


add_action( 'wp_enqueue_scripts', 'load_js_css');
function load_js_css() {
    wp_enqueue_style('swiper', _TP_ . '/css/swiper-bundle.min.css');
    wp_enqueue_style('styles',  _TP_ . '/css/styles.css');
    wp_enqueue_style('media-styles', _TP_ . '/css/media.css');

    wp_enqueue_script('swiper', _TP_ . '/js/swiper-bundle.min.js',array('jquery'),null,false);
    wp_enqueue_script('script', _TP_ . '/js/script.js',array('jquery'),null,false);
}



/* REMOVE EMOJI START */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
/* REMOVE EMOJI END */

/* REMOVE GUTENBERG STYLES START */
function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css' );
/* REMOVE GUTENBERG STYLES END */


/* REMOVE ATTRS START */
add_action('wp_loaded', 'prefix_output_buffer_start');
function prefix_output_buffer_start() {
    ob_start("prefix_output_callback");
}
function prefix_output_callback($buffer) {
    return preg_replace( "%[ ]type=[\'\"]text\/(javascript|css)[\'\"]%", '', $buffer );
}
/* REMOVE ATTRS END */


/* ACF theme options START */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(
        array(
            'page_title' => 'Options',
            'menu_title' => 'Options',
            'menu_slug' => 'theme-options',
            'capability' => 'edit_posts',
            'parent_slug' => '',
            'position' => false,
        )
    );
}
/* ACF theme options END */



/* hide admin TABS START */
function remove_menu () 
{
   remove_menu_page('edit-comments.php');
} 

add_action('admin_menu', 'remove_menu');
/* hide admin TABS END */

/* body class START */
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
        $classes[] = 'template-' . str_replace(".php","",get_page_template_slug());
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );
/* body class END */


/* insert image START */
function insertImage($file, $class = '', $width = 100, $height = 100, $return = 0) {
    
    if (!empty($file)) {

        if(!is_array($file)) {
            $file_url = _IMAGES_.'/'.$file;
            $file_title =  pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
        } else {
            $file_url = $file['url'];
            $file_title = $file['alt'];
            $extension = pathinfo($file['filename'], PATHINFO_EXTENSION);
        }

        $context = stream_context_create(array (
            'http' => [
                'header' => 'Authorization: Basic ' . base64_encode("demo:a30599b78355")
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ));

        if (!@file_get_contents($file_url, false, $context) === false) {
            if ($extension == 'svg') {
                $content = file_get_contents($file_url, false, $context);
                $content = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $content);
                if ($return) {
                    return $content;
                }

                echo $content;
            } else {
                $content = '<img 
                    class="'.$class.'" 
                    src="'.$file_url. '" 
                    alt="'.$file_title.'"
                    width="'.$width.'"
                    height="'.$height.'" 
                />';

                if ($return) {
                    return $content;
                }

                echo $content;
            }
        }
    }
}
/* insert image END */

/* dump START */
function dd($arr) {
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
    die;
}
/* dump END */



add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $path;
    
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    
    
    // return
    return $paths;
    
}


add_action('after_setup_theme', function(){
    register_nav_menus( array(
        'main_menu'   => 'Main menu',
        'footer_menu'   => 'Footer menu',
        'mobile_menu'   => 'Mobile menu',
    ));
});


/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function test_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on test, use a find and replace
		* to change 'test' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'test', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'test' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'test_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'test_setup' );


// Remove WP toolbar
add_filter('show_admin_bar', '__return_false');


// Remove autoupdate plugin
add_filter( 'auto_update_plugin', '__return_false' );

