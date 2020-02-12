<?php

namespace Elementor;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Talemy_Events_Slider extends Widget_Base {

    public function get_name() {
        return 'talemy-events-slider';
    }

    public function get_title() {
        return esc_html__( 'Events Slider', 'talemy' );
    }

    public function get_icon() {
        return 'eicon-countdown sf-addons-label';
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
            'section_events',
            [
                'label' => esc_html__( 'Events', 'talemy' ),
            ]
        );

        $this->add_control(
            'display',
            [
                'label' => esc_html__( 'Display', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'list',
                'options' => [
                    'list' => esc_html__( 'Upcoming Events', 'talemy' ),
                    'past' => esc_html__( 'Past Events', 'talemy' ),
                    'future' => esc_html__( 'Future Events', 'talemy' ),
                    'custom' => esc_html__( 'Custom', 'talemy' ),
                ],
            ]
        );

        $this->add_control(
            'start_date',
            [
                'label' => esc_html__( 'Start Date', 'talemy' ),
                'type' => Controls_Manager::DATE_TIME,
                'default' => '',
            ]
        );

        $this->add_control(
            'end_date',
            [
                'label' => esc_html__( 'End Date', 'talemy' ),
                'type' => Controls_Manager::DATE_TIME,
                'default' => '',
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => esc_html__( 'Featured Events Only', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => esc_html__( 'Number of events to show', 'talemy' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider',
            [
                'label' => esc_html__( 'Slider', 'talemy' ),
                'tab' => Controls_Manager::TAB_CONTENT,
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
                    '' => esc_html__( 'Default', 'talemy' ),
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => '',
                'tablet_default' => 3,
                'mobile_default' => 1,
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label' => esc_html__( 'Sliders To Scroll', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'talemy' ),
                'options' => [
                    1 => esc_html__( '1', 'talemy' ),
                    2 => esc_html__( '2', 'talemy' ),
                    3 => esc_html__( '3', 'talemy' ),
                    4 => esc_html__( '4', 'talemy' ),
                ],
                'condition' => [
                    'slides_per_view!' => '1',
                ],
                'default' => 1,
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
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_height',
            [
                'label' => esc_html__( 'Height', 'talemy' ),
                'type' => Controls_Manager::SLIDER,
                'label_block' => true,
                'selectors' => [
                    '{{WRAPPER}} .events-slider-nav,{{WRAPPER}} .events-slider-item' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'range' => [
                    'px' => [
                        'min' => 150,
                        'max' => 1000,
                    ]
                ]
            ]
        );

        $this->start_controls_tabs( 'content_colors' );

        $this->start_controls_tab(
            'content_normal',
            [
                'label' => esc_html__( 'Normal', 'talemy' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .events-slider .event-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => esc_html__( 'Date', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .events-slider .event-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__( 'Background', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_hover',
            [
                'label' => esc_html__( 'Hover', 'talemy' ),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .events-slider .event-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'date_color_hover',
            [
                'label' => esc_html__( 'Date', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .events-slider .event-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color_hover',
            [
                'label' => esc_html__( 'Background', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ld-category-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .events-slider .event-title',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'selector' => '{{WRAPPER}} .events-slider .event-title',
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
        $slider_settings['autoHeight'] = true;
        $slider_settings['watchOverflow'] = true;
        $slider_settings['slidesPerView'] = !empty( $settings['slides_per_view'] ) ? intval( $settings['slides_per_view'] ) : 4;
        $slider_settings['slidesToScroll'] = !empty( $settings['slides_to_scroll'] ) ? intval( $settings['slides_to_scroll'] ) : 1;
        $slider_settings['loop'] = ( $settings['loop'] == 'yes' );
        $slider_settings['speed'] = isset( $settings['speed'] ) ? $settings['speed'] : 300;
        $slider_settings['breakpoints'] = [
            1024 => [
                'slidesPerView' => !empty( $settings['slides_per_view_tablet'] ) ? intval( $settings['slides_per_view_tablet'] ) : 1,
            ],
            768 => [
                'slidesPerView' => !empty( $settings['slides_per_view_mobile'] ) ? intval( $settings['slides_per_view_mobile'] ) : 1
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
        
        return $slider_settings;
    }

    protected function render() {
        $settings = $this->get_settings();
        $number = !empty( $settings['number'] ) ? $settings['number'] : 4;

        $query_args = array(
            'eventDisplay' => $settings['display'],
            'posts_per_page' => $number,
            'start_date' => current_time( 'timestamp' ),
        );

        if ( !empty( $settings['start_date'] ) ) {
            $query_args['start_date'] = $settings['start_date'];
        }

        if ( !empty( $settings['end_date'] ) ) {
            $query_args['end_date'] = $settings['end_date'];
        }

        if ( isset( $settings['featured'] ) && 'yes' == $settings['featured'] ) {
            $query_args['featured'] = 1;
        }

        $events = tribe_get_events( $query_args );
        
        if ( $events ) : ?>
        
        <div class="events-slider">
            <div class="events-slider-nav">
                <span class="sub"><?php esc_html_e( 'Upcoming', 'talemy' ); ?></span>
                <span class="title"><?php esc_html_e( 'Events', 'talemy' ); ?></span>
                <div class="slider-arrows">
                    <span class="slider-arrow prev-slide"><i class="ticon-angle-left"></i></span>
                    <span class="slider-arrow next-slide"><i class="ticon-angle-right"></i></span>
                </div>
            </div>
            <div class="events-slider-wrapper">
                <div class="swiper-container" data-settings='<?php echo wp_json_encode( $this->get_slider_settings( $settings ) ); ?>'>
                    <div class="swiper-wrapper">
                    <?php foreach ( $events as $event ) : ?>
                        <div class="swiper-slide">
                            <div class="events-slider-item">
                                <a href="<?php echo esc_url( tribe_get_event_link( $event ) ); ?>" title="<?php echo esc_attr( $event->post_title ); ?>" rel="bookmark">
                                    <h3 class="event-title"><?php echo esc_html( $event->post_title ); ?></h3>
                                    <span class="event-date"><i class="far fa-calendar-alt"></i><?php echo tribe_get_start_date( $event ); ?></span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php endif;
    }

    public function get_event_thumbnail() { ?>
        <?php if ( has_post_thumbnail( $event ) ) : ?>
            <div class="post-thumb">
                <a href="<?php echo esc_url( $link ); ?>">
                    <?php echo get_the_post_thumbnail( $event, $settings['thumbnail_size'] ); ?>
                </a>
            </div>
        <?php endif;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Talemy_Events_Slider() );