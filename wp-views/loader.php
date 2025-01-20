<?php
/**
 * Plugin initialization.
 *
 * @package Toolset Views
 */

// Get the list of files that have been required
$required_files_list = get_required_files();
$main_plugin_file_path = $required_files_list[ count($required_files_list) - 2 ];

// Define basic constants
define('WPV_PATH', dirname(__FILE__));
define('WPV_PLUGIN_BASENAME', plugin_basename($main_plugin_file_path));
define('WPV_PLUGIN_FILE', basename(WPV_PLUGIN_BASENAME));

// Include Constants
require_once WPV_PATH . '/loader/constants.php';

// Ensure UserCapabilities are loaded
require_once WPV_PATH . '/backend/UserCapabilities.php';

// Load manual dependencies (OTGS UI, Toolset Common, Theme Settings)
require_once WPV_PATH . '/loader/manual-dependencies.php';

// Load API
require_once WPV_PATH . '/loader/api.php';

// Initialize the Views settings
require WPV_PATH_EMBEDDED . '/inc/wpv-settings.class.php';
require WPV_PATH . '/inc/wpv-settings-screen.class.php';
global $WPV_settings;
$WPV_settings = WPV_Settings::get_instance();

// Public Views API functions
require WPV_PATH_EMBEDDED . '/inc/wpv-api.php';

// Include Helper Classes
require_once WPV_PATH . '/inc/classes/wpv-exception-with-message.class.php';

// Include Toolset Object Wrappers
require_once WPV_PATH_EMBEDDED . '/inc/classes/wpv-post-object-wrapper.class.php';
require_once WPV_PATH_EMBEDDED . '/inc/classes/wpv-view-base.class.php';
require_once WPV_PATH_EMBEDDED . '/inc/classes/wpv-view-embedded.class.php';
require_once WPV_PATH_EMBEDDED . '/inc/classes/wpv-wordpress-archive-embedded.class.php';
require_once WPV_PATH_EMBEDDED . '/inc/classes/wpv-content-template-embedded.class.php';

require_once WPV_PATH . '/inc/classes/wpv-view.class.php';
require_once WPV_PATH . '/inc/classes/wpv-wordpress-archive.class.php';
require_once WPV_PATH . '/inc/classes/wpv-content-template.class.php';

// Cache Handling
require_once WPV_PATH_EMBEDDED . '/inc/classes/wpv-cache.class.php';

// Module Manager Integration
require WPV_PATH_EMBEDDED . '/inc/wpv-module-manager.php';

// Load Core Functions
require WPV_PATH_EMBEDDED . '/inc/functions-core-embedded.php';
require WPV_PATH . '/inc/functions-core.php';

// Load AJAX Management
require WPV_PATH . '/loader/deprecated.php';
require WPV_PATH . '/inc/wpv-admin-ajax.php';
require WPV_PATH . '/inc/wpv-admin-ajax-layout-wizard.php';

// Initialize Shortcodes
require WPV_PATH_EMBEDDED . '/inc/wpv-shortcodes.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-shortcodes-gui.php';

// Conditional Logic
require WPV_PATH_EMBEDDED . '/inc/wpv-condition.php';

// Query Modifiers
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-order-by-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-types-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-post-types-embedded.php';
require WPV_PATH_EMBEDDED . '/inc/wpv-filter-limit-embedded.php';

// Frontend Query Filters
require_once WPV_PATH_EMBEDDED . '/inc/filters/wpv-filter-author-embedded.php';
require_once WPV_PATH_EMBEDDED . '/inc/filters/wpv-filter-category-embedded.php';
require_once WPV_PATH_EMBEDDED . '/inc/filters/wpv-filter-date-embedded.php';
require_once WPV_PATH_EMBEDDED . '/inc/filters/wpv-filter-meta-field-embedded.php';
require_once WPV_PATH_EMBEDDED . '/inc/filters/wpv-filter-sticky-embedded.php';

// WooCommerce Integration
require WPV_PATH_EMBEDDED . '/inc/third-party/wpv-compatibility-woocommerce.class.php';

// Compatibility with Third-Party Plugins
require_once WPV_PATH_EMBEDDED . '/inc/third-party/wpv-compatibility-generic.class.php';
WPV_Compatibility_Generic::initialize();

// Main Plugin Classes
require WPV_PATH_EMBEDDED . '/inc/wpv.class.php';
require WPV_PATH . '/inc/wpv-plugin.class.php';
global $WP_Views;
$WP_Views = new WP_Views_plugin;

// Bootstrap Views
require_once WPV_PATH . '/application/bootstrap.php';
