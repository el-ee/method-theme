
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

      
			<header class="page-header">
      
      
      <?php
      
      $hide_posts = false;
      
      $this_category = get_category($cat);
      if($this_category->category_parent == 0) {
        
        // FOR ISSUES CATEGORY, DO SOMETHING SPECIAL
        if($this_category->cat_name == "Issues" || $this_category->cat_name == "issues" ) {
            $hide_posts = true;
          

          printf('<div id="issue-listing">');
        
            // get all the issues
            $all_issues = get_categories('child_of='.$cat); 
            
            $issue_numbers = get_option('issue_numbers');
            $issue_array = array();

            foreach($all_issues as $an_issue) {
              $cat = $an_issue->cat_ID;
              $issue_array[$issue_numbers[$cat]] = $an_issue;
            }
            
            // sort the array by keys (which are the issue numbers)
            ksort($issue_array);
       
            // display issue details in order of the sorted array
            // this printing function is in functions.php
            foreach ($issue_array as $an_issue) {   
              print_issue_header($an_issue);
            } // end for each issue loop
       
          printf('</div> <!-- end of #issue-listing -->');
        
         
        }
        
        // OTHERWISE, CARRYON

      }
      else {
        $parent_category = get_category($this_category->category_parent);
        if($parent_category->cat_name == "Issues" || $parent_category->cat_name == "issues" ) {

          // THIS IS AN ISSUE, CREATE SPECIAL HEADER 
          
          
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
      
      </div><!-- description -->
       </div><!-- row -->          
      
      <?php
      
        }
        else
        {
          echo ("this is something else");
        }
      }
      
      ?>

	 

        
   </header><!-- .page-header -->
      
  		<?php if ( have_posts() ) : ?>
      
      
     <?php if(! $hide_posts) { ?>

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

     <?php } ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
