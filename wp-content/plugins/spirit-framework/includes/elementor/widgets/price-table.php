<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Price_Table extends Widget_Base {

	public function get_name() {
		return 'sf-price-table';
	}

	public function get_title() {
		return __( 'Price Table', 'spirit' );
	}

	public function get_icon() {
		return 'eicon-price-table sf-addons-label';
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
			'section_header',
			[
				'label' => __( 'Header', 'spirit' ),
			]
		);

		$this->add_control(
			'heading',
			[
				'label' => __( 'Title', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Title', 'spirit' ),
			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label' => __( 'Subtitle', 'spirit' ),
				'type' => Controls_Manager::TEXT,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pricing',
			[
				'label' => __( 'Pricing', 'spirit' ),
			]
		);

		$this->add_control(
			'currency_symbol',
			[
				'label' => __( 'Currency Symbol', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'spirit' ),
					'dollar' => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'spirit' ),
					'euro' => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'spirit' ),
					'baht' => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'spirit' ),
					'franc' => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'spirit' ),
					'guilder' => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'spirit' ),
					'krona' => 'kr ' . _x( 'Krona', 'Currency Symbol', 'spirit' ),
					'lira' => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'spirit' ),
					'peseta' => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'spirit' ),
					'peso' => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'spirit' ),
					'pound' => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'spirit' ),
					'real' => 'R$ ' . _x( 'Real', 'Currency Symbol', 'spirit' ),
					'ruble' => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'spirit' ),
					'rupee' => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'spirit' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'spirit' ),
					'shekel' => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'spirit' ),
					'yen' => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'spirit' ),
					'won' => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'spirit' ),
					'custom' => __( 'Custom', 'spirit' ),
				],
				'default' => 'dollar',
			]
		);

		$this->add_control(
			'currency_symbol_custom',
			[
				'label' => __( 'Custom Symbol', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'currency_symbol' => 'custom',
				],
			]
		);

		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => '39.99',
			]
		);

		$this->add_control(
			'currency_format',
			[
				'label' => __( 'Currency Format', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => '1,234.56 (Default)',
					',' => '1.234,56',
				],
			]
		);

		$this->add_control(
			'sale',
			[
				'label' => __( 'Sale', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'spirit' ),
				'label_off' => __( 'Off', 'spirit' ),
				'default' => '',
			]
		);

		$this->add_control(
			'original_price',
			[
				'label' => __( 'Original Price', 'spirit' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '59',
				'condition' => [
					'sale' => 'yes',
				],
			]
		);

		$this->add_control(
			'period',
			[
				'label' => __( 'Period', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Monthly', 'spirit' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_items',
			[
				'label' => __( 'Items', 'spirit' ),
			]
		);

		if ( self::default_icon_control() ) {
			$item_icon_control = [
				'name' => 'item_selected_icon',
				'label' => __( 'Icon', 'spirit' ),
				'type' => Controls_Manager::ICONS
			];
		} else {
			$item_icon_control = [
				'name' => 'item_icon',
				'label' => __( 'Icon', 'spirit' ),
				'type' => 'sf_icon'
			];
		}
		
		$this->add_control(
			'items',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'item_text',
						'label' => __( 'Text', 'spirit' ),
						'type' => Controls_Manager::TEXT,
						'default' => __( 'List Item', 'spirit' ),
					],
					
					$item_icon_control,
					
					[
						'name' => 'item_icon_color',
						'label' => __( 'Icon Color', 'spirit' ),
						'type' => Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
						],
					]
				],
				'default' => [
					[
						'item_text' => __( 'List Item #1', 'spirit' ),
					],
					[
						'item_text' => __( 'List Item #2', 'spirit' ),
					],
					[
						'item_text' => __( 'List Item #3', 'spirit' ),
					],
					[
						'item_text' => __( 'List Item #4', 'spirit' ),
					],
					[
						'item_text' => __( 'List Item #5', 'spirit' ),
					],
				],
				'title_field' => '{{{ item_text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer',
			[
				'label' => __( 'Footer', 'spirit' ),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Buy Now', 'spirit' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'spirit' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'spirit' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'footer_additional_info',
			[
				'label' => __( 'Additional Info', 'spirit' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'rows' => 2,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon',
			[
				'label' => __( 'Ribbon', 'spirit' ),
			]
		);

		$this->add_control(
			'show_ribbon',
			[
				'label' => __( 'Show', 'spirit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'ribbon_title',
			[
				'label' => __( 'Title', 'spirit' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Popular', 'spirit' ),
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ribbon_horizontal_position',
			[
				'label' => __( 'Horizontal Position', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'spirit' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'spirit' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_main_style',
			[
				'label' => __( 'Main', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'main_border',
				'selector' => '{{WRAPPER}} .sf-price-table__main',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_header_style',
			[
				'label' => __( 'Header', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'header_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__header' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_heading_style',
			[
				'label' => __( 'Premium', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'selector' => '{{WRAPPER}} .sf-price-table__heading',
			]
		);

		$this->add_control(
			'heading_sub_heading_style',
			[
				'label' => __( 'Sub Title', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_heading_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__subheading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'sub_heading_typography',
				'selector' => '{{WRAPPER}} .sf-price-table__subheading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pricing_element_style',
			[
				'label' => __( 'Pricing', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'pricing_element_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__price' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'pricing_element_padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__currency, {{WRAPPER}} .sf-price-table__integer-part, {{WRAPPER}} .sf-price-table__fractional-part' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .sf-price-table__price-inner',
			]
		);

		$this->add_control(
			'heading_currency_style',
			[
				'label' => __( 'Currency Symbol', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'currency_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__currency' => 'font-size: calc({{SIZE}}em/100)',
				],
				'condition' => [
					'currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'currency_position',
			[
				'label' => __( 'Position', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default' => 'before',
				'options' => [
					'before' => [
						'title' => __( 'Before', 'spirit' ),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [
						'title' => __( 'After', 'spirit' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_control(
			'currency_vertical_position',
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
					'{{WRAPPER}} .sf-price-table__currency' => 'align-self: {{VALUE}}',
				],
				'condition' => [
					'currency_symbol!' => '',
				],
			]
		);

		$this->add_control(
			'fractional_part_style',
			[
				'label' => __( 'Fractional Part', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'fractional-part_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__fractional-part' => 'font-size: calc({{SIZE}}em/100)',
				],
			]
		);

		$this->add_control(
			'fractional_part_vertical_position',
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
					'{{WRAPPER}} .sf-price-table__after-price' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'heading_original_price_style',
			[
				'label' => __( 'Original Price', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'sale' => 'yes',
					'original_price!' => '',
				],
			]
		);

		$this->add_control(
			'original_price_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__original-price' => 'color: {{VALUE}}',
				],
				'condition' => [
					'sale' => 'yes',
					'original_price!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'original_price_typography',
				'selector' => '{{WRAPPER}} .sf-price-table__original-price',
				'condition' => [
					'sale' => 'yes',
					'original_price!' => '',
				],
			]
		);

		$this->add_control(
			'original_price_vertical_position',
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
				'selectors_dictionary' => [
					'top' => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'default' => 'bottom',
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__original-price' => 'align-self: {{VALUE}}',
				],
				'condition' => [
					'sale' => 'yes',
					'original_price!' => '',
				],
			]
		);

		$this->add_control(
			'heading_period_style',
			[
				'label' => __( 'Period', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_control(
			'period_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__period' => 'color: {{VALUE}}',
				],
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->add_control(
			'period_position',
			[
				'label' => __( 'Position', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
				'options' => [
					'below' => __( 'Below', 'spirit' ),
					'beside' => __( 'Beside', 'spirit' ),
				],
				'default' => 'below',
				'condition' => [
					'period!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item_style',
			[
				'label' => __( 'Items', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_responsive_control(
			'items_padding',
			[
				'label' => __( 'Items Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__items' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => __( 'Item Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__items li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'item_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__items' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'item_alignment',
			[
				'label' => __( 'Alignment', 'spirit' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
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
					],
				],
				'selectors_dictionary' => [
					'left' => 'flex-start',
					'center' => 'center',
					'right' => 'flex-end',
				],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__item-inner' => 'justify-content: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer_style',
			[
				'label' => __( 'Footer', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			]
		);

		$this->add_control(
			'footer_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__footer' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'footer_padding',
			[
				'label' => __( 'Padding', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_footer_button',
			[
				'label' => __( 'Button', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_size',
			[
				'label' => __( 'Size', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'sm' => __( 'Small', 'spirit' ),
					'' => __( 'Medium', 'spirit' ),
					'lg' => __( 'Large', 'spirit' ),
				],
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_style',
			[
				'label' => __( 'Button Style', 'spirit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'outline-dark',
				'options' => sf_get_option_button_styles()
			]
		);

		$this->add_control(
			'heading_additional_info',
			[
				'label' => __( 'Additional Info', 'spirit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'footer_additional_info!' => '',
				],
			]
		);

		$this->add_control(
			'additional_info_color',
			[
				'label' => __( 'Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__additional_info' => 'color: {{VALUE}}',
				],
				'condition' => [
					'footer_additional_info!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'additional_info_typography',
				'selector' => '{{WRAPPER}} .sf-price-table__additional_info',
				'condition' => [
					'footer_additional_info!' => '',
				],
			]
		);

		$this->add_control(
			'additional_info_margin',
			[
				'label' => __( 'Margin', 'spirit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default' => [
					'top' => 15,
					'right' => 30,
					'bottom' => 0,
					'left' => 30,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__additional_info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'condition' => [
					'footer_additional_info!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_style',
			[
				'label' => __( 'Ribbon', 'spirit' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition' => [
					'show_ribbon' => 'yes',
				],
			]
		);

		$this->add_control(
			'ribbon_bg_color',
			[
				'label' => __( 'Background Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__ribbon-inner' => 'background-color: {{VALUE}}',
				],
			]
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$this->add_responsive_control(
			'ribbon_distance',
			[
				'label' => __( 'Distance', 'spirit' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__ribbon-inner' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
				],
			]
		);

		$this->add_control(
			'ribbon_text_color',
			[
				'label' => __( 'Text Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ffffff',
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sf-price-table__ribbon-inner' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .sf-price-table__ribbon-inner',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'selector' => '{{WRAPPER}} .sf-price-table__ribbon-inner',
			]
		);

		$this->end_controls_section();
	}

	private function render_currency_symbol( $symbol, $location ) {
		$currency_position = $this->get_settings( 'currency_position' );
		$location_setting = ! empty( $currency_position ) ? $currency_position : 'before';
		if ( ! empty( $symbol ) && $location === $location_setting ) {
			echo '<span class="sf-price-table__currency sf-currency--' . $location . '">' . $symbol . '</span>';
		}
	}

	private function get_currency_symbol( $symbol_name ) {
		$symbols = [
			'dollar' => '&#36;',
			'euro' => '&#128;',
			'franc' => '&#8355;',
			'pound' => '&#163;',
			'ruble' => '&#8381;',
			'shekel' => '&#8362;',
			'baht' => '&#3647;',
			'yen' => '&#165;',
			'won' => '&#8361;',
			'guilder' => '&fnof;',
			'peso' => '&#8369;',
			'peseta' => '&#8359',
			'lira' => '&#8356;',
			'rupee' => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real' => 'R$',
			'krona' => 'kr',
		];
		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	protected function render() {
		$settings = $this->get_settings();
		$symbol = '';

		if ( ! empty( $settings['currency_symbol'] ) ) {
			if ( 'custom' !== $settings['currency_symbol'] ) {
				$symbol = $this->get_currency_symbol( $settings['currency_symbol'] );
			} else {
				$symbol = $settings['currency_symbol_custom'];
			}
		}
		$currency_format = empty( $settings['currency_format'] ) ? '.' : $settings['currency_format'];
		$price = explode( $currency_format, $settings['price'] );
		$intpart = $price[0];
		$fraction = '';
		if ( 2 === count( $price ) ) {
			$fraction = $price[1];
		}

		$this->add_render_attribute( 'button_text', 'class', [
			'sf-price-table__button',
			'btn',
			!empty( $settings['button_size'] ) ? 'btn-'. $settings['button_size'] : '',
			!empty( $settings['button_style'] ) ? 'btn-'. $settings['button_style'] : 'btn-outline-dark',
		] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'button_text', 'href', $settings['link']['url'] );

			if ( ! empty( $settings['link']['is_external'] ) ) {
				$this->add_render_attribute( 'button_text', 'target', '_blank' );
			}
		}

		if ( ! empty( $settings['button_hover_animation'] ) ) {
			$this->add_render_attribute( 'button_text', 'class', 'sf-animation-' . $settings['button_hover_animation'] );
		}

		$this->add_render_attribute( 'heading', 'class', 'sf-price-table__heading' );
		$this->add_render_attribute( 'sub_heading', 'class', 'sf-price-table__subheading' );
		$this->add_render_attribute( 'period', 'class', ['sf-price-table__period', 'sf-typo-excluded'] );
		$this->add_render_attribute( 'footer_additional_info', 'class', 'sf-price-table__additional_info' );
		$this->add_render_attribute( 'ribbon_title', 'class', 'sf-price-table__ribbon-inner' );

		$this->add_inline_editing_attributes( 'heading', 'none' );
		$this->add_inline_editing_attributes( 'sub_heading', 'none' );
		$this->add_inline_editing_attributes( 'period', 'none' );
		$this->add_inline_editing_attributes( 'footer_additional_info' );
		$this->add_inline_editing_attributes( 'button_text' );
		$this->add_inline_editing_attributes( 'ribbon_title' );

		$period_position = $settings['period_position'];
		$period_element = '<span ' . $this->get_render_attribute_string( 'period' ) . '>' . $settings['period'] . '</span>';
		
		?>
		<div class="sf-price-table">
			<?php if ( $settings['heading'] || $settings['sub_heading'] ) : ?>
				<div class="sf-price-table__header">
					<?php if ( ! empty( $settings['heading'] ) ) : ?>
						<h3 <?php echo $this->get_render_attribute_string( 'heading' ); ?>><?php echo $settings['heading']; ?></h3>
					<?php endif; ?>

					<?php if ( ! empty( $settings['sub_heading'] ) ) : ?>
						<span <?php echo $this->get_render_attribute_string( 'sub_heading' ); ?>><?php echo $settings['sub_heading']; ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="sf-price-table__main">
				<div class="sf-price-table__price">
					<div class="sf-price-table__price-inner">
						<?php if ( 'yes' === $settings['sale'] && ! empty( $settings['original_price'] ) ) : ?>
							<div class="sf-price-table__original-price sf-typo-excluded"><?php echo $symbol . $settings['original_price']; ?></div>
						<?php endif; ?>
						<?php $this->render_currency_symbol( $symbol, 'before' ); ?>
						<?php if ( ! empty( $intpart ) || 0 <= $intpart ) : ?>
							<span class="sf-price-table__integer-part"><?php echo $intpart; ?></span>
						<?php endif; ?>

						<?php if ( '' !== $fraction || ( ! empty( $settings['period'] ) && 'beside' === $period_position ) ) : ?>
							<div class="sf-price-table__after-price">
								<span class="sf-price-table__fractional-part"><?php echo $fraction; ?></span>

								<?php if ( ! empty( $settings['period'] ) && 'beside' === $period_position ) : ?>
									<?php echo $period_element; ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php $this->render_currency_symbol( $symbol, 'after' ); ?>

						<?php if ( ! empty( $settings['period'] ) && 'below' === $period_position ) : ?>
							<?php echo $period_element; ?>
						<?php endif; ?>
					</div>
				</div>

				<?php if ( ! empty( $settings['items'] ) ) : ?>
					<ul class="sf-price-table__items">
						<?php foreach ( $settings['items'] as $index => $item ) :
							$repeater_setting_key = $this->get_repeater_setting_key( 'item_text', 'item', $index );
							$this->add_inline_editing_attributes( $repeater_setting_key );
							?>
							<li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
								<div class="sf-price-table__item-inner">
									<?php if ( ! empty( $item['item_selected_icon']['value'] ) ) : ?>
										<?php Icons_Manager::render_icon( $item['item_selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									<?php elseif ( ! empty( $item['item_icon'] ) ): ?>
										<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
									<?php endif; ?>
									<?php if ( ! empty( $item['item_text'] ) ) : ?>
										<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>>
											<?php echo $item['item_text']; ?>
										</span>
									<?php else :
										echo '&nbsp;';
									endif;
									?>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if ( ! empty( $settings['button_text'] ) || ! empty( $settings['footer_additional_info'] ) ) : ?>
					<div class="sf-price-table__footer">
						<?php if ( ! empty( $settings['button_text'] ) ) : ?>
							<a <?php echo $this->get_render_attribute_string( 'button_text' ); ?>><?php echo $settings['button_text']; ?></a>
						<?php endif; ?>

						<?php if ( ! empty( $settings['footer_additional_info'] ) ) : ?>
							<div <?php echo $this->get_render_attribute_string( 'footer_additional_info' ); ?>><?php echo $settings['footer_additional_info']; ?></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				
				<?php if ( 'yes' === $settings['show_ribbon'] && ! empty( $settings['ribbon_title'] ) ) :
					$this->add_render_attribute( 'ribbon-wrapper', 'class', 'sf-price-table__ribbon' );

					if ( ! empty( $settings['ribbon_horizontal_position'] ) ) :
						$this->add_render_attribute( 'ribbon-wrapper', 'class', 'sf-ribbon-' . $settings['ribbon_horizontal_position'] );
					endif;

					?>
					<div <?php echo $this->get_render_attribute_string( 'ribbon-wrapper' ); ?>>
						<div <?php echo $this->get_render_attribute_string( 'ribbon_title' ); ?>><?php echo $settings['ribbon_title']; ?></div>
					</div>
				<?php endif; ?>

			</div>
		</div>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Price_Table() );