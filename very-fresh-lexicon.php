<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              freshlabs.de
 * @since             1.0.0
 * @package           Very_Fresh_Lexicon
 *
 * @wordpress-plugin
 * Plugin Name:       Very fresh Lexicon
 * Plugin URI:        https://freshlabs.de
 * Description:       Flexicon is a simple yet customizable plugin to create a lexicon in wordpress.
 * Version:           1.0.5
 * Author:            freshlabs.de
 * Author URI:        https://profiles.wordpress.org/freshlabs/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       very-fresh-lexicon
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Very_Fresh_Lexicon_VERSION', '1.0.5' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-very-fresh-lexicon-activator.php
 */
function activate_Very_Fresh_Lexicon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-very-fresh-lexicon-activator.php';
	Very_Fresh_Lexicon_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-very-fresh-lexicon-deactivator.php
 */
function deactivate_Very_Fresh_Lexicon() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-very-fresh-lexicon-deactivator.php';
	Very_Fresh_Lexicon_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_Very_Fresh_Lexicon' );
register_deactivation_hook( __FILE__, 'deactivate_Very_Fresh_Lexicon' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-very-fresh-lexicon.php';


/**
 * Letter Filter
 */
function flex_posts_where( $where, $query ) {
    global $wpdb;

    $starts_with = esc_sql( $query->get( 'starts_with' ) );

    if ( $starts_with ) {
        $where .= " AND $wpdb->posts.post_title LIKE '$starts_with%'";
    }

    return $where;
}
add_filter( 'posts_where', 'flex_posts_where', 10, 2 );

/**
 * Archive Page Flex
 */
function get_flex_pt_template( $archive_template ) {
     global $post;

     if ( is_post_type_archive ( 'flex' ) ) {
          $archive_template = dirname( __FILE__ ) . '/public/partials/archive-flex.php';
     }
     return $archive_template;
}

add_filter( 'archive_template', 'get_flex_pt_template' ) ;

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_Very_Fresh_Lexicon() {

	$plugin = new Very_Fresh_Lexicon();
	$plugin->run();
}
run_Very_Fresh_Lexicon();
