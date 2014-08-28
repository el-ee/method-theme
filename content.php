<?php
/**
 * @package method
 */
?>

<?php

if(($wp_query->current_post)==0) {
	echo('<div><div class="row">');
}
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<a class="post-thumbnail" href="<?php the_permalink(); ?>"><span><?php the_post_thumbnail(); ?></span></a>
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php the_author_posts_link(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
		
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->

<?php
	
if(($wp_query->current_post + 4)%3==0) {
	echo('</div></div><div><div class="row">');
}
?>
