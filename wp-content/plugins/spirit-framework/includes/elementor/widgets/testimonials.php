<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Testimonials extends Widget_Base {

	public function get_name() {
		return 'sf-testimonials';
	}

	public function get_title() {
		return __( 'Testimonials', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel sf-addons-label';
	}

    public function get_categories() {
        return [ 'sf-addons' ];
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    public function get_script_depends() {
        return [
            'swiper',
            'sf-frontend',
        ];
    } 

	protected function _register_controls() {

        $this->start_controls_section(
            'section_items',
            [
                'label' => esc_attr__( 'Items', 'spirit' ),
            ]
        );

		$this->add_control(
			'items',
			[
				'label' => __( 'Testimonials', 'spirit' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'content',
						'label' => __( 'Content', 'spirit' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => '',
						'label_block' => true,
					],
					[
						'name' => 'image',
						'label' => __( 'Image', 'spirit' ),
						'type' => Controls_Manager::MEDIA,
					],
					[
						'name' => 'name',
						'label' => __( 'Name', 'spirit' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'John Doe',
						'label_block' => true,
					],
					[
						'name' => 'title',
						'label' => __( 'Title', 'spirit' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'CEO',
						'label_block' => true,
					],
				],
				'default' => [
					[
						'name' => 'John Doe',
						'title' => 'CEO',
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
					],
					[
						'name' => 'John Doe',
						'title' => 'CEO',
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
					],
					[
						'name' => 'John Doe',
						'title' => 'CEO',
						'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_attr__( 'General', 'spirit' ),
            ]
        );

		$this->add_control(
			'skin',
			[
				'label' => __( 'Skin', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => __( 'Default', 'spirit' ),
					'card' => __( 'Card', 'spirit' ),
				],
				'prefix_class' => 'sf-testimonial--skin-',
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'image_above',
				'options' => [
					'image_inline' => __( 'Image Inline', 'spirit' ),
					'image_above' => __( 'Image Above', 'spirit' ),
					'image_top' => __( 'Image Top', 'spirit' ),
					'image_left' => __( 'Image Left', 'spirit' ),
					'image_right' => __( 'Image Right', 'spirit' ),
				],
				'prefix_class' => 'sf-testimonial--layout-',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'prefix_class' => 'sf-testimonial--align-',
			]
		);

        $this->add_responsive_control(
            'spacing',
            [
                'label' => __( 'Space Between', 'talemy' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                	'size' => 30,
                	'unit' => 'px',
                ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'render_type' => 'template'
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider',
			[
				'label' => __( 'Slider', 'spirit' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label' => __( 'Sliders Per View', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					1 => __( '1', 'spirit' ),
					2 => __( '2', 'spirit' ),
					3 => __( '3', 'spirit' ),
					4 => __( '4', 'spirit' ),
					5 => __( '5', 'spirit' ),
					6 => __( '6', 'spirit' ),
					'' => __( 'Default', 'spirit' ),
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => '',
				'tablet_default' => '',
				'mobile_default' => 1,
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'slides_to_scroll',
			[
				'label' => __( 'Sliders Per Scroll', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'description' => __( 'Set how many slides are scrolled per swipe.', 'spirit' ),
				'options' => [
					1 => __( '1', 'spirit' ),
					2 => __( '2', 'spirit' ),
					3 => __( '3', 'spirit' ),
					4 => __( '4', 'spirit' ),
					5 => __( '5', 'spirit' ),
					6 => __( '6', 'spirit' ),
					'' => __( 'Default', 'spirit' )
				],
				'condition' => [
					'slides_to_show!' => '1',
				],
				'default' => '',
			]
		);

        $this->add_control(
            'navigation',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => __( 'Arrows', 'spirit' ),
                'default' => 'yes',
                'label_off' => __( 'Hide', 'spirit' ),
                'label_on' => __( 'Show', 'spirit' ),
                'frontend_available' => true,
                'prefix_class' => 'sf-arrows--',
                'render_type' => 'template',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __( 'Pagination', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'None', 'spirit' ),
                    'bullets' => __( 'Dots', 'spirit' ),
                ],
                'prefix_class' => 'sf-pagination--type-',
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Autoplay', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'spirit' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label' => __( 'Infinite Loop', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

        $this->add_control(
            'fade',
            [
                'label' => __( 'Fade', 'spirit' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => [
                    'slides_to_show' => '1',
                ],
            ]
        );

		$this->add_control(
			'speed',
			[
				'label' => __( 'Animation Speed', 'spirit' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 300,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_items_style',
			[
				'label' => __( 'Content', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-testimonial' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-testimonial__text' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .sf-testimonial__text',
			]
		);

		$this->add_control(
			'name_style',
			[
				'label' => __( 'Name', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-testimonial__name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .sf-testimonial__name',
			]
		);

		$this->add_control(
			'title_style',
			[
				'label' => __( 'Title', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-testimonial__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' => __( 'Image', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_size',
			[
				'label' => __( 'Image Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-testimonial__image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .sf-testimonial__image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}}.sf-testimonial--layout-image_above .sf-testimonial__image' => 'top: calc({{SIZE}}{{UNIT}} * 0.5 - {{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'image_gap',
			[
				'label' => __( 'Image Gap', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.sf-testimonial--layout-image_left .sf-testimonial__content' => 'padding-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.sf-testimonial--layout-image_right .sf-testimonial__content' => 'padding-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.sf-testimonial--layout-image_top .sf-testimonial__image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.sf-testimonial--layout-image_above.sf-testimonial--skin-card .has-image .sf-testimonial__content' => 'padding-top:{{SIZE}}{{UNIT}}!important;',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_style',
            [
                'label' => esc_attr__( 'Navigation', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

		$this->add_control(
			'arrows_skin',
			[
				'label' => __( 'Arrows Skin', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'prefix_class' => 'sf-arrows--skin-',
				'options' => [
					'default' => __( 'Default', 'spirit' ),
					'1' => __( 'Style 1', 'spirit' ),
					'2' => __( 'Style 2', 'spirit' ),
					'3' => __( 'Style 3', 'spirit' ),
				],
			]
		);

        $this->add_control(
            'arrows_color',
            [
                'label' => __( 'Arrows Color', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'dark',
                'prefix_class' => 'sf-arrows--color-',
                'options' => [
                    'light' => __( 'Light', 'spirit' ),
                    'dark' => __( 'Dark', 'spirit' ),
                ],
            ]
        );

		$this->add_control(
			'arrows_position',
			[
				'label' => __( 'Arrows Position', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'prefix_class' => 'sf-arrows--position-',
				'options' => [
					'default' => __( 'Default', 'spirit' ),
					'top_right' => __( 'Top Right', 'spirit' ),
					'top_left' => __( 'Top Left', 'spirit' ),
					'bottom_right' => __( 'Bottom Right', 'spirit' ),
					'bottom_left' => __( 'Bottom Left', 'spirit' ),
				],
			]
		);


		$this->add_responsive_control(
			'arrows_offset',
			[
				'label' => __( 'Arrows Offset', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%' ],
				'selectors' => [
					'{{WRAPPER}}.sf-arrows--position-default .sf-swiper-btn' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'bullets_color',
			[
				'label' => __( 'Bullets Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'bullets_active_color',
			[
				'label' => __( 'Bullets Active Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-swiper-pagination .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				]
			]
		);

        $this->end_controls_section();
	}


    /**
     * Get slider settings
     * @param  array $settings  widget settings
     * @return array            slider settings
     */
    public function get_slider_settings( $settings ) {
        $slider_settings = [];

        $spacing_desktop = ( '' != $settings['spacing']['size'] ) ? $settings['spacing']['size'] : 30;
        $spacing_tablet = ( '' != $settings['spacing_tablet']['size'] ) ? $settings['spacing_tablet']['size'] : $spacing_desktop;
        $spacing_mobile = ( '' != $settings['spacing_mobile']['size'] ) ? $settings['spacing_mobile']['size'] : $spacing_tablet;

        $slider_settings['autoHeight'] = true;
        $slider_settings['watchOverflow'] = true;
        $slider_settings['slidesPerView'] = !empty( $settings['slides_to_show'] ) ? intval( $settings['slides_to_show'] ) : 3;
        $slider_settings['slidesToScroll'] = !empty( $settings['slides_to_scroll'] ) ? intval( $settings['slides_to_scroll'] ) : 1;
        $slider_settings['spaceBetween'] = $spacing_desktop;
        $slider_settings['loop'] = ( $settings['loop'] == 'yes' );
        $slider_settings['speed'] = isset( $settings['speed'] ) ? $settings['speed'] : 300;
        $slider_settings['breakpoints'] = [
            1024 => [
                'slidesPerView' => !empty( $settings['slides_to_show_tablet'] ) ? intval( $settings['slides_to_show_tablet'] ) : 1,
                'spaceBetween' => $spacing_tablet,
            ],
            768 => [
                'slidesPerView' => !empty( $settings['slides_to_show_mobile'] ) ? intval( $settings['slides_to_show_mobile'] ) : 1,
                'spaceBetween' => $spacing_mobile,
            ]
        ];
        
        if ( 'yes' == $settings['autoplay'] ) {
        	if ( !empty( $settings['autoplay_speed'] ) ) {
        		$slider_settings['autoplay'] = [
        			'delay' => intval( $settings['autoplay_speed'] )
        		];
        	} else {
        		$slider_settings['autoplay'] = true;
        	}
        }

        if ( 'yes' == $settings['fade'] ) {
        	$slider_settings['effect'] = 'fade';
        }

        if ( !empty( $settings['navigation'] ) ) {
            $slider_settings['navigation'] = [
            	'prevEl' => $settings['prev_btn_selector'],
                'nextEl' => $settings['next_btn_selector'],
            ];
        }

        if ( 'bullets' == $settings['pagination'] ) {
            $slider_settings['pagination'] = [
                'el' => $settings['pagination_selector'],
                'clickable' => true,
                'type' => 'bullets',
            ];
        }
        
        return $slider_settings;
    }

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['items'] ) ) {
			return;
		}

		$image_top = false;

		if ( 'image_above' == $settings['layout'] || 'image_top' == $settings['layout'] ) {
			$image_top = true;
		}

		// use unique id selector
        $prev_btn_id = uniqid();
        $next_btn_id = uniqid();
        $pagination_id = uniqid();
        $settings['prev_btn_selector'] = '#sf-swiper-btn-'. $prev_btn_id;
        $settings['next_btn_selector'] = '#sf-swiper-btn-'. $next_btn_id;
        $settings['pagination_selector'] = '#sf-swiper-pagination-'. $pagination_id;

		?>
		<div class="sf-testimonials clearfix">
			<div class="sf-swiper-container">
				<div class="swiper-container" data-settings='<?php echo wp_json_encode( $this->get_slider_settings( $settings ) ); ?>'>
					<div class="swiper-wrapper">
					<?php foreach ( $settings['items'] as $item ) : ?>
						<div class="swiper-slide">
							<div class="sf-testimonial<?php if ( $item['image']['url'] ) { echo ' has-image'; } ?>">
								<div class="sf-testimonial__content">
									<?php if ( $item['image']['url'] && $image_top ) : ?>
									<div class="sf-testimonial__image">
										<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_html( $item['title'] ); ?>">
									</div>
									<?php endif; ?>
									<div class="sf-testimonial__text">
										<?php echo esc_html( $item['content'] ); ?>
									</div>
									<?php if ( 'image_inline' != $settings['layout'] ) : ?>
										<cite class="sf-testimonial__cite">
										<?php if ( !empty( $item['name'] ) ) : ?>
											<span class="sf-testimonial__name"><?php echo esc_html( $item['name'] ); ?></span>
										<?php endif; ?>
										<?php if ( !empty( $item['title'] ) ) : ?>
											<span class="sf-testimonial__title"><?php echo esc_html( $item['title'] ); ?></span>
										<?php endif; ?>
										</cite>
									<?php endif; ?>
								</div>
								<div class="sf-testimonial__footer">
									<?php if ( $item['image']['url'] && !$image_top ) : ?>
									<div class="sf-testimonial__image">
										<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_html( $item['title'] ); ?>">
									</div>
									<?php endif; ?>
									<?php if ( 'image_inline' == $settings['layout'] ) : ?>
										<cite class="sf-testimonial__cite">
										<?php if ( !empty( $item['name'] ) ) : ?>
											<span class="sf-testimonial__name"><?php echo esc_html( $item['name'] ); ?></span>
										<?php endif; ?>
										<?php if ( !empty( $item['title'] ) ) : ?>
											<span class="sf-testimonial__title"><?php echo esc_html( $item['title'] ); ?></span>
										<?php endif; ?>
										</cite>
									<?php endif; ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
                <?php if ( 'bullets' == $settings['pagination'] ) : ?>
                    <div id="sf-swiper-pagination-<?php echo esc_attr( $pagination_id ) ?>" class="sf-swiper-pagination"></div>
                <?php endif; ?>
                <?php if ( isset( $settings['navigation'] ) && $settings['navigation'] ) : ?>
                    <div id="sf-swiper-btn-<?php echo esc_attr( $prev_btn_id ) ?>" class="sf-swiper-btn sf-swiper-btn-prev"><span class="prev"><?php esc_html_e( 'Prev', 'talemy' ); ?></span></div>
                    <div id="sf-swiper-btn-<?php echo esc_attr( $next_btn_id ) ?>" class="sf-swiper-btn sf-swiper-btn-next"><span class="next"><?php esc_html_e( 'Next', 'talemy' ); ?></span></div>
                <?php endif; ?>
			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Testimonials() );