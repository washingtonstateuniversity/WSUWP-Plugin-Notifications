<?php
/*
Plugin Name: WSUWP Notifications
Version: 0.0.1
Description: Manages notifications sent through WordPress at WSU.
Author: washingtonstateuniversity, jeremyfelt
Author URI: https://web.wsu.edu/
Plugin URI: https://github.com/washingtonstateuniversity/WSUWP-Plugin-Notifications
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// The core plugin class.
require dirname( __FILE__ ) . '/includes/class-wsuwp-plugin-notifications.php';

add_action( 'after_setup_theme', 'WSUWP_Plugin_Notifications' );
/**
 * Start things up.
 *
 * @return \WSUWP_Plugin_Notifications
 */
function WSUWP_Plugin_Notifications() {
	return WSUWP_Plugin_Notifications::get_instance();
}
