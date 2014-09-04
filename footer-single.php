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
        
        $category_to_list = 0;
        $category_to_list_name = '';
        
        $issue_numbers = get_option('issue_numbers');

        $article_categories = get_the_category();
        foreach($article_categories as $a_category){
        
          $a_parent = $a_category->category_parent;
          if($a_parent != 0) {
       
            $a_parent = get_category($a_parent);   
            if($a_parent->slug == 'issues') {
               $category_to_list = $a_category->term_id;
               $category_to_list_name = $a_category->cat_name;
            }
          }
        }
        
        $image_id = get_option( '_wpfifc_taxonomy_term_'.$category_to_list.'_thumbnail_id_', 0 );
        $image_url = wp_get_attachment_image_src($image_id, 'method-header');
        printf( '<div class="issue-image"><img src="%s"></img></div>', $image_url[0]);

    
        printf('<div id="footer-issue-title"><h1 >Issue %s: %s </h1></div>', $issue_numbers[$category_to_list], $category_to_list_name);
    
        printf('<div id="footer-article-listing">');
        printf('<p>Also in this issue:</p>');
        printf('<ul>');
        
        /* Create new query to loop other articles in this issue */
      
        $query2 = new WP_Query( 'cat='.$category_to_list );

        // The 2nd Loop
        while ( $query2->have_posts() ) {
        	$query2->next_post();
        	echo '<li><a href="' . get_permalink($query2->post->ID) . '">' . get_the_title( $query2->post->ID ) . '</a><span class="author"> by ' . get_the_author($query2->post->ID) . '</span></li>';
        }

        // Restore original Post Data
        wp_reset_postdata();
     

        printf('</ul></div>');
       
 
   

      
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
