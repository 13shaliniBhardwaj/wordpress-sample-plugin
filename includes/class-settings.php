<?php
namespace WP_Sample_Plugin;

if (!defined('ABSPATH')) exit;

/**
 * Class Settings
 * Singleton for plugin settings page
 */
class Settings {

    private static $instance = null;

    public static function get_instance(): self {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {}

    /**
     * Initialize settings page hooks
     */
    public function init(): void {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    /**
     * Add settings page under Settings menu
     */
    public function add_admin_menu(): void {
        add_options_page(
            'WP Sample Plugin Settings',
            'WP Sample Plugin',
            'manage_options',
            'wp-sample-plugin',
            [$this, 'settings_page_html']
        );
    }

    /**
     * Register plugin settings
     */
    public function register_settings(): void {
        register_setting('wp_sample_plugin_options', 'wp_sample_greeting');

        add_settings_section(
            'wp_sample_section',
            'General Settings',
            null,
            'wp-sample-plugin'
        );

        add_settings_field(
            'wp_sample_greeting',
            'Greeting Message',
            [$this, 'greeting_field_html'],
            'wp-sample-plugin',
            'wp_sample_section'
        );
    }

    /**
     * Render greeting input field
     */
    public function greeting_field_html(): void {
        $value = get_option('wp_sample_greeting', 'Hello from Shalini’s WP Sample Plugin!');
        echo "<input type='text' name='wp_sample_greeting' value='" . esc_attr($value) . "' class='regular-text'>";
    }

    /**
     * Render settings page HTML
     */
    public function settings_page_html(): void {
        ?>
        <div class="wrap">
            <h1>WP Sample Plugin Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('wp_sample_plugin_options');
                do_settings_sections('wp-sample-plugin');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }
}
