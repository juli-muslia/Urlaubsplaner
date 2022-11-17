<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://julianmuslia.com
 * @since             1.0.0
 * @package           Publishing_Urlaubs
 *
 * @wordpress-plugin
 * Plugin Name:       Publishing Urlaubs
 * Plugin URI:        https://publishing-group.de
 * Description:       Publishing Group Urlaubs Plan is a plugin developed for Publishing Group GmbH vacation planner
 * Version:           1.0.0
 * Author:            Julian Muslia
 * Author URI:        https://julianmuslia.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       publishing-urlaubs
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
define( 'PUBLISHING_URLAUBS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-publishing-urlaubs-activator.php
 */
function activate_publishing_urlaubs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-publishing-urlaubs-activator.php';

	$activator = new Publishing_Urlaubs_Activator();
	$activator->activate();

	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-publishing-urlaubs-deactivator.php
 */
function deactivate_publishing_urlaubs() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-publishing-urlaubs-deactivator.php';
	Publishing_Urlaubs_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_publishing_urlaubs' );
register_deactivation_hook( __FILE__, 'deactivate_publishing_urlaubs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-publishing-urlaubs.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_publishing_urlaubs() {

	$plugin = new Publishing_Urlaubs();
	$plugin->run();

}
run_publishing_urlaubs();
