<?php

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !function_exists( 'talemy_get_option' ) ) {
	/**
	 * Get option
	 * Helper function to retrieve theme option value.
	 * 
	 * @param  string $key      option key
	 * @param  mixed  $default  default value
	 * @return mixed            option value
	 */
	function talemy_get_option( $key, $default = '' ) {
		if ( is_customize_preview() ) {
			return get_theme_mod( $key, $default );
		}

		$theme_options = Talemy_Options::get_options();

		if ( isset( $theme_options[ $key ] ) ) {
			if ( '' === $theme_options[ $key ] && !empty( $default ) ) {
				return $default;
			}
			return $theme_options[ $key ];
		}

		return $default;
	}
}

if ( !function_exists( 'talemy_set_option' ) ) {
	/**
	 * Set option
	 * Helper function to set option value.
	 * 
	 * @param  string $key      option key
	 * @param  mixed  $default  default value
	 * @return mixed            option value
	 */
	function talemy_set_option( $key, $value = '' ) {
		global $talemy_global_option;
		$talemy_global_option[ $key ] = $value;
	}
}

if ( !function_exists( 'talemy_echo_option_attr' ) ) {
	/**
	 * Echo option as attribute
	 * 
	 * @param  string $key      option key
	 * @param  string $prefix   output prefix
	 * @param  string $suffix   output suffix
	 * @return string attribute
	 */
	function talemy_echo_option_attr( $key, $default = '', $prefix = '', $suffix = '' ) {
		$theme_options = Talemy_Options::get_options();

		if ( !empty( $theme_options[ $key ] ) ) {
			echo esc_attr( $prefix . (string) $theme_options[ $key ] . $suffix );
		} else {
			echo esc_attr( $prefix . $default . $suffix );
		}
	}
}

if ( !function_exists( 'talemy_get_post_meta' ) ) {
	/**
	 * Get post meta
	 * Helper function to retrieve meta value.
	 * 
	 * @param  string $meta_key      meta key
	 * @param  mixed  $default       default value
	 * @param  int $post_id       post_id
	 * @return mixed                 meta value
	 */
	function talemy_get_post_meta( $meta_key = '', $default = '', $post_id = null ) {

		if ( !isset( $meta_key ) ) {
			return '';
		}

		if ( is_null( $post_id ) ) {
			global $post;
			$post_id = isset( $post->ID ) ? $post->ID : 0;
		}

		$meta_data = get_post_meta( $post_id, $meta_key, true );

		if ( isset( $meta_data ) ) {
			if ( '' == $meta_data && !empty( $default ) ) {
				return $default;
			}
			return $meta_data;
		}
		return $default;
	}
}

if ( !function_exists( 'talemy_set_setting' ) ) {
	/**
	 * Set setting
	 * 
	 * @param  string $key   setting name
	 * @param  mixed  $value
	 */
	function talemy_set_setting( $key, $value ) {
		global $talemy_global_settings;

		$talemy_global_settings[ $key ] = $value;
	}
}

if ( !function_exists( 'talemy_get_setting' ) ) {
	/**
	 * Get setting
	 * 
	 * @param  string $key     setting name
	 * @param  array  $default default value
	 */
	function talemy_get_setting( $key, $default = '', $allow_empty = false ) {
		global $talemy_global_settings;
		$value = '';

		if ( isset( $talemy_global_settings[ $key ] ) ) {
			$value = $talemy_global_settings[ $key ];
		}

		if ( !$allow_empty && '' === $value ) {
			$value = $default;
		}

		return $value;
	}
}

if ( !function_exists( 'talemy_set_template_settings' ) ) {
	/**
	 * Set template settings
	 * 
	 * @param  string $template template name
	 * @param  array  $default values
	 */
	function talemy_set_template_settings( $template, $args = array( 'sidebar' => 'default-sidebar' ) ) {
		global $talemy_global_settings;

		if ( 'archive' === $template ) {
			if ( is_category() ) {
				$template = 'category';
			} else if ( is_tag() ) {
				$template = 'tag';
			} else if ( is_author() ) {
				$template = 'author';
			}
		}

		$talemy_global_settings['template'] 	    = $template;
		$talemy_global_settings['layout'] 		    = talemy_get_option( $template .'_layout' );
		$talemy_global_settings['sidebar'] 		    = talemy_get_option( $template .'_sidebar' );
		$talemy_global_settings['banner'] 		    = talemy_get_option( $template .'_banner' );
		$talemy_global_settings['banner_image']     = talemy_get_option( $template .'_banner_image' );
		$talemy_global_settings['banner_shortcode'] = talemy_get_option( $template .'_banner_shortcode' );
		$talemy_global_settings['container'] 		= 'container';

		if ( $template == 'bbp' ) {
			return;
		}

		$talemy_global_settings['list_style']       = $list_style = talemy_get_option( $template .'_list_style' );
		$talemy_global_settings['thumb_size']       = talemy_get_option( $template .'_thumb_size' );
		$talemy_global_settings['columns']          = talemy_get_option( $template .'_columns' );
		$talemy_global_settings['tablet_columns']   = talemy_get_option( $template .'_tablet_columns' );
		$talemy_global_settings['mobile_columns']   = talemy_get_option( $template .'_mobile_columns' );
		$talemy_global_settings['pagination']       = talemy_get_option( $template .'_pagination' );
		$talemy_global_settings['ppl']      	    = talemy_get_option( $template .'_ppl' );
		$talemy_global_settings['max_loads']        = talemy_get_option( $template .'_max_loads' );
		
		if ( 'masonry' == $list_style ) {
			wp_enqueue_script( 'isotope' );
		}

		if ( 'category' == $template || 'tag' == $template || 'ld_courses' == $template ) {
			$banner_image_id 						= get_term_meta( get_queried_object_id(), '_sf_banner_image', true );
			$talemy_global_settings['banner_image'] = wp_get_attachment_url( $banner_image_id );
		}

		if ( 'ld_courses' == $template ) {
			$list_style = $list_style == 'grid2' ? 'grid' : $list_style;
			$talemy_global_settings[ $list_style .'_meta_data' ] = talemy_get_option( 'ld_courses_meta_data' );
		}
	}
}

if ( !function_exists( 'talemy_set_ld_single_settings' ) ) {
	/**
	 * Set template settings
	 * 
	 * @param  string $template template name
	 * @param  array  $default values
	 */
	function talemy_set_ld_single_settings() {
		global $talemy_global_settings;

		$talemy_global_settings['container'] = 'container';
		$talemy_global_settings['layout'] = $layout = talemy_get_option( 'ld_course_layout' );
		$talemy_global_settings['sidebar'] = talemy_get_option( 'ld_sidebar' );
		$talemy_global_settings['banner'] = talemy_get_option( 'ld_banner' );
		$talemy_global_settings['banner_image'] = talemy_get_option( 'ld_banner_image' );
		$talemy_global_settings['banner_shortcode'] = talemy_get_option( 'ld_banner_shortcode' );
		$talemy_global_settings['post_style'] = talemy_get_option( 'ld_course_style' );
		$talemy_global_settings['post_thumb_size'] = 'sidebar-right' == $layout || 'sidebar-left' == $layout ? 'talemy_thumb_medium_x' : 'talemy_thumb_large_x';
		$extra = get_post_meta( get_the_ID(), '_ld_custom_meta', true );
		$talemy_global_settings['post_embed_code'] = isset( $extra['embed_code'] ) ? $extra['embed_code'] : '';
	}
}

