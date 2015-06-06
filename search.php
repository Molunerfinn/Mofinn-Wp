<?php
/**
 * The template for displaying search results pages.
 *
 * @package EverBox
 */

get_header(); ?>

<div id="primary" class="left-column">
	<main id="main" class="site-main" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="search-header">
			<h1 class="search-title"><?php printf( __( 'Search Results for: %s', 'everbox' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header>
		<!-- END .search-header -->

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
             get_template_part( 'content', '' );
			?>

		<?php endwhile; ?>

		<?php everbox_posts_pagination(); ?>

	<?php else : ?>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; ?>

	</main>
	<!-- END #main -->
</div>
<!-- END #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
