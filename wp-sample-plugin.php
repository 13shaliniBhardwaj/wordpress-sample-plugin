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

// Cache key constants
define('WP_SAMPLE_CACHE_HELLO', 'wp_sample_hello');


// Include classes
require_once plugin_dir_path(__FILE__) . 'includes/class-api-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-settings.php';

/**
 * Initialize plugin    
 */
add_action('plugins_loaded', function () {
    // Register REST API routes
    API_Handler::register_routes();

    // Initialize hooks for API (cache invalidation etc.)
    API_Handler::init_hooks();

    // Initialize Settings page (singleton)
    Settings::get_instance()->init();
});
