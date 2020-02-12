<?php

namespace Elementor;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Talemy_Course_Categories extends Widget_Base {

    public function get_name() {
        return 'talemy-course-categories';
    }

    public function get_title() {
        return esc_html__( 'LearnDash Course Categories', 'talemy' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid sf-addons-label';
    }

    public function get_categories() {
        return array( 'sf-addons' );
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    public function get_script_depends() {
        return [
            'talemy',
            'swiper',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__( 'General', 'talemy' ),
            ]
        );

        $this->add_control(
            'categories',
            [
                'label' => esc_html__( 'Categories', 'talemy' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => talemy_get_ld_option_course_cats(),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Layout', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'carousel' => esc_html__( 'Carousel', 'talemy' ),
                    'grid' => esc_html__( 'Grid', 'talemy' ),
                ],
                'default' => 'grid',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1', 'talemy' ),
                    2 => esc_html__( '2', 'talemy' ),
                    3 => esc_html__( '3', 'talemy' ),
                    4 => esc_html__( '4', 'talemy' ),
                    6 => esc_html__( '6', 'talemy' ),
                    '' => esc_html__( 'Default', 'talemy' ),
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '',
                'tablet_default' => '',
                'mobile_default' => 1,
                'condition' => [
                    'layout!' => 'carousel',
                ]
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => esc_html__( 'Show Icon', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider',
            [
                'label' => esc_html__( 'Slider', 'talemy' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => 'carousel',
                ],
            ]
        );

        $this->add_responsive_control(
            'slides_per_view',
            [
                'label' => esc_html__( 'Sliders Per View', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => esc_html__( '1', 'talemy' ),
                    2 => esc_html__( '2', 'talemy' ),
                    3 => esc_html__( '3', 'talemy' ),
                    4 => esc_html__( '4', 'talemy' ),
                    5 => esc_html__( '5', 'talemy' ),
                    6 => esc_html__( '6', 'talemy' ),
                    '' => esc_html__( 'Default', 'talemy' ),
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '',
                'tablet_default' => '',
                'mobile_default' => 1,
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label' => esc_html__( 'Sliders Per Scroll', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'talemy' ),
                'options' => [
                    1 => esc_html__( '1', 'talemy' ),
                    2 => esc_html__( '2', 'talemy' ),
                    3 => esc_html__( '3', 'talemy' ),
                    4 => esc_html__( '4', 'talemy' ),
                    5 => esc_html__( '5', 'talemy' ),
                    6 => esc_html__( '6', 'talemy' ),
                ],
                'condition' => [
                    'slides_per_view!' => '1',
                ],
                'default' => 1,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => esc_html__( 'Arrows', 'talemy' ),
                'default' => 'yes',
                'label_off' => esc_html__( 'Hide', 'talemy' ),
                'label_on' => esc_html__( 'Show', 'talemy' ),
                'frontend_available' => true,
                'prefix_class' => 'sf-arrows--',
                'render_type' => 'template',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__( 'Pagination', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'None', 'talemy' ),
                    'bullets' => esc_html__( 'Dots', 'talemy' ),
                ],
                'prefix_class' => 'sf-pagination--type-',
                'render_type' => 'template',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__( 'Autoplay', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__( 'Autoplay Speed', 'talemy' ),
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
                'label' => esc_html__( 'Infinite Loop', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__( 'Animation Speed', 'talemy' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_items_style',
            [
                'label' => esc_html__( 'Items', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__( 'Padding', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'render_type' => 'template',
            ]
        );

        $this->add_responsive_control(
            'spacing',
            [
                'label' => esc_html__( 'Space Between', 'talemy' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} [class^=col-]' => 'padding-left: calc( {{SIZE}}{{UNIT}}/2 );padding-right: calc( {{SIZE}}{{UNIT}}/2 );margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 );margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'selector' => '{{WRAPPER}} .ld-course-categories .ld-category-name',
            ]
        );

        $this->start_controls_tabs( 'tabs_input_colors' );

        $this->start_controls_tab(
            'tab_item_normal',
            [
                'label' => esc_html__( 'Normal', 'talemy' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item a' => 'border-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .ld-category-item a',
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            [
                'label' => esc_html__( 'Hover', 'talemy' ),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item:hover .ld-category-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label' => esc_html__( 'Text Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item:hover .ld-category-name' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_color_hover',
            [
                'label' => esc_html__( 'Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item a:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .ld-category-item a:hover',
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'border_width',
            [
                'label' => esc_html__( 'Border Width', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .ld-course-categories .ld-category-item a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_icon' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__( 'Position', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => esc_html__( 'Top', 'talemy' ),
                    'left' => esc_html__( 'Left', 'talemy' ),
                    'right' => esc_html__( 'Right', 'talemy' )
                ],
                'default' => 'top',
                'prefix_class' => 'course-categories--icon-',
                'render_type' => 'template',
            ]
        );

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'talemy' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
                ],
				'default' => [
					'size' => 45,
				],
				'selectors' => [
					'{{WRAPPER}} .ld-category-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_style',
            [
                'label' => esc_html__( 'Navigation', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'arrows_skin',
            [
                'label' => esc_html__( 'Arrows Style', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'prefix_class' => 'sf-arrows--skin-',
                'options' => [
                    'default' => esc_html__( 'Default', 'talemy' ),
                    '1' => esc_html__( 'Style 1', 'talemy' ),
                    '2' => esc_html__( 'Style 2', 'talemy' ),
                    '3' => esc_html__( 'Style 3', 'talemy' ),
                ],
                'condition' => [
                    'navigation' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => esc_html__( 'Arrows Color', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'dark',
                'prefix_class' => 'sf-arrows--color-',
                'options' => [
                    'light' => esc_html__( 'Light', 'talemy' ),
                    'dark' => esc_html__( 'Dark', 'talemy' ),
                ],
            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label' => esc_html__( 'Arrows Position', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'prefix_class' => 'sf-arrows--position-',
                'options' => [
                    'default' => esc_html__( 'Default', 'talemy' ),
                    'top_right' => esc_html__( 'Top Right', 'talemy' ),
                    'top_left' => esc_html__( 'Top Left', 'talemy' ),
                    'bottom_right' => esc_html__( 'Bottom Right', 'talemy' ),
                    'bottom_left' => esc_html__( 'Bottom Left', 'talemy' ),
                ],
            ]
        );

		$this->add_control(
			'bullets_color',
			[
				'label' => esc_html__( 'Bullets Color', 'talemy' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'bullets_active_color',
			[
				'label' => esc_html__( 'Bullets Active Color', 'talemy' ),
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

        $spacing_desktop = ( '' != $settings['spacing']['size'] ) ? intval( $settings['spacing']['size'] ) : 1;
        $spacing_tablet = ( '' != $settings['spacing_tablet']['size'] ) ? intval( $settings['spacing_tablet']['size'] ) : $spacing_desktop;
        $spacing_mobile = ( '' != $settings['spacing_mobile']['size'] ) ? intval( $settings['spacing_mobile']['size'] ) : $spacing_tablet;

        $slider_settings['autoHeight'] = false;
        $slider_settings['watchOverflow'] = true;
        $slider_settings['slidesPerView'] = !empty( $settings['slides_per_view'] ) ? intval( $settings['slides_per_view'] ) : 6;
        $slider_settings['slidesToScroll'] = !empty( $settings['slides_to_scroll'] ) ? intval( $settings['slides_to_scroll'] ) : 1;
        $slider_settings['spaceBetween'] = $spacing_desktop;
        $slider_settings['loop'] = ( $settings['loop'] == 'yes' );
        $slider_settings['speed'] = isset( $settings['speed'] ) ? $settings['speed'] : 300;
        $slider_settings['breakpoints'] = [
            1024 => [
                'slidesPerView' => !empty( $settings['slides_per_view_tablet'] ) ? intval( $settings['slides_per_view_tablet'] ) : 1,
                'spaceBetween' => $spacing_tablet,
            ],
            768 => [
                'slidesPerView' => !empty( $settings['slides_per_view_mobile'] ) ? intval( $settings['slides_per_view_mobile'] ) : 1,
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
        $settings = $this->get_settings();
        if ( !empty( $settings['categories'] ) ) {
            $categories = $settings['categories'];
        } else {
            $categories = get_terms( array(
                'taxonomy' => 'ld_course_category',
                'hide_empty' => false,
            ));
        }
        if ( empty( $categories ) ) {
            return;
        }
        ?>
        <div class="ld-course-categories clearfix">
        <?php if ( 'carousel' == $settings['layout'] ) :
            // use unique id selector
            $prev_btn_id = uniqid();
            $next_btn_id = uniqid();
            $pagination_id = uniqid();
            $settings['prev_btn_selector'] = '#sf-swiper-btn-'. $prev_btn_id;
            $settings['next_btn_selector'] = '#sf-swiper-btn-'. $next_btn_id;
            $settings['pagination_selector'] = '#sf-swiper-pagination-'. $pagination_id;
            ?>
            <div class="sf-swiper-container">
                <div class="swiper-container" data-settings='<?php echo wp_json_encode( $this->get_slider_settings( $settings ) ); ?>'>
                    <div class="swiper-wrapper">
                    <?php foreach ( $categories as $category ) : ?>
                        <div class="swiper-slide">
                            <?php $this->display_category_item( $settings, $category ); ?>
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
        <?php else : ?>
            <div class="row">
            <?php foreach ( $categories as $category ) : ?>
                <div class="<?php echo esc_attr( $this->get_column_class( $settings ) ); ?>">
                <?php $this->display_category_item( $settings, $category ); ?>
                </div>
            <?php endforeach; ?>
            </div>
        <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Get column class
     * @param  array $settings  widget settings
     * @return string           column class
     */
    public function get_column_class( $settings ) {
        $classes = '';
        switch ( $settings['columns'] ) {
            case 1: $classes .= 'col-lg-12'; break;
            case 2: $classes .= 'col-lg-6'; break;
            case 3: $classes .= 'col-lg-4'; break;
            case 4: $classes .= 'col-lg-3'; break;
            case 6: $classes .= 'col-lg-2'; break;
            default: $classes .= 'col-lg-2'; break;
        }
        switch ( $settings['columns_tablet'] ) {
            case 1: $classes .= ' col-md-12'; break;
            case 2: $classes .= ' col-md-6'; break;
            case 3: $classes .= ' col-md-4'; break;
            case 4: $classes .= ' col-md-3'; break;
            case 6: $classes .= ' col-md-2'; break;
            default: $classes .= ' col-md-3'; break;
        }
        switch ( $settings['columns_mobile'] ) {
            case 1: $classes .= ' col-12'; break;
            case 2: $classes .= ' col-6'; break;
            case 3: $classes .= ' col-4'; break;
            case 4: $classes .= ' col-3'; break;
            case 6: $classes .= ' col-2'; break;
            default: $classes .= ' col-6'; break;
        }
        return $classes;
    }

    /**
     * Display category item
     * @param  array $settings  widget settings
     * @param  object $item     category object
     */
    public function display_category_item( $settings, $term ) {
        if ( !empty( $term ) ) {
            if ( is_object( $term ) ) {
                $cat = $term;
            } else {
                $cat = get_term( $term, 'ld_course_category' );
                if ( empty( $cat ) || is_wp_error( $cat ) ) {
                    return;
                }
            }
            $icon = get_term_meta( $cat->term_id, '_sf_icon', true );
            $icon_image = get_term_meta( $cat->term_id, '_sf_image_icon', true );
        }
        ?>
        <div class="ld-category-item">
            <a href="<?php echo esc_url( get_term_link( $cat->term_id, 'ld_course_category' ) ); ?>" class="ld-category-link">
                <?php if ( !empty( $settings['show_icon'] ) && 'no' != $settings['show_icon'] ) : ?>
                    <?php if ( !empty( $icon_image ) ) : ?>
                        <span class="ld-category-icon">
                            <?php echo wp_get_attachment_image( $icon_image, $settings['thumbnail_size'] ); ?>
                        </span>
                    <?php elseif ( !empty( $icon ) ) : ?>
                        <span class="ld-category-icon">
                            <i class="<?php echo esc_attr( $icon ); ?>" aria-hidden="true"></i>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>
                <span class="ld-category-name"><?php echo esc_html( $cat->name ); ?></span>
            </a>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Talemy_Course_Categories() );