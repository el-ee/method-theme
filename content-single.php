<?php
/**
 * @package method
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <?php 
    echo(get_the_post_thumbnail($page->ID, "method-header")); 
    ?>
    
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    <h2 class="entry-excerpt"><?php the_excerpt(); ?></h2>
    
    <?php the_author_posts_link(); ?>

	</header><!-- .entry-header -->

  <?php  method_share_buttons('method_share_sidebar');?>

	<div class="entry-content">
		<?php the_content(); ?>
    
    <div id="article-author-bio">
      
      <p><?php the_author_meta( 'description' ); ?></p>
      
    
    </div>
		
	</div><!-- .entry-content -->
  
  <?php  method_share_buttons('method_share_end');?>
  
  </div>

         <?php 
        
        $category_to_list = NULL;
        $category_to_list_id = 0;
        

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
        $category_link_html = '<a href="'.esc_url( $category_link ).'"title="'.$category_to_list_name.'">'.$category_to_list_name.'</a>';
        
        printf('<div id="issue-listing">');        
        
        // display other articles in this issue
        
        printf('<h1 class="also-in">Also in the %s issue:</h1>', $category_link_html );
        printf('<div class="row">');
        
        print_recent_articles($category_to_list_id, get_the_ID());
     
        printf('</div>');
       
      
  ?>




</article><!-- #post-## -->

