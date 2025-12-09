<?php
/**
 * WP Sample Plugin uninstall
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Clean up plugin options
delete_option('wp_sample_greeting');
delete_option('wp_sample_plugin_options'); // if you registered a settings group

// Clean up transient cache
delete_transient(WP_SAMPLE_CACHE_HELLO);

// Optional: clean object cache if using Redis/Memcached
if (function_exists('wp_cache_delete')) {
    wp_cache_delete(WP_SAMPLE_CACHE_HELLO, 'default'); // 'default' or your custom group
}
