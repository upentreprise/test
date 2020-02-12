<?php

namespace Elementor;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class SF_Products extends Widget_Base {

    public function get_name() {
        return 'sf-products';
    }

    public function get_title() {
        return esc_attr__( 'Woo Products', 'spirit' );
    }

    public function get_icon() {
        return 'eicon-products sf-addons-label';
    }

    public function get_categories() {
        return array( 'sf-addons' );
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    public function get_script_depends() {
        return [
            'sf-frontend',
            'swiper',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_attr__( 'Products', 'spirit' ),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __( 'Layout', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'grid' => __( 'Grid', 'spirit' ),
                    'carousel' => __( 'Carousel', 'spirit' ),
                ],
                'default' => 'carousel',
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __( 'Columns', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    1 => __( '1', 'spirit' ),
                    2 => __( '2', 'spirit' ),
                    3 => __( '3', 'spirit' ),
                    4 => __( '4', 'spirit' ),
                    6 => __( '6', 'spirit' ),
                    '' => __( 'Default', 'spirit' ),
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 1,
                'condition' => [
                    'layout!' => 'carousel',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_query',
            [
                'label' => esc_attr__( 'Query', 'spirit' ),
            ]
        );

        $this->add_control(
            'products',
            [
                'label' => __( 'Products', 'spirit' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => sf_get_option_posts( 'product' ),
            ]
        );

        $this->add_control(
            'categories',
            [
                'label' => esc_attr__( 'Categories', 'spirit' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => sf_get_option_terms( 'product_cat' ),
            ]
        );

        $this->add_control(
            'tags',
            [
                'label' => esc_attr__( 'Tags', 'spirit' ),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => sf_get_option_terms( 'product_tag' ),
            ]
        );

        $this->add_control(
            'show',
            [
                'label' => __( 'Show', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__( 'All products', 'spirit' ),
                    'featured' => esc_html__( 'Featured products', 'spirit' ),
                    'onsale' => esc_html__( 'On-sale products', 'spirit' ),
                ),
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __( 'Number of products to show', 'spirit' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => __( 'Offset', 'spirit' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __( 'Order By', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'date' => esc_html__( 'Date', 'spirit' ),
                    'price' => esc_html__( 'Price', 'spirit' ),
                    'rand' => esc_html__( 'Random', 'spirit' ),
                    'sales' => esc_html__( 'Sales', 'spirit' ),
                ),
                'default' => 'date',
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Order', 'spirit' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'desc' => esc_html__( 'DESC', 'spirit' ),
                    'asc' => esc_html__( 'ASC', 'spirit' ),
                ),
                'default' => 'desc',
            ]
        );

        $this->add_control(
            'hide_free',
            [
                'label' => __( 'Hide free products', 'spirit' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
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
                'desktop_default' => 4,
                'tablet_default' => 2,
                'mobile_default' => 1,
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
            'speed',
            [
                'label' => __( 'Animation Speed', 'spirit' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 300,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout_style',
            [
                'label' => esc_attr__( 'Layout', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'spirit' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                'selectors' => [
                    '{{WRAPPER}} .sf-products .product-info' => 'text-align: {{VALUE}};',
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

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'exclude' => [ 'custom' ],
                'default' => 'shop_catalog',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_navigation_style',
            [
                'label' => esc_attr__( 'Navigation', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE
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

		$this->add_control(
			'bullets_color',
			[
				'label' => __( 'Bullets Color', 'spirit' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sf-swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'bullets_active_color',
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

    protected function render() {
        $settings = $this->get_settings_for_display();
        $products = $this->get_products( $settings );
        if ( $products && $products->have_posts() ) :
        ?>
        <div class="woocommerce">
            <div class="sf-products">
                <div class="products clearfix">
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
                                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                                <div class="swiper-slide"><?php $this->loop_product( $settings['thumbnail_size'] ); ?></div>
                                <?php endwhile; ?>
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
                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                        <div class="<?php echo esc_attr( $this->get_column_class( $settings ) ); ?>">
                        <?php $this->loop_product( $settings['thumbnail_size'] ); ?>
                        </div>
                    <?php endwhile; ?>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        endif;
        wp_reset_postdata();
    }

    /**
     * Get products query
     * @param  array $settings  widget settings
     * @return array            products query
     */
    private function get_products( $settings ) {
        $number = !empty( $settings['number'] ) ? absint( $settings['number'] ) : 4;
        $show = !empty( $settings['show'] ) ? sanitize_title( $settings['show'] ) : '';
        $orderby = !empty( $settings['orderby'] ) ? sanitize_title( $settings['orderby'] ) : 'date';
        $order = !empty( $settings['order'] ) ? sanitize_title( $settings['order'] ) : 'desc';
        $product_visibility_term_ids = wc_get_product_visibility_term_ids();

        $query_args = array(
            'posts_per_page' => $number,
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'no_found_rows'  => 1,
            'order'          => $order,
            'meta_query'     => array(),
            'tax_query'      => array(
                'relation' => 'AND',
            ),
        );

        if ( !empty( $settings['products'] ) ) {
            $query_args['post__in'] = $settings['products'];
        }

        if ( !empty( $settings['offset'] ) ) {
            $query_args['offset'] = $settings['offset'];
        }

        if ( ! empty( $settings['hide_free'] ) ) {
            $query_args['meta_query'][] = array(
                'key'     => '_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'DECIMAL',
            );
        }

        if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['outofstock'],
                    'operator' => 'NOT IN',
                ),
            );
        }

        switch ( $show ) {
            case 'featured':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['featured'],
                );
                break;
            case 'onsale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $query_args['post__in'] = $product_ids_on_sale;
                break;
        }

        switch ( $orderby ) {
            case 'price':
                $query_args['meta_key'] = '_price'; // WPCS: slow query ok.
                $query_args['orderby']  = 'meta_value_num';
                break;
            case 'rand':
                $query_args['orderby'] = 'rand';
                break;
            case 'sales':
                $query_args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
                $query_args['orderby']  = 'meta_value_num';
                break;
            default:
                $query_args['orderby'] = 'date';
        }

        return new \WP_Query( $query_args );
    }

    /**
     * Print loop product
     * @param  string $thumbnail_size product thumbnail size
     */
    public function loop_product( $thumbnail_size = 'shop_catalog' ) {
        ?>
        <div <?php wc_product_class(); ?>>
            <div class="product-body">
                <div class="product-thumb">
                    <?php woocommerce_template_loop_product_link_open(); ?>
                    <?php woocommerce_show_product_loop_sale_flash(); ?>
                    <?php echo woocommerce_get_product_thumbnail( $thumbnail_size ); ?>
                    </a>
                </div>
                <div class="product-info">
                    <h3 class="woocommerce-loop-product__title">
                        <a href="<?php echo esc_url_raw( get_the_permalink() ); ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                    </h3>
                    <div class="product-meta">
                        <?php woocommerce_template_loop_price(); ?>
                        <?php woocommerce_template_loop_rating(); ?>
                    </div>
                    <div class="product-buttons">
                        <?php if ( function_exists( 'tinv_get_option' ) ) : ?>
                        <?php echo do_shortcode("[ti_wishlists_addtowishlist loop=yes]"); ?>
                        <?php endif; ?>
                        <?php woocommerce_template_loop_add_to_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
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
            case 6: $classes .= 'col-lg-2'; break;
            default: $classes .= 'col-lg-2'; break;
        }
        switch ( $settings['columns_tablet'] ) {
            case 1: $classes .= ' col-md-12'; break;
            case 2: $classes .= ' col-md-6'; break;
            case 3: $classes .= ' col-md-4'; break;
            case 4: $classes .= ' col-md-3'; break;
            case 6: $classes .= ' col-md-2'; break;
            default: $classes .= ' col-md-3'; break;
        }
        switch ( $settings['columns_mobile'] ) {
            case 1: $classes .= ' col-12'; break;
            case 2: $classes .= ' col-6'; break;
            case 3: $classes .= ' col-4'; break;
            case 4: $classes .= ' col-3'; break;
            case 6: $classes .= ' col-2'; break;
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
        $spacing_desktop = ( '' != $settings['spacing']['size'] ) ? intval( $settings['spacing']['size'] ) : 30;
        $spacing_tablet = ( '' != $settings['spacing_tablet']['size'] ) ? intval( $settings['spacing_tablet']['size'] ) : $spacing_desktop;
        $spacing_mobile = ( '' != $settings['spacing_mobile']['size'] ) ? intval( $settings['spacing_mobile']['size'] ) : $spacing_tablet;

        $slider_settings['autoHeight'] = true;
        $slider_settings['watchOverflow'] = true;
        $slider_settings['slidesPerView'] = !empty( $settings['slides_to_show'] ) ? intval( $settings['slides_to_show'] ) : 4;
        $slider_settings['slidesToScroll'] = !empty( $settings['slides_to_scroll'] ) ? intval( $settings['slides_to_scroll'] ) : 1;
        $slider_settings['spaceBetween'] = $spacing_desktop;
        $slider_settings['loop'] = ( $settings['loop'] == 'yes' );
        $slider_settings['speed'] = isset( $settings['speed'] ) ? $settings['speed'] : 300;
        $slider_settings['breakpoints'] = [
            1024 => [
                'slidesPerView' => !empty( $settings['slides_to_show_tablet'] ) ? intval( $settings['slides_to_show_tablet'] ) : 2,
                'spaceBetween' => $spacing_tablet,
            ],
            768 => [
                'slidesPerView' => !empty( $settings['slides_to_show_mobile'] ) ? intval( $settings['slides_to_show_mobile'] ) : 1,
                'spaceBetween' => $spacing_mobile,
            ],
            360 => [
                'slidesPerView' => 1,
                'spaceBetween' => 0,
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
        
        if ( !empty( $settings['navigation'] ) ) {
            $slider_settings['navigation'] = [
                'prevEl' => $settings['prev_btn_selector'],
                'nextEl' => $settings['next_btn_selector'],
            ];
        }

        if ( !empty( $settings['pagination'] ) && $settings['pagination'] ) {
            $slider_settings['pagination'] = [
                'el' => $settings['pagination_selector'],
                'clickable' => true,
                'type' => $settings['pagination'],
            ];
        }

        return $slider_settings;
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Products() );