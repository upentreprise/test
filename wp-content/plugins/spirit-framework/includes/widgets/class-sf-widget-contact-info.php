<?php
if ( !class_exists( 'SF_Widget_Contact_Info' ) ) {
	
	class SF_Widget_Contact_Info extends SF_Widget {

		/**
		 * Widget Constructor
		 */
		function __construct() {

			$args = array(
				'label' => 'TS - ' . esc_html__( 'Contact Info', 'spirit' ),
				'description' => esc_html__( 'Contact Info.', 'spirit' ),
				'slug' => 'sf-contact-info',
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
						'name' => esc_html__( 'Icon', 'spirit' ),
						'id' => 'item_icon_1',
						'type' => 'icon',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_attr',
					),
					array(
						'name' => esc_html__( 'Text', 'spirit' ),
						'id' => 'item_text_1',
						'type' => 'text',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'strip_tags|esc_attr',
					),
					array(
						'name' => esc_html__( 'Icon', 'spirit' ),
						'id' => 'item_icon_2',
						'type' => 'icon',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_attr',
					),
					array(
						'name' => esc_html__( 'Text', 'spirit' ),
						'id' => 'item_text_2',
						'type' => 'text',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'strip_tags|esc_attr',
					),
					array(
						'name' => esc_html__( 'Icon', 'spirit' ),
						'id' => 'item_icon_3',
						'type' => 'icon',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_attr',
					),
					array(
						'name' => esc_html__( 'Text', 'spirit' ),
						'id' => 'item_text_3',
						'type' => 'text',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'strip_tags|esc_attr',
					),
					array(
						'name' => esc_html__( 'Icon', 'spirit' ),
						'id' => 'item_icon_4',
						'type' => 'icon',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_attr',
					),
					array(
						'name' => esc_html__( 'Text', 'spirit' ),
						'id' => 'item_text_4',
						'type' => 'text',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'strip_tags|esc_attr',
					)
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


			echo $before_widget;

			if ( !empty( $title ) ) : ?>
			
				<h4 class="widget-title"><span class="title"><?php echo esc_html( $title ); ?></span></h4>

			<?php endif; ?>
			
			<div class="contact-info-widget">
				<ul>
				<?php if ( !empty( $instance['item_icon_1'] ) || !empty( $instance['item_text_1'] ) ) : ?>
					<li class="contact-info-item">
						<?php if ( !empty( $instance['item_icon_1'] ) ) : ?>
							<i class="<?php echo esc_attr( $instance['item_icon_1'] ); ?>"></i>
						<?php endif; ?>
						<?php if ( !empty( $instance['item_text_1'] ) ) : ?>
						<?php echo esc_html( $instance['item_text_1'] ); ?>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( !empty( $instance['item_icon_2'] ) || !empty( $instance['item_text_2'] ) ) : ?>
					<li class="contact-info-item">
						<?php if ( !empty( $instance['item_icon_2'] ) ) : ?>
							<i class="<?php echo esc_attr( $instance['item_icon_2'] ); ?>"></i>
						<?php endif; ?>
						<?php if ( !empty( $instance['item_text_2'] ) ) : ?>
						<?php echo esc_html( $instance['item_text_2'] ); ?>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( !empty( $instance['item_icon_3'] ) || !empty( $instance['item_text_3'] ) ) : ?>	
					<li class="contact-info-item">
						<?php if ( !empty( $instance['item_icon_3'] ) ) : ?>
							<i class="<?php echo esc_attr( $instance['item_icon_3'] ); ?>"></i>
						<?php endif; ?>
						<?php if ( !empty( $instance['item_text_3'] ) ) : ?>
						<?php echo esc_html( $instance['item_text_3'] ); ?>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				<?php if ( !empty( $instance['item_icon_4'] ) || !empty( $instance['item_text_4'] ) ) : ?>
					<li class="contact-info-item">
						<?php if ( !empty( $instance['item_icon_4'] ) ) : ?>
							<i class="<?php echo esc_attr( $instance['item_icon_4'] ); ?>"></i>
						<?php endif; ?>
						<?php if ( !empty( $instance['item_text_4'] ) ) : ?>
						<?php echo esc_html( $instance['item_text_4'] ); ?>
						<?php endif; ?>
					</li>
				<?php endif; ?>
				</ul>
			</div>

			<?php echo $after_widget;
		}
	}
}