if ( !function_exists( 'talemy_set_wc_settings' ) ) {
	/**
	 * Set WooCommerce template settings
	 * 
	 * @param  string $template template name - archive, single
	 * @param  array  $default values
	 */
	function talemy_set_wc_settings( $template ) {
		global $talemy_global_settings;

		$talemy_global_settings['container'] = 'container';
		$option_key_prefix = $template === 'product' ? 'wc_product_' : 'wc_';
		$post_id = is_shop() ? get_option( 'woocommerce_shop_page_id' ) : null;
		
		if ( is_shop() || is_product() ) {
			$talemy_global_settings['layout'] = talemy_get_post_meta( '_sf_layout', talemy_get_option( $option_key_prefix . 'layout' ), $post_id );
			$talemy_global_settings['sidebar'] = talemy_get_post_meta( '_sf_sidebar', talemy_get_option( $option_key_prefix . 'sidebar' ), $post_id );
			$talemy_global_settings['banner'] = talemy_get_post_meta( '_sf_banner', talemy_get_option( $option_key_prefix . 'banner' ), $post_id );
			$talemy_global_settings['banner_image'] = talemy_get_post_meta( '_sf_banner_image', talemy_get_option( $option_key_prefix . 'banner_image' ), $post_id );
			$talemy_global_settings['banner_shortcode'] = talemy_get_post_meta( '_sf_banner_shortcode', talemy_get_option( $option_key_prefix . 'banner_shortcode' ), $post_id );
		} else {
			$talemy_global_settings['layout'] = talemy_get_option( $option_key_prefix . 'layout' );
			$talemy_global_settings['sidebar'] = talemy_get_option( $option_key_prefix . 'sidebar' );
			$talemy_global_settings['banner'] = talemy_get_option( $option_key_prefix . 'banner' );
			$talemy_global_settings['banner_image'] = talemy_get_option( $option_key_prefix . 'banner_image' );
			$talemy_global_settings['banner_shortcode'] = talemy_get_option( $option_key_prefix . 'banner_shortcode' );
		}
	}
}

if ( !function_exists( 'talemy_set_page_settings' ) ) {
	/**
	 * Set page settings
	 * 
	 * @param  string $template template name
	 * @param  array  $default values
	 */
	function talemy_set_page_settings() {
		global $talemy_global_settings;

		$talemy_global_settings['template'] = 'page';
		$talemy_global_settings['container'] = talemy_get_post_meta( '_sf_container', 'no_container' );
		$talemy_global_settings['layout'] = talemy_get_post_meta( '_sf_layout', talemy_get_option( 'page_layout' ) );
		$talemy_global_settings['sidebar'] = talemy_get_post_meta( '_sf_sidebar', talemy_get_option( 'page_sidebar' ) );
		$talemy_global_settings['banner'] = $banner = talemy_get_post_meta( '_sf_banner', '' );

		if ( '' == $banner ) {
			$banner_image_id = talemy_get_post_meta( '_sf_banner_image', talemy_get_option( 'page_banner_image' ) );
			$talemy_global_settings['banner_image'] = wp_get_attachment_url( $banner_image_id );
		} else if ( 'shortcode' == $banner ) {
			$talemy_global_settings['banner_shortcode'] = talemy_get_post_meta( '_sf_banner_shortcode', talemy_get_option( 'page_banner_shortcode' ) );
		}

		if ( class_exists( 'WooCommerce' ) ) {
			if ( is_checkout() || is_cart() ) {
				$talemy_global_settings['layout'] = 'full-width';
			}
		}
		return;
	}
}

if ( !function_exists( 'talemy_set_post_settings' ) ) {
	/**
	 * Set post settings
	 */
	function talemy_set_post_settings() {
		global $talemy_global_settings;

		$talemy_global_settings['post_style'] = talemy_get_post_meta( '_sf_post_style', talemy_get_option( 'post_style' ) );
		$talemy_global_settings['layout'] = $layout = talemy_get_post_meta( '_sf_layout', talemy_get_option( 'post_layout' ) );
		$talemy_global_settings['sidebar'] = talemy_get_post_meta( '_sf_sidebar', talemy_get_option( 'post_sidebar' ) );
		$talemy_global_settings['banner'] = $banner = talemy_get_option( 'post_banner' );

		if ( '' == $banner ) {
			$banner_image_id = talemy_get_option( 'post_banner_image' );
			$talemy_global_settings['banner_image'] = wp_get_attachment_url( $banner_image_id );
		} else if ( 'shortcode' == $banner ) {
			$talemy_global_settings['banner_shortcode'] = talemy_get_option( 'post_banner_shortcode' );
		}

		$talemy_global_settings['post_embed_code'] = talemy_get_post_meta( '_sf_embed_code', '' );
		$talemy_global_settings['post_thumb_size'] = 'sidebar-right' == $layout || 'sidebar-left' == $layout ? 'talemy_thumb_medium_x' : 'talemy_thumb_large_x';
		$talemy_global_settings['post_categories'] = talemy_get_option( 'post_categories');
		$talemy_global_settings['post_tags'] = talemy_get_option( 'post_tags');
		$talemy_global_settings['post_author_box'] = talemy_get_option( 'post_author_box' );
		$talemy_global_settings['post_adjacent'] = talemy_get_option( 'post_adjacent' );
		$talemy_global_settings['post_related'] = talemy_get_option( 'post_related' );
		$talemy_global_settings['post_related_type'] = talemy_get_option( 'post_related_type' );
		$talemy_global_settings['post_related_count'] = talemy_get_option( 'post_related_count' );
		$talemy_global_settings['post_comments'] = talemy_get_option( 'post_comments' );
		$talemy_global_settings['post_meta_data'] = talemy_get_option( 'post_meta_data' );
		$talemy_global_settings['post_share'] = talemy_get_option( 'post_share' );
		
	}
}

if ( !function_exists( 'talemy_set_list_settings' ) ) {
	/**
	 * Set block posts settings
	 * 
	 * @param  string $key   setting name
	 * @param  mixed  $value
	 */
	function talemy_set_list_settings() {
		global $talemy_global_settings;
		$list_style 						  = talemy_get_setting( 'list_style' );
		$layout 							  = talemy_get_setting( 'layout' );
		$talemy_global_settings['thumb_size'] = talemy_get_setting( 'thumb_size' );

		if ( !empty( $list_style ) ) {

			if ( 'list' == $list_style ) {
				$talemy_global_settings['list_class'] = 'post-list';
				$talemy_global_settings['post_class'] = 'loop-post post-style-list';
			} else {
				$list_style 	= $list_style == 'grid2' ? 'grid' : $list_style;
				$columns 		= talemy_get_setting( 'columns' );
				$columns_tablet = talemy_get_setting( 'tablet_columns' );
				$columns_mobile = talemy_get_setting( 'mobile_columns' );
				$columns 		= isset( $columns ) ? ' columns-' . $columns  : ' columns-3';
				$columns_tablet = isset( $columns_tablet ) ? ' tablet-columns-' . $columns_tablet : ' tablet-columns-2';
				$columns_mobile = isset( $columns_mobile ) ? ' mobile-columns-' . $columns_mobile : ' mobile-columns-1';
	
				$talemy_global_settings['post_class'] = 'loop-post post-style-' . $list_style;
				$talemy_global_settings['list_class'] = 'post-list row' . $columns . $columns_tablet . $columns_mobile;

				if ( 'masonry' == $list_style ) {
					$talemy_global_settings['list_class'] .= ' masonry';
				}
			}
		}

		$talemy_global_settings[ $list_style . '_category' ] = talemy_get_option( $list_style . '_category' );
		
		if ( talemy_get_option( $list_style . '_excerpt' ) ) {
			$talemy_global_settings[ $list_style . '_excerpt_limit' ] = talemy_get_option( $list_style . '_excerpt_limit' );
		} else {
			$talemy_global_settings[ $list_style . '_excerpt_limit' ] = 0;
		}

		if ( !isset( $talemy_global_settings[ $list_style . '_meta_data' ] ) ) {
			$talemy_global_settings[ $list_style . '_meta_data' ] = talemy_get_option( $list_style . '_meta_data' );
		}
	}
}

