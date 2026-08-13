# Care Towards Cure Theme

A modern, responsive WordPress theme for clinic landing pages with integrated inquiry management.

## Version
1.0.0

## Requirements
- WordPress 6.0+
- PHP 8.2+
- MySQL 5.7+

## Features

### Theme Capabilities
- ✅ Fully Responsive Design (Desktop, Tablet, Mobile)
- ✅ SEO-Friendly Structure
- ✅ Fast Performance (Lazy loading, deferred scripts)
- ✅ Accessible Markup (WCAG compliance)
- ✅ Cross-browser Compatible
- ✅ Elementor Support (optional)
- ✅ WooCommerce Ready
- ✅ Mobile-First Design
- ✅ Custom Logo Upload
- ✅ Multiple Widget Areas

### Landing Page Sections
1. **Hero Banner** - Welcome message with call-to-action
2. **About Clinic** - Clinic information and introduction
3. **Services & Specialties** - Medical services offered
4. **Clinic Timings** - Operating hours display
5. **Facilities** - Gallery of clinic facilities
6. **Why Choose Us** - Unique selling propositions
7. **Gallery** - Image gallery section
8. **Contact** - Contact information and inquiry form
9. **Google Maps** - Location integration

### Inquiry Form Features
- Patient name, phone, email fields
- Appointment date/time selection
- Message/reason for visit
- AJAX submission
- Success/error notifications
- Security nonce verification
- Input validation and sanitization

## Installation

1. Upload theme folder to `/wp-content/themes/`
2. Go to WordPress Admin → Appearance → Themes
3. Activate "Care Towards Cure Theme"
4. Go to Appearance → Customize to configure theme options

## Customization Guide

### 1. Setting Theme Logo
- Go to WordPress Admin → Appearance → Customize → Site Identity
- Upload your clinic logo
- Set logo size (recommended: 40px height)

### 2. Configuring Hero Banner
Theme customizer options:
- `care_hero_title` - Hero title text
- `care_hero_subtitle` - Hero subtitle text
- `care_hero_image` - Hero background image

### 3. About Section
- `care_about_title` - Section title
- `care_about_content` - Section description
- `care_about_image` - Section image

### 4. Services Configuration
Configure up to 6 services:
- `care_service_title_[1-6]` - Service name
- `care_service_desc_[1-6]` - Service description
- `care_service_icon_[1-6]` - Icon selection (check, clock, phone, location, mail, menu)

### 5. Clinic Timings
- `care_timing_[day]_start` - Opening time (e.g., "9:00 AM")
- `care_timing_[day]_end` - Closing time (e.g., "5:00 PM")

Days: monday, tuesday, wednesday, thursday, friday, saturday, sunday

### 6. Facilities
Configure up to 8 facilities:
- `care_facility_title_[1-8]` - Facility name
- `care_facility_image_[1-8]` - Facility image

### 7. Gallery
Configure up to 12 gallery images:
- `care_gallery_image_[1-12]` - Gallery image

### 8. Contact Information
- `care_contact_title` - Section title
- `care_contact_phone` - Phone number
- `care_contact_email` - Email address
- `care_contact_address` - Physical address
- `care_contact_map_embed` - Google Map embed code

## File Structure

```
care-towards-cure-theme/
├── style.css              # Main stylesheet with theme metadata
├── functions.php          # Theme setup and enqueue scripts
├── header.php             # Header template
├── footer.php             # Footer template
├── front-page.php         # Homepage template
├── index.php              # Fallback template
├── 404.php                # Error page template
├── js/
│   └── main.js           # Main JavaScript file
├── languages/            # Translation files (future)
└── README.md             # This file
```

## Template Hierarchy

1. **Homepage**: Uses `front-page.php`
2. **Single Posts/Pages**: Uses `single.php` (would need to be created for custom styling)
3. **Archives**: Uses `index.php`
4. **Search Results**: Uses `index.php`
5. **404 Error**: Uses `404.php`

## Hooks & Filters

### Custom Actions
- `care_save_inquiry` - Hook for saving inquiry data (used by inquiry management plugin)

### Custom Functions
- `care_get_icon($icon)` - Get inline SVG icon
- `care_get_excerpt($id, $length)` - Get excerpt from post
- `care_theme_setup()` - Theme setup and feature support

