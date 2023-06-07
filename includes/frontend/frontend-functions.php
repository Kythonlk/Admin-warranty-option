<?php
// Display the warranty option on the single product page
add_action( 'woocommerce_before_add_to_cart_button', 'warranty_option_display_warranty_option' );

function warranty_option_display_warranty_option() {
    $enable_warranty = get_option( 'warranty_option_enable_warranty' );

    if ( $enable_warranty ) {
        global $product;

        // Get the product's warranty years
        $warranty_years = get_post_meta( $product->get_id(), 'warranty_option_warranty_years', true );

        // Display the warranty option HTML
        echo '<div class="warranty-option">';
        echo '<h6>' . __( 'Warranty Years:', 'kythonlk-plugins' ) . ' ' . esc_html( $warranty_years ) . '</h6>';
        echo '</div>';
    }
}

// Display the custom text on the single product page
add_action( 'woocommerce_after_add_to_cart_button', 'warranty_option_display_custom_text' );

function warranty_option_display_custom_text() {
    $enable_custom_text = get_option( 'warranty_option_enable_custom_text' );

    if ( $enable_custom_text ) {
        $custom_text = get_option( 'warranty_option_custom_text' );
        if ( ! empty( $custom_text ) ) {
            echo '<h5>' . esc_html( $custom_text ) . '</h5>';
        }
    }
}
