<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package EverBox
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function everbox_jetpack_setup() {
	$infinite = get_theme_mod('everbox_infinite', 0 );
	if( !$infinite ) {
	    return;
	}
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
		'type'		=> 'click'
	) );
}
add_action( 'after_setup_theme', 'everbox_jetpack_setup' );