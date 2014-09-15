
<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package method
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
					<?php
					

							printf( '<h1 class="author-name">%s</h1>', get_the_author() );

              
              printf('<p class="author-bio"> %s</p>', get_the_author_meta('description'));
              
              printf('<p class="author-homepage"><a href="%s">%s</a></p>', get_the_author_meta('user_url'), get_the_author_meta('user_url'));
              
              
					?>

			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php method_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
