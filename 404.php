<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package EverBox
 */
get_header(); ?>

	<div id="primary" class="left-column eh">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'everbox' ); ?></h1>
				</header>
				<!-- END .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'everbox' ); ?></p>
					<br>
					<?php get_search_form(); ?>
					<br>
					<?php the_widget( 'WP_Widget_Recent_Posts', array(), array(
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<div class="widget-head"><h3 class="widget-title">',
						'after_title'   => '</h3></div>',
					) ); ?>


					<?php the_widget( 'WP_Widget_Tag_Cloud', array(), array(
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<div class="widget-head"><h3 class="widget-title">',
						'after_title'   => '</h3></div>',
					) ); ?>

				</div>
				<!-- END .page-content -->
			</section>
			<!-- END .error-404 -->
		</main>
		<!-- END #main -->
	</div>
	<!-- END #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
