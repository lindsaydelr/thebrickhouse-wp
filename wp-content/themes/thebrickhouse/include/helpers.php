<?php
/**
 * Helper functions to use throughout the app.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Check if this is production.
function is_production()  {
  if ( 'production' == wp_get_environment_type() ) {
    return true;
  }
}

// Check if this is staging.
function is_staging()  {
  if ( 'staging' == wp_get_environment_type() ) {
    return true;
  }
}

// Check if this is development.
function is_development()  {
  if ( 'development' == wp_get_environment_type() ) {
    return true;
  }
}

// Determine if a user is an admin.
function user_is_admin() {
  return current_user_can( 'manage_options' );
}

// Determine if a user is an admin.
function user_is_editor() {
  return current_user_can( 'edit_others_pages' );
}

// Insert a new element into an array after the element with the specified key.
function array_insert_after( array $array, $key, array $new ) {
  $keys = array_keys( $array );
  $index = array_search( $key, $keys );
  $pos = false === $index ? count( $array ) : $index + 1;
  return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
}
