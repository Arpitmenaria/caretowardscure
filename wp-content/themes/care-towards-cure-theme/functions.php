<?php
/**
 * Care Towards Cure Theme Functions
 *
 * @package Care_Towards_Cure_Theme
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

// Theme constants
define( 'CARE_THEME_VERSION', '1.0.0' );
define( 'CARE_THEME_DIR', get_template_directory() );
define( 'CARE_THEME_URI', get_template_directory_uri() );

/**
 * Theme Setup
 *
 * Registers theme features and support for various WordPress functionality.
 */
function care_theme_setup(): void {
	// Automatic feed links
	add_theme_support( 'automatic-feed-links' );

	// Title tag support - allows dynamic title management
	add_theme_support( 'title-tag' );

	// Featured images
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 630, true );
	add_image_size( 'care-hero', 1920, 600, true );
	add_image_size( 'care-card', 600, 400, true );
	add_image_size( 'care-gallery', 400, 400, true );

	// HTML5 markup support
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );

	// Responsive embedded content
	add_theme_support( 'responsive-embeds' );

	// WooCommerce support (if needed)
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Register navigation menus
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'care-towards-cure' ),
		'footer'  => __( 'Footer Menu', 'care-towards-cure' ),
	) );

	// Load text domain for translations
	load_theme_textdomain( 'care-towards-cure', CARE_THEME_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'care_theme_setup' );

/**
 * Enqueue Stylesheets
 *
 * Loads main stylesheet and any additional CSS files.
 */
function care_enqueue_styles(): void {
	// Main theme stylesheet
	wp_enqueue_style(
		'care-main',
		CARE_THEME_URI . '/style.css',
		array(),
		CARE_THEME_VERSION,
		'all'
	);

	// Mission section styles
	wp_enqueue_style(
		'care-mission',
		CARE_THEME_URI . '/css/mission.css',
		array( 'care-main' ),
		CARE_THEME_VERSION,
		'all'
	);

	// Contact section styles
	wp_enqueue_style(
		'care-contact',
		CARE_THEME_URI . '/css/contact.css',
		array( 'care-main' ),
		CARE_THEME_VERSION,
		'all'
	);

	// Footer styles
	wp_enqueue_style(
		'care-footer',
		CARE_THEME_URI . '/css/footer.css',
		array( 'care-main' ),
		CARE_THEME_VERSION,
		'all'
	);

	// Modal styles
	wp_enqueue_style(
		'care-modal',
		CARE_THEME_URI . '/css/modal.css',
		array( 'care-main' ),
		CARE_THEME_VERSION,
		'all'
	);

	// New sections styles
	wp_enqueue_style(
		'care-new-sections',
		CARE_THEME_URI . '/css/new-sections.css',
		array( 'care-main' ),
		CARE_THEME_VERSION,
		'all'
	);
}
add_action( 'wp_enqueue_scripts', 'care_enqueue_styles' );

/**
 * Enqueue Scripts
 *
 * Loads JavaScript files with proper dependencies and localization.
 */
function care_enqueue_scripts(): void {
	// Main theme script
	wp_enqueue_script(
		'care-main',
		CARE_THEME_URI . '/js/main.js',
		array(),
		CARE_THEME_VERSION,
		true
	);

	// Scroll reveal animations script
	wp_enqueue_script(
		'care-scroll-reveal',
		CARE_THEME_URI . '/js/scroll-reveal.js',
		array(),
		CARE_THEME_VERSION,
		true
	);

	// Services scroll script
	wp_enqueue_script(
		'care-services-scroll',
		CARE_THEME_URI . '/js/services-scroll.js',
		array(),
		CARE_THEME_VERSION,
		true
	);

	// Modal script
	wp_enqueue_script(
		'care-modal',
		CARE_THEME_URI . '/js/modal.js',
		array(),
		CARE_THEME_VERSION,
		true
	);

	// FAQ Accordion script
	wp_enqueue_script(
		'care-faq-accordion',
		CARE_THEME_URI . '/js/faq-accordion.js',
		array(),
		CARE_THEME_VERSION,
		true
	);

	// Mission stats counter script
	wp_enqueue_script(
		'care-mission-stats',
		CARE_THEME_URI . '/js/mission-stats.js',
		array(),
		CARE_THEME_VERSION,
		true
	);

	// Localize script for AJAX and other frontend data
	wp_localize_script(
		'care-modal',
		'careTheme',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'care_nonce' ),
		)
	);

	// Comment reply script (if comments are enabled)
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'care_enqueue_scripts' );

/**
 * Register Widget Areas
 *
 * Defines custom widget areas for the theme.
 */
function care_register_sidebars(): void {
	register_sidebar( array(
		'name'          => __( 'Footer Column 1', 'care-towards-cure' ),
		'id'            => 'footer-1',
		'description'   => __( 'Widget area in the first footer column', 'care-towards-cure' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 2', 'care-towards-cure' ),
		'id'            => 'footer-2',
		'description'   => __( 'Widget area in the second footer column', 'care-towards-cure' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Column 3', 'care-towards-cure' ),
		'id'            => 'footer-3',
		'description'   => __( 'Widget area in the third footer column', 'care-towards-cure' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'care_register_sidebars' );

/**
 * Custom Logo Support
 *
 * Adds logo support via the WordPress customizer.
 */
function care_custom_logo_setup(): void {
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
}
add_action( 'after_setup_theme', 'care_custom_logo_setup' );

/**
 * Customize Default WordPress Post Excerpt Length
 */
function care_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 20;
}
add_filter( 'excerpt_length', 'care_excerpt_length' );

/**
 * Customize the excerpt ending
 */
function care_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	return ' ...';
}
add_filter( 'excerpt_more', 'care_excerpt_more' );

/**
 * Add body classes for styling
 */
function care_body_classes( $classes ) {
	// Add class for home page
	if ( is_front_page() ) {
		$classes[] = 'is-front-page';
	}

	// Add class based on number of active sidebars
	if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) {
		$classes[] = 'no-sidebars';
	}

	return $classes;
}
add_filter( 'body_class', 'care_body_classes' );

/**
 * Sanitize Custom Logo Output
 *
 * Ensures the custom logo is output correctly.
 */
function care_get_custom_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );

	if ( ! $custom_logo_id ) {
		return false;
	}

	$html = wp_get_attachment_image( $custom_logo_id, 'full' );

	return apply_filters( 'get_custom_logo', $html, $custom_logo_id );
}

/**
 * Add support for Elementor
 *
 * Ensure theme works seamlessly with Elementor if activated.
 */
function care_elementor_support() {
	add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'care_elementor_support' );

/**
 * Sanitize HTML in custom fields
 */
function care_sanitize_html( $input ) {
	return wp_kses_post( $input );
}

/**
 * Get inline SVG icon
 *
 * Helper function to safely output SVG icons inline.
 *
 * @param string $icon Icon slug/identifier.
 * @return string SVG HTML or empty string if not found.
 */
function care_get_icon( $icon ) {
	$icons = array(
		'clock'    => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
		'phone'    => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>',
		'location' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>',
		'mail'     => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>',
		'check'    => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>',
		'menu'     => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>',
		'close'    => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
		'arrow-left' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 19l-7-7 7-7"></path></svg>',
		'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5l7 7-7 7"></path></svg>',
	);

	return isset( $icons[ $icon ] ) ? $icons[ $icon ] : '';
}

/**
 * Custom excerpt function for pages
 *
 * @param int   $id Number of characters to limit excerpt.
 * @param int   $length Post ID.
 * @return string Excerpted text.
 */
function care_get_excerpt( $id, $length = 20 ) {
	$post = get_post( $id );

	if ( ! $post ) {
		return '';
	}

	$excerpt = $post->post_excerpt ? $post->post_excerpt : $post->post_content;
	$excerpt = wp_strip_all_tags( $excerpt );
	$excerpt = wp_trim_words( $excerpt, $length, ' ...' );

	return $excerpt;
}

/**
 * Add defer attribute to non-critical scripts
 *
 * @param string $tag Script tag.
 * @param string $handle Script handle.
 * @return string Modified script tag.
 */
