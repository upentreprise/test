<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Heading extends Widget_Base {

    public function get_name() {
        return 'sf-heading';
    }

    public function get_title() {
        return __( 'Heading', 'spirit' );
    }

    public function get_icon() {
        return 'eicon-t-letter sf-addons-label';
    }

    public function get_categories() {
        return [ 'sf-addons' ];
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Heading', 'spirit' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Heading', 'spirit' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'Enter your title', 'spirit' ),
                'default' => __( 'Add Your Heading Text Here', 'spirit' ),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __( 'Subheading', 'spirit' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your subtitle', 'spirit' ),
                'description' => __( 'A subtitle displayed above the heading title.', 'spirit' ),
            ]
        );

        $this->add_control(
            'short_text',
            [
                'label' => __( 'Short Text', 'spirit' ),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Enter your short text', 'spirit' ),
                'description' => __( 'Short text generally displayed below the heading title.', 'spirit' ),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'spirit' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'spirit' ),
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'HTML Tag', 'spirit' ),
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
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'spirit' ),
                'type' => Controls_Manager::CHOOSE,
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
                    ]
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_decoration',
            [
                'label' => __( 'Decoration', 'spirit' ),
            ]
        );

        $this->add_control(
            'decor_style',
            [
                'label' => __( 'Style', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'spirit' ),
                    'top_line' => __( 'Top line', 'spirit' ),
                    'bottom_line' => __( 'Bottom line', 'spirit' ),
                    'image' => __( 'Image', 'spirit' )
                ],
                'default' => 'none',
                'prefix_class' => 'sf-heading--decor-',
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'top_image',
            [
                'label' => __( 'Top Image', 'spirit' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'decor_style' => 'image'
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'bottom_image',
            [
                'label' => __( 'Bottom Image', 'spirit' ),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'decor_style' => 'image'
                ],
                'render_type' => 'template'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Heading', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-heading__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_highlight_color',
            [
                'label' => __( 'Highlight Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-heading__title span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .sf-heading__title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .sf-heading__title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_subtitle_style',
            [
                'label' => __( 'Subheading', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-heading__subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .sf-heading__subtitle',
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
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
                    '{{WRAPPER}} .sf-heading__subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_short_text_style',
            [
                'label' => __( 'Short text', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'short_text_color',
            [
                'label' => __( 'Text Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-heading__text span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_text_typography',
                'selector' => '{{WRAPPER}} .sf-heading__text span',
            ]
        );

        $this->add_responsive_control(
            'short_text_spacing',
            [
                'label' => __( 'Spacing', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sf-heading__text' => 'margin-top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_decor_style',
            [
                'label' => __( 'Decoration', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label' => __( 'Line Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-heading__line' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'line_height',
            [
                'label' => esc_html__( 'Line Height', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => [
                    'size' => 2,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [ 
                    '{{WRAPPER}} .sf-heading__line' => 'height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'line_width',
            [
                'label' => esc_html__( 'Line Width', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'default' => [
                    'size' => 60,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [ 
                    '{{WRAPPER}} .sf-heading__line' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'top_decor_spacing',
            [
                'label' => __( 'Top Spacing', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sf-heading__top' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bottom_decor_spacing',
            [
                'label' => __( 'Bottom Spacing', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sf-heading__bottom' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render heading widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( empty( $settings['title'] ) ) {
            return;
        }

        $this->add_inline_editing_attributes( 'title' );
        $this->add_inline_editing_attributes( 'subtitle' );
        $this->add_render_attribute( 'title', 'class', 'sf-heading__title' );
        $this->add_render_attribute( 'subtitle', 'class', 'sf-heading__subtitle' );
        $this->add_render_attribute( 'short_text', 'class', 'sf-heading__text' );

        $title = $settings['title'];

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_render_attribute( 'url', 'href', $settings['link']['url'] );

            if ( $settings['link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }

            $title = sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $title );
        }

        $title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['title_tag'], $this->get_render_attribute_string( 'title' ), $title );

        $subtitle_html = $short_text_html = $top_decor_html = $bottom_decor_html = '';

        if ( !empty( $settings['decor_style'] ) ) {
            
            switch ( $settings['decor_style'] ) {
                
                case 'top_line':
                    $top_decor_html .= '<div class="sf-heading__top"><span class="sf-heading__line"></span></div>';
                    break;

                case 'bottom_line':
                    $bottom_decor_html .= '<div class="sf-heading__bottom"><span class="sf-heading__line"></span></div>';
                    break;

                case 'image':
                    if ( $settings['top_image']['url'] ) {
                        $top_decor_html .= '<div class="sf-heading__top"><img src="'. esc_url( $settings['top_image']['url'] ) .'" alt="heading decoration"></div>';
                    }
                    if ( $settings['bottom_image']['url'] ) {
                        $bottom_decor_html .= '<div class="sf-heading__bottom"><img src="'. esc_url( $settings['bottom_image']['url'] ) .'" alt="heading decoration"></div>';
                    }
                    break;
            }
        }

        if ( !empty( $settings['subtitle'] ) ) {
            $subtitle_html .= sprintf( '<span %1$s>%2$s</span>', $this->get_render_attribute_string( 'subtitle' ), $settings['subtitle'] );
        }

        if ( !empty( $settings['short_text'] ) ) {
            $short_text_html .= sprintf( '<div %1$s><span>%2$s</span></div>', $this->get_render_attribute_string( 'short_text' ), $settings['short_text'] );
        }

        ?>
        <div class="sf-heading">
            <?php echo $top_decor_html; ?>
            <?php echo $subtitle_html; ?>
            <?php echo $title_html; ?>
            <?php echo $short_text_html; ?>
            <?php echo $bottom_decor_html; ?>
        </div>
        <?php
    }

    /**
     * Render heading widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _content_template() {
        ?>
        <#
        var title = settings.title;

        if ( '' !== settings.link.url ) {
            title = '<a href="' + settings.link.url + '">' + title + '</a>';
        }

        view.addRenderAttribute( 'title', 'class', 'sf-heading__title' );
        view.addInlineEditingAttributes( 'title' );
        view.addRenderAttribute( 'subtitle', 'class', 'sf-heading__subtitle' );
        view.addInlineEditingAttributes( 'subtitle' );
        view.addRenderAttribute( 'short_text', 'class', 'sf-heading__text' );

        var title_html = '<' + settings.title_tag  + ' ' + view.getRenderAttributeString( 'title' ) + '>' + title + '</' + settings.title_tag + '>';

        var subtitle_html = '';
        
        #>
        <div class="sf-heading">
            <# if ( '' !== settings.decor_style ) { #>
                <# if ( 'top_line' == settings.decor_style ) { #>
                    <div class="sf-heading__top"><span class="sf-heading__line"></span></div>
                <# } else if ( 'image' == settings.decor_style && settings.top_image.url ) { #>
                    <div class="sf-heading__top">
                        <img src="{{ settings.top_image.url }}" alt="heading decoration">
                    </div>
                <# } #>
            <# } #>
            <# if ( settings.subtitle ) { #>
                <span {{{ view.getRenderAttributeString( 'subtitle' ) }}}>{{{ settings.subtitle }}}</span>
            <# } #>
            {{{ title_html }}}
            <# if ( settings.short_text ) { #>
                <div {{{ view.getRenderAttributeString( 'short_text' ) }}}><span>{{{ settings.short_text }}}</span></div>
            <# } #>
            <# if ( '' !== settings.decor_style ) { #>
                <# if ( 'bottom_line' == settings.decor_style ) { #>
                    <div class="sf-heading__bottom"><span class="sf-heading__line"></span></div>
                <# } else if ( 'image' == settings.decor_style && settings.bottom_image.url ) { #>
                    <div class="sf-heading__bottom">
                        <img src="{{ settings.bottom_image.url }}" alt="heading decoration">
                    </div>
                <# } #>
            <# } #>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Heading() );
