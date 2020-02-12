<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Button extends Widget_Base {

	public function get_name() {
		return 'sf-button';
	}

	public function get_title() {
		return __( 'Button', 'spirit' );
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
			'section_button',
			[
				'label' => __( 'Button', 'spirit' ),
			]
		);

		$this->add_control(
			'button_type',
			[
				'label' => __( 'Type', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => sf_get_option_button_styles()
			]
		);

		$this->add_control(
			'text',
			[
				'label' => __( 'Text', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Button Text', 'spirit' ),
				'placeholder' => __( 'Button Text', 'spirit' ),
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
					'url' => '#',
				],
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
					'lg' => __( 'Large', 'spirit' ),
				],
				'style_transfer' => true,
			]
		);

		if ( self::default_icon_control() ) {
			$this->add_control(
				'selected_icon',
				[
					'label' => __( 'Icon', 'spirit' ),
					'type' => Controls_Manager::ICONS,
					'label_block' => true
				]
			);
		} else {
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'spirit' ),
					'type' => 'sf_icon',
					'label_block' => true,
					'default' => ''
				]
			);
		}

		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Icon Position', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Before', 'spirit' ),
					'right' => __( 'After', 'spirit' ),
				]
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
				]
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'spirit' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'button_id',
			[
				'label' => __( 'Button ID', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'spirit' ),
				'label_block' => false,
				'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'spirit' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_class',
			[
				'label' => __( 'Button Class', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'title' => __( 'Add your custom classes', 'spirit' ),
				'label_block' => false,
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
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

		$this->add_render_attribute( 'wrapper', 'class', 'btn-wrapper' );

		if ( !empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'button', 'class', 'btn' );
		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( !empty( $settings['button_type'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'btn-' . $settings['button_type'] );
		} else {
			$this->add_render_attribute( 'button', 'class', 'btn-primary' );
		}

		if ( !empty( $settings['button_id'] ) ) {
			$this->add_render_attribute( 'button', 'id', $settings['button_id'] );
		}

		if ( !empty( $settings['button_class'] ) ) {
			$this->add_render_attribute( 'button', 'class', $settings['button_class'] );
		}

		if ( !empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'btn-' . $settings['size'] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php $this->render_text(); ?>
			</a>
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
	protected function render_text() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'icon_align' => [
				'class' => [
					'btn-icon',
					'btn-align-icon-' . $settings['icon_align']
				],
			],
			'text' => [
				'class' => 'btn-text'
			]
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span class="btn-text-wrapper">
			<?php if ( !empty( $settings['selected_icon']['value'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'icon_align' ); ?>>
					<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
				</span>
			<?php elseif ( !empty( $settings['icon'] ) ) : ?>
				<span <?php echo $this->get_render_attribute_string( 'icon_align' ); ?>>
					<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
				</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['text']; ?></span>
		</span>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Button() );