<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class SF_Team_Members extends Widget_Base {

	public function get_name() {
		return 'sf-team-members';
	}

	public function get_title() {
		return __( 'Team Members', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-person sf-addons-label';
	}

   	public function get_categories() {
		return [ 'sf-addons' ];
	}

    public function get_keywords() {
        return [ 'sf' ];
    }
	
	protected function _register_controls() {

  		$this->start_controls_section(
  			'section_general',
  			[
  				'label' => esc_html__( 'General', 'spirit' )
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
                'desktop_default' => 3,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'condition' => [
                    'layout!' => 'carousel',
                ]
            ]
        );

		$this->add_control(
			'show_description',
			[
				'label' => __( 'Show Description', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'description_limit',
			[
				'label' => __( 'Description Limit', 'spirit' ),
				'description' => __( 'Number of characters', 'spirit' ),
				'type' => Controls_Manager::NUMBER
			]
		);

		$this->add_control(
			'show_social_links',
			[
				'label' => __( 'Show Social Links', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_items',
            [
                'label' => esc_attr__( 'Items', 'spirit' ),
            ]
        );

		$this->add_control(
			'items',
			[
				'label' => __( 'Team Members', 'spirit' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'id',
						'label' => __( 'Member', 'spirit' ),
						'description' => __( 'This option will pull member data from Wordpress profile.', 'spirit' ),
						'type' => Controls_Manager::SELECT2,
						'options' => sf_get_option_authors(),
					],
					[
						'name' => 'name',
						'label' => __( 'Name', 'spirit' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'John Doe',
					],
					[
						'name' => 'job_title',
						'label' => __( 'Job Position', 'spirit' ),
						'type' => Controls_Manager::TEXT,
						'default' => 'Web Designer',
					],
					[
						'name' => 'description',
						'label' => __( 'Description', 'spirit' ),
						'type' => Controls_Manager::TEXTAREA,
						'default' => 'Add team member description here.',
						'label_block' => true,
					],
                    [
						'name'        => 'image',
						'label'       => __( 'Image', 'spirit' ),
                        'type'        => Controls_Manager::MEDIA,
					],
					[
						'name' => 'link',
						'label' => __( 'Link To', 'spirit' ),
						'type' => Controls_Manager::URL,
						'dynamic' => [
							'active' => true
						],
					],
                    [
                        'name'        => 'social_links_heading',
                        'label'       => __('Social Links', 'spirit'),
                        'type'        => Controls_Manager::HEADING,
                        'separator'   => 'before',
                    ],
					[
						'name'        => 'facebook_url',
						'label'       => __( 'Facebook', 'spirit' ),
						'type'        => Controls_Manager::TEXT,
					],
					[
						'name'        => 'twitter_url',
						'label'       => __( 'Twitter', 'spirit' ),
						'type'        => Controls_Manager::TEXT,
					],
					[
						'name'        => 'google_plus_url',
						'label'       => __( 'Google+', 'spirit' ),
						'type'        => Controls_Manager::TEXT,
					],
					[
						'name'        => 'linkedin_url',
						'label'       => __( 'Linkedin', 'spirit' ),
						'type'        => Controls_Manager::TEXT,
					],
					[
						'name'        => 'instagram_url',
						'label'       => __( 'Instagram', 'spirit' ),
						'type'        => Controls_Manager::TEXT,
					],
					[
						'name'        => 'youtube_url',
						'label'       => __( 'YouTube', 'spirit' ),
						'type'        => Controls_Manager::TEXT,
					],
					[
						'name'        => 'pinterest_url',
						'label'       => __( 'Pinterest', 'spirit' ),
						'type'        => Controls_Manager::TEXT,
					],
					[
						'name'        => 'dribbble_url',
						'label'       => __( 'Dribbble', 'spirit' ),
						'type'        => Controls_Manager::TEXT,
					],
				],
				'default' => [
					[
						'name' => 'John Doe',
						'job_title' => 'CEO',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
					],
					[
						'name' => 'Jane Doe',
						'job_title' => 'CEO',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
					],
					[
						'name' => 'Jane Roe',
						'job_title' => 'CEO',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_slider',
			[
				'label' => __( 'Slider', 'spirit' ),
				'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout' => 'carousel',
                ]
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
			'section_styles_general',
			[
				'label' => esc_html__( 'Team Members', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'style',
			[
				'label' => esc_html__( 'Style', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__( 'Default', 'spirit' ),
					'1' => esc_html__( 'Image Left', 'spirit' ),
					'2' => esc_html__( 'Image Right', 'spirit' ),
				],
				'prefix_class' => 'sf-team-member--style-'
			]
		);

		$this->add_control(
			'h_alignment',
			[
				'label' => esc_html__( 'Horizontal Alignment', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'spirit' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'spirit' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'spirit' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'center',
				'prefix_class' => 'sf-align-',
			]
		);

		$this->add_control(
			'v_alignment',
			[
				'label' => __( 'Vertical Alignment', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__inner,{{WRAPPER}} .swiper-container-autoheight .swiper-wrapper' => 'align-items: {{VALUE}}',
				],
				'condition' => [
					'style!' => 'default',
				],
			]
		);

        $this->add_responsive_control(
            'spacing',
            [
                'label' => __( 'Space Between', 'spirit' ),
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
                    '{{WRAPPER}} .row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
                    '{{WRAPPER}} .row [class^=col-]' => 'padding-left: calc( {{SIZE}}{{UNIT}}/2 ); padding-right: calc( {{SIZE}}{{UNIT}}/2 ); margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'spirit' ),
				'selector' => '{{WRAPPER}} .sf-team-member',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
		
		
		$this->start_controls_section(
			'section_image_styles',
			[
				'label' => esc_html__( 'Image', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);		

		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Image Width', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__image img' => 'max-width:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Image Height', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__image img' => 'height:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' => esc_html__( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__content' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'content_hover_bg_color',
			[
				'label' => esc_html__( 'Background Hover Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member:hover .sf-team-member__content' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label' => esc_html__( 'Margin', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => esc_html__( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sf-team-member__desc' => 'min-height: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

		$this->add_control(
			'name_heading',
			[
				'label' => __( 'Name', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' => esc_html__( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__name' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .sf-team-member__name',
			]
		);

		$this->add_control(
			'position_heading',
			[
				'label' => __( 'Job Position', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'position_color',
			[
				'label' => esc_html__( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__position' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'position_typography',
				'selector' => '{{WRAPPER}} .sf-team-member__position',
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label' => __( 'Description', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__desc' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .sf-team-member__desc',
			]
		);

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => __( 'Space Between', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [ 'size' => 15 ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sf-team-member__desc' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		
		$this->start_controls_section(
			'section_social_links_styles',
			[
				'label' => esc_html__( 'Social Icons', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

        $this->add_responsive_control(
            'social_links_spacing',
            [
                'label' => __( 'Space Between', 'spirit' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [ 'size' => 20 ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sf-team-member__social' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Spacing', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 128,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_height',
			[
				'label' => esc_html__( 'Icon Height', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%'	=> [
						'min'	=> 0,
						'max'	=> 10
					]
				],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_width',
			[
				'label' => esc_html__( 'Icon Width', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units'	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%'	=> [
						'min'	=> 0,
						'max'	=> 10
					]
				],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'social_icons_style_tabs' );

		$this->start_controls_tab(
			'normal',
			[ 'label' => esc_html__( 'Normal', 'spirit' ) ]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .sf-team-member__social-link > a',
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a' => 'border-radius: {{SIZE}}px;',
				],
			]
		);
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			[ 'label' => esc_html__( 'Hover', 'spirit' ) ]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label' => esc_html__( 'Icon Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .sf-team-member__social-link > a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_style',
            [
                'label' => esc_attr__( 'Navigation', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                	'layout' => 'carousel',
                ]
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
			'pagination_color',
			[
				'label' => __( 'Bullets Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'pagination_active_color',
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
            default: $classes .= 'col-lg-4'; break;
        }
        switch ( $settings['columns_tablet'] ) {
            case 1: $classes .= ' col-md-12'; break;
            case 2: $classes .= ' col-md-6'; break;
            case 3: $classes .= ' col-md-4'; break;
            case 4: $classes .= ' col-md-3'; break;
            default: $classes .= ' col-md-4'; break;
        }
        switch ( $settings['columns_mobile'] ) {
            case 1: $classes .= ' col-12'; break;
            case 2: $classes .= ' col-6'; break;
            case 3: $classes .= ' col-4'; break;
            case 4: $classes .= ' col-3'; break;
            default: $classes .= ' col-6'; break;
        }
        return $classes;
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
		?>
		<div class="sf-team-members">
			<div class="clearfix">
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
                            <?php foreach ( $settings['items'] as $item ) : ?>
                            <div class="swiper-slide">
                            	<?php $item = $this->get_member_data( $item ); ?>
                            	<?php $this->loop_team_member( $item, $settings ); ?>
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
            <?php else: ?>
                <div class="row">
                <?php foreach ( $settings['items'] as $item ) : ?>
                    <div class="<?php echo esc_attr( $this->get_column_class( $settings ) ); ?>">
                    	<?php $item = $this->get_member_data( $item ); ?>
                    	<?php $this->loop_team_member( $item, $settings ); ?>
                    </div>
               	<?php endforeach; ?>
                </div>
            <?php endif; ?>
			</div>
		</div>
	<?php
	}

	public function loop_team_member( $item, $settings ) {
		if ( false == $item ) {
			return;
		}
		?>
		<div class="sf-team-member">
			<div class="sf-team-member__inner">
				<?php if ( ! empty( $item['image']['id'] ) ) : ?>
					<div class="sf-team-member__image">
						<a href="<?php echo esc_url( $item['link']['url'] ); ?>">
							<?php echo wp_get_attachment_image( $item['image']['id'], 'full' ); ?>
						</a>
					</div>
				<?php elseif ( !empty( $item['image']['url'] ) ) : ?>
					<div class="sf-team-member__image">
						<a href="<?php echo esc_url( $item['link']['url'] ); ?>">
							<img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="<?php echo esc_attr( $item['name'] ); ?>">
						</a>
					</div>
				<?php endif; ?>
				<div class="sf-team-member__content">
					<h3 class="sf-team-member__name">
						<?php if ( !empty( $item['link']['url'] ) ) :
							$attr = '';
				            if ( $item['link']['is_external'] ) {
				                $attr .= ' target="_blank"';
				            }
				            if ( ! empty( $item['link']['nofollow'] ) ) {
				                $attr .= ' rel="nofollow"';
				            }
						?>
						<a href="<?php echo esc_url( $item['link']['url'] ); ?>" <?php echo $attr; ?>><?php echo esc_html( $item['name'] ); ?></a>
						<?php else : ?>
						<?php echo esc_html( $item['name'] ); ?>
						<?php endif; ?>
					</h3>
					<p class="sf-team-member__position"><?php echo $item['job_title']; ?></p>
					
					<?php if ( ! empty( $item['description'] && $settings['show_description'] ) ): ?>
					<?php $description = !empty( $settings['description_limit'] ) ? $this->get_short_description( $item['description'], $settings['description_limit'] ) : $item['description']; ?>
						<p class="sf-team-member__desc"><?php echo wp_kses_post( $description ); ?></p>
					<?php endif; ?>
					
					<?php if ( $settings['show_social_links'] ): ?>
					<?php $this->member_social_links( $item ); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

	public function member_social_links( $item ) {
        $facebook_url    = $item['facebook_url'];
        $twitter_url     = $item['twitter_url'];
        $google_plus_url = $item['google_plus_url'];
        $youtube_url     = $item['youtube_url'];
        $instagram_url   = $item['instagram_url'];
        $pinterest_url   = $item['pinterest_url'];
        $linkedin_url    = $item['linkedin_url'];
        $dribbble_url    = $item['dribbble_url'];
        ?>
        <ul class="sf-team-member__social">
        <?php if ( !empty( $facebook_url ) ) : ?>
            <li class="sf-team-member__social-link"><a href="<?php echo esc_url( $facebook_url ); ?>"><i class="fab fa-facebook-f"></i></a></li>
        <?php endif; ?>
        <?php if ( $twitter_url ) : ?>
        	<li class="sf-team-member__social-link"><a href="<?php echo esc_url( $twitter_url ); ?>"><i class="fab fa-twitter"></i></a></li>
        <?php endif; ?>
        <?php if ( $google_plus_url ) : ?>
        	<li class="sf-team-member__social-link"><a href="<?php echo esc_url( $google_plus_url ); ?>"><i class="fab fa-google-plus-g"></i></a></li>
        <?php endif; ?>
        <?php if ( $youtube_url ) : ?>
        	<li class="sf-team-member__social-link"><a href="<?php echo esc_url( $youtube_url ); ?>"><i class="fab fa-youtube"></i></a></li>
        <?php endif; ?>
        <?php if ( $instagram_url ) : ?>
        	<li class="sf-team-member__social-link"><a href="<?php echo esc_url( $instagram_url ); ?>"><i class="fab fa-instagram"></i></a></li>
        <?php endif; ?>
        <?php if ( $pinterest_url ) : ?>
        	<li class="sf-team-member__social-link"><a href="<?php echo esc_url( $pinterest_url ); ?>"><i class="fab fa-pinterest-p"></i></a></li>
        <?php endif; ?>
        <?php if ( $linkedin_url ) : ?>
        	<li class="sf-team-member__social-link"><a href="<?php echo esc_url( $linkedin_url ); ?>"><i class="fab fa-linkedin-in"></i></a></li>
        <?php endif; ?>
        <?php if ( $dribbble_url ) : ?>
        	<li class="sf-team-member__social-link"><a href="<?php echo esc_url( $dribbble_url ); ?>"><i class="fab fa-dribbble"></i></a></li>
        <?php endif; ?>
        </ul>
        <?php
	}

	private function get_member_data( $item ) {
		if ( empty( $item['id'] ) ) {
			return $item;
		}
		
		$user_data = get_userdata( $item['id'] );
		if ( !$user_data) {
			return false;
		}

		$user_avatar = get_user_meta( $item['id'], 'sf_user_avatar', true );
		$user_title = get_user_meta( $item['id'], 'sf_user_title', true );
		$user_social_links = get_user_meta( $item['id'], 'sf_social_links', true );
		$user_description = get_user_meta( $item['id'], 'description', true );
		$user_posts_link = get_author_posts_url( $item['id'] );
		$item = array();
		$item['name'] = $user_data->display_name;
		$item['job_title'] = $user_title;
		$item['description'] = $user_description;
		$item['image'] = [];
		$item['image']['url'] = $user_avatar;
		$item['link'] = [];
		$item['link']['url'] = $user_posts_link;
		$item['link']['is_external'] = false;
		$item['link']['nofollow'] = true;
		$item['facebook_url'] = isset( $user_social_links['facebook'] ) ? $user_social_links['facebook'] : '';
		$item['twitter_url'] = isset( $user_social_links['twitter'] ) ? $user_social_links['twitter'] : '';
		$item['google_plus_url'] = isset( $user_social_links['googleplus'] ) ? $user_social_links['googleplus'] : '';
		$item['youtube_url'] = isset( $user_social_links['youtube'] ) ? $user_social_links['youtube'] : '';
		$item['instagram_url'] = isset( $user_social_links['instagram'] ) ? $user_social_links['instagram'] : '';
		$item['pinterest_url'] = isset( $user_social_links['pinterest'] ) ? $user_social_links['pinterest'] : '';
		$item['linkedin_url'] = isset( $user_social_links['linkedin'] ) ? $user_social_links['linkedin'] : '';
		$item['dribbble_url'] = isset( $user_social_links['dribbble'] ) ? $user_social_links['dribbble'] : '';
		return $item;
	}

	public function get_short_description( $description, $limit = 300 ) {
		$limit = absint( $limit );

		if ( mb_strlen( $description ) > $limit ) {
			$description = mb_substr( $description, 0, $limit );
			$description = trim( $description );

			if ( !empty( $description ) ) {
				$description .= '...';
			}
		}

		return $description;
	}

	protected function content_template() { }
}


Plugin::instance()->widgets_manager->register_widget_type( new SF_Team_Members() );