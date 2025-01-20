// Path: wp-views/wp-views.php

<?php

// Ensure WordPress is loaded
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class WP_Views {

    public function __construct() {
        add_action('init', [$this, 'register_shortcodes']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    // Register shortcodes for views
    public function register_shortcodes() {
        add_shortcode('wp_view', [$this, 'render_view']);
    }

    // Enqueue necessary scripts for AJAX pagination, search, etc.
    public function enqueue_scripts() {
        wp_enqueue_script('wp-views-ajax', plugins_url('/js/wp-views.js', __FILE__), ['jquery'], '1.0', true);
        wp_localize_script('wp-views-ajax', 'wpViewsAjax', [
            'ajax_url' => admin_url('admin-ajax.php'),
        ]);
    }

    // Render the view on the server side for initial load
    public function render_view($atts) {
        $atts = shortcode_atts([
            'id' => '',
        ], $atts, 'wp_view');

        if (empty($atts['id'])) {
            return '<p>Error: View ID is required.</p>';
        }

        // Fetch the view's content (example: custom query or predefined logic)
        ob_start();
        $this->render_view_content($atts['id']);
        return ob_get_clean();
    }

    // Fetch and display the view content
    private function render_view_content($view_id) {
        // Example: Replace with actual query logic to fetch view content
        echo '<div class="wp-view" data-view-id="' . esc_attr($view_id) . '">';
        echo '<p>Server-rendered content for view ' . esc_html($view_id) . '.</p>';
        echo '</div>';
    }

    // Handle AJAX for pagination, search, and refresh
    public function handle_ajax_request() {
        if (!isset($_POST['view_id'])) {
            wp_send_json_error('View ID missing');
        }

        $view_id = sanitize_text_field($_POST['view_id']);

        // Example: Replace with actual query logic to fetch updated view content
        ob_start();
        $this->render_view_content($view_id);
        $content = ob_get_clean();

        wp_send_json_success(['content' => $content]);
    }
}

// Initialize the class
$wp_views = new WP_Views();

// Register AJAX handlers
add_action('wp_ajax_wpv_get_view_query_results', [$wp_views, 'handle_ajax_request']);
add_action('wp_ajax_nopriv_wpv_get_view_query_results', [$wp_views, 'handle_ajax_request']);
