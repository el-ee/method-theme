<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package method
 */
?>

	</div><!-- #content -->
<footer id="colophon" class="site-footer-single" role="contentinfo">
  
  
        <?php 
        
        $category_to_list = NULL;
        $category_to_list_id = 0;
        $category_to_list_name = '';
        
        $issue_numbers = get_option('issue_numbers');

        $article_categories = get_the_category();
        foreach($article_categories as $a_category){
        
          $a_parent = $a_category->category_parent;
          if($a_parent != 0) {
       
            $a_parent = get_category($a_parent);   
            if($a_parent->slug == 'issues') {
              $category_to_list = $a_category;
            }
          }
        }

        $category_to_list_id = $category_to_list->term_id;
        $category_to_list_name = $category_to_list->cat_name;

        $category_link = get_category_link( $category_to_list_id );
        $category_link_html = '<a href="'.esc_url( $category_link ).'"title="'.$category_to_list_name.'">';
        
        printf('<div id="issue-listing">');        
        
        // display category header image
        $image_id = get_option( '_wpfifc_taxonomy_term_'.$category_to_list_id.'_thumbnail_id_', 0 );
        $image_url = wp_get_attachment_image_src($image_id, 'method-header');
        printf( '<div class="issue-image">%s<img src="%s"></img></a></div>', $category_link_html, $image_url[0]);
  
        // display child category name
        printf('<div class="issue-name">%s<h1>%s</h1></a></div>', $category_link_html, $category_to_list_name);
  
        printf('</div>');
        

    
        // display other articles in this issue
        
        printf('<p>Also in this issue:</p>');
        printf('<div class="row">');
        
        /* Create new query to loop other articles in this issue */
      
        $query2 = new WP_Query( 'cat='.$category_to_list_id );
        $num_posts_printed = 0;

        // The 2nd Loop
        while ( $query2->have_posts() && $num_posts_printed < 4) {
        	$query2->next_post();
        	
          
          
          echo '<li><a href="' . get_permalink($query2->post->ID) . '">' . get_the_title( $query2->post->ID ) . '</a><span class="author"> by ' . get_the_author($query2->post->ID) . '</span></li>';
        
          
          
          ?>
          
          
         
         <article>
         	<header class="entry-header">
         		<a class="post-thumbnail" href="<?php get_permalink($query2->post->ID); ?>"><span><?php the_post_thumbnail(); ?></span></a>
             <h1 class="entry-title"><a href="<?php get_permalink( $query2->post->ID )?>"><?php get_the_title( $query2->post->ID )?></a></h1>

         	<div class="entry-content">
         		<?php the_excerpt(); ?>
	
         	</div><!-- .entry-content -->


         </article><!-- #post-## -->
         
          <?php     
          $num_posts_printed = $num_posts_printed +1;  
        }

        wp_reset_postdata();
     
        printf('</div>');
        
 
   

      
  ?>

    
	  <div class="site-info">
      <!-- <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'method' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'method' ), 'WordPress' ); ?></a>
      <span class="sep"> | </span>
      <?php printf( __( 'Theme: %1$s by %2$s.', 'method' ), 'method', '<a href="http://underscores.me/" rel="designer">Underscores.me</a>' ); ?> -->
        
        <p class="credits">Unless otherwise noted, images from the CDC image library.</p>
        
        <a id="license" rel="license" href="http://creativecommons.org/licenses/by-nc/4.0/"><img alt="Creative Commons License" src="<?php bloginfo('template_directory');?>/images/by-nc.png" /></a>
        
    </div><!-- .site-info -->
      
      
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
