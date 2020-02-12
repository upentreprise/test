<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( !function_exists( 'talemy_get_ld_course_meta' ) ) {
	/**
	 * Get course meta
	 * 
	 * @param  array $key meta key
	 * @return string
	 */
	function talemy_get_ld_course_meta( $key = '', $course_id = null ) {
		if ( empty( $key ) ) {
			return get_post_meta( get_the_ID(), '_ld_custom_meta', true );
		}

		if ( empty( $course_id ) ) {
			$course_id = get_the_ID();
		}

		$meta_data = get_post_meta( get_the_ID(), '_ld_custom_meta', true );

		return isset( $meta_data[ $key ] ) ? $meta_data[ $key ] : '';
	}
}

if ( !function_exists( 'talemy_get_ld_loop_course_meta' ) ) {
	/**
	 * Get course meta html
	 * 
	 * @param  array $meta            meta to show
	 * @param  array  $data           meta data
	 * @param  string $wrapper class  div class
	 * @return string
	 */
	function talemy_get_ld_loop_course_meta( $meta, $data = array(), $out = '' ) {
		if ( empty( $meta ) ) {
			return '';
		}

		if ( empty( $data ) ) {
			$data = get_post_meta( get_the_ID(), '_ld_custom_meta', true );
		}

		if ( in_array( 'duration', $meta ) && !empty( $data['duration'] ) ) {
			$out .= '<li><i class="far fa-clock"></i>' . esc_html( $data['duration'] ) . '</li>';
		}

		if ( in_array( 'level', $meta ) && !empty( $data['level'] ) ) {
			$out .= '<li><i class="fas fa-signal"></i>' . esc_html( $data['level'] ) . '</li>';
		}

		if ( in_array( 'language', $meta ) && !empty( $data['language'] ) ) {
			$out .= '<li><i class="fas fa-globe"></i>' . esc_html( $data['language'] ) . '</li>';
		}

		if ( in_array( 'enrolled', $meta ) && !empty( $data['enrolled'] ) ) {
			$out .= '<li><i class="fas fa-users"></i>' . esc_html( $data['enrolled'] ) . '</li>';
		}

		if ( !empty( $out ) ) {
			$out = '<ul class="post-meta">' . $out . '</ul>';
		}

		return $out;
	}
}

if ( !function_exists( 'talemy_get_ld_loop_author' ) ) {
	/**
	 * Get loop author
	 * 
	 * @param  bool show_avatar true/false
	 * @return string html
	 */
	function talemy_get_ld_loop_author( $show_avatar = false ) {
		$author_id = get_the_author_meta( 'ID' );
		$out = '';
		$out .= '<span class="ld-course-author">';
		if ( $show_avatar ) {
			$out .= '<a class="author-avatar" href="'. esc_url( get_author_posts_url( $author_id ) ) .'">'. get_avatar( $author_id, 30 ) .'</a>';
			$out .= '<a href="'. esc_url( get_author_posts_url( $author_id, get_the_author_meta( 'user_nicename' ) ) ) .'">'. get_the_author() .'</a>';
		} else {
			$out .= sprintf( esc_html__( 'by %s', 'talemy' ), '<a href="'. esc_url( get_author_posts_url( $author_id, get_the_author_meta( 'user_nicename' ) ) ) .'">' . get_the_author() . '</a>');
		}
		$out .= '</span>';
		return $out;
	}
}

if ( !function_exists( 'talemy_get_ld_loop_thumb' ) ) {
	/**
	 * Get loop thumbnail
	 * 
	 * @param  string size thumbnail size
	 * @param  string html
	 * @return string html
	 */
	function talemy_get_ld_loop_thumb( $size = 'thumbnail', $html = '' ) {
		$out = '';

		if ( has_post_thumbnail() ) {
			$out .= '<div class="post-thumb">';
			$out .= '<a href="' . esc_url( get_permalink() ) . '">';
			$out .= get_the_post_thumbnail( get_the_ID(), $size );
			$out .= '<span class="post-thumb-btn">'. talemy_get_option( 'ld_thumb_hover_text' ) .'</span>';
			$out .= '</a>';
			$out .= $html;
			$out .= '</div>';
		} else {
			if ( talemy_get_option( 'loop_thumb_placeholder' ) ) {
				$out .= '<div class="post-thumb">';
				$out .= '<a href="' . esc_url( get_permalink() ) . '">';
				$out .= '<img src="' . esc_url( TALEMY_THEME_URI . 'assets/images/thumbs/talemy_thumb_small.png' ) . '" alt="thumbnail">';
				$out .= '</a>';
				$out .= $html;
				$out .= '</div>';
			} else {
				$out .= $html;
			}
		}
		return $out;
	}
}

