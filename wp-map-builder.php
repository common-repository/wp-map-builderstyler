<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @since             1.0.0
 * @package           Wp_Map_Builder
 *
 * @wordpress-plugin
 * Plugin Name:       WP Map Builder/Styler
 * Description:       WP Map Builder/Styler can allow you to create map and apply different styles easily. You have to just add Google Map Key, lat/long and Zoom level.
 * Version:           1.2.0
 * Author:            Patrik
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-map-builder
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
define( 'WMB_PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-map-builder-activator.php
 */
function activate_wp_map_builder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-map-builder-activator.php';
	Wp_Map_Builder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-map-builder-deactivator.php
 */
function deactivate_wp_map_builder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-map-builder-deactivator.php';
	Wp_Map_Builder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_map_builder' );
register_deactivation_hook( __FILE__, 'deactivate_wp_map_builder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-map-builder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_map_builder() {

	$plugin = new Wp_Map_Builder();
	$plugin->run();

}
run_wp_map_builder();
