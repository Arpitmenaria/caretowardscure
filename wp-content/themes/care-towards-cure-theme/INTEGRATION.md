# Theme Integration Guide

This document explains how the theme integrates with custom plugins, specifically the Inquiry Management plugin.

## Inquiry Form Integration

### How It Works

The theme includes an appointment inquiry form that:
1. Collects patient information
2. Validates and sanitizes input
3. Sends AJAX request with security nonce
4. Delegates processing to a custom plugin hook

### For Plugin Developers

The theme provides a WordPress hook for the Inquiry Management plugin to process form submissions:

#### Hook Name
```php
do_action( 'care_save_inquiry', $inquiry_data );
```

#### Data Structure
The hook receives an associative array with the following keys:

```php
array(
    'patient_name'    => string,  // Full name (required)
    'phone'           => string,  // Phone number (required)
    'email'           => string,  // Email address (optional)
    'date'            => string,  // Date in YYYY-MM-DD format (optional)
    'time'            => string,  // Time in HH:MM format (optional)
    'message'         => string,  // Message/reason for visit (optional)
)
```

#### Example Implementation

In your plugin's main file (`care-inquiry-management.php`):

```php
<?php
/**
 * Handle inquiry form submissions from the theme
 */
function care_process_inquiry_submission( $inquiry_data ) {
    // Validate data (already sanitized by theme)
    if ( empty( $inquiry_data['patient_name'] ) || empty( $inquiry_data['phone'] ) ) {
        wp_send_json_error( array(
            'message' => __( 'Invalid inquiry data', 'care-inquiry-management' ),
        ) );
        return;
    }

    // Save to custom table
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'care_inquiries';
    
    $result = $wpdb->insert(
        $table_name,
        array(
            'patient_name'      => $inquiry_data['patient_name'],
            'phone'             => $inquiry_data['phone'],
            'email'             => $inquiry_data['email'],
            'appointment_date'  => $inquiry_data['date'],
            'appointment_time'  => $inquiry_data['time'],
            'message'           => $inquiry_data['message'],
            'status'            => 'new',
            'created_at'        => current_time( 'mysql' ),
        ),
        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
    );

    if ( false === $result ) {
        wp_send_json_error( array(
            'message' => __( 'Failed to save inquiry', 'care-inquiry-management' ),
        ) );
        return;
    }

    $inquiry_id = $wpdb->insert_id;

    // Send notification email
    care_send_inquiry_notification( $inquiry_id, $inquiry_data );

    // Trigger action for other plugins
    do_action( 'care_inquiry_saved', $inquiry_id, $inquiry_data );

    wp_send_json_success( array(
        'message' => __( 'Your inquiry has been submitted successfully. We will contact you soon.', 'care-inquiry-management' ),
        'inquiry_id' => $inquiry_id,
    ) );
}

// Hook into theme's inquiry form action
add_action( 'care_save_inquiry', 'care_process_inquiry_submission' );
```

### Hooking Into Theme's AJAX Handler

The theme's AJAX handler in `functions.php` checks for the hook:

```php
function care_handle_inquiry_form(): void {
    // Validation and sanitization...
    
    if ( has_action( 'care_save_inquiry' ) ) {
        do_action( 'care_save_inquiry', array(
            'patient_name' => $patient_name,
            'phone'        => $phone,
            'email'        => $email,
            'date'         => $date,
            'time'         => $time,
            'message'      => $message,
        ) );

        wp_send_json_success( /* ... */ );
    }
}
```

## Customizer Integration

### Adding Custom Settings

The theme uses WordPress Customizer for most configuration. To add settings to the customizer, add this to your plugin's `functions.php`:

```php
function my_plugin_customize_register( $wp_customize ) {
    // Add new panel
    $wp_customize->add_panel( 'clinic_settings', array(
        'title'       => __( 'Clinic Settings', 'my-plugin' ),
        'priority'    => 100,
    ) );

    // Add section
    $wp_customize->add_section( 'clinic_doctors', array(
        'title'       => __( 'Doctors', 'my-plugin' ),
        'panel'       => 'clinic_settings',
    ) );

    // Add setting
    $wp_customize->add_setting( 'clinic_doctor_1_name', array(
        'default'           => 'Dr. Example',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    // Add control
    $wp_customize->add_control( 'clinic_doctor_1_name', array(
        'label'   => __( 'Doctor 1 Name', 'my-plugin' ),
        'section' => 'clinic_doctors',
        'type'    => 'text',
    ) );
}
add_action( 'customize_register', 'my_plugin_customize_register' );
```

### Accessing Settings in Templates

In `front-page.php` or custom templates:

```php
<?php
$doctor_name = get_theme_mod( 'clinic_doctor_1_name', 'Dr. Default Name' );
echo esc_html( $doctor_name );
?>
```

## Post Meta Integration

### Storing Section Content

