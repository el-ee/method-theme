
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
          
          // get child categories; for each:
            // display header image for that child category
            // display child category name 
            // display description of child category
            printf('<div id="issue-listing">');
        
          $child_categories = get_categories('child_of='.$cat); 
       
          foreach ($child_categories as $child_category) {
            
            $child_id = $child_category->term_id;
            $child_name = $child_category->name;
            $child_description = $child_category->category_description;
          
            $issue_dates = get_option('issue_dates');
            $child_date = $issue_dates[$child_id];
          
            $issue_numbers = get_option('issue_numbers');
            $child_number = $issue_numbers[$child_id];
            
            $category_link = get_category_link( $child_id );
            $category_link_html = '<a href="'.esc_url( $category_link ).'"title="'.$child_name.'">';
          
            // display child category issue number and date
            printf('<div class="issue-number"><h1>Issue %s: %s</h1></div>', $child_number, $child_date);

            // display category header image
            $image_id = get_option( '_wpfifc_taxonomy_term_'.$child_id.'_thumbnail_id_', 0 );
            $image_url = wp_get_attachment_image_src($image_id, 'method-header');
            printf( '<div class="issue-image">%s<img src="%s"></img></a></div>', $category_link_html, $image_url[0]);
            
            // display child category name
            printf('<div class="issue-name">%s<h1>%s</h1></a></div>', $category_link_html, $child_name);
            
            // display description
            printf('<div class="issue-description"><p>%s</p></div>', $child_description);

            
          }
          
          printf('</div> <!-- end of #issue-listing -->');
         
        }
        
        // OTHERWISE, CARRYON
        
        ?>
        
        <!-- otherwise, nothing -->
        <?php
      }
      else {
        $parent_category = get_category($this_category->category_parent);
        if($parent_category->cat_name == "Issues" || $parent_category->cat_name == "issues" ) {

          // THIS IS AN ISSUE, CREATE SPECIAL HEADER 
          
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
    		$term_description = term_description();
    		if ( ! empty( $term_description ) ) :
    			printf( '<p>%s</p>', $term_description );
    		endif;
    	
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
