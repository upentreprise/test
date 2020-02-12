<?php
/**
 * bbPress integration
 *
 * @since   1.1.7
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_bbPress {

    /**
	 * Hooks
	 */
	public function __construct() {
        // Enqueue scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );

        // bbPress page
        add_filter( 'is_bbpress', array( $this, 'bbp_page' ) );

        // Disable bbpress breadcrumbs
        add_filter( 'bbp_no_breadcrumb', '__return_true' );

        // Remove bbpress forum & topic description
        add_filter( 'bbp_get_single_forum_description', '__return_empty_string' );
        add_filter( 'bbp_get_single_topic_description', '__return_empty_string' );

        // Add search form
        add_action( 'bbp_template_before_single_forum', array( $this, 'add_search_form' ) );
        add_action( 'bbp_template_before_single_topic', array( $this, 'add_search_form' ) );
        add_action( 'bbp_template_before_search', array( $this, 'add_search_form' ) );

        // Replace subscribe separater
        add_filter( 'bbp_get_user_subscribe_link', array( $this, 'replace_separater' ), 10, 4 );
    }

    /**
     * Print search form
     *
     * @return void
     */
    public function add_search_form() {
        ?>
        <?php if ( bbp_allow_search() ) : ?>
            <div class="bbp-search-form">
                <?php bbp_get_template_part( 'form', 'search' ); ?>
            </div>
        <?php endif; ?>
        <?php
    }

    /**
     * Replace separater
     */
    public function replace_separater( $html, $r, $user_id, $topic_id ) {
        return str_replace( '&nbsp;|&nbsp;', '<span class="sep"></span>', $html );
    }

    /**
     * Enqueue scripts
     *
     * @return void
     */
    public function scripts() {
        $suffix = !TALEMY_DEV_MODE ? '.min' : '';

        if ( is_bbpress() ) {
            wp_register_style(
                'talemy-bbpress',
                TALEMY_THEME_URI . 'assets/css/bbpress' . $suffix . '.css',
                false,
                TALEMY_THEME_VERSION
            );
            wp_enqueue_style( 'talemy-bbpress' );
            wp_style_add_data( 'talemy-bbpress', 'rtl', 'replace' );
        }
    }

    /**
     * Check if post has bbpress shortcodes
     *
     * @param bool $is_bbpress
     * @return bool
     */
    public function bbp_page( $is_bbpress ) {
        global $post;
        if ( $post instanceof WP_Post && ( has_shortcode( $post->post_content, 'bbp-login' ) || has_shortcode( $post->post_content, 'bbp-register' ) || has_shortcode( $post->post_content, 'bbp-lost-pass' ) ) ) {
            $is_bbpress = true;
        }
        return $is_bbpress;
    }
}

if ( class_exists( 'bbPress' ) ) {
    new Talemy_bbPress();
}
