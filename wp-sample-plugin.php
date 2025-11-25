<?php
/**
 * Plugin Name: WP Sample Plugin
 * Description: Sample WordPress plugin demonstrating REST API, settings page, and OOP best practices.
 * Version: 1.0
 * Author: Shalini Bhardwaj
 * Text Domain: wp-sample-plugin
 */

namespace WP_Sample_Plugin;

if (!defined('ABSPATH')) exit;

// Include classes
require_once plugin_dir_path(__FILE__) . 'includes/class-api-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-settings.php';

/**
 * Initialize plugin
 */
add_action('plugins_loaded', function () {
    // Register REST API routes
    \WP_Sample_Plugin\API_Handler::register_routes();

    // Initialize Settings page
    \WP_Sample_Plugin\Settings::get_instance()->init();
});
