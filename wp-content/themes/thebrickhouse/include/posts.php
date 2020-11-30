<?php
/**
 * Functions and adjustments for posts.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


/**
 * Alter the posts query:
 * - include external links
 * - exclude featured links (only on the homepage)
 */
function alter_posts_query( $query ) {
  // Abort if not main query or admin or not the posts query.
  if ( ! $query->is_main_query() || is_admin() || 'post' !== get_query_var( 'post_type' ) ) {
    return;
  }

  // Make sure external posts are included.
  set_query_var( 'post_type',    INTERNAL_AND_EXTERNAL_POST_TYPES );

  // If we're looking at the homepage, exclude the featured posts from the post list.
  if ( is_home() ) {
    set_query_var( 'post__not_in', get_field( 'homepage_featured_posts', 'option' ) );
  }
}
add_filter( 'pre_get_posts', __NAMESPACE__ . '\alter_query_to_remove_featured_posts_from_homepage_post_list' );
