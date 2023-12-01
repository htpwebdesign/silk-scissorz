<?php

/**
 * Silk & Scissorz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Silk_&_Scissorz
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function silk_scissorz_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Silk & Scissorz, use a find and replace
		* to change 'silk-scissorz' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('silk-scissorz', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__('Header Menu', 'silk-scissorz'),
			'header-submenu' => esc_html__('Header Submenu', 'silk-scissorz'),
			'social-media' => esc_html__('Social Media - Footer Left Side', 'silk-scissorz'),
			'footer-right' => esc_html__('Footer Quick Link', 'silk-scissorz'),
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
			'silk_scissorz_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');

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
add_action('after_setup_theme', 'silk_scissorz_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function silk_scissorz_content_width()
{
	$GLOBALS['content_width'] = apply_filters('silk_scissorz_content_width', 640);
}
add_action('after_setup_theme', 'silk_scissorz_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function silk_scissorz_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'silk-scissorz'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'silk-scissorz'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'silk_scissorz_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function silk_scissorz_scripts()
{

	// Google Fonts
	wp_enqueue_style(
		'silk-googlefonts',
		'https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Playfair+Display:wght@400;700;900&display=swap',
		array(),
		null, // only use null for Google Fonts
		'all'
	);


	wp_enqueue_style('silk-scissorz-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('silk-scissorz-style', 'rtl', 'replace');

	wp_enqueue_script('silk-scissorz-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	// Enqueue Swiper on the Homepage
	if (is_front_page()) {
		wp_enqueue_script('swiper-scripts', get_template_directory_uri() . '/js/swiper-bundle.min.js', array(), '11.0.4', array('strategy' => 'defer'));
		wp_enqueue_script('swiper-configs', get_template_directory_uri() . '/js/swiper-configs.js', array('swiper-scripts'), _S_VERSION, array('strategy' => 'defer'));
	}

	//Enqueue Dropdown js
	if (is_page(30)) {
		wp_enqueue_script('dropdown', get_template_directory_uri() . '/js/dropdown.js',  array('jquery'), _S_VERSION, true);
		wp_enqueue_script('accordion-faq', get_template_directory_uri() . '/js/accordion.js',  array('jquery'), _S_VERSION, true);
	}

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	// Google Map For ACF
	wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAbDccbZ61WQAxDVzfGWOBdsahhN5AHT10&callback=Function.prototype', array(), _S_VERSION, true);
	wp_enqueue_script('acf-map-script', get_template_directory_uri() . '/js/acf-map.js', array('jquery', 'google-map'), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'silk_scissorz_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register CPTs and Taxonomies.
 */

require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Change the Ecerpt Length from 55 to 20
function silk_excerpt_length($length)
{
	return 20;
}
add_filter('excerpt_length', 'silk_excerpt_length', 999);

// Modify the end of the excerpt
function silk_excerpt_more($more)
{
	$more = '...<a class"" href="' . esc_url(get_permalink()) . '">Continue Reading</a>';
	return $more;
}

add_filter('excerpt_more', 'silk_excerpt_more');

