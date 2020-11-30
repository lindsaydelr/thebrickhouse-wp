<?php
/**
 * Admin settings and UI adjustments.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Add admin JS and CSS.
function add_admin_js_and_css() {
  // Load theme admin stylesheet.
  wp_enqueue_style( 'admin-stylesheet', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/admin.css', false, CACHEBUST );
}
add_action('admin_enqueue_scripts', __NAMESPACE__ . '\add_admin_js_and_css');

// Remove admin toolbar navigation menu items.
function remove_admin_toolbar_items() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu( 'wp-logo' );   // WordPress logo
}
add_action( 'wp_before_admin_bar_render', __NAMESPACE__ . '\remove_admin_toolbar_items' );

// Add navigation menu locations.
function create_menus() {
  register_nav_menus( array(
    'header' => 'Header',
    'footer' => 'Footer',
  ) );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\create_menus' );

// Add admin options pages.
function add_admin_options_pages() {
  // Homepage.
  acf_add_options_page( array(
    'page_title' => 'Homepage',
    'menu_title' => 'Homepage',
    'menu_slug'  => 'homepage',
    'icon_url'   => 'dashicons-admin-home',
    'autoload'   => true,
    'position'   => '4.4'
  ) );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\add_admin_options_pages');

// Set image defaults:
// 1. Images link to nothing by default.
update_option( 'image_default_link_type', 'none' );
// 2. Images align center by default.
update_option( 'image_default_align', 'center' );

// Add support for WP features and image sizes.
function add_theme_support_options() {
  // Add support for nav menus and automatic title tag.
  add_theme_support( 'menus' );
  add_theme_support( 'title-tag' );

  // Enable support for Post Thumbnails.
  // (This size is referred to as 'post-thumbnail' when retrieving an image. Not
  // to be confused with 'thumbnail' which is the smallest built-in size.)
  add_theme_support( 'post-thumbnails' );
  // set_post_thumbnail_size( 350, 275, true);

  // Set built-in image sizes:
  // Don't bother changing the 150×150 thumbnails
  update_option( 'medium_size_w', 600 ); // (WP default is 300×300, no crop)
  update_option( 'medium_size_h', 600 );
  update_option( 'medium_crop',   false );

  update_option( 'medium_large_size_w', 800 ); // (WP default is 768×768, no crop)
  update_option( 'medium_large_size_h', 800 );
  update_option( 'medium_large_crop',   false );

  update_option( 'large_size_w', 1400 ); // (WP default is 1024×1024, no crop)
  update_option( 'large_size_h', 1400  );
  update_option( 'large_crop',   false );
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\add_theme_support_options' );


/**
 * Disable emojis.
 */
function disable_emoji_scripts() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

  // Remove from TinyMCE
  add_filter( 'tiny_mce_plugins', __NAMESPACE__ . '\disable_tinymce_emoji' );
}
add_action( 'init', __NAMESPACE__ . '\disable_emoji_scripts' );

// Filter out the TinyMCE Emoji plugin.
function disable_tinymce_emoji( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}
