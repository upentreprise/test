<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Countdown extends Widget_Base {

	public function get_name() {
		return 'sf-countdown';
	}

	public function get_title() {
		return __( 'Countdown', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-countdown sf-addons-label';
	}

    public function get_categories() {
        return [ 'sf-addons' ];
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    public function get_script_depends() {
        return [
            'sf-frontend',
        ];
    }

	protected function _register_controls() {
		$this->start_controls_section(
			'section_countdown',
			[
				'label' => __( 'Countdown', 'spirit' ),
			]
		);

		$this->add_control(
			'due_date',
			[
				'label' => __( 'Due Date', 'spirit' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => date( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				/* translators: %s: Time zone. */
				'description' => sprintf( __( 'Date set according to your timezone: %s.', 'spirit' ), Utils::get_timezone_string() ),
			]
		);

		$this->add_control(
			'label_display',
			[
				'label' => __( 'View', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'block' => __( 'Block', 'spirit' ),
					'inline' => __( 'Inline', 'spirit' ),
				],
				'default' => 'block',
				'prefix_class' => 'sf-countdown--label-',
			]
		);

		$this->add_control(
			'show_days',
			[
				'label' => __( 'Days', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'spirit' ),
				'label_off' => __( 'Hide', 'spirit' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_hours',
			[
				'label' => __( 'Hours', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'spirit' ),
				'label_off' => __( 'Hide', 'spirit' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_minutes',
			[
				'label' => __( 'Minutes', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'spirit' ),
				'label_off' => __( 'Hide', 'spirit' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_seconds',
			[
				'label' => __( 'Seconds', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'spirit' ),
				'label_off' => __( 'Hide', 'spirit' ),
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' => __( 'Show Label', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'spirit' ),
				'label_off' => __( 'Hide', 'spirit' ),
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'custom_labels',
			[
				'label' => __( 'Custom Label', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'show_labels!' => '',
				],
			]
		);

		$this->add_control(
			'label_days',
			[
				'label' => __( 'Days', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Days', 'spirit' ),
				'placeholder' => __( 'Days', 'spirit' ),
				'condition' => [
					'show_labels!' => '',
					'custom_labels!' => '',
					'show_days' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_hours',
			[
				'label' => __( 'Hours', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Hours', 'spirit' ),
				'placeholder' => __( 'Hours', 'spirit' ),
				'condition' => [
					'show_labels!' => '',
					'custom_labels!' => '',
					'show_hours' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_minutes',
			[
				'label' => __( 'Minutes', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Minutes', 'spirit' ),
				'placeholder' => __( 'Minutes', 'spirit' ),
				'condition' => [
					'show_labels!' => '',
					'custom_labels!' => '',
					'show_minutes' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_seconds',
			[
				'label' => __( 'Seconds', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Seconds', 'spirit' ),
				'placeholder' => __( 'Seconds', 'spirit' ),
				'condition' => [
					'show_labels!' => '',
					'custom_labels!' => '',
					'show_seconds' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Boxes', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'container_width',
			[
				'label' => __( 'Container Width', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .sf-countdown' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'box_background_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-countdown-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'selector' => '{{WRAPPER}} .sf-countdown-item',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Border Radius', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_align',
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
				],
				'prefix_class' => 'sf%s-align-',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_spacing',
			[
				'label' => __( 'Space Between', 'spirit' ),
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
					'{{WRAPPER}} .sf-countdown-item:not(:last-of-type)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => __( 'Space Between', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.sf-countdown--label-block .sf-countdown-label' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_digits',
			[
				'label' => __( 'Digits', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'digits_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-countdown-digits' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'digits_typography',
				'selector' => '{{WRAPPER}} .sf-countdown-digits',
			]
		);

		$this->add_control(
			'heading_label',
			[
				'label' => __( 'Label', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .sf-countdown-label',
			]
		);

		$this->end_controls_section();
	}

	public function get_default_countdown_labels() {
		return array(
			'label_months' => __( 'Months', 'spirit' ),
			'label_weeks' => __( 'Weeks', 'spirit' ),
			'label_days' => __( 'Days', 'spirit' ),
			'label_hours' => __( 'Hours', 'spirit' ),
			'label_minutes' => __( 'Minutes', 'spirit' ),
			'label_seconds' => __( 'Seconds', 'spirit' ),
		);
	}

	private function get_countdown_item( $settings, $label, $part_class ) {
		$out = '<div class="sf-countdown-item"><span class="sf-countdown-digits ' . $part_class . '"></span>';
		if ( $settings['show_labels'] ) {
			$default_labels = $this->get_default_countdown_labels();
			$label = ( $settings['custom_labels'] ) ? $settings[ $label ] : $default_labels[ $label ];
			$out .= ' <span class="sf-countdown-label">' . $label . '</span>';
		}
		$out .= '</div>';
		return $out;
	}

	protected function render() {
		$settings = $this->get_settings();
		$due_date = $settings['due_date'];
		// Handle timezone ( we need to set GMT time )
		$due_date = strtotime( $due_date ) - ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
		?>
		<div class="sf-countdown" data-date="<?php echo esc_attr( $due_date ); ?>">
		<?php 
			if ( $settings['show_days'] ) {
				echo $this->get_countdown_item( $settings, 'label_days', 'sf-countdown-days' );
			}
			if ( $settings['show_hours'] ) {
				echo $this->get_countdown_item( $settings, 'label_hours', 'sf-countdown-hours' );
			}
			if ( $settings['show_minutes'] ) {
				echo $this->get_countdown_item( $settings, 'label_minutes', 'sf-countdown-minutes' );
			}
			if ( $settings['show_seconds'] ) {
				echo $this->get_countdown_item( $settings, 'label_seconds', 'sf-countdown-seconds' );
			}
		?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Countdown() );