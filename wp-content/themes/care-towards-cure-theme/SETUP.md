# Theme Setup & Configuration Guide

Complete step-by-step setup guide for Care Towards Cure Theme.

## Initial Installation

### Step 1: Upload Theme
1. Download the theme folder
2. Upload to `/wp-content/themes/` via SFTP or file manager
3. In WordPress Admin: **Appearance → Themes**
4. Find "Care Towards Cure Theme" and click **Activate**

### Step 2: Verify Theme Activation
After activation, you should see:
- ✅ Theme activated in Appearance → Themes
- ✅ Appearance menu items available
- ✅ Front page displays (if set as homepage)

## Configure Homepage

### Step 1: Set Static Homepage
1. Go to **Settings → Reading**
2. Under "Your homepage displays":
   - Select **A static page**
   - Homepage: Select any page or create new one
   - Click **Save Changes**

### Step 2: Verify Homepage
- Visit your site's homepage
- You should see the hero banner and all sections

## Theme Customizer Setup

### Access Customizer
**Appearance → Customize** (or **Appearance → Themes → Customize**)

### Section 1: Site Identity
**Path**: Appearance → Customize → Site Identity

Configure:
- **Site Title** - Clinic/practice name
- **Tagline** - Short description
- **Logo** - Upload clinic logo (40px height recommended)
- **Favicon** - Clinic icon

### Section 2: Hero Banner
**Creating Custom Section** (in Functions → Add to Customizer):

```php
// Add to your custom plugin's functions.php
add_action( 'customize_register', function( $wp_customize ) {
    // Hero Settings Section
    $wp_customize->add_section( 'hero_section', array(
        'title'       => 'Hero Banner',
        'priority'    => 1,
    ) );

    // Hero Title
    $wp_customize->add_setting( 'care_hero_title', array(
        'default'           => 'Welcome to Care Towards Cure',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'care_hero_title', array(
        'label'       => 'Hero Title',
        'section'     => 'hero_section',
        'type'        => 'text',
    ) );

    // Hero Subtitle
    $wp_customize->add_setting( 'care_hero_subtitle', array(
        'default'           => 'Your trusted clinic for comprehensive healthcare',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'care_hero_subtitle', array(
        'label'       => 'Hero Subtitle',
        'section'     => 'hero_section',
        'type'        => 'text',
    ) );

    // Hero Background Image
    $wp_customize->add_setting( 'care_hero_image' );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'care_hero_image', array(
        'label'       => 'Hero Background Image',
        'section'     => 'hero_section',
        'mime_type'   => 'image',
    ) ) );
} );
```

### Configure Services (Up to 6)

Add these settings for each service (1-6):

```php
for ( $i = 1; $i <= 6; $i++ ) {
    // Service Title
    $wp_customize->add_setting( 'care_service_title_' . $i, array(
        'default'           => 'Service ' . $i,
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'care_service_title_' . $i, array(
        'label'   => 'Service ' . $i . ' Title',
        'section' => 'services_section',
        'type'    => 'text',
    ) );

    // Service Description
    $wp_customize->add_setting( 'care_service_desc_' . $i, array(
        'default'           => 'Service description',
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'care_service_desc_' . $i, array(
        'label'   => 'Service ' . $i . ' Description',
        'section' => 'services_section',
        'type'    => 'textarea',
    ) );

    // Service Icon
    $wp_customize->add_setting( 'care_service_icon_' . $i, array(
        'default'           => 'check',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'care_service_icon_' . $i, array(
        'label'   => 'Service ' . $i . ' Icon',
        'section' => 'services_section',
        'type'    => 'select',
        'choices' => array(
            'check'    => 'Checkmark',
            'clock'    => 'Clock',
            'phone'    => 'Phone',
            'location' => 'Location',
            'mail'     => 'Mail',
            'menu'     => 'Menu',
        ),
    ) );
}
```

### Configure Clinic Hours

Add time settings for each day:

