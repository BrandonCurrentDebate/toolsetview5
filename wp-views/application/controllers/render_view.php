<?php
function custom_render_toolset_view($view_id, $query_args) {
    // Ensure the variables are defined
    if (!isset($view_id) || !isset($query_args)) {
        error_log('Missing $view_id or $query_args in custom_render_toolset_view.');
        return '<!-- Error: Missing required variables for View rendering -->';
    }

    // Check if wpv_render_view is available
    if (!function_exists('wpv_render_view')) {
        error_log('wpv_render_view() is not defined.');
        return '<!-- Error: wpv_render_view() not defined -->';
    }

    // Generate a unique cache key
    $cache_key = 'toolset_view_' . md5($view_id . serialize($query_args));

    // Attempt to retrieve cached output
    $cached_output = wp_cache_get($cache_key, 'toolset_views');
    if ($cached_output) {
        return $cached_output;
    }

    // Render the View
    $output = wpv_render_view($view_id, $query_args);

    // Cache the output
    wp_cache_set($cache_key, $output, 'toolset_views', 3600);

    return $output;
}

// Force server-side rendering for non-AJAX requests
if (!wp_doing_ajax()) {
    global $view_id, $query_args;
    echo custom_render_toolset_view($view_id, $query_args);
    return;
}
