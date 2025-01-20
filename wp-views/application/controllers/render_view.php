<?php
function custom_render_toolset_view($view_id, $query_args) {
    // Generate a unique cache key for this View
    $cache_key = 'toolset_view_' . md5($view_id . serialize($query_args));

    // Attempt to retrieve cached output
    $cached_output = wp_cache_get($cache_key, 'toolset_views');
    if ($cached_output) {
        return $cached_output;
    }

    // Render the View server-side
    $output = wpv_render_view($view_id, $query_args);

    // Store the rendered output in Redis or object cache
    wp_cache_set($cache_key, $output, 'toolset_views', 3600);

    return $output;
}

// Force server-side rendering for non-AJAX requests
if (!wp_doing_ajax()) {
    echo custom_render_toolset_view($view_id, $query_args);
    return;
}
