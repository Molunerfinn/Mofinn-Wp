<?php
/**
 * EverBox functions and definitions
 *
 * @package EverBox
 */
define('EVERBOX_URL', get_template_directory_uri());
define('EVERBOX_DIR', get_template_directory());

/* =Theme Core
----------------------------------*/
require EVERBOX_DIR . '/inc/theme-setup.php';
require EVERBOX_DIR . '/inc/template-tags.php';
require EVERBOX_DIR . '/inc/jetpack.php';
require EVERBOX_DIR . '/inc/widgets/class-popular-widget.php';
require EVERBOX_DIR . '/inc/customizer.php';
require EVERBOX_DIR . '/inc/extras.php';
?>
