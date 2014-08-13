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

	<footer id="colophon" class="site-footer" role="contentinfo">
    
     <nav id="footer-menu" class="footer-menu">
     <?php wp_nav_menu( array( 
       'theme_location' => 'footer',
       'menu_class' => 'method-footer',
       'link_before' => '<span>',
       'link_after' => '</span>'
      )); ?>
    </nav>
    
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
