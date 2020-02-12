<?php

/**
 * Display a help tip.
 *
 * @param  string $tip        Help tip text.
 * @param  bool   $allow_html Allow sanitized HTML if true or escape.
 * @return string
 */
function sf_help_tip( $tip, $allow_html = false ) {
	if ( $allow_html ) {
		$tip = sf_sanitize_tooltip( $tip );
	} else {
		$tip = esc_attr( $tip );
	}

	return '<span class="sf-help-tip" data-tip="' . $tip . '"></span>';
}

/**
 * Retrieve a list of all published pages
 *
 * On large sites this can be expensive, so only load if on the settings page or $force is set to true
 *
 * @param bool $force Force the pages to be loaded even if not on settings
 * @return array $pages_options An array of the pages
 */
function sf_get_option_pages( $force = false ) {

	$pages_options = array( '' => '' ); // Blank option

	if( ( ! isset( $_GET['page'] ) || 'sf_settings' != $_GET['page'] ) && ! $force ) {
		return $pages_options;
	}

	$pages = get_pages();
	if ( $pages ) {
		foreach ( $pages as $page ) {
			$pages_options[ $page->ID ] = $page->post_title;
		}
	}

	return $pages_options;
}

/**
 * Get all post types
 * @return array  post type options
 */
function sf_get_option_post_types() {
    $post_types = get_post_types();
    $options = array();
    foreach ( $post_types as $name => $slug ) {
        $options[ $slug ] = $name;
    }
    return $options;
}

/**
 * Get a list of categories
 * @return array  category options
 */
function sf_get_option_cats() {
	$cats = get_categories( 'hide_empty=0' );
	$options = array();
	foreach ( $cats as $cat ) {
		$options[ $cat->term_id ] = htmlspecialchars_decode( $cat->cat_name );
	}
	return $options;
}


/**
 * Get a list of exclude cats options
 * @return array  category options
 */
function sf_get_option_exclude_cats() {
	$cats = get_categories( 'hide_empty=0' );
	$options = array();
	foreach ( $cats as $cat ) {
		$options[ '-' . $cat->term_id ] = htmlspecialchars_decode( $cat->name );
	}
	return $options;
}

/**
 * Get a list of tags as option
 * @return array  tag options
 */
function sf_get_option_tags() {
	$tags = get_tags( 'hide_empty=0' );
	$options = array();
	foreach ( $tags as $tag ) {
		$options[ $tag->term_id ] = htmlspecialchars_decode( $tag->name );
	}
	return $options;
}

/**
 * Get a list of terms as option
 * @return array  term options
 */
function sf_get_option_terms( $taxonomy = 'category' ) {
	$terms = get_terms( array(
		'taxonomy' => $taxonomy,
		'hide_empty' => 0,
	));
	$options = array();
	foreach ( $terms as $term ) {
		$options[ $term->term_id ] = htmlspecialchars_decode( $term->name );
	}
	return $options;
}

/**
 * Get a list of posts
 * @return array  post options
 */
function sf_get_option_posts( $post_type = 'post' ) {
	$options = array();
    $posts = get_posts( array(
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => -1,
    ));
    foreach( $posts as $post ) {
        $options[ $post->ID ] = $post->post_title;
    }
    return $options;
}

/**
 * Get all authors
 * @return array  authors
 */
function sf_get_option_authors() {
    $users = get_users();
    $options = array();
    foreach ( $users as $user ) {
        $options[ $user->ID ] = $user->display_name;
    }
    return $options;
}

/**
 * Get button styles
 * @return array  button styles
 */
function sf_get_option_button_styles() {
    return apply_filters( 'sf_option_button_styles', array(
		'primary' => __( 'Primary', 'spirit' ),
		'secondary' => __( 'Secondary', 'spirit' ),
		'light' => __( 'Light', 'spirit' ),
		'dark' => __( 'Dark', 'spirit' ),
		'info' => __( 'Info', 'spirit' ),
		'success' => __( 'Success', 'spirit' ),
		'warning' => __( 'Warning', 'spirit' ),
		'danger' => __( 'Danger', 'spirit' ),
		'outline-primary' => __( 'Outline Primary', 'spirit' ),
		'outline-secondary' => __( 'Outline Secondary', 'spirit' ),
		'outline-light' => __( 'Outline Light', 'spirit' ),
		'outline-dark' => __( 'Outline Dark', 'spirit' ),
		'outline-info' => __( 'Outline Info', 'spirit' ),
		'outline-success' => __( 'Outline Success', 'spirit' ),
		'outline-warning' => __( 'Outline Warning', 'spirit' ),
		'outline-danger' => __( 'Outline Danger', 'spirit' )
    ));
}

/**
 * Get a fontawesome icons from json file
 * @return array icons
 */
function sf_get_font_icons() {
	$fonts_json = file_get_contents( SF_FRAMEWORK_DIR . 'includes/data/fontawesome.json' );
	$fonts_array = json_decode( $fonts_json, true );
	return apply_filters( 'sf_font_icons', $fonts_array );
}

/**
 * Get mega menu columns array
 * @return array columns
 */
function sf_get_megamenu_column_names() {
	return array( "1/1","1/2 ( 2/4 ) ( 3/6 ) ( 4/8 )","1/3 ( 2/6 )","2/3 ( 4/6 )","1/4 ( 2/8 )","3/4 ( 6/8 )","1/5","2/5","3/5","4/5","1/6","5/6","1/7","2/7","3/7","4/7","5/7","6/7","1/8","3/8","5/8","7/8" );
}

