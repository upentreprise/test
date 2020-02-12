<?php 
/**
 * SF Admin
 * 
 */
defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Admin {

    /**
     * Constructor
     */
    function __construct() {
        $this->constants();
        $this->includes();
        $this->hooks();
    }

    /**
     * Constants
     */
    function constants() {
        if ( !defined( 'SF_ADMIN_DIR' ) ) {
            define( 'SF_ADMIN_DIR', SF_FRAMEWORK_DIR . 'includes/admin/' );
        }
        global $sf_global_settings;
        if ( !isset( $sf_global_settings ) ) {
            $sf_global_settings = get_option( 'sf_settings' );
        }
        $sf_global_settings = !empty( $sf_global_settings ) && is_array( $sf_global_settings ) ? $sf_global_settings : array();
    }

    /**
     * Include required files
     */
    function includes() {
        require_once SF_FRAMEWORK_DIR . 'includes/libs/meta-box/meta-box.php';
        require_once SF_FRAMEWORK_DIR . 'includes/libs/mb-term-meta/mb-term-meta.php';
        require_once SF_FRAMEWORK_DIR . 'includes/libs/meta-box-conditional-logic/meta-box-conditional-logic.php';
        require_once SF_FRAMEWORK_DIR . 'includes/libs/meta-box-tabs/meta-box-tabs.php';
        require_once SF_FRAMEWORK_DIR . 'includes/libs/pand.php';
        require_once SF_FRAMEWORK_DIR . 'includes/demo/class-sf-demo-manager.php';
        require_once SF_FRAMEWORK_DIR . 'includes/fonts/class-sf-fonts-manager.php';
        require_once SF_FRAMEWORK_DIR . 'includes/menu/class-sf-megamenu.php';
		require_once SF_FRAMEWORK_DIR . 'includes/class-sf-post-fields.php';
        require_once SF_FRAMEWORK_DIR . 'includes/class-sf-widget.php';
        require_once SF_FRAMEWORK_DIR . 'includes/class-sf-user-profile.php';
        require_once SF_FRAMEWORK_DIR . 'includes/envato/class-sf-product-registration.php';
        require_once SF_FRAMEWORK_DIR . 'includes/envato/class-sf-product-updater.php';
        require_once SF_ADMIN_DIR . 'settings/settings.php';
        require_once SF_ADMIN_DIR . 'settings/callbacks.php';
        require_once SF_ADMIN_DIR . 'settings/register-settings.php';
        require_once SF_ADMIN_DIR . 'settings/display-settings.php';
    }

    /**
     * Hooks
     */
    function hooks() {
        add_action( 'after_switch_theme', array( $this, 'plugin_default' ), 99 );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
        add_action( 'admin_bar_menu', array( $this, 'adminbar_support' ), 999 );
        add_action( 'admin_menu', array( $this, 'admin_menus' ) );
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
        add_action( 'admin_head', array( $this, 'admin_fonts' ) );
        add_action( 'customize_controls_print_scripts', array( $this, 'admin_fonts' ) );
        add_action( 'init', array( $this, 'mb_icon_type' ) );
    }

    /**
     * Admin menus
     */
    function admin_menus() {
        if ( current_user_can( 'edit_theme_options' ) ) {

            $admin_submenus = array(
                'welcome' => esc_html__( 'Welcome', 'spirit' ),
                'registration' => esc_html__( 'Registration', 'spirit' ),
                'demos' => esc_html__( 'Demos', 'spirit' ),
                'fonts' => esc_html__( 'Fonts', 'spirit' ),
                'status' => esc_html__( 'Status', 'spirit' )
            );

            // add top menu
            $theme_name = sf_get_parent_theme_name();
            add_menu_page( $theme_name, $theme_name, 'edit_theme_options', 'sf_welcome', function() {
                include_once SF_ADMIN_DIR . 'views/header.php';
                include_once SF_ADMIN_DIR . 'views/welcome.php';
                include_once SF_ADMIN_DIR . 'views/footer.php';
            }, null, 2 );

            // add sub menus
            foreach ( $admin_submenus as $menu_slug => $menu_label ) {
                add_submenu_page( 'sf_welcome', $menu_label, $menu_label, 'edit_theme_options', 'sf_' . $menu_slug, function() use ( $menu_slug ) {
                    include_once SF_ADMIN_DIR . 'views/header.php';
                    include_once SF_ADMIN_DIR . 'views/' . $menu_slug . '.php';
                    include_once SF_ADMIN_DIR . 'views/footer.php';
                });
            }

            // add settings
            add_submenu_page( 'sf_welcome', __( 'Settings', 'spirit' ), __( 'Settings', 'spirit' ), 'edit_theme_options', 'sf_settings', 'sf_settings_page' );
        }
    }

    /**
     * Add to admin bar
     * @param  object $wp_admin_bar wp admin bar
     */
    function adminbar_support( $wp_admin_bar ) {
        $wp_admin_bar->add_node(
            array(
                'id'    => 'theme-spirit',
                'title' => 'Theme Support',
                'href'  => 'https://themespirit.com/support',
                'meta' => array( 'target' => '_blank' )
        ));
    }

    /**
     * Show admin notices
     */
    function admin_notices() {
        settings_errors( 'sf-notices' );
    }

    /**
     * Enqueue admin scripts
     */
    function admin_scripts() {
    	$suffix = defined( 'SF_SCRIPT_DEBUG' ) && SF_SCRIPT_DEBUG ? '' : '.min';

    	// enqueue styles
        wp_register_style( 'font-awesome-5-all', SF_FRAMEWORK_URI . 'assets/lib/font-awesome/css/all.min.css', [], '5.10.1' );
        wp_enqueue_style( 'selectize', SF_FRAMEWORK_URI . 'assets/lib/selectize/css/selectize' . $suffix . '.css' );
        wp_enqueue_style( 'sf-admin', SF_FRAMEWORK_URI . 'assets/css/admin' . $suffix . '.css', false, SF_FRAMEWORK_VERSION );
        wp_style_add_data( 'sf-admin', 'rtl', 'replace' );

        // register admin scripts
        wp_register_script( 'selectize', SF_FRAMEWORK_URI . 'assets/lib/selectize/js/selectize.min.js', array( 'jquery' ), SF_FRAMEWORK_VERSION, true );
        
        wp_register_script( 'jquery-tiptip', SF_FRAMEWORK_URI . 'assets/lib/tiptip/jquery.tipTip.min.js', array( 'jquery' ), SF_FRAMEWORK_VERSION, true );
        
        wp_register_script( 'fonticonpicker', SF_FRAMEWORK_URI . 'assets/lib/fonticonpicker/js/jquery.fonticonpicker.min.js', array( 'jquery' ), SF_FRAMEWORK_VERSION, true );
        
        wp_register_script( 'bootstrap-modal', SF_FRAMEWORK_URI . 'assets/lib/bootstrap/bootstrap.modal' . $suffix . '.js', array( 'jquery' ), SF_FRAMEWORK_VERSION, true );

        wp_register_script( 'sf-fonts', SF_FRAMEWORK_URI . 'assets/js/admin/fonts' . $suffix . '.js', array( 'jquery' ), SF_FRAMEWORK_VERSION, true );
        
        wp_register_script( 'sf-system-status', SF_FRAMEWORK_URI . 'assets/js/admin/system-status' . $suffix . '.js', array( 'jquery', 'jquery-tiptip' ), SF_FRAMEWORK_VERSION, true );
        
        wp_register_script( 'sf-megamenu', SF_FRAMEWORK_URI . 'assets/js/admin/megamenu' . $suffix . '.js', array( 'jquery', 'bootstrap-modal', 'fonticonpicker' ), SF_FRAMEWORK_VERSION, true );
        
        wp_register_script( 'sf-admin', SF_FRAMEWORK_URI . 'assets/js/admin/admin' . $suffix . '.js', array( 'jquery', 'imagesloaded', 'jquery-tiptip', 'fonticonpicker' ), SF_FRAMEWORK_VERSION, true );

        // enqueue scripts
        wp_enqueue_script( 'imagesloaded' );
        wp_enqueue_script( 'selectize' );
        wp_enqueue_script( 'sf-admin' );
        wp_localize_script( 'sf-admin', 'SF_L10n', $this->l10n() );

        $current_page = isset( $_GET['page'] ) ? $_GET['page'] : '';
        $current_screen = get_current_screen();
		
        if ( $current_page === 'sf_demos' ) {
            wp_enqueue_script( 'bootstrap-modal' );
        }

        if ( $current_page === 'sf_fonts' ) {
			wp_enqueue_script( 'sf-fonts' );
		}

		if ( $current_page === 'sf_status' ) {
			wp_enqueue_script( 'sf-system-status' );
		}

        if ( $current_screen->id === 'nav-menus' ) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker-alpha', SF_FRAMEWORK_URI . 'assets/lib/colorpicker/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), SF_FRAMEWORK_VERSION, true );
            wp_enqueue_media();
            wp_enqueue_style( 'font-awesome-5-all' );
            wp_enqueue_script( 'sf-megamenu' );
        }

        if ( $current_screen->id === 'widgets' ) {
            wp_enqueue_style( 'font-awesome-5-all' );
        }
    }

	/**
	 * Returns translation strings.
     * 
	 * @return array
	 */
	function l10n() {
		return array(
			'remove_sidebar'=> __( 'Are you sure to remove this sidebar?', 'spirit' ),
            'install_required_plugins' => __( 'Please install all the required plugins.', 'spirit' ),
            'install_demo' => __( "Demo Installation\n\nThis will replicate the live demo, which include all the demo content and theme settings being selected. Your current theme settings will be overwritten. Installation could take a minute or less to complete.\n\nDo you want to proceed?", 'spirit' ),
            'uninstall_demo' => __( "All demo content and settings will be deleted. Contents created prior to demo installation will not be touched.\n\nDo you want to procceed?", 'spirit' ),
			'user_confirmation' => __( 'Are you sure?', 'spirit' ),
			'user_approve' => __( 'Approve now', 'spirit' ),
			'user_remove_approval' => __( 'Remove Approval', 'spirit' ),
			'user_updating' => __( 'Updating user', 'spirit' ),
        );
	}

    /**
     * Fonts
     */
    function admin_fonts() {
        ?>
        <script type="text/javascript">
            var SF_Fonts = <?php echo json_encode( sf_get_font_icons() ); ?>
        </script><?php
    }

    /**
     * Metabox Icon field
     */
    function mb_icon_type() {
        require SF_FRAMEWORK_DIR .'includes/fields/icon.php';
    }

    /**
     * Add default
     */
    function plugin_default() {
        if ( false == get_option( 'sf_settings' ) ) {
            update_option( 'sf_settings', array( 'enable_custom_sidebars' => 1, 'enable_login_registration' => 1 ) );
        }

        // install default fonts
        SF_Fonts::add_default_fonts();
    }
}
