<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              novaramedia.com
 * @since             1.0.0
 * @package           Novaramedia_Audio_Tool
 *
 * @wordpress-plugin
 * Plugin Name:       Novara Media Audio Tool
 * Plugin URI:        github.com/novaramedia/novaramedia-audio-tool
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Novara Media
 * Author URI:        novaramedia.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       novaramedia-audio-tool
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-novaramedia-audio-tool-activator.php
 */
function activate_novaramedia_audio_tool() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-novaramedia-audio-tool-activator.php';
	Novaramedia_Audio_Tool_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-novaramedia-audio-tool-deactivator.php
 */
function deactivate_novaramedia_audio_tool() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-novaramedia-audio-tool-deactivator.php';
	Novaramedia_Audio_Tool_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_novaramedia_audio_tool' );
register_deactivation_hook( __FILE__, 'deactivate_novaramedia_audio_tool' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-novaramedia-audio-tool.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_novaramedia_audio_tool() {

	$plugin = new Novaramedia_Audio_Tool();
	$plugin->run();

}
run_novaramedia_audio_tool();