if ( !function_exists( 'sf_get_social_icon_names' ) ) {
	/**
	 * Get social icon names
	 * @return array
	 */
	function sf_get_social_icon_names() {
		return array(
			'facebook'      => 'Facebook',
			'twitter'       => 'Twitter',
			'googleplus'    => 'Google Plus',
			'instagram'     => 'Instagram',
			'pinterest'     => 'Pinterest',
			'behance'       => 'Behance',
			'deviantart'    => 'Deviantart',
			'digg'          => 'Digg',
			'dribbble'      => 'Dribbble',
			'flickr'        => 'Flickr',
			'github'        => 'Github',
			'linkedin'      => 'Linkedin',
			'quora'         => 'Quora',
			'reddit'        => 'Reddit',
			'skype'         => 'Skype',
			'soundcloud'    => 'Soundcloud',
			'spotify'       => 'Spotify',
			'stackoverflow' => 'Stackoverflow',
			'steam'         => 'Steam',
			'stumbleupon'   => 'StumbleUpon',
			'tumblr'        => 'Tumblr',
			'vimeo'         => 'Vimeo',
			'whatsapp'      => 'WhatsApp',
			'windows'       => 'Windows',
			'wordpress'     => 'Wordpress',
			'youtube'       => 'Youtube',
			'weixin'        => 'Weixin',
			'twitch'        => 'Twitch',
			'vk'            => 'VK',
			'rss'           => 'RSS',
			'email'         => 'Email'
		);
	}
}

if ( !function_exists( 'sf_get_social_icon_classes' ) ) {
	/**
	 * Get social icon classes
	 * @return array
	 */
	function sf_get_social_icon_classes() {
		return array(
			'facebook'      => 'fab fa-facebook-f',
			'twitter'       => 'fab fa-twitter',
			'googleplus'    => 'fab fa-google-plus-g',
			'instagram'     => 'fab fa-instagram',
			'pinterest'     => 'fab fa-pinterest-p',
			'behance'       => 'fab fa-behance',
			'deviantart'    => 'fab fa-deviantart',
			'digg'          => 'fab fa-digg',
			'dribbble'      => 'fab fa-dribbble',
			'flickr'        => 'fab fa-flickr',
			'github'        => 'fab fa-github',
			'linkedin'      => 'fab fa-linkedin',
			'quora'         => 'fab fa-quora',
			'reddit'        => 'fab fa-reddit',
			'skype'         => 'fab fa-skype',
			'soundcloud'    => 'fab fa-soundcloud',
			'spotify'       => 'fab fa-spotify',
			'stackoverflow' => 'fab fa-stack-overflow',
			'steam'         => 'fab fa-steam',
			'stumbleupon'   => 'fab fa-stumbleupon',
			'tumblr'        => 'fab fa-tumblr',
			'vimeo'         => 'fab fa-vimeo',
			'whatsapp'      => 'fab fa-whatsapp',
			'windows'       => 'fab fa-windows',
			'wordpress'     => 'fab fa-wordpress',
			'youtube'       => 'fab fa-youtube',
			'weixin'        => 'fab fa-weixin',
			'twitch'        => 'fab fa-twitch',
			'vk'            => 'fab fa-vk',
			'rss'           => 'fas fa-rss',
			'email'         => 'far fa-envelope'
		);
	}
}

if ( !function_exists( 'sf_get_social_icons_data' ) ) {
	/**
	 * Get social icons data
	 *
	 * @param array $links social links
	 * @return array
	 */
	function sf_get_social_icons_data( $links = array() ) {
		
		if ( empty( $links ) ) {
			return array();
		}

		$icons_data = array();
		$icon_names = sf_get_social_icon_names();
		$icon_classes = sf_get_social_icon_classes();

		foreach ( $links as $key => $url ) {
			$icons_data[] = array(
				'icon' => @$icon_classes[ $key ],
				'class' => 's-'. $key,
				'url'  => $url,
				'title' => @$icon_names[ $key ]
			);
		}

		return $icons_data;
	}
}

if ( !function_exists( 'sf_social_icons' ) ) {
	/**
	 * Output social icons
	 * 
	 * @param  array  $social_icons social icons data
	 * @param  string $class        wrapper class
	 */
	function sf_social_icons( $social_icons = array(), $class = '' ) {
		if ( !empty( $social_icons ) ) {
			$out = '<div class="'. esc_attr( $class ) .'">';
			$out .= '<div class="social-list">';
			foreach( $social_icons as $icon ) {
				$out .= '<a href="' . esc_url( $icon['url'] ) .'" class="'. esc_attr( $icon['class'] ) .'" title="'. esc_attr( $icon['title'] ) .'" target="_blank"><i class="'. esc_attr( $icon['icon'] ) .'"></i><span>'. esc_attr( $icon['title'] ) .'</span></a>';
			}
			$out .= '</div>';
			$out .= '</div>';
			echo $out;
		}
	}
}

if ( !function_exists( 'sf_get_post_title_link' ) ) {
    /**
     * Get post title link from post id
     * 
     * @param  int     $post_id  post id
     * @param  array   $atts     attributes
     * @return string            html
     */
    function sf_get_post_title_link( $post_id = null, $atts = array() ) {

        $out = $attributes = '';
        
        if ( $post_id && is_string( get_post_status( $post_id ) ) ) {
           
            if ( !empty( $atts ) && is_array( $atts ) ) {
                foreach ( $atts as $name => $value ) {
                    $attributes .= $name . '="' . esc_attr( $value ) . '" ';
                }
            }

            $out .= '<a href="'. esc_url( get_the_permalink( $post_id ) ) .'" ' . $attributes . '>'. get_the_title( $post_id ) .'</a>';
        }

        return $out;
    }
}
