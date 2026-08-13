<?php
/**
 * The header template
 *
 * Displays the site header, navigation, and begins HTML structure
 *
 * @package Care_Towards_Cure_Theme
 */

defined( 'ABSPATH' ) || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<header class="site-header" role="banner">
		<div class="navbar-container">
			<!-- Site Logo -->
			<div class="site-branding">
				<?php
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$site_title     = get_bloginfo( 'name' );
				$site_url       = home_url( '/' );

				if ( $custom_logo_id ) {
					$logo_html = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
						'class' => 'site-logo-img',
						'alt'   => esc_attr( $site_title ),
					) );
					echo '<a href="' . esc_url( $site_url ) . '" class="site-logo" title="' . esc_attr( $site_title ) . '">' . wp_kses_post( $logo_html ) . '</a>';
				} else {
					echo '<a href="' . esc_url( $site_url ) . '" class="site-logo site-logo-text">';
					echo '<span class="site-title">' . esc_html( $site_title ) . '</span>';
					echo '</a>';
				}
				?>
			</div>

			<!-- Center Navigation Menu -->
			<nav class="main-navigation" id="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'care-towards-cure' ); ?>">
				<ul class="menu navbar-menu">
					<li><a href="<?php echo esc_url( home_url( '/#about' ) ); ?>" class="navbar-link" data-scroll-target="about"><?php esc_html_e( 'About', 'care-towards-cure' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="navbar-link" data-scroll-target="services"><?php esc_html_e( 'Services', 'care-towards-cure' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#doctors' ) ); ?>" class="navbar-link" data-scroll-target="doctors"><?php esc_html_e( 'Doctors', 'care-towards-cure' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="navbar-link" data-scroll-target="contact"><?php esc_html_e( 'Contact', 'care-towards-cure' ); ?></a></li>
				</ul>
			</nav>

			<!-- Mobile Menu Toggle -->
			<button
				class="mobile-menu-toggle"
				id="mobile-menu-toggle"
				aria-label="<?php esc_attr_e( 'Toggle Navigation Menu', 'care-towards-cure' ); ?>"
				aria-expanded="false"
				aria-controls="main-navigation"
			>
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</button>
		</div>
	</header>
