<?php  
get_header();
?>	
<div id="primary" class="left-column">
	<main id="main" class="site-main" role="main">
	<?php  
		if(have_posts()) : 
			while(have_posts()) : the_post();
				get_template_part( 'content', '' );
			endwhile;
			everbox_posts_pagination();
		else:
			get_template_part( 'content', 'none' );
		endif;
	?>
	</main>
	<!-- END .site-main -->
</div>
<!-- END #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>