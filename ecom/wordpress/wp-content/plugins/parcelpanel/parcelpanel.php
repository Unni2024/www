<?php

/**
 * Plugin Name: CWILL (formerly ParcelPanel) Order Tracking for WooCommerce
 * Plugin URI: https://docs.parcelpanel.com/woocommerce
 * Description: The best order tracking plugin specially designed for WooCommerce, driving customer loyalty and more sales by providing the best post-purchase experience.
 * Version: 4.6.3
 * Author: CWILL Order Tracking
 * Author URI: https://www.parcelpanel.com
 * Developer: CWILL Order Tracking
 * Developer URI: https://www.parcelpanel.com
 * Text Domain: parcelpanel
 * Domain Path: /l10n/languages/
 * License: GPL-2.0
 * Requires PHP: 7.2
 * Requires at least: 5.8
 * WC requires at least: 4.4.0
 * WC tested up to: 10.8
 *
 * @copyright 2018-2026 CWILL Order Tracking
 */

define('ParcelPanel\VERSION', '4.6.3');
define('ParcelPanel\DB_VERSION', '2.9.0');

define('ParcelPanel\PLUGIN_FILE', __FILE__);
define('ParcelPanel\PLUGIN_PATH', untrailingslashit(plugin_dir_path(__FILE__)));

defined('ParcelPanel\DEBUG') || define('ParcelPanel\DEBUG', false);

if ( is_multisite() ) {
    // In a multisite environment, check the activated plugins for the current site
    $active_plugins = get_site_option('active_sitewide_plugins'); // Get the global activation plugin
    $is_woocommerce_active = isset($active_plugins['woocommerce/woocommerce.php']);
} else {
    // In a single-site environment, check the currently activated plugins
    $active_plugins = apply_filters('active_plugins', get_option('active_plugins'));
    $is_woocommerce_active = in_array('woocommerce/woocommerce.php', $active_plugins);
}

// Check if WooCommerce is activated
if ($is_woocommerce_active) {

    include __DIR__ . '/vendor/autoload.php';

    ParcelPanel\ParcelPanel::instance();
}

// compatible with HPOS
add_action('before_woocommerce_init', function () {
    if (class_exists(\Automattic\WooCommerce\Utilities\FeaturesUtil::class)) {
        \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility('custom_order_tables', __FILE__, true);
    }
});