Use post meta to store content for specific sections:

```php
<?php
// In your plugin
function save_section_content( $post_id, $section_name, $content ) {
    update_post_meta( $post_id, 'section_' . $section_name, wp_kses_post( $content ) );
}

// In template
function get_section_content( $post_id, $section_name ) {
    return get_post_meta( $post_id, 'section_' . $section_name, true );
}
?>
```

## Custom Post Types

### Example: Doctors Directory

```php
<?php
function register_doctor_post_type() {
    $labels = array(
        'name'               => 'Doctors',
        'singular_name'      => 'Doctor',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'menu_icon'          => 'dashicons-businessman',
        'rewrite'            => array( 'slug' => 'doctor' ),
    );

    register_post_type( 'doctor', $args );
}

add_action( 'init', 'register_doctor_post_type' );
?>
```

### Displaying in Theme

Create `single-doctor.php` in theme:

```php
<?php get_header(); ?>

<main id="main-content">
    <div class="container">
        <div class="section">
            <?php
            while ( have_posts() ) {
                the_post();
                ?>
                <div class="grid-2">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div>
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <h1><?php the_title(); ?></h1>
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
```

## Shortcode Integration

### Registering Shortcodes

In your plugin:

```php
<?php
function clinic_contact_shortcode( $atts ) {
    $output = '<div class="clinic-contact">';
    $output .= '<p>Phone: ' . get_theme_mod( 'care_contact_phone' ) . '</p>';
    $output .= '</div>';
    return $output;
}

add_shortcode( 'clinic_contact', 'clinic_contact_shortcode' );
?>
```

### Using in Theme

In `front-page.php`:

```php
<?php echo do_shortcode( '[clinic_contact]' ); ?>
```

## Database Integration

### Creating Custom Tables

In your plugin's activation hook:

```php
<?php
function care_inquiry_management_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'care_inquiries';
    
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        patient_name varchar(255) NOT NULL,
        phone varchar(20) NOT NULL,
        email varchar(255),
        appointment_date date,
        appointment_time time,
        message longtext,
        status varchar(20) DEFAULT 'new',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook( __FILE__, 'care_inquiry_management_activate' );
?>
```

## Email Notifications

### Sending Inquiry Notification

```php
<?php
function care_send_inquiry_notification( $inquiry_id, $inquiry_data ) {
    $to = get_option( 'admin_email' );
    $subject = 'New Appointment Inquiry Received';
    
    $message = "New appointment inquiry:\n\n";
    $message .= "Name: " . $inquiry_data['patient_name'] . "\n";
    $message .= "Phone: " . $inquiry_data['phone'] . "\n";
    $message .= "Email: " . $inquiry_data['email'] . "\n";
    $message .= "Date: " . $inquiry_data['date'] . "\n";
    $message .= "Time: " . $inquiry_data['time'] . "\n";
    $message .= "Message: " . $inquiry_data['message'] . "\n";

    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );

    wp_mail( $to, $subject, $message, $headers );
}
?>
```

## Admin Dashboard Integration

### Adding Metaboxes

```php
<?php
function add_inquiry_metabox() {
    add_meta_box(
        'inquiry_details',
        'Inquiry Details',
        'render_inquiry_metabox',
        'care_inquiry'  // Custom post type
    );
}

add_action( 'add_meta_boxes', 'add_inquiry_metabox' );

function render_inquiry_metabox( $post ) {
    $phone = get_post_meta( $post->ID, '_phone', true );
    echo '<label>Phone:</label>';
    echo '<input type="text" name="phone" value="' . esc_attr( $phone ) . '">';
}
?>
```

## Performance Considerations

1. **Database Queries**: Use `wp_cache_set()` for frequently accessed data
2. **AJAX Requests**: Keep response sizes minimal
3. **Images**: Optimize before uploading to media library
4. **Scripts**: Only enqueue when needed

## Security Best Practices

1. **Input Validation**: Always validate user input
2. **Output Escaping**: Escape all output (esc_html, esc_attr, etc.)
3. **Nonce Verification**: Check nonces for AJAX requests
4. **Capability Checks**: Verify user capabilities before sensitive operations
5. **SQL Injection**: Use prepared statements with `$wpdb`

## Testing Integration

### Manual Testing Checklist

- [ ] Form submits successfully
- [ ] Data appears in admin panel
- [ ] Email notification sent
- [ ] Success message displays
- [ ] Error handling works
- [ ] Mobile form works
- [ ] Invalid data rejected
- [ ] AJAX gracefully degrades (if JS disabled)

### Debug Mode

Enable debug mode in `wp-config.php`:

```php
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
```

Check `/wp-content/debug.log` for errors.

## Support

For integration help:
1. Check theme documentation in README.md
2. Review this integration guide
3. Check WordPress plugin handbook
4. Inspect browser console for JavaScript errors
5. Check PHP error logs
