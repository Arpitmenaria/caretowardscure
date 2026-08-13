<?php
/**
 * The main template file
 *
 * Fallback template used when a more specific template doesn't exist
 *
 * @package Care_Towards_Cure_Theme
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="main-content">
		<div class="container">
			<div class="index-content-wrapper">
				<?php
				if ( have_posts() ) {
					?>
					<div class="posts-list">
						<?php
						while ( have_posts() ) {
							the_post();
							?>
							<article <?php post_class( 'index-post-article' ); ?>>
								<header class="entry-header">
									<h2 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<div class="entry-meta index-entry-meta">
										<?php
										printf(
											esc_html__( 'Posted on %s by %s', 'care-towards-cure' ),
											'<time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>',
											'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
										);
										?>
									</div>
								</header>

								<?php
								if ( has_post_thumbnail() ) {
									echo '<div class="index-post-thumbnail-wrap">';
									the_post_thumbnail( 'medium', array( 'class' => 'index-post-thumbnail' ) );
									echo '</div>';
								}
								?>

								<div class="entry-content">
									<?php the_excerpt(); ?>
									<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e( 'Read More', 'care-towards-cure' ); ?></a>
								</div>
							</article>
							<?php
						}
						?>
					</div>

					<?php
					// Pagination
					the_posts_pagination( array(
						'prev_text' => esc_html__( 'Previous', 'care-towards-cure' ),
						'next_text' => esc_html__( 'Next', 'care-towards-cure' ),
					) );
					?>
					<?php
				} else {
					?>
					<div class="index-no-posts">
						<h2><?php esc_html_e( 'No Posts Found', 'care-towards-cure' ); ?></h2>
						<p><?php esc_html_e( 'Sorry, no posts match your criteria.', 'care-towards-cure' ); ?></p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Go Home', 'care-towards-cure' ); ?></a>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</main>

<?php
get_footer();
