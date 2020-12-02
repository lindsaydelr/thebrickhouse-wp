<?php
/**
 * The functions.php file, loaded automatically by WordPress.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;


// Create a version number for cache-busting assets.
// -----------------------------------------------------------------------------
// WARNING: The next line is re-written by the Gulp task that builds the
// production files, so leave the next line alone or cache-busting will break!
define( 'CACHEBUST', '1606944421251' );
// -----------------------------------------------------------------------------

// General helper functions and settings.
// DO NOT REMOVE OR MOVE THIS LINE. Subsequent scripts rely on it.
require_once( 'include/helpers.php' );


/**
 * Define constants.
 */

// Frontend values.
define( 'THEME_COLOR', '#823111' );

// Post types.
define( 'PUBLICATION_POST_TYPE', 'publication' );
define( 'EXTERNAL_POST_POST_TYPE', 'external-post' );
define( 'INTERNAL_AND_EXTERNAL_POST_TYPES', array( 'post', EXTERNAL_POST_POST_TYPE ) );


/**
 * Include theme code files.
 */

// Set required plugins.
require_once( 'lib/class-tgm-plugin-activation.php' );
require_once( 'include/required-plugins.php' );

// Admin settings and adjustments.
require_once( 'include/admin.php' );

// Settings for the Advanced Custom Fields plugin.
require_once( 'include/acf-settings.php' );
require_once( 'include/coauthors-plus-settings.php' );
require_once( 'include/yoast-seo-settings.php' );

// Custom post types.
require_once( 'include/custom-post-types/external-post.php' );
require_once( 'include/custom-post-types/publication.php' );

// Frontend.
require_once( 'include/frontend.php' );
require_once( 'include/posts.php' );