if ( !function_exists( 'talemy_set_block_settings' ) ) {
	/**
	 * Set block posts settings
	 * 
	 * @param  string $key   setting name
	 * @param  mixed  $value
	 */
	function talemy_set_block_settings( $atts ) {
		global $talemy_global_settings;

		$talemy_global_settings['list_style'] = $list_style = isset( $atts['list_style'] ) ? $atts['list_style'] : 'grid';
		$talemy_global_settings['thumb_size'] = isset( $atts['thumbnail_size'] ) ? $atts['thumbnail_size'] : 'talemy_thumb_small';

		if ( 'list' == $list_style ) {
			$talemy_global_settings['list_class'] = 'post-list';
			$talemy_global_settings['post_class'] = 'loop-post post-style-list';
		} else {
			$list_style = 'grid';
			$columns = isset( $atts['columns'] ) ? ' columns-' . $atts['columns']  : ' columns-3';
			$columns_tablet = isset( $atts['columns_tablet'] ) ? ' tablet-columns-' . $atts['columns_tablet'] : ' tablet-columns-2';
			$columns_mobile = isset( $atts['columns_mobile'] ) ? ' mobile-columns-' . $atts['columns_mobile'] : ' mobile-columns-1';

			$talemy_global_settings['list_class'] = 'post-list row' . $columns . $columns_tablet . $columns_mobile;
			$talemy_global_settings['post_class'] = 'loop-post post-style-grid';
		}

		if ( isset( $atts['show_category'] ) && 'yes' == $atts['show_category'] ) {
			$talemy_global_settings[ $list_style .'_category' ] = true;
		} else {
			$talemy_global_settings[ $list_style .'_category' ] = false;
		}

		if ( isset( $atts['show_excerpt'] ) && 'yes' == $atts['show_excerpt'] && isset( $atts['excerpt_limit'] ) ) {
			$talemy_global_settings[ $list_style .'_excerpt_limit' ] = $atts['excerpt_limit'];
		} else {
			$talemy_global_settings[ $list_style .'_excerpt_limit' ] = 0;
		}

		if ( isset( $atts['meta_data'] ) ) {
			$talemy_global_settings[ $list_style .'_meta_data' ] = $atts['meta_data'];
		}
	}
}

if ( !function_exists( 'talemy_set_block_setting' ) ) {
	/**
	 * Set block setting
	 * 
	 * @param  string $key   setting name
	 * @param  mixed  $value
	 */
	function talemy_set_block_setting( $key, $value ) {
		global $talemy_global_settings;

		$talemy_global_settings[ $key ] = $value;
	}
}

if ( !function_exists( 'talemy_get_block_setting' ) ) {
	/**
	 * Get block setting
	 * 
	 * @param  string $key     setting name
	 * @param  array  $default default value
	 */
	function talemy_get_block_setting( $key, $default = '' ) {
		global $talemy_global_settings;

		if ( isset( $talemy_global_settings[ $key ] ) ) {
			return $talemy_global_settings[ $key ];
		} else {
			return $default;
		}
	}
}

if ( !function_exists( 'talemy_clear_block_settings' ) ) {
	/**
	 * Clear block setting
	 * 
	 */
	function talemy_clear_block_settings() {
		global $talemy_global_settings;
		unset( $talemy_global_settings );
	}
}

if ( !function_exists( 'talemy_get_query' ) ) {
	/**
	 * Get current query.
	 *
	 * @return  WP_Query|null
	 */
	function talemy_get_query() {
		global $talemy_global_query;

		// Add default query to Talemy query if its not added or default query is used.
		if ( !isset( $talemy_global_query ) ) {
			global $wp_query;
			$talemy_global_query = &$wp_query;
		}
		return $talemy_global_query;
	}
}

if ( !function_exists( 'talemy_set_query' ) ) {
	/**
	 * Set global query.
	 *
	 * @return  WP_Query|null
	 */
	function talemy_set_query( &$query, $args = array() ) {
		global $talemy_global_query;
		$talemy_global_query = $query;
	}
}

if ( !function_exists( 'talemy_page_loader' ) ) {
	/**
	 * Output page loader
	 */
	function talemy_page_loader() {
		$loader = talemy_get_option( 'page_loader' );
		$out = '';
		
		switch ( $loader ) {
			case 'line':
				$out .= '<div id="loader" class="line"></div>';
				break;
			
			case 'circle':
				$out .= '<div id="loader" class="sf-circle">
			        <div class="sf-circle1 sf-child"></div>
			        <div class="sf-circle2 sf-child"></div>
			        <div class="sf-circle3 sf-child"></div>
			        <div class="sf-circle4 sf-child"></div>
			        <div class="sf-circle5 sf-child"></div>
			        <div class="sf-circle6 sf-child"></div>
			        <div class="sf-circle7 sf-child"></div>
			        <div class="sf-circle8 sf-child"></div>
			        <div class="sf-circle9 sf-child"></div>
			        <div class="sf-circle10 sf-child"></div>
			        <div class="sf-circle11 sf-child"></div>
			        <div class="sf-circle12 sf-child"></div></div>';
			    break;
			
			case 'pulse':
				$out .= '<div id="loader" class="sf-spinner-pulse"></div>';
				break;
			
			case 'square-spin':
				$out .= '<div id="loader" class="sf-square-spin"><div></div></div>';
				break;
			
			case 'wave':
				$out .= '<div id="loader" class="sf-wave"><div class="sf-rect sf-rect1"></div><div class="sf-rect sf-rect2"></div><div class="sf-rect sf-rect3"></div><div class="sf-rect sf-rect4"></div><div class="sf-rect sf-rect5"></div></div>';
				break;
		}
		
		echo $out; // WPCS: XSS ok.
	}
}

if ( !function_exists( 'talemy_get_preloader' ) ) {
	/**
	 * Output preloader
	 */
	function talemy_get_preloader() {
		return '<div class="preloader"><svg class="google-circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"/></svg></div>';
	}
}

if ( !function_exists( 'talemy_block_parse_atts' ) ) {
	/**
	 * Prepare atts
	 * @param  array  &$atts
	 * @return query
	 */
	function &talemy_block_parse_atts( &$atts ) {
        
		$default_atts = array(
			'title' => '',
			'subtitle' => '',
			'count' => 3,
			'order' => '',
			'orderby' => 'DESC',
			'format' => '',
			'categories' => '',
			'exclude_categories' => '',
			'course_categories' => '',
			'course_tags' => '',
			'post_type' => 'post',
			'post_ids' => '',
			'authors' => '',
			'tab_type' => '',
			'tab_categories' => '',
			'tab_tags' => '',
			'tab_authors' => '',
			'tab_show_all' => 'yes',
			'tab_orderby' => '',
			'tab_order' => '',
			'tags' => '',
			'preload_content' => '',
			'pagination' => '',
			'ppl' => 5,
			'max_loads' => '',
			'list_style' => '',
			'current_tab_id' => '',
			'show_category' => 'yes',
			'show_excerpt' => 'yes',
			'excerpt_limit' => '',
			'thumbnail_size' => '',
			'meta_data' => array(),
			'columns' => 3,
			'columns_tablet' => 2,
			'columns_mobile' => 1,
			'query_args' => array(),
		);

		//remove unused args
		$temp_atts = array();
		foreach ( $atts as $key => $value ) {
			if ( isset( $default_atts[ $key ] ) ) {
				$temp_atts[ $key ] = $atts[ $key ];
			}
		}

		$atts = wp_parse_args( $temp_atts, $default_atts );
		return $atts;
	}
}