function care_defer_scripts( $tag, $handle ) {
	if ( 'care-main' === $handle ) {
		return str_replace( ' src', ' defer src', $tag );
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'care_defer_scripts', 10, 2 );

/**
 * WordPress AJAX handler for inquiry form
 *
 * Handles secure AJAX submission for the appointment inquiry form.
 */
function care_handle_inquiry_form(): void {
	check_ajax_referer( 'care_nonce', 'nonce' );

	// Sanitize and validate input
	$patient_name = sanitize_text_field( $_POST['patient_name'] ?? '' );
	$phone        = sanitize_text_field( $_POST['phone'] ?? '' );
	$email        = sanitize_email( $_POST['email'] ?? '' );
	$date         = sanitize_text_field( $_POST['appointment_date'] ?? '' );
	$time         = sanitize_text_field( $_POST['appointment_time'] ?? '' );
	$message      = sanitize_textarea_field( $_POST['message'] ?? '' );

	// Validate required fields
	if ( empty( $patient_name ) || empty( $phone ) ) {
		wp_send_json_error( array(
			'message' => __( 'Please fill in all required fields.', 'care-towards-cure' ),
		) );
	}

	// Validate email if provided
	if ( ! empty( $email ) && ! is_email( $email ) ) {
		wp_send_json_error( array(
			'message' => __( 'Please enter a valid email address.', 'care-towards-cure' ),
		) );
	}

	// Validate phone format (basic check)
	if ( ! preg_match( '/^[0-9\-\+\(\)\s]{10,}$/', $phone ) ) {
		wp_send_json_error( array(
			'message' => __( 'Please enter a valid phone number.', 'care-towards-cure' ),
		) );
	}

	// If a custom inquiry plugin exists, delegate to it
	if ( has_action( 'care_save_inquiry' ) ) {
		do_action( 'care_save_inquiry', array(
			'patient_name' => $patient_name,
			'phone'        => $phone,
			'email'        => $email,
			'date'         => $date,
			'time'         => $time,
			'message'      => $message,
		) );

		wp_send_json_success( array(
			'message' => __( 'Your inquiry has been submitted successfully. We will contact you soon.', 'care-towards-cure' ),
		) );
	}

	wp_send_json_error( array(
		'message' => __( 'Unable to process your request. Please try again later.', 'care-towards-cure' ),
	) );
}
add_action( 'wp_ajax_care_inquiry_form', 'care_handle_inquiry_form' );
add_action( 'wp_ajax_nopriv_care_inquiry_form', 'care_handle_inquiry_form' );

/**
 * Register Customizer Settings - Hero Section
 *
 * Adds all customizable fields for the hero section
 */
function care_customize_register( $wp_customize ) {
	// =============================================
	// HERO SECTION PANEL
	// =============================================
	$wp_customize->add_panel( 'care_hero_panel', array(
		'title'       => __( 'Hero Section', 'care-towards-cure' ),
		'priority'    => 10,
		'description' => __( 'Customize the hero section content and appearance', 'care-towards-cure' ),
	) );

	// =============================================
	// HERO CONTENT SECTION
	// =============================================
	$wp_customize->add_section( 'care_hero_content', array(
		'title'       => __( 'Hero Content', 'care-towards-cure' ),
		'panel'       => 'care_hero_panel',
		'priority'    => 10,
	) );

	// Hero Badge
	$wp_customize->add_setting( 'care_hero_badge', array(
		'default'           => __( 'TRUSTED HEALTHCARE PROVIDER', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_hero_badge', array(
		'label'       => __( 'Badge Text', 'care-towards-cure' ),
		'description' => __( 'Small badge text above the main title', 'care-towards-cure' ),
		'section'     => 'care_hero_content',
		'type'        => 'text',
	) );

	// Hero Title
	$wp_customize->add_setting( 'care_hero_title', array(
		'default'           => __( 'Your Health, Our Priority', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_hero_title', array(
		'label'       => __( 'Hero Title', 'care-towards-cure' ),
		'description' => __( 'Main heading of the hero section', 'care-towards-cure' ),
		'section'     => 'care_hero_content',
		'type'        => 'text',
	) );

	// Hero Subtitle
	$wp_customize->add_setting( 'care_hero_subtitle', array(
		'default'           => __( 'Experience world-class medical expertise with a human touch. Our specialized team is dedicated to providing personalized care tailored to your unique journey.', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_hero_subtitle', array(
		'label'       => __( 'Hero Subtitle', 'care-towards-cure' ),
		'description' => __( 'Secondary text below the main title', 'care-towards-cure' ),
		'section'     => 'care_hero_content',
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 3 ),
	) );

	// =============================================
	// HERO BUTTONS SECTION
	// =============================================
	$wp_customize->add_section( 'care_hero_buttons', array(
		'title'       => __( 'Call-to-Action Buttons', 'care-towards-cure' ),
		'panel'       => 'care_hero_panel',
		'priority'    => 20,
	) );

	// Button 1 - Primary
	$wp_customize->add_setting( 'care_hero_btn1_text', array(
		'default'           => __( 'Book Appointment', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_hero_btn1_text', array(
		'label'       => __( 'Primary Button Text', 'care-towards-cure' ),
		'section'     => 'care_hero_buttons',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'care_hero_btn1_link', array(
		'default'           => '#contact',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_hero_btn1_link', array(
		'label'       => __( 'Primary Button Link', 'care-towards-cure' ),
		'description' => __( 'URL or anchor link', 'care-towards-cure' ),
		'section'     => 'care_hero_buttons',
		'type'        => 'text',
	) );

	// Button 2 - Secondary
	$wp_customize->add_setting( 'care_hero_btn2_text', array(
		'default'           => __( 'Call Now', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_hero_btn2_text', array(
		'label'       => __( 'Secondary Button Text', 'care-towards-cure' ),
		'section'     => 'care_hero_buttons',
		'type'        => 'text',
	) );

	$wp_customize->add_setting( 'care_hero_btn2_link', array(
		'default'           => 'tel:+1555123456',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_hero_btn2_link', array(
		'label'       => __( 'Secondary Button Link', 'care-towards-cure' ),
		'description' => __( 'Use tel: for phone or http: for URL', 'care-towards-cure' ),
		'section'     => 'care_hero_buttons',
		'type'        => 'text',
	) );

	// =============================================
	// HERO IMAGES SECTION
	// =============================================
	$wp_customize->add_section( 'care_hero_images', array(
		'title'       => __( 'Carousel Images', 'care-towards-cure' ),
		'panel'       => 'care_hero_panel',
		'priority'    => 40,
		'description' => __( 'Upload 3-4 images for the hero carousel (Image 1 is required)', 'care-towards-cure' ),
	) );

	// Hero Images (4 slots)
	for ( $i = 1; $i <= 4; $i++ ) {
		$image_key = 'care_hero_image_' . $i;

		$wp_customize->add_setting( $image_key, array(
			'default'           => '',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				$image_key,
				array(
					'label'       => sprintf( __( 'Hero Image %d', 'care-towards-cure' ), $i ),
					'description' => $i === 1 ? __( '(Required)', 'care-towards-cure' ) : __( '(Optional)', 'care-towards-cure' ),
					'section'     => 'care_hero_images',
					'mime_type'   => 'image',
				)
			)
		);
	}

	// =============================================
	// CONTENT IMAGES PANEL
	// =============================================
	$wp_customize->add_panel( 'care_content_images_panel', array(
		'title'       => __( 'Content Images', 'care-towards-cure' ),
		'priority'    => 18,
		'description' => __( 'Manage images for various sections of the site', 'care-towards-cure' ),
	) );

	// =============================================
	// WELCOME SECTION IMAGES
	// =============================================
	$wp_customize->add_section( 'care_welcome_images', array(
		'title'       => __( 'Welcome Section', 'care-towards-cure' ),
		'panel'       => 'care_content_images_panel',
		'priority'    => 10,
	) );

	// Welcome Section Image
	$wp_customize->add_setting( 'care_welcome_image', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'care_welcome_image',
			array(
				'label'       => __( 'Welcome Section Image', 'care-towards-cure' ),
				'description' => __( 'Image displayed on the right side of the Welcome section', 'care-towards-cure' ),
				'section'     => 'care_welcome_images',
				'mime_type'   => 'image',
			)
		)
	);

	// =============================================
	// DOCTORS SECTION IMAGES
	// =============================================
	$wp_customize->add_section( 'care_doctors_images', array(
		'title'       => __( 'Doctors Section', 'care-towards-cure' ),
		'panel'       => 'care_content_images_panel',
		'priority'    => 20,
	) );

	// Doctor 1 Image
	$wp_customize->add_setting( 'care_doctor_image_1', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'care_doctor_image_1',
			array(
				'label'       => __( 'Doctor 1 Image', 'care-towards-cure' ),
				'description' => __( 'Profile image for the first doctor', 'care-towards-cure' ),
				'section'     => 'care_doctors_images',
				'mime_type'   => 'image',
			)
		)
	);

	// Doctor 2 Image
	$wp_customize->add_setting( 'care_doctor_image_2', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'care_doctor_image_2',
			array(
				'label'       => __( 'Doctor 2 Image', 'care-towards-cure' ),
				'description' => __( 'Profile image for the second doctor', 'care-towards-cure' ),
				'section'     => 'care_doctors_images',
				'mime_type'   => 'image',
			)
		)
	);

	// =============================================
	// MISSION SECTION PANEL
	// =============================================
	$wp_customize->add_panel( 'care_mission_panel', array(
		'title'       => __( 'Mission & Legacy Section', 'care-towards-cure' ),
		'priority'    => 20,
		'description' => __( 'Customize the mission and legacy section content', 'care-towards-cure' ),
	) );

	// =============================================
	// MISSION CONTENT SECTION
	// =============================================
	$wp_customize->add_section( 'care_mission_content', array(
		'title'       => __( 'Mission Content', 'care-towards-cure' ),
		'panel'       => 'care_mission_panel',
		'priority'    => 10,
	) );

	// Mission Title
	$wp_customize->add_setting( 'care_mission_title', array(
		'default'           => __( 'Our Mission & Legacy', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_mission_title', array(
		'label'       => __( 'Section Title', 'care-towards-cure' ),
		'section'     => 'care_mission_content',
		'type'        => 'text',
	) );

	// Mission Description 1
	$wp_customize->add_setting( 'care_mission_desc_1', array(
		'default'           => __( 'Founded in 1998, Vitae Clinic has been at the forefront of medical innovation for over two decades. Our journey began with a simple vision: to provide high-quality, patient-centric care that combines clinical expertise with a compassionate touch.', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_mission_desc_1', array(
		'label'       => __( 'Description - Paragraph 1', 'care-towards-cure' ),
		'section'     => 'care_mission_content',
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 4 ),
	) );

	// Mission Description 2
	$wp_customize->add_setting( 'care_mission_desc_2', array(
		'default'           => __( 'Today, we are recognized as a leader in multi-specialty healthcare, serving thousands of patients annually with a commitment to integrity, transparency, and medical excellence.', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_mission_desc_2', array(
		'label'       => __( 'Description - Paragraph 2', 'care-towards-cure' ),
		'section'     => 'care_mission_content',
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 3 ),
	) );

	// =============================================
	// MISSION STATS SECTION
	// =============================================
	$wp_customize->add_section( 'care_mission_stats', array(
		'title'       => __( 'Statistics', 'care-towards-cure' ),
		'panel'       => 'care_mission_panel',
		'priority'    => 20,
	) );

	// Stats (4 items)
	$stat_defaults = array(
		array( 'value' => '25+', 'label' => 'Years Excellence', 'color' => '' ),
		array( 'value' => '50+', 'label' => 'Happy Patients', 'color' => 'primary' ),
		array( 'value' => '40+', 'label' => 'Specialists', 'color' => '' ),
		array( 'value' => '12+', 'label' => 'Awards Won', 'color' => 'secondary' ),
	);

	for ( $i = 1; $i <= 4; $i++ ) {
		$default = $stat_defaults[ $i - 1 ];

		// Stat Value
		$stat_value_key = 'care_mission_stat_' . $i . '_value';
		$wp_customize->add_setting( $stat_value_key, array(
			'default'           => $default['value'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $stat_value_key, array(
			'label'       => sprintf( __( 'Statistic %d - Value', 'care-towards-cure' ), $i ),
			'section'     => 'care_mission_stats',
			'type'        => 'text',
		) );

		// Stat Label
		$stat_label_key = 'care_mission_stat_' . $i . '_label';
		$wp_customize->add_setting( $stat_label_key, array(
			'default'           => $default['label'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $stat_label_key, array(
			'label'       => sprintf( __( 'Statistic %d - Label', 'care-towards-cure' ), $i ),
			'section'     => 'care_mission_stats',
			'type'        => 'text',
		) );

		// Stat Color
		$stat_color_key = 'care_mission_stat_' . $i . '_color';
		$wp_customize->add_setting( $stat_color_key, array(
			'default'           => $default['color'],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $stat_color_key, array(
			'label'       => sprintf( __( 'Statistic %d - Color', 'care-towards-cure' ), $i ),
			'description' => __( 'Leave blank for white/light, "primary" for blue, "secondary" for cyan', 'care-towards-cure' ),
			'section'     => 'care_mission_stats',
			'type'        => 'text',
		) );
	}

	// =============================================
	// SERVICES SECTION PANEL
	// =============================================
	$wp_customize->add_panel( 'care_services_panel', array(
		'title'       => __( 'Services Section', 'care-towards-cure' ),
		'priority'    => 30,
		'description' => __( 'Customize the services and specialties section', 'care-towards-cure' ),
	) );

	// =============================================
	// SERVICES CONTENT SECTION
	// =============================================
	$wp_customize->add_section( 'care_services_content', array(
		'title'       => __( 'Services Content', 'care-towards-cure' ),
		'panel'       => 'care_services_panel',
		'priority'    => 10,
	) );

	// Services Badge
	$wp_customize->add_setting( 'care_services_badge', array(
		'default'           => __( 'OUR SERVICES', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_services_badge', array(
		'label'       => __( 'Badge Text', 'care-towards-cure' ),
		'section'     => 'care_services_content',
		'type'        => 'text',
	) );

	// Services Title
	$wp_customize->add_setting( 'care_services_title', array(
		'default'           => __( 'Comprehensive Care Portfolio', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_services_title', array(
		'label'       => __( 'Section Title', 'care-towards-cure' ),
		'section'     => 'care_services_content',
		'type'        => 'text',
	) );

	// Services Description
	$wp_customize->add_setting( 'care_services_description', array(
		'default'           => __( 'Explore our wide range of medical services and specialties', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_services_description', array(
		'label'       => __( 'Section Description', 'care-towards-cure' ),
		'section'     => 'care_services_content',
		'type'        => 'text',
	) );

	// =============================================
	// SERVICES ITEMS SECTION
	// =============================================
	$wp_customize->add_section( 'care_services_items', array(
		'title'       => __( 'Services & Specialties', 'care-towards-cure' ),
		'panel'       => 'care_services_panel',
		'priority'    => 20,
		'description' => __( 'Add up to 6 services/specialties. The first one will be featured (primary blue)', 'care-towards-cure' ),
	) );

	// Service Items (6 slots)
	$service_defaults = array(
		array( 'title' => 'General Consultation', 'desc' => 'Your first point of contact for all medical concerns and regular checkups.', 'link' => '#', 'style' => 'primary', 'icon' => '🩺' ),
		array( 'title' => 'Pediatrics', 'desc' => 'Specialized care for our youngest patients.', 'link' => '#', 'style' => 'secondary', 'icon' => '👶' ),
		array( 'title' => 'Orthopedics', 'desc' => 'Focusing on bone and joint health.', 'link' => '#', 'style' => 'light', 'icon' => '🦴' ),
		array( 'title' => 'Cardiology', 'desc' => 'Advanced cardiac monitoring.', 'link' => '#', 'style' => 'light', 'icon' => '❤️' ),
		array( 'title' => 'Physiotherapy', 'desc' => 'Rehabilitation programs tailored to recovery.', 'link' => '#', 'style' => 'white', 'icon' => '🏃' ),
		array( 'title' => 'Dental Care', 'desc' => 'Complete oral hygiene care.', 'link' => '#', 'style' => 'light', 'icon' => '🦷' ),
	);

	for ( $i = 1; $i <= 6; $i++ ) {
		$default = $service_defaults[ $i - 1 ];

		// Service Title
		$service_title_key = 'care_service_' . $i . '_title';
		$wp_customize->add_setting( $service_title_key, array(
			'default'           => $default['title'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $service_title_key, array(
			'label'       => sprintf( __( 'Service %d - Title', 'care-towards-cure' ), $i ),
			'section'     => 'care_services_items',
			'type'        => 'text',
		) );

		// Service Description
		$service_desc_key = 'care_service_' . $i . '_description';
		$wp_customize->add_setting( $service_desc_key, array(
			'default'           => $default['desc'],
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $service_desc_key, array(
			'label'       => sprintf( __( 'Service %d - Description', 'care-towards-cure' ), $i ),
			'section'     => 'care_services_items',
			'type'        => 'textarea',
			'input_attrs' => array( 'rows' => 2 ),
		) );

		// Service Link
		$service_link_key = 'care_service_' . $i . '_link';
		$wp_customize->add_setting( $service_link_key, array(
			'default'           => $default['link'],
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $service_link_key, array(
			'label'       => sprintf( __( 'Service %d - Link (Optional)', 'care-towards-cure' ), $i ),
			'section'     => 'care_services_items',
			'type'        => 'text',
		) );

		// Service Style
		$service_style_key = 'care_service_' . $i . '_style';
		$wp_customize->add_setting( $service_style_key, array(
			'default'           => $default['style'],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $service_style_key, array(
			'label'       => sprintf( __( 'Service %d - Card Style', 'care-towards-cure' ), $i ),
			'description' => __( 'primary (blue featured), secondary (cyan), light (gray), or white', 'care-towards-cure' ),
			'section'     => 'care_services_items',
			'type'        => 'text',
		) );
	}

	// =============================================
	// GALLERY/FACILITIES SECTION PANEL
	// =============================================
	$wp_customize->add_panel( 'care_gallery_panel', array(
		'title'       => __( 'Gallery/Facilities Section', 'care-towards-cure' ),
		'priority'    => 40,
		'description' => __( 'Customize the facilities gallery section with masonry layout', 'care-towards-cure' ),
	) );

	// =============================================
	// GALLERY CONTENT SECTION
	// =============================================
	$wp_customize->add_section( 'care_gallery_content', array(
		'title'       => __( 'Gallery Content', 'care-towards-cure' ),
		'panel'       => 'care_gallery_panel',
		'priority'    => 10,
	) );

	// Gallery Badge
	$wp_customize->add_setting( 'care_gallery_badge', array(
		'default'           => __( 'WORLD-CLASS FACILITIES', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_gallery_badge', array(
		'label'       => __( 'Badge Text', 'care-towards-cure' ),
		'section'     => 'care_gallery_content',
		'type'        => 'text',
	) );

	// Gallery Title
	$wp_customize->add_setting( 'care_gallery_title', array(
		'default'           => __( 'World-Class Facilities', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_gallery_title', array(
		'label'       => __( 'Section Title', 'care-towards-cure' ),
		'section'     => 'care_gallery_content',
		'type'        => 'text',
	) );

	// Gallery Description
	$wp_customize->add_setting( 'care_gallery_description', array(
		'default'           => __( 'Equipped with the latest diagnostic and therapeutic technology.', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_gallery_description', array(
		'label'       => __( 'Section Description', 'care-towards-cure' ),
		'section'     => 'care_gallery_content',
		'type'        => 'text',
	) );

	// Gallery View Link Text
	$wp_customize->add_setting( 'care_gallery_view_link', array(
		'default'           => __( 'View Full Gallery', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_gallery_view_link', array(
		'label'       => __( 'View Gallery Link Text', 'care-towards-cure' ),
		'section'     => 'care_gallery_content',
		'type'        => 'text',
	) );

	// =============================================
	// GALLERY ITEMS SECTION
	// =============================================
	$wp_customize->add_section( 'care_gallery_items', array(
		'title'       => __( 'Facility Items', 'care-towards-cure' ),
		'panel'       => 'care_gallery_panel',
		'priority'    => 20,
		'description' => __( 'Upload images for each facility. First 4 items will be displayed in masonry layout.', 'care-towards-cure' ),
	) );

	// Gallery Items (6 slots available)
	$facility_defaults = array(
		array( 'title' => 'Advanced Imaging Center' ),
		array( 'title' => 'Consultation Room' ),
		array( 'title' => 'Research Lab' ),
		array( 'title' => 'Patient Comfort Lounge' ),
		array( 'title' => 'Surgery Suite' ),
		array( 'title' => 'Emergency Care' ),
	);

	for ( $i = 1; $i <= 6; $i++ ) {
		$default = $facility_defaults[ $i - 1 ];

		// Facility Title
		$facility_title_key = 'care_facility_' . $i . '_title';
		$wp_customize->add_setting( $facility_title_key, array(
			'default'           => $default['title'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $facility_title_key, array(
			'label'       => sprintf( __( 'Facility %d - Title', 'care-towards-cure' ), $i ),
			'section'     => 'care_gallery_items',
			'type'        => 'text',
		) );

		// Facility Image
		$facility_image_key = 'care_facility_' . $i . '_image';
		$wp_customize->add_setting( $facility_image_key, array(
			'default'           => '',
			'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				$facility_image_key,
				array(
					'label'       => sprintf( __( 'Facility %d - Image', 'care-towards-cure' ), $i ),
					'description' => ( $i <= 4 ) ? __( '(Displayed in masonry)', 'care-towards-cure' ) : __( '(Hidden)', 'care-towards-cure' ),
					'section'     => 'care_gallery_items',
					'mime_type'   => 'image',
				)
			)
		);
	}

	// =============================================
	// DOCTOR/TEAM MEMBER SECTION PANEL
	// =============================================
	$wp_customize->add_panel( 'care_doctor_panel', array(
		'title'       => __( 'Doctor/Team Member Section', 'care-towards-cure' ),
		'priority'    => 50,
		'description' => __( 'Customize the featured doctor or team member profile', 'care-towards-cure' ),
	) );

	// =============================================
	// DOCTOR CONTENT SECTION
	// =============================================
	$wp_customize->add_section( 'care_doctor_content', array(
		'title'       => __( 'Doctor Content', 'care-towards-cure' ),
		'panel'       => 'care_doctor_panel',
		'priority'    => 10,
	) );

	// Doctor Badge
	$wp_customize->add_setting( 'care_doctor_badge', array(
		'default'           => __( 'HEAD OF CLINICAL EXCELLENCE', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_doctor_badge', array(
		'label'       => __( 'Badge Text', 'care-towards-cure' ),
		'section'     => 'care_doctor_content',
		'type'        => 'text',
	) );

	// Doctor Name
	$wp_customize->add_setting( 'care_doctor_name', array(
		'default'           => __( 'Dr. Jonathan Healthington', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_doctor_name', array(
		'label'       => __( 'Doctor Name', 'care-towards-cure' ),
		'section'     => 'care_doctor_content',
		'type'        => 'text',
	) );

	// Doctor Title
	$wp_customize->add_setting( 'care_doctor_title', array(
		'default'           => __( 'Chief Cardiologist & Medical Director', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_doctor_title', array(
		'label'       => __( 'Doctor Title/Position', 'care-towards-cure' ),
		'section'     => 'care_doctor_content',
		'type'        => 'text',
	) );

	// Doctor Experience
	$wp_customize->add_setting( 'care_doctor_experience', array(
		'default'           => __( '25+ Years', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_doctor_experience', array(
		'label'       => __( 'Experience', 'care-towards-cure' ),
		'description' => __( 'e.g., "25+ Years"', 'care-towards-cure' ),
		'section'     => 'care_doctor_content',
		'type'        => 'text',
	) );

	// Doctor Qualifications
	$wp_customize->add_setting( 'care_doctor_qualifications', array(
		'default'           => __( 'MD, PhD, FACC', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_doctor_qualifications', array(
		'label'       => __( 'Qualifications', 'care-towards-cure' ),
		'description' => __( 'e.g., "MD, PhD, FACC"', 'care-towards-cure' ),
		'section'     => 'care_doctor_content',
		'type'        => 'text',
	) );

	// Doctor Description
	$wp_customize->add_setting( 'care_doctor_description', array(
		'default'           => __( 'Dr. Healthington has pioneered several non-invasive cardiac procedures and leads our team with a philosophy centered on "Precision with Heart." Under his guidance, HealthPremium has achieved a 99.2% patient satisfaction rating.', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_doctor_description', array(
		'label'       => __( 'Description', 'care-towards-cure' ),
		'section'     => 'care_doctor_content',
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 5 ),
	) );

	// =============================================
	// DOCTOR IMAGE SECTION
	// =============================================
	$wp_customize->add_section( 'care_doctor_image', array(
		'title'       => __( 'Doctor Image', 'care-towards-cure' ),
		'panel'       => 'care_doctor_panel',
		'priority'    => 20,
		'description' => __( 'Upload a professional portrait image (aspect ratio 4:5 recommended)', 'care-towards-cure' ),
	) );

	// Doctor Image
	$wp_customize->add_setting( 'care_doctor_image', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'care_doctor_image',
			array(
				'label'       => __( 'Doctor Portrait', 'care-towards-cure' ),
				'description' => __( 'Professional headshot or portrait', 'care-towards-cure' ),
				'section'     => 'care_doctor_image',
				'mime_type'   => 'image',
			)
		)
	);

	// =============================================
	// TIMINGS/OPERATING HOURS SECTION PANEL
	// =============================================
	$wp_customize->add_panel( 'care_timings_panel', array(
		'title'       => __( 'Timings & Benefits Section', 'care-towards-cure' ),
		'priority'    => 60,
		'description' => __( 'Customize clinic operating hours and why choose us benefits', 'care-towards-cure' ),
	) );

	// =============================================
	// OPERATING HOURS SECTION
	// =============================================
	$wp_customize->add_section( 'care_timings_hours', array(
		'title'       => __( 'Clinic Operating Hours', 'care-towards-cure' ),
		'panel'       => 'care_timings_panel',
		'priority'    => 10,
	) );

	// Operating Hours (3 slots)
	$hours_defaults = array(
		array( 'day' => 'Monday - Friday', 'time' => '08:00 AM - 08:00 PM', 'type' => 'primary' ),
		array( 'day' => 'Saturday', 'time' => '09:00 AM - 05:00 PM', 'type' => 'secondary' ),
		array( 'day' => 'Sunday', 'time' => 'Closed / Emergency Only', 'type' => 'closed' ),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$default = $hours_defaults[ $i - 1 ];

		// Hours Day
		$hours_day_key = 'care_hours_' . $i . '_day';
		$wp_customize->add_setting( $hours_day_key, array(
			'default'           => $default['day'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $hours_day_key, array(
			'label'       => sprintf( __( 'Day %d', 'care-towards-cure' ), $i ),
			'section'     => 'care_timings_hours',
			'type'        => 'text',
		) );

		// Hours Time
		$hours_time_key = 'care_hours_' . $i . '_time';
		$wp_customize->add_setting( $hours_time_key, array(
			'default'           => $default['time'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $hours_time_key, array(
			'label'       => sprintf( __( 'Time %d', 'care-towards-cure' ), $i ),
			'section'     => 'care_timings_hours',
			'type'        => 'text',
		) );

		// Hours Type
		$hours_type_key = 'care_hours_' . $i . '_type';
		$wp_customize->add_setting( $hours_type_key, array(
			'default'           => $default['type'],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $hours_type_key, array(
			'label'       => sprintf( __( 'Type %d', 'care-towards-cure' ), $i ),
			'description' => __( '"primary" (blue), "secondary" (cyan), or "closed" (red)', 'care-towards-cure' ),
			'section'     => 'care_timings_hours',
			'type'        => 'text',
		) );
	}

	// Emergency Notice
	$wp_customize->add_setting( 'care_timings_emergency', array(
		'default'           => __( '24/7 Emergency support is available via our helpline.', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_timings_emergency', array(
		'label'       => __( 'Emergency Notice', 'care-towards-cure' ),
		'section'     => 'care_timings_hours',
		'type'        => 'text',
	) );

	// =============================================
	// BENEFITS SECTION
	// =============================================
	$wp_customize->add_section( 'care_benefits_section', array(
		'title'       => __( 'Why Choose Us Benefits', 'care-towards-cure' ),
		'panel'       => 'care_timings_panel',
		'priority'    => 20,
	) );

	// Benefits Title
	$wp_customize->add_setting( 'care_benefits_title', array(
		'default'           => __( 'Why Patients Choose Vitae', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_benefits_title', array(
		'label'       => __( 'Section Title', 'care-towards-cure' ),
		'section'     => 'care_benefits_section',
		'type'        => 'text',
	) );

	// Benefits Items (3 slots)
	$benefit_defaults = array(
		array( 'title' => 'Patient-Centric Care', 'desc' => 'We prioritize your comfort and well-being with personalized treatment plans and attentive service.', 'icon' => '❤️', 'type' => 'primary' ),
		array( 'title' => 'Modern Technology', 'desc' => 'Utilizing the latest medical equipment and digital health records for accurate diagnosis.', 'icon' => '⚙️', 'type' => 'secondary' ),
		array( 'title' => 'Board-Certified Experts', 'desc' => 'Our specialists are world-class professionals with extensive experience in their fields.', 'icon' => '🏆', 'type' => 'dark' ),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$default = $benefit_defaults[ $i - 1 ];

		// Benefit Title
		$benefit_title_key = 'care_benefit_' . $i . '_title';
		$wp_customize->add_setting( $benefit_title_key, array(
			'default'           => $default['title'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $benefit_title_key, array(
			'label'       => sprintf( __( 'Benefit %d - Title', 'care-towards-cure' ), $i ),
			'section'     => 'care_benefits_section',
			'type'        => 'text',
		) );

		// Benefit Description
		$benefit_desc_key = 'care_benefit_' . $i . '_description';
		$wp_customize->add_setting( $benefit_desc_key, array(
			'default'           => $default['desc'],
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $benefit_desc_key, array(
			'label'       => sprintf( __( 'Benefit %d - Description', 'care-towards-cure' ), $i ),
			'section'     => 'care_benefits_section',
			'type'        => 'textarea',
			'input_attrs' => array( 'rows' => 3 ),
		) );

		// Benefit Icon
		$benefit_icon_key = 'care_benefit_' . $i . '_icon';
		$wp_customize->add_setting( $benefit_icon_key, array(
			'default'           => $default['icon'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $benefit_icon_key, array(
			'label'       => sprintf( __( 'Benefit %d - Icon (Emoji)', 'care-towards-cure' ), $i ),
			'section'     => 'care_benefits_section',
			'type'        => 'text',
		) );

		// Benefit Type
		$benefit_type_key = 'care_benefit_' . $i . '_type';
		$wp_customize->add_setting( $benefit_type_key, array(
			'default'           => $default['type'],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( $benefit_type_key, array(
			'label'       => sprintf( __( 'Benefit %d - Icon Color', 'care-towards-cure' ), $i ),
			'description' => __( '"primary" (blue), "secondary" (cyan), or "dark" (navy)', 'care-towards-cure' ),
			'section'     => 'care_benefits_section',
			'type'        => 'text',
		) );
	}

	// =============================================
	// REVIEWS/TESTIMONIALS SECTION PANEL
	// =============================================
	$wp_customize->add_panel( 'care_reviews_panel', array(
		'title'       => __( 'Reviews/Testimonials Section', 'care-towards-cure' ),
		'priority'    => 70,
		'description' => __( 'Customize patient reviews and testimonials', 'care-towards-cure' ),
	) );

	// =============================================
	// REVIEWS HEADER SECTION
	// =============================================
	$wp_customize->add_section( 'care_reviews_header', array(
		'title'       => __( 'Reviews Header', 'care-towards-cure' ),
		'panel'       => 'care_reviews_panel',
		'priority'    => 10,
	) );

	// Reviews Badge
	$wp_customize->add_setting( 'care_reviews_badge', array(
		'default'           => __( 'PATIENT STORIES', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_reviews_badge', array(
		'label'       => __( 'Badge Text', 'care-towards-cure' ),
		'section'     => 'care_reviews_header',
		'type'        => 'text',
	) );

	// Reviews Title
	$wp_customize->add_setting( 'care_reviews_title', array(
		'default'           => __( 'What Our Patients Say', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_reviews_title', array(
		'label'       => __( 'Section Title', 'care-towards-cure' ),
		'section'     => 'care_reviews_header',
		'type'        => 'text',
	) );

	// =============================================
	// REVIEWS ITEMS SECTION
	// =============================================
	$wp_customize->add_section( 'care_reviews_items', array(
		'title'       => __( 'Patient Reviews', 'care-towards-cure' ),
		'panel'       => 'care_reviews_panel',
		'priority'    => 20,
		'description' => __( 'Add up to 3 patient testimonials. Middle one will be featured (dark blue).', 'care-towards-cure' ),
	) );

	// Review Items (3 slots)
	$review_defaults = array(
		array(
			'name'     => 'Sarah Jenkins',
			'role'     => 'General Checkup',
			'rating'   => 5,
			'text'     => 'The level of professionalism and care I received at HealthPremium was unmatched. Dr. Jonathan took the time to explain everything clearly.',
			'featured' => false,
		),
		array(
			'name'     => 'Robert Wilson',
			'role'     => 'Emergency Care',
			'rating'   => 5,
			'text'     => 'Emergency services were lightning fast. They saved my husband\'s life. I can\'t thank the staff enough for their dedication and calm under pressure.',
			'featured' => true,
		),
		array(
			'name'     => 'Michael Chen',
			'role'     => 'Diagnostics',
			'rating'   => 5,
			'text'     => 'Finally a clinic that respects your time. Digital check-in was seamless, and the facilities are remarkably clean and modern.',
			'featured' => false,
		),
	);

	for ( $i = 1; $i <= 3; $i++ ) {
		$default = $review_defaults[ $i - 1 ];

		// Review Name
		$review_name_key = 'care_review_' . $i . '_name';
		$wp_customize->add_setting( $review_name_key, array(
			'default'           => $default['name'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $review_name_key, array(
			'label'       => sprintf( __( 'Review %d - Patient Name', 'care-towards-cure' ), $i ),
			'section'     => 'care_reviews_items',
			'type'        => 'text',
		) );

		// Review Role/Department
		$review_role_key = 'care_review_' . $i . '_role';
		$wp_customize->add_setting( $review_role_key, array(
			'default'           => $default['role'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $review_role_key, array(
			'label'       => sprintf( __( 'Review %d - Department/Service', 'care-towards-cure' ), $i ),
			'section'     => 'care_reviews_items',
			'type'        => 'text',
		) );

		// Review Rating
		$review_rating_key = 'care_review_' . $i . '_rating';
		$wp_customize->add_setting( $review_rating_key, array(
			'default'           => $default['rating'],
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $review_rating_key, array(
			'label'       => sprintf( __( 'Review %d - Rating (1-5 stars)', 'care-towards-cure' ), $i ),
			'section'     => 'care_reviews_items',
			'type'        => 'number',
			'input_attrs' => array( 'min' => 1, 'max' => 5, 'step' => 1 ),
		) );

		// Review Text
		$review_text_key = 'care_review_' . $i . '_text';
		$wp_customize->add_setting( $review_text_key, array(
			'default'           => $default['text'],
			'sanitize_callback' => 'sanitize_textarea_field',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $review_text_key, array(
			'label'       => sprintf( __( 'Review %d - Testimonial Text', 'care-towards-cure' ), $i ),
			'section'     => 'care_reviews_items',
			'type'        => 'textarea',
			'input_attrs' => array( 'rows' => 4 ),
		) );

		// Review Featured
		$review_featured_key = 'care_review_' . $i . '_featured';
		$wp_customize->add_setting( $review_featured_key, array(
			'default'           => $default['featured'],
			'sanitize_callback' => 'rest_sanitize_boolean',
			'transport'         => 'postMessage',
		) );
		$wp_customize->add_control( $review_featured_key, array(
			'label'       => sprintf( __( 'Review %d - Featured (Dark Blue Background)', 'care-towards-cure' ), $i ),
			'section'     => 'care_reviews_items',
			'type'        => 'checkbox',
		) );
	}

	// =============================================
	// CONTACT SECTION PANEL
	// =============================================
	$wp_customize->add_panel( 'care_contact_panel', array(
		'title'       => __( 'Contact Section', 'care-towards-cure' ),
		'priority'    => 80,
		'description' => __( 'Customize contact information and Google Map', 'care-towards-cure' ),
	) );

	// =============================================
	// CONTACT HEADER SECTION
	// =============================================
	$wp_customize->add_section( 'care_contact_header', array(
		'title'       => __( 'Contact Header', 'care-towards-cure' ),
		'panel'       => 'care_contact_panel',
		'priority'    => 10,
	) );

	// Contact Badge
	$wp_customize->add_setting( 'care_contact_badge', array(
		'default'           => __( 'GET IN TOUCH', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_contact_badge', array(
		'label'       => __( 'Badge Text', 'care-towards-cure' ),
		'section'     => 'care_contact_header',
		'type'        => 'text',
	) );

	// Contact Title
	$wp_customize->add_setting( 'care_contact_title', array(
		'default'           => __( 'Contact Our Clinic', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_contact_title', array(
		'label'       => __( 'Section Title', 'care-towards-cure' ),
		'section'     => 'care_contact_header',
		'type'        => 'text',
	) );

	// =============================================
	// CONTACT INFO SECTION
	// =============================================
	$wp_customize->add_section( 'care_contact_info', array(
		'title'       => __( 'Contact Information', 'care-towards-cure' ),
		'panel'       => 'care_contact_panel',
		'priority'    => 20,
	) );

	// Clinic Address
	$wp_customize->add_setting( 'care_contact_address', array(
		'default'           => __( 'C-114, Triveni Nagar Rd, opp. Triveni Heights, Shopping Centre, Vishveshvariya Nagar, Arjun Nagar, Jaipur, Rajasthan 302019', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_contact_address', array(
		'label'       => __( 'Clinic Address', 'care-towards-cure' ),
		'section'     => 'care_contact_info',
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 2 ),
	) );

	// Phone Number
	$wp_customize->add_setting( 'care_contact_phone', array(
		'default'           => '+91 9414311475',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_contact_phone', array(
		'label'       => __( 'Phone Number', 'care-towards-cure' ),
		'section'     => 'care_contact_info',
		'type'        => 'text',
	) );

	// Email
	$wp_customize->add_setting( 'care_contact_email', array(
		'default'           => 'caretowardscure@gmail.com',
		'sanitize_callback' => 'sanitize_email',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_contact_email', array(
		'label'       => __( 'Email Address', 'care-towards-cure' ),
		'section'     => 'care_contact_info',
		'type'        => 'email',
	) );

	// =============================================
	// GOOGLE MAP SECTION
	// =============================================
	$wp_customize->add_section( 'care_contact_map', array(
		'title'       => __( 'Google Map', 'care-towards-cure' ),
		'panel'       => 'care_contact_panel',
		'priority'    => 30,
		'description' => __( 'Embed your Google Map. Go to Google Maps > Share > Embed a map > Copy iframe src URL', 'care-towards-cure' ),
	) );

	// Google Map URL
	$wp_customize->add_setting( 'care_contact_map_url', array(
		'default'           => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3558.2623!2d75.7812467!3d26.8666793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1sCare%20Towards%20Cure!2s0x396db5b581ba7fad:0xff2dc658bdf92ade!5e0!3m2!1sen!2sin!4v1722865200000',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_contact_map_url', array(
		'label'       => __( 'Google Map Embed URL', 'care-towards-cure' ),
		'description' => __( 'Paste the complete iframe src URL from Google Maps', 'care-towards-cure' ),
		'section'     => 'care_contact_map',
		'type'        => 'url',
	) );

	// =============================================
	// FOOTER PANEL
	// =============================================
	$wp_customize->add_panel( 'care_footer_panel', array(
		'title'       => __( 'Footer', 'care-towards-cure' ),
		'priority'    => 90,
		'description' => __( 'Customize footer branding, social media, and contact details', 'care-towards-cure' ),
	) );

	// =============================================
	// FOOTER BRANDING SECTION
	// =============================================
	$wp_customize->add_section( 'care_footer_branding', array(
		'title'       => __( 'Branding', 'care-towards-cure' ),
		'panel'       => 'care_footer_panel',
		'priority'    => 10,
	) );

	// Footer Logo Name
	$wp_customize->add_setting( 'care_footer_logo_name', array(
		'default'           => get_bloginfo( 'name' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_footer_logo_name', array(
		'label'       => __( 'Organization Name', 'care-towards-cure' ),
		'section'     => 'care_footer_branding',
		'type'        => 'text',
	) );

	// Footer Tagline
	$wp_customize->add_setting( 'care_footer_tagline', array(
		'default'           => __( 'Dedicated to providing world-class medical care with compassion and integrity.', 'care-towards-cure' ),
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_footer_tagline', array(
		'label'       => __( 'Tagline/Description', 'care-towards-cure' ),
		'section'     => 'care_footer_branding',
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 3 ),
	) );

	// =============================================
	// SOCIAL MEDIA SECTION
	// =============================================
	$wp_customize->add_section( 'care_footer_social', array(
		'title'       => __( 'Social Media Links', 'care-towards-cure' ),
		'panel'       => 'care_footer_panel',
		'priority'    => 20,
		'description' => __( 'Add your social media profile URLs', 'care-towards-cure' ),
	) );

	$social_platforms = array(
		'facebook'  => 'Facebook',
		'twitter'   => 'Twitter / X',
		'instagram' => 'Instagram',
		'linkedin'  => 'LinkedIn',
		'youtube'   => 'YouTube',
	);

	foreach ( $social_platforms as $platform => $label ) {
		$setting_key = 'care_social_' . $platform;

		$wp_customize->add_setting( $setting_key, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( $setting_key, array(
			'label'       => $label . ' ' . __( 'URL', 'care-towards-cure' ),
			'section'     => 'care_footer_social',
			'type'        => 'url',
		) );
	}

	// =============================================
	// FOOTER CONTACT SECTION
	// =============================================
	$wp_customize->add_section( 'care_footer_contact', array(
		'title'       => __( 'Contact Details', 'care-towards-cure' ),
		'panel'       => 'care_footer_panel',
		'priority'    => 30,
	) );

	// Footer Phone
	$wp_customize->add_setting( 'care_footer_phone', array(
		'default'           => '+91 9414311475',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_footer_phone', array(
		'label'       => __( 'Phone Number', 'care-towards-cure' ),
		'section'     => 'care_footer_contact',
		'type'        => 'text',
	) );

	// Footer Email
	$wp_customize->add_setting( 'care_footer_email', array(
		'default'           => 'caretowardscure@gmail.com',
		'sanitize_callback' => 'sanitize_email',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_footer_email', array(
		'label'       => __( 'Email Address', 'care-towards-cure' ),
		'section'     => 'care_footer_contact',
		'type'        => 'email',
	) );

	// Footer Hours
	$wp_customize->add_setting( 'care_footer_hours', array(
		'default'           => '24/7 Available',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_footer_hours', array(
		'label'       => __( 'Operating Hours', 'care-towards-cure' ),
		'description' => __( 'e.g., "Mon-Fri 9AM-6PM" or "24/7 Available"', 'care-towards-cure' ),
		'section'     => 'care_footer_contact',
		'type'        => 'text',
	) );

	// =============================================
	// FOOTER COPYRIGHT SECTION
	// =============================================
	$wp_customize->add_section( 'care_footer_copyright', array(
		'title'       => __( 'Copyright & Links', 'care-towards-cure' ),
		'panel'       => 'care_footer_panel',
		'priority'    => 40,
	) );

	// Footer Copyright Text
	$wp_customize->add_setting( 'care_footer_copyright', array(
		'default'           => sprintf( '&copy; %d %s. All rights reserved.', gmdate( 'Y' ), get_bloginfo( 'name' ) ),
		'sanitize_callback' => 'sanitize_textarea_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'care_footer_copyright', array(
		'label'       => __( 'Copyright Text', 'care-towards-cure' ),
		'description' => __( 'HTML tags allowed: &lt;strong&gt;, &lt;em&gt;, &lt;a&gt;', 'care-towards-cure' ),
		'section'     => 'care_footer_copyright',
		'type'        => 'textarea',
		'input_attrs' => array( 'rows' => 2 ),
	) );
}
add_action( 'customize_register', 'care_customize_register' );

/**
 * Create Policy Pages
 *
 * Creates Privacy Policy, Terms & Conditions, and Refund & Cancellation Policy pages
 * if they don't already exist. Hooked to after_theme_switch for automatic creation.
 */
function care_create_policy_pages(): void {
	$pages = array(
		array(
			'post_title'   => 'Privacy Policy',
			'post_name'    => 'privacy-policy',
			'post_content' => '# Privacy Policy

**Last Updated: August 11, 2026**

Care Towards Cure ("we," "our," or "us") operates the website care-towards-cure.local (the "Site"). This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our Site or use our services.

## 1. Information We Collect

**Personal Information you provide:**
- Name, email address, phone number
- Appointment booking details
- Health-related information you submit through forms or consultations
- Payment information (processed securely)

**Automatically collected information:**
- IP address, browser type, device information
- Pages visited, time spent, referring website
- Cookies and similar tracking technologies

## 2. How We Use Your Information

- To schedule and manage appointments
- To provide medical consultations and follow-up care
- To communicate with you about your care
- To improve our website and services
- To comply with legal and regulatory obligations
- To send administrative information and appointment reminders

## 3. How We Protect Your Information

We implement reasonable administrative, technical, and physical safeguards to protect your personal and health information from unauthorized access, disclosure, or misuse. All data is encrypted and stored securely. However, no method of transmission over the internet is 100% secure.

## 4. Sharing Your Information

We do not sell your personal information. We may share information with:
- Healthcare providers involved in your care
- Service providers who help us operate the Site (hosting, payment processing, appointment scheduling)
- Legal authorities when required by law
- Payment processors for secure transaction processing

## 5. Your Rights

Depending on your location, you may have the right to:
- Access the personal information we hold about you
- Request correction or deletion of your data
- Withdraw consent for data processing
- Request a copy of your data in a portable format

To exercise these rights, contact us at info@caretowardscure.com or call 9414311475.

## 6. Cookies

We use cookies to improve site functionality and analyze traffic. You can control cookies through your browser settings. Cookies help us remember your preferences and enhance your experience on our Site.

## 7. Children\'s Privacy

Our Site is not directed at children under 18. We do not knowingly collect information from minors without parental consent.

## 8. Data Retention

We retain your personal information for as long as necessary to provide our services and comply with legal obligations. Health information may be retained in accordance with medical record retention laws.

## 9. Changes to This Policy

We may update this Privacy Policy periodically. Changes will be posted on this page with an updated "Last Updated" date. Your continued use of the Site constitutes acceptance of the updated policy.

## 10. Contact Us

If you have questions about this Privacy Policy or wish to exercise your rights, contact us at:

**Care Towards Cure**
2147, Gul Ji Dhabai Ki Gali, Gangauri Bazar
Jaipur-302020
Email: info@caretowardscure.com
Phone: 9414311475

This privacy policy complies with standard healthcare data protection practices. Patients are encouraged to review this policy regularly for any updates.',
		),
		array(
			'post_title'   => 'Terms & Conditions',
			'post_name'    => 'terms-conditions',
			'post_content' => '# Terms & Conditions

**Last Updated: August 11, 2026**

Welcome to Care Towards Cure. By accessing or using our website care-towards-cure.local, you agree to be bound by these Terms & Conditions.

## 1. Use of the Site

This Site provides information about our clinic, services, and doctors, and allows you to book appointments online and access online consultations. The content on this Site is for informational purposes only and does not constitute medical advice, diagnosis, or treatment.

## 2. Medical Disclaimer

The information provided on this Site is not a substitute for professional medical advice. Always seek the advice of a qualified healthcare provider with any questions regarding a medical condition. Never disregard professional medical advice or delay seeking it because of something you read on this Site.

**In case of a medical emergency:**
- Call your local emergency number immediately
- Go to the nearest emergency room
- Do not rely on this website for emergency medical needs

## 3. Appointment Bookings & Online Consultations

- Appointments and online consultations booked through this Site are subject to confirmation by our clinic staff
- We reserve the right to reschedule or cancel appointments due to unforeseen circumstances (doctor unavailability, emergencies, etc.)
- Online consultations are conducted via secure video conferencing
- Please refer to our Refund & Cancellation Policy for details on cancellations and rescheduling
- Patients are responsible for following medical advice provided during consultations

## 4. User Responsibilities

You agree to:
- Provide accurate and complete information when booking appointments or consultations
- Use the Site only for lawful purposes
- Not attempt to gain unauthorized access to any part of the Site
- Not engage in any fraudulent activity
- Respect our intellectual property rights

## 5. Intellectual Property

All content on this Site, including text, graphics, logos, images, and videos, is the property of Care Towards Cure unless otherwise stated, and is protected by applicable intellectual property laws. You may not reproduce, distribute, or transmit any content without our prior written permission.

## 6. Limitation of Liability

To the fullest extent permitted by law, Care Towards Cure shall not be liable for:
- Any indirect, incidental, special, or consequential damages
- Loss of profit, revenue, or data
- Damages arising from your use of this Site
- Reliance on any information provided on this Site
- Medical outcomes resulting from consultations or treatment recommendations

Patients acknowledge that medical outcomes depend on many factors beyond the clinic\'s control.

## 7. Third-Party Links

Our Site may contain links to third-party websites. We are not responsible for the content, accuracy, or privacy practices of these external sites. Please review the privacy and terms of any third-party site before providing personal information.

## 8. Doctor-Patient Relationship

Online consultations through Care Towards Cure establish a doctor-patient relationship. This relationship creates legal and ethical obligations, and consultations are subject to medical confidentiality and data protection laws.

## 9. Governing Law

These Terms shall be governed by and construed in accordance with the laws of India and shall be subject to the exclusive jurisdiction of Indian courts.

## 10. Changes to These Terms

We may revise these Terms at any time. Changes will be effective upon posting to this Site. Continued use of the Site after changes constitutes acceptance of the updated Terms.

## 11. Contact Us

For questions about these Terms & Conditions, contact us at:

**Care Towards Cure**
2147, Gul Ji Dhabai Ki Gali, Gangauri Bazar
Jaipur-302020
Email: info@caretowardscure.com
Phone: 9414311475

By using this Site, you acknowledge that you have read, understood, and agree to be bound by these Terms & Conditions.',
		),
		array(
			'post_title'   => 'Refund & Cancellation Policy',
			'post_name'    => 'refund-cancellation-policy',
			'post_content' => '# Refund & Cancellation Policy

**Last Updated: August 11, 2026**

At Care Towards Cure, we understand that plans can change. This policy outlines our procedures for appointment cancellations, rescheduling, and refunds.

## 1. Appointment Cancellations

- Patients may cancel or reschedule an appointment up to **24 hours before** the scheduled time without any charge.
- Cancellations made **less than 24 hours** before the appointment may be subject to a cancellation fee equivalent to 50% of the consultation fee.
- **No-shows** (failure to attend without prior notice) will be charged the full consultation fee.
- Emergency cancellations may be subject to management discretion and case-by-case review.

## 2. How to Cancel or Reschedule

You can cancel or reschedule your appointment by:
- **Calling us:** 9414311475
- **Emailing us:** info@caretowardscure.com
- **Using our online booking portal:** care-towards-cure.local
- **Visiting our clinic:** 2147, Gul Ji Dhabai Ki Gali, Gangauri Bazar, Jaipur-302020

Please provide your appointment details and reason for cancellation to expedite the process.

## 3. Refunds for Paid Consultations

- If you paid in advance and cancel **within 24 hours of booking**, you will receive a **full refund** (100%).
- If you cancel **24-48 hours before** your appointment, you will receive a **75% refund**.
- If you cancel **less than 24 hours before** your appointment, you will receive a **50% refund**.
- **No-shows** and cancellations made **after** the appointment time are generally **non-refundable**.
- **Exception:** Refunds may be considered in cases of documented medical emergencies, serious illness, or service failure on our part (subject to management discretion).

## 4. Refund Processing

- Approved refunds will be processed within **5-7 business days** and credited back via the original payment method.
- Processing times may vary depending on your bank or payment provider — some banks may take an additional 2-3 business days.
- If you do not see the refund within 7-10 business days, please contact us immediately at info@caretowardscure.com.

## 5. Clinic-Initiated Cancellations

If **we** need to cancel or reschedule your appointment due to:
- Doctor unavailability
- Medical emergencies
- Unforeseen circumstances
- System/technical issues

We will notify you **as soon as possible** and offer:
- A **rescheduled appointment** at your earliest convenience, or
- A **full refund** if a new appointment time does not work for you

In cases of clinic-initiated cancellations, you may also request to be placed on a priority cancellation list for future appointments.

## 6. Online Consultation Refunds

- **Online consultations** follow the same cancellation and refund policy as in-clinic appointments.
- If technical issues prevent the consultation from occurring on our end, a full refund will be issued immediately.
- If the patient is unavailable at the scheduled time, the standard cancellation policy applies.

## 7. Package/Subscription Refunds

- Clinic packages or subscription services are **generally non-refundable** once purchased and any services have commenced.
- Unused portions of a package may be refunded at management discretion if requested within 30 days of purchase.
- Partial refunds for completed services are evaluated on a case-by-case basis.

## 8. Special Circumstances

The following situations may qualify for full or partial refund consideration:
- Documented medical emergency or severe illness preventing attendance
- Death in the family or major personal hardship (with supporting documentation)
- Significant miscommunication regarding appointment time/date
- Service failure or negligence on our part

Please contact us at info@caretowardscure.com or call 9414311475 to discuss your specific situation.

## 9. Dispute Resolution

If you believe a cancellation fee or refund decision was made in error:
1. Contact us within **14 days** of the disputed charge
2. Provide your appointment details, proof of payment, and reason for dispute
3. Our management team will review and respond within **5 business days**
4. If you remain unsatisfied, you may escalate to our clinic director for final review

## 10. Changes to This Policy

We reserve the right to update this Refund & Cancellation Policy at any time. Changes will be effective immediately upon posting to this website, with an updated "Last Updated" date. Continued use of our services after policy changes constitutes acceptance of the updated policy.

## 11. Contact for Refund or Cancellation Requests

**Phone:** 9414311475
**Email:** info@caretowardscure.com
**Address:** 2147, Gul Ji Dhabai Ki Gali, Gangauri Bazar, Jaipur-302020

**Operating Hours:**
- Monday – Friday: 9:00 AM – 6:00 PM
- Saturday: 10:00 AM – 4:00 PM
- Sunday: Closed

For any questions regarding refunds, cancellations, or our policies, please don\'t hesitate to contact us. Your satisfaction and trust are important to us.',
		),
	);

	foreach ( $pages as $page ) {
		// Check if page already exists
		$existing_page = get_page_by_path( $page['post_name'] );

		if ( $existing_page ) {
			// Update existing page with new content
			wp_update_post( array(
				'ID'           => $existing_page->ID,
				'post_content' => $page['post_content'],
			) );
		} else {
			// Create new page
			wp_insert_post( array(
				'post_type'      => 'page',
				'post_title'     => $page['post_title'],
				'post_name'      => $page['post_name'],
				'post_content'   => $page['post_content'],
				'post_status'    => 'publish',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			) );
		}
	}
}

// Create policy pages on theme activation
add_action( 'after_switch_theme', 'care_create_policy_pages' );

// Also run on every admin page load as a fallback (can be removed later once pages are created)
if ( is_admin() ) {
	add_action( 'admin_init', 'care_create_policy_pages' );
}
