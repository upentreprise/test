<?php
/**
 * SF Login
 *
 * Login, Register, Lost Password, Email Verification
 *
 * @package  Spirit_Framework
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Login {
	
	/**
	 * Static property to hold our singleton instance
	 */
	protected static $_instance = null;

	/**
	 * Main instance
	 * Ensures only one instance of this class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @return SF_Login - Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

    /**
     * Constructor
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

        add_action( 'wp_ajax_nopriv_sf_ajax_login', array( $this, 'login' ) );
        add_action( 'wp_ajax_nopriv_sf_ajax_register', array( $this, 'register' ) );
        add_action( 'wp_ajax_nopriv_sf_ajax_lost_password', array( $this, 'lost_password' ) );
        add_action( 'wp_ajax_nopriv_sf_ajax_resend_link', array( $this, 'resend_link' ) );
        add_filter( 'authenticate', array( $this, 'check_email_verification' ), 100, 2 );
        add_action( 'init', array( $this, 'verification_auto_login' ) );
        add_action( 'wp_footer', array( $this, 'print_login_modal' ), 100 );
        
        add_shortcode( 'sf_login_box', array( $this, 'print_login_box' ) );
        add_shortcode( 'sf_login', array( $this, 'print_login_form' ) );
        add_shortcode( 'sf_register', array( $this, 'print_register_form' ) );
        add_shortcode( 'sf_email_verification', array( $this, 'print_email_verification' ) );
        
        add_filter( 'manage_users_columns', array( $this, 'add_manage_users_columns' ) );
        add_filter( 'manage_users_custom_column', array( $this, 'add_manage_users_custom_column' ), 10, 3 );
        add_action( 'wp_ajax_sf_ajax_approve_user', array( $this, 'approve_user' ) );
        add_filter( 'bulk_actions-users', array( $this, 'bulk_approve' ) );
        add_filter( 'handle_bulk_actions-users', array( $this, 'bulk_approve_handler' ), 10, 3 );
        add_filter( 'removable_query_args', array( $this, 'bulk_action_removable_query_args' ) );
        add_action( 'admin_notices', array( $this, 'bulk_action_admin_notice' ) );
    }

    /**
     * Enqueue scripts
     */
    function frontend_scripts() {
        $suffix = defined( 'SF_SCRIPT_DEBUG' ) && SF_SCRIPT_DEBUG ? '' : '.min';
        
        wp_enqueue_style( 'sf-login', SF_FRAMEWORK_URI .'assets/css/login.min.css', false, SF_FRAMEWORK_VERSION );
        wp_style_add_data( 'sf-login', 'rtl', 'replace' );

        wp_register_script( 'sf-login', SF_FRAMEWORK_URI .'assets/js/frontend/login' . $suffix . '.js', array( 'jquery', 'jquery-throttle-debounce' ), SF_FRAMEWORK_VERSION, true );
        wp_enqueue_script( 'sf-login' );

        wp_localize_script( 'sf-login', 'sf_login_data', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'required_fields' => __( 'Please fill in all required fields.', 'spirit' ),
        ) );
    }

    /**
     * Custom column title
     * @param array $columns columns data
     */
    function add_manage_users_columns( $columns ) {
        return array_merge( $columns, array( 'sf_status' => __( 'User Status', 'spirit' ) ) );
    }
    
    /**
     * Custom column content
     * @param string $output
     * @param string $column_name
     * @param int $user_id
     */
    function add_manage_users_custom_column( $output, $column_name, $user_id ) {
        ob_start();

        if ( $column_name == 'sf_status' ) {
            $activation_status = get_user_meta( $user_id, 'sf_activation_status' );

            if ( isset( $activation_status[0] ) && count( $activation_status ) == 1 ) :
            ?>
            <div class="sf_status">
                <?php echo ( $activation_status[0] == 1 ? esc_html__( 'Verified', 'spirit' ) : esc_html__( 'Pending Verification', 'spirit' ) ); ?>
            </div>
            <div class="row-actions">
                <?php if ( $activation_status[0] == 0 ) : ?>
                    <span class="sf_action sf_approve" user_id="<?php echo esc_attr( $user_id ); ?>" do="approve"><?php esc_html_e( 'Approve now', 'spirit' ); ?></span>
                <?php elseif ( $activation_status[0] == 1 ) : ?>
                    <span class="sf_action sf_remove_approval" user_id="<?php echo esc_attr( $user_id ); ?>" do="remove_approval"><?php esc_html_e( 'Remove approval', 'spirit' ); ?></span>
                <?php endif; ?>
            </div>
            <?php
            endif;
        }
        
        return ob_get_clean();
    }

    /**
     * Approve user
     *
     * @return void
     */
    function approve_user() {
        $user_id = isset( $_POST['user_id'] ) ? $_POST['user_id'] : '';
        $action = isset( $_POST['do'] ) ? $_POST['do'] : '';
        
        if ( empty( $user_id ) || empty( $action ) ) {
            wp_die();
        }

        if ( $action == 'approve' ) {
            update_user_meta( $user_id, 'sf_activation_status', 1 );
        }

        if ( $action == 'remove_approval' ) {
            update_user_meta( $user_id, 'sf_activation_status', 0 );
        }
        
        $activation_status = get_user_meta( $user_id, 'sf_activation_status', true );
        $activation_status = empty( $activation_status ) ? 0 : $activation_status;
        $user_staus = $activation_status == 1 ? esc_html__( 'Verified', 'spirit' ) : esc_html__( 'Pending Verification', 'spirit' );
        echo $user_staus;

        wp_die();
    }

    function bulk_approve( $actions ) {
        $actions['sf_bulk_approve'] = __( 'Approve', 'spirit' );
        $actions['sf_bulk_remove_approval'] = __( 'Remove Approval', 'spirit' );
        return $actions;
    }
    
    /**
     * Bulk approve handler
     *
     * @param string $redirect_to
     * @param string $action
     * @param array $items
     * @return $redirect_to
     */
    function bulk_approve_handler( $redirect_to, $action, $items ) {
        if ( $action == 'sf_bulk_approve' ) {
            $user_status = 1;
            $redirect_to = add_query_arg( 'sf_bulk_approve', count( $items ), $redirect_to );
        } elseif ( $action =='sf_bulk_remove_approval' ) {
            $user_status = 0;
            $redirect_to = add_query_arg( 'sf_bulk_remove_approval', count( $items ), $redirect_to );
        } else {
            return $redirect_to;
        }

        foreach ( $items as $user_id ) {
            $activation_status = get_user_meta( $user_id, 'sf_activation_status' );
            if ( isset( $activation_status[0] ) ) {
                update_user_meta( $user_id, 'sf_activation_status', $user_status );
            }
        }
        return $redirect_to;
    }
    
    /**
     * Bulk action removable query args
     *
     * @param array $args
     * @return $args
     */
    function bulk_action_removable_query_args( $args ) {
        $args[] = 'sf_bulk_approve';
        $args[] = 'sf_bulk_remove_approval';
        return $args;
    }

    /**
     * Bulk action admin notice
     *
     * @return void
     */
    function bulk_action_admin_notice() {
        if ( isset( $_REQUEST['sf_bulk_approve'] ) ) {
            $user_count = intval( $_REQUEST['sf_bulk_approve'] );

            echo '<div id="message" class="notice notice-success is-dismissible">';
            echo '<p>'. sprintf( _n( '%s user account marked as approved.', '%s user accounts marked as approved.', $user_count, 'spirit' ), number_format_i18n( $user_count ) ) . '</p>';
            echo '</div>';
    
        } elseif ( isset( $_REQUEST['sf_bulk_remove_approval'] ) ) {
            $user_count = intval( $_REQUEST['sf_bulk_remove_approval'] );

            echo '<div id="message" class="notice notice-success is-dismissible">';
            echo '<p>'. sprintf( _n( '%s user account marked as unverified.', '%s user accounts marked as unverified.', $user_count, 'spirit' ), number_format_i18n( $user_count ) ) . '</p>';
            echo '</div>';
        }
    }

    /**
     * Process login
     */
    function login() {
        if ( empty( $_POST['security'] ) || !wp_verify_nonce( $_POST['security'], 'sf_login_nonce' ) ) {
            wp_send_json_error( array( 'message'=>'<span class="error">' . __( 'Token is invalid or expired. Please refresh and try again.', 'spirit' ) . '</span>' ) );
        }
        
        $username = isset( $_POST['username'] ) ? sanitize_user( $_POST['username'] ) : '';
        $password = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';
        $remember = !empty( $_POST['remember'] ) ? true : false;
        $messages = sf_get_login_form_messages();
        $error = '';

        $signon = wp_signon( array(
            'user_login' => $username,
            'user_password' => $password,
            'remember' => $remember
        ), false );

        if ( is_wp_error( $signon ) ) {
            switch ( $signon->get_error_code() ) {
                case 'invalid_username': $error = $messages['invalid_username']; break;
                case 'incorrect_password': $error = $messages['incorrect_password']; break;
                case 'email_not_verified': $error = $signon->get_error_message(); break;
            }
        } elseif ( empty( $_COOKIE[ LOGGED_IN_COOKIE ] ) ) {
            if ( headers_sent() ) {
                /* translators: 1: Browser cookie documentation URL, 2: Support forums URL */
                $error = sprintf( __( '<strong>ERROR</strong>: Cookies are blocked due to unexpected output. For help, please see <a href="%1$s" target="_blank">this documentation</a> or try the <a href="%2$s">support forums</a>.', 'spirit' ),
                    __( 'https://codex.wordpress.org/Cookies', 'spirit' ), __( 'https://wordpress.org/support/', 'spirit' ) );
            }
        }

        if ( ! empty( $error ) ) {
            wp_send_json_error( array( 'message'=>'<span class="error">' . $error . '</span>' ) );
        }

        if ( $signon && ! is_wp_error( $signon ) ) {
            // wp_set_current_user( $user->ID, $username );

            $redirect_url = get_the_permalink( SF()->get_setting( 'login_redirect_page' ) );
            $redirect_url = apply_filters( 'sf_login_redirect_page', $redirect_url );

            wp_send_json_success( array(
                'refresh' => true,
                'message' => '<span class="success">' . $messages['success'] . '</span>',
                'redirect_url' => esc_url( $redirect_url )
            ) );
        }

        exit();
    }

    /**
     * Process account registration
     */
    function register() {
        if ( empty( $_POST['security'] ) || !wp_verify_nonce( $_POST['security'], 'sf_register_nonce' ) ) {
            wp_send_json_error( array( 'message'=>'<span class="error">' . __( 'Token is invalid or expired. Please refresh and try again.', 'spirit' ) . '</span>' ) );
        }

        $username   = isset( $_POST['username'] ) ? sanitize_user( $_POST['username'] ) : '';
        $email      = isset( $_POST['email'] ) ? $_POST['email'] : '';
        $password   = !empty( $_POST['password'] ) ? $_POST['password'] : '';
        $first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( $_POST['first_name'] ) : '';
        $last_name  = isset( $_POST['last_name'] ) ? sanitize_text_field( $_POST['last_name'] ) : '';
        $messages   = sf_get_new_account_form_messages();
        $errors     = $error_fields = array();
        $success    = '';
        $signon     = false;

        if ( get_option( 'users_can_register' ) ) {
            $generate_username = SF()->get_setting( 'new_account_generate_username' );
            $generate_password = SF()->get_setting( 'new_account_generate_password' );
            $first_last_name   = SF()->get_setting( 'new_account_first_last_name' );
            $verify_email      = SF()->get_setting( 'new_account_verify_email' );
            
            // Check empty fields by html & javascript
            // if ( empty( $email )
            //     || ( !$generate_username && empty( $username ) )
            //     || ( !$generate_password && empty( $password ) )
            //     || ( $first_last_name && ( empty( $first_name ) || empty( $last_name ) ) )
            // ) {
            //     $error = $messages['required'];
            // }
            
            // Check username
            if ( !$generate_username ) {
                if ( username_exists( $username ) ) {
                    $errors[] = $messages['username_exists'];
                    $error_fields[] = '.sf-username';
                } elseif ( !validate_username( $username ) ) {
                    $errors[] = $messages['invalid_username'];
                    $error_fields[] = '.sf-username';
                }
            }

            // Check email
            if ( is_email( $email ) ) {
                if ( email_exists( $email ) ) {
                    $errors[] = $messages['existing_user_email'];
                    $error_fields[] = '.sf-email';
                }
            } else {
                $errors[] = $messages['invalid_email'];
                $error_fields[] = '.sf-email';
            }

            $errors = apply_filters( 'sf_user_registration_errors', $errors, array(
                'username' => $username,
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'error_fields' => $error_fields
            ));

            if ( isset( $errors['error_fields'] ) ) {
                $error_fields = $errors['error_fields'];
                unset( $errors['error_fields'] );
            }

            // Create user if no errors
            if ( empty( $errors ) ) {

                // Generate unique username from email address
                if ( $generate_username ) {
                    $username   = sanitize_user( current( explode( '@', $email ) ), true );
                    $o_username = $username;
                    $append     = 1;

                    while ( username_exists( $username ) ) {
                        $username = $o_username . $append;
                        $append ++;
                    }
                }

                // Generate random password
                if ( $generate_password ) {
                    $password = wp_generate_password( 12, false );
                }

                // User data
                $new_user_data = apply_filters(
                    'sf_new_user_data', array(
                        'user_login' => $username,
                        'user_pass'  => $password,
                        'user_email' => $email,
                        'first_name' => $first_name,
                        'last_name'  => $last_name
                    )
                );

                $user_id = wp_insert_user( $new_user_data );

                if ( is_wp_error( $user_id ) ) {
                    $errors[] = $user_id->get_error_message();
                } else {

                    // User verification
                    if ( $verify_email ) {
                        $activation_key = MD5( $email . uniqid( time(), true ) );
                        add_user_meta( $user_id, 'sf_activation_key', $activation_key );
                        add_user_meta( $user->ID, 'sf_activation_status', 0 );
                        $activation_link = sf_get_email_verification_link( $user_id, $activation_key );
                    } else {
                        // auto login user
                        if ( ! SF()->get_setting( 'new_account_auto_login' ) ) {
                            $signon = wp_signon( array(
                                'user_login' => $username,
                                'user_password' => $password,
                                'remember' => true
                            ), false );
                        }
                    }

                    do_action( 'sf_user_registeration', $user_id, $new_user_data, $generate_password );

                    $mail = new SF_Email();
                    
                    if ( !empty( $activation_link ) ) {
                        if ( $mail->send_activate_account_mail( $user_id, $new_user_data, $activation_link ) ) {
                            $success = $messages['success_verify_email'] . '<div class="text-center"><button type="button" class="btn btn-outline-dark sf-resend-link" data-nonce="'. wp_create_nonce( 'sf_resend_link_nonce' ) .'" data-user="'. $username .'">'. __( 'Re-send Verfication Email', 'spirit' ) .'</button></div>';
                        } else {
                            $errors[] = $messages['send_mail_error'];
                        }
                    } else {
                        if ( $mail->send_new_account_mail( $user_id, $new_user_data, $generate_password ) ) {
                            $success = $messages['success'];
                        } else {
                            $errors[] = $messages['send_mail_error'];
                        }
                    }
                }
            }

        } else {
            $errors[] = $messages['no_registration'];
        }

        if ( !empty( $errors ) ) {
            wp_send_json_error( array(
                'message' => '<span class="error">' . implode( '<br/>', $errors ) . '</span>',
                'fields'  => $error_fields
            ) );
        }
        
        if ( !empty( $success ) ) {
            wp_send_json_success( array(
                'delayed_refresh' => ( $signon && !is_wp_error( $signon ) ? true : false ), 
                'message'=>'<span class="success">' . $success . '</span>'
            ) );
        }

        exit();
    }

    /**
     * Process lost password
     */
    function lost_password() {
        if ( empty( $_POST['security'] ) || !wp_verify_nonce( $_POST['security'], 'sf_lost_password_nonce' ) ) {
            wp_send_json_error( array( 'message'=>'<span class="error">' . __( 'Token is invalid or expired. Please refresh and try again.', 'spirit' ) . '</span>' ) );
        }
        
        $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : '';
        $messages = sf_get_lost_password_form_messages();
        $error = $success = '';

        // if ( empty( $user_login ) ) {
        //     $error = $messages['username_email_empty'];
        // }

        if ( is_email( $user_login ) && email_exists( $user_login ) ) {
            $user = get_user_by( 'email', $user_login );

        } elseif ( validate_username( $user_login ) && username_exists( $user_login ) ) {
            $user = get_user_by( 'login', $user_login );
        }
            
        if ( $user && ! is_wp_error( $user ) ) {

            // Fires before errors are returned from a password reset request.
            do_action( 'lostpassword_post' );
            
            // Fires before a new password is retrieved.
            do_action( 'retrieve_password', $user->user_login );

            $allow = true;
            if ( is_multisite() && is_user_spammy( $user ) ) {
                $allow = false;
            }

            // Filters whether to allow a password to be reset.
            $allow = apply_filters( 'allow_password_reset', $allow, $user->ID );

            if ( $allow && ! is_wp_error( $allow ) ) {

                // Generate something random for a password reset key.
                $reset_key = wp_generate_password( 20, false );
                
                // Fires when a password reset key is generated.
                do_action( 'retrieve_password_key', $user->user_login, $reset_key );

                global $wpdb, $wp_hasher;
                // Now insert the key, hashed, into the DB.
                if ( empty( $wp_hasher ) ) {
                    require_once ABSPATH . 'wp-includes/class-phpass.php';
                    $wp_hasher = new PasswordHash( 8, true );
                }
                
                $hashed = time() . ':' . $wp_hasher->HashPassword( $reset_key );
                $wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user->user_login ) );

                // Reset url
                $reset_pass_url = apply_filters( 'sf_reset_password_url', network_site_url( "wp-login.php?action=rp&key=$reset_key&login=" . rawurlencode( $user->user_login ), 'login' ) );

                // Send mail
                $mail = new SF_Email();

                if ( $mail->send_reset_password_mail( $user->ID, $user->user_login, $user->user_email, $reset_pass_url ) ) {
                    $success = $messages['success'];
                } else {
                    $error = $messages['send_mail_error'];
                }
            
            } else {
                $error = $messages['no_password_reset'];
            }
        
        } else {
            $error = $messages['user_not_registered'];
        }  
        
        if ( ! empty( $error ) ) {
            wp_send_json_error( array( 'message'=>'<span class="error">' . $error . '</span>' ) );
        }
        
        if ( ! empty( $success ) ) {
            wp_send_json_success( array( 'message'=>'<span class="success">' . $success . '</span>' ) );
        }

        exit();
    }

    function check_email_verification( $user, $username ) {
        if ( is_wp_error( $user ) ) {
            return $user;
        }

        $activation_status = get_user_meta( $user->ID, 'sf_activation_status' );

        if ( isset( $activation_status[0] ) && count( $activation_status ) == 1 && $activation_status[0] == 0 ) {
            return new WP_Error( 'email_not_verified', sprintf(
                __( 'You have not verified your email address, please check your email and click on verification link we sent you. <a href="javascript:void(0)" data-user="%s">Re-send the link</a>', 'spirit' ),
                $username
            ));
        }

        return $user;
    }

    /**
     * Process resend verification email
     */
    function resend_link() {
        if ( empty( $_POST['security'] ) || !wp_verify_nonce( $_POST['security'], 'sf_resend_link_nonce' ) ) {
            wp_send_json_error( array( 'message'=>'<span class="error">' . __( 'Token is invalid or expired. Please refresh and try again.', 'spirit' ) . '</span>' ) );
        }

        $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : '';
        $user = get_user_by( 'login', $user_login );
        
        if ( $user ) {
            $activation_key = MD5( $email . uniqid( time(), true ) );
            update_user_meta( $user->ID, 'sf_activation_key', $activation_key );
            $activation_link = sf_get_email_verification_link( $user->ID, $activation_key );
            $new_user_data = array(
                'user_login' => $username,
                'user_email' => $user->user_email,
                'first_name' => $user->first_name,
                'last_name'  => $user->last_name
            );
        }

        if ( !empty( $activation_link ) ) {
            $mail = new SF_Email();
            
            if ( $mail->send_activate_account_mail( $user_id, $new_user_data, $activation_link ) ) {
                wp_send_json_success();
            } else {
                wp_send_json_error();
            }
        }

        wp_die();
    }

    function print_login_modal() {
        ?>
        <div class="sf-login-overlay">
            <div class="sf-login-modal">
                <?php sf_get_template( 'account/login-box.php' ); ?>
                <button class="sf-modal-close"><span class="sf-icon-close"></span></button>
            </div>
        </div>
        <?php
    }

    function print_login_box( $atts ) {
        return sf_get_template_html( 'account/login-box.php', $atts );
    }

    function print_login_form( $atts ) {
        return sf_get_template_html( 'account/form-login.php', $atts );
    }

    function print_register_form( $atts ) {
        return sf_get_template_html( 'account/form-register.php', $atts );
    }

    function print_lost_password_form( $atts ) {
        return sf_get_template_html( 'account/form-lost-password.php', $atts );
    }

    function print_email_verification( $atts ) {
        $html = '';
        $status_code = '';

        if ( !is_page( SF()->get_setting( 'verification_page' ) ) || !SF()->get_setting( 'new_account_verify_email' ) || empty( $_GET['activation_key'] ) ) {
            $status_code = 'invalid';
        }

        $users = get_users( array( 'meta_value' => $_GET['activation_key'] ) );
        $user_id = isset( $users[0]->ID ) ? $users[0]->ID : '';
        
        if ( '' == $user_id ) {
            $status_code = 'invalid';
        } else {
            $activation_key = get_user_meta( $user_id, 'sf_activation_key', true );
            $activation_status = get_user_meta( $user_id, 'sf_activation_status', true );

            if ( $activation_status != 0 ) {
                $status_code = 'verified';
            } elseif ( !empty( $activation_key ) && $activation_key == $_GET['activation_key'] ) {
                $status_code = 'verified';
                update_user_meta( $user_id, 'sf_activation_status', 1 );
                $redirect_page_url = get_permalink( SF()->get_setting( 'verification_redirect_page' ) );

                $generate_password = SF()->get_setting( 'new_account_generate_password' );
                if ( $generate_password ) {
                    // set new password
                    $password = wp_generate_password( 12, false );
                    wp_set_password( $password, $user_id );
                } else {
                    $password = '';
                }
                
                $mail = new SF_Email();
                $mail->send_new_account_mail(
                    $user_id,
                    array(
                        'user_login' => $users[0]->user_login,
                        'user_pass'  => $password,
                        'user_email' => $users[0]->user_email,
                        'first_name' => $users[0]->first_name,
                        'last_name'  => $users[0]->last_name
                    ),
                    $generate_password
                );
                
                if ( SF()->get_setting( 'verification_auto_login' ) ) {
                    wp_set_current_user( $user_id, $users[0]->user_login );
                    
                    // add auto login query args
                    if ( !empty( $redirect_page_url ) ) {
                        $redirect_page_url = add_query_arg( array( 'sf_autologin' => 'yes', 'key' => $activation_key ), $redirect_page_url );
                    }
                }

                if ( !empty( $redirect_page_url ) ) {
                    $status_code = 'verified_and_redirect';
                    $html .= '<script>jQuery(document).ready(function(){setTimeout(function(){window.location.href = "'. $redirect_page_url .'";}, 3000);})</script>';
                }

            } else {
                $status_code = 'unverified';
            }
        }

        switch ( $status_code ) {
            case 'invalid': $html .= esc_html__( 'Invalid request', 'spirit' ); break;
            case 'verified': $html .= esc_html__( 'Your email has been verified.', 'spirit' ); break;
            case 'verified_and_redirect': $html .= esc_html__( 'Your email has been verified. Redirecting in 3 seconds..', 'spirit' ); break;
            default: $html .= esc_html__( 'Sorry we could not verify your email address.', 'spirit' ); break;
        }

        return $html;
    }

    /**
     * Auto login user after verification
     */
    function verification_auto_login() {
        if ( isset( $_GET['sf_autologin'] ) && $_GET['sf_autologin']=='yes' && isset( $_GET['key'] ) ) {
            $activation_key = $_GET['key'];
            $users = get_users( array( 'meta_value' => $_GET['key'] ) );
            $user_id = isset( $users[0]->ID ) ? $users[0]->ID : '';
            
            if ( '' !== $user_id ) {
                $activation_status = get_user_meta( $user_id, 'sf_activation_status', true );
                if ( $activation_status != 0 ) {
                    wp_set_auth_cookie( $user_id );
                    do_action( 'wp_login', $users[0]->user_login );
                    wp_set_current_user( $user_id, $users[0]->user_login );
                }
            }
        }
    }
}

