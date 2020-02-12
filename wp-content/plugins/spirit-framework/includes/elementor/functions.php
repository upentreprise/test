<?php

add_action( 'wp_ajax_sf_load_gallery_items', 'sf_load_gallery_items' );
add_action( 'wp_ajax_nopriv_sf_load_gallery_items', 'sf_load_gallery_items' );

/**
 * Load ajax items
 */
function sf_load_gallery_items() {
    $page_number = isset( $_POST['page_number'] ) ? $_POST['page_number'] : 1;
    $settings = isset( $_POST['settings'] ) ? $_POST['settings'] : array();
    $items_per_page = !empty( $settings['items_per_page'] ) ? $settings['items_per_page'] : 5;
    $items = !empty( $settings['items'] ) ? $settings['items'] : array();
    $offset = ( $page_number - 1 ) * $items_per_page;
    $images = array_slice( $items, $offset, $items_per_page );
    sf_display_gallery_items( $images, $settings );
    exit;
}

/**
 * Display gallery items
 * 
 * @param  array $images   images
 * @param  array $settings widget settings
 */
function sf_display_gallery_items( $images, $settings ) {
    foreach ( $images as $image ) : ?>
        <div class="sf-gallery-item <?php echo esc_attr( $image['tags'] ); ?>" data-colspan="<?php echo esc_attr( $image['colspan'] ); ?>">
            <div class="sf-gallery__image">
                <?php if ( 'yes' == $settings['enable_lightbox'] ) : ?>
                <a data-fancybox="sf-gallery-<?php echo esc_attr( $settings['gallery_id'] ); ?>" class="sf-lightbox__item" href="<?php echo esc_url( $image['url'] ); ?>" title="<?php echo esc_attr( $image['title'] ); ?>">
                    <?php echo wp_get_attachment_image( $image['id'], $settings['thumbnail_size'] ); ?>
                </a>
                <?php else : echo wp_get_attachment_image( $image['id'], $settings['thumbnail_size'] ); endif; ?>
                <div class="sf-gallery-item__overlay"></div>
                <?php if ( !empty( $image['title'] ) ) : ?>
                    <h4 class="sf-gallery-item__title">
                    <?php if ( !empty( $image['link']['url'] ) ) : ?>
                        <?php $target = $image['link']['is_external'] ? ' target="_blank"' : ''; ?>
                        <?php $rel = $image['link']['nofollow'] ? ' rel="nofollow"' : ''; ?>
                        <a href="<?php echo esc_url( $image['link']['url'] ); ?>"<?php echo $target; echo $rel; ?>>
                            <?php echo esc_html( $image['title'] ); ?>
                        </a>
                    <?php else : ?>
                        <span><?php echo esc_html( $image['title'] ); ?></span>
                    <?php endif; ?>
                    </h4>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach;
}