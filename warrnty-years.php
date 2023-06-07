<?php
/**
 * Plugin Name: warranty Option woocommerce
 * Description: Add custom warranty options to WooCommerce products.
 * Version: 1.0.1
 * Author: Kythonlk(Kavindu Harshana)
 * Author URI: https://kythonlk.com
 * Text Domain: kypow
 * Domain Path: /languages
 */

// Activation and deactivation hooks
register_activation_hook( __FILE__, 'kypow_activation_function' );
register_deactivation_hook( __FILE__, 'kypow_deactivation_function' );

function kypow_activation_function() {
    // Perform activation tasks, if any
    add_option( 'kypow_enable_warranty', true );
    add_option( 'kypow_enable_custom_text', true );
}

function kypow_deactivation_function() {
    // Perform deactivation tasks, if any
    delete_option( 'kypow_enable_warranty' );
    delete_option( 'kypow_enable_custom_text' );
}

// Load admin settings file
require_once plugin_dir_path( __FILE__ ) . 'includes/admin/admin-settings.php';

// Load frontend functions file
require_once plugin_dir_path( __FILE__ ) . 'includes/frontend/frontend-functions.php';
