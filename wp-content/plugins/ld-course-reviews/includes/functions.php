<?php

if ( !function_exists( 'ldcr_course_rating' ) ) {
	/**
	 * Display course rating html
	 * 
	 * @param  int  $course_id  course id
	 * @param  boolean $show_count show review count
	 * @param  boolean $show_score show review score
	 * @param  boolean $show_stars show stars
	 * @return string
	 */
	function ldcr_course_rating( $course_id = null, $show_count = false, $show_score = false, $show_stars = true ) {
		echo ldcr_get_course_rating( $course_id, $show_count, $show_score, $show_stars );
	}
}

if ( !function_exists( 'ldcr_get_course_rating' ) ) {
	/**
	 * Get course rating html
	 * 
	 * @param  int  $course_id  course id
	 * @param  boolean $show_count show number of reviews
	 * @param  boolean $show_score show review score
	 * @param  boolean $show_stars show stars
	 * @return string
	 */
	function ldcr_get_course_rating( $course_id = null, $show_count = false, $show_score = false, $show_stars = true ) {
		if ( empty( $course_id ) ) {
			$course_id = get_the_ID();
		}

		if ( empty( $course_id ) ) {
			return '';
		}

		$out = '';
		$score = ldcr_get_course_rating_score( $course_id );
		$hide_not_rated = apply_filters( 'ldcr_course_rating_hide_not_rated', true );

		if ( '' === $score ) {
			$score = 0;

			if ( !$hide_not_rated ) {
				return '';
			}
		}

		if ( $show_stars ) {
			$out .= ldcr_get_rating_stars( $score );
		}

		if ( $show_score ) {
			$out .= '<span class="ldcr-rating-score">'. $score . '</span>';
		}
	
		if ( $show_count ) {
			$count = ldcr_get_course_total_reviews( $course_id );
			$ratings_text = sprintf( _n( '%s <span>rating</span>', '%s <span>ratings</span>', $count, 'spirit' ), $count );
			$out .= '<span class="ldcr-total-reviews">('. $ratings_text .')</span>';
		}
		
		return '<span class="ldcr-rating-wrapper">'. $out .'</span>';
	}
}

if ( !function_exists( 'ldcr_get_rating_stars' ) ) {
	/**
	 * Get rating stars html
	 * 
	 * @param  string $score  review score
	 * @return string         html
	 */
	function ldcr_get_rating_stars( $score = '' ) {
		if ( isset( $score ) && '' !== $score ) {
			$fill_width = round( $score, 2 ) * 20;
			return "<span class='ldcr-rating'>
				<span class='ldcr-unfilled-stars'>
					<i class='ldcr-star ldcr-star--unfilled'></i>
					<i class='ldcr-star ldcr-star--unfilled'></i>
					<i class='ldcr-star ldcr-star--unfilled'></i>
					<i class='ldcr-star ldcr-star--unfilled'></i>
					<i class='ldcr-star ldcr-star--unfilled'></i>
				</span>
				<span class='ldcr-filled-stars' style='width:{$fill_width}%;'>
					<i class='ldcr-star ldcr-star--filled'></i>
					<i class='ldcr-star ldcr-star--filled'></i>
					<i class='ldcr-star ldcr-star--filled'></i>
					<i class='ldcr-star ldcr-star--filled'></i>
					<i class='ldcr-star ldcr-star--filled'></i>
				</span>
			</span>";
		}
		return '';
	}
}

if ( !function_exists( 'ldcr_course_rating_stars' ) ) {
	/**
	 * Display course rating - stars
	 *
	 * Provide course id or use within the loop
	 * 
	 * @param  string $course_id  course id
	 * @return html
	 */
	function ldcr_course_rating_stars( $course_id = null ) {
		echo ldcr_get_course_rating_stars( $course_id );
	}
}

if ( !function_exists( 'ldcr_get_course_rating_stars' ) ) {
	/**
	 * Get course rating - stars
	 *
	 * Provide course id or use within the loop
	 * 
	 * @param  string $course_id  course id
	 * @return html
	 */
	function ldcr_get_course_rating_stars( $course_id = null ) {
		$score = ldcr_get_course_rating_score( $course_id );
		return ldcr_get_rating_stars( $score );
	}
}

if ( !function_exists( 'ldcr_course_rating_score' ) ) {
	/**
	 * Display course rating - score
	 *
	 * Provide course id or use within the loop
	 * 
	 * @param  string $course_id  course id
	 * @return html
	 */
	function ldcr_course_rating_score( $course_id = null ) {
		echo ldcr_get_course_rating_score( $course_id );
	}
}

