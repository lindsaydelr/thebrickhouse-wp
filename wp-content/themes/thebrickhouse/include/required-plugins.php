<?php
/**
 * Register required and suggested plugins.
 *
 * @package TheBrickHouse
 */

namespace TheBrickHouse;

add_action( 'tgmpa_register', __NAMESPACE__ . '\register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

function register_required_plugins() {

  $bundle_dir = get_template_directory() . '/lib/bundled-plugins/';

  $plugins = array(

    /**
     * Required:
     */
    array(
      'name'               => 'ACF Field Styles Enhanced', // The plugin name.
      'slug'               => 'acf-field-styles-enhanced', // The plugin slug (typically the folder name).
      'source'             => 'https://github.com/matthewmcvickar/acf-field-styles-enhanced/archive/master.zip', // The plugin source.
      'required'           => true, // If false, the plugin is only 'recommended' instead of required.
      'version'            => '0.0.28', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
      'force_activation'   => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
      'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
    ),

    array(
      'name'               => 'Advanced Custom Fields Pro',
      'slug'               => 'advanced-custom-fields-pro',
      'source'             => $bundle_dir . 'advanced-custom-fields-pro.zip',
      'required'           => true,
      'version'            => '5.9.3',
      'force_activation'   => true,
      'force_deactivation' => false,
    ),

    array(
      'name'               => 'ACF Content Analysis for Yoast SEO',
      'slug'               => 'acf-content-analysis-for-yoast-seo',
      'required'           => true,
      'version'            => '2.7',
      'force_activation'   => true,
      'force_deactivation' => false,
    ),

    array(
      'name'               => 'Co-Authors Plus',
      'slug'               => 'co-authors-plus',
      'required'           => true,
      'version'            => '3.4.3',
      'force_activation'   => true,
      'force_deactivation' => false,
    ),

    array(
      'name'               => 'Redirection',
      'slug'               => 'redirection',
      'required'           => true,
      'version'            => '4.9.1',
      'force_activation'   => true,
      'force_deactivation' => false,
    ),

    array(
      'name'               => 'Yoast SEO',
      'slug'               => 'wordpress-seo',
      'required'           => true,
      'version'            => '15.3',
      'force_activation'   => true,
      'force_deactivation' => false,
    ),

    array(
      'name'               => 'Advanced Custom Fields: Sites',
      'slug'               => 'acf-sites',
      'required'           => true,
      'version'            => '2.0.0',
      'force_activation'   => true,
      'force_deactivation' => false,
    ),

    // array(
    //   'name'               => 'Classic Editor',
    //   'slug'               => 'classic-editor',
    //   'required'           => true,
    //   'version'            => '1.5',
    //   'force_activation'   => true,
    //   'force_deactivation' => false,
    // ),


    /**
     * Recommended:
     */
    array(
      'name'     => 'WP DB Migrate Pro',
      'slug'     => 'wp-migrate-db-pro',
      'source'   => $bundle_dir . 'wp-migrate-db-pro-1.9.13.zip',
      'required' => false,
      'version'  => '1.9.13',
    ),

    array(
      'name'     => 'WP DB Migrate Pro: Multisite Tools',
      'slug'     => 'wp-migrate-db-pro-multisite-tools',
      'source'   => $bundle_dir . 'wp-migrate-db-pro-multisite-tools-1.2.6.zip',
      'required' => false,
      'version'  => '1.2.6',
    ),

  );

  $config = array(
    'id'           => 'fyusion',               // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => '',                      // Default absolute path to bundled plugins.
    'menu'         => 'tgmpa-install-plugins', // Menu slug.
    'parent_slug'  => 'themes.php',            // Parent menu slug.
    'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
    'has_notices'  => true,                    // Show admin notices or not.
    'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
    'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
    'is_automatic' => false,                   // Automatically activate plugins after installation or not.
    'message'      => '',                      // Message to output right before the plugins table.
  );

  tgmpa( $plugins, $config );

}

?>
