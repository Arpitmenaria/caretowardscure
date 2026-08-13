<?php
/**
 * The 404 template
 *
 * Displays when a page or post is not found
 *
 * @package Care_Towards_Cure_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="main-content">
		<div class="container">
			<div style="padding: 100px 0; text-align: center;">
				<div style="max-width: 600px; margin: 0 auto;">
					<h1 style="font-size: 4rem; margin-bottom: 1rem; color: var(--primary-color);">404</h1>
					<h2><?php esc_html_e( 'Page Not Found', 'care-towards-cure' ); ?></h2>
					<p style="font-size: 1.125rem; margin: 2rem 0; color: var(--light-text);">
						<?php esc_html_e( 'The page you are looking for could not be found. It might have been moved or deleted.', 'care-towards-cure' ); ?>
					</p>

					<div style="margin: 2rem 0;">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary btn-lg"><?php esc_html_e( 'Go to Home Page', 'care-towards-cure' ); ?></a>
						<a href="javascript:history.back()" class="btn btn-outline btn-lg" style="margin-left: 1rem;"><?php esc_html_e( 'Go Back', 'care-towards-cure' ); ?></a>
					</div>

					<div style="margin-top: 3rem;">
						<h3><?php esc_html_e( 'Quick Links', 'care-towards-cure' ); ?></h3>
						<ul style="list-style: none; padding: 0; margin: 1rem 0;">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#about" style="color: var(--primary-color);"><?php esc_html_e( 'About Us', 'care-towards-cure' ); ?></a></li>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>#contact" style="color: var(--primary-color);"><?php esc_html_e( 'Contact Us', 'care-towards-cure' ); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</main>

<?php
get_footer();
