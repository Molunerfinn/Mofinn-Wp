<?php  

class Everbox_Popular_Widget extends WP_Widget {

	/**
	 * Sets up the widget configures
	 */
	function __construct() {
		parent::__construct(
			'everbox_popular', // Base ID
			__('EverBox - Tab Posts', 'everbox'), // Name
			array( 'description' => __( 'A tab widget that contain popular posts list and latest posts list.', 'everbox' ), 'classname' => 'widget_stream-list' ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	function widget( $args, $instance ) {

		extract( $args );
		$class = '';

		$popular_title 	= ( ! empty( $instance['popular_title'] ) ) ? 	$instance['popular_title'] 			: __( 'Popular', 'everbox' );
		$latest_title 	= ( ! empty( $instance['latest_title'] ) ) 	? 	$instance['latest_title'] 			: __( 'Latest', 'everbox' );
		$range 			= ( ! empty( $instance['range'] ) ) 		? 	intval( $instance['range'] ) 		: '7';
		$posts_num 		= ( ! empty( $instance['posts_num'] ) ) 	? 	intval( $instance['posts_num'] ) 	: 8;

		echo $args['before_widget'];

		?>
		<div class="widget-content">
			<ul id="filter-toggle-buttons">
				<li class="filter-button"><a href="#popular_posts-<?php echo $this->number; ?>"><?php echo $popular_title; ?></a></li>
				<li class="filter-button"><a href="#latest_posts-<?php echo $this->number; ?>"><?php echo $latest_title; ?></a></li>
			</ul>
			<!-- END #filter-toggle-buttons -->
			<div id="popular_posts-<?php echo $this->number; ?>" class="posts-list tab_content">
			<?php  
				$popular_args = array(
					'posts_per_page' => $posts_num,
					'orderby' => 'comment_count',
					'order'	=> 'DESC'
				);
				$popular_query = null;
				switch ($range) {
					case '7':
						add_filter( 'posts_where', array( $this, 'filter_where_7days' ) );
						$popular_query = new WP_Query( $popular_args );
						remove_filter( 'posts_where', array( $this, 'filter_where_7days' ) );
						break;
					case '30':
						add_filter( 'posts_where', array( $this, 'filter_where_30days' ) );
						$popular_query = new WP_Query( $popular_args );
						remove_filter( 'posts_where', array( $this, 'filter_where_30days' ) );
						break;
					case '1':
					default:
						add_filter( 'posts_where', array( $this, 'filter_where_1days' ) );
						$popular_query = new WP_Query( $popular_args );
						remove_filter( 'posts_where', array( $this,'filter_where_1days' ) );
						break;
				}
				
				$output = '';
				if( $popular_query->have_posts() ) :
					$output .= "<ul>";
					while( $popular_query->have_posts() ) : $popular_query->the_post();
						$output .= "<li>";
						if( has_post_thumbnail() ) {
							$output .= sprintf( '<div class="thumb">%s</div>', get_the_post_thumbnail( get_the_id(), '120x100' ) );
						}
						$output .= '<div class="right-body">';
						$output .= 	sprintf( '<a href="%1$s" class="title" title="%2$s" role="bookmark">%3$s</a>',
							get_permalink( get_the_id() ),
							esc_attr( get_the_title() ),
							get_the_title()
						);
						$output .=  sprintf( '<time class="entry-date published" datetime="%1$s">%2$s</time>',
							esc_attr( get_the_date( 'c' ) ),
							esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago', 'everbox') )
						);
						$output .= '<span class="divider">&bull;</span>';
						$output .= '<span class="comments-count">' . sprintf( __('%s Comments', 'everbox'), get_comments_number() ) . '<span>';
						$output .=	'</div>';
						$output .=	'</li>';
					endwhile;
					$output .= "</ul>";
					echo $output;
				else :
					_e('No Posts', 'everbox');
				endif;
				wp_reset_postdata();
			?>
			</div>
			<!-- END #popular_posts -->
			<div id="latest_posts-<?php echo $this->number; ?>" class="posts-list tab_content">
			<?php
				$latest_query = new WP_Query( array(
					'posts_per_page' => $posts_num
				) );
				$output = '';
				if( $latest_query->have_posts() ) :
					$output .= "<ul>";
					while( $latest_query->have_posts() ) : $latest_query->the_post();
						$output .= "<li>";
						if( has_post_thumbnail() ) {
							$output .= sprintf( '<div class="thumb">%s</div>', get_the_post_thumbnail( get_the_id(), 'eb-small-thumb' ) );
						}
						$output .= '<div class="right-body">';
						$output .= 	sprintf( '<a href="%1$s" class="title" title="%2$s" role="bookmark">%3$s</a>',
							get_permalink( get_the_id() ),
							esc_attr( get_the_title() ),
							get_the_title()
						);
						$output .=  sprintf( '<time class="entry-date published" datetime="%1$s">%2$s</time>',
							esc_attr( get_the_date( 'c' ) ),
							esc_html( human_time_diff( get_the_time('U'), current_time('timestamp') ) . __(' ago', 'everbox') )
						);
						$output .=	'</div>';
						$output .=	'</li>';
					endwhile;
					$output .= "</ul>";
					echo $output;
				else :
					_e('No Posts', 'everbox');
				endif;
				wp_reset_postdata();
			?>
			</div>
			<!-- END #latest_posts -->
		</div>
		<!-- END .widget-content -->
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	function form( $instance ) {

		$popular_title 	= ( ! empty( $instance['popular_title'] ) ) 	? esc_attr( $instance['popular_title'] ) 	: __('Popular', 'everbox');
		$latest_title 	= ( ! empty( $instance['latest_title'] ) )		? esc_attr( $instance['latest_title'] ) 	: __('Latest', 'everbox');
		$range 			= ( ! empty( $instance['range'] ) )				? intval( $instance['range'] ) 				: 1;
		$posts_num 		= ( ! empty( $instance['posts_num'] ) ) 		? intval( $instance['posts_num'] ) 			: 8;

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'popular_title' ); ?>"><?php _e( 'Popular tab title:', 'everbox' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'popular_title' ); ?>" name="<?php echo $this->get_field_name( 'popular_title' ); ?>" type="text" value="<?php echo $popular_title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'range' ); ?>"><?php _e( 'Range:', 'everbox' ); ?></label>
			<br />
			<select class='widefat' name="<?php echo $this->get_field_name('range'); ?>" id="<?php echo $this->get_field_id('range'); ?>">
				<option value="1" <?php selected( '1', $range ); ?>><?php _e( 'Last 1 days', 'everbox' ); ?></option>
				<option value="7" <?php selected( '7', $range ); ?>><?php _e( 'Last 7 days', 'everbox' ); ?></option>
				<option value="30" <?php selected( '30', $range ); ?>><?php _e( 'Last 30 days', 'everbox' ); ?></option>
			</select>
		</p>
		<hr>
		<p>
			<label for="<?php echo $this->get_field_id( 'latest_title' ); ?>"><?php _e( 'Latest tab title:', 'everbox' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'latest_title' ); ?>" name="<?php echo $this->get_field_name( 'latest_title' ); ?>" type="text" value="<?php echo $latest_title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_num' ); ?>"><?php _e( 'Posts num:', 'everbox' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'posts_num' ); ?>" name="<?php echo $this->get_field_name( 'posts_num' ); ?>" type="number" value="<?php echo $posts_num; ?>" />
			<label for="<?php echo $this->get_field_id( 'posts_num' ); ?>"><?php _e('how many posts you want to show for both popular tab and latest tab.', 'everbox'); ?></label>
		</p>
		<?php
	}
	
	/**
	 * Processing widget options on save
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['popular_title'] 		= strip_tags( $new_instance['popular_title'] );
		$instance['latest_title'] 		= strip_tags( $new_instance['latest_title'] );
		$instance['range']				= absint( strip_tags( $new_instance['range'] ) );
		$instance['posts_num'] 			= absint( strip_tags( $new_instance['posts_num'] ) );

		return $instance;

	}

	function filter_where_1days( $where ) {
		//posts in the last 1 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-1 days')) . "'";
	    return $where;
	}

	function filter_where_7days( $where ) {
		//posts in the last 7 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-7 days')) . "'";
	    return $where;
	}

	function filter_where_30days( $where ) {
		//posts in the last 30 days
	    $where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
	    return $where;
	}

}

?>