<?php

namespace Elementor;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Talemy_Events_Countdown extends Widget_Base {

    public function get_name() {
        return 'talemy-events-countdown';
    }

    public function get_title() {
        return esc_html__( 'Events Countdown', 'talemy' );
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

    protected function _register_controls() {
        $this->start_controls_section(
            'section_main',
            [
                'label' => esc_html__( 'Events', 'talemy' ),
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'single-event',
                'options' => [
                    'single-event' => esc_html__( 'Single Event', 'talemy' ),
                    'next-event' => esc_html__( 'Next Event', 'talemy' ),
                    'future-event' => esc_html__( 'Future Event', 'talemy' ),
                ],
            ]
        );

        $this->add_control(
            'event',
            [
                'label' => esc_html__( 'Event', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => talemy_get_option_events(),
                'default' => '',
                'condition' => [
                    'type' => 'single-event',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'talemy_thumb_small',
                'separator' => 'none',
                'exclude' => [ 'custom' ],
            ]
        );

        $this->add_control(
            'show_venue_address',
            [
                'label' => esc_html__( 'Show Venue Address', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'talemy' ),
                'label_off' => esc_html__( 'Hide', 'talemy' ),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_days',
            [
                'label' => esc_html__( 'Days', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'talemy' ),
                'label_off' => esc_html__( 'Hide', 'talemy' ),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_hours',
            [
                'label' => esc_html__( 'Hours', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'talemy' ),
                'label_off' => esc_html__( 'Hide', 'talemy' ),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_minutes',
            [
                'label' => esc_html__( 'Minutes', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'talemy' ),
                'label_off' => esc_html__( 'Hide', 'talemy' ),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_seconds',
            [
                'label' => esc_html__( 'Seconds', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'talemy' ),
                'label_off' => esc_html__( 'Hide', 'talemy' ),
                'default' => 'yes',
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

        $this->add_control(
            'content_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-right' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_timer_style',
            [
                'label' => esc_html__( 'Timer', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .events-countdown-item',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_spacing',
            [
                'label' => esc_html__( 'Space Between', 'talemy' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-item' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'box_width',
            [
                'label' => esc_html__( 'Minimum Width', 'talemy' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-item' => 'min-width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_digits',
            [
                'label' => esc_html__( 'Digits', 'talemy' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'digits_color',
            [
                'label' => esc_html__( 'Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'digits_typography',
                'selector' => '{{WRAPPER}} .events-countdown-digits',
            ]
        );

        $this->add_control(
            'heading_label',
            [
                'label' => esc_html__( 'Label', 'talemy' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .events-countdown-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .events-countdown-label',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        if ( 'next-event' === $settings['type'] || 'future-event' === $settings['type'] ) {
            $upcoming_event = 'future-event' === $settings['type'] ? 'future' : 'list';
            $event = tribe_get_events( array(
                'eventDisplay' => $upcoming_event,
                'posts_per_page' => 1,
                'start_date' => current_time( 'timestamp' )
            ) );
            $event = reset( $event );
        } elseif ( 'single-event' == $settings['type'] && !empty( $settings['event'] ) ) {
            $event = get_post( $settings['event'] );
        }

        if ( empty( $event ) ) {
            esc_html_e( 'No Events Found.', 'talemy' );
            return;
        }

        $link = tribe_get_event_link( $event );
        $venue_details = tribe_get_venue_details( $event->ID );
        $venue_address = tribe_get_address( $event->ID );
        $has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';
        $organizer = tribe_get_organizer( $event->ID );
        $event_start_date = tribe_get_start_date( $event->ID );
        ?>
        <div class="events-countdown">
            <div class="events-countdown-wrapper">
                <div class="events-countdown-left">
                <?php if ( has_post_thumbnail( $event ) ) : ?>
                    <div class="post-thumb">
                        <a href="<?php echo esc_url( $link ); ?>" style="background-image:url(<?php echo get_the_post_thumbnail_url( $event, $settings['thumbnail_size'] ); ?>);"></a>
                    </div>
                <?php endif; ?>
                </div>
                <div class="events-countdown-right">
                    <div class="post-info">
                        <h3 class="post-title">
                            <a class="tribe-event-url" href="<?php echo esc_url( $link ); ?>" title="<?php echo esc_attr( $event->post_title ); ?>" rel="bookmark">
                                <?php echo esc_attr( $event->post_title ); ?>
                            </a>
                        </h3>
                        <div class="post-meta">
                            <!-- Schedule & Recurrence Details -->
                            <div class="tribe-event-schedule-details">
                                <?php echo tribe_events_event_schedule_details( $event ); ?>
                            </div>

                            <?php if ( $settings['show_venue_address'] && $venue_details && !empty( $venue_address ) ) : ?>
                                <!-- Venue Display Info -->
                                <div class="tribe-events-venue-details">
                                    <i class="far fa-compass"></i>
                                <?php
                                    $address_delimiter = empty( $venue_address ) ? ' ' : ', ';

                                    // These details are already escaped in various ways earlier in the process.
                                    echo implode( $address_delimiter, $venue_details );

                                    if ( tribe_show_google_map_link( $event->ID ) ) {
                                        echo tribe_get_map_link_html( $event->ID );
                                    }
                                ?>
                                </div> <!-- .tribe-events-venue-details -->
                            <?php endif; ?>
                        </div>
                        <div class="post-excerpt">
                            <?php echo tribe_events_get_the_excerpt( $event->ID, wp_kses_allowed_html( 'post' ) ); ?>
                        </div>
                        <?php $this->display_countdown_timer( $settings, $event_start_date ); ?>
                        <a href="<?php echo esc_url( $link ); ?>" class="btn btn-secondary" rel="bookmark"><?php esc_html_e( 'Find out more', 'talemy' ) ?> &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function display_countdown_timer( $settings, $due_date ) {
        ?>
        <div class="events-countdown-timer" data-date="<?php echo esc_attr( strtotime( $due_date ) ); ?>">
        <?php
            if ( $settings['show_days'] ) {
                echo $this->get_countdown_item( esc_html__( 'Days', 'talemy' ), 'days' );
            }
            if ( $settings['show_hours'] ) {
                echo $this->get_countdown_item( esc_html__( 'Hours', 'talemy' ), 'hours' );
            }
            if ( $settings['show_minutes'] ) {
                echo $this->get_countdown_item( esc_html__( 'Minutes', 'talemy' ), 'minutes' );
            }
            if ( $settings['show_seconds'] ) {
                echo $this->get_countdown_item( esc_html__( 'Seconds', 'talemy' ), 'seconds' );
            }
        ?>
        </div>
        <?php
    }

    public function get_countdown_item( $label, $part_class ) {
        $out = '<div class="events-countdown-item '. $part_class .'"><span class="events-countdown-digits events-countdown-'. $part_class .'"></span>';
        $out .= '<span class="events-countdown-label">'. $label .'</span>';
        $out .= '</div>';
        return $out;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Talemy_Events_Countdown() );