function my_acf_google_map_api($api)
{
	$api['key'] = 'AIzaSyAbDccbZ61WQAxDVzfGWOBdsahhN5AHT10';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');



function new_loop_shop_per_page($cols)
{
	// $cols contains the current number of products per page based on the value stored on Options –> Reading
	// Return the number of products you wanna show per page.
	$cols = 6;
	return $cols;
function new_loop_shop_per_page($cols)
{
	// $cols contains the current number of products per page based on the value stored on Options –> Reading
	// Return the number of products you wanna show per page.
	$cols = 6;
	return $cols;
}
/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('loop_shop_per_page', 'new_loop_shop_per_page');
add_filter('loop_shop_per_page', 'new_loop_shop_per_page');

add_action('wp_dashboard_setup', 'my_custom_dashboard_widget');
function my_custom_dashboard_widget()
{
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_video_widget', 'Video Tutorial', 'custom_dashboard_fun');
function my_custom_dashboard_widget()
{
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_video_widget', 'Video Tutorial', 'custom_dashboard_fun');
}

function custom_dashboard_fun()
{
function custom_dashboard_fun()
{
	echo '<a href="https://gearoid.me/pokemon/" target="_blank">See the tutorial</a>';
}
}

function wporg_remove_all_dashboard_metaboxes()
{
	// Remove the rest of the dashboard widgets
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('health_check_status', 'dashboard', 'normal');
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
	remove_meta_box('dashboard_activity', 'dashboard', 'normal');
	remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal');
	remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes');
function wporg_remove_all_dashboard_metaboxes()
{
	// Remove the rest of the dashboard widgets
	remove_meta_box('dashboard_primary', 'dashboard', 'side');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
	remove_meta_box('health_check_status', 'dashboard', 'normal');
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
	remove_meta_box('dashboard_activity', 'dashboard', 'normal');
	remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal');
	remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes');

function my_login_logo()
{ ?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sas-favicon-purple.png);
			height: 140px;
			width: 140px;
function my_login_logo()
{ ?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
			background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/sas-favicon-purple.png);
			height: 140px;
			width: 140px;
			background-size: 140px 140px;
			background-repeat: no-repeat;
			padding-bottom: 30px;
		}
	</style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');
			padding-bottom: 30px;
		}
	</style>
<?php }
add_action('login_enqueue_scripts', 'my_login_logo');

// Remove admin menu links for non-Administrator accounts
function fwd_remove_admin_links()
{
	if (!current_user_can('manage_options')) {
		remove_menu_page('edit.php');           // Remove Posts link
		remove_menu_page('edit-comments.php');  // Remove Comments link
	}
}
add_action('admin_menu', 'fwd_remove_admin_links');

// Create Block Template 
function silk_block_editor_template()
{
	// Booking Page
	if (isset($_GET['post']) && '141' == $_GET['post']) {
		$post_type_object = get_post_type_object('page');
		$post_type_object->template = array(
			// define blocks here...
			array(
				'core/paragraph',
				array(
					'placeholder' => 'Add your introduction here...'
				)
			),
		);
		$post_type_object->template_lock = 'all';
	}
	// Cart Page
	if (isset($_GET['post']) && '15' == $_GET['post']) {
		$post_type_object = get_post_type_object('page');
		$post_type_object->template = array(
			// define blocks here...
			array(
				'core/shortcode',
				array(
					'placeholder' => 'Add your shortcode here...'
				)
			),
		);
		$post_type_object->template_lock = 'all';
	}
	// Checkout Page
	if (isset($_GET['post']) && '16' == $_GET['post']) {
		$post_type_object = get_post_type_object('page');
		$post_type_object->template = array(
			// define blocks here...
			array(
				'core/shortcode',
				array(
					'placeholder' => 'Add your shortcode here...'
				)
			),
		);
		$post_type_object->template_lock = 'all';
	}
	// My Account Page
	if (isset($_GET['post']) && '17' == $_GET['post']) {
		$post_type_object = get_post_type_object('page');
		$post_type_object->template = array(
			// define blocks here...
			array(
				'core/shortcode',
				array(
					'placeholder' => 'Add your shortcode here...'
				)
			),
		);
		$post_type_object->template_lock = 'all';
	}
	// Services Page
	if (isset($_GET['post']) && '24' == $_GET['post']) {
		$post_type_object = get_post_type_object('page');
		$post_type_object->template = array(
			// define blocks here...
			array(
				'core/paragraph',
				array(
					'placeholder' => 'Add your introduction here...'
				)
			),
		);
		$post_type_object->template_lock = 'all';
	}
}

add_action('init', 'silk_block_editor_template');

// Change the Block Editor to Classic Editor
function silk_post_filter($use_block_editor, $post)
{
	$page_ids = array(26, 30, 22);
	if (in_array($post->ID, $page_ids)) {
		return false;
	} else {
		return $use_block_editor;
	}
}
add_filter('use_block_editor_for_post', 'silk_post_filter', 10, 2);
