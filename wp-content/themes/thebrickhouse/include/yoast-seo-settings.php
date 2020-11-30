<?php
/**
 * Settings for Yoast SEO plugin.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Move Yoast metabox to the bottom of the screen.
function move_yoast_metabox_to_bottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', __NAMESPACE__ . '\move_yoast_metabox_to_bottom');
