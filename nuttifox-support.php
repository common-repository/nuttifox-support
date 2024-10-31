<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://nuttifox.com
 * @since             1.0.0
 * @package           Nuttifox_Support
 *
 * @wordpress-plugin
 * Plugin Name:       Nuttifox Support
 * Plugin URI:        https://nuttifox.com/support
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Nuttifox
 * Author URI:        https://nuttifox.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nuttifox-support
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
define( 'NUTTIFOX_SUPPORT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nuttifox-support-activator.php
 */
function activate_nuttifox_support() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nuttifox-support-activator.php';
	Nuttifox_Support_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nuttifox-support-deactivator.php
 */
function deactivate_nuttifox_support() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nuttifox-support-deactivator.php';
	Nuttifox_Support_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nuttifox_support' );
register_deactivation_hook( __FILE__, 'deactivate_nuttifox_support' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nuttifox-support.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_nuttifox_support() {

	$plugin = new Nuttifox_Support();
	$plugin->run();

}
run_nuttifox_support();
