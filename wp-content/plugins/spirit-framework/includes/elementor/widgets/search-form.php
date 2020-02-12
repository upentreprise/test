<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Search_Form extends Widget_Base {

	public function get_name() {
		return 'sf-search-form';
	}

	public function get_title() {
		return __( 'Search Form', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-site-search sf-addons-label';
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
			'search_content',
			[
				'label' => __( 'Search Form', 'spirit' ),
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => __( 'Height', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'label_block' => true,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__container' => 'min-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .sf-search-form__submit' => 'min-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' => __( 'Placeholder', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'default' => __( 'Search', 'spirit' ) . '...',
			]
		);

		$this->add_control(
			'button_type',
			[
				'label' => __( 'Button Type', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => __( 'Icon', 'spirit' ),
					'text' => __( 'Text', 'spirit' ),
				],
				'prefix_class' => 'sf-search-form--button-',
				'render_type' => 'template',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Search', 'spirit' ),
				'separator' => 'after',
				'condition' => [
					'button_type' => 'text',
				],
			]
		);

		if ( self::default_icon_control() ) {
			$this->add_control(
				'button_selected_icon',
				[
					'label' => __( 'Button Icon', 'spirit' ),
					'type' => Controls_Manager::ICONS,
					'label_block' => false,
					'default' => [
						'value' => 'fas fa-search',
						'library' => 'solid'
					],
					'render_type' => 'template',
					'condition' => [
						'button_type' => 'icon',
					],
				]
			);
		} else {
			$this->add_control(
				'button_icon',
				[
					'label' => __( 'Button Icon', 'spirit' ),
					'type' => 'sf_icon',
					'label_block' => false,
					'default' => 'fas fa-search',
					'render_type' => 'template',
					'condition' => [
						'button_type' => 'icon',
					],
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_query',
			[
				'label' => __( 'Search Query', 'spirit' ),
			]
		);

		$this->add_control(
			'query_post_types',
			[
				'label' => __( 'Post Types', 'spirit' ),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'multiple' => true,
				'options' => sf_get_option_post_types(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input_style',
			[
				'label' => __( 'Input', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'input_padding',
            [
                'label' => __( 'Padding', 'spirit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} input[type=search].sf-search-form__input' => 'padding: 0 {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'input_typography',
				'selector' => '{{WRAPPER}} input[type="search"].sf-search-form__input',
			]
		);

		$this->start_controls_tabs( 'tabs_input_colors' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __( 'Normal', 'spirit' ),
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input[type="search"].sf-search-form__input' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_background_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__container' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label' => __( 'Border Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__container' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow',
				'selector' => '{{WRAPPER}} .sf-search-form__container',
				'fields_options' => [
					'box_shadow_type' => [
						'separator' => 'default',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __( 'Focus', 'spirit' ),
			]
		);

		$this->add_control(
			'input_text_color_focus',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form--focus input[type=search].sf-search-form__input' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_background_color_focus',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form--focus .sf-search-form__container' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label' => __( 'Border Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form--focus .sf-search-form__container' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'input_box_shadow_focus',
				'selector' => '{{WRAPPER}} .sf-search-form--focus .sf-search-form__container',
				'fields_options' => [
					'box_shadow_type' => [
						'separator' => 'default',
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_border_width',
			[
				'label' => __( 'Border Size', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__container' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__container' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Button', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'spirit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sf-search-form__submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}}.sf-search-form--button-text .sf-search-form__submit',
				'condition' => [
					'button_type' => 'text',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_colors' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'spirit' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__submit' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__submit' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'spirit' ),
			]
		);

		$this->add_control(
			'button_text_color_hover',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__submit:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_background_color_hover',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__submit:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.sf-search-form--button-icon .sf-search-form__submit' => 'font-size: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',
				'condition' => [
					'button_type' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'button_width',
			[
				'label' => __( 'Width', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-search-form__submit' => 'min-width: calc( {{SIZE}} * {{size.SIZE}}{{size.UNIT}} )',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$this->add_render_attribute(
			'input', [
				'placeholder' => $settings['placeholder'],
				'class' => 'sf-search-form__input',
				'type' => 'search',
				'name' => 's',
				'title' => __( 'Search', 'spirit' ),
				'value' => get_search_query(),
			]
		);

		?>
		<form class="sf-search-form" role="search" action="<?php echo home_url(); ?>" method="get">
			<div class="sf-search-form__container">
				<input <?php echo $this->get_render_attribute_string( 'input' ); ?>>
				<?php if ( !empty( $settings['query_post_types'] ) ) {
					foreach ( $settings['query_post_types'] as $post_type ) {
						echo '<input type="hidden" name="post_type[]" value="' . $post_type . '">';
					}
				} ?>
				<button class="sf-search-form__submit" type="submit">
					<?php if ( 'icon' === $settings['button_type'] ) : ?>
						<?php if ( !empty( $settings['button_selected_icon']['value'] ) ) : ?>
							<?php Icons_Manager::render_icon( $settings['button_selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php elseif ( !empty( $settings['button_icon'] ) ) : ?>
							<i class="<?php echo esc_attr( $settings['button_icon'] ); ?>" aria-hidden="true"></i>
						<?php endif; ?>
					<?php elseif ( ! empty( $settings['button_text'] ) ) : ?>
						<span><?php echo $settings['button_text']; ?></span>
					<?php endif; ?>
				</button>
			</div>
		</form>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Search_Form() );