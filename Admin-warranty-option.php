<?php
/**
 * Plugin Name: Admin-warranty-option
 * Description: Add custom warranty options to WooCommerce products.
 * Version: 1.0.0
 * Author: Kythonlk(Kavindu harshana)
 * Author URI: https://kythonlk.com
 * Text Domain: kyap
 */

// Activation and deactivation hooks
register_activation_hook( __FILE__, 'your_plugin_activation_function' );
register_deactivation_hook( __FILE__, 'your_plugin_deactivation_function' );

function your_plugin_activation_function() {
    // Perform activation tasks, if any
}

function your_plugin_deactivation_function() {
    // Perform deactivation tasks, if any
}

// Add custom field for warranty years in product edit page
add_action( 'woocommerce_product_options_general_product_data', 'your_plugin_add_warranty_years_field' );

function your_plugin_add_warranty_years_field() {
    global $post;

    echo '<div class="options_group">';
    woocommerce_wp_text_input( array(
        'id'            => 'your_plugin_warranty_years',
        'label'         => __( 'Warranty Years', 'kyap' ),
        'placeholder'   => '',
        'description'   => __( 'Enter the warranty years for this product.', 'kyap' ),
        'desc_tip'      => true,
    ) );
    echo '</div>';
}

// Save the warranty years entered by the admin when the product is updated
add_action( 'woocommerce_process_product_meta', 'your_plugin_save_warranty_years' );

function your_plugin_save_warranty_years( $post_id ) {
    $warranty_years = isset( $_POST['your_plugin_warranty_years'] ) ? sanitize_text_field( $_POST['your_plugin_warranty_years'] ) : '';
    update_post_meta( $post_id, 'your_plugin_warranty_years', $warranty_years );
}

// Display the warranty option on the single product page
add_action( 'woocommerce_before_add_to_cart_button', 'your_plugin_display_warranty_option' );

function your_plugin_display_warranty_option() {
    global $product;

    // Get the product's warranty years
    $warranty_years = get_post_meta( $product->get_id(), 'your_plugin_warranty_years', true );

    // Display the warranty option HTML
    echo '<div class="warranty-option">';
    echo '<label for="warranty_years">' . __( 'Warranty Years:', 'kyap' ) . '</label>';
    echo '<input type="number" name="warranty_years" id="warranty_years" min="1" value="' . esc_attr( $warranty_years ) . '" />';
    echo '</div>';
}
