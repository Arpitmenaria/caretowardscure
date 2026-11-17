<?php
/**
 * Single Doctor Profile Template
 *
 * Displays individual doctor profile page
 *
 * @package Care_Towards_Cure_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="main-content">
		<article class="doctor-profile" role="article">
			<div class="container">
				<!-- Doctor Header -->
				<div class="doctor-header">
					<?php
					if ( has_post_thumbnail() ) {
						echo '<div class="doctor-image">';
						the_post_thumbnail( 'care-card' );
						echo '</div>';
					}
					?>
					<div class="doctor-info">
						<h1 class="doctor-name"><?php the_title(); ?></h1>
						<?php
						$designation = get_post_meta( get_the_ID(), 'doctor_designation', true );
						if ( $designation ) {
							echo '<p class="doctor-designation">' . esc_html( $designation ) . '</p>';
						}
						?>
					</div>
				</div>

				<!-- Doctor Content -->
				<div class="doctor-content">
					<h2><?php esc_html_e( 'Professional Profile', 'care-towards-cure' ); ?></h2>
					<div class="doctor-bio">
						<?php the_content(); ?>
					</div>

					<!-- Professional Details -->
					<?php
					$qualifications = get_post_meta( get_the_ID(), 'doctor_qualifications', true );
					$specialties = get_post_meta( get_the_ID(), 'doctor_specialties', true );
					$experience = get_post_meta( get_the_ID(), 'doctor_experience', true );
					?>

					<?php if ( $qualifications ) : ?>
						<div class="doctor-section">
							<h3><?php esc_html_e( 'Qualifications', 'care-towards-cure' ); ?></h3>
							<p><?php echo wp_kses_post( $qualifications ); ?></p>
						</div>
					<?php endif; ?>

					<?php if ( $specialties ) : ?>
						<div class="doctor-section">
							<h3><?php esc_html_e( 'Specialties', 'care-towards-cure' ); ?></h3>
							<p><?php echo wp_kses_post( $specialties ); ?></p>
						</div>
					<?php endif; ?>

					<?php if ( $experience ) : ?>
						<div class="doctor-section">
							<h3><?php esc_html_e( 'Experience', 'care-towards-cure' ); ?></h3>
							<p><?php echo wp_kses_post( $experience ); ?></p>
						</div>
					<?php endif; ?>

					<!-- Action Buttons -->
					<div class="doctor-actions">
						<a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-primary">
							<?php esc_html_e( 'Book Appointment', 'care-towards-cure' ); ?>
						</a>
						<a href="<?php echo esc_url( home_url( '/#doctors' ) ); ?>" class="btn btn-secondary">
							<?php esc_html_e( '← Back to Doctors', 'care-towards-cure' ); ?>
						</a>
					</div>
				</div>
			</div>
		</article>
	</main>

	<style>
		.doctor-profile {
			padding: 60px 20px;
			background-color: #f8f9fa;
		}

		.doctor-header {
			display: flex;
			gap: 40px;
			margin-bottom: 60px;
			align-items: flex-start;
		}

		.doctor-image {
			flex: 0 0 300px;
		}

		.doctor-image img {
			width: 100%;
			height: auto;
			border-radius: 8px;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
		}

		.doctor-info {
			flex: 1;
		}

		.doctor-name {
			font-size: 2.5rem;
			font-weight: 700;
			color: #1a1a1a;
			margin: 0 0 10px 0;
		}

		.doctor-designation {
			font-size: 1.25rem;
			color: #0066cc;
			margin: 0;
		}

		.doctor-content {
			background: white;
			padding: 40px;
			border-radius: 8px;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
		}

		.doctor-content h2 {
			font-size: 1.75rem;
			font-weight: 700;
			color: #1a1a1a;
			margin-bottom: 20px;
		}

		.doctor-bio {
			margin-bottom: 40px;
			line-height: 1.8;
			color: #555;
		}

		.doctor-section {
			margin-bottom: 30px;
		}

		.doctor-section h3 {
			font-size: 1.25rem;
			font-weight: 600;
			color: #1a1a1a;
			margin-bottom: 12px;
		}

		.doctor-section p {
			color: #666;
			line-height: 1.8;
		}

		.doctor-actions {
			margin-top: 40px;
			padding-top: 40px;
			border-top: 1px solid #e0e0e0;
			display: flex;
			gap: 15px;
			flex-wrap: wrap;
		}

		.doctor-actions .btn {
			display: inline-block;
		}

		@media (max-width: 768px) {
			.doctor-header {
				flex-direction: column;
				gap: 20px;
			}

			.doctor-image {
				flex: 0 0 auto;
				width: 100%;
			}

			.doctor-name {
				font-size: 1.75rem;
			}

			.doctor-designation {
				font-size: 1rem;
			}

			.doctor-content {
				padding: 20px;
			}
		}
	</style>

<?php
get_footer();
