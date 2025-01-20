<?php
// Handle AJAX requests for Toolset Views
add_action('wp_ajax_wpv_get_view_query_results', function () {
    // Allow AJAX only for user-triggered interactions like pagination or filtering
    if (isset($_POST['action_type']) && in_array($_POST['action_type'], ['pagination', 'filter'])) {
        wpv_get_view_query_results_handler();
    } else {
        // Block AJAX requests for initial View loading
        wp_send_json_error(['message' => 'Initial AJAX load disabled.']);
    }
});
