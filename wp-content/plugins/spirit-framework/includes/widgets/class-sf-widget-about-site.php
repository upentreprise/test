<?php
if ( !class_exists( 'SF_Widget_About_Site' ) ) {
	
	class SF_Widget_About_Site extends SF_Widget {
		
		/**
		 * Widget Constructor
		 */
		function __construct() {
			$args = array(
				'label' => 'TS - ' . esc_html__( 'About Site', 'spirit' ),
				'description' => esc_html__( 'About Site.', 'spirit' ),
				'slug' => 'sf-about-site',
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
						'name' => esc_html__( 'Logo', 'spirit' ),
						'id' => 'logo',
						'type' => 'image',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_url',
					),
					array(
						'name' => esc_html__( 'Retina Logo', 'spirit' ),
						'id' => 'retina_logo',
						'type' => 'image',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'esc_url',
					),
					array(
						'name' => esc_html__( 'Logo Width', 'spirit' ),
						'id' => 'logo_width',
						'type' => 'number',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'natural',
					),
					array(
						'name' => esc_html__( 'Logo Height', 'spirit' ),
						'id' => 'logo_height',
						'type' => 'number',
						'class' => 'widefat',
						'std' => '',
						'filter' => 'natural',
					),
					array(
						'name' => esc_html__( 'Site Description', 'spirit' ),
						'id' => 'description',
						'type' => 'textarea',
						'class' => 'widefat',
						'std' => '',
						'rows' => 6,
						'filter' => 'strip_tags|esc_attr',
					),
					array(
						'name' => esc_html__( 'Show Social Icons', 'spirit' ),
						'id' => 'show_social',
						'type' => 'checkbox',
						'std' => 1,
					),
					array(
						'name' => esc_html__( 'Icon Style', 'spirit' ),
						'id' => 'icon_style',
						'type' => 'select',
						'class' => 'widefat',
						'fields' => array(
							esc_html__( 'Default', 'spirit' ) => 'default',
							esc_html__( 'Style 1', 'spirit' ) => '1'
						),
						'std' => 'default',
						'filter' => 'esc_attr',
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
			$logo_url = isset( $instance['logo'] ) ? $instance['logo'] : '';
			$logo_r_url = isset( $instance['retina_logo'] ) ? $instance['retina_logo'] : '';
			$logo_height = isset( $instance['logo_height'] ) ? $instance['logo_height'] : '';
			$logo_width = isset( $instance['logo_width'] ) ? $instance['logo_width'] : '';
			$description = isset( $instance['description'] ) ? $instance['description'] : '';
			$show_social = isset( $instance['show_social'] ) ? (bool)$instance['show_social'] : 1;
			$icon_style = !empty( $instance['icon_style'] ) ? $instance['icon_style'] : 'default';

			$site_title = esc_attr( get_bloginfo( 'name' ) );
			$attr_data = $attr_dimension = $attr_class = '';

			// logo width and height attribute
			if ( !empty( $logo_width ) ) {
				$attr_dimension .= ' width="' . esc_attr( $logo_width ) . '"';
			}

			if ( !empty( $logo_height ) ) {
				$attr_dimension .= ' height="' . esc_attr( $logo_height ) . '"';
			}

			// retina logo url
			if ( !empty( $logo_r_url ) ) {
				$attr_data = ' data-retina="'. esc_url( $logo_r_url ) .'"';

				if ( empty( $logo_url ) ) {
					$logo_url = $logo_r_url;

				} else {
					$attr_class = ' class="logo-retina"';
				}
			}

			echo $before_widget;

			if ( !empty( $title ) ) : ?>

				<h4 class="widget-title"><span class="title"><?php echo esc_html( $title ); ?></span></h4>
			
			<?php endif; ?>

			<div class="about-site-widget">
				<?php if ( !empty( $logo_url ) ) : ?>
				<div class="site-logo-wrapper">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img<?php echo $attr_class . $attr_dimension . $attr_data;// WPCS: XSS ok.?> src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( $site_title ); ?>">
					</a>
				</div>
				<?php endif; ?>

				<?php if ( !empty( $description ) ) : ?>
				<div class="site-description"><?php echo $description; ?></div>
				<?php endif; ?>

				<?php if ( $show_social ) : ?>
				<?php sf_site_social_links( 'site-social sf-social-icons__style-' . $icon_style ); ?>
				<?php endif; ?>

			</div>
			<?php

			echo $after_widget;
		}
	}
}