/**
 * Login form messages
 * @return array translatable messages
 */
function sf_get_login_form_messages() {
    return apply_filters( 'sf_login_form_messages', array(
        'success' => __( 'Login successful, redirecting..', 'spirit' ),
        'invalid_username' => __( '<strong>ERROR</strong>: Invalid username.', 'spirit' ) .
                ' <a class="sf-lost-password" href="' . wp_lostpassword_url() . '">' .
                __( 'Lost your password?', 'spirit' ) .
                '</a>',
        'incorrect_password' => __( '<strong>ERROR</strong>: Incorrect password.', 'spirit' ) .
            ' <a class="sf-lost-password" href="' . wp_lostpassword_url() . '">' .
            __( 'Lost your password?', 'spirit' ) .
            '</a>'
    ) );
}

/**
 * New account form messages
 * @return array translatable messages
 */
function sf_get_new_account_form_messages() {
    return apply_filters( 'sf_new_account_form_messages', array(
        'success' => __( 'Registration complete. Please check your email.', 'spirit' ),
        'success_verify_email' => __( 'Registration complete. Please verify your email address.', 'spirit' ),
        'no_registration' => __( 'User registration is currently not allowed.', 'spirit' ),
        'username_exists' => __( 'Sorry, that username already exists! ', 'spirit' ),
        'invalid_username' => __( 'Please enter a valid username.', 'spirit' ),
        'existing_user_email' => __( 'That email is already registered, please choose another one.', 'spirit' ),
        'invalid_email' => __( 'Please enter a valid email address.', 'spirit' ),
        'send_mail_error' => __( 'Registration complete. System is unable to send you an email.', 'spirit' ),
    ) );
}

