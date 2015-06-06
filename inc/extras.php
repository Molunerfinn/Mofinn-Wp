<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package EverBox
 */

/**
 * Change default excerpt more text
 */
function everbox_custom_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'everbox_custom_excerpt_more');

/**
 * Change default excerpt text
 */
function everbox_custom_excerpt( $excerpt ) {
    return $excerpt . '<a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More  &raquo;', 'everbox') . '</a>';
}
add_filter('the_excerpt', 'everbox_custom_excerpt');
/**
 * Change default excerpt length
 */
function everbox_custom_excerpt_length( $length ) {
    $custom_length = intval( get_theme_mod( 'everbox_excerpt_length', '60' ) );
	return $custom_length;
}
add_filter( 'excerpt_length', 'everbox_custom_excerpt_length', 999 );

/**
 * Post comments
 * @param  string $comment
 * @param  string $args
 * @param  string $depth
 * @return string
 */
function everbox_comments( $comment , $args , $depth ) {

    $GLOBALS['comment'] = $comment;
        $comment_post = get_post($comment->comment_post_ID);
    ?>
    <!-- commment -->
    <li id="comment-<?php echo $comment->comment_ID; ?>" <?php comment_class(); ?>>
    	<?php
          $avatar_size = 48;
        ?>
    	<div class="commentator-avatar-wrap">
    		<div class="commentator-avatar">
    			<?php echo get_avatar($comment,$avatar_size); ?>
    		</div>
    	</div>
    	<div class="comment-body">
      		<div class="comment-heading">
      			<span class="comment-author"><?php comment_author(); ?></span>
      			<span>&bull;</span>
      			<span class="comment-meta"><?php echo get_comment_date(); ?></span>
      			<span>&bull;</span>
      			<span class="comment-reply"><?php comment_reply_link(array_merge($args,array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
      			<?php
				if ( $comment_post ) {
					if ( $comment->user_id === $comment_post->post_author ) {
				?>
				<span>&bull;</span>
				<span class="comment-byauthor"><?php _e('Author', 'everbox' ); ?></span>
				<?php
					}
				}
				?>

			</div>
      		<?php if ($comment->comment_approved == '0') : ?>
            <div class="alert alert-info"><?php _e('Your comment is awaiting approval.','everbox');?></div>
        	<?php endif; ?>

	        <?php comment_text(); ?>
    	</div>
    </li>
    <!-- End commment -->
    <?php
}

/**
 * Posts pagination
 */
function everbox_posts_pagination() {
    $infinite = get_theme_mod( 'everbox_infinite', 0 );
    if( $infinite ) {
        return;
    }
    $output = '';
    $output .= '<div class="pagination-wrap">';
    $output .= get_the_posts_pagination(array('mid_size' => 1, 'screen_reader_text' => ''));
    $output .= '</div>';
    echo $output;
}

/**
 * wp_nav_menu() callback
 *
 * When there is no menu set, display the warning message.
 */
function everbox_nav_cb() {
    printf( '<div class="menu-warning">' . __('Sorry, you have not set any menus.', 'everbox') . '</div>');
}

/**
 * Sanitizes a hex color.
 */
function everbox_sanitize_hex_color( $color ) {
    if ( '' === $color  || false == $color) {
        return '';
    }

    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
        return $color;
    }
  return null;
}
/**
 * Sanitizes integer.
 */
function everbox_sanitize_integer( $input ) {
    return absint( $input );
}
/**
 * Sanitizes bool.
 */
function everbox_sanitize_bool( $input ) {
    if($input) {
        return 1;
    }
    return 0;
}