<?php
/**
 * WP Sample Plugin uninstall
 */
if (!defined('WP_UNINSTALL_PLUGIN')) exit;

// Clean up options
delete_option('wp_sample_greeting');
