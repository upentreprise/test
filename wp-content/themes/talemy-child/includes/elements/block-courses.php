<?php

namespace Elementor;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Talemy_Block_Courses extends Widget_Base {

    public function get_name() {
        return 'talemy-block-courses';
    }

    public function get_title() {
        return esc_html__( 'Block Courses', 'talemy' );
    }

    public function get_icon() {
        return 'eicon-text-area sf-addons-label';
    }

    public function get_categories() {
        return array( 'sf-addons' );
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    public function get_script_depends() {
        return [
            'talemy-block',
            'talemy'
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
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Block Title', 'talemy' ),
                'default' => esc_html__( 'Block Title', 'talemy' ),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__( 'Block Subtitle', 'talemy' ),
                'default' => '',
            ]
        );

        $this->add_control(
            'list_style',
            [
                'label' => esc_html__( 'List Style', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__( 'Grid 1', 'talemy' ),
                    'grid2' => esc_html__( 'Grid 2', 'talemy' ),
                    'list' => esc_html__( 'List', 'talemy' ),
                ),
                'default' => 'grid'
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'condition' => [
                    'list_style!' => 'list',
                ]
            ]
        );

        $this->add_responsive_control(
            'spacing',
            [
                'label' => esc_html__( 'Space Between', 'talemy' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [ 'size' => 30 ],
                'tablet_default' => [ 'size' => 20 ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                   '{{WRAPPER}} .post-list[class*="columns"]' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
                    '{{WRAPPER}} .post-style-grid' => 'padding-left: calc( {{SIZE}}{{UNIT}}/2 ); padding-right: calc( {{SIZE}}{{UNIT}}/2 );',
                    '{{WRAPPER}} .post-list .post-style-grid' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .post-list .post-style-list' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => [ 'custom' ],
                'default' => 'talemy_thumb_small',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'meta_data',
            [
                'label' => esc_html__( 'Meta Data', 'talemy' ),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => [
                    'level' => esc_html__( 'Level', 'talemy' ),
                    'duration' => esc_html__( 'Duration', 'talemy' ),
                    'language' => esc_html__( 'Language', 'talemy' ),
                    'enrolled' => esc_html__( 'Students', 'talemy' )
                ],
                'default' => [ 'level', 'duration', 'language' ],
                'separator' => 'before',
                'label_block' => true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_html__( 'Query', 'talemy' ),
            ]
        );

        $this->add_control(

            'course_categories', [
                'type' => Controls_Manager::SELECT2,
                'label' => esc_html__( 'Categories', 'talemy' ),
                'default' => '',
                'multiple' => true,
                'options' => talemy_get_ld_option_course_cats()
            ]
        );

        $this->add_control(

            'course_tags', [
                'type' => Controls_Manager::SELECT2,
                'label' => esc_html__( 'Tags', 'talemy' ),
                'default' => '',
                'multiple' => true,
                'options' => talemy_get_ld_option_course_tags(),
            ]
        );

        $this->add_control(
            'authors',
            [
                'label' => esc_html__( 'Authors', 'talemy' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => sf_get_option_authors(),
            ]
        );

        $this->add_control(
            'post_ids',
            [
                'label' => esc_html__( 'Post In', 'talemy' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => talemy_get_ld_option_courses(),
            ]
        );

        $this->add_control(
            'count',
            [
                'label' => esc_html__( 'Posts Count', 'talemy' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__( 'Offset Posts', 'talemy' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order By', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__( 'Latest Posts', 'talemy' ),
                    'rating' => esc_html__( 'Rating Score', 'talemy' ),
                    'random' => esc_html__( 'Random Posts', 'talemy' ),
                    'menu_order' => esc_html__( 'Page Order', 'talemy' )
                ),
                'default' => '',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'DESC' => esc_html__( 'Descending', 'talemy' ),
                    'ASC' => esc_html__( 'Ascending', 'talemy' )
                ),
                'default' => 'DESC',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'talemy' ),
            ]
        );

        $this->add_control(
            'tab_type',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Tab Type', 'talemy' ),
                'default' => '',
                'options' => [
                    '' => esc_html__( 'No Tabs', 'talemy' ),
                    'subcat' => esc_html__( 'Subcategories as Tabs', 'talemy' ),
                    'cat' => esc_html__( 'Categories as Tabs', 'talemy' ),
                    'tag' => esc_html__( 'Tags as Tabs', 'talemy' ),
                    'author' => esc_html__( 'Authors as Tabs', 'talemy' ),
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_control(
            'tab_categories',
            [
                'type' => Controls_Manager::SELECT2,
                'label' => esc_html__( 'Categories', 'talemy' ),
                'default' => '',
                'multiple' => true,
                'options' => talemy_get_ld_option_course_cats(),
                'condition' => [
                    'tab_type' => 'cat'
                ]
            ]
        );

        $this->add_control(
            'tab_tags',
            [
                'type' => Controls_Manager::SELECT2,
                'label' => esc_html__( 'Tags', 'talemy' ),
                'default' => '',
                'multiple' => true,
                'options' => talemy_get_ld_option_course_tags(),
                'condition' => [
                    'tab_type' => 'tag'
                ]
            ]
        );

        $this->add_control(
            'tab_authors',
            [
                'label' => esc_html__( 'Authors', 'talemy' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => sf_get_option_authors(),
                'condition' => [
                    'tab_type' => 'author',
                ]
            ]
        );

        $this->add_control(
            'tab_orderby',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Order By', 'talemy' ),
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'talemy' ),
                    'name' => esc_html__( 'Name', 'talemy' ),
                    'slug' => esc_html__( 'Slug', 'talemy' ),
                    'id' => esc_html__( 'ID', 'talemy' ),
                    'count' => esc_html__( 'Count', 'talemy' )
                ],
                'render_type' => 'template',
				'conditions' => [
					'terms' => [
						[
							'name' => 'tab_type',
							'operator' => '!==',
							'value' => ''
						],
						[
							'name' => 'tab_type',
							'operator' => '!==',
							'value' => 'author'
						]
					]
				]
            ]
        );

        $this->add_control(
            'tab_order',
            [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Order', 'talemy' ),
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'talemy' ),
                    'ASC' => esc_html__( 'Ascending', 'talemy' ),
                    'DESC' => esc_html__( 'Descending', 'talemy' )
                ],
                'render_type' => 'template',
				'conditions' => [
					'terms' => [
						[
							'name' => 'tab_type',
							'operator' => '!==',
							'value' => ''
						],
						[
							'name' => 'tab_type',
							'operator' => '!==',
							'value' => 'author'
						]
					]
				]
            ]
        );

        $this->add_control(
            'tab_show_all',
            [
                'label' => esc_html__( 'Show "All" Tab', 'talemy' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'talemy' ),
                'label_off' => esc_html__( 'Hide', 'talemy' ),
                'default' => 'yes',
            ]
        );

        $this->add_control(

            'preload_content', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Preload Content', 'talemy' ),
                'default' => '',
                'options' => [
                    '' => esc_html__( 'No Preloading ( Recommended )', 'talemy' ),
                    'preload' => esc_html__( 'Preload Content', 'talemy' )
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination',
            [
                'label' => esc_html__( 'Pagination', 'talemy' )
            ]
        );

        $this->add_control(

            'pagination', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__( 'Pagination', 'talemy' ),
                'default' => '',
                'options' => [
                    '' => esc_html__( 'No Pagination', 'talemy' ),
                    'next_prev' => esc_html__( 'Prev / Next', 'talemy' ),
                    'load_more' => esc_html__( 'Load More', 'talemy' ),
                    'load_more_scroll' => esc_html__( 'Infinite Scroll', 'talemy' )
                ]
            ]
        );

        $this->add_control(
            'ppl',
            [
                'label' => esc_html__( 'Posts Per Load', 'talemy' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6
            ]
        );

        $this->add_control(
            'max_loads',
            [
                'label' => esc_html__( 'Max Loads ( Infinite Scroll )', 'talemy' ),
                'description' => esc_html__( 'The number of loads before a load more button will appear. Leave empty to always use infinite scroll.', 'talemy' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__( 'General', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-heading .sf-heading__title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .sf-heading .sf-heading__title',
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__( 'Subtitle Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-heading .sf-heading__subtitle' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .sf-heading .sf-heading__subtitle',
            ]
        );

        $this->add_control(
            'decor_style',
            [
                'label' => __( 'Title Style', 'talemy' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'talemy' ),
                    'bottom_line' => __( 'Bottom line', 'talemy' )
                ],
                'default' => 'bottom_line',
                'prefix_class' => 'sf-heading--decor-',
                'render_type' => 'template',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label' => __( 'Line Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-heading .sf-heading__line' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'label_bg_color',
            [
                'label' => esc_html__( 'Status Label Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post-badge' => 'background-color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'thumbnail_overlay_color',
            [
                'label' => esc_html__( 'Thumbnail Overlay Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .type-sfwd-courses.loop-post .post-thumb>a:before' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tab_style',
            [
                'label' => esc_html__( 'Tabs', 'talemy' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->start_controls_tabs( 'Normal' );

        $this->start_controls_tab(
            'tab_normal',
            [
                'label' => esc_html__( 'Normal', 'talemy' )
            ]
        );

        $this->add_control(
            'tab_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-item:not(.active)' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .more-tab' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label' => esc_html__( 'Text Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-item:not(.active)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .more-tab' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_active',
            [
                'label' => esc_html__( 'Hover/Active', 'talemy' )
            ]
        );

        $this->add_control(
            'tab_active_bg_color',
            [
                'label' => esc_html__( 'Background Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-item.active' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_active_text_color',
            [
                'label' => esc_html__( 'Text Color', 'talemy' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-item.active' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'tab_padding',
            [
                'label' => esc_html__( 'Padding', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .tabs-wrapper .tab-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .more-tab' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'tab_gap',
            [
                'label' => esc_html__( 'Tab Gap', 'talemy' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 30,
                    ],
                ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .tabs-wrapper .tab-item' => 'margin-left: {{SIZE}}{{UNIT}}',
                    'body:not(.rtl) {{WRAPPER}} .more-tab' => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_gap',
            [
                'label' => esc_html__( 'Content Gap', 'talemy' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .block-header' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .tabs-wrapper .tab-item, {{WRAPPER}} .more-tab',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tab_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'talemy' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tabs-wrapper .tab-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .more-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography',
                'selector' => '{{WRAPPER}} .block-nav .block-link, {{WRAPPER}} .block-nav .more-tab, {{WRAPPER}} .block-nav .tab-item'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $settings['post_type'] = 'sfwd-courses';
        
        $block = new \Talemy_Block_Courses( $settings );
        $out = '';
        $out .= talemy_block_get_header( $settings, $block->get_tabs() );
        $out .= $block->get_content();
        $out .= $block->get_preload_content();
        if ( $block->query->max_num_pages > 1 ) {
            $out .= talemy_block_get_footer( $settings );
        }
        
        if ( !empty( $out ) ) {
            $out = '<div class="block-posts pb-block" data-block="' . htmlspecialchars( $block->get_block_data(), ENT_QUOTES, 'UTF-8' ) . '">' . $out . '</div>';
            echo $out; // WPCS: XSS ok.
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new Talemy_Block_Courses() );