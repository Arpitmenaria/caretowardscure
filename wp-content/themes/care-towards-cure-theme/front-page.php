<?php
/**
 * The front page template
 *
 * Displays the clinic landing page
 *
 * @package Care_Towards_Cure_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="main-content">
		<!-- ===== HERO SECTION ===== -->
		<?php
		$hero_image = get_theme_mod( 'care_hero_image_1' );
		$hero_style = $hero_image ? ' style="background-image: url(' . esc_url( $hero_image ) . '); background-size: cover; background-position: center;"' : '';

		// Get customizer values (these can be edited by client in admin)
		$hero_badge = get_theme_mod( 'care_hero_badge', __( 'TRUSTED HEALTHCARE PROVIDER', 'care-towards-cure' ) );
		$hero_title = get_theme_mod( 'care_hero_title', __( 'Your Health Deserves Personalised Care.', 'care-towards-cure' ) );
		$hero_subtitle = get_theme_mod( 'care_hero_subtitle', __( 'Professional healthcare consultation designed around you — with convenient online access from wherever you are.', 'care-towards-cure' ) );
		$hero_btn1_text = get_theme_mod( 'care_hero_btn1_text', __( 'Book an Appointment', 'care-towards-cure' ) );
		$hero_btn2_text = get_theme_mod( 'care_hero_btn2_text', __( 'Inquire Now', 'care-towards-cure' ) );
		?>
		<section class="hero-section" role="region" aria-label="<?php esc_attr_e( 'Hero Section', 'care-towards-cure' ); ?>" data-reveal<?php echo $hero_style; // phpcs:ignore WordPress.Security.EscapedOutput ?>>
			<div class="container">
				<div class="hero-content">
					<?php if ( ! empty( $hero_badge ) ) : ?>
						<div class="hero-badge"><?php echo esc_html( $hero_badge ); ?></div>
					<?php endif; ?>
					<h1 class="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
					<p class="hero-description">
						<?php echo esc_html( $hero_subtitle ); ?>
					</p>
					<div class="hero-buttons">
						<button type="button" class="btn btn-primary" data-open-modal="appointmentModal">
							<?php echo esc_html( $hero_btn1_text ); ?>
						</button>
						<a href="#contact" class="btn btn-secondary">
							<?php echo esc_html( $hero_btn2_text ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== WELCOME SECTION ===== -->
		<?php
		$welcome_title = get_theme_mod( 'care_welcome_title', __( 'Welcome to Care Towards Cure', 'care-towards-cure' ) );
		$welcome_para_1 = get_theme_mod( 'care_welcome_para_1', __( 'At Care Towards Cure, we believe that healthcare should be personal, accessible and focused on the individual — not just the symptoms.', 'care-towards-cure' ) );
		$welcome_para_2 = get_theme_mod( 'care_welcome_para_2', __( 'We provide personalised consultations and treatment guidance with an emphasis on understanding each patient\'s health concerns, medical history, lifestyle and individual needs.', 'care-towards-cure' ) );
		$welcome_para_3 = get_theme_mod( 'care_welcome_para_3', __( 'Whether you are looking for guidance for a new health concern or continuing care for an existing condition, our goal is to make quality healthcare more accessible and convenient.', 'care-towards-cure' ) );
		$welcome_image_id = get_theme_mod( 'care_welcome_image' );
		$welcome_image_url = $welcome_image_id ? wp_get_attachment_url( $welcome_image_id ) : get_template_directory_uri() . '/images/placeholder-welcome.svg';
		?>
		<section class="welcome-section" id="welcome" data-reveal>
			<div class="container">
				<div class="welcome-wrapper">
					<div class="welcome-content">
						<h2><?php echo esc_html( $welcome_title ); ?></h2>
						<p><?php echo esc_html( $welcome_para_1 ); ?></p>
						<p><?php echo esc_html( $welcome_para_2 ); ?></p>
						<p><?php echo esc_html( $welcome_para_3 ); ?></p>
						<div class="welcome-buttons">
							<button type="button" class="btn btn-primary" data-open-modal="appointmentModal">
								<?php echo esc_html( $hero_btn1_text ); ?>
							</button>
							<a href="#contact" class="btn btn-secondary">
								<?php echo esc_html( $hero_btn2_text ); ?>
							</a>
						</div>
					</div>
					<div class="welcome-image">
						<img src="<?php echo esc_url( $welcome_image_url ); ?>" alt="<?php esc_attr_e( 'Welcome Section', 'care-towards-cure' ); ?>" class="welcome-img">
					</div>
				</div>
			</div>
		</section>

		<!-- ===== CLINIC GALLERY SECTION ===== -->
		<section class="gallery-section" id="gallery" data-reveal>
			<div class="container">
				<div class="gallery-header">
					<h2><?php esc_html_e( 'OUR CLINIC', 'care-towards-cure' ); ?></h2>
					<p class="gallery-subtitle"><?php esc_html_e( 'A Look Inside Care Towards Cure', 'care-towards-cure' ); ?></p>
				</div>

				<?php
				// Get all gallery images from the Gallery CPT
				$gallery_query = new WP_Query( array(
					'post_type'      => 'care_gallery',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order date',
					'order'          => 'ASC',
				) );
				?>

				<?php if ( $gallery_query->have_posts() ) : ?>
					<div class="gallery-grid" data-reveal-group>
						<?php
						while ( $gallery_query->have_posts() ) {
							$gallery_query->the_post();
							if ( has_post_thumbnail() ) {
								?>
								<div class="gallery-item">
									<div class="gallery-image-wrapper">
										<?php the_post_thumbnail( 'care-card' ); ?>
									</div>
								</div>
								<?php
							}
						}
						wp_reset_postdata();
						?>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<!-- ===== HEALTHCARE THAT LISTENS SECTION ===== -->
		<section class="listens-section" data-reveal>
			<div class="container">
				<div class="listens-content">
					<h2><?php esc_html_e( 'Healthcare That Listens', 'care-towards-cure' ); ?></h2>
					<p class="listens-description">
						<?php esc_html_e( 'At Care Towards Cure, we take the time to understand your concerns, medical history and individual needs before providing personalised treatment guidance.', 'care-towards-cure' ); ?>
					</p>
					<div class="listens-approach">
						<div class="approach-step">
							<span class="step-number">1</span>
							<h3><?php esc_html_e( 'Listen', 'care-towards-cure' ); ?></h3>
						</div>
						<div class="approach-arrow">→</div>
						<div class="approach-step">
							<span class="step-number">2</span>
							<h3><?php esc_html_e( 'Understand', 'care-towards-cure' ); ?></h3>
						</div>
						<div class="approach-arrow">→</div>
						<div class="approach-step">
							<span class="step-number">3</span>
							<h3><?php esc_html_e( 'Treat', 'care-towards-cure' ); ?></h3>
						</div>
						<div class="approach-arrow">→</div>
						<div class="approach-step">
							<span class="step-number">4</span>
							<h3><?php esc_html_e( 'Follow Up', 'care-towards-cure' ); ?></h3>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== OUR APPROACH SECTION ===== -->
		<section class="approach-section" id="approach" data-reveal>
			<div class="container">
				<h2><?php esc_html_e( 'Our Approach', 'care-towards-cure' ); ?></h2>
				<p class="approach-intro">
					<?php esc_html_e( 'Listen. Understand. Treat. Follow Up.', 'care-towards-cure' ); ?>
				</p>
				<p class="approach-intro-secondary">
					<?php esc_html_e( 'Every patient is different, and healthcare should not follow a one-size-fits-all approach. At Care Towards Cure, we take time to understand your concerns before recommending a treatment approach. Our consultation process focuses on:', 'care-towards-cure' ); ?>
				</p>
				<div class="approach-steps" data-reveal-group>
					<div class="step">
						<h3><?php esc_html_e( 'Understanding your symptoms and concerns', 'care-towards-cure' ); ?></h3>
					</div>
					<div class="step">
						<h3><?php esc_html_e( 'Reviewing your relevant medical history', 'care-towards-cure' ); ?></h3>
					</div>
					<div class="step">
						<h3><?php esc_html_e( 'Assessing your individual needs', 'care-towards-cure' ); ?></h3>
					</div>
					<div class="step">
						<h3><?php esc_html_e( 'Providing personalised treatment guidance', 'care-towards-cure' ); ?></h3>
					</div>
					<div class="step">
						<h3><?php esc_html_e( 'Explaining the recommended treatment clearly', 'care-towards-cure' ); ?></h3>
					</div>
					<div class="step">
						<h3><?php esc_html_e( 'Following up on your progress when required', 'care-towards-cure' ); ?></h3>
					</div>
				</div>
				<p class="approach-conclusion">
					<?php esc_html_e( 'Our aim is to create a healthcare experience where patients feel heard, informed and supported.', 'care-towards-cure' ); ?>
				</p>
			</div>
		</section>

		<!-- ===== ONLINE CONSULTATION SECTION ===== -->
		<section class="consultation-section" id="consultation" data-reveal>
			<div class="container">
				<h2><?php esc_html_e( 'Online Consultation', 'care-towards-cure' ); ?></h2>
				<h3 class="consultation-tagline"><?php esc_html_e( 'Healthcare, Wherever You Are', 'care-towards-cure' ); ?></h3>
				<p class="consultation-intro">
					<?php esc_html_e( 'You don\'t always need to travel to a clinic for every consultation. Care Towards Cure offers online consultation facilities that allow you to connect with the doctor remotely from the comfort of your home.', 'care-towards-cure' ); ?>
				</p>
				<h3 class="consultation-process-title"><?php esc_html_e( 'How It Works', 'care-towards-cure' ); ?></h3>
				<div class="consultation-steps" data-reveal-group>
					<div class="consultation-step">
						<div class="step-number">1</div>
						<h4><?php esc_html_e( 'Book Your Appointment', 'care-towards-cure' ); ?></h4>
						<p><?php esc_html_e( 'Choose a suitable consultation option and submit your appointment request.', 'care-towards-cure' ); ?></p>
					</div>
					<div class="consultation-step">
						<div class="step-number">2</div>
						<h4><?php esc_html_e( 'Share Your Details', 'care-towards-cure' ); ?></h4>
						<p><?php esc_html_e( 'Provide your basic information and relevant medical documents or previous reports, if required.', 'care-towards-cure' ); ?></p>
					</div>
					<div class="consultation-step">
						<div class="step-number">3</div>
						<h4><?php esc_html_e( 'Consult the Doctor', 'care-towards-cure' ); ?></h4>
						<p><?php esc_html_e( 'Attend your scheduled online consultation through the provided video consultation link.', 'care-towards-cure' ); ?></p>
					</div>
					<div class="consultation-step">
						<div class="step-number">4</div>
						<h4><?php esc_html_e( 'Receive Treatment Guidance', 'care-towards-cure' ); ?></h4>
						<p><?php esc_html_e( 'After understanding your condition, the doctor will provide appropriate medical guidance and treatment recommendations.', 'care-towards-cure' ); ?></p>
					</div>
					<div class="consultation-step">
						<div class="step-number">5</div>
						<h4><?php esc_html_e( 'Follow Up', 'care-towards-cure' ); ?></h4>
						<p><?php esc_html_e( 'Continue your care through scheduled follow-ups whenever required.', 'care-towards-cure' ); ?></p>
					</div>
				</div>
				<div class="consultation-button">
					<button type="button" class="btn btn-primary btn-lg" data-open-modal="consultationModal">
						<?php esc_html_e( 'Inquire Now', 'care-towards-cure' ); ?>
					</button>
				</div>
			</div>
		</section>

		<!-- ===== ABOUT OUR DOCTORS SECTION ===== -->
		<section class="doctors-section" id="doctors" data-reveal>
			<div class="container">
				<div class="doctors-header">
					<h2><?php esc_html_e( 'ABOUT OUR DOCTORS', 'care-towards-cure' ); ?></h2>
					<h3 class="doctors-subtitle"><?php esc_html_e( 'Meet Our Doctors', 'care-towards-cure' ); ?></h3>
					<p class="doctors-tagline">
						<?php esc_html_e( 'Experienced Care. Personal Attention. A Shared Commitment to Better Health.', 'care-towards-cure' ); ?>
					</p>
					<p class="doctors-intro">
						<?php esc_html_e( 'At Care Towards Cure, our approach to healthcare is built around listening carefully, understanding each patient\'s concerns and providing personalised care.', 'care-towards-cure' ); ?>
					</p>
					<p class="doctors-intro">
						<?php esc_html_e( 'Our consultations are led by Dr. M.K. Saini and Dr. Jyoti Jain, who are committed to creating a comfortable and patient-focused healthcare experience.', 'care-towards-cure' ); ?>
					</p>
				</div>

				<?php
				// Get all doctors from the Doctor CPT
				$doctors_query = new WP_Query( array(
					'post_type'      => 'care_doctor',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				) );
				?>
				<div class="doctors-grid" data-reveal-group>
					<?php
					if ( $doctors_query->have_posts() ) {
						while ( $doctors_query->have_posts() ) {
							$doctors_query->the_post();
							$doctor_id = get_the_ID();
							$designation = get_post_meta( $doctor_id, 'doctor_designation', true );
							$excerpt = get_the_excerpt();
							?>
							<div class="doctor-card">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="doctor-image">
										<?php the_post_thumbnail( 'care-card' ); ?>
									</div>
								<?php endif; ?>
								<div class="doctor-content">
									<h3 class="doctor-name"><?php the_title(); ?></h3>
									<?php if ( $designation ) : ?>
										<p class="doctor-designation"><?php echo esc_html( $designation ); ?></p>
									<?php endif; ?>
									<?php if ( $excerpt ) : ?>
										<p class="doctor-bio"><?php echo wp_kses_post( $excerpt ); ?></p>
										<?php if ( strlen( wp_strip_all_tags( get_the_content() ) ) > 150 ) : ?>
											<button class="doctor-show-more-btn" type="button"><?php esc_html_e( 'Show More', 'care-towards-cure' ); ?></button>
										<?php endif; ?>
									<?php endif; ?>
									<div class="doctor-actions">
										<a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php esc_html_e( 'View Profile', 'care-towards-cure' ); ?></a>
									</div>
								</div>
							</div>
							<?php
						}
						wp_reset_postdata();
					}
					?>
				</div>

				<div class="doctors-footer">
					<h3><?php esc_html_e( 'Two Doctors. One Commitment to Patient Care.', 'care-towards-cure' ); ?></h3>
					<p>
						<?php esc_html_e( 'At Care Towards Cure, we believe that healthcare is not simply about treating a condition. It is about understanding the person, listening to their concerns and supporting them throughout their healthcare journey.', 'care-towards-cure' ); ?>
					</p>
					<p>
						<?php esc_html_e( 'Dr. M.K. Saini and Dr. Jyoti Jain share this patient-first approach and work towards making healthcare more accessible, personal and convenient for every patient.', 'care-towards-cure' ); ?>
					</p>
					<button type="button" class="btn btn-primary btn-lg" data-open-modal="appointmentModal">
						<?php esc_html_e( 'Book an Appointment', 'care-towards-cure' ); ?>
					</button>
				</div>
			</div>
		</section>

		<!-- ===== ABOUT CARE TOWARDS CURE SECTION ===== -->
		<section class="about-section" id="about" data-reveal>
			<div class="container">
				<!-- 1. WELCOME TO CARE TOWARDS CURE -->
				<div class="about-header">
					<h2><?php esc_html_e( 'WELCOME TO CARE TOWARDS CURE', 'care-towards-cure' ); ?></h2>
					<h3 class="about-subtitle"><?php esc_html_e( 'Personalised Healthcare With a Patient-First Approach', 'care-towards-cure' ); ?></h3>
				</div>

				<div class="about-content">
					<p class="about-intro">
						<?php esc_html_e( 'Care Towards Cure was created with a simple vision — to make healthcare more personal, accessible and convenient.', 'care-towards-cure' ); ?>
					</p>
					<p class="about-intro">
						<?php esc_html_e( 'We understand that visiting a healthcare facility can sometimes be difficult because of distance, time constraints or other responsibilities.', 'care-towards-cure' ); ?>
					</p>
					<p class="about-intro">
						<?php esc_html_e( 'Our online consultation service is designed to make it easier for patients to connect with a doctor without unnecessary travel.', 'care-towards-cure' ); ?>
					</p>
					<p class="about-intro">
						<?php esc_html_e( 'We combine professional consultation with a patient-focused approach to create a comfortable healthcare experience.', 'care-towards-cure' ); ?>
					</p>
				</div>

				<!-- 2. OUR APPROACH -->
				<div class="about-approach" style="margin-top: 60px; padding-top: 40px; border-top: 1px solid #e0e0e0;">
					<h3 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 30px; text-align: center;"><?php esc_html_e( 'OUR APPROACH', 'care-towards-cure' ); ?></h3>
					<p style="text-align: center; font-size: 1.1rem; color: #666; margin-bottom: 40px;">
						<?php esc_html_e( 'Listen. Understand. Treat. Follow Up.', 'care-towards-cure' ); ?>
					</p>
					<p style="text-align: center; color: #555; line-height: 1.8; margin-bottom: 40px; max-width: 800px; margin-left: auto; margin-right: auto;">
						<?php esc_html_e( 'Every patient is different, and healthcare should not follow a one-size-fits-all approach. At Care Towards Cure, we take time to understand your concerns before recommending a treatment approach. Our consultation process focuses on:', 'care-towards-cure' ); ?>
					</p>
					<div class="approach-steps" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-bottom: 40px;">
						<div class="step" style="padding: 20px; background: #f8f9fa; border-radius: 8px;">
							<h4 style="color: #1a1a1a; font-weight: 600; margin-bottom: 10px;"><?php esc_html_e( 'Understanding your symptoms and concerns', 'care-towards-cure' ); ?></h4>
						</div>
						<div class="step" style="padding: 20px; background: #f8f9fa; border-radius: 8px;">
							<h4 style="color: #1a1a1a; font-weight: 600; margin-bottom: 10px;"><?php esc_html_e( 'Reviewing your relevant medical history', 'care-towards-cure' ); ?></h4>
						</div>
						<div class="step" style="padding: 20px; background: #f8f9fa; border-radius: 8px;">
							<h4 style="color: #1a1a1a; font-weight: 600; margin-bottom: 10px;"><?php esc_html_e( 'Assessing your individual needs', 'care-towards-cure' ); ?></h4>
						</div>
						<div class="step" style="padding: 20px; background: #f8f9fa; border-radius: 8px;">
							<h4 style="color: #1a1a1a; font-weight: 600; margin-bottom: 10px;"><?php esc_html_e( 'Providing personalised treatment guidance', 'care-towards-cure' ); ?></h4>
						</div>
						<div class="step" style="padding: 20px; background: #f8f9fa; border-radius: 8px;">
							<h4 style="color: #1a1a1a; font-weight: 600; margin-bottom: 10px;"><?php esc_html_e( 'Explaining the recommended treatment clearly', 'care-towards-cure' ); ?></h4>
						</div>
						<div class="step" style="padding: 20px; background: #f8f9fa; border-radius: 8px;">
							<h4 style="color: #1a1a1a; font-weight: 600; margin-bottom: 10px;"><?php esc_html_e( 'Following up on your progress when required', 'care-towards-cure' ); ?></h4>
						</div>
					</div>
					<p style="text-align: center; color: #555; line-height: 1.8; font-size: 1.05rem;">
						<?php esc_html_e( 'Our aim is to create a healthcare experience where patients feel heard, informed and supported.', 'care-towards-cure' ); ?>
					</p>
				</div>

				<!-- 3. OUR VALUES -->
				<div class="about-values" style="margin-top: 60px; padding-top: 40px; border-top: 1px solid #e0e0e0;">
					<h3 class="values-title" style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 40px; text-align: center;"><?php esc_html_e( 'OUR VALUES', 'care-towards-cure' ); ?></h3>

					<div class="values-grid">
						<div class="value-card">
							<div class="value-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
								</svg>
							</div>
							<h4 class="value-name"><?php esc_html_e( 'Patient First', 'care-towards-cure' ); ?></h4>
							<p class="value-description">
								<?php esc_html_e( 'We put the patient\'s concerns and wellbeing at the centre of every consultation.', 'care-towards-cure' ); ?>
							</p>
						</div>

						<div class="value-card">
							<div class="value-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path>
									<path d="M12 6c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4z"></path>
								</svg>
							</div>
							<h4 class="value-name"><?php esc_html_e( 'Personalised Care', 'care-towards-cure' ); ?></h4>
							<p class="value-description">
								<?php esc_html_e( 'We understand that every individual is different and requires an individual approach.', 'care-towards-cure' ); ?>
							</p>
						</div>

						<div class="value-card">
							<div class="value-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
								</svg>
							</div>
							<h4 class="value-name"><?php esc_html_e( 'Clear Communication', 'care-towards-cure' ); ?></h4>
							<p class="value-description">
								<?php esc_html_e( 'We believe patients should understand their health concerns and treatment recommendations.', 'care-towards-cure' ); ?>
							</p>
						</div>

						<div class="value-card">
							<div class="value-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M12 2L2 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"></path>
									<path d="M10 17l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"></path>
								</svg>
							</div>
							<h4 class="value-name"><?php esc_html_e( 'Accessibility', 'care-towards-cure' ); ?></h4>
							<p class="value-description">
								<?php esc_html_e( 'We use technology to make consultation more convenient for patients, wherever appropriate.', 'care-towards-cure' ); ?>
							</p>
						</div>

						<div class="value-card">
							<div class="value-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M12 2c6.627 0 12 5.373 12 12s-5.373 12-12 12S0 20.627 0 14 5.373 2 12 2z"></path>
									<path d="M12 6v6l4 2.5"></path>
								</svg>
							</div>
							<h4 class="value-name"><?php esc_html_e( 'Continuity of Care', 'care-towards-cure' ); ?></h4>
							<p class="value-description">
								<?php esc_html_e( 'Healthcare doesn\'t end when the consultation ends. Follow-up and continued communication can be an important part of the treatment journey.', 'care-towards-cure' ); ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== SERVICES SECTION ===== -->
		<section class="services-section" id="services" data-reveal>
			<div class="container">
				<div class="services-header">
					<h2><?php esc_html_e( 'SERVICES', 'care-towards-cure' ); ?></h2>
					<h3 class="services-subtitle"><?php esc_html_e( 'Consultation & Treatment', 'care-towards-cure' ); ?></h3>
				</div>

				<?php
				// Get all services from the Service CPT
				$services_query = new WP_Query( array(
					'post_type'      => 'care_service',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
					'meta_query'     => array(
						array(
							'key'     => 'service_visible',
							'value'   => 'yes',
							'compare' => '=',
						),
					),
				) );
				?>

				<div class="services-grid" data-reveal-group>
					<?php
					if ( $services_query->have_posts() ) {
						while ( $services_query->have_posts() ) {
							$services_query->the_post();
							?>
							<a href="<?php the_permalink(); ?>" class="service-card service-card-link">
								<h4 class="service-title"><?php the_title(); ?></h4>
								<p class="service-description">
									<?php echo wp_kses_post( get_the_excerpt() ); ?>
								</p>
								<div class="service-cta">
									<?php esc_html_e( 'Learn More →', 'care-towards-cure' ); ?>
								</div>
							</a>
							<?php
						}
						wp_reset_postdata();
					}
					?>
				</div>

				<div class="services-disclaimer">
					<p>
						<?php esc_html_e( 'Important: Services and treatment recommendations are subject to the doctor\'s clinical assessment and may vary from patient to patient.', 'care-towards-cure' ); ?>
					</p>
				</div>
			</div>
		</section>

		<!-- ===== WHY CHOOSE CARE TOWARDS CURE SECTION ===== -->
		<section class="benefits-section" id="benefits" data-reveal>
			<div class="container">
				<div class="benefits-header">
					<h2><?php esc_html_e( 'WHY CHOOSE CARE TOWARDS CURE?', 'care-towards-cure' ); ?></h2>
				</div>

				<div class="benefits-grid" data-reveal-group>
					<!-- Benefit 1 -->
					<div class="benefit-card">
						<div class="benefit-icon">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
							</svg>
						</div>
						<h3 class="benefit-title"><?php esc_html_e( 'Personalised Attention', 'care-towards-cure' ); ?></h3>
						<p class="benefit-description">
							<?php esc_html_e( 'Your concerns are heard and discussed rather than being treated as just another case.', 'care-towards-cure' ); ?>
						</p>
					</div>

					<!-- Benefit 2 -->
					<div class="benefit-card">
						<div class="benefit-icon">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M23 7l-7 5 7 5V7z"></path>
								<rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
							</svg>
						</div>
						<h3 class="benefit-title"><?php esc_html_e( 'Convenient Online Access', 'care-towards-cure' ); ?></h3>
						<p class="benefit-description">
							<?php esc_html_e( 'Consult from home without unnecessary travel, wherever online consultation is clinically appropriate.', 'care-towards-cure' ); ?>
						</p>
					</div>

					<!-- Benefit 3 -->
					<div class="benefit-card">
						<div class="benefit-icon">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<circle cx="12" cy="12" r="10"></circle>
								<path d="M12 6v6l4 2"></path>
								<path d="M8 2l-2.5 3.5"></path>
								<path d="M16 2l2.5 3.5"></path>
							</svg>
						</div>
						<h3 class="benefit-title"><?php esc_html_e( 'Patient-Centred Approach', 'care-towards-cure' ); ?></h3>
						<p class="benefit-description">
							<?php esc_html_e( 'We focus on understanding the complete picture of your health and concerns.', 'care-towards-cure' ); ?>
						</p>
					</div>

					<!-- Benefit 4 -->
					<div class="benefit-card">
						<div class="benefit-icon">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
								<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
							</svg>
						</div>
						<h3 class="benefit-title"><?php esc_html_e( 'Easy Appointment Booking', 'care-towards-cure' ); ?></h3>
						<p class="benefit-description">
							<?php esc_html_e( 'Request your consultation through our simple online appointment system.', 'care-towards-cure' ); ?>
						</p>
					</div>

					<!-- Benefit 5 -->
					<div class="benefit-card">
						<div class="benefit-icon">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
								<path d="M10 17l2 2 4-4"></path>
							</svg>
						</div>
						<h3 class="benefit-title"><?php esc_html_e( 'Secure & Convenient', 'care-towards-cure' ); ?></h3>
						<p class="benefit-description">
							<?php esc_html_e( 'Share relevant information and documents digitally for a smoother consultation experience.', 'care-towards-cure' ); ?>
						</p>
					</div>

					<!-- Benefit 6 -->
					<div class="benefit-card">
						<div class="benefit-icon">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
								<path d="M12 2c6.627 0 12 5.373 12 12s-5.373 12-12 12S0 20.627 0 14 5.373 2 12 2z"></path>
								<path d="M12 6v6l4 2.5"></path>
								<path d="M7 11l2 2 4-4"></path>
							</svg>
						</div>
						<h3 class="benefit-title"><?php esc_html_e( 'Follow-Up Support', 'care-towards-cure' ); ?></h3>
						<p class="benefit-description">
							<?php esc_html_e( 'Continue your healthcare journey with follow-up consultations when recommended.', 'care-towards-cure' ); ?>
						</p>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== APPOINTMENT & ONLINE CONSULTATION SECTION ===== -->
		<section class="appointment-section" id="appointment" data-reveal>
			<div class="container">
				<div class="appointment-header">
					<h2><?php esc_html_e( 'APPOINTMENT & ONLINE CONSULTATION', 'care-towards-cure' ); ?></h2>
				</div>

				<div class="steps-container">
					<!-- Step 1 -->
					<div class="step-item">
						<div class="step-badge">1</div>
						<div class="step-content">
							<h4 class="step-title"><?php esc_html_e( 'Select Your Consultation', 'care-towards-cure' ); ?></h4>
							<p class="step-description">
								<?php esc_html_e( 'Choose the consultation option that suits your needs.', 'care-towards-cure' ); ?>
							</p>
						</div>
					</div>

					<!-- Step 2 -->
					<div class="step-item">
						<div class="step-badge">2</div>
						<div class="step-content">
							<h4 class="step-title"><?php esc_html_e( 'Fill in Your Details', 'care-towards-cure' ); ?></h4>
							<p class="step-description">
								<?php esc_html_e( 'Enter your name, contact number and other required information.', 'care-towards-cure' ); ?>
							</p>
						</div>
					</div>

					<!-- Step 3 -->
					<div class="step-item">
						<div class="step-badge">3</div>
						<div class="step-content">
							<h4 class="step-title"><?php esc_html_e( 'Verify Your Mobile Number', 'care-towards-cure' ); ?></h4>
							<p class="step-description">
								<?php esc_html_e( 'Complete OTP verification to confirm your contact details.', 'care-towards-cure' ); ?>
							</p>
						</div>
					</div>

					<!-- Step 4 -->
					<div class="step-item">
						<div class="step-badge">4</div>
						<div class="step-content">
							<h4 class="step-title"><?php esc_html_e( 'Select Your Preferred Time', 'care-towards-cure' ); ?></h4>
							<p class="step-description">
								<?php esc_html_e( 'Choose an available consultation slot.', 'care-towards-cure' ); ?>
							</p>
						</div>
					</div>

					<!-- Step 5 -->
					<div class="step-item">
						<div class="step-badge">5</div>
						<div class="step-content">
							<h4 class="step-title"><?php esc_html_e( 'Make Payment', 'care-towards-cure' ); ?></h4>
							<p class="step-description">
								<?php esc_html_e( 'Complete the consultation payment through the available payment options.', 'care-towards-cure' ); ?>
							</p>
						</div>
					</div>

					<!-- Step 6 -->
					<div class="step-item">
						<div class="step-badge">6</div>
						<div class="step-content">
							<h4 class="step-title"><?php esc_html_e( 'Attend Your Consultation', 'care-towards-cure' ); ?></h4>
							<p class="step-description">
								<?php esc_html_e( 'You will receive the consultation details and online meeting link.', 'care-towards-cure' ); ?>
							</p>
						</div>
					</div>
				</div>

				<div class="appointment-cta">
					<button type="button" class="btn btn-primary btn-lg" data-open-modal="appointmentModal">
						<?php esc_html_e( 'Book Your Appointment Now', 'care-towards-cure' ); ?>
					</button>
				</div>
			</div>
		</section>

<!-- ===== FREQUENTLY ASKED QUESTIONS SECTION ===== -->
		<section class="faq-section" id="faq" data-reveal>
			<div class="container">
				<div class="faq-header">
					<h2><?php esc_html_e( 'FREQUENTLY ASKED QUESTIONS', 'care-towards-cure' ); ?></h2>
				</div>

				<?php
				// Get all FAQs from the FAQ CPT
				$faqs_query = new WP_Query( array(
					'post_type'      => 'care_faq',
					'posts_per_page' => -1,
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
					'meta_query'     => array(
						array(
							'key'     => 'faq_visible',
							'value'   => 'yes',
							'compare' => '=',
						),
					),
				) );
				?>

				<div class="faq-grid" data-reveal-group>
					<?php
					if ( $faqs_query->have_posts() ) {
						while ( $faqs_query->have_posts() ) {
							$faqs_query->the_post();
							?>
							<div class="faq-card">
								<div class="faq-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
										<circle cx="12" cy="12" r="10"></circle>
										<path d="M12 16v-4"></path>
										<path d="M12 8h.01"></path>
									</svg>
								</div>
								<h3 class="faq-question"><?php the_title(); ?></h3>
								<p class="faq-answer">
									<?php echo wp_kses_post( get_the_content() ); ?>
								</p>
							</div>
							<?php
						}
						wp_reset_postdata();
					}
					?>
				</div>
			</div>
		</section>

<!-- ===== PRIVACY & PATIENT CONFIDENTIALITY SECTION ===== -->
		<section class="privacy-section" id="privacy" data-reveal>
			<div class="container">
				<div class="privacy-content">
					<div class="privacy-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
							<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
							<path d="M10 17l2 2 4-4"></path>
						</svg>
					</div>

					<h2><?php esc_html_e( 'PRIVACY & PATIENT CONFIDENTIALITY', 'care-towards-cure' ); ?></h2>

					<p class="privacy-tagline"><?php esc_html_e( 'Your privacy matters to us.', 'care-towards-cure' ); ?></p>

					<div class="privacy-text">
						<p>
							<?php esc_html_e( 'Information shared with Care Towards Cure during the appointment and consultation process is handled with appropriate confidentiality and used for purposes related to providing healthcare services, appointment management and patient communication.', 'care-towards-cure' ); ?>
						</p>

						<p>
							<?php esc_html_e( 'We encourage patients not to share unnecessary personal or medical information through public channels.', 'care-towards-cure' ); ?>
						</p>
					</div>

					<div class="privacy-cta">
						<a href="#" class="btn btn-primary"><?php esc_html_e( 'Read Privacy Policy', 'care-towards-cure' ); ?></a>
					</div>
				</div>
			</div>
		</section>

		<!-- ===== CONTACT US SECTION ===== -->
		<section class="contact-section" id="contact" data-reveal>
			<div class="container">
				<div class="contact-header">
					<h2><?php esc_html_e( 'CONTACT US', 'care-towards-cure' ); ?></h2>
					<h3 class="contact-subtitle"><?php esc_html_e( 'We\'re Here to Help', 'care-towards-cure' ); ?></h3>
					<p class="contact-intro">
						<?php esc_html_e( 'Have a question about an appointment or consultation?', 'care-towards-cure' ); ?>
					</p>
				</div>

				<div class="contact-wrapper">
					<div class="contact-info">
						<div class="clinic-details">
							<h3 class="clinic-name"><?php esc_html_e( 'Care Towards Cure', 'care-towards-cure' ); ?></h3>

							<!-- Address -->
							<div class="contact-item">
								<div class="contact-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
										<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
										<circle cx="12" cy="10" r="3"></circle>
									</svg>
								</div>
								<div class="contact-details">
									<p class="contact-label"><a href="https://maps.app.goo.gl/e6F8CtKWT7vKEh1N7" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none; cursor: pointer; font-weight: 600;"><?php esc_html_e( 'Triveni Nagar Branch', 'care-towards-cure' ); ?></a></p>
									<p class="contact-value">
										<a href="https://maps.app.goo.gl/e6F8CtKWT7vKEh1N7" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none; cursor: pointer;">
											<?php esc_html_e( 'C-114, Triveni Nagar Rd, opposite Triveni Heights, Shopping Centre, Vishveshvariya Nagar, Arjun Nagar, Jaipur, Rajasthan 302019', 'care-towards-cure' ); ?>
										</a>
									</p>
								</div>
							</div>


						<!-- Gangori Bazar Branch -->
						<div class="contact-item">
							<div class="contact-icon">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
									<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
									<circle cx="12" cy="10" r="3"></circle>
								</svg>
							</div>
							<div class="contact-details">
								<p class="contact-label"><a href="https://maps.app.goo.gl/airNiZuFRvXMUvx59" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none; cursor: pointer; font-weight: 600;"><?php esc_html_e( 'Gangori Bazar Branch', 'care-towards-cure' ); ?></a></p>
								<p class="contact-value">
									<a href="https://maps.app.goo.gl/airNiZuFRvXMUvx59" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none; cursor: pointer;">
										<?php esc_html_e( 'PN 2147, opposite Gangori Bazar Road, Gangori Bazar, Purani Basti, Jaipur, Rajasthan 302001', 'care-towards-cure' ); ?>
									</a>
								</p>
							</div>
						</div>
							<!-- Phone -->
							<div class="contact-item">
								<div class="contact-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
										<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
									</svg>
								</div>
								<div class="contact-details">
									<p class="contact-label"><?php esc_html_e( 'Phone', 'care-towards-cure' ); ?></p>
									<p class="contact-value">
										<a href="tel:9414311475">
											<?php esc_html_e( '9414311475', 'care-towards-cure' ); ?>
										</a>
									</p>
								</div>
							</div>

							<!-- Email -->
							<div class="contact-item">
								<div class="contact-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
										<rect x="2" y="4" width="20" height="16" rx="2"></rect>
										<path d="M2 6l10 8 10-8"></path>
									</svg>
								</div>
								<div class="contact-details">
									<p class="contact-label"><?php esc_html_e( 'Email', 'care-towards-cure' ); ?></p>
									<p class="contact-value">
										<?php
										$contact_email = get_theme_mod( 'care_footer_email', 'info@caretowardscure.com' );
										?>
										<a href="mailto:<?php echo esc_attr( $contact_email ); ?>">
											<?php echo esc_html( $contact_email ); ?>
										</a>
									</p>
								</div>
							</div>

							<!-- Hours -->
							<div class="contact-item">
								<div class="contact-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
										<circle cx="12" cy="12" r="10"></circle>
										<polyline points="12 6 12 12 16 14"></polyline>
									</svg>
								</div>
								<div class="contact-details">
									<p class="contact-label"><?php esc_html_e( 'Consultation Hours', 'care-towards-cure' ); ?></p>
									<p class="contact-value">
										<?php esc_html_e( 'Morning 10 AM to 2 PM', 'care-towards-cure' ); ?><br>
										<?php esc_html_e( 'Evening 5:30 PM to 9 PM', 'care-towards-cure' ); ?>
									</p>
								</div>
							</div>
						</div>
					</div>

					<div class="contact-cta">
						<button type="button" class="btn btn-primary btn-lg" data-open-modal="appointmentModal">
							<?php esc_html_e( 'Book an Appointment', 'care-towards-cure' ); ?>
						</button>
						<a href="https://wa.me/919414311475" target="_blank" rel="noopener noreferrer" class="btn btn-secondary btn-lg">
							<?php esc_html_e( 'Contact Us', 'care-towards-cure' ); ?>
						</a>
					</div>
				</div>


			<!-- Branch Locations Map -->
			<div class="contact-map-section" style="margin-top: 60px; padding: 40px 20px; background: #f8f9fa;">
				<div class="container">
					<h3 style="text-align: center; font-size: 1.8rem; margin-bottom: 40px; font-weight: 700;"><?php esc_html_e( 'Our Clinic Locations', 'care-towards-cure' ); ?></h3>

					<div style="border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
						<iframe src="https://www.google.com/maps?q=care+towards+cure+jaipur&output=embed" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
					<p style="text-align: center; margin-top: 20px; color: #666; font-size: 0.95rem;">
						📍 Triveni Nagar Branch | 📍 Gangori Bazar Branch - Both locations visible on the map above
					</p>
				</div>
			</div>
			</div>
		</section>

	</main>

<?php
get_footer();
