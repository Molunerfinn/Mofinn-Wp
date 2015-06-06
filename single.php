<?php
/**
 * The template for displaying all single posts.
 *
 * @package EverBox
 */

get_header();
the_post();
?>
<div id="primary" class="left-column">
	<main id="main" class="site-main" role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
			<header class="entry-header">
			<?php if(has_post_thumbnail()) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<!-- END .entry-thumbnail -->
			<?php endif; ?>
				<?php everbox_post_category(); ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php everbox_post_meta(); ?>
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
			<footer class="entry-footer">
				<?php everbox_post_tags(); ?>
			</footer>
			<!-- END .entry-footer -->
		</article>
		<!-- END .single-post -->
		<?php everbox_post_navigation(); ?>

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
