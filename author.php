<?php
/**
 * The template for displaying author posts.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package EverBox
 */

get_header(); 
global $author; $userdata = get_userdata($author);
?>

	<div id="primary" class="left-column">
		<main id="main" class="site-main" role="main">

		<?php if(have_posts()) : ?>
			<header class="archive-header">
				<div class="clearfix">
					<div class="archive-rss">
						<a href="<?php echo get_author_feed_link( $author ); ?>" target="_blank">
							<span class="icon-rss"></span>
						</a>
					</div>
					<?php
						the_archive_title( '<h1 class="archive-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</div>
				<div class="author-box">
					<div class="author-avatar">
						<?php echo get_avatar( $userdata->user_email, '80' ) ?>
					</div>
					<!-- END .author-avatar -->
					<div class="author-info">
						<div class="author-desc">
							<?php echo $userdata->description; ?>
						</div>
						<?php do_action('after_author_desc'); ?>
					</div>
					<!-- END .author-info -->
				</div>
				<!-- END .author-box -->
			</header>
			<!-- END .archive-header -->
		<?php 
				while(have_posts()) : the_post();
					/* Include the post template for the content.
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