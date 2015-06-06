<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package EverBox
 */

/**
 * Display navigation to next/previous post when applicable.
 *
 */
function everbox_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'everbox' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">&laquo;&laquo;%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link&raquo;&raquo;</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Prints HTML with meta information for current post categories.
 */
function everbox_post_category() {
	
	if( ! get_theme_mod( 'everbox_category_link', 0 ) ) {
		return;
	}

	$categories = get_the_category();
	$separator = ' ';
	$output = '';
	if( $categories ) {
		foreach($categories as $category) {
			$output .= '<a href="'.esc_url(get_category_link( $category->term_id )).'" title="' . esc_attr( sprintf( __( "View all posts in %s", 'everbox' ), $category->name ) ) . '">'.esc_html($category->cat_name).'</a>'.$separator;
		}
?>
		<div class="post-meta category-links">
			<?php echo trim($output, $separator); ?>
		</div>
		<!-- END .post-meta -->
<?php
	}
}

/**
 * Prints site heading
 */
function everbox_site_heading() {

	$logo = get_theme_mod('everbox_logo', '' );
	if(!empty($logo)) {
	?>
		<a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link" rel="home">
			<img src="<?php echo esc_url( $logo ); ?>">
		</a>
	<?php } else { ?>
		<h1 class="site-title">
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
		</h1>
	<?php }
}
/**
 * Prints HTML with meta information for current post-date, author and comments.
 */
function everbox_post_meta() {
?>
<div class="post-meta">
	<span class="vcard author">
	<?php if(is_singular()) { ?>
	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="vcard author" rel="author"><?php echo esc_html( get_the_author() ); ?></a></span>
	<?php } else { ?>
	<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="vcard author"><?php echo esc_html( get_the_author() ); ?></a></span>
	<?php } ?>
	<span class="divider">&bull;</span>
	<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
	<?php if( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
	<span class="divider">&bull;</span>
	<?php if(is_home()) { ?>
	<span class="comments-count"><?php comments_popup_link( __( 'No Comment', 'everbox' ), __( '1 Comment', 'everbox' ), __( '% Comments', 'everbox' ) ); ?></span>
	<?php } else { ?>
	<span class="comments-count"><?php comments_popup_link( __( 'Leave a comment', 'everbox' ), __( '1 Comment', 'everbox' ), __( '% Comments', 'everbox' ) ); ?></span>
	<?php } ?>
	<?php endif; ?>
</div>
<!-- END .post-meta -->
<?php
}

/**
 * Prints HTML with meta information for current post tags.
 */
function everbox_post_tags() {

	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', '' );
	if ( $tags_list ) {
		printf( '<span class="tags-links">' . __( 'Tagged: %1$s', 'everbox' ) . '</span>', $tags_list );
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function everbox_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'everbox_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'everbox_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so everbox_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so everbox_categorized_blog should return false.
		return false;
	}
}

/**
 * Prints HTML for password protect post
 */
function everbox_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="form-inline" rol="form" method="post">
    ' . '<p>' . __( "This content is password protected. To view it please enter your password below:", 'everbox' ) . '</p>' .'
    	<div class="form-group">
    		<input name="post_password" id="' . esc_attr( $label ) . '" type="password" size="20" maxlength="20" placeholder="'. esc_attr__( "Password:", 'everbox' ) .'" class="form-control" />
   		</div>
		<div class="form-group"><button type="submit" class="btn btn-primary" name="Submit">'. __( 'Submit', 'everbox' ) .'</button></div>
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'everbox_password_form' );