if ( !function_exists( 'ldcr_get_course_rating_score' ) ) {
	/**
	 * Get course rating - score
	 * 
	 * Provide course id or use within the loop
	 * 
	 * @param  string $course_id  course id
	 * @return string             review score
	 */
	function ldcr_get_course_rating_score( $course_id = null ) {
		if ( empty( $course_id ) ) {
			$course_id = get_the_ID();
		}
		$score = get_post_meta( $course_id, '_ldcr_rating', true );
		return !empty( $score ) ? $score : '';
	}
}

if ( !function_exists( 'ldcr_get_course_total_reviews' ) ) {
	/**
	 * Get the total number of reviews of one course
	 * 
	 * Provide course id or use within the loop
	 * 
	 * @param  string $course_id  course id
	 * @return string             number of reviews
	 */
	function ldcr_get_course_total_reviews( $course_id = null ) {
		if ( empty( $course_id ) ) {
			$course_id = get_the_ID();
		}
		$total = get_post_meta( $course_id, '_ldcr_total_rating', true );
		return !empty( $total ) ? $total : 0;
	}
}

if ( !function_exists( 'ldcr_update_course_meta' ) ) {
	/**
	 * Update course meta - rating
	 * 
	 * @param  int $course_id    course id
	 * @return void
	 */
	function ldcr_update_course_meta( $course_id = null ) {

		if ( empty( $course_id ) ) {
			return;
		}

		$rating = new LDCR_Rating_Summary( $course_id );
		update_post_meta( $course_id, '_ldcr_rating', $rating->get_average_score() );
		update_post_meta( $course_id, '_ldcr_total_rating', $rating->get_total_count() );

		// run this whenever course meta is updated
		do_action( 'ldcr_update_course_meta', $course_id );
	}
}

if ( !function_exists( 'ldcr_update_review_meta' ) ) {
	/**
	 * Update review meta
	 * 
	 * @param  int $post_id    review post id
	 * @return void
	 */
	function ldcr_update_review_meta( $review_id = null, $course_id = null ) {

		if ( empty( $review_id ) ) {
			return;
		}

		if ( is_null( $course_id ) ) {
			$course_id = get_post_meta( $review_id, '_ldcr_course_id', true );
		}

		$upvotes = ldcr_get_upvote_count( $review_id );
		update_post_meta( $review_id, '_ldcr_upvotes', $upvotes );

		// run this whenever review meta is updated
		do_action( 'ldcr_update_review_meta', $review_id, $course_id );
	}
}

