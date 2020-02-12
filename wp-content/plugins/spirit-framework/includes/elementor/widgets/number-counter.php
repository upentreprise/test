<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Number_Counter extends Widget_Base {

	public function get_name() {
		return 'sf-number-counter';
	}

	public function get_title() {
		return __( 'Number Counter', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-counter sf-addons-label';
	}

    public function get_categories() {
        return [ 'sf-addons' ];
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    public function get_script_depends() {
        return [
        	'jquery-animate-number',
            'sf-frontend',
        ];
    }

	public static function default_icon_control() {
		return apply_filters( 'sf_elementor_default_icon_control', false );
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_number_counter',
			[
				'label' => __( 'Number Counter', 'spirit' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => __( 'Title', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Customers', 'spirit' ),
			]
		);

		$this->add_control(
			'start_value',
			[
				'label' => __( 'Start Value', 'spirit' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 0.01,
				'default' => 0,
			]
		);

		$this->add_control(
			'end_value',
			[
				'label' => __( 'End Value', 'spirit' ),
				'type' => Controls_Manager::NUMBER,
				'step' => 0.01,
				'default' => 800,
			]
		);

		$this->add_control(
			'duration',
			[
				'label' => __( 'Duration', 'spirit' ),
				'description' => __( 'The total duration of the count up animation', 'spirit' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 2000,
			]
		);

		$this->add_control(
			'icon_position',
			[
				'label' => __( 'Icon Position', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'left' => __( 'Left', 'spirit' ),
					'top' => __( 'Top', 'spirit' ),
				],
				'default' => 'left',
				'prefix_class' => 'sf-number-counter--icon-',
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label' => __( 'Icon Type', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'icon' => __( 'Icon', 'spirit' ),
					'image' => __( 'Image', 'spirit' ),
				],
				'default' => 'icon'
			]
		);

		if ( self::default_icon_control() ) {
			$this->add_control(
				'selected_icon',
				[
					'label' => __( 'Icon', 'spirit' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-users',
						'library' => 'solid'
					],
					'separator' => 'before',
				]
			);
		} else {
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'spirit' ),
					'type' => 'sf_icon',
					'label_block' => true,
					'condition' => [
						'icon_type' => 'icon',
					],
					'default' => 'fas fa-users'
				]
			);
		}

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'spirit' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'condition' => [
					'icon_type' => 'image',
				],
			]
		);

		$this->add_control(
			'prefix',
			[
				'label' => __( 'Prefix', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => __( 'Suffix', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'K',
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' => __( 'Alignment', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'spirit' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'spirit' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'spirit' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
				'prefix_class' => 'sf-number-counter--align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_number_style',
			[
				'label' => __( 'Number', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'number_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__number' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_typography',
                'label' => __( 'Typography', 'spirit' ),
                'selector' => '{{WRAPPER}} .sf-number-counter__number',
            ]
        );

		$this->add_control(
			'number_separator',
			[
				'label' => __( 'Number Separator', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'number_spacing',
			[
				'label' => __( 'Spacing', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.sf-number-counter--icon-left .sf-number-counter__title' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__title' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'spirit' ),
                'selector' => '{{WRAPPER}} .sf-number-counter__title',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_prefix_style',
			[
				'label' => __( 'Prefix', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'prefix_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__prefix' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'prefix_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__prefix' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'prefix_position',
			[
				'label' => __( 'Vertical Position', 'spirit' ),
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
					'{{WRAPPER}} .sf-number-counter__prefix' => 'align-self: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_suffix_style',
			[
				'label' => __( 'Suffix', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'suffix_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__suffix' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'suffix_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__suffix' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'suffix_position',
			[
				'label' => __( 'Vertical Position', 'spirit' ),
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
					'{{WRAPPER}} .sf-number-counter__suffix' => 'align-self: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__icon i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-number-counter__icon' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();
		$start_value = !empty( $settings['start_value'] ) ? $settings['start_value'] : 0;
		$end_value = !empty( $settings['end_value'] ) ? $settings['end_value'] : $start_value;
		$separator = !empty( $settings['number_separator'] ) ? $settings['number_separator'] : '';
		$icon_url = '';

		$this->add_render_attribute(
			'number',
			[
				'class' => 'sf-number-counter__number',
				'data-start' => $start_value,
				'data-end' => $end_value,
				'data-duration' => isset( $settings['duration'] ) ? $settings['duration'] : 2000,
				'data-separator' => $separator,
			]
		);

		if ( 'image' == $settings['icon_type'] ) {
			$icon_url = !empty( $settings['image']['url'] ) ? $settings['image']['url'] : '';
		}

		?>
		<div class="sf-number-counter">
			<?php if ( 'icon' == $settings['icon_type'] && !empty( $settings['selected_icon']['value'] ) || !empty( $settings['icon'] ) ) : ?>
				<div class="sf-number-counter__icon">
					<?php if ( !empty( $settings['selected_icon']['value'] ) ) : ?>
						<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					<?php elseif ( !empty( $settings['icon'] ) ) : ?>
						<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
					<?php endif; ?>
				</div>
			<?php elseif ( !empty( $icon_url ) ): ?>
				<div class="sf-number-counter__icon">
					<img src="<?php echo esc_url( $icon_url ); ?>" alt="icon">
				</div>
			<?php endif; ?>
			<div class="sf-number-counter__inner">
			<?php if ( !empty( $settings['prefix'] ) ) : ?>
				<span class="sf-number-counter__prefix"><?php echo esc_html( $settings['prefix'] ); ?></span>
			<?php endif; ?>
				<span <?php echo $this->get_render_attribute_string( 'number' ); ?>><?php echo esc_html( $start_value ); ?></span>
			<?php if ( !empty( $settings['suffix'] ) ) : ?>
				<span class="sf-number-counter__suffix"><?php echo esc_html( $settings['suffix'] ); ?></span>
			<?php endif; ?>
			<?php if ( !empty( $settings['title'] ) ) : ?>
				<div class="sf-number-counter__title"><?php echo esc_html( $settings['title'] ); ?></div>
			<?php endif; ?>
			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Number_Counter() );