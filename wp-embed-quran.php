<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://kamalabs.com
 * @since             1.0.0
 * @package           Wp_Embed_Quran
 *
 * @wordpress-plugin
 * Plugin Name:       WP Embed Quran
 * Plugin URI:        https://github.com/emkamal/wp_embed_quran
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Mustafa Kamal
 * Author URI:        http://kamalabs.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-embed-quran
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-embed-quran-activator.php
 */
function activate_wp_embed_quran() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-embed-quran-activator.php';
	Wp_Embed_Quran_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-embed-quran-deactivator.php
 */
function deactivate_wp_embed_quran() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-embed-quran-deactivator.php';
	Wp_Embed_Quran_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_embed_quran' );
register_deactivation_hook( __FILE__, 'deactivate_wp_embed_quran' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-embed-quran.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_embed_quran() {

	$plugin = new Wp_Embed_Quran();
	$plugin->run();

}
run_wp_embed_quran();
