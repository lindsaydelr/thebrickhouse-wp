<?php
/**
 * Plugin settings for Co-Authors Plus.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Add serial commas to Co-Authors Plus' author list output. Filters
// `coauthors_default_between_last` to include a serial commas (Oxford comma)
// when there are three or more coauthors.
function add_serial_comma_to_coauthors_list( $between_last ) {
  if ( ' and ' === $between_last && count( get_coauthors() ) > 2 ) {
		$between_last = ', and ';
  }

	return $between_last;
}
add_filter( 'coauthors_default_between_last', __NAMESPACE__ . '\add_serial_comma_to_coauthors_list' );