if ( !function_exists( 'talemy_block_get_query' ) ) {
	/**
	 * Get block query
	 * @param  array  &$atts
	 * @return query
	 */
	function &talemy_block_get_query( &$atts, &$tab_ids ) {

        if ( !empty( $atts['query_args'] ) ) {
            $query = new WP_Query( $atts['query_args'] );
            return $query;
        }

        extract( shortcode_atts( array(
            'categories' => '',
            'exclude_categories' => '',
			'course_categories' => '',
			'course_tags' => '',
            'tags' => '',
            'authors' => '',
            'format' => '',
            'post_ids' => '',
            'post_type' => 'post',
            'count' => 5,
            'orderby' => 'DESC',
            'order' => '',
            'offset' => 0,
            'loop' => 'off',
            'tab_type' => '',
            'tab_show_all' => true,
        ), $atts ) );

        $query_args = array(
        	'post_type' => $post_type,
            'post_status' => 'publish',
            'ignore_sticky_posts' => true,
            'order' => $orderby,
            'paged' => 1,
        );

        if ( !empty( $categories ) ) {
        	$categories = implode( ',', $categories );

            if ( !empty( $exclude_categories ) ) {
                $query_args['cat'] = $categories . ',' . implode( ',', $exclude_categories );
            } else {
                $query_args['cat'] = $categories;
            }
        } else {
            if ( !empty( $exclude_categories ) ) {
                $query_args['cat'] = implode( ',', $exclude_categories );
            }
        }

        if ( !empty( $course_categories ) || !empty( $course_tags ) ) {

            $query_args['tax_query'] = array(
            	'relation' => 'OR',
            	array(
            		'taxonomy' => 'ld_course_category',
            		'terms' => $course_categories,
            		'operator' => 'IN',
            	),
            	array(
            		'taxonomy' => 'ld_course_tag',
            		'terms' => $course_tags,
            		'operator' => 'IN',
            	)
            );
        }

        if ( !empty( $tags) ) {
            $query_args['tag__in'] = $tags;
        }

        if ( !empty( $authors )) {
            $query_args['author__in'] = $authors;
        }

        if ( !empty( $post_ids ) ) {
            $query_args['post__in'] = $post_ids;
        }

        if ( !empty( $format ) ) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'post_format',
                    'field'    => 'slug',
                    'terms'    => array( 'post-format-' . $format )
            ));
        }

        $query_args['posts_per_page'] = $atts['count'];
        $query_args['offset'] = (int) $offset;

        switch ( $order ) {

            case 'random':
                $query_args['orderby'] = 'rand';
                break;

            case 'comments':
                $query_args['orderby'] = 'comment_count';
                break;
            
            case 'menu_order':
                $query_args['orderby'] = 'menu_order';
                break;

            case 'rating':
                $query_args['orderby'] = 'meta_value_num';
                $query_args['meta_key'] = '_ldcr_rating';
                break;
        }

		if ( !$tab_show_all && !empty( $tab_type ) && !empty( $tab_ids[0] ) ) {
            switch ( $tab_type ) {
                case 'subcat':
                case 'cat':
                	if ( $post_type == 'sfwd-courses' ) {
	                    $query_args['tax_query'] = array(
	                        array(
	                            'taxonomy' => 'ld_course_category',
	                            'terms' => $tab_ids[0]
	                        )
	                    );
                	} else if ( $post_type == 'post' ) {
	                    $query_args['cat'] = $tab_ids[0];
                	}

                    break;
                
                case 'tag':
                	if ( $post_type == 'sfwd-courses' ) {
	                    $query_args['tax_query'] = array(
	                        array(
	                            'taxonomy' => 'ld_course_tag',
	                            'terms' => $tab_ids[0]
	                        )
	                    );
                	} else if ( $post_type == 'post' ) {
	                    $query_args['tag'] = $tab_ids[0];
                	}
                    break;
                
                case 'author':
                    $query_args['author'] = $tab_ids[0];
                    break;
            }
		}

		$query = new WP_Query( $query_args );
        
        return $query;
	}
}

if ( !function_exists( 'talemy_block_get_header' ) ) {
	/**
	 * Get block header
	 * @param  array  &$atts
	 * @param  string $output
	 * @return html
	 */
	function talemy_block_get_header( &$atts, $block_tabs = '', $output = '' ) {
        
        $block_title = '';

        if ( !empty( $atts['title'] ) ) {
	 		$block_title .= '<div class="sf-heading">';

	 		if ( !empty( $atts['subtitle'] ) ) {
	 			$block_title .= '<span class="sf-heading__subtitle">'. $atts['subtitle'] . '</span>';
	 		}

			$block_title .= '<h3 class="sf-heading__title">'. $atts['title'] . '</h3>';

			if ( isset( $atts['decor_style'] ) && 'bottom_line' == $atts['decor_style'] ) {
				$block_title .= '<div class="sf-heading__bottom"><span class="sf-heading__line"></span></div>';
			}

			$block_title .= '</div>';
        }

        if ( !empty( $atts['title'] ) || !empty( $block_tabs ) ) {
            $output .= '<div class="block-header">' . $block_title . $block_tabs . '</div>';
        }

        $output .= talemy_get_preloader();

        return $output;
	}
}

if ( !function_exists( 'talemy_block_get_footer' ) ) {
	/**
	 * Get block footer ( pagination )
	 * @param  array  &$atts
	 * @param  string $output
	 * @return html
	 */
	function talemy_block_get_footer( &$atts, $output = '' ) {
        if ( empty( $atts['pagination'] ) ) {
        	return $output;
        }

        ob_start();

        ?>
        <div class="block-footer">
        <?php if ( 'next_prev' == $atts['pagination'] ) : ?>
            <div class="load-next-prev-posts">
                <a href="javascript:void(0)" class="load-posts prev-posts" title="<?php esc_attr_e( 'Previous', 'talemy' ); ?>"><span class="prev"><?php esc_html_e( 'Prev', 'talemy' ); ?></span></a>
                <a href="javascript:void(0)" class="load-posts next-posts" title="<?php esc_attr_e( 'Next', 'talemy' ); ?>"><span class="next"><?php esc_html_e( 'Next', 'talemy' ); ?></span></a>
            </div>
        <?php elseif ( 'load_more' == $atts['pagination'] ): ?>
            <button class="load-more btn btn-primary">
                <span class="load-text"><?php esc_html_e( 'Load more', 'talemy' ); ?></span>
                <span class="loading-text"><?php esc_html_e( 'Loading...', 'talemy' ); ?></span>
            </button>
        <?php elseif ( 'load_more_scroll' == $atts['pagination'] ) : ?>
            <div class="load-more-scroll">
                <?php echo talemy_get_preloader(); ?>
            </div>
        <?php endif; ?>
        </div><?php

        return ob_get_clean();
    }
}