if ( !function_exists( 'ldcr_get_upvote_count' ) ) {
	/**
	 * Get upvote count
	 * 
	 * @param  int $review_id  review id
	 * @return int count
	 */
	function ldcr_get_upvote_count( $review_id = null ) {
		global $wpdb;

		$query = $wpdb->prepare("
			SELECT COUNT(*)
			FROM {$wpdb->base_prefix}usermeta um
			WHERE um.meta_key = %s AND um.meta_value = %s
		", "ldcr_vote_{$review_id}", "up" );

		$count = $wpdb->get_var( $query );
		if ( $count ) {
			return $count;
		}
		return 0;
	}
}

if ( !function_exists( 'ldcr_get_course_reviews_query' ) ) {
	function ldcr_get_course_reviews_query( $course_id = 0 ) {
		$posts_per_page = ldcr_get_setting( 'reviews_per_page', 10 );
		$review_page = get_query_var( 'review_page' );

		if ( !empty( $review_page ) && absint( $review_page ) > 1 ) {
			$offset = ( absint( $review_page ) - 1 ) * $posts_per_page;
		}

		$query_args = array(
			'post_type'        => 'ldcr_review',
			'post_status'      => 'publish',
			'posts_per_page'   => $posts_per_page,
			'paged'            => 1,
			'meta_query'       => array(
				'relation'     => 'AND',
				array(
					'key'      => '_ldcr_course_id',
					'value'    => $course_id,
					'compare'  => '=',
				),
				'upvote_query' => array(
					'key'      => '_ldcr_upvotes',
					'compare'  => 'EXISTS',
				),
			),
			'orderby'          => array(
				'upvote_query' => 'DESC',
				'date'         => 'DESC',
			)
		);

		if ( !empty( $offset ) ) {
			$query_args['offset'] = $offset;
			$query_args['ldcr_page'] = $review_page;
		}

		$query_args = apply_filters( 'ldcr_course_reviews_query', $query_args );

		return new WP_Query( $query_args );
	}
}

if ( !function_exists( 'ldcr_get_pagination' ) ) {
	/**
	 * Get reviews pagination
	 * 
	 * @param  object $query WP_Query
	 * @return void or html
	 */
	function ldcr_get_pagination( $query ) {
		$posts_per_page = $query->get('posts_per_page');
		$found_posts = $query->found_posts;

		if ( $found_posts == 0 || $posts_per_page < 1 || $found_posts <= $posts_per_page ) {
			return;
		}

		if ( isset( $query->query_vars['ldcr_page'] ) ) {
			$current = $query->query_vars['ldcr_page'];
		} else {
			$current = 1;
		}

		$total = ceil( $found_posts / $posts_per_page );
		$next = esc_html__( 'Next', 'ld-course-reviews' );
		$prev = esc_html__( 'Previous', 'ld-course-reviews' );
		$next_class = $current == $total ? 'next disabled' : 'next';
		$prev_class = $current == 1 ? 'prev disabled' : 'prev';

		$out = '<div class="ldcr-reviews__pagination">';
		$out .= '<div class="ldcr-page-numbers">';
		$out .= '<button class="ldcr-page-number '. $prev_class .'" data-page="prev">'. $prev . '</button>';
		
		for ( $n = 1; $n <= $total; $n++ ) {
			if ( $n == $current ) {
				$out .= '<button class="ldcr-page-number current" data-page="'. $n .'">'. number_format_i18n( $n ) . '</button>';
			} else {
				$out .= '<button class="ldcr-page-number" data-page="'. $n .'">'. number_format_i18n( $n ) . '</button>';
			}
		}
		
		$out .= '<button class="ldcr-page-number '. $next_class .'" data-page="next">'. $next . '</button>';
		$out .= '</div>';
		$out .= '</div>';

		return $out;
	}
}


if ( !function_exists( 'ldcr_send_new_review_email' ) ) {
	/**
	 * Send new reivew email - notify course author
	 * 
	 * @param  int $course_id    course id
	 * @param  int $review_id    review id
	 * @param  string $rating    rating score
	 * @param  string $headline  review headline
	 * @param  string $content   review content
	 * @return void
	 */
	function ldcr_send_new_review_email( $course_id, $review_id, $rating = '', $headline = '', $content = '' ) {
		
		$from_name     = ldcr_get_setting( 'from_name' );
		$from_name     = !empty( $from_name ) ? wp_specialchars_decode( esc_html( $from_name ), ENT_QUOTES ) : wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
		
		$from_address  = ldcr_get_setting( 'from_email' );
		$from_address    = !empty( $from_address ) ? sanitize_email( $from_address ) : get_option( 'admin_email' );
		
		$subject       = ldcr_get_setting( 'new_review_subject' );
		$subject       = !empty( $subject ) ? $subject : __( 'A user has written a new review for {course_title}', 'ld-course-reviews' );
		
		$email_type    = ldcr_get_setting( 'new_review_email_type', 'plain' );

		if ( 'html' == $email_type ) {
			$content_type = 'text/html';
			$template_path = 'emails/new-review.php';
		} else {
			$content_type = 'text/plain';
			$template_path = 'emails/plain/new-review.php';
		}

        $headers  = "From: {$from_name} <{$from_address}>\r\n";
        $headers .= "Reply-To: {$from_address}\r\n";
        $headers .= "Content-Type: {$content_type}; charset=utf-8\r\n";

        $course   = get_post( $course_id );
        $to       = get_the_author_meta( 'user_email', $course->post_author );
		$subject  = preg_replace( '{course_title}', $course_title, $subject );

		$review   = get_post( $review_id );
		$author   = get_userdata( $review->post_author );

		$message = ldcr_get_template_html( $template_path, array(
			'course_title'  => $course->post_title,
			'rating'        => $rating,
			'headline'      => $headline,
			'content'       => $content,
			'review_author' => $author->display_name,
			'review_email'  => $author->user_email
		));

		$to = apply_filters( 'ldcr_new_review_recipients', $to );
		
		wp_mail( $to, $subject, $message, $headers );
	}
}

if ( !function_exists( 'ldcr_is_course_review_enabled' ) ) {
	/**
	 * Check if course review is enabled
	 * @return bool
	 */
	function ldcr_is_course_review_enabled( $course_id = null ) {
		if ( empty( $course_id ) ) {
			$course_id = get_the_ID();
		}
        $review_enabled = get_post_meta( $course_id, '_ldcr_enable', true );
        return isset( $review_enabled ) && $review_enabled || '' == $review_enabled;
	}
}

if ( !function_exists( 'ldcr_get_pending_review' ) ) {
	/**
	 * Get pending review
	 * 
	 * @param  int $course_id    course id
	 * @param  int $user_id      user id
	 * @return WP_Post
	 */
	function ldcr_get_pending_review( $course_id = null, $user_id = null ) {
		if ( empty( $course_id ) ) {
			$course_id = get_the_ID();
		}
        
        if ( empty( $user_id ) ) {
            $user_id = get_current_user_id();
		}

		if ( empty( $course_id ) || empty( $user_id ) ) {
			return '';
		}

		$user_review = get_posts( array(
        	'post_type' => 'ldcr_review',
        	'author' => $user_id,
        	'meta_key' => '_ldcr_course_id',
        	'meta_value' => $course_id,
        	'post_status' => 'pending'
		));

		return !empty( $user_review ) ? $user_review[0] : '';
	}
}

if ( !function_exists( 'ldcr_is_course_review_allowed' ) ) {
	/**
	 * Check if a user is allowed to submit a review
	 * 
	 * @param  int $course_id    course id
	 * @param  int $user_id      user id
	 * @return bool
	 */
	function ldcr_is_course_review_allowed( $course_id = null, $user_id = null ) {
        $allowed = false;

        if ( empty( $course_id ) ) {
            return false;
        }

        // if ( !is_user_logged_in() ) {
        // 	return new WP_Error( 'req_login', __( 'You must be logged in to submit a review.', 'ld-course-reviews' ) );
        // }
        
        if ( empty( $user_id ) ) {
            $user_id = get_current_user_id();
        }

        // check if there's an existing review from the user
        $user_review = get_posts( array(
        	'post_type' => 'ldcr_review',
        	'author' => $user_id,
        	'meta_key' => '_ldcr_course_id',
        	'meta_value' => $course_id,
        	'post_status' => array( 'publish', 'pending' )
        ));

        if ( !empty( $user_review ) ) {
        	return false;
        }

        // check requirements for submitting a review
        $review_after = get_post_meta( $course_id, '_ldcr_review_after', true );

        if ( isset( $review_after ) && 0 == $review_after ) {
        	$enrolled_courses = learndash_user_get_enrolled_courses( $user_id );

        	if ( in_array( $course_id, $enrolled_courses ) ) {
        		$allowed = true;
        	} else {
        		$allowed = new WP_Error( 'req_enrollment', __( 'You must be enrolled to review this course.', 'ld-course-reviews' ) );
        	}

        } else {
	        switch ( get_post_type( $review_after ) ) {
	            case 'sfwd-courses': $allowed = learndash_course_completed( $user_id, $review_after ); break;
	            case 'sfwd-lessons': $allowed = learndash_is_lesson_complete( $user_id, $review_after ); break;
	            case 'sfwd-topic': $allowed = learndash_is_topic_complete( $user_id, $review_after ); break;
	            case 'sfwd-quiz': $allowed = learndash_is_quiz_complete( $user_id, $review_after ); break;
	        }

	        if ( !$allowed ) {
	        	$allowed = new WP_Error( 'req_completion', __( 'You have not completed lessons required to submit a review for this course.', 'ld-course-reviews' ) );
	        }
        }

        return apply_filters( 'ldcr_course_review_allowed', $allowed );
	}
}

if ( !function_exists( 'ldcr_comments_link' ) ) {
	/**
	 * Display comments link
	 */
	function ldcr_comments_link() {
		$num_comments = get_comments_number();

		if ( comments_open() && !ldcr_get_setting( 'disable_comments', false ) ) {
			if ( $num_comments == 0 ) {
				$comments = __( 'Comment' );
			} elseif ( $num_comments > 1 ) {
				$comments = sprintf( __( '%s comments', 'ld-course-reviews' ), $num_comments );
			} else {
				$comments = __( '1 comment', 'ld-course-reviews' );
			} ?>
			<a class="ldcr-btn-comment" href="<?php echo get_comments_link(); ?>"><?php echo $comments; ?></a><?php
		}
	}
}