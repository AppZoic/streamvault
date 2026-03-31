<?php
// Start the session
session_start();

// Define REST API endpoint URL as a constant
define('LICENSE_MANAGER_API_URL', 'https://appzoic.com/wp-json/license-manager/v1/validate');

// Add custom menu item to the main menu
add_action('admin_menu', 'streamvault_license_key_settings_menu');
function streamvault_license_key_settings_menu() {
    add_menu_page('License Key Settings', 'License Key', 'manage_options', 'license-key-settings', 'streamvault_license_key_settings_page', 'dashicons-admin-network', 10);
}

// Display the settings page
function streamvault_license_key_settings_page() {
    ?>
    <div class="wrap">
        <h2><?php echo esc_html__('License Key Settings', 'streamvault'); ?></h2>
        <?php streamvault_display_license_key_messages(); ?>
        <?php if (get_option('license_key_activated') != 'activated') { ?>
            <form method="post" action="options.php">
                <?php settings_fields('license_key_settings_group'); ?>
                <?php do_settings_sections('license-key-settings'); ?>
                <?php submit_button('Activate License Key'); ?>
            </form>
        <?php } else { ?>
            <div class="updated"><h3><?php echo esc_html__('Your theme is activated', 'streamvault'); ?></h3></div>
        <?php } ?>
    </div>
    <?php
}

// Register and define the settings
add_action('admin_init', 'streamvault_license_key_settings_init');
function streamvault_license_key_settings_init() {
    register_setting('license_key_settings_group', 'license_key');

    add_settings_section('license_key_settings_section', 'Enter Your License Key', 'streamvault_license_key_settings_section_callback', 'license-key-settings');

    add_settings_field('license_key_field', 'License Key', 'streamvault_license_key_field_callback', 'license-key-settings', 'license_key_settings_section');
}

// Section callback function
function streamvault_license_key_settings_section_callback() {
    echo 'Enter your license key below:';
}

// Field callback function
function streamvault_license_key_field_callback() {
    $license_key = get_option('license_key');
    echo "<input type='text' name='license_key' value='" . esc_attr($license_key) . "' />";
}

// Validate license key
function streamvault_validate_license_key($license_key) {
    $response = streamvault_store_license_key_via_rest_api($license_key);

    if (is_wp_error($response)) {
        update_option('license_key', '');
        update_option('license_key_activated', 'deactivated');
        $_SESSION['license_key_error'] = $response->get_error_message(); // Store error message in session
    } else {
        update_option('license_key', $license_key);
        update_option('license_key_activated', 'activated');
        $_SESSION['license_key_success'] = $response['message']; // Store success message in session
        wp_redirect(admin_url('index.php')); // Redirect to the WordPress dashboard
        exit;
    }
}

// Store license key
function streamvault_store_license_key_via_rest_api($license_key) {
    $data = array(
        'license_key' => $license_key,
        'domain' => home_url()
    );

    $options = array(
        'method'  => 'POST',
        'headers' => array('Content-Type' => 'application/json'),
        'body'    => json_encode($data),
    );

    $response = wp_remote_post(LICENSE_MANAGER_API_URL, $options);

    if (is_wp_error($response)) {
        return new WP_Error('api_error', 'Failed to connect to the API.');
    } else {
        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = wp_remote_retrieve_body($response);
        $response_data = json_decode($response_body, true);

        if ($response_code === 200 && isset($response_data['message'])) {
            return $response_data;
        } else {
            return new WP_Error('api_error', isset($response_data['message']) ? $response_data['message'] : 'Invalid API response.');
        }
    }
}

// Display error messages on the settings page
function streamvault_display_license_key_messages() {
    if (isset($_SESSION['license_key_error'])) {
        echo '<div class="error"><p>' . $_SESSION['license_key_error'] . '</p></div>';
        unset($_SESSION['license_key_error']); // Remove error message from session
    }
    if (isset($_SESSION['license_key_success'])) {
        echo '<div class="updated"><p>' . $_SESSION['license_key_success'] . '</p></div>';
        unset($_SESSION['license_key_success']); // Remove success message from session
    }
}

// Add admin notice if license key is not activated
function streamvault_admin_license_notice() {
    if (get_option('license_key_activated') != 'activated') { ?>
        <div class="notice notice-error is-dismissible">
            <p>
                <strong>
                    <p><?php echo esc_html__( 'This theme requires a license key to install core plugin, auto-update, and one-click demo import.', 'streamvault' ) ?></p>
                    <span><a href="<?php echo admin_url( 'admin.php?page=license-key-settings' ); ?>"><?php echo esc_html__( 'Activate License','streamvault' ) ?></a></span> |
                    <span><a href="<?php echo esc_url( 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-' ); ?>" target="_blank"><?php echo esc_html__( 'Get Your Purchase Code','streamvault' ) ?></a></span>
                </strong>
            </p>
        </div>
    <?php }
}
add_action('admin_notices', 'streamvault_admin_license_notice');

// Validate and store license key on form submission
if (isset($_POST['license_key'])) {
    streamvault_validate_license_key(sanitize_text_field($_POST['license_key']));
}