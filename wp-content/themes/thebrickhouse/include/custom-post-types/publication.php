<?php
/**
 * Establish custom post type for publication and associated functions.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Register custom post type.
function register_custom_post_type_for_publication() {

  $labels = array(
    'name'                  => 'Publications',
    'singular_name'         => 'Publication',
    'menu_name'             => 'Publications',
    'name_admin_bar'        => 'Publications',
    'archives'              => 'Publication Archives',
    'attributes'            => 'Publication Attributes',
    'parent_item_colon'     => 'Parent Publication:',
    'all_items'             => 'All Publications',
    'add_new_item'          => 'Add New Publication',
    'add_new'               => 'Add New',
    'new_item'              => 'New Publication',
    'edit_item'             => 'Edit Publication',
    'update_item'           => 'Update Publication',
    'view_item'             => 'View Publication',
    'view_items'            => 'View Publications',
    'search_items'          => 'Search Publications',
    'not_found'             => 'Not found',
    'not_found_in_trash'    => 'Not found in Trash',
    'featured_image'        => 'Featured Image',
    'set_featured_image'    => 'Set featured image',
    'remove_featured_image' => 'Remove featured image',
    'use_featured_image'    => 'Use as featured image',
    'insert_into_item'      => 'Insert into Publication',
    'uploaded_to_this_item' => 'Uploaded to this Publication',
    'items_list'            => 'Publication list',
    'items_list_navigation' => 'Publication list navigation',
    'filter_items_list'     => 'Filter Publication list',
  );

  $args = array(
    'label'                 => 'Publication',
    'labels'                => $labels,
    'supports'              => array( 'title' ),
    'hierarchical'          => false,
    'taxonomies'            => array( ),
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 40,
    'menu_icon'             => 'dashicons-admin-site-alt',
    'show_in_admin_bar'     => false,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'publicly_queryable'    => false,
    'capability_type'       => 'post',
    'show_in_rest'          => false,
  );

  register_post_type( PUBLICATION_POST_TYPE, $args );

}
add_action( 'init', __NAMESPACE__ . '\register_custom_post_type_for_publication', 0 );


/**
 * Get publications.
 */
function get_publications() {
  $publications_query = get_posts( array(
    'posts_per_page' => -1,
    'post_type'      => PUBLICATION_POST_TYPE,
    'post_status'    => array( 'publish' ),
    'orderby'        => 'title',
    'order'          => 'ASC'
  ) );

  if ( empty( $publications_query ) ) {
    return;
  }


  // Build array of publication data.
  $publications = array();

  foreach ( $publications_query as $publication ) {
      // Get URL for this publication.
    if ( get_field( 'publication_in_multisite_network', $publication ) ) {
      $site_ID = get_field( 'publication_site', $publication );
      $site_ID = $site_ID[0];
      $publication_URL = get_site_url( $site_ID );
    }
    else {
      $publication_URL = get_field( 'publication_url', $publication );
    }

    $publications[] = array(
      'title'              => $publication->post_title,
      'description'        => get_field( 'publication_description', $publication ),
      'url'                => $publication_URL,
      'logo_attachment_ID' => get_field( 'publication_logo', $publication ),
    );
  }

  return $publications;
}


/**
 * Get publication info array.
 */
function get_publication_link( $publication_ID, $new_window = false ) {
  $name = get_the_title( $publication_ID );
  $url  = get_field( 'publication_url', $publication_ID );

  // Open the link in a new window if we want that.
  $attr = null;
  if ( $new_window ) {
    $attr = '  rel="noopener" target="_blank"';
  }

  $output = "<a href=\"$url\" $attr>$name</a>";

  return $output;
}


/**
 * Get publication info array.
 */
function get_publication( $publication_ID ) {
  $publication = array(
    'title'   => get_the_title( $publication_ID ),
    'url'     => get_field( 'publication_url', $publication_ID ),
    'logo_id' => get_field( 'publication_logo', $publication_ID ),
  );

  return $publication;
}


/**
 * Get publication information.
 */
function get_post_publication( $post_ID = null ) {
  global $post;
  if ( empty( $post_ID ) && ! empty( $post ) ) {
    $post_ID = $post->ID;
  }

  // Get the publication of this post.
  if ( is_external_post( $post_ID ) ) {
    $publication_ID = get_field( 'external_post_publication' );
  }
  else {
    $publication_ID = get_field( 'post_publication' );
  }

  // Get publication details and build an array of them.
  if ( ! empty( $publication_ID ) ) {
    $publication = get_publication( $publication_ID );
  }
  // If no publication was provided, assume The Brick House (this is not an
  // external post).
  else {
    $publication = array(
      'title'   => get_bloginfo( 'name' ),
      'url'     => get_bloginfo( 'url' ),
      'logo_id' => get_option( 'site_icon' ),
    );
  }

  return $publication;
}
