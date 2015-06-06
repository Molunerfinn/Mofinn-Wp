<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package EverBox
 */

get_header();
the_post();
?>
<div id="primary" class="left-column">
	<main id="main" class="site-main" role="main">
		<?php do_action('everbox_before_content'); ?>
		<article id="page-<?php the_ID(); ?>" <?php post_class( 'single-page' ); ?>>
			<header class="page-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<!-- END .entry-header -->
			<div class="entry-content">
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="pagination-wrap"><div class="link-pages">',
						'after'  => '</div></div>',
						'pagelink' => '<span>%</span>'
					) );
				?>
			</div>
			<!-- END .entry-content -->
		</article>
		<!-- END .single-post -->
		<?php do_action('everbox_after_post'); ?>
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
	</main>
	<!-- END .site-main -->
</div>
<!-- END #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
