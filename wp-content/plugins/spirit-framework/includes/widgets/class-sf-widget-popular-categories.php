<?php
if ( !class_exists( 'SF_Widget_Popular_Categories' ) ) {

	class SF_Widget_Popular_Categories extends SF_Widget {

		/**
		 * Widget Constructor
		 */
		function __construct() {

			$args = array(
				'label' => 'TS - ' . esc_html__( 'Popular Categories', 'spirit' ),
				'description' => esc_html__( 'Show popular categories by post count.', 'spirit' ),
				'slug' => 'sf-popular-categories',
				'fields' => array(
					array(
						'name' => esc_html__( 'Title', 'spirit' ),
						'id' => 'title',
						'type' => 'text',
						'class' => 'widefat',
						'std' => '',
					),
					array(
						'name' => esc_html__( 'Include Categories', 'spirit' ),
						'desc' => esc_html__( 'Leave empty to show all the categories', 'spirit' ),
						'id' => 'include',
						'type' => 'select_cats',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_attr'
					),
					array(
						'name' => esc_html__( 'Exclude Categories', 'spirit' ),
						'id' => 'exclude',
						'type' => 'select_cats',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_attr'
					),
					array(
						'name' => esc_html__( 'Number of categories to show', 'spirit' ),
						'desc' => esc_html__( 'Leave empty to show all the categories', 'spirit' ),
						'id' => 'count',
						'type' => 'number',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'natural',
					),
					array(
						'name' => esc_html__( 'Show post counts', 'spirit' ),
						'id' => 'show_count',
						'type' => 'checkbox',
						'std' => 0,
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
			$include = isset( $instance['include'] ) ? $instance['include'] : '';
			$exclude = isset( $instance['exclude'] ) ? $instance['exclude'] : '';
			$count = isset( $instance['count'] ) ? $instance['count'] : '';
			$show_count = isset( $instance['show_count'] ) ? (bool)$instance['show_count'] : false;

			$cat_args = array(
	            'show_count' => true,
	            'orderby' => 'count',
	            'order' => 'DESC',
	            'hide_empty' => true
			);

			if ( !empty( $include ) ) {
				$cat_args['include'] = explode( ',', $include );
			}

			if ( !empty( $exclude ) ) {
				$cat_args['exclude'] = explode( ',', $exclude );
			}

			if ( !empty( $count ) ) {
				$cat_args['number'] = $count;
			}

			echo $before_widget;

			if ( !empty( $title ) ) : ?>
				<h4 class="widget-title"><span class="title"><?php echo esc_html( $title ); ?></span></h4>
			<?php endif;

			$cats = get_categories( $cat_args );

			if ( !empty( $cats ) ) {

				echo '<ul>';

				foreach ( $cats as $cat ) {
					echo '<li class="cat-item cat-item-' . esc_attr( $cat->term_id ) . '"><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_attr( $cat->cat_name );

					if ( $show_count ) {
						echo '<span class="count">' . esc_attr( $cat->count ) . '</span>';
					}

					echo '</a></li>';
				}

				echo '</ul>';
			}
		
			echo $after_widget;
		}
	}
}
