<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.alexisvillegas.com
 * @since             1.0.0
 * @package           AJV_Portfolio
 *
 * @wordpress-plugin
 * Plugin Name:       AJV Portfolio
 * Plugin URI:        http://www.alexisvillegas.com/plugins/ajv-portfolio
 * Description:       This plugin adds a portfolio section to your website.
 * Version:           1.0.0
 * Author:            Alexis J. Villegas
 * Author URI:        http://www.alexisvillegas.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ajv-portfolio
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 *
 */
function activate_ajv_portfolio() {
	
	require_once plugin_dir_path( __FILE__ ) . 'admin/class-ajv-portfolio-admin.php';
	
	AJV_Portfolio_Admin::add_notice();
	
}

register_activation_hook( __FILE__, 'activate_ajv_portfolio' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ajv-portfolio.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ajv_portfolio() {

	$plugin = new AJV_Portfolio();
	$plugin->run();

}
run_ajv_portfolio();
