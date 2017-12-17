<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://viktormorales.com
 * @since             1.0.0
 * @package           Vhm_Contact_Buttons
 *
 * @wordpress-plugin
 * Plugin Name:       VHM Contact Buttons
 * Plugin URI:        https://viktormorales.com
 * Description:       WordPress Plugin to show the most popular platforms contact buttons
 * Version:           1.0.0
 * Author:            Viktor H. Morales
 * Author URI:        https://viktormorales.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       vhm-contact-buttons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-vhm-contact-buttons-activator.php
 */
function activate_vhm_contact_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vhm-contact-buttons-activator.php';
	Vhm_Contact_Buttons_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-vhm-contact-buttons-deactivator.php
 */
function deactivate_vhm_contact_buttons() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-vhm-contact-buttons-deactivator.php';
	Vhm_Contact_Buttons_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_vhm_contact_buttons' );
register_deactivation_hook( __FILE__, 'deactivate_vhm_contact_buttons' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-vhm-contact-buttons.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_vhm_contact_buttons() {

	$plugin = new Vhm_Contact_Buttons();
	$plugin->run();

}
run_vhm_contact_buttons();
