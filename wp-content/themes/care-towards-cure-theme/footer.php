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
					<!-- Social Media Icons -->
					<div class="footer-social-media">
						<?php
						$facebook_url = get_theme_mod( 'care_facebook_url', 'https://www.facebook.com/share/1C77R1zW6E/?mibextid=wwXIfr' );
						$instagram_url = get_theme_mod( 'care_instagram_url', 'https://www.instagram.com/care_towards_cure?stkn=djByem5oMDgydTdj' );
						$whatsapp_url = get_theme_mod( 'care_whatsapp_url', 'https://wa.me/919414311475' );
						$youtube_url = get_theme_mod( 'care_youtube_url', 'https://youtube.com/@ctchomoeo' );
						?>

						<?php if ( $facebook_url ) : ?>
							<a href="<?php echo esc_url( $facebook_url ); ?>" class="social-icon facebook" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'Facebook', 'care-towards-cure' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
									<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
								</svg>
							</a>
						<?php endif; ?>

						<?php if ( $instagram_url ) : ?>
							<a href="<?php echo esc_url( $instagram_url ); ?>" class="social-icon instagram" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'Instagram', 'care-towards-cure' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
									<path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.117.6c-.628.24-1.159.547-1.688 1.078-.53.529-.84 1.06-1.079 1.688-.27.708-.471 1.578-.53 2.856C.032 8.333.016 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.53 2.856.24.628.549 1.159 1.078 1.688.53.529 1.06.84 1.688 1.078.708.269 1.577.47 2.856.53 1.28.058 1.687.072 4.947.072s3.667-.015 4.947-.072c1.277-.06 2.148-.261 2.856-.53.628-.24 1.159-.549 1.688-1.078.53-.529.84-1.06 1.078-1.688.269-.708.47-1.577.53-2.856.058-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.261-2.148-.53-2.856-.24-.628-.549-1.159-1.078-1.688-.529-.53-1.06-.84-1.688-1.078-.708-.27-1.577-.471-2.856-.53C15.667.048 15.26.032 12 0zm0 2.16c3.203 0 3.585.009 4.849.070 1.171.054 1.805.244 2.227.414.562.217.96.477 1.382.896.419.42.679.819.896 1.381.17.422.36 1.057.413 2.227.061 1.264.07 1.645.07 4.849 0 3.203-.009 3.585-.07 4.849-.054 1.171-.244 1.805-.414 2.227-.217.562-.477.96-.896 1.382-.42.419-.819.679-1.381.896-.422.17-1.057.36-2.227.413-1.264.061-1.645.07-4.849.07-3.203 0-3.585-.009-4.849-.07-1.171-.054-1.805-.244-2.227-.414-.562-.217-.96-.477-1.382-.896-.419-.42-.679-.819-.896-1.381-.17-.422-.36-1.057-.413-2.227-.061-1.264-.07-1.645-.07-4.849 0-3.203.009-3.585.07-4.849.054-1.171.244-1.805.414-2.227.217-.562.477-.96.896-1.382.42-.419.819-.679 1.381-.896.422-.17 1.057-.36 2.227-.413 1.264-.061 1.645-.07 4.849-.07zM5.838 12a6.162 6.162 0 1 1 12.324 0 6.162 6.162 0 0 1-12.324 0zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm4.965-10.322a1.44 1.44 0 1 1 2.881.001 1.44 1.44 0 0 1-2.881-.001z"/>
								</svg>
							</a>
						<?php endif; ?>

						<?php if ( $whatsapp_url ) : ?>
							<a href="<?php echo esc_url( $whatsapp_url ); ?>" class="social-icon whatsapp" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'WhatsApp', 'care-towards-cure' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
									<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-4.946 1.23l-.356.214-3.71-.974.992 3.63-.235.374a9.86 9.86 0 001.33 4.815l.166.331 3.84.822-.25 1.53c.27.19.747.48 1.29.792.27.149.546.28.816.28.533 0 1.083-.222 1.45-.64l1.46-1.646c.33.178.738.408 1.168.612l.427.201c4.206 1.984 8.35-1.175 8.35-1.175l-4.705-1.22.473-.783c1.023-1.692 1.603-3.682 1.603-5.81 0-6.437-5.23-11.66-11.667-11.66"/>
								</svg>
							</a>
						<?php endif; ?>

						<?php if ( $youtube_url ) : ?>
							<a href="<?php echo esc_url( $youtube_url ); ?>" class="social-icon youtube" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'YouTube', 'care-towards-cure' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
									<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
								</svg>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<!-- Policies -->
				<div class="footer-links-section">
					<h3 class="footer-section-title"><?php esc_html_e( 'Policies', 'care-towards-cure' ); ?></h3>
					<ul class="footer-links-list">
						<?php
						$policy_pages = array(
							array( 'slug' => 'terms-conditions', 'label' => 'Terms & Conditions' ),
						);

						foreach ( $policy_pages as $policy ) {
							$page = get_page_by_path( $policy['slug'] );
							if ( $page && $page->ID && ! is_admin() ) {
								$url = get_permalink( $page->ID );
								if ( $url && strpos( $url, 'wp-admin' ) === false ) {
									echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $policy['label'] ) . '</a></li>';
								}
							}
						}
						?>
					</ul>
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
						<input class="form-input" type="tel" id="phone" name="phone" required maxlength="10" pattern="[0-9]{10}" inputmode="numeric" placeholder="<?php esc_attr_e( '10 digit mobile number', 'care-towards-cure' ); ?>">
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
							<select class="form-input time-input" id="appointment_time" name="appointment_time" required>
								<option value=""><?php esc_html_e( 'Select time slot', 'care-towards-cure' ); ?></option>
								<optgroup label="<?php esc_attr_e( 'Morning (10:00 AM - 2:00 PM)', 'care-towards-cure' ); ?>">
									<option value="10:00">10:00 AM</option>
									<option value="10:30">10:30 AM</option>
									<option value="11:00">11:00 AM</option>
									<option value="11:30">11:30 AM</option>
									<option value="12:00">12:00 PM</option>
									<option value="12:30">12:30 PM</option>
									<option value="13:00">1:00 PM</option>
									<option value="13:30">1:30 PM</option>
								</optgroup>
								<optgroup label="<?php esc_attr_e( 'Evening (5:30 PM - 9:00 PM)', 'care-towards-cure' ); ?>">
									<option value="17:30">5:30 PM</option>
									<option value="18:00">6:00 PM</option>
									<option value="18:30">6:30 PM</option>
									<option value="19:00">7:00 PM</option>
									<option value="19:30">7:30 PM</option>
									<option value="20:00">8:00 PM</option>
									<option value="20:30">8:30 PM</option>
								</optgroup>
							</select>
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
