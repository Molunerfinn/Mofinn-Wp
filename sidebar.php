<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package EverBox
 */
?>
<div id="secondary" class="right-column">
	<div class="secondary-toggle"><i class="icon-angle-left"></i></div>
	<div class="sidebar" role="complementary">
		<?php
			if(is_singular() && is_active_sidebar( 'sidebar-alter' )) {
				dynamic_sidebar( 'sidebar-alter' );
			} else {
				dynamic_sidebar( 'sidebar-default' );
			}
		?>
		<div class="site-footer">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container' => 'div',
				'container_class' => 'footer-links',
				'fallback_cb' => ''
			) );
		?>
		
		<?php if(get_theme_mod( 'everbox_credit', 1 )) : ?>
			<div class="site-info">
			<?php  
				printf('Powered by WordPress. Theme by <a href="%1$s" target="_blank">moyu</a>', esc_url( 'http://www.20theme.com' ));
			?>
			</div>
			<!-- END .site-info -->
		<?php endif; ?>

		</div>
		<!-- END .site-footer -->
	</div>
	<!-- END .sidebar -->
</div>
<!-- END #secondary -->
