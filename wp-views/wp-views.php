<?php
/*
Plugin Name: Toolset Views Custom
Plugin URI: https://toolset.com/?utm_source=viewsplugin&utm_campaign=views&utm_medium=plugins-list-full-version&utm_term=Visit plugin site
Description: Custom version of Toolset Views with server-side rendering, Redis caching, and enhanced AJAX functionality.
Author: OnTheGoSystems (Customized)
Author URI: https://toolset.com
Version: 3.6.18-custom
*/

if ( defined( 'WPV_VERSION' ) ) {
	require_once dirname( __FILE__ ) . '/deactivate/by-existing.php';
	wpv_force_deactivate_by_blocks( plugin_basename( __FILE__  ) );
} elseif ( defined( 'TB_VERSION' ) ) {
	// Check for Toolset Blocks as standalone plugin (early beta packages).
	require_once dirname( __FILE__ ) . '/deactivate/by-blocks-beta.php';
	wpv_force_deactivate_by_blocks_beta( plugin_basename( __FILE__  ) );
} else {
	define( 'WPV_VERSION', '3.6.18-custom' );

	// Load core plugin functionality
	require_once dirname( __FILE__ ) . '/loader.php';

	// Include custom modifications
	require_once dirname( __FILE__ ) . '/application/controllers/render_view.php';
	require_once dirname( __FILE__ ) . '/application/controllers/frontend_view_query_results.php';

	// Initialize Redis integration
	add_action('plugins_loaded', function () {
		if (!class_exists('Redis')) {
			error_log('Redis PHP extension not found.');
			return;
		}

		global $redis;
		$redis = new Redis();
		if (!$redis->connect('127.0.0.1', 6379)) {
			error_log('Redis connection failed.');
		} else {
			error_log('Redis connected successfully.');
		}
	});
}
