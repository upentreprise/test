<?php 
/**
 * SF Envato API
 *
 * @class SF_Envato_API
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

class SF_Envato_API {

    /**
     * The single class instance.
     *
     * @since 1.0.0
     * @access private
     *
     * @var object
     */
    private static $_instance = null;

	/**
	 * The Envato API personal token.
	 *
	 * @access private
	 * @since 1.0.0
	 * @var string
	 */
	private $token = '';

    /**
     * Main SF_Envato_API Instance
     *
     * Ensures only one instance of this class exists in memory at any one time.
     *
     * @see SF_Envato_API()
     * @uses SF_Envato_API::init_globals() Setup class globals.
     * @uses SF_Envato_API::init_actions() Setup hooks and actions.
     *
     * @since 1.0.0
     * @static
     * @return object The one true SF_Envato_API.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
            self::$_instance->init_globals();
        }
        return self::$_instance;
    }

    /**
     * A dummy constructor to prevent this class from being loaded more than once.
     *
     * @see SF_Envato_API::instance()
     *
     * @since 1.0.0
     * @access private
     */
    private function __construct() {
        /* We do nothing here! */
    }

    /**
     * You cannot clone this class.
     *
     * @since 1.0.0
     */
    public function __clone() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'spirit' ), '1.0.0' );
    }

    /**
     * You cannot unserialize instances of this class.
     *
     * @since 1.0.0
     */
    public function __wakeup() {
        _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'spirit' ), '1.0.0' );
    }


    /**
     * Setup the class globals.
     *
     * @since 1.0.0
     * @access private
     */
    private function init_globals() {
        // Envato API token.
        $this->token = sf_product_registration()->get_option( 'token' );
    }

    /**
     * Set a new token
     *
     * @since 1.0.0
     * @access private
     */
    public function set_token( $token = '' ) {
        $this->token = $token;
    }

    /**
     * Get token
     *
     * @since 1.0.0
     * @access private
     */
    public function get_token() {
        return $this->token;
    }

	/**
	 * Send Envato API request
	 *
	 * @access public
	 * @param  string $url  API request URL
	 * @param  array  $args 'wp_remote_get' args
	 * @return array  The HTTP response.
	 */
	public function request( $url, $args = [] ) {
        $defaults = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $this->token,
                'User-Agent'    => 'WordPress - Spirit Framework ' . SF_FRAMEWORK_VERSION
            ),
            'timeout' => 15
        );
        $args = wp_parse_args( $args, $defaults );

        $token = trim( str_replace( 'Bearer', '', $args['headers']['Authorization'] ) );
        if ( empty( $token ) ) {
            return new WP_Error( 'api_token_error', __( 'An API token is required.', 'spirit' ) );
        }

        // Make an API request.
        $response = wp_remote_get( esc_url_raw( $url ), $args );

        // Check the response code.
        $response_code    = wp_remote_retrieve_response_code( $response );
        $response_message = wp_remote_retrieve_response_message( $response );

        if ( ! empty( $response->errors ) && isset( $response->errors['http_request_failed'] ) ) {
            return new WP_Error( 'http_error', esc_html( current( $response->errors['http_request_failed'] ) ) );
        }

        if ( 200 !== $response_code && ! empty( $response_message ) ) {
            return new WP_Error( $response_code, $response_message );
        } elseif ( 200 !== $response_code ) {
            return new WP_Error( $response_code, __( 'An unknown API error occurred.', 'spirit' ) );
        } else {
            $return = json_decode( wp_remote_retrieve_body( $response ), true );
            if ( null === $return ) {
                return new WP_Error( 'api_error', __( 'An unknown API error occurred.', 'spirit' ) );
            }
            return $return;
        }
	}

    /**
     * Deferred item download URL.
     *
     * @since 1.0.0
     *
     * @param int $id The item ID.
     * @return string.
     */
    public function deferred_download( $id ) {
        if ( empty( $id ) ) {
            return '';
        }

        $args = array(
            'deferred_download' => true,
            'item_id'           => $id,
        );
        return add_query_arg( $args, esc_url( sf_product_registration()->get_page_url() ) );
    }

    /**
     * Get the item download.
     *
     * @since 1.0.0
     *
     * @param  int   $id The item ID.
     * @param  array $args The arguments passed to `wp_remote_get`.
     * @return bool|array The HTTP response.
     */
    public function download( $id, $args = array() ) {
        if ( empty( $id ) ) {
            return false;
        }

        $url      = 'https://api.envato.com/v3/market/buyer/download?item_id=' . $id . '&shorten_url=true';
        $response = $this->request( $url, $args );

        // @todo Find out which errors could be returned & handle them in the UI.
        if ( is_wp_error( $response ) || empty( $response ) || ! empty( $response['error'] ) ) {
            return false;
        }

        if ( ! empty( $response['wordpress_theme'] ) ) {
            return $response['wordpress_theme'];
        }

        if ( ! empty( $response['wordpress_plugin'] ) ) {
            return $response['wordpress_plugin'];
        }

        return false;
    }

    /**
     * Get the list of available themes.
     *
     * @since 1.0.0
     *
     * @param  array $args The arguments passed to `wp_remote_get`.
     * @return array The HTTP response.
     */
    public function themes( $args = array() ) {
        $themes   = array();
        $url      = 'https://api.envato.com/v2/market/buyer/list-purchases?filter_by=wordpress-themes';
        $response = $this->request( $url, $args );

        if ( is_wp_error( $response ) || empty( $response ) || empty( $response['results'] ) ) {
            return $themes;
        }

        foreach ( $response['results'] as $theme ) {
            $themes[] = $this->normalize_theme( $theme['item'] );
        }

        return $themes;
    }

    /**
     * Normalize a theme.
     *
     * @since 1.0.0
     *
     * @param  array $theme An array of API request values.
     * @return array A normalized array of values.
     */
    public function normalize_theme( $theme ) {
        $normalized_theme = array(
            'id'            => $theme['id'],
            'name'          => ( ! empty( $theme['wordpress_theme_metadata']['theme_name'] ) ? $theme['wordpress_theme_metadata']['theme_name'] : '' ),
            'author'        => ( ! empty( $theme['wordpress_theme_metadata']['author_name'] ) ? $theme['wordpress_theme_metadata']['author_name'] : '' ),
            'version'       => ( ! empty( $theme['wordpress_theme_metadata']['version'] ) ? $theme['wordpress_theme_metadata']['version'] : '' ),
            'description'   => self::remove_non_unicode( strip_tags( $theme['wordpress_theme_metadata']['description'] ) ),
            'url'           => ( ! empty( $theme['url'] ) ? $theme['url'] : '' ),
            'author_url'    => ( ! empty( $theme['author_url'] ) ? $theme['author_url'] : '' ),
            'thumbnail_url' => ( ! empty( $theme['thumbnail_url'] ) ? $theme['thumbnail_url'] : '' ),
            'rating'        => ( ! empty( $theme['rating'] ) ? $theme['rating'] : '' ),
            'landscape_url' => '',
        );

        // No main thumbnail in API response, so we grab it from the preview array.
        if ( empty( $normalized_theme['thumbnail_url'] ) && ! empty( $theme['previews'] ) && is_array( $theme['previews'] ) ) {
            foreach ( $theme['previews'] as $possible_preview ) {
                if ( ! empty( $possible_preview['landscape_url'] ) ) {
                    $normalized_theme['landscape_url'] = $possible_preview['landscape_url'];
                    break;
                }
            }
        }
        if ( empty( $normalized_theme['thumbnail_url'] ) && ! empty( $theme['previews'] ) && is_array( $theme['previews'] ) ) {
            foreach ( $theme['previews'] as $possible_preview ) {
                if ( ! empty( $possible_preview['icon_url'] ) ) {
                    $normalized_theme['thumbnail_url'] = $possible_preview['icon_url'];
                    break;
                }
            }
        }

        return $normalized_theme;
    }

    /**
     * Remove all non unicode characters in a string
     *
     * @since 1.0.0
     *
     * @param string $retval The string to fix.
     * @return string
     */
    static private function remove_non_unicode( $retval ) {
        return preg_replace( '/[\x00-\x1F\x80-\xFF]/', '', $retval );
    }
}