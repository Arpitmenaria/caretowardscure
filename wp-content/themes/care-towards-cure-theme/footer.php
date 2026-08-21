<?php
/**
 * The footer template
 *
 * Displays the site footer and closes HTML structure
 *
 * @package Care_Towards_Cure_Theme
 */

defined( 'ABSPATH' ) || exit;
?>

	<footer class="site-footer" role="contentinfo">
		<div class="container">
			<!-- Footer Content -->
			<div class="footer-content">
				<!-- Branding & Tagline -->
				<div class="footer-branding">
					<h2 class="footer-logo-name"><?php esc_html_e( 'Care Towards Cure', 'care-towards-cure' ); ?></h2>
					<p class="footer-tagline">
						<?php esc_html_e( 'Personalised healthcare consultation with a patient-first approach.', 'care-towards-cure' ); ?>
					</p>
				</div>

				<!-- Policies -->
				<div class="footer-links-section">
					<h3 class="footer-section-title"><?php esc_html_e( 'Policies', 'care-towards-cure' ); ?></h3>
					<ul class="footer-links-list">
						<li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'privacy-policy' ) ) ); ?>"><?php esc_html_e( 'Privacy Policy', 'care-towards-cure' ); ?></a></li>
						<li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'terms-conditions' ) ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'care-towards-cure' ); ?></a></li>
						<li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'refund-cancellation-policy' ) ) ); ?>"><?php esc_html_e( 'Refund & Cancellation Policy', 'care-towards-cure' ); ?></a></li>
					</ul>
				</div>

				<!-- Contact Details -->
				<div class="footer-contact">
					<h3><?php esc_html_e( 'Contact Info', 'care-towards-cure' ); ?></h3>
					<?php
					$footer_phone = get_theme_mod( 'care_footer_phone', '9414311475' );
					$footer_email = get_theme_mod( 'care_footer_email', 'enquiry@caretowardscure.com' );
					$footer_address = get_theme_mod( 'care_footer_address', '2147, Gul Ji Dhabai Ki Gali, Gangauri Bazar, Jaipur-302020' );
					?>

					<?php if ( $footer_phone ) : ?>
						<div class="contact-item">
							<span class="contact-item-icon">📞</span>
							<div class="contact-item-text">
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $footer_phone ) ); ?>">
									<?php echo esc_html( $footer_phone ); ?>
								</a>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $footer_email ) : ?>
						<div class="contact-item">
							<span class="contact-item-icon">✉️</span>
							<div class="contact-item-text">
								<a href="mailto:<?php echo esc_attr( $footer_email ); ?>">
									<?php echo esc_html( $footer_email ); ?>
								</a>
							</div>
						</div>
					<?php endif; ?>

					<?php if ( $footer_address ) : ?>
						<div class="contact-item">
							<span class="contact-item-icon">📍</span>
							<div class="contact-item-text">
								<a href="https://maps.app.goo.gl/5tx4B5ngJrVzMGRW8" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none;">
									<?php echo esc_html( $footer_address ); ?>
								</a>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<!-- Footer Bottom -->
			<div class="footer-bottom">
				<p class="footer-copyright">
					<?php
					printf(
						/* translators: %d = year, %s = site name */
						esc_html__( '© %d %s. All Rights Reserved.', 'care-towards-cure' ),
						(int) gmdate( 'Y' ),
						esc_html( get_bloginfo( 'name' ) )
					);
					?>
				</p>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

	<!-- ===== APPOINTMENT MODAL ===== -->
	<div id="appointmentModal" class="modal-overlay" role="dialog" aria-labelledby="appointmentModalTitle">
		<div class="modal-dialog">
			<div class="modal-header">
				<h2 class="modal-title" id="appointmentModalTitle"><?php esc_html_e( 'Book Your Appointment', 'care-towards-cure' ); ?></h2>
				<button class="modal-close" aria-label="<?php esc_attr_e( 'Close', 'care-towards-cure' ); ?>">×</button>
			</div>
			<div class="modal-body">
				<form id="appointmentForm" method="POST" novalidate>
					<div class="form-field">
						<label class="form-label" for="patient_name"><?php esc_html_e( 'Full Name', 'care-towards-cure' ); ?> <span style="color: #e74c3c;">*</span></label>
						<input class="form-input" type="text" id="patient_name" name="patient_name" required placeholder="<?php esc_attr_e( 'Enter your full name', 'care-towards-cure' ); ?>">
					</div>

					<div class="form-field">
						<label class="form-label" for="phone"><?php esc_html_e( 'Phone Number', 'care-towards-cure' ); ?> <span style="color: #e74c3c;">*</span></label>
						<input class="form-input" type="tel" id="phone" name="phone" required placeholder="<?php esc_attr_e( 'Enter your phone number', 'care-towards-cure' ); ?>">
					</div>

					<div class="form-field">
						<label class="form-label" for="email"><?php esc_html_e( 'Email Address', 'care-towards-cure' ); ?></label>
						<input class="form-input" type="email" id="email" name="email" placeholder="<?php esc_attr_e( 'Enter your email (optional)', 'care-towards-cure' ); ?>">
					</div>

					<div class="form-row two-col">
						<div class="form-field">
							<label class="form-label" for="appointment_date"><?php esc_html_e( 'Preferred Date', 'care-towards-cure' ); ?></label>
							<input class="form-input date-input" type="date" id="appointment_date" name="appointment_date">
						</div>
						<div class="form-field">
							<label class="form-label" for="appointment_time"><?php esc_html_e( 'Preferred Time', 'care-towards-cure' ); ?></label>
							<input class="form-input time-input" type="time" id="appointment_time" name="appointment_time">
						</div>
					</div>

					<div class="form-field">
						<label class="form-label" for="reason"><?php esc_html_e( 'Reason for Consultation', 'care-towards-cure' ); ?></label>
						<textarea class="form-textarea" id="reason" name="reason" placeholder="<?php esc_attr_e( 'Briefly describe your health concern', 'care-towards-cure' ); ?>"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-btn modal-btn-cancel"><?php esc_html_e( 'Cancel', 'care-towards-cure' ); ?></button>
				<button type="button" class="modal-btn modal-btn-reset"><?php esc_html_e( 'Reset', 'care-towards-cure' ); ?></button>
				<button type="submit" form="appointmentForm" class="modal-btn modal-btn-submit"><?php esc_html_e( 'Submit Inquiry', 'care-towards-cure' ); ?></button>
			</div>
		</div>
	</div>

	<!-- ===== SUCCESS MODAL ===== -->
	<div id="successModal" class="modal-overlay" role="dialog" aria-labelledby="successModalTitle">
		<div class="modal-dialog">
			<div class="modal-header">
				<h2 class="modal-title" id="successModalTitle"><?php esc_html_e( 'Thank You!', 'care-towards-cure' ); ?></h2>
			</div>
			<div class="modal-body modal-success-body">
				<div class="success-icon">✓</div>
				<h3 class="success-title"><?php esc_html_e( 'Inquiry Submitted Successfully', 'care-towards-cure' ); ?></h3>
				<p class="success-message"><?php esc_html_e( 'Your appointment inquiry has been submitted successfully. We will contact you soon to confirm your appointment details.', 'care-towards-cure' ); ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="modal-btn modal-btn-close-success" data-close-success="successModal"><?php esc_html_e( 'Done', 'care-towards-cure' ); ?></button>
			</div>
		</div>
	</div>

</body>
</html>