if ( !function_exists( 'talemy_get_post_format_icon' ) ) {
	/**
	 * Get post format icon
	 * @param  string $format post format
	 * @return string
	 */
	function talemy_get_post_format_icon( $format = '' ) {
		switch ( $format ) {
			case 'audio': $icon = '<i class="post-format-icon fas fa-music"></i>'; break;
			case 'gallery': $icon = '<i class="post-format-icon far fa-clone"></i>'; break;
			case 'video': $icon = '<i class="post-format-icon fas fa-play"></i>'; break;
			default: $icon = '';
		}
		return $icon;
	}
}

if ( !function_exists( 'talemy_get_post_hero_style' ) ) {
	/**
	 * Output post hero style attr
	 */
	function talemy_get_post_hero_style() {
		$background = get_post_meta( get_the_ID(), '_sf_hero_image', true );
		$out = $css = '';

		if ( !empty( $background ) && is_array( $background ) ) {
			if ( !empty( $background['color'] ) ) {
				$css .= 'background-color:'. $background['color'] .';';
			}
			if ( !empty( $background['image'] ) ) {
				$css .= 'background-image:url('. esc_url( $background['image'] ) .');';
			} elseif ( has_post_thumbnail() ) {
				$css .= 'background-image:url('. esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ) .');';
			}
			if ( !empty( $background['position'] ) ) {
				$css .= 'background-position:'. $background['position'] .';';
			}
			if ( !empty( $background['attachment'] ) ) {
				$css .= 'background-attachment:'. $background['attachment'] .';';
			}
			if ( !empty( $background['size'] ) ) {
				$css .= 'background-size:'. $background['size'] .';';
			}
		}
		if ( !empty( $css ) ) {
			$out .= ' style="'. esc_attr( $css ) .'"';
		} else if ( has_post_thumbnail() ) {
			$out .= ' style="background-image:url('. get_the_post_thumbnail_url( get_the_ID(), 'full' ) .');"';
		}
		return $out;
	}
}

if ( !function_exists( 'talemy_main_menu' ) ) {
	/**
	 * Output main menu
	 */
	function talemy_main_menu() {
		$page_menu = talemy_get_post_meta( '_sf_menu', '' );
		$registered_nav_menus = get_registered_nav_menus();
		
		if ( is_page() && !empty( $page_menu ) ) {
			$nav_menu_args = array(
				'container' => '',
				'menu_class' => 'nav-menu pre-compress',
				'depth' => 5,
				'walker' => new Talemy_Walker_Main_Menu(),
				'menu' => wp_get_nav_menu_object( $page_menu )
			);
		} else {
			if ( has_nav_menu( 'main' ) ) {
				$nav_menu_args = array(
					'container' => '',
					'theme_location' => 'main',
					'menu_class' => 'nav-menu pre-compress',
					'depth' => 5,
					'walker' => new Talemy_Walker_Main_Menu(),
				);
			} else {
				if ( current_user_can( 'edit_theme_options' ) ) {
					talemy_main_menu_fb();
				}
				return;
			}
		}

		if ( !empty( $nav_menu_args ) ) {
			
			add_filter( 'wp_nav_menu_items', 'talemy_add_nav_menu_items', 10, 2 );

			wp_nav_menu( $nav_menu_args );
	
			remove_filter( 'wp_nav_menu_items', 'talemy_add_nav_menu_items' );
		}
	}
}

if ( !function_exists( 'talemy_off_canvas_left_menu' ) ) {
	/**
	 * Output off-canvas left menu
	 */
	function talemy_off_canvas_left_menu() {
		if ( has_nav_menu( 'side' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'side',
				'container' => '',
				'menu_class' => 'off-canvas-menu',
				'depth' => 3,
				'walker' => new Talemy_Walker_Offcanvas_Menu()
			) );
		} else if ( current_user_can( 'edit_theme_options' ) ) {
			talemy_off_canvas_menu_fb();
		}
	}
}

if ( !function_exists( 'talemy_off_canvas_right_menu' ) ) {
	/**
	 * Output off-canvas right menu
	 */
	function talemy_off_canvas_right_menu() {
		if ( has_nav_menu( 'side_right' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'side_right',
				'container' => '',
				'menu_class' => 'off-canvas-menu',
				'depth' => 3,
				'walker' => new Talemy_Walker_Offcanvas_Menu()
			) );
		} else if ( current_user_can( 'edit_theme_options' ) ) {
			talemy_off_canvas_menu_fb();
		}
	}
}

if ( !function_exists( 'talemy_account_menu' ) ) {
	/**
	 * Output Account menu
	 */
	function talemy_account_menu() {
		if ( has_nav_menu( 'account' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'account',
				'container' => '',
				'menu_class' => 'account-menu',
				'depth' => 1
			) );
		}
	}
}

if ( !function_exists( 'talemy_footer_menu' ) ) {
	/**
	 * Output footer menu
	 */
	function talemy_footer_menu() {
		if ( has_nav_menu( 'footer' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container' => '',
				'menu_class' => 'footer-menu',
				'depth' => 1
			) );
		} else if ( current_user_can( 'edit_theme_options' ) ) {
			talemy_footer_menu_fb();
		}
	}
}

if ( !function_exists( 'talemy_main_menu_fb' ) ) {
	/**
	 * Main Menu fallback
	 */
	function talemy_main_menu_fb() {
	    echo '<ul class="nav-menu">';
	    echo '<li class="menu-item-first"><a href="'. esc_url( network_admin_url( 'nav-menus.php' ) ) .'?action=locations">'. esc_html__( 'Create or select a menu', 'talemy' ) .'</a></li>';
	    echo '</ul>';
	}
}

if ( !function_exists( 'talemy_off_canvas_menu_fb' ) ) {
	/**
	 * Side Menu fallback
	 */
	function talemy_off_canvas_menu_fb() {
	    echo '<ul class="off-canvas-menu">';
	    echo '<li class="menu-item-first"><a href="'. esc_url( network_admin_url( 'nav-menus.php' ) ) .'?action=locations">'. esc_html__( 'Create or select a menu', 'talemy' ) .'</a></li>';
	    echo '</ul>';
	}
}

if ( !function_exists( 'talemy_footer_menu_fb' ) ) {
	/**
	 * Footer Menu fallback
	 */
	function talemy_footer_menu_fb() {
	    echo '<ul class="footer-menu">';
	    echo '<li class="menu-item-first"><a href="'. esc_url( network_admin_url( 'nav-menus.php' ) ) .'?action=locations">'. esc_html__( 'Create or select a menu', 'talemy' ) .'</a></li>';
	    echo '</ul>';
	}
}

if ( !function_exists( 'talemy_footer_copyright' ) ) {
	/**
	 * Output footer copyright content
	 */
	function talemy_footer_copyright() {
	    $copyright = talemy_get_option( 'footer_copyright' );
	    if ( !empty( $copyright ) ) {
		    $copyright = str_replace( '%%year%%', date( 'Y' ), $copyright );
		    $copyright = str_replace( '%%sitename%%', get_bloginfo( 'name' ), $copyright );
		    echo '<div class="footer-copyright">';
		    echo wp_kses_post( $copyright );
		    echo '</div>';
	    }
	}
}

if ( !function_exists( 'talemy_link_pages' ) ) {
	/**
	 * Link pages
	 */
	function talemy_link_pages() {
		global $page, $numpages, $multipage;
		
		$next = is_rtl() ? '<i class="fas fa-chevron-left"></i>' : '<i class="fas fa-chevron-right"></i>';
		$prev = is_rtl() ? '<i class="fas fa-chevron-right"></i>' : '<i class="fas fa-chevron-left"></i>';

        if ( $multipage ) : ?>
			<div class="post-pagination clearfix">
				<div class="page-num"><?php printf( '<span>%1$u</span> / %2$u', $page, $numpages ); ?></div>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-nav">',
						'after' => '</div>',
						'next_or_number' => 'next',
						'nextpagelink' => $next,
						'previouspagelink' => $prev,
						'echo' => 1
					)); ?>
			</div><?php
        endif;
	}
}

