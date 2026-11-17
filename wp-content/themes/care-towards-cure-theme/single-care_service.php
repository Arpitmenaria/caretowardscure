<?php
/**
 * Single Service Detail Page Template
 *
 * Displays individual service information
 *
 * @package Care_Towards_Cure_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="main-content">
		<article class="service-detail" role="article">
			<div class="container">
				<!-- Service Header -->
				<div class="service-header">
					<?php
					if ( has_post_thumbnail() ) {
						echo '<div class="service-image">';
						the_post_thumbnail( 'care-hero' );
						echo '</div>';
					}
					?>
					<div class="service-info">
						<h1 class="service-title"><?php the_title(); ?></h1>
						<p class="service-excerpt"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
					</div>
				</div>

				<!-- Service Content -->
				<div class="service-content">
					<?php the_content(); ?>
				</div>

				<!-- Back Link -->
				<div class="service-back">
					<a href="<?php echo esc_url( home_url( '/#services' ) ); ?>" class="btn btn-secondary">
						<?php esc_html_e( '← Back to Services', 'care-towards-cure' ); ?>
					</a>
				</div>
			</div>
		</article>
	</main>

	<style>
		.service-detail {
			padding: 60px 20px;
			background-color: #f8f9fa;
		}

		.service-header {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 40px;
			margin-bottom: 60px;
			align-items: center;
		}

		.service-image {
			width: 100%;
			border-radius: 8px;
			overflow: hidden;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
		}

		.service-image img {
			width: 100%;
			height: auto;
			display: block;
		}

		.service-info {
			padding: 20px 0;
		}

		.service-title {
			font-size: 2.5rem;
			font-weight: 700;
			color: #1a1a1a;
			margin: 0 0 20px 0;
			line-height: 1.3;
		}

		.service-excerpt {
			font-size: 1.1rem;
			color: #666;
			line-height: 1.8;
			margin: 0;
		}

		.service-content {
			background: white;
			padding: 40px;
			border-radius: 8px;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
			margin-bottom: 40px;
			line-height: 1.8;
			color: #555;
		}

		.service-content h2 {
			font-size: 1.75rem;
			font-weight: 700;
			color: #1a1a1a;
			margin-top: 30px;
			margin-bottom: 15px;
		}

		.service-content h2:first-child {
			margin-top: 0;
		}

		.service-content h3 {
			font-size: 1.3rem;
			font-weight: 600;
			color: #1a1a1a;
			margin-top: 20px;
			margin-bottom: 10px;
		}

		.service-content ul,
		.service-content ol {
			margin: 20px 0;
			padding-left: 25px;
		}

		.service-content li {
			margin-bottom: 10px;
		}

		.service-content p {
			margin-bottom: 15px;
		}

		.service-back {
			text-align: center;
			padding-top: 40px;
			border-top: 1px solid #e0e0e0;
		}

		.service-back a {
			display: inline-block;
		}

		@media (max-width: 768px) {
			.service-header {
				grid-template-columns: 1fr;
				gap: 30px;
			}

			.service-title {
				font-size: 1.75rem;
			}

			.service-excerpt {
				font-size: 1rem;
			}

			.service-content {
				padding: 25px;
			}

			.service-content h2 {
				font-size: 1.4rem;
			}

			.service-detail {
				padding: 40px 15px;
			}
		}
	</style>

<?php
get_footer();
