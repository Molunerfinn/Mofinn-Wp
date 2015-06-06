<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package EverBox
 */
?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<div class="container-fluid">
				<div class="group">
					<div class="left-column">
						<div class="site-heading">
							<?php everbox_site_heading(); ?>
						</div>
						<!-- END .site-heading -->
						<nav id="site-navigation" class="main-navigation" role="navigation">
							<div class="nav-toggle"><i class="icon-bars"></i></div>
							<div class="main-menu-container">
							<?php
								wp_nav_menu( array(
									'theme_location' => 'primary',
									'container' => 'false',
									'menu_class' => 'main-nav',
									'fallback_cb' => 'everbox_nav_cb'
								) );
							?>
							</div>
						</nav>
						<!-- END .main-nagivation -->
					</div>
					<!-- END .left-column -->
					<div class="right-column">
						<div class="mobile-search-toggle"><i class="icon-search"></i></div>
						<div class="site-search-area">
							<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
								<input type="text" value="" name="s" id="s">
								<button type="submit" id="searchsubmit"><i class="icon-search"></i></button>
								<button type="button" id="search-toggle"></button>
							</form>
						</div>
						<!-- END .site-search-area -->
					</div>
					<!-- END .right-column -->
				</div>
				<!-- END .group -->
			</div>
			<!-- END .container-fluid -->
			<div class="mobile-menu-container">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'primary',
					'container' => 'false',
					'menu_class' => 'mobile-menu'
				) );
			?>
			</div>
			<!-- END .mobile-menu-container -->
			<div class="mobile-search-container">
				<form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
					<input type="search" value="" name="s" id="s" placeholder="<?php esc_attr(_e('Search..', 'everbox')); ?>">
				</form>
			</div>
			<!-- END .mobile-search-container -->
		</header>
		<!-- END .site-header -->
		<div class="container-fluid">
			<div id="content" class="site-content group">