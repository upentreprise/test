<?php
/**
 * Learndash integration
 *
 * @since   1.1.7
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Talemy_LearnDash {

    /**
	 * Hooks
	 */
	public function __construct() {
        add_action( 'pre_get_posts', array( $this, 'custom_query' ) );
        add_filter( 'talemy_currency_symbols', array( $this, 'currency_symbols' ), 10, 2 );
        add_action( 'learndash-topic-row-title-after', array( $this, 'learndash_topic_row_title_after' ), 10, 3 );

        if ( function_exists( 'learndash_is_active_theme' ) && learndash_is_active_theme( 'ld30' ) ) {
            add_action( 'wp_enqueue_scripts', array( $this, 'custom_style' ), 20 );
            $this->load_modal_html();
        }
    }

	/**
	 * Enqueue custom styles
	 */
	public function custom_style() {
        $suffix = !TALEMY_DEV_MODE ? '.min' : '';
        wp_register_style( 'talemy-learndash-style', TALEMY_THEME_URI . 'assets/css/learndash' . $suffix . '.css', false, TALEMY_THEME_VERSION );
        wp_enqueue_style( 'talemy-learndash-style' );
        wp_style_add_data( 'talemy-learndash-style', 'rtl', 'replace' );
    }

    /**
     * Wrapper function to include the modal login in the footer of the HTML.
     */
    public function load_modal_html() {
        global $learndash_login_model_html;
        $theme_settings = get_option( 'learndash_settings_theme_ld30' );
        if ( !empty( $theme_settings['login_mode_enabled'] ) && $theme_settings['login_mode_enabled'] === 'yes' ) {
            // Don't need to load the HTML if the user is already logged in.
            if ( ( ! is_user_logged_in() ) && ( function_exists( 'learndash_get_template_part' ) ) ) {
                if ( false === $learndash_login_model_html ) {
                    $learndash_login_model_html = learndash_get_template_part( 'modules/login-modal.php', array(), false );
                    if ( false !== $learndash_login_model_html ) {
                        add_action( 'wp_footer', function() {
                            global $learndash_login_model_html;
                            if ( ( isset( $learndash_login_model_html ) ) && ( ! empty( $learndash_login_model_html ) ) ) {
                                echo '<div class="learndash-wrapper learndash-wrapper-login-modal">' . $learndash_login_model_html . '</div>';
                            }
                        });
                    }
                }
            }
        }
    }

    /**
     * Modify search query
     * 
     * @param  object $query WP_Query
     */
    public function custom_query( $query ) {
        if ( is_admin() || !$query->is_main_query() ) {
            return;
        }

        if ( is_search() ) {

            if ( empty( $_GET['ld_course_price'] ) ) {
                return;
            }

            if ( 'free' == $_GET['ld_course_price'] ) {
                $query->set( 'meta_query', array(
                    'relation' => 'OR',
                    array(
                        'key' => '_sfwd-courses',
                        'value' => '"free";',
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => '_sfwd-courses',
                        'value' => '"open";',
                        'compare' => 'LIKE'
                    )
                ));
            } elseif ( 'paid' == $_GET['ld_course_price'] ) {
                $query->set( 'meta_query', array(
                    'relation' => 'OR',
                    array(
                        'key' => '_sfwd-courses',
                        'value' => '"paynow";',
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => '_sfwd-courses',
                        'value' => '"subscribe";',
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => '_sfwd-courses',
                        'value' => '"closed";',
                        'compare' => 'LIKE'
                    )
                ));
            }

        } else if ( is_author() ) {
            $query->set( 'post_type' , array( 'sfwd-courses' ) );
        }
    }
    
	/**
	 * Currency symbols
	 * 
	 * @param  string $currency  currency code such as USD, EUR
	 * @param  int    $course_id course ID
	 * @return string currency symbol
	 */
	public function currency_symbols( $currency, $course_id = null ) {
		static $currency_symbols = array(
			'USD' => '&#36;',
			'AUD' => '&#36;',
			'BRL' => '&#82;&#36;',
			'CAD' => '&#36;',
			'CHF' => '&#67;&#72;&#70;',
			'CNY' => '&#165;',
			'CZK' => '&#75;&#269;',
			'DKK' => '&#107;&#114;',
			'EUR' => '&#8364;',
			'GBP' => '&#163;',
			'HKD' => '&#36;',
			'HUF' => '&#70;&#116;',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'JPY' => '&#165;',
			'KRW' => '&#8361;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'NOK' => '&#107;&#114;',
			'NZD' => '&#36;',
			'PHP' => '&#8369;',
			'PLN' => '&#122;&#322;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'THB' => '&#3647;',
			'TWD' => '&#78;&#84;&#36;',
			'ZAR' => '&#82;',
		);
		return isset( $currency_symbols[ $currency ] ) ? $currency_symbols[ $currency ] : $currency;
    }
    
    /**
     * Add custom content before topic title
     *
     * @param integer $topic_id
     * @param integer $course_id
     * @param integer $user_id
     * @return void
     */
	public function learndash_topic_row_title_after( $topic_id, $course_id, $user_id ) {
		$topic_meta = get_post_meta( $topic_id, '_ld_custom_meta', true );
		$topic_icon = !empty( $topic_meta['content_type'] ) ? $topic_meta['content_type'] : '';
		$topic_icon = !empty( $topic_meta['custom_icon'] ) ? $topic_meta['custom_icon'] : $topic_icon;
		
		if ( ! empty( $topic_icon ) ) : ?>
			<span class="ld-item__type-icon"><i class="<?php echo esc_attr( $topic_icon ); ?>"></i></span>
		<?php endif; ?>
		<?php if ( ! empty( $topic_meta['duration'] ) ) : ?>
			<span class="ld-item__duration"><?php echo esc_html( $topic_meta['duration'] ); ?></span>
		<?php endif;
    }
}

if ( defined( 'LEARNDASH_VERSION' ) ) {
    new Talemy_LearnDash();
}
