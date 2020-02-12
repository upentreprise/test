<?php
if ( !class_exists( 'SF_Widget_About' ) ) {
	
	class SF_Widget_About extends SF_Widget {

		/**
		 * Widget Constructor
		 */
		function __construct() {

			$args = array(
				'label' => 'TS - ' . esc_html__( 'About', 'spirit' ),
				'description' => esc_html__( 'About.', 'spirit' ),
				'slug' => 'sf-about',
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
						'name' => esc_html__( 'About Image', 'spirit' ),
						'id' => 'about_image',
						'type' => 'image',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_url',
					),
					array(
						'name' => esc_html__( 'About Title', 'spirit' ),
						'id' => 'about_title',
						'type' => 'text',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'strip_tags|esc_attr',
					),
					array(
						'name' => esc_html__( 'About Description', 'spirit' ),
						'id' => 'about_description',
						'type' => 'textarea',
						'class' => 'widefat',
						'std' => '',
						'rows' => 6,
						'filter' => 'strip_tags|esc_attr',
					),
					array(
						'name' => esc_html__( 'About Autography', 'spirit' ),
						'id' => 'about_autograph',
						'type' => 'image',
						'class' => 'widefat',
						'std' => '',
					)
				)
			);

			$this->create_widget( $args );

			add_action( 'admin_enqueue_scripts', array( $this, 'media_scripts' ) );
		}

		/**
		 * Enqueue the script needed for image upload
		 * 
		 */
		function media_scripts() {
	    	if ( function_exists( 'wp_enqueue_media' ) ) {
			    wp_enqueue_media();
			}
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
			$about_image = isset( $instance['about_image'] ) ? $instance['about_image'] : '';
			$about_title = isset( $instance['about_title'] ) ? $instance['about_title'] : '';
			$about_description = isset( $instance['about_description'] ) ? $instance['about_description'] : '';
			$about_autograph = isset( $instance['about_autograph'] ) ? $instance['about_autograph'] : '';


			echo $before_widget;

			if ( !empty( $title ) ) : ?>
			
				<h4 class="widget-title"><span class="title"><?php echo esc_html( $title ); ?></span></h4>

			<?php endif; ?>
			
			<div class="about-widget">

			<?php if ( !empty( $about_image ) ): ?>

				<div class="about-image">
					<img src="<?php echo esc_url( $about_image ); ?>" alt="<?php echo esc_attr( $about_title ); ?>">
				</div>

			<?php endif; ?>

			<?php if ( !empty( $about_title ) ): ?>

				<h2 class="about-title"><?php echo esc_html( $about_title ); ?></h2>

			<?php endif; ?>

			<?php if ( !empty( $about_description ) ): ?>
				
				<p class="about-description"><?php echo wp_kses_post( $about_description ); ?></p>

			<?php endif; ?>

			<?php if ( !empty( $about_autograph ) ): ?>

				<div class="about-autograph">
					<img src="<?php echo esc_url( $about_autograph ); ?>" alt="<?php echo esc_attr( $about_title ); ?>">
				</div>

			<?php endif; ?>

			</div>

			<?php echo $after_widget;
		}
	}
}
