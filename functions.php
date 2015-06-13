<?php
/**
 * mofinn functions and definitions
 *
 * @package mofinn
 */
define('mofinn_URL', get_template_directory_uri());
define('mofinn_DIR', get_template_directory());

/* =Theme Core
----------------------------------*/
require mofinn_DIR . '/inc/theme-setup.php';
require mofinn_DIR . '/inc/template-tags.php';
require mofinn_DIR . '/inc/jetpack.php';
require mofinn_DIR . '/inc/widgets/class-popular-widget.php';
require mofinn_DIR . '/inc/customizer.php';
require mofinn_DIR . '/inc/extras.php';
?>
