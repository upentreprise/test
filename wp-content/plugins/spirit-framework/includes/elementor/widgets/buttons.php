<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Buttons extends Widget_Base {

	public function get_name() {
		return 'sf-buttons';
	}

	public function get_title() {
		return __( 'Buttons', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-button sf-addons-label';
	}

    public function get_categories() {
        return [ 'sf-addons' ];
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

	public static function default_icon_control() {
		return apply_filters( 'sf_elementor_default_icon_control', false );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_buttons',
			[
				'label' => __( 'Buttons', 'spirit' ),
			]
		);

		if ( self::default_icon_control() ) {
			$button_icon_control = [
				'name' => 'selected_icon',
				'label' => __( 'Icon', 'spirit' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
			];
		} else {
			$button_icon_control = [
				'name' => 'icon',
				'label' => __( 'Icon', 'spirit' ),
				'type' => 'sf_icon',
				'label_block' => true,
			];
		}

        $this->add_control(
            'items',
            [
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'type' => 'primary',
                        'text' => esc_html__( 'Button Text', 'spirit' ),
                        'link' => '#',
                        'icon' => '',
                        'css_id' => '',
                        'css_classes' => ''
                    ],
                    [
                        'type' => 'outline-primary',
                        'text' => esc_html__( 'Button Text', 'spirit' ),
                        'link' => '#',
                        'icon' => '',
                        'css_id' => '',
                        'css_classes' => ''
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'type',
                        'label' => esc_html__( 'Type', 'spirit' ),
						'type' => Controls_Manager::SELECT,
						'default' => 'primary',
						'options' => sf_get_option_button_styles()
                    ],
                    [
                        'name' => 'text',
                        'label' => esc_html__( 'Text', 'spirit' ),
                        'type' => Controls_Manager::TEXT,
						'default' => __( 'Button Text', 'spirit' ),
						'placeholder' => __( 'Button Text', 'spirit' ),
                    ],
                    [
                        'name' => 'link',
                        'label' => esc_html__( 'Link', 'spirit' ),
						'type' => Controls_Manager::URL,
						'dynamic' => [
							'active' => true,
						],
						'placeholder' => __( 'https://your-link.com', 'spirit' ),
						'default' => [
							'url' => '#',
						]
					],
					
					$button_icon_control,

                    [
                        'name' => 'css_id',
                        'label' => esc_html__( 'CSS ID', 'spirit' ),
                        'type' => Controls_Manager::TEXT
                    ],
                    [
                        'name' => 'css_classes',
                        'label' => esc_html__( 'CSS Classes', 'spirit' ),
                        'type' => Controls_Manager::TEXT
                    ]

                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			[
				'label' => __( 'Buttons', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
					'justify' => [
						'title' => __( 'Justified', 'spirit' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'sf%s-align-',
				'default' => '',
			]
		);

		$this->add_control(
			'size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'sm' => __( 'Small', 'spirit' ),
					'' => __( 'Medium', 'spirit' ),
					'lg' => __( 'Large', 'spirit' )
				],
				'style_transfer' => true,
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.btn, {{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Icon Position', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Before', 'spirit' ),
					'right' => __( 'After', 'spirit' ),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => __( 'Icon Spacing', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .btn .btn-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'after'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.btn, {{WRAPPER}} .btn',
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label'      => __( 'Space between buttons', 'spirit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'default'    => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .sf-buttons .btn-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
					'(desktop){{WRAPPER}}.sf-buttons__stack-desktop .sf-buttons .btn-wrapper' => 'display: block; margin-bottom: {{SIZE}}{{UNIT}};margin-right: 0;',
					'(tablet){{WRAPPER}}.sf-buttons__stack-tablet .sf-buttons .btn-wrapper' => 'display: block; margin-bottom: {{SIZE}}{{UNIT}};margin-right: 0;',
					'(mobile){{WRAPPER}}.sf-buttons__stack-mobile .sf-buttons .btn-wrapper' => 'display: block; margin-bottom: {{SIZE}}{{UNIT}};margin-right: 0;',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'stack_on',
			[
				'label'        => __( 'Stack on', 'spirit' ),
				'description'  => __( 'Choose on what breakpoint where the buttons will stack.', 'spirit' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'none',
				'options'      => [
					'none'    => __( 'None', 'spirit' ),
					'desktop' => __( 'Desktop', 'spirit' ),
					'tablet'  => __( 'Tablet', 'spirit' ),
					'mobile'  => __( 'Mobile', 'spirit' ),
				],
				'prefix_class' => 'sf-buttons__stack-',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sf-buttons">
		<?php
			for ( $i = 0; $i < count( $settings['items'] ); $i++ ) :
				$item = $settings['items'][ $i ];

				if ( !empty( $item['link']['url'] ) ) {
					$this->add_render_attribute( 'button_'. $i, 'href', $item['link']['url'] );

					if ( $item['link']['is_external'] ) {
						$this->add_render_attribute( 'button_'. $i, 'target', '_blank' );
					}

					if ( $item['link']['nofollow'] ) {
						$this->add_render_attribute( 'button_'. $i, 'rel', 'nofollow' );
					}
				}

				$this->add_render_attribute( 'button_'. $i, 'class', 'btn' );
				$this->add_render_attribute( 'button_'. $i, 'role', 'button' );

				if ( !empty( $item['type'] ) ) {
					$this->add_render_attribute( 'button_'. $i, 'class', 'btn-'. $item['type'] );
				} else {
					$this->add_render_attribute( 'button_'. $i, 'class', 'btn-primary' );
				}

				if ( !empty( $item['css_id'] ) ) {
					$this->add_render_attribute( 'button_'. $i, 'id', $item['css_id'] );
				}

				if ( !empty( $item['css_classes'] ) ) {
					$this->add_render_attribute( 'button_'. $i, 'class', $item['css_classes'] );
				}

				if ( !empty( $settings['size'] ) ) {
					$this->add_render_attribute( 'button_'. $i, 'class', 'btn-' . $settings['size'] );
				}

				?>
				<div class="btn-wrapper">
					<a <?php echo $this->get_render_attribute_string( 'button_'. $i ); ?>>
						<?php $this->render_text( $item, $i ); ?>
					</a>
				</div>
		<?php endfor; ?>
		</div>
		<?php
	}


	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function render_text( $item, $i ) {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'icon_align_'. $i => [
				'class' => [
					'btn-icon',
					'btn-align-icon-' . $settings['icon_position'],
				],
			],
			'text_'. $i => [
				'class' => 'btn-text',
			],
		] );

		?>
		<span class="btn-text-wrapper">
			<?php if ( !empty( $item['selected_icon']['value'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'icon_align_'. $i ); ?>>
					<?php Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
			<?php elseif ( !empty( $item['icon'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'icon_align_'. $i ); ?>>
					<i class="<?php echo esc_attr( $item['icon'] ); ?>" aria-hidden="true"></i>
				</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text_'. $i ); ?>><?php echo esc_html( $item['text'] ); ?></span>
		</span>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Buttons() );