if ( !function_exists( 'talemy_button' ) ) {
	function talemy_button( $button_text = '', $button_link = '', $button_classes = array() ) {
		echo '<a href="'. esc_url( $button_link ) .'" class="'. esc_attr( implode( ' ', $button_classes ) ) .'">'. esc_html( $button_text ) .'</a>';
	}
}

if ( !function_exists( 'talemy_get_archive_title' ) ) {
	/**
	 * File: wp-includes/general-template.php
	 */
	function talemy_get_archive_title() {

		$title = '';

		if ( is_home() ) {
			$title = esc_html__( 'Blog', 'talemy' );
		} elseif ( is_category() ) {
	        /* translators: Category archive title. 1: Category name */
	        $title = single_cat_title( '', false );
	    } elseif ( is_tag() ) {
	        /* translators: Tag archive title. 1: Tag name */
	        $title = single_tag_title( '', false );
	    } elseif ( is_author() ) {
	        /* translators: Author archive title. 1: Author name */
	        $title = get_the_author();
	    } elseif ( is_year() ) {
	        /* translators: Yearly archive title. 1: Year */
	        $title = sprintf( esc_html__( 'Year: %s', 'talemy' ), get_the_date( _x( 'Y', 'yearly archives date format', 'talemy' ) ) );
	    } elseif ( is_month() ) {
	        /* translators: Monthly archive title. 1: Month name and year */
	        $title = sprintf( esc_html__( 'Month: %s', 'talemy' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'talemy' ) ) );
	    } elseif ( is_day() ) {
	        /* translators: Daily archive title. 1: Date */
	        $title = sprintf( esc_html__( 'Day: %s', 'talemy' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'talemy' ) ) );
	    } elseif ( is_tax( 'post_format' ) ) {
	        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
	            $title = _x( 'Asides', 'post format archive title', 'talemy' );
	        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
	            $title = _x( 'Galleries', 'post format archive title', 'talemy' );
	        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
	            $title = _x( 'Images', 'post format archive title', 'talemy' );
	        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
	            $title = _x( 'Videos', 'post format archive title', 'talemy' );
	        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
	            $title = _x( 'Quotes', 'post format archive title', 'talemy' );
	        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
	            $title = _x( 'Links', 'post format archive title', 'talemy' );
	        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
	            $title = _x( 'Statuses', 'post format archive title', 'talemy' );
	        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
	            $title = _x( 'Audio', 'post format archive title', 'talemy' );
	        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
	            $title = _x( 'Chats', 'post format archive title', 'talemy' );
	        }
	    } elseif ( is_post_type_archive() ) {
	        $title = post_type_archive_title( '', false );
	    } elseif ( is_tax() ) {
	    	if ( is_tax( 'product_cat' ) || is_tax( 'ld_course_category' ) || is_tax( 'ld_course_tag' ) ) {
	    		$title = single_term_title( '', false );
	    	} else {
		        $tax = get_taxonomy( get_queried_object()->taxonomy );
		        /* translators: Taxonomy term archive title. 1: Taxonomy singular name, 2: Current taxonomy term */
		        $title = sprintf( '%1$s: %2$s', $tax->labels->singular_name, single_term_title( '', false ) );
	    	}
    	} else {
	        $title = esc_html__( 'Archives', 'talemy' );
	    }
	    return $title;
	}
}

if ( !function_exists( 'talemy_get_post_categories' ) ) {
	function talemy_get_post_categories( $separator = ', ', $post_id = null ) {
		$cats = $out = '';

		if ( !empty( $post_id ) ) {
			$cats = get_the_category( $post_id );
		} else {
			$cats = get_the_category();
		}

		if ( $cats ) {
			$out .= '<div class="post-categories">';
			$cats_array = array();
			foreach ( $cats as $cat ) {
				$cats_array[] = '<a class="cat-' . $cat->term_id . '-link" href="' . get_category_link( $cat->term_id ) . '">' . esc_html( $cat->cat_name ) . '</a>';
			}
			$out .= implode( $separator, $cats_array );
			$out .= '</div>';
		}
		return $out;
	}
}

if ( !function_exists( 'talemy_get_post_category' ) ) {
	function talemy_get_post_category() {
		$cat_id = get_post_meta( get_the_ID(), '_sf_primary_category', true );
		$cat_name = $out = '';

		if ( empty( $cat_id ) ) {
			$cat = get_the_category();
			if ( $cat ) {
				$cat_id = $cat[0]->term_id;
				$cat_name = $cat[0]->cat_name;
			}
		} else {
			$cat_name = get_cat_name( $cat_id );
		}

		if ( $cat_name ) {
			$out .= '<div class="post-category"><a class="cat-'. esc_attr( $cat_id ) .'-link" href="'. esc_url( get_category_link( $cat_id ) ) .'">'. esc_html( $cat_name ) .'</a></div>';
		}
		return $out;
	}
}

if ( !function_exists( 'talemy_get_loop_category' ) ) {
	function talemy_get_loop_category( $show = true ) {
		return $show ? talemy_get_post_category() : '';
	}
}

if ( !function_exists( 'talemy_get_loop_meta' ) ) {
	function talemy_get_loop_meta( $post_meta = array() ) {

		if ( empty( $post_meta ) ) {
			return '';
		}

		global $talemy_date_format;

		if ( !isset( $talemy_date_format ) ) {
			$talemy_date_format = talemy_get_option( 'loop_date_format' );
		}

		$out = '';
		$author_id = get_the_author_meta( 'ID' );

		if ( in_array( 'author', $post_meta ) ) {
			$out .= '<li class="meta-author">';

			if ( in_array( 'avatar', $post_meta ) ) {
				$out .= '<a class="author-avatar" href="'. esc_url( get_author_posts_url( $author_id ) ) .'">'. get_avatar( $author_id, 30 ) .'</a>';
			}

			$out .= '<a href="'. esc_url( get_author_posts_url( $author_id, get_the_author_meta( 'user_nicename' ) ) ) .'">'. ( !in_array( 'avatar', $post_meta ) ? '<i class="fas fa-user-alt"></i>' : '' ) . get_the_author() .'</a></li>';
		}

		if ( in_array( 'date', $post_meta ) ) {
			if ( empty( $talemy_date_format ) ) {
				$talemy_date_format = get_option( 'date_format' );
			}

			$archive_year  = get_the_time('Y');
			$archive_month = get_the_time('m');
			$archive_day   = get_the_time('d');
			$out .= '<li class="meta-date"><a href="'. esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ) .'"><time datetime="' . date( DATE_W3C, get_the_time( 'U' ) ) . '"><i class="far fa-calendar-alt"></i>'. get_the_date( $talemy_date_format ) .'</time></a></li>';
		}

		if ( in_array( 'comment', $post_meta ) ) {
			$out .= '<li class="meta-comments"><a href="'. esc_url( get_permalink() ) .'#comments"><i class="far fa-comment-alt"></i>'. get_comments_number() .'</a></li>';
		}

		return !empty( $out ) ? '<ul class="post-meta">'. $out .'</ul>' : '';
	}
}

