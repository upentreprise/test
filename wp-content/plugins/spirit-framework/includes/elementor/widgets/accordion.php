<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Accordion extends Widget_Base {

	public function get_name() {
		return 'sf-accordion';
	}

	public function get_title() {
		return __( 'Accordion', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-accordion sf-addons-label';
	}

    public function get_categories() {
        return [ 'sf-addons' ];
    }

	public function get_keywords() {
		return [ 'accordion', 'tabs', 'toggle', 'sf' ];
	}

	public static function default_icon_control() {
		return apply_filters( 'sf_elementor_default_icon_control', false );
	}

	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Accordion', 'spirit' ),
			]
		);

  		$this->add_control(
		  'accordion_type',
		  	[
		   	'label' => esc_html__( 'Accordion Type', 'spirit' ),
		     	'type' => Controls_Manager::SELECT,
		     	'default' => 'accordion',
		     	'label_block' => false,
		     	'options' => [
		     		'accordion' => esc_html__( 'Accordion', 'spirit' ),
		     		'toggle' => esc_html__( 'Toggle', 'spirit' ),
		     	],
		  	]
		);

		if ( self::default_icon_control() ) {
			$this->add_control(
				'selected_icon',
				[
					'label' => __( 'Icon', 'spirit' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-plus-circle',
						'library' => 'solid'
					],
					'separator' => 'before',
				]
			);
	
			$this->add_control(
				'selected_icon_active',
				[
					'label' => __( 'Active Icon', 'spirit' ),
					'type' => Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-minus-circle',
						'library' => 'solid'
					],
					'condition' => [
						'selected_icon[value]!' => '',
					]
				]
			);
		} else {
			$this->add_control(
				'icon',
				[
					'label' => __( 'Icon', 'spirit' ),
					'type' => 'sf_icon',
					'default' => 'fas fa-plus-circle',
					'separator' => 'before',
				]
			);
	
			$this->add_control(
				'icon_active',
				[
					'label' => __( 'Active Icon', 'spirit' ),
					'type' => 'sf_icon',
					'default' => 'fas fa-minus-circle',
					'condition' => [
						'icon!' => '',
					],
				]
			);
		}

		$this->add_control(
			'title_html_tag',
			[
				'label' => __( 'Title HTML Tag', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
				],
				'default' => 'div',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_items',
			[
				'label' => __( 'Items', 'spirit' ),
			]
		);

		$this->add_control(
			'items',
			[
				'label' => __( 'Accordion Items', 'spirit' ),
				'type' => Controls_Manager::REPEATER,
				'separator' => 'before',
				'fields' => [
					[
						'name' => 'item_active',
						'label' => __( 'Active Item', 'spirit' ),
						'type' => Controls_Manager::SWITCHER,
						'default' => 'no',
					],
					[
						'name' => 'item_title',
						'label' => __( 'Title & Content', 'spirit' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'Accordion Title', 'spirit' ),
						'dynamic' => [
							'active' => true,
						],
						'label_block' => true,
					],
					[
						'name' => 'item_content',
						'label' => __( 'Content', 'spirit' ),
						'type' => Controls_Manager::WYSIWYG,
						'default' => __( 'Accordion Content', 'spirit' ),
						'show_label' => false,
					]
				],
				'default' => [
					[
						'item_active' => 'yes',
						'item_title' => __( 'Accordion #1', 'spirit' ),
						'item_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'spirit' ),
					],
					[
						'item_active' => '',
						'item_title' => __( 'Accordion #2', 'spirit' ),
						'item_content' => __( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio, neque qui velit. Magni dolorum quidem ipsam eligendi, totam, facilis laudantium cum accusamus ullam voluptatibus commodi numquam, error, est. Ea, consequatur.', 'spirit' ),
					],
				],
				'title_field' => '{{{ item_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Accordion', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => __( 'Border Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__item' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__content' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item.active .sf-accordion__title' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_active_color',
			[
				'label' => __( 'Border Active Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__item:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item:hover .sf-accordion__content' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item:hover .sf-accordion__title' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item.active' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item.active .sf-accordion__content' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item.active .sf-accordion__title' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__item' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sf-accordion__content' => 'border-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sf-accordion__item.active .sf-accordion__title' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'items_spacing',
			[
				'label' => __( 'Spacing', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => __( 'Title', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_title_colors' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'spirit' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active', 'spirit' ),
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item.active .sf-accordion__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_active_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__title:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item.active .sf-accordion__title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .sf-accordion__title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		if ( self::default_icon_control() ) {
			$section_icon_condition = [ 'selected_icon[value]!' => '' ];
		} else {
			$section_icon_condition = [ 'icon!' => '' ];
		}

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => __( 'Icon', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => $section_icon_condition
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => __( 'Alignment', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Start', 'spirit' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'End', 'spirit' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => is_rtl() ? 'right' : 'left',
				'toggle' => false,
				'label_block' => false,
				'prefix_class' => 'sf-accordion--icon-'
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__icon i:before' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' => __( 'Active Icon Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__title:hover .sf-accordion__icon i:before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sf-accordion__item.active .sf-accordion__icon i:before' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_responsive_control(
			'icon_space',
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
					'{{WRAPPER}}.sf-accordion--icon-left .sf-accordion__icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.sf-accordion--icon-right .sf-accordion__icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				]
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

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__content' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .sf-accordion__content',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .sf-accordion__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sf-accordion" data-toggle="<?php echo ( 'toggle' == $settings['accordion_type'] ); ?>" role="tablist">
		<?php
			foreach ( $settings['items'] as $index => $item ) :
				
				$item_title_setting_key = $this->get_repeater_setting_key( 'item_title', 'items', $index );
				$item_content_setting_key = $this->get_repeater_setting_key( 'item_content', 'items', $index );

				$this->add_render_attribute( $item_title_setting_key, [
					'class' => [ 'sf-accordion__title' ],
					'role' => 'tab',
				] );

				$this->add_render_attribute( $item_content_setting_key, [
					'class' => [ 'sf-accordion__content', 'clearfix' ],
					'role' => 'tabpanel',
				] );

				$this->add_inline_editing_attributes( $item_content_setting_key, 'advanced' );
				?>
				<div class="sf-accordion__item<?php if ( $item['item_active'] == 'yes' ) { echo ' active'; } ?>">
					<<?php echo $settings['title_html_tag']; ?> <?php echo $this->get_render_attribute_string( $item_title_setting_key ); ?>>
						<?php if ( !empty( $settings['selected_icon']['value'] ) ) : ?>
							<span class="sf-accordion__icon" aria-hidden="true">
								<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'class' => 'sf-accordion__icon-closed' ] ); ?>
								<?php if ( !empty( $settings['selected_icon_active']['value'] ) ) : ?>
									<?php Icons_Manager::render_icon( $settings['selected_icon_active'], [ 'class' => 'sf-accordion__icon-opened' ] ); ?>
								<?php endif; ?>
							</span>
						<?php elseif ( !empty( $settings['icon'] ) ) : ?>
							<span class="sf-accordion__icon" aria-hidden="true">
								<i class="sf-accordion__icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
								<i class="sf-accordion__icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>"></i>
							</span>
						<?php endif; ?>
						<span class="sf-accordion__title-text"><?php echo $item['item_title']; ?></span>
					</<?php echo $settings['title_html_tag']; ?>>
					<div <?php echo $this->get_render_attribute_string( $item_content_setting_key ); ?>><?php echo $this->parse_text_editor( $item['item_content'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Accordion() );