/**
 * Lost password form messages
 * @return array translatable messages
 */
function sf_get_lost_password_form_messages() {
    return apply_filters( 'sf_lost_password_form_messages', array(
        'success' => __( 'Link for password reset has been emailed to you. Please check your email.', 'spirit' ),
        'no_password_reset' => __( 'Password reset is not allowed for this user.', 'spirit' ),
        'user_not_registered' => __( 'There is no user registered with that email.', 'spirit' ),
        'send_mail_error' => __( 'System is unable to send you an email for password reset.', 'spirit' ),
    ) );
}

if ( !function_exists( 'sf_get_new_account_agreement_text' ) ) {
    /**
     * Get new account agreement text
     */
    function sf_get_new_account_agreement_text() {
        $text            = SF()->get_setting( 'new_account_agreement_text' );
        $terms_page_id   = SF()->get_setting( 'terms_page_id' );
        $privacy_page_id = SF()->get_setting( 'privacy_page_id' );
        $terms_link      = sf_get_post_title_link( $terms_page_id, array( 'class' => 'sf-agreement-link', 'target' => '_blank' ) );
        $privacy_link    = sf_get_post_title_link( $privacy_page_id, array( 'class' => 'sf-agreement-link', 'target' => '_blank' ) );
        
        $find_replace = array(
            '[terms]'          => $terms_link,
            '[privacy_policy]' => $privacy_link,
        );

        return str_replace( array_keys( $find_replace ), array_values( $find_replace ), $text );
    }
}

if ( !function_exists( 'sf_get_email_verification_link' ) ) {
    /**
     * Get email verification link
     * @param  int    $user_id user id
     * @param  string $key     activation key
     * @return string          activation link
     */
    function sf_get_email_verification_link( $user_id, $key = '' ) {
        $link = '';
        
        if ( empty( $key ) ) {
            $key = get_user_meta( $user_id, 'sf_activation_key', true );
        }

        if ( !empty( $key ) ) {
            $verification_page = get_permalink( SF()->get_setting( 'verification_page' ) );
            
            if ( !empty( $verification_page ) ) {
                $link = add_query_arg( array( 'activation_key' => $key ), $verification_page );
            }
        }

        return $link;
    }
}