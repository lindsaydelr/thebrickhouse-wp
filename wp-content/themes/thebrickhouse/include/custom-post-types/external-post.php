<?php
/**
 * Establish custom post type for external posts from other publications.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Register custom post type.
function register_custom_post_type_for_external_post() {

  $labels = array(
    'name'                  => 'External Posts',
    'singular_name'         => 'External Post',
    'menu_name'             => 'External Posts',
    'name_admin_bar'        => 'External Posts',
    'archives'              => 'External Post Archives',
    'attributes'            => 'External Post Attributes',
    'parent_item_colon'     => 'Parent External Post:',
    'all_items'             => 'All External Posts',
    'add_new_item'          => 'Add New External Post',
    'add_new'               => 'Add New',
    'new_item'              => 'New External Post',
    'edit_item'             => 'Edit External Post',
    'update_item'           => 'Update External Post',
    'view_item'             => 'View External Post',
    'view_items'            => 'View External Posts',
    'search_items'          => 'Search External Posts',
    'not_found'             => 'Not found',
    'not_found_in_trash'    => 'Not found in Trash',
    'featured_image'        => 'Featured Image',
    'set_featured_image'    => 'Set featured image',
    'remove_featured_image' => 'Remove featured image',
    'use_featured_image'    => 'Use as featured image',
    'insert_into_item'      => 'Insert into external post',
    'uploaded_to_this_item' => 'Uploaded to this external post',
    'items_list'            => 'External post list',
    'items_list_navigation' => 'External post list navigation',
    'filter_items_list'     => 'Filter external post list',
  );

  $args = array(
    'label'                 => 'External Post',
    'labels'                => $labels,
    'supports'              => array( 'title', 'author' ),
    'hierarchical'          => false,
    'taxonomies'            => array( ),
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 4,
    'menu_icon'             => 'dashicons-admin-links',
    'show_in_admin_bar'     => false,
    'show_in_nav_menus'     => false,
    'can_export'            => true,
    'has_archive'           => false,
    'exclude_from_search'   => true,
    'publicly_queryable'    => false,
    'capability_type'       => 'post',
    'show_in_rest'          => false,
  );

  register_post_type( EXTERNAL_POST_POST_TYPE, $args );

}
add_action( 'init', __NAMESPACE__ . '\register_custom_post_type_for_external_post', 0 );

// Check if post is external post.
function is_external_post( $post_ID = null ) {
  global $post;

  if ( empty( $post_ID ) && ! empty( $post ) ) {
    $post_ID = $post->ID;
  }

  if ( EXTERNAL_POST_POST_TYPE == get_post_type( $post_ID ) ) {
    return true;
  }
  else {
    return false;
  }
}

// Get title/description/image/etc from external post URL.
function cached__get_external_post_details( $post_ID = null ) {
  global $post;
  if ( empty( $post_ID ) && ! empty( $post ) ) {
    $post_ID = $post->ID;
  }

  $transient_name = 'brickhouse_external_post_details_' . $post_ID;

  if ( false === get_transient( $transient_name ) ) {
    // echo '<p>DEBUG: No transient found. Making new request.</p>';
    $post_details = get_external_post_details( $post_ID );
  }
  else {
    // echo '<p>DEBUG: Transient found! Using it.</p>';
    $post_details = get_transient( $transient_name );
  }

  return $post_details;
}

function get_external_post_details( $post_ID = null ) {
  global $post;
  if ( empty( $post_ID ) && ! empty( $post ) ) {
    $post_ID = $post->ID;
  }

  // Store this data in a transient.
  $transient_name = 'brickhouse_external_post_details_' . $post_ID;

  // Exit if this isn't actually an external post.
  if ( ! is_external_post( $post_ID ) ) {
    return;
  }

  $post_URL = get_field( 'external_post_url', $post_ID );
  $post_meta = get_open_graph_tags( $post_URL );

  // DEBUG.
  // echo '<pre style="background:#fff;color:#000;font-size:14px;border:2px red">DEBUG:<br>';
  // print_r( $post_meta );
  // echo '</pre>';

  $post_details = array(
    'publication'   => get_field( 'external_post_publication', $post_ID ),
    'url'           => $post_meta['url'],
    'title'         => $post_meta['title'],
    'description'   => $post_meta['description'],
    'thumbnail_url' => $post_meta['image'],
    'author'        => get_coauthors( $post_ID ),
    'date'          => $post_meta['date'],
  );

  // Clear existing transient data.
  delete_transient( $transient_name );

  // Save data in a transient.
  set_transient( $transient_name, $post_details, 3 * HOUR_IN_SECONDS );

  return $post_details;
}

function get_open_graph_tags( $url, $specified_tags = 0 ){
  // Get the document at the URL.
  $document = new \DOMDocument();
  @$document->loadHTML( file_get_contents( $url ) );

  // Get the <title> tag (which is not a meta tag).
  if ( $tags['title'] = $document->getElementsByTagName('title')->item(0) ) {
    $tags['title'] = $document->getElementsByTagName('title')->item(0)->nodeValue;
  }

  // Search for the first <time> tag.
  if ( $document->getElementsByTagName('time')->item(0) ) {
    $tags['date'] = $document->getElementsByTagName('time')->item(0)->getAttribute( 'datetime' );
  }

  // Get all meta tags.
  foreach ( $document->getElementsByTagName( 'meta' ) as $meta_tag ) {
    // Skip meta tags with 'name' attributes.
    if ( $meta_tag->getAttribute( 'name' ) ) {
      continue;
    }

    // Get the property name of the meta tag.
    $property = $meta_tag->getAttribute('property');

    // If name contains 'description' or 'keywords' or 'og:' (Open Graph).
    if ( in_array( $property, [ 'description', 'keywords' ] ) || strpos( $property, 'og:' ) === 0 ) {
      // Add to the tags array, with the key set to the meta tag's property name
      // minus the 'og:' and the value set to the meta tag's value.
      $tags[ str_replace( 'og:', '', $property ) ] = $meta_tag->getAttribute( 'content' );
    }
  }

  // If only specific tags were wanted, return those.
  if ( ! empty( $specified_tags ) ) {
    return array_intersect_key( $tags, array_flip( $specified_tags ) );
  }
  // Otherwise return all tags.
  else {
    return $tags;
  }
}

