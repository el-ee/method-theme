<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package method
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function method_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'method_jetpack_setup' );
