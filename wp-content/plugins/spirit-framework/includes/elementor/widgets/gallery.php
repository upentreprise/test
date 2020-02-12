<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SF_Gallery extends Widget_Base {

    static public $gallery_instance = 0;

    public function get_name() {
        return 'sf-gallery';
    }

    public function get_title() {
        return __( 'Gallery', 'spirit' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid sf-addons-label';
    }

    public function get_categories() {
        return [ 'sf-addons' ];
    }

    public function get_keywords() {
        return [ 'sf' ];
    }

    public function get_style_depends() {
        return [
            'fancybox'
        ];
    }

    public function get_script_depends() {
        return [
            'fancybox',
            'isotope',
            'imagesloaded',
            'sf-frontend',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_gallery',
            [
                'label' => __( 'Gallery', 'spirit' ),
            ]
        );

        $this->add_control(
            'bulk_upload',
            [
                'label' => __( 'Bulk upload images?', 'spirit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'spirit' ),
                'label_off' => __( 'No', 'spirit' ),
                'default' => '',
            ]
        );

        $this->add_control(
            'gallery_images',
            [
                'label' => __( 'Add Images', 'spirit' ),
                'type' => Controls_Manager::GALLERY,
                'condition' => [
                    'bulk_upload!' => ''
                ],
            ]
        );

        $this->add_control(
            'gallery_items',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => [

                    [
                        'name' => 'item_image',
                        'label' => __( 'Image', 'spirit' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],

                    [
                        'name' => 'item_column_span',
                        'label' => __( 'Column Span', 'spirit' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4',
                            '5' => '5',
                            '6' => '6',
                        ],
                        'default' => '1',
                    ],

                    [
                        'name' => 'item_title',
                        'label' => __( 'Title', 'spirit' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'placeholder' => __( 'Enter your title', 'spirit' ),
                        'default' => '',
                        'separator' => 'before'
                    ],

                    [
                        'name' => 'item_tags',
                        'label' => __( 'Tag(s)', 'spirit' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'description' => __( 'One or more comma separated tags for the gallery item. Will be used as filters for the items.', 'spirit' ),
                    ],

                    [
                        'name' => 'item_link',
                        'label' => __( 'Link to', 'spirit' ),
                        'label_block' => true,
                        'type' => Controls_Manager::URL,
                        'dynamic' => [
                            'active' => true,
                        ],
                        'placeholder' => __( 'http://your-link.com', 'spirit' ),
                    ],

                ],

                'title_field' => '{{{ item_title }}}',
                'condition' => [
                    'bulk_upload' => ''
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label' => __( 'Options', 'spirit' ),
            ]
        );

        $this->add_control(
            'enable_lightbox',
            [
                'type' => Controls_Manager::SWITCHER,
                'label' => __( 'Enable Lightbox Gallery', 'spirit' ),
                'label_off' => __( 'No', 'spirit' ),
                'label_on' => __( 'Yes', 'spirit' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_filters',
            [
                'label' => __( 'Show Image Filters', 'spirit' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'spirit' ),
                'label_off' => __( 'No', 'spirit' ),
                'default' => 'yes',
                'condition' => [
                    'bulk_upload' => ''
                ],
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => __( 'Columns', 'spirit' ),
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
            ]
        );

        $this->add_control(
            'layout_mode',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Layout Mode', 'spirit' ),
                'options' => array(
                    'fitRows' => __( 'Fit Rows', 'spirit' ),
                    'masonry' => __( 'Masonry', 'spirit' ),
                ),
                'default' => 'fitRows',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'label' => __( 'Gallery Image Size', 'spirit' ),
                'default' => 'large',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pagination',
            [
                'label' => __( 'Pagination', 'spirit' ),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'type' => Controls_Manager::SELECT,
                'label' => __( 'Pagination', 'spirit' ),
                'options' => array(
                    'none' => __( 'None', 'spirit' ),
                    'load_more' => __( 'Load More', 'spirit' ),
                ),
                'default' => 'none',
            ]
        );

        $this->add_control(
            'items_per_page',
            [
                'label' => __( 'Items Per Page', 'spirit' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'default' => 8,
                'condition' => [
                    'pagination' => 'load_more',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_filters_styling',
            [
                'label' => __( 'Filters', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'filter_colors' );

        $this->start_controls_tab(
            'filter_color_normal',
            [
                'label' => __( 'Normal', 'spirit' ),
            ]
        );

        $this->add_control(
            'filter_text_color',
            [
                'label' => __( 'Text Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sf-gallery__filter' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_bg_color',
            [
                'label' => __( 'Background Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sf-gallery__filter' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'filter_color_active',
            [
                'label' => __( 'Active', 'spirit' ),
            ]
        );

        $this->add_control(
            'filter_active_text_color',
            [
                'label' => __( 'Text Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sf-gallery__filter.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'filter_active_bg_color',
            [
                'label' => __( 'Background Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sf-gallery__filter.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'filter_padding',
            [
                'label' => __( 'Padding', 'spirit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .sf-gallery__filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'filter_typography',
                'selector' => '{{WRAPPER}} .sf-gallery__filter',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_images_styling',
            [
                'label' => __( 'Images', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'spacing',
            [
                'label' => __( 'Spacing', 'spirit' ),
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
                    '{{WRAPPER}} .sf-gallery-item' => 'padding: calc({{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .sf-gallery__items' => 'margin: calc({{SIZE}}{{UNIT}}/-2);',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_overlay_color',
            [
                'label' => __( 'Overlay Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-gallery-item__overlay' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item_title_styling',
            [
                'label' => __( 'Item Title', 'spirit' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_title_color',
            [
                'label' => __( 'Title Color', 'spirit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sf-gallery-item__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_title_typography',
                'selector' => '{{WRAPPER}} .sf-gallery-item__title',
            ]
        );

        $this->end_controls_section();
    }

    protected function get_data_settings( $settings ) {
        return [
            'columns' => $settings['columns'],
            'columns_tablet' => $settings['columns_tablet'],
            'columns_mobile' => $settings['columns_mobile'],
            'enable_lightbox' => $settings['enable_lightbox'],
            'gallery_id' => $settings['gallery_id'],
            'layout_mode' => $settings['layout_mode'],
            'items' => $settings['items'],
            'items_per_page' => $settings['items_per_page'],
            'thumbnail_size' => $settings['thumbnail_size'],
        ];
    }

    protected function render() {
        $settings = $this->get_settings();

        self::$gallery_instance ++;

        $settings['gallery_id'] = self::$gallery_instance;
        $items = $settings['bulk_upload'] == 'yes' ? $settings['gallery_images'] : $settings['gallery_items'];

        if ( !empty( $items ) ) {
            echo '<div id="sf-gallery-' . self::$gallery_instance . '" class="sf-gallery">';

            $filters_html = $tags = '';
            $images = [];

            if ( 'yes' === $settings['bulk_upload'] ) {
 
                foreach ( $items as $item ) {
                    if ( !empty( $item['id'] ) ) {
                        $image = get_post( $item['id'] );
                        $images[] = [
                            'colspan' => 1,
                            'id' => $item['id'],
                            'link' => '',
                            'tags' => '',
                            'title' => $image->post_excerpt,
                            'url' => $item['url'],
                        ];
                    }
                }

            } else {
                
                foreach ( $items as $item ) {
                    if ( !empty( $item['item_image']['id'] ) ) {
                        $images[] =
                        [
                            'colspan' => $item['item_column_span'],
                            'id' => $item['item_image']['id'],
                            'link' => $item['item_link'],
                            'tags' => empty( $item['item_tags'] ) ? '' : str_replace( ',', ' ', strtolower( $item['item_tags'] ) ),
                            'title' => $item['item_title'],
                            'url' => $item['item_image']['url'],
                        ];
                    }
                    
                    if ( !empty( $item['item_tags'] ) ) {
                        $tags .= ','. $item['item_tags'];
                    }
                }

                if ( 'yes' == $settings['show_filters'] && !empty( $tags ) ) {
                    $tags = substr( $tags, 1 );
                    $tags = explode( ',', $tags );
                    $tags = array_unique( $tags );
                    $filters_html .= '<div class="sf-gallery__filters">'
                                  .'<button class="sf-gallery__filter active" data-filter="*">'. esc_html__( 'All', 'lava' ) .'</button>';
                    foreach ( $tags as $tag ) {
                        $filters_html .= '<button class="sf-gallery__filter" data-filter=".'. esc_attr( strtolower( $tag ) ) .'">'. esc_html( $tag ) .'</button>';
                    }
                    $filters_html .= '</div>';
                    
                    echo $filters_html;
                }

            }

            $items_per_page = absint( $settings['items_per_page' ] );
            $show_load_more = 'load_more' == $settings['pagination'] && count( $images ) > $items_per_page ? true : false;
            $data_items = [];

            if ( $show_load_more ) {
                $data_items = array_slice( $images, $items_per_page );
                $images = array_slice( $images, 0, $items_per_page );
            }
            $settings['items'] = $data_items;
            ?>
            <div class="sf-gallery__items"
                data-settings='<?php echo wp_json_encode( $this->get_data_settings( $settings ) ); ?>'
                data-max-pages="<?php echo ceil( count( $data_items ) / $items_per_page ) + 1; ?>"
                data-page="1">
                <div class="sf-grid-sizer" data-colspan="1"></div>
                <?php sf_display_gallery_items( $images, $settings ); ?>
            </div>
            <?php if ( $show_load_more ) : ?>
                <div class="sf-gallery__footer">
                    <a href="javascript:void(0)" class="btn btn-primary sf-gallery__load-more">
                        <span class="load-text"><?php esc_html_e( 'Load more', 'spirit' ); ?></span>
                        <span class="loading-text"><?php esc_html_e( 'Loading...', 'spirit' ); ?></span>
                    </a>
                </div>
            <?php endif;

            if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
                $this->render_editor_script();
            }
            echo '</div>';
        }
    }

    /**
     * Print editor script.
     *
     * @access protected
     */
    protected function render_editor_script() {

        ?><script type="text/javascript">
            jQuery(document).ready(function($) {
                var $container = $('#sf-gallery-<?php echo self::$gallery_instance; ?>').find('.sf-gallery__items');
                var settings = $container.data('settings');
                layoutMode = settings.layout_mode;
                enableLightbox = settings.enable_lightbox;
                
                var columns = settings.columns;
                var tabletQuery = window.matchMedia('(max-width: ' + 900 + 'px)');
                var mobileQuery = window.matchMedia('(max-width: ' + 600 + 'px)');
                
                if (mobileQuery.matches) {
                    columns = settings.columns_mobile;
                } else if (tabletQuery.matches) {
                    columns = settings.columns_tablet;
                }

                var columnWidth = (1/columns)*100;

                $container.children().each(function() {
                    var $grid = $(this);
                    var colSpan = $grid.data('colspan');
                    colSpan = Math.max(Math.min(colSpan, columns), 1);
                    if (columns == 2 && tabletQuery.matches) {
                        colSpan = 1;
                    }
                    $grid.css('width', parseFloat(Math.floor(columnWidth*colSpan*10000)/10000) + '%');
                });

                $container.imagesLoaded(function() {
                    $container.children().css('visibility', 'visible');

                    var gallery = $container.isotope({
                        itemSelector: '.sf-gallery-item',
                        layoutMode: layoutMode,
                        percentPosition: true,
                        resizable: true,
                        fitRows: {
                            gutter: 0,
                        },
                        masonry: {
                            columnWidth: '.sf-grid-sizer',
                            gutter: 0,
                        }
                    });

                    var $filters = $container.siblings('.sf-gallery__filters');

                    if ($filters.length) {
                        $filters.on('click', 'button', function() {
                            var $button = $(this);
                            if (!$button.hasClass('active')) {
                                $button.addClass('active').siblings('.active').removeClass('active');
                                var filterValue = $button.attr('data-filter');
                                gallery.isotope({ filter: filterValue });
                            }
                        });
                    }
                });
            });
        </script>
        <?php
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new SF_Gallery() );