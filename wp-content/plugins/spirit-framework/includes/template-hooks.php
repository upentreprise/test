<?php

add_action( 'sf_post_share_buttons', 'sf_post_share_buttons' );

if ( !function_exists( 'sf_post_share_buttons' ) ) {
	/**
	 * Display share buttons on single post
	 */
    function sf_post_share_buttons() {
        sf_get_template( 'post-share-buttons.php' );
    }
}

add_action( 'sf_author_social_links', 'sf_author_social_links', 10, 1 );

if ( !function_exists( 'sf_author_social_links' ) ) {
	/**
	 * Display site social links
	 * 
	 * @param integer $author_id author ID
	 */
    function sf_author_social_links( $author_id = null ) {
    	$social_links = get_the_author_meta( 'sf_social_links', $author_id );
   		$social_links_data = sf_get_social_icons_data( $social_links );
    	sf_social_icons( $social_links_data, 'author-social' );
    }
}

add_action( 'sf_site_social_links', 'sf_site_social_links', 10, 1 );

if ( !function_exists( 'sf_site_social_links' ) ) {
	/**
	 * Display site social links
	 * 
	 * @param string $class wrapper class
	 */
    function sf_site_social_links( $class = '' ) {
    	$mods = get_theme_mods();
    	$social_links = array();
    	foreach( sf_get_social_icon_names() as $key => $label ) {
    		if ( !empty( $mods[ "social_{$key}" ] ) ) {
    			$social_links[ $key ] = $mods[ "social_{$key}" ];
    		}
    	}
       	$social_links_data = sf_get_social_icons_data( $social_links );
        sf_social_icons( $social_links_data, $class );
    }
}


// use custom avatar
add_filter( 'get_avatar', 'sf_custom_avatar', 10, 5 );

if ( !function_exists( 'sf_custom_avatar' ) ) {
	/**
	 * Custom avatar
	 * @param  string $avatar      avatar html
	 * @param  int/string $id_or_email user id or email
	 * @param  int $size           image size
	 * @param  string $default     default
	 * @param  string $alt         image alt
	 * @return string              custom avatar html
	 */
	function sf_custom_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
	    $user = false;
	    
	    if ( is_numeric( $id_or_email ) ) {

	        $id = (int) $id_or_email;
	        $user = get_user_by( 'id' , $id );

	    } elseif ( is_object( $id_or_email ) ) {

	        if ( ! empty( $id_or_email->user_id ) ) {
	            $id = (int) $id_or_email->user_id;
	            $user = get_user_by( 'id' , $id );
	        }

	    } else {
	        $user = get_user_by( 'email', $id_or_email );
	    }

	    if ( $user && is_object( $user ) ) {
	    	
	    	$custom_avatar = get_the_author_meta( 'sf_user_avatar', $user->ID );
	        
	        if ( !empty( $custom_avatar ) ) {
	            $avatar = "<img alt='{$alt}' src='{$custom_avatar}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
	        }
	    }

	    return $avatar;
	}
}