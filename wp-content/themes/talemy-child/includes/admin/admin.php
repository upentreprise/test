<?php
/**
 * Admin
 *
 * @since   1.1.7
 * @package Talemy/Classes
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class Talemy_Admin {

    /**
	 * Hooks
	 */
	public function __construct() {
        if ( defined( 'SF_FRAMEWORK_VERSION' ) ) {
            new SF_Admin();
        }
        $this->includes();
        $this->hooks();
    }

    /**
     * Include files
     */
    public function includes() {
        require_once( TALEMY_THEME_DIR . 'includes/admin/block-editor.php' );
        require_once( TALEMY_THEME_DIR . 'includes/admin/config.php' );
        require_once( TALEMY_THEME_DIR . 'includes/admin/plugins.php' );
        require_once( TALEMY_THEME_DIR . 'includes/admin/metabox.php' );
    }

    /**
     * Include files
     */
    public function hooks() {
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ), 20 );

        // remove wp video popup ad admin notice
        if ( function_exists( 'wp_video_popup_pro_ad' ) ) {
            remove_action( 'admin_notices', 'wp_video_popup_pro_ad' );
        }
    }

    /**
     * Display admin notice if the required plugins are not active
     */
    public function admin_notices() {
        if ( isset( $_GET['page'] ) && $_GET['page'] == 'tgmpa-install-plugins' ) {
            return;
        }
    
        if ( !defined( 'SF_FRAMEWORK_VERSION' ) ) {
            $plugin_page_url = class_exists( 'TGM_Plugin_Activation' ) ? TGM_Plugin_Activation::$instance->get_tgmpa_url() : '';
            ?>
            <div class="notice notice-error is-dismissible" style="padding:5px 15px 10px;">
                <h3 style="margin-bottom: 10px;"><?php esc_html_e( 'Installation/Update Of Required Plugins Needed', 'talemy' ); ?></h3>
                <p><?php esc_html_e( 'The following required plugin is currently inactive: Spirit Framework.', 'talemy' ); ?></p>
                <p style="margin-top: 15px;"><a href="<?php echo esc_url( $plugin_page_url ); ?>" class="button-primary"><?php esc_html_e( 'Go Activate Plugin', 'talemy' ); ?></a></p>
            </div>
            <?php
        }

        if ( function_exists( 'sf_is_admin_notice_active' ) && !sf_is_admin_notice_active( 'sf-learndash-notice-forever' ) ) {
            return;
        }
    
        if ( !defined( 'LEARNDASH_VERSION' ) ) {
        ?>
        <div class="notice notice-warning is-dismissible" data-dismissible="sf-learndash-notice-forever">
            <p><?php
                printf(
                    __( 'This theme requires the <b><a href="https://learndash.com" target="_blank"><b>LearnDash LMS</b></a></b> plugin. %s', 'talemy' ), // WPCS: XSS ok.
                    '<a href="https://learndash.com" target="_blank"><b>'. esc_html__( 'Get It Here!', 'talemy' ) .'</b></a>'
                );
                ?>
            </p>
        </div>
        <?php
        }
    }

    /**
     * Enqueue admin styles & scripts
     */
    public function admin_scripts() {
        $current_screen = get_current_screen();

        wp_enqueue_style( 'ticon', TALEMY_THEME_URI . 'assets/css/ticon.css', array(), TALEMY_THEME_VERSION );
        
        if ( 'edit-category' == $current_screen->id || 'edit-post_tag' == $current_screen->id || 'edit-ld_course_category' == $current_screen->id || 'edit-ld_course_tag' == $current_screen->id ) {
            wp_enqueue_style( 'font-awesome-5-all' );
        }
    }
}

new Talemy_Admin();



