<?php
/**
 * @package EverBox
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-item' ); ?>>
	<?php if(has_post_thumbnail()) : ?>
	<div class="right">
		<div class="post-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<!-- END .post-thumbnail -->
	</div>
	<!-- END .right -->
	<?php endif; ?>
	<div class="left">
		<?php everbox_post_category(); ?>
		<h2 class="post-title">
		<?php 
			printf('<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>', 
				esc_url( get_permalink() ), 
				esc_attr( get_the_title() ), 
				get_the_title() 
			); 
			if(is_sticky()) {
				echo '<span class="sub-label">'. __('Sticky', 'everbox') .'</span>';
			}
		?>
		</h2>
		<?php everbox_post_meta(); ?>
		<div class="post-excerpt">
			<?php the_excerpt(); ?>
		</div>
		<!-- END .post-excerpt -->
	</div>
	<!-- END .left -->
</article>
<!-- END .post-item -->
