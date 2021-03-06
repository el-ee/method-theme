  <?php
/**
 * The template used for displaying page content in page.php
 *
 * @package method
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <div class="page-header-image">
    <?php 
    echo(get_the_post_thumbnail($page->ID, "method-header")); 
    ?>
  </div>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		
	</div><!-- .entry-content -->

</article><!-- #post-## -->