```php
$days = array(
    'monday'    => 'Monday',
    'tuesday'   => 'Tuesday',
    'wednesday' => 'Wednesday',
    'thursday'  => 'Thursday',
    'friday'    => 'Friday',
    'saturday'  => 'Saturday',
    'sunday'    => 'Sunday',
);

foreach ( $days as $day_key => $day_label ) {
    // Opening Time
    $wp_customize->add_setting( 'care_timing_' . $day_key . '_start', array(
        'default'           => '9:00 AM',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'care_timing_' . $day_key . '_start', array(
        'label'   => $day_label . ' Opening Time',
        'section' => 'timings_section',
        'type'    => 'text',
    ) );

    // Closing Time
    $wp_customize->add_setting( 'care_timing_' . $day_key . '_end', array(
        'default'           => '5:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'care_timing_' . $day_key . '_end', array(
        'label'   => $day_label . ' Closing Time',
        'section' => 'timings_section',
        'type'    => 'text',
    ) );
}
```

### Configure Contact Information

```php
// Phone Number
$wp_customize->add_setting( 'care_contact_phone', array(
    'default'           => '+1 (555) 123-4567',
    'sanitize_callback' => 'sanitize_text_field',
) );
$wp_customize->add_control( 'care_contact_phone', array(
    'label'   => 'Phone Number',
    'section' => 'contact_section',
    'type'    => 'tel',
) );

// Email
$wp_customize->add_setting( 'care_contact_email', array(
    'default'           => get_option( 'admin_email' ),
    'sanitize_callback' => 'sanitize_email',
) );
$wp_customize->add_control( 'care_contact_email', array(
    'label'   => 'Email Address',
    'section' => 'contact_section',
    'type'    => 'email',
) );

// Address
$wp_customize->add_setting( 'care_contact_address', array(
    'default'           => '123 Medical Street, Healthcare City',
    'sanitize_callback' => 'sanitize_textarea_field',
) );
$wp_customize->add_control( 'care_contact_address', array(
    'label'   => 'Address',
    'section' => 'contact_section',
    'type'    => 'textarea',
) );

// Google Map Embed
$wp_customize->add_setting( 'care_contact_map_embed', array(
    'default'           => '',
    'sanitize_callback' => 'wp_kses_post',
) );
$wp_customize->add_control( 'care_contact_map_embed', array(
    'label'       => 'Google Map Embed Code',
    'description' => 'Paste Google Maps embed iframe code',
    'section'     => 'contact_section',
    'type'        => 'textarea',
) );
```

## Gallery Setup

### Upload Images

1. **Media Library**:
   - Go to **Media → Add New**
   - Upload your clinic/facility photos
   - Note the attachment ID for each image

2. **Add to Customizer** (example):
   ```php
   for ( $i = 1; $i <= 12; $i++ ) {
       $wp_customize->add_setting( 'care_gallery_image_' . $i );
       $wp_customize->add_control( new WP_Customize_Media_Control( 
           $wp_customize, 
           'care_gallery_image_' . $i, 
           array(
               'label'     => 'Gallery Image ' . $i,
               'section'   => 'gallery_section',
               'mime_type' => 'image',
           ) 
       ) );
   }
   ```

## Navigation Menu Setup

### Create Primary Menu

1. Go to **Appearance → Menus**
2. Click **Create a new menu**
3. Name it "Main Menu"
4. Add menu items:
   - Home (use custom link: `#`)
   - About (custom link: `#about`)
   - Services (custom link: `#services`)
   - Timings (custom link: `#timings`)
   - Contact (custom link: `#contact`)
5. Under "Display location":
   - ✅ Check **Primary Menu**
6. Click **Save Menu**

### Create Footer Menu (Optional)

1. Create new menu: "Footer Links"
2. Add links (privacy, terms, etc.)
3. Check **Footer Menu** in Display location

## Email Configuration

### Setup Email Notifications

The inquiry form sends notifications to admin email. To change:

1. Go to **Settings → General**
2. Update **Administration Email Address**
3. Click **Save Changes**

### Test Email (requires plugin)

Add to a custom plugin to test:

```php
wp_mail( 
    get_option( 'admin_email' ),
    'Test Email from Care Towards Cure',
    'This is a test email.'
);
```

## Elementor Integration (Optional)

If using Elementor:

1. Install **Elementor** plugin
2. Go to **Elementor → Settings**
3. Under **Integrations**:
   - Theme Support: **Care Towards Cure Theme** should be selected
4. Create/edit pages with Elementor

