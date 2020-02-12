<?php
if ( !class_exists( 'SF_Widget_Popular_Posts' ) ) {

	class SF_Widget_Popular_Posts extends SF_Widget {

		/**
		 * Widget Constructor
		 */
		function __construct() {
			
			$args = array(
				'label' => 'TS - ' . esc_html__( 'Popular Posts', 'spirit' ),
				'description' => esc_html__( 'Show popular posts.', 'spirit' ),
				'slug' => 'sf-popular-posts',
				'fields' => array(
					array(
						'name' => esc_html__( 'Title', 'spirit' ),
						'id' => 'title',
						'type' => 'text',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'strip_tags|esc_attr',
					),
					array(
						'name' => esc_html__( 'Categories', 'spirit' ),
						'id' => 'categories',
						'type' => 'select_cats',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_attr'
					),
					array(
						'name' => esc_html__( 'Post IDs', 'spirit' ),
						'desc' => esc_html__( 'Enter post IDs separated by comma.( e.g. 35,36 ) Exclude a post by prefixing its ID with a - (minus) sign.( e.g. -35,-36 )', 'spirit' ),
						'id' => 'post_ids',
						'type' => 'text',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_attr'
					),
					array(
						'name' => esc_html__( 'Order By', 'spirit' ),
						'id' => 'order',
						'type' => 'select',
						'class' => 'widefat',
						'fields' => array(
							esc_html__( 'Latest Posts', 'spirit' ) => 'latest',
							esc_html__( 'Most Commented', 'spirit' ) => 'comments',
							esc_html__( 'Random Posts', 'spirit' ) => 'random'
						),
						'std' => 'latest',
						'filter' => 'esc_attr',
					),
					array(
						'name' => esc_html__( 'Post Style', 'spirit' ),
						'id' => 'style',
						'type' => 'select',
						'class' => 'widefat',
						'fields' => array(
							esc_html__( 'Small', 'spirit' ) => 'small',
							esc_html__( 'Text', 'spirit' ) => 'text',
						),
						'std' => 'small',
						'filter' => 'esc_attr',
					),
					array(
						'name' => esc_html__( 'Number of posts to show', 'spirit' ),
						'id' => 'count',
						'type' => 'number',
						'class' => 'widefat',
						'std' => 5,
						'filter' => 'natural',
					),
					array(
						'name' => esc_html__( 'Offset posts', 'spirit' ),
						'id' => 'offset',
						'type' => 'number',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'natural'
					),
				)
			);

			$this->create_widget( $args );
		}

		/**
		 * Echoes the widget content.
		 *
		 * @param array $args     Display arguments including 'before_title', 'after_title',
		 *                        'before_widget', and 'after_widget'.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {
			extract( $args );
			$title = isset( $instance['title'] ) ? $instance['title'] : '';
			$categories = isset( $instance['categories'] ) ? $instance['categories'] : '';
			$post_ids = isset( $instance['post_ids'] ) ? $instance['post_ids'] : '';
			$order = isset( $instance['order'] ) ? $instance['order'] : 'latest';
			$style = isset( $instance['style'] ) ? $instance['style'] : 'small';
			$count = isset( $instance['count'] ) ? $instance['count'] : 5;
			$offset = isset( $instance['offset'] ) ? absint( $instance['offset'] ) : 0;

			$query_args = array(
				'post_type' => 'post',
				'posts_per_page' => $count,
				'post_status' => 'publish',
				'no_found_rows' => 1,
				'ignore_sticky_posts' => true
			);

	        switch ( $order ) {
	            case 'random':
	                $query_args['orderby'] = 'rand';
	                break;

	            case 'comments':
	                $query_args['orderby'] = 'comment_count';
	        }

			if ( !empty( $categories ) ) {
				$query_args['cat'] = $categories;
			}

			if ( !empty( $post_ids ) ) {
				$post_ids = explode( ',', $post_ids );

				foreach( $post_ids as $id ) {
					if ( intval( $id ) >= 0 ) {
						$query_args['post__in'][] = $id;
					} else {
						$query_args['post__not_in'][] = $id;
					}
				}
			}

			if ( $offset > 0 ) {
				$query_args['offset'] = $offset;
			}

			$query = new WP_Query( $query_args );

			$date_format = get_option( 'date_format' );

			echo $before_widget;

			if ( !empty( $title ) ) : ?>
				<h4 class="widget-title"><span class="title"><?php echo esc_html( $title ); ?></span></h4>
			<?php endif; ?>
			<div class="post-list">
			<?php $counter = 0; while ( $query->have_posts() ): $query->the_post(); $counter ++; ?>
				<div <?php post_class( 'loop-post post-style-' . $style ); ?>>
					<div class="post-body">
						<?php if ( 'small' == $style && has_post_thumbnail() ) : ?>
							<div class="post-thumb">
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<?php echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' ); ?>
								</a>
							</div>
					    <?php endif; ?>
                        <div class="post-info">
                        	<h3 class="post-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h3>
                            <ul class="post-meta"><li class="meta-date"><time datetime="<?php echo date( DATE_W3C, get_the_time( 'U' ) ); ?>"><i class="far fa-calendar-alt"></i><?php echo get_the_date( $date_format ); ?></time></li></ul>
                        </div>
					</div>
				</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
			</div>

			<?php echo $after_widget;
		}
	}
}
