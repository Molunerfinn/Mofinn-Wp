<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package mofinn
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function mofinn_jetpack_setup() {
	$infinite = get_theme_mod('mofinn_infinite', 0 );
	if( !$infinite ) {
	    return;
	}
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
		'type'		=> 'click'
	) );
}
add_action( 'after_setup_theme', 'mofinn_jetpack_setup' );