<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EverBox
 */

get_header(); ?>

	<div id="primary" class="left-column">
		<main id="main" class="site-main" role="main">

		<?php if(have_posts()) : ?>
			<header class="archive-header">
				<?php  
					if(is_category()) {
						$feed_link = get_category_feed_link( get_query_var('cat') );
						printf('<div class="archive-rss"><a href="%s" target="_blank"><span class="icon-rss"></span></a></div>',
							get_category_feed_link( get_query_var('cat') )
						);
					}
					the_archive_title( '<h1 class="archive-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .archive-header -->
		<?php 
				while(have_posts()) : the_post();

					/* Include the post  template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', '' );

				endwhile;
				everbox_posts_pagination();
			else :

				get_template_part( 'content', 'none' );

			endif; 
		?>
		
		</main>
		<!-- END .site-main -->
	</div>
	<!-- END #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>