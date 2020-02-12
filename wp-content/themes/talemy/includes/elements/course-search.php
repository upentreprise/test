<?php

namespace Elementor;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Talemy_Course_Search extends Widget_Base {

    public function get_name() {
        return 'talemy-course-search';
    }

    public function get_title() {
        return esc_html__( 'LearnDash Course Search', 'talemy' );
    }

    public function get_icon() {
        return 'eicon-search sf-addons-label';
    }

    public function get_categories() {
        return array( 'sf-addons' );
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'search_content',
            [
                'label' => esc_html__( 'Search Form', 'talemy' ),
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'talemy' ),
                'type' => Controls_Manager::TEXT,
                'separator' => 'before',
                'default' => esc_html__( 'chercher', 'talemy' ) . '...',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'talemy' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'chercher', 'talemy' ),
                'separator' => 'after',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_input_style',
            [
                'label' => esc_html__( 'Input', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} input[type="search"].course-search__input',
            ]
        );

        $this->start_controls_tabs( 'tabs_input_colors' );

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => esc_html__( 'Normal', 'talemy' ),
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => esc_html__( 'Text Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search .course-search__input' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .course-search__input::-webkit-input-placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .course-search__input::-moz-input-placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .course-search__input:-ms-input-placeholder' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .selectric' => 'color: {{VALUE}}'
                ],
            ]
        );

        $this->add_control(
            'input_background_color',
            [
                'label' => esc_html__( 'Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search .course-search__input' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .selectric' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_border_color',
            [
                'label' => esc_html__( 'Border Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search .course-search__input' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .selectric' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .selectric .button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label' => esc_html__( 'Focus', 'talemy' ),
            ]
        );

        $this->add_control(
            'input_text_color_focus',
            [
                'label' => esc_html__( 'Text Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search .course-search__input:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .selectric-open .selectric' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_background_color_focus',
            [
                'label' => esc_html__( 'Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search .course-search__input:focus' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .selectric-open .selectric' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'input_border_color_focus',
            [
                'label' => esc_html__( 'Border Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-search .course-search__input:focus' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .selectric-open .selectric' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .course-search .selectric-open .selectric .button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_width',
            [
                'label' => esc_html__( 'Border Size', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .course-search .course-search__input:focus' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .course-search .selectric-open .selectric' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Search Button', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label' => esc_html__( 'Button Style', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => sf_get_option_button_styles()
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $this->add_render_attribute(
            'input', [
                'placeholder' => $settings['placeholder'],
                'class' => 'course-search__input',
                'type' => 'search',
                'name' => 's',
                'title' => esc_html__( 'chercher', 'talemy' ),
                'value' => get_search_query(),
            ]
        );

        $this->add_render_attribute( 'button', 'class', [
            'btn btn-block',
            !empty( $settings['button_style'] ) ? 'btn-'. $settings['button_style'] : 'btn-primary'
        ] );

        ?>
        <form class="course-search has-search-button" role="search" action="<?php echo esc_url( home_url() ); ?>" method="get">
            <div class="row sm-gutters">
                <div class="col-md-6 col-lg-3">
                    <select name="ld_course_category" class="course-select__category">
                        <option value="" selected><?php esc_html_e( 'All Categories', 'talemy' ); ?></option>
                    <?php foreach ( talemy_get_ld_option_course_cats( 'slug' ) as $slug => $label ) : ?>
                        <option value="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $label ); ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 col-lg-3">
                    <select name="ld_course_price" class="course-select__price">
                        <option value="" selected><?php esc_html_e( 'All Price', 'talemy' ); ?></option>
                        <option value="free"><?php esc_html_e( 'Free', 'talemy' ); ?></option>
                        <option value="paid"><?php esc_html_e( 'Paid', 'talemy' ); ?></option>
                    </select>
                </div>
                <div class="col-md-6 col-lg-3">
                    <input <?php echo $this->get_render_attribute_string( 'input' ); ?>>
                    <input type="hidden" name="post_type" value="sfwd-courses">
                </div>
                <div class="col-md-6 col-lg-3">
                    <button <?php echo $this->get_render_attribute_string( 'button' ); ?> type="submit"><?php echo esc_html( $settings['button_text'] ); ?></button>
                </div>
            </div>
        </form>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Talemy_Course_Search() );