## Styling & CSS

### CSS Variables
The theme uses CSS custom properties for consistent theming:

```css
--primary-color: #0066cc
--secondary-color: #00b4d8
--tertiary-color: #f72585
--light-bg: #f8f9fa
--dark-text: #1a1a1a
--light-text: #666666
--border-color: #e0e0e0
```

### Responsive Breakpoints
- **Tablet & Below**: 768px
- **Mobile**: 480px

## WordPress Integration

### Theme Support
- Automatic Feed Links
- Title Tag Management
- Featured Images
- Post Thumbnails
- HTML5 Markup
- Responsive Embeds
- WooCommerce Support (if needed)
- Elementor Support

### Widget Areas
- Footer Column 1
- Footer Column 2
- Footer Column 3

### Navigation Menus
- Primary Menu (Header)
- Footer Menu

## Security Features

✅ Input Sanitization (sanitize_text_field, sanitize_email, etc.)
✅ Output Escaping (esc_html, esc_attr, esc_url, etc.)
✅ NONCE Verification (for AJAX forms)
✅ Capability Checks (for admin functions)
✅ wp_kses_post() for HTML content

## Performance Optimization

✅ Defer JavaScript loading
✅ Lazy loading for images (via JS)
✅ Optimized CSS (no unnecessary code)
✅ Minimal dependencies
✅ Responsive images support

## Browser Support

- Chrome/Edge (Latest)
- Firefox (Latest)
- Safari (Latest)
- Mobile Browsers (iOS Safari, Chrome Mobile)

## AJAX Form Handler

The theme includes an AJAX inquiry form handler that:
1. Validates all input fields
2. Sanitizes data
3. Checks security nonce
4. Delegates to custom inquiry plugin via `care_save_inquiry` hook
5. Returns JSON response (success/error)

### JavaScript Implementation
- Fetch API for modern browsers
- Error handling and user feedback
- Loading state management
- Form reset on success

## Translation Support

The theme is fully translatable with text domain: `care-towards-cure`

To create translations:
1. Install Poedit or similar translation tool
2. Scan `care-towards-cure-theme` folder
3. Create `.po` and `.mo` files in `languages/` folder

Example: `languages/care-towards-cure-hi_IN.mo` (Hindi)

## Plugin Recommendations

### For Enhanced Functionality
1. **Care Inquiry Management Plugin** - Handle appointment inquiries
2. **Yoast SEO** - Advanced SEO optimization
3. **WP Super Cache** - Page caching
4. **Wordfence** - Security

### Optional
- **Elementor** - Page builder (theme supports it)
- **Contact Form 7** - Alternative form handling
- **Akismet** - Spam protection

## Troubleshooting

### Mobile Menu Not Working
- Clear browser cache
- Check if JavaScript is enabled
- Verify `main.js` is loaded (check browser console)

### Styles Not Applying
- Go to Appearance → Customize and save settings
- Clear WordPress cache
- Check style.css file integrity

### Images Not Showing
- Verify image files exist
- Check file permissions
- Use absolute URLs in customizer

## Customization Tips

### Adding Custom Colors
Edit CSS variables in `style.css`:
```css
:root {
  --primary-color: #your-color;
  --secondary-color: #your-color;
}
```

### Adding Custom Section
1. Create new section in `front-page.php`
2. Add customizer settings in `functions.php`
3. Style in `style.css`

### Modifying Inquiry Form
Form HTML is in `front-page.php`. To add fields:
1. Add form input in HTML
2. Update JavaScript AJAX handler
3. Modify PHP handler in `functions.php`

## Support & Maintenance

For issues or feature requests:
1. Check WordPress plugin/theme repository
2. Review code comments in template files
3. Check browser console for JavaScript errors
4. Verify PHP error logs

## License

GPL v2 or later - https://www.gnu.org/licenses/gpl-2.0.html

## Changelog

### Version 1.0.0 (Initial Release)
- Theme setup and core functionality
- Homepage template with all sections
- Inquiry form with AJAX handling
- Responsive design
- Mobile menu
- Footer widgets
- SEO optimization
- Security features
- Accessibility support
