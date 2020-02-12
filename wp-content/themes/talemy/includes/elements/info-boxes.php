<?php

namespace Elementor;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Talemy_Info_Boxes extends Widget_Base {

    public function get_name() {
        return 'talemy-info-boxes';
    }

    public function get_title() {
        return esc_attr__( 'Info Boxes', 'talemy' );
    }

    public function get_icon() {
        return 'eicon-icon-box sf-addons-label';
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
            'section_content',
            [
                'label' => esc_html__( 'Content', 'talemy' ),
            ]
        );

        $this->add_control(
            'heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Title', 'talemy' ),
                'default' => esc_html__( 'Section Heading', 'talemy' ),
            ]
        );

        $this->add_control(
            'desc',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__( 'Content', 'talemy' ),
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__( 'Item List', 'talemy' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'talemy' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => '',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'icon',
                        'label' => esc_html__( 'Choose Icon', 'talemy' ),
                        'type' => 'sf_icon',
                        'default' => 'fas fa-dove',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'image',
                        'label' => esc_html__( 'Choose Image', 'talemy' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => '',
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__( 'Link to', 'talemy' ),
                        'type' => Controls_Manager::URL,
                        'dynamic' => [
                            'active' => true,
                        ],
                        'placeholder' => esc_html__( 'https://your-link.com', 'talemy' ),
                    ]
                ],
                'default' => [
                    [
                        'title' => 'Science',
                        'icon' => 'ticon-stationery',
                        'link' => '#',
                    ],
                    [
                        'title' => 'Art',
                        'icon' => 'ticon-canvas',
                        'link' => '#',
                    ],
                    [
                        'title' => 'Technology',
                        'icon' => 'ticon-cloud-computing',
                        'link' => '#',
                    ],
                ],
                'title_field' => '{{{ title }}}',
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
                'tablet_default' => 1,
                'mobile_default' => 1
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
            'section_box_style',
            [
                'label' => esc_html__( 'Box', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

         $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .info-box a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .info-box-title',
                'separator' => 'before',
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
        $slider_settings['slidesPerView'] = !empty( $settings['slides_per_view'] ) ? $settings['slides_per_view'] : 3;
        $slider_settings['slidesPerGroup'] = !empty( $settings['slides_to_scroll'] ) ? $settings['slides_to_scroll'] : 1;
        $slider_settings['spaceBetween'] = 20;
        $slider_settings['loop'] = ( $settings['loop'] == 'yes' );
        $slider_settings['speed'] = isset( $settings['speed'] ) ? $settings['speed'] : 300;
        $slider_settings['breakpoints'] = [
            1024 => [
                'slidesPerView' => !empty( $settings['slides_per_view_tablet'] ) ? $settings['slides_per_view_tablet'] : 2,
            ],
            768 => [
                'slidesPerView' => !empty( $settings['slides_per_view_mobile'] ) ? $settings['slides_per_view_mobile'] : 1
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
        
        if ( !empty( $settings['items'] ) ) : ?>
        
        <div class="info-boxes">
            <div class="info-boxes-summary">
                <?php if ( !empty( $settings['heading'] ) ) {
                    echo '<div class="sf-heading text-center text-md-left"><h2 class="sf-heading__title">'. esc_html( $settings['heading'] ) .'</h2><div class="sf-heading__bottom"><span class="sf-heading__line"></span></div></div>';
                } ?>
                <?php if ( !empty( $settings['desc'] ) ) : ?>
                <div class="summary">
                    <?php echo esc_html( $settings['desc'] ); ?>
                </div>
                <?php endif; ?>
                <div class="slider-arrows">
                    <span class="slider-arrow prev-slide"><i class="arrow-icon ticon-angle-left"></i></span>
                    <span class="slider-arrow next-slide"><i class="arrow-icon ticon-angle-right"></i></span>
                </div>
            </div>
            <div class="info-boxes-wrapper">
                <div class="swiper-container" data-settings='<?php echo wp_json_encode( $this->get_slider_settings( $settings ) ); ?>'>
                    <div class="swiper-wrapper">
                    <?php foreach ( $settings['items'] as $item ) : ?>
                    <?php $has_link = !empty( $item['link']['url'] ); ?>
                        <div class="swiper-slide">
                            <div class="info-box">
                            <?php if ( $has_link ) : ?>
                                <a href="<?php echo esc_url( $item['link']['url'] ); ?>" <?php if ( $item['link']['is_external'] ) : ?> target="_blank"<?php endif; if ( !empty( $item['link']['nofollow'] ) ) : ?> rel="nofollow"<?php endif; ?>>
                            <?php else: ?>
                                <a href="javascript:void(0)">
                            <?php endif; ?>
                                <div class="info-box-icon">
                                <?php if ( !empty( $item['icon'] ) ) : ?>
                                    <i class="<?php echo esc_html( $item['icon'] ); ?>"></i>
                                <?php elseif ( !empty( $item['image']['url'] ) ) : ?>
                                <?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
                                <?php endif; ?>
                                </div>
                                <h3 class="info-box-title"><?php echo wp_kses_post( $item['title'] ); ?></h3>
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
}

Plugin::instance()->widgets_manager->register_widget_type( new Talemy_Info_Boxes() );