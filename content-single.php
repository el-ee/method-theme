<?php
/**
 * @package method
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
    <?php the_post_thumbnail(); ?>
    
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    <h2 class="entry-excerpt"><?php the_excerpt(); ?></h2>
    
    <?php the_author_link(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
