<?php
if ( !class_exists( 'SF_Widget_Social_Icons' ) ) {

	class SF_Widget_Social_Icons extends SF_Widget {
		
		/**
		 * Widget Constructor
		 */
		function __construct() {

			$fields = array(
				array(
					'name' => esc_html__( 'Title', 'spirit' ),
					'id' => 'title',
					'type' => 'text',
					'class' => 'widefat',
					'std' => '',
					'filter' => 'strip_tags|esc_attr',
				),
				array(
					'name' => esc_html__( 'Icon Style', 'spirit' ),
					'id' => 'style',
					'type' => 'select',
					'class' => 'widefat',
					'fields' => array(
						esc_html__( 'Default', 'spirit' ) => 'default',
						esc_html__( 'Style 1', 'spirit' ) => '1'
					),
					'std' => 'default',
					'filter' => 'esc_attr',
				),
				array(
					'name' => esc_html__( 'Alignment', 'spirit' ),
					'id' => 'align',
					'type' => 'select',
					'class' => 'widefat',
					'fields' => array(
						esc_html__( 'Default', 'spirit' ) => '',
						esc_html__( 'Left', 'spirit' ) => 'left',
						esc_html__( 'Center', 'spirit' ) => 'center',
						esc_html__( 'Right', 'spirit' ) => 'right'
					),
					'std' => 'mods',
					'filter' => 'esc_attr',
				),
				array(
					'name' => esc_html__( 'URL Source', 'spirit' ),
					'desc' => esc_html__( 'Use social links in theme options or add custom links below.', 'spirit' ),
					'id' => 'data_source',
					'type' => 'select',
					'class' => 'widefat',
					'fields' => array(
						esc_html__( 'Theme Option', 'spirit' ) => 'mods',
						esc_html__( 'Custom', 'spirit' ) => 'custom',
					),
					'std' => 'mods',
					'filter' => 'esc_attr',
				)
			);

			foreach ( sf_get_social_icon_names() as $key => $label ) {
				$fields[] = array(
					'name' => $label,
					'id' => $key,
					'type' => 'text',
					'class' => 'widefat',
					'std' => '',
					'filter' => 'esc_url',
				);
			}

			$args = array(
				'label' => 'TS - ' . esc_html__( 'Social Icons', 'spirit' ),
				'description' => esc_html__( 'Displays social icons.', 'spirit' ),
				'slug' => 'sf-social-icons',
				'fields' => $fields
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
			$classes = !empty( $instance['align'] ) ? ' text-'. $instance['align'] : '';
			$classes .= !empty( $instance['style'] ) ? ' sf-social-icons__style-'. $instance['style'] : ' sf-social-icons__style-default';
			$data_source = !empty( $instance['data_source'] ) ? $instance['data_source'] : 'mods';

			echo $before_widget;

			if ( !empty( $title ) ) : ?>
			<h4 class="widget-title"><span class="title"><?php echo esc_html( $title ); ?></span></h4>
			<?php endif;

			if ( 'mods' == $data_source ) {
				sf_site_social_links( $classes );
			} else {
				$social_links = array();
		    	foreach( sf_get_social_icon_names() as $key => $label ) {
		    		if ( !empty( $instance[ $key ] ) ) {
		    			$social_links[ $key ] = $instance[ $key ];
		    		}
		    	}
		       	$social_links_data = sf_get_social_icons_data( $social_links );
		        sf_social_icons( $social_links_data, $classes );
			}
			
			echo $after_widget;
		}
	}
}
