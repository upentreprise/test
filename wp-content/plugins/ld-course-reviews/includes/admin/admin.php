<?php
/**
 * LDCR Admin
 * 
 */
defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class LDCR_Admin {

    /**
     * Constructor
     */
    function __construct() {
        $this->constants();
        $this->includes();
        $this->hooks();
    }

    /**
     * Define constants
     */
    function constants() {
        global $ldcr_settings;
        if ( !isset( $ldcr_settings ) ) {
            $ldcr_settings = get_option( 'ldcr_settings' );
        }
        $ldcr_settings = !empty( $ldcr_settings ) && is_array( $ldcr_settings ) ? $ldcr_settings : array();
    }

    /**
     * Include files
     */
    function includes() {
        require_once( LDCR_DIR . 'includes/admin/metabox.php' );
        require_once( LDCR_DIR . 'includes/admin/settings.php' );
        require_once( LDCR_DIR . 'includes/admin/tools.php' );
        require_once( LDCR_DIR . 'includes/admin/license.php' );
    }

    /**
     * Hooks
     */
    function hooks() {
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
        add_action( 'admin_menu', array( $this, 'admin_menus' ) );
        // approve & unapprove actions
        add_filter( 'post_row_actions', array( $this, 'add_post_row_actions' ), 10, 2 );
        add_action( 'wp_ajax_ldcr_approve_review', array( $this, 'approve' ) );
        add_action( 'wp_ajax_ldcr_unapprove_review', array( $this, 'unapprove' ) );
        // update course rating if post status is changed
        add_action( 'save_post', array( $this, 'update_course_meta' ) );
        add_action( 'wp_trash_post', array( $this, 'update_course_meta' ) );
        add_action( 'untrash_post', array( $this, 'update_course_meta' ) );
        add_action( 'delete_post', array( $this, 'update_course_meta' ) );
        add_action( 'delete_post', array( $this, 'update_review_meta' ), 20 );
        add_action( 'delete_user', 'ldcr_update_review_meta' );
        // custom columns and filters on manage posts screen
        add_filter( 'manage_ldcr_review_posts_columns' , array( $this, 'add_review_columns' ) );
        add_action( 'manage_ldcr_review_posts_custom_column' , array( $this, 'custom_columns' ), 10, 2 );
        add_filter( 'manage_edit-ldcr_review_sortable_columns', array( $this, 'sortable_columns' ) );
        add_action( 'pre_get_posts', array( $this, 'columns_orderby' ) );
        add_action( 'restrict_manage_posts', array( $this, 'add_custom_filters' ) );
        add_filter( 'parse_query', array( $this, 'add_query_filter' ) );
    }

    /**
     * Admin notices
     */
    function admin_notices() {
        // display a notice if LearnDash LMS is not active
        if ( !is_plugin_active( 'sfwd-lms/sfwd_lms.php' ) ) {
            ?>
            <div class="notice notice-error is-dismissible">
                <p><?php printf( __( '%s - The following required plugin is currently inactive: %s', 'ld-course-reviews' ), '<b>LearnDash Course Reviews</b>', '<b>LearnDash LMS</b>' ); ?></p>
            </div>
            <?php
        }
        // settings updated
        settings_errors( 'ldcr-notices' );
    }

    /**
     * Enqueue admin scripts
     */
    function admin_scripts() {
        $screen = get_current_screen();
        $screen = isset( $screen ) ? $screen : '';
        
        $dev_mode = false;
        $min = !$dev_mode ? '.min' : '';

        // enqueue style
        wp_enqueue_style( 'ldcr-admin', LDCR_URI . 'assets/css/admin'. $min .'.css', false, LDCR_VERSION );
        wp_style_add_data( 'ldcr-admin', 'rtl', 'replace' );

        // enqueue script
        if ( 'edit-ldcr_review' == $screen->id || 'ldcr_review_page_ldcr_tools' == $screen->id ) {
            wp_enqueue_script( 'ldcr-admin', LDCR_URI . 'assets/js/admin'. $min .'.js', array( 'jquery' ), LDCR_VERSION, true );
        }
        // disable autosave
        if ( 'ldcr_review' == $screen->id ) {
            wp_dequeue_script( 'autosave' );
        }
    }

    /**
     * Admin menus
     */
    function admin_menus() {
        add_submenu_page( 'edit.php?post_type=ldcr_review', __( 'Settings', 'ld-course-reviews' ), __( 'Settings', 'ld-course-reviews' ), 'edit_theme_options', 'ldcr_settings', 'ldcr_settings_page' );
        add_submenu_page( 'edit.php?post_type=ldcr_review', __( 'Tools', 'ld-course-reviews' ), __( 'Tools', 'ld-course-reviews' ), 'edit_theme_options', 'ldcr_tools', 'ldcr_tools_page' );
        add_submenu_page( 'edit.php?post_type=ldcr_review', __( 'License', 'ld-course-reviews' ), __( 'License', 'ld-course-reviews' ), 'edit_theme_options', 'ldcr_license', array( 'LDCR_License', 'form' ) );
    }

    /**
     * Add approve & unapprove action
     * 
     * @param array $actions  actions array
     * @param object $post    WP_Post
     */
    function add_post_row_actions( $actions, $post ) {
        if ( 'ldcr_review' !== $post->post_type || 'trash' === $post->post_status ) {
            return $actions;
        }

        // Remove quick-edit
        unset( $actions['inline hide-if-no-js'] );

        $custom_actions = [];
        $custom_actions['approve'] = '<a href="'. wp_nonce_url( admin_url( sprintf( 'post.php?post=%s&action=approve', $post->ID ) ), 'approve_review_'. $post->ID ) .'" class="ldcr-change-review-status" aria-label="'. __( 'Approve this review', 'ld-course-reviews' ) .'">'. __( 'Approve', 'ld-course-reviews' ) .'</a>';
        $custom_actions['unapprove'] = '<a href="'. wp_nonce_url( admin_url( sprintf( 'post.php?post=%s&action=unapprove', $post->ID ) ), 'unapprove_review_'. $post->ID ) .'" class="ldcr-change-review-status" aria-label="'. __( 'Unapprove this review', 'ld-course-reviews' ) .'">'. __( 'Unapprove', 'ld-course-reviews' ) .'</a>';

        return $custom_actions + $actions;
    }

    /**
     * Approve a review
     */
    function approve() {
        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';
        check_admin_referer( "approve_review_{$post_id}" );
        
        wp_update_post( array( 'ID' => $post_id, 'post_status' => 'publish' ) );
        $course_id = get_post_meta( $post_id, '_ld_course_id', true );
        ldcr_update_course_meta( $course_id );
        
        wp_send_json_success();
    }

    /**
     * Unapprove a review
     */
    function unapprove() {
        $post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : '';
        check_admin_referer( "unapprove_review_{$post_id}" );
        
        wp_update_post( array( 'ID' => $post_id, 'post_status' => 'pending' ) );
        $course_id = get_post_meta( $post_id, '_ld_course_id', true );
        ldcr_update_course_meta( $course_id );
        
        ob_start();
        _post_states( get_post( $post_id ) );
        $state = ob_get_clean();

        wp_send_json_success( array( 'state' => $state ) );
    }

    /**
     * Update course meta
     * 
     * @param  int $post_id  review post id
     * @return void
     */
    function update_course_meta( $post_id ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( 'ldcr_review' == get_post_type( $post_id ) ) {
            $course_id = get_post_meta( $post_id, '_ldcr_course_id', true );
            ldcr_update_course_meta( $course_id );
        }
    }

    /**
     * Update review meta
     * 
     * @param  int $post_id  review id
     * @return void
     */
    function update_review_meta( $post_id ) {
        delete_metadata( 'user', null, 'ldcr_vote_'. $post_id, null, true );
    }

    /**
     * Add columns
     * @param array $columns columns data
     */
    function add_review_columns( $columns ) {
        $date = $columns['date'];
        unset( $columns['date'] );
        $columns['course'] = __( 'Course', 'ld-course-reviews' );
        $columns['rating'] = __( 'Rating', 'ld-course-reviews' );
        $columns['author'] = __( 'Author', 'ld-course-reviews' );
        $columns['date'] = $date;
        return $columns;
    }

    /**
     * Add column output
     * 
     * @param  string $column column slug
     * @param  int $post_id post id
     */
    function custom_columns( $column, $post_id ) {
        switch ( $column ) {
            case 'course':
                $course_id = get_post_meta( $post_id, '_ldcr_course_id', true );
                if ( $course_id ) : ?>
                <a href="<?php echo esc_url( get_edit_post_link( $course_id ) ); ?>"><?php echo get_the_title( $course_id ); ?></a>
                <?php endif;
                break;

            case 'rating':
                $score = get_post_meta( $post_id, '_ldcr_rating', true );
                echo ldcr_get_rating_stars( $score );
                break;

            case 'author':
                $post = get_post( $post_id );
                if ( $post ) {
                    echo get_the_author_meta( 'display_name', $post->post_author );
                }
                break;
        }
    }

    /**
     * Make columns sortable
     * 
     * @param  array $columns sortable columns
     * @return array          columns
     */
    function sortable_columns( $columns ) {
        $columns['course'] = 'course';
        $columns['rating'] = 'ldcr_rating';
        return $columns;
    }

    /**
     * Modify orderby query
     * 
     * @param  object $query WP_Query
     */
    function columns_orderby( $query ) {
        if ( !is_admin() ) {
            return;
        }

        $orderby = $query->get( 'orderby' );
        if ( 'ldcr_rating' == $orderby ) {
            $query->set( 'meta_key', '_ldcr_rating' );
            $query->set( 'orderby', 'meta_value_num' );
        }
    }

    /**
     * Query filter
     * 
     * @param  object $query WP_Query
     */
    function add_query_filter( $query ) {
        if ( !is_admin() ) {
            return;
        }

        global $post_type, $pagenow;

        if ( 'edit.php' !== $pagenow || 'ldcr_review' !== $post_type ) {
            return;
        }

        if ( isset( $_GET['ldcr_course_id'] ) && $_GET['ldcr_course_id'] != '') {
            $query->query_vars['meta_key'] = 'ldcr_course_id';
            $query->query_vars['meta_value'] = absint( $_GET['ldcr_course_id'] );
        }

        if ( isset( $_GET['ldcr_rating'] ) && $_GET['ldcr_rating'] != '') {
            $value = absint( $_GET['ldcr_rating'] );
            $query->query_vars['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key' => '_ldcr_rating',
                    'value' => $value,
                    'compare' => '>='
                ),
                array(
                    'key' => '_ldcr_rating',
                    'value' => ( $value + 1 ),
                    'compare' => '<'
                )
            );
        }
    }

    /**
     * Add course and rating filter on manage posts screen
     * 
     * @param  object $query WP_Query
     */
    function add_custom_filters( $query ) {
        global $post_type, $pagenow;
        
        if ( 'edit.php' != $pagenow || 'ldcr_review' != $post_type ) {
            return;
        }
        
        // Course filter
        if ( isset( $_GET['ldcr_course_id'] ) ) {
            $selected = sanitize_text_field( $_GET['ldcr_course_id'] );
        } else {
            $selected = '';
        }

        $query = new WP_Query( array(
            'post_type' => 'sfwd-courses',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'not_found_rows' => 1,
        ));

        if ( $query->have_posts() ) {
            ?>
            <select name="ldcr_course_id">
                <option value=""><?php esc_html_e( 'All courses', 'ld-course-reviews' ); ?></option>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <option value="<?php echo get_the_ID(); ?>" <?php selected( get_the_ID(), $selected ); ?>><?php the_title(); ?></option>
                <?php endwhile; ?>
            </select>
            <?php
        }

        // Rating filter
        if ( isset( $_GET['ldcr_rating'] ) ) {
            $selected = sanitize_text_field( $_GET['ldcr_rating'] );
        } else {
            $selected = '';
        }
        ?>
        <select name="ldcr_rating">
            <option value="" <?php selected( '', $selected ); ?>><?php esc_html_e( 'All stars', 'ld-course-reviews' ); ?></option>
            <option value="5" <?php selected( '5', $selected ); ?>><?php esc_html_e( '5 stars', 'ld-course-reviews' ); ?></option>
            <option value="4" <?php selected( '4', $selected ); ?>><?php esc_html_e( '4 stars', 'ld-course-reviews' ); ?></option>
            <option value="3" <?php selected( '3', $selected ); ?>><?php esc_html_e( '3 stars', 'ld-course-reviews' ); ?></option>
            <option value="2" <?php selected( '2', $selected ); ?>><?php esc_html_e( '2 stars', 'ld-course-reviews' ); ?></option>
            <option value="1" <?php selected( '1', $selected ); ?>><?php esc_html_e( '1 star', 'ld-course-reviews' ); ?></option>
        </select>
        <?php
    }
}

if ( is_admin() ) {
    new LDCR_Admin();
}
