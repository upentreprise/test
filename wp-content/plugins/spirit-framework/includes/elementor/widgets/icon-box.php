<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Icon_Box extends Widget_Base {

	public function get_name() {
		return 'sf-icon-box';
	}

	public function get_title() {
		return __( 'Icon Box', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-icon-box sf-addons-label';
	}

    public function get_categories() {
        return [ 'sf-addons' ];
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

	public static function default_icon_control() {
		return apply_filters( 'sf_elementor_default_icon_control', false );
	}

	/**
	 * Register icon box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon', 'spirit' ),
			]
		);

  		$this->add_control(
		  	'icon_position',
		  	[
		   	'label' => esc_html__( 'Icon Position', 'spirit' ),
		     	'type' => Controls_Manager::SELECT,
		     	'default' => 'top',
		     	'label_block' => false,
		     	'options' => [
		     		'top' => esc_html__( 'Top', 'spirit' ),
		     		'left' => esc_html__( 'Left', 'spirit' ),
		     		'right' => esc_html__( 'Right', 'spirit' ),
		     	],
		     	'prefix_class' => 'sf-position-',
		  	]
		);

  		$this->add_control(
		  	'icon_type',
		  	[
		   	'label' => esc_html__( 'Icon Type', 'spirit' ),
		     	'type' => Controls_Manager::SELECT,
		     	'default' => 'icon',
		     	'label_block' => false,
		     	'options' => [
		     		'' => esc_html__( 'None', 'spirit' ),
		     		'icon' => esc_html__( 'Icon', 'spirit' ),
		     		'image' => esc_html__( 'Image', 'spirit' ),
		     		'number' => esc_html__( 'Number', 'spirit' ),
		     	],
		  	]
		);

		if ( self::default_icon_control() ) {
			$this->add_control(
				'selected_icon',
				[
					'label' => __( 'Choose Icon', 'spirit' ),
					'type' => Controls_Manager::ICONS,
					'default' => 'fas fa-dove',
					'condition' => [
						'icon_type' => 'icon'
					]
				]
			);
		} else {
			$this->add_control(
				'icon',
				[
					'label' => __( 'Choose Icon', 'spirit' ),
					'type' => 'sf_icon',
					'default' => 'fas fa-dove',
					'condition' => [
						'icon_type' => 'icon'
					]
				]
			);
		}

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'spirit' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->add_control(
			'number',
			[
				'label' => __( 'Number', 'spirit' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 0.01,
				'default' => 0,
				'condition' => [
					'icon_type' => 'number'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'spirit' ),
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title & Description', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Heading text', 'spirit' ),
				'placeholder' => __( 'Enter your title', 'spirit' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'spirit' ),
				'placeholder' => __( 'Enter your description', 'spirit' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link to', 'spirit' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'spirit' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title HTML Tag', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_layout',
			[
				'label' => __( 'Icon Box', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'h_alignment',
			[
				'label' => __( 'Horiziontal Align', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'spirit' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'spirit' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'spirit' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__wrapper' => 'text-align: {{VALUE}};',
				],
				'label_block' => false
			]
		);

		$this->add_control(
			'v_alignment',
			[
				'label' => __( 'Vertical Align', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'spirit' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'spirit' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'spirit' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'prefix_class' => 'sf-vertical-align-',
				'condition' => [
					'icon_position!' => 'top',
				]
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'bg_colors' );

		$this->start_controls_tab(
			'bg_color_normal',
			[
				'label' => __( 'Normal', 'spirit' ),
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'bg_color_hover',
			[
				'label' => __( 'Hover', 'spirit' ),
			]
		);

		$this->add_control(
			'hover_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'hover_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover',
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__content .sf-icon-box__title:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'spirit' ),
					'stacked' => __( 'Stacked', 'spirit' ),
					'framed' => __( 'Framed', 'spirit' ),
				],
				'default' => 'default',
				'prefix_class' => 'sf-view-'
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'spirit' ),
					'square' => __( 'Square', 'spirit' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default'
				],
				'prefix_class' => 'sf-shape-',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .sf-icon-number',
				'condition' => [
					'icon_type' => 'number',
				]
			]
		);

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'spirit' ),
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.sf-view-stacked .sf-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.sf-view-framed .sf-icon, {{WRAPPER}}.sf-view-default .sf-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.sf-view-framed .sf-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.sf-view-stacked .sf-icon' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => __( 'Hover', 'spirit' ),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.sf-view-stacked .elementor-widget-container:hover .sf-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.sf-view-framed .elementor-widget-container:hover .sf-icon, {{WRAPPER}}.sf-view-default .elementor-widget-container:hover .sf-icon' => 'color: {{VALUE}};border-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.sf-view-framed .elementor-widget-container:hover .sf-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.sf-view-stacked .elementor-widget-container:hover .sf-icon' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'spirit' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.sf-position-right .sf-icon-box__icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.sf-position-left .sf-icon-box__icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.sf-position-top .sf-icon-box__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .sf-icon-box__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .sf-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .sf-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .sf-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'spirit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'spirit' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => __( 'Opacity', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__icon img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .sf-icon-box__icon img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'spirit' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => __( 'Opacity', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__icon img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .sf-icon-box__icon img:hover',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__icon img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'spirit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__desc' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__content .sf-icon-box__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .sf-icon-box__content .sf-icon-box__title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sf-icon-box__content .sf-icon-box__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .sf-icon-box__content .sf-icon-box__desc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_advanced',
			[
				'label' => __( 'Advanced', 'spirit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'css_classes',
			[
				'label' => __( 'CSS Classes', 'spirit' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$has_link = ! empty( $settings['link']['url'] );

		if ( $has_link ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'title_text', 'class', 'sf-icon-box__title' );
		$this->add_inline_editing_attributes( 'title_text' );
        
        $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string( 'title_text' ), $settings['title_text'] );
        $desc_html = '';

        if ( !empty( $settings['description_text'] ) ) {
        	$this->add_render_attribute( 'description_text', 'class', 'sf-icon-box__desc' );
        	$this->add_inline_editing_attributes( 'description_text' );
        	$desc_html = sprintf( '<div %1$s>%2$s</div>', $this->get_render_attribute_string( 'description_text' ), $settings['description_text'] );
        }

        $this->add_render_attribute( 'icon_box_class', 'class', [ 'sf-icon-box', $settings['css_classes'] ] );

		?>
		<div <?php echo $this->get_render_attribute_string( 'icon_box_class' ); ?>>
			<?php if ( $has_link ) : ?>
			<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
			<?php endif; ?>
				<div class="sf-icon-box__wrapper equal-height">
					
					<?php if ( 'icon' == $settings['icon_type'] && !empty( $settings['icon'] ) || !empty( $settings['selected_icon']['value'] ) ) :
							$this->add_render_attribute( 'icon', 'class', [ 'sf-icon', 'elementor-animation-' . $settings['hover_animation'] ] );
						?>
						<div class="sf-icon-box__icon">
							<span <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
								<?php if ( !empty( $settings['selected_icon']['value'] ) ) : ?>
									<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								<?php elseif ( !empty( $settings['icon'] ) ) : ?>
									<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
								<?php endif; ?>
							</span>
						</div>
					
					<?php elseif ( 'image' === $settings['icon_type'] && !empty( $settings['image']['url'] ) ) :
						
						$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
						$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
						$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

						if ( $settings['hover_animation'] ) {
							$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );
						}
						$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
			 		?>
						<div class="sf-icon-box__icon"><?php echo $image_html; ?></div>
					
					<?php elseif ( 'number' === $settings['icon_type'] && !empty( $settings['number'] ) ) :
						
						$this->add_render_attribute( 'number', 'class', [ 'sf-icon', 'elementor-animation-' . $settings['hover_animation'] ] );
						?>
						<div class="sf-icon-box__icon">
							<span <?php echo $this->get_render_attribute_string( 'number' ); ?>>
								<i class="sf-icon-number"><?php echo esc_html( $settings['number'] ); ?></i>
							</span>
						</div>

					<?php endif; ?>

					<div class="sf-icon-box__content">
						<?php echo $title_html; ?>
						<?php echo $desc_html; ?>
					</div>
				</div>
			<?php if ( $has_link ) : ?>
			</a>
			<?php endif; ?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Icon_Box() );