if ( !function_exists( 'talemy_get_ld_course_categories' ) ) {
	/**
	 * Get course category links
	 * Use it within the loop
	 * 
	 * @return html category links
	 */
	function talemy_get_ld_course_categories( $separator = ', ' ) {
		$cats = get_the_terms( get_the_ID(), 'ld_course_category' );
		$links = array();
		if ( $cats ) {
			foreach ( $cats as $cat ) {
				$links[] = sprintf( '<a href="%s">%s</a>', get_term_link( $cat->term_id, 'ld_course_category' ), $cat->name );
			}
		}
		return !empty( $links ) ? '<span class="course-categories">'. implode( $separator, $links ) .'</span>' : '';
	}
}

if ( !function_exists( 'talemy_get_ld_course_price' ) ) {
	/**
	 * Get course price
	 * 
	 * @param  int    $course_id      course id
	 * @param  array  $course_options course options
	 * @return html                   string
	 */
	function talemy_get_ld_course_price( $course_id = null, $course_options = array() ) {

		if ( empty( $course_id ) ) {
			$course_id = get_the_ID();
		}

		if ( empty( $course_id ) ) {
			return '';
		}

		if ( empty( $course_options ) ) {
			$course_options = get_post_meta( $course_id, '_sfwd-courses', true );
		}

		$options = get_option( 'sfwd_cpt_options' );
		$currency_setting = class_exists( 'LearnDash_Settings_Section' ) ? LearnDash_Settings_Section::get_section_setting( 'LearnDash_Settings_Section_PayPal', 'paypal_currency' ) : null;
		$currency = $price_text = '';

		if ( isset( $currency_setting ) || ! empty( $currency_setting ) ) {
			$currency = $currency_setting;
		} else if ( isset( $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'] ) ) {
			$currency = $options['modules']['sfwd-courses_options']['sfwd-courses_paypal_currency'];
		}

		if ( is_null( $currency ) ) {
			$currency = 'USD';
		}

		$price_type = isset( $course_options['sfwd-courses_course_price_type'] ) ? strtoupper( $course_options['sfwd-courses_course_price_type'] ) : 'free';
		$price = isset( $course_options['sfwd-courses_course_price'] ) ? $course_options['sfwd-courses_course_price'] : '';

		if ( 'open' == $price_type ) {
			$price_text .= esc_html__( 'Open Registration', 'talemy' );
		} else if ( 'free' == $price_type || '' === $price ) {
			$price_text .= esc_html__( 'Free', 'talemy' );
		}

		if ( !empty( $price ) ) {
			$price_format = '{currency}{price}';
			$price_format = apply_filters( 'talemy_course_price_format', $price_format );
			$currency_symbol = apply_filters( 'talemy_currency_symbols', $currency, $course_id );
			$price_text = str_replace( array( '{currency}', '{price}' ), array( '<span class="symbol">'. $currency_symbol .'</span>', '<span class="price">'. $price .'</span>' ), $price_format );
		}

		return apply_filters( 'talemy_course_price', $price_text, $course_id );
	}
}

if ( !function_exists( 'talemy_get_ld_option_course_cats' ) ) {
	/**
	 * Get LearnDash course categoreis
	 *
	 * @param  string $type  value type: id (default) or slug
	 * @return array course categoreis
	 */
	function talemy_get_ld_option_course_cats( $type = 'id' ) {
		$cats = get_terms( 'hide_empty=0&taxonomy=ld_course_category' );
		$cats_array = array();
		if ( !empty( $cats ) && !is_wp_error( $cats ) ) {
			foreach ( $cats as $cat ) {
				$value = $type == 'slug' ? $cat->slug : $cat->term_id;
				$cats_array[ $value ] = wp_specialchars_decode( $cat->name );
			}
		}
		return $cats_array;
	}
}

if ( !function_exists( 'talemy_get_ld_option_course_tags' ) ) {
	/**
	 * Get LearnDash course tags
	 * @return array course tags
	 */
	function talemy_get_ld_option_course_tags() {
		$tags = get_terms( 'hide_empty=0&taxonomy=ld_course_tag' );
		$tags_array = array();
		if ( !empty( $tags ) && !is_wp_error( $tags ) ) {
			foreach ( $tags as $tag ) {
				$tags_array[ $tag->term_id ] = wp_specialchars_decode( $tag->name );
			}
		}
		return $tags_array;
	}
}

if ( !function_exists( 'talemy_get_ld_option_courses' ) ) {
	/**
	 * Get LearnDash courses
	 * @return array courses
	 */
	function talemy_get_ld_option_courses() {
		$options = array();
	    $posts = get_posts( array(
	        'post_type' => 'sfwd-courses',
	        'post_status' => 'publish',
	        'posts_per_page' => -1,
	    ));
	    foreach( $posts as $post ) {
	        $options[ $post->ID ] = $post->post_title;
	    }
	    return $options;
	}
}

if ( !function_exists( 'talemy_get_ld_course_student_count' ) ) {
	/**
	 * Get LearnDash course student count
	 * @param  integer $course_id     course id
	 * @param  integer $base_count    base count
	 * @return integer                student count
	 */
	function talemy_get_ld_course_student_count( $course_id, $base_count = 0 ) {
		$meta = get_post_meta( $course_id, '_sfwd-courses', true );
		if ( !empty( $meta['sfwd-courses_course_access_list'] ) ) {
			$lists = explode( ',', $meta['sfwd-courses_course_access_list'] );
			$count = count( $lists );
		} else {
			$count = 0;
		}
		return $count + absint( $base_count );
	}
}

if ( !function_exists( 'talemy_get_wc_product_price' ) ) {
    /**
     * Get Woocommerce product price
     */
	function talemy_get_wc_product_price( $product_id = null ) {
		if ( empty( $product_id ) ) {
			return '';
		}
	 
		$product = wc_get_product( $product_id );
	 
		if ( ! $product ) {
			return '';
		}
	 
		return $product->get_price_html();
	}
}

if ( !function_exists( 'talemy_get_ld_wc_payment_button' ) ) {
    /**
     * Get WooCommerce payment button for a course
     */
	function talemy_get_ld_wc_payment_button( $course_id, $product_id = null ) {
		global $woocommerce;

		if ( empty( $course_id ) || empty( $product_id ) ) {
			return '';
		}

		$button = '';
		$meta = get_post_meta( $course_id, '_sfwd-courses', true );
		$custom_button_url = !empty( $meta['sfwd-courses_custom_button_url'] ) ? $meta['sfwd-courses_custom_button_url'] : '';
		$custom_button_label = !empty( $meta['sfwd-courses_custom_button_label'] ) ? $meta['sfwd-courses_custom_button_label'] : '';
	 
		if ( empty( $custom_button_label ) ) {
			$button_text = LearnDash_Custom_Label::get_label( 'button_take_this_course' );
		} else {
			$button_text = esc_attr( $custom_button_label );
		}

		if ( empty( $custom_button_url ) ) {
			$checkout_url = $woocommerce->cart->get_cart_url();
			$button_url = add_query_arg( 'add-to-cart', $product_id, $checkout_url );
		} else {
			$custom_button_url = trim( $custom_button_url );
			/**
			 * If the value does NOT start with [http://, https://, /] we prepend the home URL.
			 */
			if ( ( stripos( $custom_button_url, 'http://', 0 ) !== 0 ) && ( stripos( $custom_button_url, 'https://', 0 ) !== 0 ) && ( strpos( $custom_button_url, '/', 0 ) !== 0 ) ) {
				$button_url = get_home_url( null, $custom_button_url );
			}
		}

		$button_url = apply_filters( 'sf_learndash_wc_payment_button_url', $button_url, $course_id, $product_id );

		if ( !empty( $button_url ) ) {
			$button = '<a class="btn btn-lg btn-primary btn-block" href="' . esc_url( $button_url ) . '">' . $button_text . '</a>';
		}

		return $button;
	}
}

if ( !function_exists( 'talemy_get_ld_course_resume_link' ) ) {
	/**
	 * Get LearnDash course resume link
	 *
	 * @param  int $course_id  course id
	 * @return string
	 */
	function talemy_get_ld_course_resume_link( $course_id ) {
		$permalink = '';
		
		if ( is_user_logged_in() ) {
			if ( !empty( $course_id ) ) {
				$user	= wp_get_current_user();
				$course	= get_post( $course_id );

				if ( isset( $course ) && 'sfwd-courses' === $course->post_type ) {
					$course_progress	= get_user_meta( get_current_user_id(), '_sfwd-course_progress', true );
					$course_progress 	= !empty( $course_progress ) ? $course_progress : array();
					$lesson_list		= learndash_get_lesson_list( $course_id );
					$last_known_step_id = '';

					if ( empty( $lesson_list ) ) {
						return '';
					}

					if ( !isset( $course_progress[ $course_id ] ) ) {
						$last_known_step_id = $lesson_list[0]->ID;
					} else {
						$course_steps = $course_progress[ $course_id ];
						$last_known_step_id = isset( $course_steps['last_id'] ) ? $course_steps['last_id'] : 0;
					}

					$last_know_post_object = get_post( absint( $last_known_step_id ) );

					// Make sure the post exists
					if ( null !== $last_know_post_object ) {
						if ( function_exists( 'learndash_get_step_permalink' ) ) {
							$permalink = learndash_get_step_permalink( $last_known_step_id, $course_id );
						} else {
							$permalink = get_permalink( $step_id );
						}
					}
				}
			}
		}
		
		return $permalink;
	}
}