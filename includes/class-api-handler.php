<?php
namespace WP_Sample_Plugin;

if (!defined('ABSPATH')) exit;

/**
 * Class API_Handler
 * Registers REST API endpoints for the plugin
 */
class API_Handler {

    /**
     * Register REST API routes
     */
    public static function register_routes(): void {
        add_action('rest_api_init', function () {
            register_rest_route('wp-sample/v1', '/hello', [
                'methods' => 'GET',
                'callback' => [__CLASS__, 'say_hello'],
                'permission_callback' => '__return_true',
            ]);
        });
    }

    /**
     * REST API callback
     *
     * @param \WP_REST_Request $request
     * @return array
     */
    public static function say_hello(\WP_REST_Request $request): array {
        return [
            'success' => true,
            'message' => 'Hello from Shalini’s WP Sample Plugin!',
        ];
    }
}
