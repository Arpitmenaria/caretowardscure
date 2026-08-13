<?php
/**
 * The page template
 *
 * Displays full-width pages (not posts)
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
					while ( have_posts() ) {
						the_post();
						?>
						<article <?php post_class( 'page-article' ); ?>>
							<header class="entry-header">
								<h1 class="entry-title"><?php the_title(); ?></h1>
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
								the_post_thumbnail( 'large', array( 'class' => 'index-post-thumbnail' ) );
								echo '</div>';
							}
							?>

							<div class="entry-content">
								<?php the_content(); ?>
							</div>
						</article>
						<?php
					}
				} else {
					?>
					<div class="index-no-posts">
						<h2><?php esc_html_e( 'Page Not Found', 'care-towards-cure' ); ?></h2>
						<p><?php esc_html_e( 'Sorry, this page does not exist.', 'care-towards-cure' ); ?></p>
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
