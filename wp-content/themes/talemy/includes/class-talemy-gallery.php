<?php
/**
 * Extend gallery features
 *
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_Gallery {

	public function __construct() {
        // Use jetpack gallery instead of default gallery
        if ( !class_exists( 'Jetpack' ) || !Jetpack::is_module_active( 'tiled-gallery' ) ) {
            add_filter( 'post_gallery', array( $this, 'gallery_shortcode' ), 10, 3 );
        }

        if ( is_admin() ) {
            add_action( 'print_media_templates', array( $this, 'gallery_settings' ) );
        }
	}

    /**
     * Gallery shortcode
     * @param string $output   The gallery output. Default empty.
     * @param array  $attr     Attributes of the gallery shortcode.
     * @param int    $instance Unique numeric ID of this gallery shortcode instance.
     * @return string          gallery html
     */
    public function gallery_shortcode( $output = '', $atts, $instance ) {
        global $post;

        $html5 = current_theme_supports( 'html5', 'gallery' );
        $atts = shortcode_atts( array(
            'order'          => 'ASC',
            'orderby'        => 'menu_order ID',
            'id'             => $post ? $post->ID : 0,
            'itemtag'        => $html5 ? 'figure'     : 'dl',
            'icontag'        => $html5 ? 'div'        : 'dt',
            'captiontag'     => $html5 ? 'figcaption' : 'dd',
            'columns'        => 3,
            'size'           => 'thumbnail',
            'include'        => '',
            'exclude'        => '',
            'link'           => '',
            'ids'            => '',
            'style'          => 'WordPress',
            'autoplay'       => false,
            'autoplay_speed' => '',
            'loop'           => false,
            'lightbox'       => false,
        ), $atts, 'gallery' );

        $image_ids = array();
        if ( !is_array( $atts['ids'] ) ) {
            $image_ids = explode( ',', $atts['ids'] );
        }
        
        if ( empty( $image_ids ) ) {
            return $output;
        }

        if ( $atts['style'] != 'WordPress' ) {
            // enqueue swiper script
            wp_enqueue_script( 'jquery-swiper' );

            // slider settings
            $slider_settings = [];
            $slider_settings['autoHeight'] = true;
            $slider_settings['watchOverflow'] = true;
            $slider_settings['slidesPerView'] = 1;
            $slider_settings['slidesToScroll'] = 1;
            $slider_settings['loop'] = $atts['loop'];
            $autoplay = filter_var( $atts['autoplay'], FILTER_VALIDATE_BOOLEAN );

            if ( $autoplay ) {
                if ( !empty( $atts['autoplay_speed'] ) ) {
                    $slider_settings['autoplay'] = [
                        'delay' => intval( $atts['autoplay_speed'] )
                    ];
                } else {
                    $slider_settings['autoplay'] = true;
                }
            }

            $slider_settings['navigation'] = [
                'prevEl' => '.sf-swiper-btn-prev',
                'nextEl' => '.sf-swiper-btn-next',
            ];

            $slider_settings['pagination'] = [
                'el' => '.sf-swiper-pagination',
                'clickable' => true,
                'type' => 'bullets'
            ];

            // main gallery output
            $output .= '<div class="post-gallery">';
            $output .= '<div class="sf-swiper-container sf-arrows--skin-2">';
            $output .= '<div class="swiper-container" data-settings='. wp_json_encode( $slider_settings ) .'>';
            $output .= '<div class="swiper-wrapper">';
            foreach ( $image_ids as $image_id ) {
                $output .= '<div class="swiper-slide">';
                $output .= wp_get_attachment_image( intval( $image_id ), $atts['size'] );
                $output .= '</div>';
            }
            $output .= '</div>';
            $output .= '<div class="sf-swiper-btn sf-swiper-btn-prev"><span class="prev">'. esc_html__( 'Prev', 'talemy' ) .'</span></div><div class="sf-swiper-btn sf-swiper-btn-next"><span class="next">'. esc_html__( 'Next', 'talemy' ) .'</span></div>';
            $output .= '</div>';
            $output .= '<div class="sf-swiper-pagination"></div>';
            $output .= '</div></div>';

            return $output;
        }

        // WordPress gallery_shortcode

        $id = intval( $atts['id'] );

        if ( ! empty( $atts['include'] ) ) {
            $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( ! empty( $atts['exclude'] ) ) {
            $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
        } else {
            $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
        }

        if ( empty( $attachments ) ) {
            return '';
        }

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment ) {
                $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
            }
            return $output;
        }

        $itemtag = tag_escape( $atts['itemtag'] );
        $captiontag = tag_escape( $atts['captiontag'] );
        $icontag = tag_escape( $atts['icontag'] );
        $valid_tags = wp_kses_allowed_html( 'post' );
        if ( ! isset( $valid_tags[ $itemtag ] ) ) {
            $itemtag = 'dl';
        }
        if ( ! isset( $valid_tags[ $captiontag ] ) ) {
            $captiontag = 'dd';
        }
        if ( ! isset( $valid_tags[ $icontag ] ) ) {
            $icontag = 'dt';
        }

        $columns = intval( $atts['columns'] );
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";

        $gallery_style = '';

        /**
         * Filters whether to print default gallery styles.
         *
         * @since 3.1.0
         *
         * @param bool $print Whether to print default gallery styles.
         *                    Defaults to false if the theme supports HTML5 galleries.
         *                    Otherwise, defaults to true.
         */
        if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
            $gallery_style = "
            <style type='text/css'>
                #{$selector} {
                    margin: auto;
                }
                #{$selector} .gallery-item {
                    float: {$float};
                    margin-top: 10px;
                    text-align: center;
                    width: {$itemwidth}%;
                }
                #{$selector} img {
                    border: 2px solid #cfcfcf;
                }
                #{$selector} .gallery-caption {
                    margin-left: 0;
                }
                /* see gallery_shortcode() in wp-includes/media.php */
            </style>\n\t\t";
        }

        $size_class = sanitize_html_class( $atts['size'] );
        $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

        /**
         * Filters the default gallery shortcode CSS styles.
         *
         * @since 2.5.0
         *
         * @param string $gallery_style Default CSS styles and opening HTML div container
         *                              for the gallery shortcode output.
         */
        $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

        $i = 0;
        foreach ( $attachments as $id => $attachment ) {

            $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
            $enable_lightbox = filter_var( $atts['lightbox'], FILTER_VALIDATE_BOOLEAN );
            
            if ( $enable_lightbox ) {
                if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
                    $image_output = "<a data-fancy='gallery-{$instance}' class='fancy-link' href='". wp_get_attachment_url( $id ) . "'> ". wp_get_attachment_image( $id, $atts['size'], false, $attr ) ."</a>";
                } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
                    $image_output = "<a data-fancy='gallery-{$instance}' class='fancy-link' href='". wp_get_attachment_url( $id ) . "'> ". wp_get_attachment_image( $id, $atts['size'], false, $attr ) ."</a>";
                } else {
                    $image_output = "<a data-fancy='gallery-{$instance}' class='fancy-link' href='". wp_get_attachment_url( $id ) . "'> ". wp_get_attachment_image( $id, $atts['size'], false, $attr ) ."</a>";
                }
            } else {
                if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
                    $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
                } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
                    $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
                } else {
                    $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
                }
            }

            $image_meta  = wp_get_attachment_metadata( $id );

            $orientation = '';
            if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
                $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
            }
            $output .= "<{$itemtag} class='gallery-item'>";
            $output .= "
                <{$icontag} class='gallery-icon {$orientation}'>
                    $image_output
                </{$icontag}>";
            if ( $captiontag && trim($attachment->post_excerpt) ) {
                $output .= "
                    <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
                    " . wptexturize($attachment->post_excerpt) . "
                    </{$captiontag}>";
            }
            $output .= "</{$itemtag}>";
            if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
                $output .= '<br style="clear: both" />';
            }
        }

        if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
            $output .= "
                <br style='clear: both' />";
        }

        $output .= "
            </div>\n";

        return $output;
    }

    /**
     * Custom gallery settings
     */
    public function gallery_settings() {
      // define your backbone template;
      // the "tmpl-" prefix is required,
      // and your input field should have a data-setting attribute
      // matching the shortcode name
      ?>
        <script type="text/html" id="tmpl-talemy-gallery-settings">
        <hr style="float:left;width:100%;margin:15px 0;">
        <label class="setting">
            <span><?php esc_html_e( 'Gallery', 'talemy' ); ?></span>
            <select data-setting="style">
                <option value="theme"><?php esc_html_e( 'Talemy Gallery', 'talemy' ); ?></option>
                <option value="WordPress"><?php esc_html_e( 'WordPress Default', 'talemy' ); ?></option>
            </select>
        </label>
        <label class="setting">
            <span><?php esc_html_e( 'Infinite Loop', 'talemy' ); ?></span>
            <input type="checkbox" data-setting="loop">
        </label>
        <label class="setting">
            <span><?php esc_html_e( 'Autoplay', 'talemy' ); ?></span>
            <input type="checkbox" data-setting="autoplay" checked>
        </label>
        <label class="setting">
            <span><?php esc_html_e( 'Autoplay Speed', 'talemy' ); ?></span>
            <input type="text" data-setting="autoplay_speed" value="" style="width:99%;">
        </label>
        </script>
        <script>
            jQuery(document).ready(function() {
                // add your shortcode attribute and its default value to the
                // gallery settings list; $.extend should work as well...
                _.extend(wp.media.gallery.defaults, {
                    style: 'WordPress',
                    autoplay: 'false',
                    autoplay_speed: '3000',
                    loop: 'false',
                });

                // merge default gallery settings template with yours
                wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
                    template: function(view){
                        return wp.media.template('gallery-settings')(view) + wp.media.template('talemy-gallery-settings')(view);
                    }
                });
            });
        </script>
        <?php
    }

}

new Talemy_Gallery();