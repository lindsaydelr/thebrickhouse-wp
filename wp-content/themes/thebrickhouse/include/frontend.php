<?php
/**
 * Functions and adjustments for the frontend.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Disable emojicons.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Disable extra feed links.
remove_action( 'wp_head', 'feed_links_extra' );
remove_action( 'wp_head', 'wlwmanifest_link' );

// Disable block editor CSS.
function remove_block_editor_stylesheet(){
  wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\remove_block_editor_stylesheet', 100 );

// Include theme stylesheet and script.
function load_blog_scripts_and_stylesheets() {
  // Load theme stylesheet.
  wp_enqueue_style( 'theme-stylesheet', get_template_directory_uri() . '/assets/css/main.css', false, CACHEBUST );

  // Do not load theme jQuery.
  // wp_deregister_script('jquery');

  // Load theme scripts.
  wp_register_script( 'theme-script', get_template_directory_uri() . '/assets/js/main.js', null, CACHEBUST, true );
  wp_enqueue_script( 'theme-script' );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\load_blog_scripts_and_stylesheets' );

// Move the WP admin bar to the bottom of the screen on the frontend.
function move_admin_bar_to_bottom_of_screen() {
  // Exit if this is the admin or nobody is logged in.
  if ( is_admin() || ! is_user_logged_in() ) {
    return;
  }

  // Output CSS to move the admin bar to the bottom of the screen.
  ?>

  <style>
  div#wpadminbar {
    top: auto;
    bottom: 0;
    position: fixed;
  }

  .ab-sub-wrapper {
    bottom: 32px;
  }

  html {
    margin-top: 0 !important;
    margin-bottom: 32px !important;
  }

  @media screen and (max-width: 782px) {
    .ab-sub-wrapper {
      bottom: 46px;
    }

    html {
      margin-bottom: 46px !important;
    }
  }
  </style>

  <?php
}
add_action( 'wp_head', __NAMESPACE__ . '\move_admin_bar_to_bottom_of_screen', 99 );

// Show an SVG.
function get_svg( $name, $class = '' ) {
  $svg_path = '/assets/images/' . $name . '.svg';

  // Find file in child or parent theme.
  if ( file_exists( get_stylesheet_directory() . $svg_path ) ) {
    $file = get_stylesheet_directory() . $svg_path;
  }
  else {
    return;
  }

  $output = '<span class="svg-container svg--' . $name . ' ' . $class . '">' . file_get_contents( $file ) . '</span>';
  return $output;
}

// Customize the automatic archive title: remove all prefixes.
function customize_archive_title( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  } elseif ( is_tag() ) {
    $title = single_tag_title( '', false );
  } elseif ( is_author() ) {
    $title = '' . get_the_author();
  } elseif ( is_post_type_archive() ) {
    $title = post_type_archive_title( '', false );
  } elseif ( is_tax() ) {
    $title = single_term_title( '', false );
  }

  return $title;
}
add_filter( 'get_the_archive_title', __NAMESPACE__ . '\customize_archive_title' );

// Register the 'year_filter' query variable so we can filter by it. For some
// reason, WordPress will not allow me to use the built-in `year` and
// `post_type` filters together. It keeps trying to load the index.php template
// instead of trying for archive-press-release.php or archive.php or date.php.
// I'm tired of fighting it. Support thread here:
// https://wordpress.org/support/topic/year-archive-for-custom-post-type/
function register_year_filter_query_var( $vars ) {
  $vars[] = 'year_filter';
  return $vars;
}
add_filter( 'query_vars', __NAMESPACE__ . '\register_year_filter_query_var' );

// Alter WP query to support year filter for press releases and media coverage.
function add_year_filter_to_media_coverage_and_press_releases( $query ) {
  // Exit if not frontend or not main query.
  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }

  // Exit if we're not dealing with media coverage or press releases.
  if ( empty( get_query_var( 'post_type' ) )
    || ! ( get_query_var( 'post_type' ) == MEDIA_COVERAGE_POST_TYPE
        || get_query_var( 'post_type' ) == PRESS_RELEASE_POST_TYPE )
  ) {
    return;
  }

  // Get *all* press releases and media coverage, because there's no pagination
  // design available.
  set_query_var( 'numberposts', -1 );
  set_query_var( 'posts_per_page', -1 );

  // If a year was selected, show only posts from that year.
  if ( ! empty( get_query_var( 'year_filter' ) ) ) {
    set_query_var( 'year', get_query_var( 'year_filter' ) );
  }
}
add_filter( 'pre_get_posts', __NAMESPACE__ . '\add_year_filter_to_media_coverage_and_press_releases' );

// Get SVG attachment uploaded to WordPress.
function get_svg_attachment( $id, $dimensions = array() ) {
  $image_url      = wp_get_attachment_url( $id );
  $image_alt      = get_post_meta( $id, '_wp_attachment_image_alt', TRUE );
  $file_extension = pathinfo( $image_url, PATHINFO_EXTENSION );

  if ( 'svg' !== $file_extension ) {
    return false;
  }

  $width = isset( $dimensions['width'] ) ? $dimensions['width'] : null;
  $height = isset( $dimensions['height'] ) ? $dimensions['height'] : null;

  return '<img src="' . $image_url . '"
    loading="lazy"
    class="svg-image"
    alt="' . $image_alt . '"
    width="' . $width . '"
    height="' . $height . '"
  >';
}
