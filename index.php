<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * NOTE: THIS IS A CUSTOM HOME PAGE
 * It only displays posts that are part of the latest issue
 * 
 * @package method
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
      <header class="page-header">
<?php

// get all of the categories that are a child of the 'Issues' category
$parent_id = get_cat_ID( 'Issues');
if(isset($parent_id)) {
  $args = array('child_of' => $parent_id);
  $all_issues = get_categories($args);

  // create list of these issues so we can find most recent one
  $issue_numbers = get_option('issue_numbers');
  $issue_array = array();

  foreach($all_issues as $an_issue) {

    $cat = $an_issue->cat_ID;
    $issue_array[$issue_numbers[$cat]] = $cat;
  }

  // get last key in issue array, this is most recent issue 
  // (this is by issue number not by date)
  $last_key = key( array_slice( $issue_array, -1, 1, TRUE ) );

  //
   $cat = $issue_array[$last_key];
 
   $cat_object = get_the_category_by_ID( $cat );
   
   query_posts('cat='.$cat);
    
          // CREATE ISSUE HEADER 
          
            $image_id = get_option( '_wpfifc_taxonomy_term_'.$cat.'_thumbnail_id_', 0 );
        
            $image_url = wp_get_attachment_image_src($image_id, 'method-header');
        
            printf( '<div class="issue-image"><img src="%s"></img></div>', $image_url[0]);

             ?>

<div class="row">
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
    		$term_description = term_description();
    		if ( ! empty( $term_description ) ) :
    			printf( '<p>%s</p>', $term_description );    
    		endif;
        ?>
               </div><!-- #issue-description -->
             </div><!-- .row -->
 
           </header><!-- .page-header -->
           
<?php } 
else {
  error_log("This theme is designed to show the latest issue on the home page. You must create a parent category called 'Issue' and make all issues sub-categories of this in order for the theme to function properly. ");
}?>

		<?php if ( have_posts() ) : ?>

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
	</div><!-- #primary -->

<?php get_footer(); ?>
