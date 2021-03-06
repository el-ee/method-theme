<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package method
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>



<body <?php body_class("method_".$pagename); ?>>
  
    
    
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'method' ); ?></a>

	<header id="masthead" class="site-header " role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a class = "first-letter" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo(substr( get_bloginfo( 'name', 'display' ), 0, 1)); ?></a><a class="remaining-letters" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo(substr( get_bloginfo( 'name', 'display' ), 1));  ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
      <nav id="social-menu" class="social-menu">
      <?php wp_nav_menu( array( 
        'theme_location' => 'social',
        'menu_class' => 'method-social',
        'link_before' => '<span>',
        'link_after' => '</span>'
       )); ?>
     </nav>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle">&#x2261;</button>
			<?php wp_nav_menu( array( 
        'theme_location' => 'primary',  
        'menu_class' => 'method-navigation'
        )); ?>
      


		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