## Footer Widget Areas

### Add Content to Footer

1. Go to **Appearance → Widgets**
2. You'll see three widget areas:
   - **Footer Column 1**
   - **Footer Column 2**
   - **Footer Column 3**

3. Add widgets (Text, Menu, etc.) to each
4. Click **Publish/Update**

Example widgets:
- **Text Widget**: Office address, hours
- **Menu Widget**: Quick links
- **Custom HTML**: Social media links

## SEO Optimization

### Basic SEO Setup

1. **Homepage Title & Description**:
   - Site Title (Settings → General)
   - Site Tagline (Settings → General)

2. **Structure**:
   - H1: Use main hero title only once
   - H2: Section titles
   - H3: Subsection titles

3. **Images**:
   - Add descriptive alt text to all images
   - Use meaningful filenames

### Recommended: Install Yoast SEO

1. Install **Yoast SEO** plugin
2. Run setup wizard
3. Optimize each page for target keyword
4. Check readability

## Performance Optimization

### Caching

1. Install **WP Super Cache** or **W3 Total Cache**
2. Enable page caching
3. Enable browser caching
4. Enable object caching (if available)

### Image Optimization

1. Install **Imagify** or **Smush**
2. Optimize all images
3. Remove unused images

### Database Cleanup

1. Install **WP-Optimize**
2. Remove unused tables
3. Optimize database

## Security Setup

### WordPress Hardening

1. **Settings → General**:
   - Remove WordPress version from header
   - Use secure email

2. **Settings → Discussion**:
   - Moderate comments if enabled
   - Disable trackbacks

3. **Users → Edit Profile**:
   - Change default admin username
   - Use strong password

### Install Security Plugin

1. Install **Wordfence** or **Sucuri**
2. Run security scan
3. Enable two-factor authentication
4. Setup firewall rules

## Backup Setup

### Automated Backups

1. Install **UpdraftPlus** or **BackWPup**
2. Configure backup schedule:
   - Frequency: Weekly
   - Storage: Cloud (Google Drive, Dropbox)
3. Test restore process

## Inquiry Form Integration

### For Custom Inquiry Plugin

1. Create custom plugin in `/wp-content/plugins/care-inquiry-management/`
2. Hook into `care_save_inquiry` action
3. Save to custom database table
4. Send notification email
5. Add admin panel to manage inquiries

See **INTEGRATION.md** for detailed plugin development guide.

## Testing Checklist

Before launch, verify:

- [ ] Homepage displays correctly
- [ ] All sections load properly
- [ ] Hero banner shows image
- [ ] Services section displays 6 services
- [ ] Clinic timings correct
- [ ] Contact info accurate
- [ ] Inquiry form submits successfully
- [ ] Mobile menu works
- [ ] Footer displays correctly
- [ ] All links work (internal anchors)
- [ ] Images load properly
- [ ] No JavaScript errors (F12 console)
- [ ] No PHP warnings (check error logs)
- [ ] PageSpeed score acceptable (Lighthouse)

## Troubleshooting

### Hero Banner Not Showing Image
- Check image is uploaded to media library
- Verify image URL in customizer
- Check browser cache (Ctrl+Shift+R)

### Mobile Menu Not Working
- Clear browser cache
- Check JavaScript console for errors
- Verify `main.js` file exists and loads

### Form Not Submitting
- Check network tab in browser dev tools
- Verify AJAX URL is correct
- Check PHP error logs
- Ensure inquiry plugin is active

### Styles Not Loading
- Clear WordPress cache
- Verify `style.css` file integrity
- Check file permissions (644)
- Hard refresh browser (Ctrl+Shift+R)

## Support Resources

1. **Theme README.md** - Feature documentation
2. **INTEGRATION.md** - Plugin integration guide
3. **WordPress.org Docs** - Official documentation
4. **Customizer Help** - Built-in help text

## Next Steps

1. ✅ Activate theme
2. ✅ Configure basic settings
3. ✅ Add menu items
4. ✅ Upload images
5. ✅ Setup footer widgets
6. ✅ Install inquiry plugin
7. ✅ Test all functionality
8. ✅ Optimize for SEO
9. ✅ Setup backups
10. ✅ Go live!
