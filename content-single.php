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
    
    <?php the_author_link(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		
	</div><!-- .entry-content -->
  
  <h1>Share this article:</h1>
  <div id="share-buttons">
    <ul class="method-social-share">
      <li>
        <a href="http://twitter.com"><span class="genericon genericon-facebook"></span></a>
      </li>
      <li>
        <a href="http://twitter.com"><span class="genericon genericon-twitter"></span></a>
      </li>
    </ul>
  </div>

  
  <h1>Also in this issue:</h1>

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
