<?php 
/**
 * SF Email
 *
 * @package  Spirit_Framework
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Email {

    /**
     *  List of preg* regular expression patterns to search for,
     *  used in conjunction with $plain_replace.
     *  https://raw.github.com/ushahidi/wp-silcc/master/class.html2text.inc
     *
     *  @var array $plain_search
     *  @see $plain_replace
     */
    public $plain_search = array(
        "/\r/",                                                  // Non-legal carriage return.
        '/&(nbsp|#0*160);/i',                                    // Non-breaking space.
        '/&(quot|rdquo|ldquo|#0*8220|#0*8221|#0*147|#0*148);/i', // Double quotes.
        '/&(apos|rsquo|lsquo|#0*8216|#0*8217);/i',               // Single quotes.
        '/&gt;/i',                                               // Greater-than.
        '/&lt;/i',                                               // Less-than.
        '/&#0*38;/i',                                            // Ampersand.
        '/&amp;/i',                                              // Ampersand.
        '/&(copy|#0*169);/i',                                    // Copyright.
        '/&(trade|#0*8482|#0*153);/i',                           // Trademark.
        '/&(reg|#0*174);/i',                                     // Registered.
        '/&(mdash|#0*151|#0*8212);/i',                           // mdash.
        '/&(ndash|minus|#0*8211|#0*8722);/i',                    // ndash.
        '/&(bull|#0*149|#0*8226);/i',                            // Bullet.
        '/&(pound|#0*163);/i',                                   // Pound sign.
        '/&(euro|#0*8364);/i',                                   // Euro sign.
        '/&(dollar|#0*36);/i',                                   // Dollar sign.
        '/&[^&\s;]+;/i',                                         // Unknown/unhandled entities.
        '/[ ]{2,}/',                                             // Runs of spaces, post-handling.
    );

    /**
     *  List of pattern replacements corresponding to patterns searched.
     *
     *  @var array $plain_replace
     *  @see $plain_search
     */
    public $plain_replace = array(
        '',                                             // Non-legal carriage return.
        ' ',                                            // Non-breaking space.
        '"',                                            // Double quotes.
        "'",                                            // Single quotes.
        '>',                                            // Greater-than.
        '<',                                            // Less-than.
        '&',                                            // Ampersand.
        '&',                                            // Ampersand.
        '(c)',                                          // Copyright.
        '(tm)',                                         // Trademark.
        '(R)',                                          // Registered.
        '--',                                           // mdash.
        '-',                                            // ndash.
        '*',                                            // Bullet.
        '£',                                            // Pound sign.
        'EUR',                                          // Euro sign. € ?.
        '$',                                            // Dollar sign.
        '',                                             // Unknown/unhandled entities.
        ' ',                                             // Runs of spaces, post-handling.
    );

    /**
     * Email subject
     *
     * @var string
     */
    private $subject;

    /**
     * Email heading
     *
     * @var string
     */
    private $heading;

    /**
     * Email content in plain format
     *
     * @var string
     */
    private $content_plain = '';

    /**
     * Email content in html format
     *
     * @var string
     */
    private $content_html = '';

    /**
     * True when email is being sent.
     *
     * @var bool
     */
    private $sending;

    /**
     * Email type - plain, html, multipart
     *
     * @var bool
     */
    private $email_type = 'plain';

    /**
     * Email heading
     *
     * @var string
     */
    private $headers;

    /**
     * Strings to find/replace in subjects/headings.
     *
     * @var array
     */
    protected $placeholders = array();

    /**
     * Constructor
     */
    function __construct() {
        // Find/replace.
        if ( empty( $this->placeholders ) ) {
            $this->placeholders = array(
                '{site_title}' => $this->get_blogname(),
            );
        }
        add_action( 'sf_email_header', array( $this, 'email_header' ) );
        add_action( 'sf_email_footer', array( $this, 'email_footer' ) );
    }

    /**
     * Send new account mail
     * 
     * @param  int $user_id user id
     * @param  array $user_data user data: username, password, email
     * @param  boolean $password_generated whether password is autogenerated
     * @return void
     */
    public function send_new_account_mail( $user_id, $user_data, $password_generated ) {
        $subject = SF()->get_setting( 'new_account_subject' );
        $subject = !empty( $subject ) ? $subject : __( 'Your account on {site_title}', 'spirit' );
        $this->subject = $this->format_string( $subject );
        
        $heading = SF()->get_setting( 'new_account_heading' );
        $heading = !empty( $heading ) ? $heading : __( 'Welcome to {site_title}', 'spirit' );
        $this->heading = $this->format_string( $heading );

        $this->email_type = SF()->get_setting( 'new_account_email_type' );
        
        if ( 'html' !== $this->get_email_type() ) {
            $this->content_plain = sf_get_template_html( 'emails/plain/new-account.php', array(
                'email_heading'      => $this->heading,
                'user_login'         => $user_data['user_login'],
                'user_pass'          => $user_data['user_pass'],
                'blogname'           => $this->get_blogname(),
                'password_generated' => $password_generated,
                'sent_to_admin'      => false,
                'plain_text'         => true,
                'email'              => $this,
            ) );
        }

        if ( 'plain' !== $this->get_email_type() ) {
            $this->content_html = sf_get_template_html( 'emails/new-account.php', array(
                'email_heading'      => $this->heading,
                'user_login'         => $user_data['user_login'],
                'user_pass'          => $user_data['user_pass'],
                'blogname'           => $this->get_blogname(),
                'password_generated' => $password_generated,
                'sent_to_admin'      => false,
                'plain_text'         => false,
                'email'              => $this,
            ) );
        }

        add_action( 'phpmailer_init', array( $this, 'handle_multipart' ) );

        return $this->send( $user_data['user_email'], $this->subject, $this->get_content(), $this->get_headers() );
    }

    /**
     * Send reset password mail
     * 
     * @param  int $user_id user id
     * @param  string $user_login user login
     * @param  string $user_email user email address
     * @param  string $reset_pass_url password reset url
     * @return void
     */
    public function send_reset_password_mail( $user_id, $user_login, $user_email, $reset_pass_url ) {
        $subject = SF()->get_setting( 'reset_password_subject' );
        $subject = !empty( $subject ) ? $subject : __( 'Password reset for {site_title}', 'spirit' );
        $this->subject = $this->format_string( $subject );
        
        $heading = SF()->get_setting( 'reset_password_heading' );
        $heading = !empty( $heading ) ? $heading : __( 'Password reset instructions', 'spirit' );
        $this->heading = $this->format_string( $heading );

        $this->email_type = SF()->get_setting( 'reset_password_email_type' );
        
        if ( 'html' !== $this->get_email_type() ) {
            $this->content_plain = sf_get_template_html( 'emails/plain/reset-password.php', array(
                'email_heading'  => $this->heading,
                'user_id'        => $user_id,
                'user_login'     => $user_login,
                'reset_pass_url' => $reset_pass_url,
                'blogname'       => $this->get_blogname(),
                'sent_to_admin'  => false,
                'plain_text'     => true,
                'email'          => $this,
            ) );
        }

        if ( 'plain' !== $this->get_email_type() ) {
            $this->content_html = sf_get_template_html( 'emails/reset-password.php', array(
                'email_heading'  => $this->heading,
                'user_id'        => $user_id,
                'user_login'     => $user_login,
                'reset_pass_url' => $reset_pass_url,
                'blogname'       => $this->get_blogname(),
                'sent_to_admin'  => false,
                'plain_text'     => false,
                'email'          => $this,
            ) );
        }

        add_action( 'phpmailer_init', array( $this, 'handle_multipart' ) );

        return $this->send( $user_email, $this->subject, $this->get_content(), $this->get_headers() );
    }

    /**
     * Send activate account mail
     * 
     * @param  int $user_id user id
     * @param  array $user_data user data: username, password, email
     * @param  boolean $activation_link whether password is autogenerated
     * @return void
     */
    public function send_activate_account_mail( $user_id, $user_data, $activation_link ) {
        $subject = SF()->get_setting( 'activate_account_subject' );
        $subject = !empty( $subject ) ? $subject : __( 'Account Confirmation', 'spirit' );
        $this->subject = $this->format_string( $subject );
        
        $heading = SF()->get_setting( 'activate_account_heading' );
        $heading = !empty( $heading ) ? $heading : __( 'Account Confirmation', 'spirit' );
        $this->heading = $this->format_string( $heading );

        $this->email_type = SF()->get_setting( 'activate_account_email_type' );
        
        if ( 'html' !== $this->get_email_type() ) {
            $this->content_plain = sf_get_template_html( 'emails/plain/activate-account.php', array(
                'email_heading'      => $this->heading,
                'user_login'         => $user_data['user_login'],
                'user_pass'          => $user_data['user_pass'],
                'blogname'           => $this->get_blogname(),
                'activation_link'    => $activation_link,
                'sent_to_admin'      => false,
                'plain_text'         => true,
                'email'              => $this,
            ) );
        }

        if ( 'plain' !== $this->get_email_type() ) {
            $this->content_html = sf_get_template_html( 'emails/activate-account.php', array(
                'email_heading'      => $this->heading,
                'user_login'         => $user_data['user_login'],
                'user_pass'          => $user_data['user_pass'],
                'blogname'           => $this->get_blogname(),
                'activation_link'    => $activation_link,
                'sent_to_admin'      => false,
                'plain_text'         => false,
                'email'              => $this,
            ) );
        }

        add_action( 'phpmailer_init', array( $this, 'handle_multipart' ) );

        return $this->send( $user_data['user_email'], $this->subject, $this->get_content(), $this->get_headers() );
    }

    /**
     * Handle multipart mail.
     *
     * @param  PHPMailer $mailer PHPMailer object.
     * @return PHPMailer
     */
    public function handle_multipart( $mailer ) {
        if ( $this->sending && 'multipart' === $this->get_email_type() ) {
            $mailer->AltBody = wordwrap( // phpcs:ignore WordPress.NamingConventions.ValidVariableName.NotSnakeCaseMemberVar
                preg_replace( $this->plain_search, $this->plain_replace, strip_tags( $this->get_content_plain() ) )
            );
            $this->sending = false;
        }
        return $mailer;
    }

    /**
     * Format email string.
     *
     * @param mixed $string Text to replace placeholders in.
     * @return string
     */
    public function format_string( $string ) {
        $find = array_keys( $this->placeholders );
        $replace = array_values( $this->placeholders );
        return apply_filters( 'sf_email_format_string', str_replace( $find, $replace, $string ), $this );
    }

    /**
     * Get blog name formatted for emails.
     *
     * @return string
     */
    private function get_blogname() {
        return wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );
    }

    /**
     * Get email subject.
     *
     * @return string
     */
    public function get_subject() {
        return $this->subject;
    }

    /**
     * Get email heading.
     *
     * @return string
     */
    public function get_heading() {
        return $this->heading;
    }

    /**
     * Get email headers.
     *
     * @return string
     */
    public function get_headers() {
        if ( ! $this->headers ) {
            $this->headers  = "From: {$this->get_from_name()} <{$this->get_from_address()}>\r\n";
            $this->headers .= "Reply-To: {$this->get_from_address()}\r\n";
            $this->headers .= "Content-Type: {$this->get_content_type()}; charset=utf-8\r\n";
        }
        return apply_filters( 'sf_email_headers', $this->headers, $this );
    }

    /**
     * Return email type.
     *
     * @return string
     */
    public function get_email_type() {
        return $this->email_type && class_exists( 'DOMDocument' ) ? $this->email_type : 'plain';
    }

    /**
     * Get email content type.
     *
     * @return string
     */
    public function get_content_type() {
        switch ( $this->get_email_type() ) {
            case 'html':
                return 'text/html';
            case 'multipart':
                return 'multipart/alternative';
            default:
                return 'text/plain';
        }
    }

    /**
     * Get email content.
     *
     * @return string
     */
    public function get_content() {
        $this->sending = true;

        if ( 'plain' === $this->get_email_type() ) {
            $email_content = preg_replace( $this->plain_search, $this->plain_replace, strip_tags( $this->get_content_plain() ) );
        } else {
            $email_content = $this->get_content_html();
        }

        return wordwrap( $email_content, 70 );
    }

    /**
     * Get the email content in plain text format.
     *
     * @return string
     */
    public function get_content_plain() {
        return $this->content_plain;
    }

    /**
     * Get the email content in HTML format.
     *
     * @return string
     */
    public function get_content_html() {
        return $this->content_html;
    }

    /**
     * Get the from name for outgoing emails.
     *
     * @return string
     */
    public function get_from_name() {
        $from_name = apply_filters( 'sf_email_from_name', SF()->get_setting( 'from_name' ), $this );
        return wp_specialchars_decode( esc_html( $from_name ), ENT_QUOTES );
    }

    /**
     * Get the from address for outgoing emails.
     *
     * @return string
     */
    public function get_from_address() {
        $from_email = SF()->get_setting( 'from_email' );
        if ( empty( $from_email ) ) {
            $from_email = get_option( 'admin_email' );
        }
        $from_email = apply_filters( 'sf_email_from_email', $from_email, $this );
        return sanitize_email( $from_email );
    }

    /**
     * Send an email.
     *
     * @param string $to Email to.
     * @param string $subject Email subject.
     * @param string $message Email message.
     * @param string $headers Email headers.
     * @return bool success
     */
    public function send( $to, $subject, $message, $headers ) {
        add_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
        add_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
        add_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );

        $message = apply_filters( 'sf_mail_content', $this->style_inline( $message ) );
        $return  = wp_mail( $to, $subject, $message, $headers );

        remove_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
        remove_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );
        remove_filter( 'wp_mail_content_type', array( $this, 'get_content_type' ) );

        return $return;
    }

    /**
     * Apply inline styles to dynamic content.
     *
     * @param string|null $content Content that will receive inline styles.
     * @return string
     */
    public function style_inline( $content ) {
        // make sure we only inline CSS for html emails.
        if ( in_array( $this->get_content_type(), array( 'text/html', 'multipart/alternative' ), true ) ) {
            ob_start();
            sf_get_template( 'emails/email-styles.php' );
            $css = apply_filters( 'sf_email_styles', ob_get_clean() );

			if ( $this->supports_emogrifier() ) {
				$emogrifier_class = '\\Pelago\\Emogrifier';
				if ( ! class_exists( $emogrifier_class ) ) {
					include_once SF_FRAMEWORK_DIR . 'includes/libs/class-emogrifier.php';
				}
				try {
					$emogrifier = new $emogrifier_class( $content, $css );
					$content    = $emogrifier->emogrify();
				} catch ( Exception $e ) {
					error_log( "emogrifier: " . $e->getMessage() );
				}
			} else {
				$content = '<style type="text/css">' . $css . '</style>' . $content;
			}
        }
        return $content;
    }

	/**
	 * Return if emogrifier library is supported.
	 *
	 * @since 1.1.2
	 * @return bool
	 */
	protected function supports_emogrifier() {
		return class_exists( 'DOMDocument' ) && version_compare( PHP_VERSION, '5.5', '>=' );
	}

    /**
     * Get the email header.
     *
     * @param mixed $email_heading Heading for the email.
     */
    public function email_header( $email_heading ) {
        sf_get_template( 'emails/email-header.php', array( 'email_heading' => $email_heading ) );
    }

    /**
     * Get the email footer.
     */
    public function email_footer() {
        sf_get_template( 'emails/email-footer.php' );
    }
}