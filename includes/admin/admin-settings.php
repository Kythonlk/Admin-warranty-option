<?php
// Add admin settings page to the main menu
add_action( 'admin_menu', 'warranty_option_add_menu_page' );

function warranty_option_add_menu_page() {
    add_menu_page(
        'Warranty Option Settings',
        'Warranty Option',
        'manage_options',
        'warranty-option-settings',
        'warranty_option_settings_page',
        'dashicons-admin-generic',
        99
    );
}

function warranty_option_settings_page() {
    // Display the settings page HTML
    ?>
    <div class="wrap">
        <h1>Warranty Option Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'warranty-option-settings-group' );
            do_settings_sections( 'warranty-option-settings-group' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register admin settings and fields
add_action( 'admin_init', 'warranty_option_register_settings' );

function warranty_option_register_settings() {
    register_setting( 'warranty-option-settings-group', 'warranty_option_custom_text', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => '',
    ) );

    register_setting( 'warranty-option-settings-group', 'warranty_option_enable_warranty', array(
        'type' => 'boolean',
        'default' => true,
    ) );

    register_setting( 'warranty-option-settings-group', 'warranty_option_enable_custom_text', array(
        'type' => 'boolean',
        'default' => true,
    ) );

    add_settings_section(
        'warranty-option-settings-section',
        'Custom Text adding to after add to cart button in sigle product page',
        'warranty_option_settings_section_callback',
        'warranty-option-settings-group'
    );

    add_settings_field(
        'warranty-option-custom-text-field',
        'Custom Text',
        'warranty_option_custom_text_field_callback',
        'warranty-option-settings-group',
        'warranty-option-settings-section'
    );

    add_settings_section(
        'warranty-option-features-section',
        'Plugin Features',
        'warranty_option_features_section_callback',
        'warranty-option-settings-group'
    );

    add_settings_field(
        'warranty-option-warranty-feature',
        'Warranty Feature',
        'warranty_option_warranty_feature_callback',
        'warranty-option-settings-group',
        'warranty-option-features-section'
    );

    add_settings_field(
        'warranty-option-custom-text-feature',
        'Custom Text Feature',
        'warranty_option_custom_text_feature_callback',
        'warranty-option-settings-group',
        'warranty-option-features-section'
    );
}

function warranty_option_settings_section_callback() {
    // Section callback HTML (if needed)
}

function warranty_option_custom_text_field_callback() {
    $custom_text = get_option( 'warranty_option_custom_text' );
    echo '<input type="text" name="warranty_option_custom_text" value="' . esc_attr( $custom_text ) . '" />';
}

function warranty_option_features_section_callback() {
    // Section callback HTML (if needed)
}

function warranty_option_warranty_feature_callback() {
    $enable_warranty = get_option( 'warranty_option_enable_warranty' );
    echo '<input type="checkbox" name="warranty_option_enable_warranty" value="1" ' . checked( $enable_warranty, true, false ) . ' />';
}

function warranty_option_custom_text_feature_callback() {
    $enable_custom_text = get_option( 'warranty_option_enable_custom_text' );
    echo '<input type="checkbox" name="warranty_option_enable_custom_text" value="1" ' . checked( $enable_custom_text, true, false ) . ' />';
}