if ( !function_exists( 'talemy_get_loop_title' ) ) {
	/**
	 * Get loop title
	 */
	function talemy_get_loop_title() {
		$title = get_the_title();

		if ( 0 === mb_strlen( $title ) ) {
			$title = '&nbsp;';
		}

		if ( !empty( $title ) ) {
			return '<h3 class="post-title"><a href="' . esc_url( get_permalink() ) . '">' . $title . '</a></h3>';
		}

		return '';
	}
}

if ( !function_exists( 'talemy_get_loop_thumb' ) ) {
	/**
	 * Get loop thumbnail
	 * 
	 * @param  string size thumbnail size
	 * @param  string html
	 * @return string html
	 */
	function talemy_get_loop_thumb( $size = 'thumbnail', $html = '' ) {
		$out = '';

		if ( has_post_thumbnail() ) {
			$out .= '<div class="post-thumb">';
			$out .= '<a href="' . esc_url( get_permalink() ) . '">';
			$out .= get_the_post_thumbnail( get_the_ID(), $size );
			$out .= '</a>';
			$out .= talemy_get_post_format_icon( get_post_format() );
			$out .= $html;
			$out .= '</div>';
		} else {
			if ( talemy_get_option( 'loop_thumb_placeholder' ) ) {
				$out .= '<div class="post-thumb">';
				$out .= '<a href="' . esc_url( get_permalink() ) . '">';
				$out .= '<img src="' . esc_url( TALEMY_THEME_URI . 'assets/images/thumbs/talemy_thumb_small.png' ) . '" alt="thumbnail">';
				$out .= '</a>';
				$out .= talemy_get_post_format_icon( get_post_format() );
				$out .= $html;
				$out .= '</div>';
			} else {
				$out .= $html;
			}
		}
		return $out;
	}
}

if ( !function_exists( 'talemy_get_loop_excerpt' ) ) {
	/**
	 * @param  integer $limit   excerpt limit by charactors
	 * @param  string  $excerpt excerpt
	 * @return string  excerpt
	 */
	function talemy_get_loop_excerpt( $limit = 150, $excerpt = '' ) {
		if ( $limit == 0 ) {
			return $excerpt;
		}

		if ( has_excerpt() ) {
		    $excerpt = get_the_excerpt();
		} else {
		    $content = get_the_content();
		    $content = strip_shortcodes( $content );
		    $excerpt = apply_filters( 'the_content', $content );
		    $excerpt = str_replace( ']]>', ']]&gt;', $excerpt );
		}

		$excerpt = strip_tags( $excerpt );
		$limit = absint( $limit );

		if ( mb_strlen( $excerpt ) > $limit ) {
			$excerpt = mb_substr( $excerpt, 0, $limit );
			$excerpt = trim( $excerpt );

			if ( !empty( $excerpt ) ) {
				$excerpt .= '...';
			}
		}

		if ( !empty( $excerpt ) ) {
			return '<div class="post-excerpt">'. $excerpt .'</div>';
		}
		return '';
	}
}

if ( ! function_exists( 'talemy_nav_login' ) ) {
	/**
	 * Output navbar login button
	 */
	function talemy_nav_login( $avatar_size = 24 ) {
		if ( !defined( 'SF_FRAMEWORK_VERSION' ) || !talemy_get_option( 'nav_login' ) ) {
			return;
		}

		$ajax_login_class = SF()->get_setting( 'enable_login_registration' ) ? ' sf-ajax-login' : '';

		if ( is_user_logged_in() ) :
			$user_id   = get_current_user_id();
			$user_data = get_userdata( $user_id );
			$user_link = apply_filters( 'talemy_user_link', '#' );
			?>
			<div class="nav-item-wrap dropdown-open-on-hover">
				<a href="<?php echo esc_url( $user_link ); ?>" class="nav-btn btn-login btn-has-dropdown" title="<?php esc_attr_e( 'Log In', 'talemy' ); ?>"><?php echo get_avatar( $user_id, $avatar_size ); ?><span><?php echo esc_attr( $user_data->user_nicename ); ?></span></a>
				<div class="nav-dropdown account-dropdown">
					<?php do_action( 'talemy_before_account_menu', $user_data ); ?>
					<?php talemy_account_menu(); ?>
					<?php do_action( 'talemy_after_account_menu', $user_data ); ?>
					<a class="account-logout-link" href="<?php echo wp_logout_url( home_url() ); ?>" title="<?php esc_attr_e( 'Log Out', 'talemy' ); ?>"><span><?php esc_html_e( 'Log Out', 'talemy' ); ?></span></a>
				</div>
			</div>
		<?php
		else :
			if ( defined( 'LEARNDASH_VERSION' ) ) {
            	$login_model = LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Theme_LD30', 'login_mode_enabled' );
				$login_url = apply_filters( 'learndash_login_url', ( $login_model === 'yes' ? '#login' : wp_login_url( get_permalink() ) ) );
			} else {
				$login_url = apply_filters( 'talemy_login_url', wp_login_url( get_permalink() ) );
			}
			if ( 'button' == talemy_get_option( 'nav_login_button_style' ) ) :
			?>
				<div class="btn-login-wrapper">
					<a class="btn btn-sm btn-outline-primary<?php echo esc_attr( $ajax_login_class ); ?>" href="<?php echo esc_url( $login_url ); ?>" title="<?php esc_attr_e( 'Log In', 'talemy' ); ?>"><?php echo apply_filters( 'talemy_login_button_text', esc_html__( 'Login | Register', 'talemy' ) ); ?></a>
				</div>
			<?php else: ?>
				<a class="nav-btn btn-login<?php echo esc_attr( $ajax_login_class ); ?>" href="<?php echo esc_url( $login_url ); ?>" title="<?php esc_attr_e( 'Log In', 'talemy' ); ?>">
					<i class="ticon-user-alt" aria-hidden="true"></i>
				</a>
			<?php endif; ?>
		<?php endif;
	}
}

if ( !function_exists( 'talemy_nav_wc_cart' ) ) {
	/**
	 * Output navbar cart button
	 */
	function talemy_nav_wc_cart() {
		global $woocommerce;

		if ( !talemy_get_option( 'wc_nav_cart' ) || !defined( 'WC_PLUGIN_FILE' ) ) {
			return;
		}

		$cart_link = wc_get_cart_url();
		$item_count = $woocommerce->cart->cart_contents_count;
		ob_start();
		?>
		<div class="nav-item-wrap dropdown-open-on-hover">
			<a class="nav-btn btn-cart btn-has-dropdown" href="<?php echo esc_url( $cart_link ); ?>" title="<?php esc_attr_e( 'View Shopping Cart', 'talemy' ); ?>">
				<i class="position-relative">
					<i class="ticon-shopping-bag"></i>
					<span class="cart-item-count item-count" style="<?php echo esc_attr( $item_count == '0' ? 'display:none;' : '' ); ?>"><?php echo esc_html( $item_count ); ?></span>
				</i>
			</a>
			<div id="nav-cart-widget" class="nav-dropdown widget_shopping_cart woocommerce">
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
		</div>
		<?php
		$out = ob_get_clean();
		echo $out; // WPCS: XSS ok.
	}
}

if ( !function_exists( 'talemy_nav_wc_wishlist' ) ) {
	/**
	 * Output navbar wishlist button
	 */
	function talemy_nav_wc_wishlist() {

		if ( !talemy_get_option( 'nav_wishlist' ) || !defined( 'WC_PLUGIN_FILE' ) || !function_exists( 'tinv_get_option' ) ) {
			return;
		}

		$page_id = tinv_get_option( 'page', 'wishlist' );

		if ( empty( $page_id ) ) {
			return;
		}

		?>
		<a href="<?php echo esc_url( get_the_permalink( $page_id ) ); ?>" class="nav-btn btn-like"><i class="ticon-heart"></i></a>
		<?php
	}
}

