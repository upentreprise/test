<?php

/**
 * LD Course Reviews
 * 
 */

class LD_Course_Reviews {

	/**
	 * Static property to hold our singleton instance
	 *
	 */
	private static $instance = null;

	/**
	 * If an instance exists, this returns it.  If not, it creates one and
	 * retuns it.
	 *
	 * @return LD_Course_Reviews
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self;
			self::$instance->includes();
			self::$instance->hooks();
		}
		return self::$instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'ld-course-reviews' ), '1.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'ld-course-reviews' ), '1.0' );
	}

	/**
	 * Include files
	 */
	public function includes() {
		require_once( LDCR_DIR . 'includes/class-rating-summary.php' );
		require_once( LDCR_DIR . 'includes/core-functions.php' );
		require_once( LDCR_DIR . 'includes/functions.php' );
		require_once( LDCR_DIR . 'includes/shortcodes.php' );
		require_once( LDCR_DIR . 'includes/admin/admin.php' );
	}

	/**
	 * Hooks - actions and filters
	 */
	public function hooks() {
		add_action( 'plugins_loaded', array( self::$instance, 'load_plugin_textdomain' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_filter( 'query_vars', array( $this, 'query_vars' ) );

		if ( 'theme' == ldcr_get_setting( 'review_template' ) ) {
			add_action( 'template_redirect', array( __CLASS__, 'unsupported_theme_init' ) );
		} else {
			add_filter( 'template_include', array( __CLASS__, 'template_loader' ) );
		}

		if ( ldcr_get_setting( 'show_after_course', false ) ) {
			add_action( 'learndash-course-after', array( __CLASS__, 'add_course_reviews' ), 10, 3 );
		}

		add_action( 'wp_ajax_ldcr_submit_review', array( $this, 'submit_course_review' ) );
		add_action( 'wp_ajax_nopriv_ldcr_submit_review', array( $this, 'submit_course_review' ) );
		add_action( 'wp_ajax_ldcr_load_reviews', array( $this, 'load_reviews' ) );
		add_action( 'wp_ajax_nopriv_ldcr_load_reviews', array( $this, 'load_reviews' ) );
		add_action( 'wp_ajax_ldcr_vote_review', array( $this, 'vote_review' ) );
		add_action( 'wp_ajax_nopriv_ldcr_vote_review', array( $this, 'vote_review' ) );
		
		add_action( 'ldcr_email_header', array( $this, 'email_header' ) );
		add_action( 'ldcr_email_footer', array( $this, 'email_footer' ) );
		add_action( 'ldcr_course_reviews', array( $this, 'display_course_reviews' ) );
		add_action( 'ldcr_content_single_review', array( $this, 'display_single_review' ) );
		add_action( 'ldcr_course_rating', 'ldcr_course_rating', 10, 4 );
		add_action( 'ldcr_course_rating_stars', 'ldcr_course_rating_stars', 10, 1 );
		add_action( 'ldcr_course_rating_score', 'ldcr_course_rating_score', 10, 1 );
	}

	/**
	 * Load textdomain
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'ld-course-reviews', false, LDCR_DIR . 'languages' );
	}

	/**
	 * Frontend scripts
	 */
	public function frontend_scripts() {
		$dev_mode = false;
		$min = !$dev_mode ? '.min' : '';
		wp_register_style( 'ldcr', LDCR_URI . 'assets/css/style'. $min .'.css', false, LDCR_VERSION );
		wp_register_script( 'ldcr', LDCR_URI . 'assets/js/frontend'. $min .'.js', array( 'jquery' ), LDCR_VERSION, true );
		
		wp_enqueue_style( 'ldcr' );
		wp_style_add_data( 'ldcr', 'rtl', 'replace' );
		
		wp_enqueue_script( 'ldcr' );
		wp_localize_script( 'ldcr', 'ldcr_js_data', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'sending_feedback' => __( 'Sending feedback..', 'ld-course-reviews' )
		));

		if ( is_singular( 'ldcr_review' ) && comments_open() && !ldcr_get_setting( 'disable_comments', false ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Register review post type
	 */
	public function register_post_type() {

		$labels = array(
			'name'                  => _x( 'Course Reviews', 'Course Reviews', 'ld-course-reviews' ),
			'singular_name'         => _x( 'Course Review', 'Course Review', 'ld-course-reviews' ),
			'menu_name'             => __( 'Course Reviews', 'ld-course-reviews' ),
			'attributes'            => __( 'Item Attributes', 'ld-course-reviews' ),
			'all_items'             => __( 'All Reviews', 'ld-course-reviews' ),
			'edit_item'             => __( 'Edit Review', 'ld-course-reviews' ),
			'update_item'           => __( 'Update Review', 'ld-course-reviews' ),
			'view_item'             => __( 'View Review', 'ld-course-reviews' ),
			'view_items'            => __( 'View Reviews', 'ld-course-reviews' ),
			'search_items'          => __( 'Search Reviews', 'ld-course-reviews' )
		);
		
		$args = array(
			'label'                 => __( 'Course Revieiws', 'ld-course-reviews' ),
			'description'           => __( 'LearnDash course reviews', 'ld-course-reviews' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor', 'comments' ),
			'show_ui'               => true,
			'menu_position'         => 30,
			'menu_icon'             => 'dashicons-star-half',
			'rewrite'               => array(
				'slug' => 'course-reviews',
				'with_front' => true,
			),
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capabilities'          => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'          => true
		);
		
		register_post_type( 'ldcr_review', $args );

	    if ( get_option( 'ldcr_flush_rewrite_rules_flag' ) ) {
	        flush_rewrite_rules();
	        delete_option( 'ldcr_flush_rewrite_rules_flag' );
	    }
	}

	/**
	 * Load custom template
	 *
	 * @param string $template Template to load.
	 * @return string
	 */
	public static function template_loader( $template ) {
		if ( is_singular( 'ldcr_review' ) ) {
			$new_template = ldcr_locate_template( 'single-review.php' );
			if ( !empty( $new_template ) && file_exists( $new_template ) ) {
				$template = apply_filters( 'ldcr_single_review_template', $new_template );
			}
		}
		return $template;
	}

	/**
	 * Hook in methods to enhance the unsupported theme experience on pages.
	 *
	 * @return void
	 */
	public static function unsupported_theme_init() {
		if ( is_singular( 'ldcr_review' ) ) {
			add_filter( 'the_content', array( __CLASS__, 'unsupported_theme_review_content_filter' ), 10 );
		}
	}

	/**
	 *
	 * For unsupported themes, this will setup the single review content.
	 *
	 * @since 1.0.4
	 * @param string $content Existing post content.
	 * @return string
	 */
	public static function unsupported_theme_review_content_filter( $content ) {
		if ( 'default' !== ldcr_get_setting( 'review_template' ) || ! is_main_query() || ! in_the_loop() ) {
			return $content;
		}

		// Remove the filter we're in to avoid nested calls.
		remove_filter( 'the_content', array( __CLASS__, 'unsupported_theme_review_content_filter' ) );

		if ( is_singular( 'ldcr_review' ) ) {
			// hide page title on unsupported themes
			add_filter( 'ldcr_review_page_title', '__return_empty_string' );
			$content = ldcr_get_template_html( 'content-single-review.php' );
		}
		return $content;
	}

	/**
	 * Add review page number
	 * 
	 * @param  array $vars  query variables
	 * @return array        $vars
	 */
	public function query_vars( $vars ) {
		$vars[] = 'review_page';
		return $vars;
	}

	/**
	 * Get the email header.
	 *
	 */
	public function email_header() {
	    ldcr_get_template( 'emails/email-header.php' );
	}

	/**
	 * Get the email footer.
	 */
	public function email_footer() {
	    ldcr_get_template( 'emails/email-footer.php' );
	}

	/**
	 * Submit course review
	 */
	public function submit_course_review() {

		if ( empty( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'ldcr_review_nonce' ) ) {
			wp_send_json_error( array(
				'message' => esc_html__( 'Action failed. Please refresh the page and retry.', 'ld-course-reviews' )
			));
		}

		$rating = isset( $_POST['rating'] ) ? $_POST['rating'] : '1';
		$review = isset( $_POST['review'] ) ? $_POST['review'] : '';
		$headline = isset( $_POST['headline'] ) ? $_POST['headline'] : '';
		$course_id = isset( $_POST['course_id'] ) ? $_POST['course_id'] : '';

		if ( ldcr_get_setting( 'review_require_approval' ) ) {
			$post_status = 'pending';
		} else {
			$post_status = 'publish';
		}

		$post_data = array(
			'post_content' => $review,
			'post_title' => $headline,
			'post_type' => 'ldcr_review',
			'post_status' => $post_status,
			'comment_status' => 'open'
		);
		$post_id = wp_insert_post( $post_data, true );

		if ( !is_wp_error( $post_id ) && 0 !== $post_id ) {
			update_post_meta( $post_id, '_ldcr_rating', $rating );
			update_post_meta( $post_id, '_ldcr_course_id', $course_id );
			update_post_meta( $post_id, '_ldcr_upvotes', 0 );

			// send new review notification to course author
			if ( ldcr_get_setting( 'new_review_email' ) ) {
				ldcr_send_new_review_email( $course_id, $post_id, $rating, $headline, $review );
			}
			
			if ( $post_status === 'publish' ) {
				// update average rating of this course
				ldcr_update_course_meta( $course_id );
				
				do_action( 'ldcr_review_submission' );

				wp_send_json_success( array(
					'publish' => true,
					'message' => '<span class="success">' . esc_html__( 'Review published.', 'ld-course-reviews' ) . '</span>'
				));

			} else {
				do_action( 'ldcr_review_submission' );
				
				wp_send_json_success( array(
					'message' => esc_html__( 'Your review is awaiting approval.', 'ld-course-reviews' )
				));
			}

		} else {
			wp_send_json_error( array(
				'message' => '<span class="error">' . esc_html__( 'Submission failed. Please try again later.', 'ld-course-reviews' ) . '</span>'
			));
		}

		wp_die();
	}

	/**
	 * Load review items
	 */
	public function load_reviews() {
		
		$page_number = isset( $_POST['page_number'] ) ? $_POST['page_number'] : 1;
		$course_id = isset( $_POST['course_id'] ) ? $_POST['course_id'] : 0;
		$count = isset( $_POST['count'] ) ? $_POST['count'] : get_option( 'posts_per_page' );
		$filter_by_star = !empty( $_POST['filter_by_star'] ) ? $_POST['filter_by_star'] : '';
		$offset = $page_number * $count - $count;

		$query_args = array(
			'post_type'        => 'ldcr_review',
			'post_status'      => 'publish',
			'posts_per_page'   => $count,
			'paged'            => 1,
			'offset'           => $offset,
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

		if ( !empty( $filter_by_star ) ) {
			$query_args['meta_query'][] = array(
				'key' => '_ldcr_rating',
				'value' => $filter_by_star,
				'compare' => '>='
			);
			$query_args['meta_query'][] = array(
                'key' => '_ldcr_rating',
                'value' => ( $filter_by_star + 1 ),
                'compare' => '<'
			);
		}

		if ( $page_number > 1 ) {
			$query_args['ldcr_page'] = $page_number;
		}

		$query = new WP_Query( $query_args );

		if ( !$query->have_posts() ) {
			wp_send_json_error( array(
				'message' => esc_html__( 'No reviews to display', 'ld-course-reviews' ),
			));
		}

		ob_start();
		
		while( $query->have_posts() ) {
			$query->the_post();
			ldcr_get_template( 'loop-review.php', array( 'course_id' => $course_id ) );
		}

		$items = ob_get_clean();
		$pagination = ldcr_get_pagination( $query );
		wp_reset_postdata();
		
		wp_send_json_success( array(
			'items' => $items,
			'pagination' => $pagination,
		));

		wp_die();
	}

	/**
	 * Vote review
	 */
	public function vote_review() {

		if ( empty( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'ldcr_vote_nonce' ) ) {
			wp_send_json_error( array(
				'message' => esc_html__( 'Action failed. Please refresh the page and retry.', 'ld-course-reviews' )
			));
		}

		if ( !is_user_logged_in() ) {
			wp_send_json_error( array(
				'message' => esc_html__( 'You must be logged in to submit a vote.', 'ld-course-reviews' )
			));
		}

		$vote = isset( $_POST['vote'] ) ? $_POST['vote'] : '';
		$review_id = isset( $_POST['id'] ) ? $_POST['id'] : '';

		if ( !in_array( $vote, array( 'up', 'down', 'undo' ) ) ) {
			wp_send_json_error( array(
				'message' => '<span class="error">' . esc_html__( 'Invalid action.', 'ld-course-reviews' ) . '</span>'
			));
		}

		if ( 'undo' == $vote ) {
			delete_user_meta( get_current_user_id(), "ldcr_vote_{$review_id}" );
			ldcr_update_review_meta( $review_id );
			wp_send_json_success( array(
				'vote' => $vote
			));

		} else {
			update_user_meta( get_current_user_id(), "ldcr_vote_{$review_id}", $vote );
			ldcr_update_review_meta( $review_id );
			wp_send_json_success( array(
				'vote' => $vote,
				'message' => '<span class="success">' . esc_html__( 'Thank you for your feedback.', 'ld-course-reviews' ) . '</span>'
			));
		}

		wp_die();
	}

	/**
	 * Add course reviews after course content
	 *
	 * @param int $post_id
	 * @param int $course_id
	 * @param int $user_id
	 * @return void
	 */
	public static function add_course_reviews( $post_id, $course_id, $user_id ) {
		if ( is_singular( 'sfwd-courses' ) ) {
			ldcr_get_template_part( 'course', 'reviews' );
		}
	}

	/**
	 * Display course reviews on single course page
	 */
	function display_course_reviews() {
		ldcr_get_template_part( 'course', 'reviews' );
	}

	/**
	 * Display single review content
	 *
	 * use within the loop
	 */
	function display_single_review() {
		ldcr_get_template_part( 'loop', 'review' );
		wp_nonce_field( 'ldcr_vote_nonce', 'ldcr_vote_nonce' );
	}
}