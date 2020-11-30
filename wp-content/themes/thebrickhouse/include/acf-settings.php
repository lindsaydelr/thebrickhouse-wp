<?php
/**
 * Plugin settings for ACF.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Speed up ACF loading time by hiding WP Admin custom meta value box.
add_filter( 'acf/settings/remove_wp_meta_box', '__return_true' );

// Save ACF values to local JSON files.
function set_acf_json_save_point( $path ) {
  $path = get_template_directory() . '/include/acf-field-groups';
  return $path;
}
add_filter( 'acf/settings/save_json', __NAMESPACE__ . '\set_acf_json_save_point' );

function set_acf_json_load_point( $paths ) {
  unset( $paths[0] );
  $paths[] = get_template_directory() . '/include/acf-field-groups';
  return $paths;
}
add_filter( 'acf/settings/load_json', __NAMESPACE__ . '\set_acf_json_load_point' );

// Sort all ACF post 'relationship' and 'post object' fields reverse
// chronologically.
function sort_relationship_field_lists_chronologically( $args, $field, $post ) {
  $args['orderby'] = 'post_date';
  $args['order'] = 'DESC';
  return $args;
}
add_filter( 'acf/fields/relationship/query', __NAMESPACE__ . '\sort_relationship_field_lists_chronologically', 10, 3 );
add_filter( 'acf/fields/post_object/query', __NAMESPACE__ . '\sort_relationship_field_lists_chronologically', 10, 3 );

// Add simplified WYSIWYG editor toolbars.
function add_simplified_wysiwyg_toolbar( $toolbars ) {
  $toolbars['Bold, Italic, Links'] = array(
    1 => array(
      'bold',
      'italic',
      'link',
      'unlink',
    )
  );

  return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars', __NAMESPACE__ . '\add_simplified_wysiwyg_toolbar' );
