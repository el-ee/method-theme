
<?php
/**
 * The template for displaying archive pages of categories.
 * This is used for the issue display
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
        $image_id = get_option( '_wpfifc_taxonomy_term_'.$cat.'_thumbnail_id_', 0 );
        
        $image_url = wp_get_attachment_image_src($image_id, 'method-header');
        
        printf( '<div id="issue-image"><img src="%s"></img></div>', $image_url[0]);

         ?>


        <div id="issue-headers">
				<h1 class="issue-number">
					<?php
          echo ("Issue ");
          $issue_numbers = get_option('issue_numbers');
          echo($issue_numbers[$cat]);
          ?>
          </h1>
            <h1 class="issue-title">
            <?php     single_cat_title();     ?>
				</h1>
      </div>
      <div id="issue-description">
				
	<?php
		// Show an optional term description.
		$term_description = term_description();
		if ( ! empty( $term_description ) ) :
			printf( '<p>%s</p>', $term_description );
		endif;
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
