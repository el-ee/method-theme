<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package method
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
          <img src=" <?php echo get_template_directory_uri(); ?>/images/404-image.png"></img>
          <h1 class="page-title">Page missing</h1>

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below?', 'method' ); ?></p>

          

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