if ( !function_exists( 'talemy_topbar_cta_button' ) ) {
	/**
	 * Output topbar call to action button
	 */
	function talemy_topbar_cta_button() {
		$button_text	= talemy_get_option( 'topbar_btn_text' );
		$button_url		= talemy_get_option( 'topbar_btn_url' );
		$button_class   = talemy_get_option( 'topbar_btn_class' );
		$button_classes = !empty( $button_class ) ? 'topbar-btn '. $button_class : 'topbar-btn';
		$out = '';

		if ( !empty( $button_text ) ) {
			?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="<?php echo esc_attr( $button_classes ); ?>"><?php echo esc_html( $button_text ); ?></a>
			<?php
		}
	}
}

if ( !function_exists( 'talemy_nav_cta_button' ) ) {
	/**
	 * Output navbar call to action button
	 */
	function talemy_nav_cta_button() {
		if ( !talemy_get_option( 'nav_cta_btn' ) ) {
			return;
		}

		$button_text	= talemy_get_option( 'nav_btn_text' );
		$button_url		= talemy_get_option( 'nav_btn_url' );
		$button_class	= talemy_get_option( 'nav_btn_class' );
		$button_classes = !empty( $button_class ) ? 'btn btn-primary nav-btn-cta '. $button_class : 'btn btn-primary nav-btn-cta';
		$out = '';
		
		if ( !empty( $button_text ) ) {
			?>
			<a href="<?php echo esc_url( $button_url ); ?>" class="<?php echo esc_attr( $button_classes ); ?>"><?php echo esc_html( $button_text ); ?></a>
			<?php
		}
	}
}

if ( !function_exists( 'talemy_nav_course_category_list' ) ) {
	/**
	 * Output navbar course category list
	 */
	function talemy_nav_course_category_list() {

		if ( !talemy_get_option( 'nav_show_course_cats' ) ) {
			return;
		}
		?>
		<ul class="nav-category-list">
			<li>
				<a class="nav-btn-cat" href="javascript:void(0)">
					<span class="icon-category">
						<span class="square"></span>
						<span class="square"></span>
						<span class="square"></span>
						<span class="square"></span>
					</span>
					<span class="text"><?php esc_html_e( 'Categories', 'talemy' ); ?></span>
				</a>
				<?php $term_ids = talemy_get_option( 'nav_course_cats' ); ?>
				<?php if ( !empty( $term_ids ) ) : ?>
					<div class="course-category-list">
					<?php foreach ( $term_ids as $id ) :
						$term = get_term( (int) $id, 'ld_course_category' );
						if ( $term && !is_wp_error( $term ) ) :
							$term_link = get_term_link( $term );
							$term_image_id = get_term_meta( $id, '_sf_featured_image', true );
							$term_image = $term_class = '';
							if ( !empty( $term_image_id ) ) {
								$term_class = ' has-image';
								$term_image = wp_get_attachment_image_src( $term_image_id, 'talemy_thumb_small' );
							}
							?>
							<div class="cat-item<?php echo esc_attr( $term_class ); ?>">
								<a href="<?php echo esc_url( $term_link ); ?>"<?php if ( !empty( $term_image ) ) : echo ' style="background-image:url('. esc_url( $term_image[0] ) .');"'; endif; ?>>
									<span class="cat-info">
										<span class="cat-name"><?php echo esc_html( $term->name ); ?></span>
										<span class="count"><?php printf( esc_html__( '%s Courses', 'talemy' ), $term->count ); ?></span>
									</span>
								</a>
							</div>
						<?php endif; ?>
					<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</li>
		</ul>
		<?php
	}
}

if ( !function_exists( 'talemy_add_nav_menu_items' ) ) {
    function talemy_add_nav_menu_items( $items, $args ) {
        ob_start(); ?>
        <li class="menu-items-container menu-item-has-children">
            <a class="menu-item-btn-more" href="javascript:void(0)" role="button"><span class="menu-text"><?php esc_html_e( 'More', 'talemy' ); ?></span><span class="menu-caret"><i class="ticon-angle-down"></i></span></a>
            <ul class="sub-menu"></ul>
        </li><?php
        $items .= ob_get_clean();
        return $items;
    }
}

if ( !function_exists( 'talemy_comment' ) ) {
	/**
	* Output custom comment
	* 
	* @param mixed   $comment
	* @param array   $args
	* @param integer $depth
	*/
	function talemy_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		switch ( $comment->comment_type ) {
			case 'pingback': ?>

			<li class="post pingback">
				<p><?php esc_html_e( 'Pingback', 'talemy' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'talemy' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php 
				break;
			case 'trackback': ?>

			<li class="post trackback">
				<p><?php esc_html_e( 'Trackback', 'talemy' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'talemy' ), '<span class="edit-link">', '</span>' ); ?></p>
			<?php
				break;
			default:
			?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?> itemprop="" itemscope="itemscope" itemtype="http://schema.org/UserComments">
				<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				 	<meta itemprop="discusses" content="<?php the_title(); ?>" />
		         	<link itemprop="url" href="#comment-<?php comment_ID() ?>">
					<?php echo get_avatar( $comment, 60 ); ?>
					<div class="comment-content">
						<div class="comment-author" itemprop="creator" itemtype="http://schema.org/Person"><span itemprop="name"><?php comment_author_link(); ?></span></div>
						<div class="comment-meta">
							<span class="date" datetime="<?php echo get_comment_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?php echo get_comment_time( 'l, F j, Y, g:i a' ); ?>" itemprop="commentTime"><i class="far fa-calendar-alt"></i><?php printf( esc_attr__( '%1$s at %2$s', 'talemy' ), get_comment_date(),  get_comment_time() ); ?></span><?php edit_comment_link( esc_attr__( 'Edit', 'talemy' ), '  ', '' ); ?>
						</div>
						<div class="content" itemprop="commentText">
							<?php if ( $comment->comment_approved == '0' ): ?>
								<em class="comment-awaiting-moderation"><i class="far fa-clock"></i><?php esc_html_e( 'Your comment is awaiting moderation.', 'talemy' ); ?></em>
							<?php endif; ?>
							<?php comment_text(); ?>
						</div>
						<?php comment_reply_link(
								array_merge( $args, array(
									'depth' => $depth,
									'max_depth' => $args['max_depth'],
									'reply_text' => esc_html__( 'Reply', 'talemy' ),
									'login_text' => esc_html__( 'Log in to leave a comment', 'talemy' )
								)));
							?>
					</div>
				</article>
		<?php
		}
	}
}


if ( !function_exists( 'talemy_get_allowed_html_for_ads' ) ) {
	/**
	 * Get allowed html for ads
	 */
	function talemy_get_allowed_html_for_ads() {
		return apply_filters( 'talemy_allowed_html_for_ads', array(
			'a' => array(
				'class'  => true,
				'href'   => true,
				'rel'    => true,
				'title'  => true,
				'target' => true
			),
			'img' => array(
				'alt'    => true,
				'class'  => true,
				'height' => true,
				'src'    => true,
				'srcset' => true,
				'width'  => true
			),
            'script' => array(
                'async' => true,
                'src' => true
			),
			'ins' => array(
                'style' => true,
				'data-ad-client' => true,
				'data-ad-slot' => true
			)
		) );
	}
}
