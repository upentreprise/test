<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Progress_Bars extends Widget_Base {

    public function get_name() {
        return 'sf-progress-bars';
    }

    public function get_title() {
        return __( 'Progress Bars', 'spirit' );
    }

    public function get_icon() {
        return 'eicon-skill-bar sf-addons-label';
    }

    public function get_categories() {
        return [ 'sf-addons' ];
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    public function get_script_depends() {
        return [
            'sf-frontend'
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_items',
            [
                'label' => esc_html__( 'Progress Bars', 'spirit' ),
            ]
        );

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'title' => esc_html__( 'Photoshop', 'spirit' ),
                        'percent' => 87,
                    ],
                    [
                        'title' => esc_html__( 'Illustrator', 'spirit' ),
                        'percent' => 76,
                    ],
                    [
                        'title' => esc_html__( 'InDesign', 'spirit' ),
                        'percent' => 65,
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'spirit' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Title', 'spirit' ),
                        'dynamic' => [
                            'active' => true,
                        ]
                    ],
                    [
                        'name' => 'percent',
                        'label' => esc_html__( 'Percentage', 'spirit' ),
                        'type' => Controls_Manager::SLIDER,
                        'default' => [
                            'size' => 50,
                            'unit' => '%',
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'bar_color',
                        'label' => esc_html__( 'Bar Color', 'spirit' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '#4054b2',
                        'selectors' => [
                            '{{WRAPPER}} {{CURRENT_ITEM}} .sf-progress-bar' => 'background: {{VALUE}}',
                        ]
                    ],

                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_bar_style',
            [
                'label' => esc_html__( 'Bar', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bar_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-progress-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bar_height',
            [
                'label' => esc_html__( 'Height', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sf-progress-wrapper' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bar_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'spirit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .sf-progress-wrapper, {{WRAPPER}} .sf-progress-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bar_spacing',
            [
                'label' => esc_html__( 'Spacing', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sf-progress-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => esc_html__( 'Text', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-progress-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .sf-progress-title,{{WRAPPER}} .sf-progress-percentage',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => esc_html__( 'Text Position', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'text_top',
                'options' => [
                    'default' => esc_html__( 'Default', 'spirit' ),
                    'text_top' => esc_html__( 'Text Top', 'spirit' )
                ],
                'prefix_class' => 'sf-progress-bar--layout-',
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'display_percentage',
            [
                'label' => esc_html__( 'Display Percentage', 'spirit' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'render_type' => 'template'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display(); ?>

        <div class="sf-progress-bars">
        <?php if ( !empty( $settings['items'] ) ) :
            foreach ( $settings['items'] as $index => $item ) :
                $this->add_render_attribute( 'wrapper_'. $index, [
                    'class' => 'sf-progress-wrapper elementor-repeater-item-'. $item['_id'],
                    'role' => 'progressbar',
                    'aria-valuemin' => '0',
                    'aria-valuemax' => '100',
                    'aria-valuenow' => $item['percent']['size'],
                ] );
                $this->add_render_attribute( 'progress-bar_'. $index, [
                    'class' => 'sf-progress-bar',
                    'data-max' => $item['percent']['size'],
                ]);
            ?>
            <?php if ( 'text_top' === $settings['layout'] ) : ?>
                <div class="sf-progress-text">
                <?php if ( !empty( $item['title'] ) ) : ?>
                    <span class="sf-progress-title"><?php echo esc_html( $item['title' ] ); ?></span>    
                <?php endif; ?>
                <?php if ( 'yes' === $settings['display_percentage'] ) : ?>
                    <span class="sf-progress-percentage"><?php echo esc_html( $item['percent']['size'] ); ?>%</span>    
                <?php endif; ?>
                </div>
            <?php endif; ?>
            <div <?php echo $this->get_render_attribute_string( 'wrapper_'. $index ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'progress-bar_'. $index ); ?>>
                    <?php if ( 'default' === $settings['layout'] ) : ?>
                        <?php if ( !empty( $item['title'] ) ) : ?>
                            <span class="sf-progress-title"><?php echo esc_html( $item['title' ] ); ?></span>    
                        <?php endif; ?>
                        <?php if ( 'yes' === $settings['display_percentage'] ) : ?>
                            <span class="sf-progress-percentage"><?php echo esc_html( $item['percent']['size'] ); ?>%</span>    
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Progress_Bars() );