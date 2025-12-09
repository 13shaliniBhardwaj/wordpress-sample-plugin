<?php
namespace WP_Sample_Plugin;

if (!defined('ABSPATH')) exit;

/**
 * Class API_Handler
 * Registers REST API endpoints for the plugin
 */
class API_Handler {
    
    /**
     * Register all REST API routes
     */
    public static function register_routes(): void {
        add_action('rest_api_init', [__CLASS__, 'register_hello_route']);
    }

    /**
     * Initialize hooks (cache invalidation, etc.)
     */
    public static function init_hooks(): void {
        add_action('save_post', [__CLASS__, 'clear_cache']);
        add_action('deleted_post', [__CLASS__, 'clear_cache']);
        add_action('updated_post_meta', [__CLASS__, 'clear_cache']);
    }

    /**
     * Register /hello route
     */
    public static function register_hello_route(): void {
        register_rest_route('wp-sample/v1', '/hello', [
            'methods' => 'GET',
            'callback' => [__CLASS__, 'say_hello'],
            'permission_callback' => '__return_true', // public endpoint
        ]);
    }

    /**
     * REST API callback for /hello
     *
     * Uses transient caching
     *
     * @param \WP_REST_Request $request
     * @return array
     */
    public static function say_hello(\WP_REST_Request $request): array {
        $cache_key = WP_SAMPLE_CACHE_HELLO;
        $response  = get_transient($cache_key);

        if (false === $response) {
            // Build response (could add DB queries or expensive computation)
            $response = [
                'success' => true,
                'message' => 'Hello from Shalini’s WP Sample Plugin!',
            ];

            // Cache for 1 hour
            set_transient($cache_key, $response, HOUR_IN_SECONDS);
        }

        return $response;
    }

    /**
     * Clear cached response
     */
    public static function clear_cache(): void {
        delete_transient(WP_SAMPLE_CACHE_HELLO);
    }
}
