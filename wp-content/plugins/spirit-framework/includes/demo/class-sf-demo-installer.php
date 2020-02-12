<?php
/**
 * SF Demo Installer
 *
 * Demo data installer class
 */

class SF_Demo_Installer {

	private static $data = array();
    private static $backup = array();
    private static $current = '';
	private static $history = array();
	private static $demo_key = '_sf_demo_content';
    private static $demo_dir = '';

    /**
     * post date - timestamp
     * @var integer
     */
    private static $post_date = 0;

    /**
     * start widget instance from 100
     * @var integer
     */
    private static $widget_instance = 100;

	/**
	 * Constructor
	 */
	private static function init() {
        $current = get_option( 'sf_demo_current' ); // demo id
		$history = get_option( 'sf_demo_history' ); // menus, sidebars, widgets, terms
        $backup = get_option( 'sf_demo_backup' ); // menus, widgets, options
        
        if ( !empty( $current ) ) {
            self::$current = $current;
        }

        if ( !empty( $history ) ) {
            self::$history = $history;
        }

        if ( !empty( $backup ) ) {
            self::$backup = $backup;
        }
        
        $upload_dir = wp_upload_dir();
        self::$demo_dir = wp_normalize_path( $upload_dir['basedir'] .'/'. get_template() . '_demo' );
        
        self::$post_date = current_time( 'timestamp' );
	}

    /**
     * Before install content
     * delete old demo & do backup
     */
    public static function before_install_demo() {
        // read demo data
        self::init();
        
        // backup theme settings before installing the demo
        if ( empty( self::$current ) ) {
            $backup = [];
            $active_sidebars = get_option( 'sidebars_widgets' );
            $backup['sidebars_widgets'] = !empty( $active_sidebars ) ? $active_sidebars : '';
            // remove widgets from current sidebars
            if ( isset( $active_sidebars['default-sidebar'] ) ) {
                $active_sidebars['default-sidebar'] = array();
            }
            if ( isset( $active_sidebars['footer-1'] ) ) {
                $active_sidebars['footer-1'] = array();
            }
            if ( isset( $active_sidebars['footer-2'] ) ) {
                $active_sidebars['footer-2'] = array();
            }
            if ( isset( $active_sidebars['footer-3'] ) ) {
                $active_sidebars['footer-3'] = array();
            }
            if ( isset( $active_sidebars['footer-4'] ) ) {
                $active_sidebars['footer-4'] = array();
            }
            if ( isset( $active_sidebars['footer-5'] ) ) {
                $active_sidebars['footer-5'] = array();
            }
            if ( isset( $active_sidebars['footer-gallery'] ) ) {
                $active_sidebars['footer-gallery'] = array();
            }
            if ( isset( $active_sidebars['footer-top'] ) ) {
                $active_sidebars['footer-top'] = array();
            }
            if ( isset( $active_sidebars['footer-bottom'] ) ) {
                $active_sidebars['footer-bottom'] = array();
            }
            if ( isset( $active_sidebars['topbar-left'] ) ) {
                $active_sidebars['topbar-left'] = array();
            }
            if ( isset( $active_sidebars['topbar-right'] ) ) {
                $active_sidebars['topbar-right'] = array();
            }
            if ( isset( $active_sidebars['off-canvas'] ) ) {
                $active_sidebars['off-canvas'] = array();
            }
            if ( isset( $active_sidebars['side'] ) ) {
                $active_sidebars['side'] = array();
            }
            if ( isset( $active_sidebars['side_right'] ) ) {
                $active_sidebars['side_right'] = array();
            }
            update_option( 'sidebars_widgets', $active_sidebars );

            $menus = get_theme_mod( 'nav_menu_locations' );
            $backup['nav_menu_locations'] = !empty( $menus ) ? $menus : '';
            set_theme_mod( 'nav_menu_locations', [] );

            $options = get_theme_mods();
            $backup['options'] = !empty( $options ) ? $options : '';
            update_option( 'sf_demo_backup', $backup );
            self::$backup = $backup;
        }
        // delete demo content before installation
        else {
            // remove widgets from current sidebars
            $active_sidebars = get_option( 'sidebars_widgets' );
            if ( isset( $active_sidebars['default-sidebar'] ) ) {
                $active_sidebars['default-sidebar'] = array();
            }
            if ( isset( $active_sidebars['footer-1'] ) ) {
                $active_sidebars['footer-1'] = array();
            }
            if ( isset( $active_sidebars['footer-2'] ) ) {
                $active_sidebars['footer-2'] = array();
            }
            if ( isset( $active_sidebars['footer-3'] ) ) {
                $active_sidebars['footer-3'] = array();
            }
            if ( isset( $active_sidebars['footer-4'] ) ) {
                $active_sidebars['footer-4'] = array();
            }
            if ( isset( $active_sidebars['footer-5'] ) ) {
                $active_sidebars['footer-5'] = array();
            }
            if ( isset( $active_sidebars['footer-gallery'] ) ) {
                $active_sidebars['footer-gallery'] = array();
            }
            if ( isset( $active_sidebars['footer-top'] ) ) {
                $active_sidebars['footer-top'] = array();
            }
            if ( isset( $active_sidebars['footer-bottom'] ) ) {
                $active_sidebars['footer-bottom'] = array();
            }
            if ( isset( $active_sidebars['topbar-left'] ) ) {
                $active_sidebars['topbar-left'] = array();
            }
            if ( isset( $active_sidebars['topbar-right'] ) ) {
                $active_sidebars['topbar-right'] = array();
            }
            update_option( 'sidebars_widgets', $active_sidebars );
            self::delete_contents();
        }
    }

    /**
     * Install demo
     */
    public static function install_demo( $demo_file = '', $demo_data, $new_demo_data ) {
        // backup && delete content
        self::before_install_demo();
        // install demo data
        $demo_file = wp_normalize_path( $demo_file );
        if ( !empty( $demo_file ) && file_exists( $demo_file ) ) {
            include( $demo_file );
        }
        // save demo history
        self::$history['content'] = $new_demo_data;
        self::after_install_contents();
    }

    /**
     * Uninstall demo
     * remove everything
     */
    public static function uninstall_demo() {
        // read demo data
        self::init();
        self::delete_contents();
        self::restore_backup();
        delete_option( 'sf_demo_current' );
    }

    /**
     * Delete demo contents
     */
    public static function delete_contents() {
        self::delete_posts();
        self::delete_media();
        self::delete_menus();
        self::delete_terms();
        self::delete_sidebars();
        self::delete_cpt_posts();
        self::delete_rev_sliders();
        self::$history = array();
        delete_option( 'sf_demo_history' );
    }

    /**
     * Restore backup after demo uninstall
     */
    public static function restore_backup() {
        if ( !empty( self::$backup ) ) {
            // restore nav menu locations
            if ( isset( self::$backup['nav_menu_locations'] ) ) {
                set_theme_mod( 'nav_menu_locations', self::$backup['nav_menu_locations'] );
            }
            // restore widgets
            if ( isset( self::$backup['sidebars_widgets'] ) ) {
                update_option( 'sidebars_widgets', self::$backup['sidebars_widgets'] );
            }
            // restore options
            if ( isset( self::$backup['options'] ) ) {
                $theme_slug = get_option( 'stylesheet' );
                update_option( "theme_mods_$theme_slug", self::$backup['options'] );
            }
            self::$backup = array();
            delete_option( 'sf_demo_backup' );
        }
    }

    /**
     * After install content
     * save demo history for later use
     */
    public static function after_install_contents() {
        if ( !empty( self::$history ) ) {
            update_option( 'sf_demo_history', self::$history );
        }
    }

    /**
     * Set static homepage
     * @param array args 
     */
    public static function set_homepage( $args ) {
        if ( !empty( $args['show_on_front'] ) ) {
            update_option( 'show_on_front', $args['show_on_front'] );
        }
        if ( !empty( $args['page_on_front'] ) ) {
            update_option( 'page_on_front', $args['page_on_front'] );
        }
        if ( !empty( $args['page_for_posts'] ) ) {
            update_option( 'page_for_posts', $args['page_for_posts'] );
        }
    }

    /**
     * Get post date - minus one day
     * @return post date
     */
    public static function get_post_date() {
        self::$post_date -= 86400;
        return date( 'Y-m-d H:i:s', self::$post_date );
    }

    /**
     * Get post content
     * @return string lorem ipsum
     */
    public static function get_post_content() {
        return 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.
<blockquote>Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.</blockquote>
Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.

Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis.';
    }

    /**
     * Add post
     * @param array $args arguments
     */
    public static function add_post( $args ) {
        $new_post = array( 
            'post_title' => $args['title'],
            'post_status' => 'publish',
            'post_type' => 'post',
            'comment_status' => 'open',
            'tags_input' => isset( $args['tags'] ) ? $args['tags'] : array(),
            'post_date' => self::get_post_date(),
        );

        if ( !empty( $args['post_id'] ) ) {
            $new_post['import_id'] = absint( $args['post_id'] );
        }

        if ( !empty( $args['post_content'] ) ) {
            $new_post['post_content'] = $args['post_content'];
        } else {
            $new_post['post_content'] = self::get_post_content();
        }

        if ( !empty( $args['post_excerpt'] ) ) {
            $new_post['post_excerpt'] = $args['post_excerpt'];
        }

        $post_id = wp_insert_post( $new_post );

        if ( is_wp_error( $post_id ) ) {
            return $post_id;
        }

        if ( !empty( $args['categories'] ) ) {
            wp_set_object_terms( $post_id, $args['categories'], 'category' );
        }

        if ( !empty( $args['post_format'] ) ) {
            set_post_format( $post_id, $args['post_format'] );
        }

        if ( !empty( $args['featured'] ) ) {
            set_post_thumbnail( $post_id, $args['featured'] );
        }

        if ( isset( $args['sticky'] ) && $args['sticky'] ) {
            stick_post( $post_id );
        }
        
        if ( !empty( $args['post_meta'] ) ) {
            foreach ( $args['post_meta'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }

        // add our demo custom meta field and use it for deletion
        update_post_meta( $post_id, self::$demo_key, true );

        return $post_id;
    }

    /**
     * Add page
     * @param array $args arguments
     */
    public static function add_page( $args ) {
        $new_page = array( 
            'post_title' => isset( $args['title'] ) ? $args['title'] : 'Page',
            'post_status' => 'publish',
            'post_type' => 'page',
            'ping_status' => 'closed',
            'comment_status' => 'closed',
        );

        if ( !empty( $args['post_id'] ) ) {
            $new_page['import_id'] = absint( $args['post_id'] );
        }

        if ( !empty( $args['post_content'] ) ) {
            $new_page['post_content'] = $args['post_content'];
        } else {
            $new_page['post_content'] = '';
        }

        $post_id = wp_insert_post( $new_page );

        if ( is_wp_error( $post_id ) ) {
            return $post_id;
        }

        if ( !empty( $args['post_meta'] ) ) {
            foreach ( $args['post_meta'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }

        update_post_meta( $post_id, self::$demo_key, true );

        return $post_id;
    }

    /**
     * Add custom post type
     * @param array $args arguments
     */
    public static function add_custom_post_type( $args ) {
        $new_post = array(
            'post_title' => $args['title'],
            'post_type' => $args['post_type'],
            'post_status' => 'publish',
            'ping_status' => 'closed',
            'comment_status' => 'closed',
            'post_date' => self::get_post_date(),
        );

        if ( !empty( $args['post_content'] ) ) {
            $new_post['post_content'] = $args['post_content'];
        }

        if ( !empty( $args['post_excerpt'] ) ) {
            $new_post['post_excerpt'] = $args['post_excerpt'];
        }

        if ( !empty( $args['post_id'] ) ) {
            $new_post['import_id'] = absint( $args['post_id'] );
        }

        $post_id = wp_insert_post( $new_post );

        if ( is_wp_error( $post_id ) ) {
            return $post_id;
        }

        if ( !empty( $args['featured'] ) ) {
            set_post_thumbnail( $post_id, $args['featured'] );
        }

        if ( !empty( $args['taxonomy'] ) ) {
            wp_set_object_terms( $post_id, $args['taxonomy'][0], $args['taxonomy'][1] );
        }

        if ( !empty( $args['post_meta'] ) ) {
            foreach ( $args['post_meta'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }

        // add our demo custom meta field and use it for deletion
        update_post_meta( $post_id, self::$demo_key, true );

        return $post_id;
    }

    /**
     * Add elementor page
     * @param array $args arguments
     */
    public static function add_elementor_page( $args ) {
        $source = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' );
        $item = $source->import_template( basename( $args['file'] ), $args['file'] );

        $post_id = isset( $item[0]['template_id'] ) ? $item[0]['template_id'] : 0;
        $post_type = !empty( $args['post_type'] ) ? $args['post_type'] : 'page';
        $post_data = array(
            'ID' => $post_id,
            'post_type' => $post_type,
            'post_date' => self::get_post_date()
        );

        if ( !empty( $args['title'] ) ) {
            $post_data['post_title'] = $args['title'];
        }

        if ( !empty( $args['slug'] ) ) {
            $post_data['post_name'] = $args['slug'];
        }

        if ( !empty( $post_id ) ) {
            wp_update_post( $post_data );
        } else {
            return $post_id;
        }

        if ( !empty( $args['featured'] ) ) {
            set_post_thumbnail( $post_id, $args['featured'] );
        }

        if ( !empty( $args['taxonomy'] ) ) {
            wp_set_object_terms( $post_id, $args['taxonomy'][0], $args['taxonomy'][1] );
        }

        if ( !empty( $args['post_meta'] ) ) {
            foreach ( $args['post_meta'] as $key => $value ) {
                update_post_meta( $post_id, $key, $value );
            }
        }

        update_post_meta( $post_id, self::$demo_key, true );
        
        return $post_id;
    }

    /**
     * Add term
     * @param string $term_name term name
     * @param string $taxonomy  taxonomy name
     * @param array  $args
     * @param array  $term_meta term meta
     */
    public static function add_term( $term_name, $taxonomy, $args = array(), $term_meta = array() ) {
        $term = term_exists( $term_name, $taxonomy );
        if ( $term !== 0 && $term !==  null ) {
            if ( is_array( $term ) ) {
                return $term['term_id'];
            } else {
                wp_update_term( $term, $taxonomy, $args );
                return $term;
            }
        }

        // set parent id
        if ( !empty( $args['parent'] ) ) {
            $term = get_term_by( 'slug', $args['parent'], $taxonomy );
            if ( $term ) {
                $args['parent'] = $term->term_id;
            } else {
                $args['parent'] = 0;
            }
        }

        $term = wp_insert_term( $term_name, $taxonomy, $args );
        $term_id = 0;

        if ( !is_wp_error( $term ) ) {
            $term_id = $term['term_id'];

            if ( !empty( $term_meta ) && is_array( $term_meta ) ) {
                foreach ( $term_meta as $key => $value ) {
                    add_term_meta( $term_id, $key, $value, true );
                }
            }

            // save to demo history
            if ( !isset( self::$history['term'][ $taxonomy ] ) ) {
                self::$history['term'][ $taxonomy ] = [ $term_id ];
            } elseif ( !in_array( $term_id, self::$history['term'][ $taxonomy ] ) ) {
                self::$history['term'][ $taxonomy ][] = $term_id;
            }
        }

        return $term_id;
    }

    /**
     * Add a category
     * 
     * @param array $args
     */
    public static function add_category( $args ) {
        // check if the category exist
        $term = term_exists( $args['name'], 'category' );
        if ( $term !== 0 && $term !==  null ) {
            if ( is_array( $term ) ) {
                return $term['term_id'];
            } else {
                wp_update_term( $term, 'category', $args );
                return $term;
            }
        }

        // get parent id
        if ( isset( $args['parent_id'] ) && is_string( $args['parent_id'] ) ) {
            $term = get_category_by_slug( $args['parent_id'] );
            if ( $term ) {
                $args['parent_id'] = $term->term_id;
            } else {
                $args['parent_id'] = 0;
            }
        }

        // create new category
        $cat_id = wp_create_category( $args['name'], $args['parent_id'] );
        
        if ( $cat_id !== 0 ) {

            if ( !empty( $args['description'] ) ) {
                wp_update_term( $cat_id, 'category', array( 'description' => $args['description'] ) );
            }

            // save to demo history
            if ( !isset( self::$history['term']['category'] ) ) {
                self::$history['term']['category'] = [ $cat_id ];
            } elseif ( !in_array( $cat_id, self::$history['term']['category'] ) ) {
                self::$history['term']['category'][] = $cat_id;
            }
        }

        return $cat_id;
    }

    /**
     * Add a sidebar
     * 
     * @param string $name sidebar name
     * @param string $desc sidebar description
     */
    public static function add_sidebar( $name, $desc = '' ) {

        if ( empty( $name ) ) {
            return;
        }

        if ( !isset( $desc ) ) {
            $desc = '';
        }

        $sidebar_id = sanitize_title_with_dashes( $name );
        $sidebars = get_option( 'sf_custom_sidebars' );

        // if a sidebar exist return the sidebar id
        if ( !empty( $sidebars ) && array_key_exists( $sidebar_id, $sidebars ) ) {
            return $sidebar_id;
        }

        // update custom sidebar option
        $sidebars[$sidebar_id] = array( 'name' => $name, 'desc' => $desc );
        update_option( 'sf_custom_sidebars', $sidebars );

        // update sidebar to active sidebar list
        $active_sidebars = get_option( 'sidebars_widgets' );
        $active_sidebars[$sidebar_id] = array();
        update_option( 'sidebars_widgets', $active_sidebars );

        // save to demo history
        if ( !isset( self::$history['sidebar'] ) ) {
            self::$history['sidebar'] = [$sidebar_id];
        } elseif ( !in_array( $sidebar_id, self::$history['sidebar'] ) ) {
            self::$history['sidebar'][] = $sidebar_id;
        }

        return $sidebar_id;
    }

    /**
     * Add widget to sidebar
     * 
     * @param string $sidebar_id   sidebar id
     * @param string $widget_name  widget name
     * @param array $args          widget args
     */
    public static function add_widget_to_sidebar( $sidebar_id, $widget_name = '', $args = array() ) {

        if ( empty( $sidebar_id ) || empty( $widget_name ) ) {
            return;
        }

        // update widget to active sidebars list
        $active_sidebars = get_option( 'sidebars_widgets' );
        $active_sidebars[ $sidebar_id ][] = $widget_name . '-' . self::$widget_instance;
        update_option( 'sidebars_widgets', $active_sidebars );

        // update widget instance
        $widget = get_option( 'widget_' . $widget_name );
        $widget[ self::$widget_instance ] = $args;
        update_option( "widget_$widget_name", $widget );

        // save widget instance
        $demo_option['widgets'][] = array( 'widget_' . $widget_name, self::$widget_instance );

        self::$widget_instance ++;
    }
 

    /**
     * Add menu
     * 
     * @param string $menu_name menu name
     * @param array  $locations location data
     */
    public static function add_menu( $menu_name = '', $locations = array() ) {
        
        $menu_obj = wp_get_nav_menu_object( $menu_name );
        $menu_id = 0;

        // check if a menu exists return menu id or create a new one
        if ( $menu_obj === false ) {
            $menu_id = wp_create_nav_menu( $menu_name );
            if ( is_wp_error( $menu_id ) ) {
                return false;
            }
        } else {
            $menu_id = $menu_obj->term_id;
        }

        // set menu locations
        $menus = get_theme_mod( 'nav_menu_locations' );
        if ( !empty( $locations ) && is_array( $locations ) ) {
            foreach ( $locations as $location ) {
                $menus[ $location ] = $menu_id;
            }
            set_theme_mod( 'nav_menu_locations', $menus );
        }

        // save to demo history
        if ( !isset( self::$history['menu'] ) ) {
            self::$history['menu'] = [ $menu_id ];
        } elseif ( !in_array( $menu_id, self::$history['menu'] ) ) {
            self::$history['menu'][] = $menu_id;
        }

        return $menu_id;
    }

    /**
     * Add menu item link
     * 
     * @param int $menu_id  menu id
     * @param array $args   menu meta
     */
    public static function add_menu_item_link( $menu_id, $args ) {
        $menu_item_data = array(
            'menu-item-object' => '',
            'menu-item-parent-id' => $args['parent_id'],
            'menu-item-type' => 'custom',
            'menu-item-title' => isset( $args['title'] ) ? $args['title'] : 'Link',
            'menu-item-url' => isset( $args['url'] ) ? $args['url'] : '#',
            'menu-item-classes' => isset( $args['classes'] ) ? $args['classes'] : '',
            'menu-item-status' => 'publish',
        );
        $menu_item_id = wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

        self::add_custom_nav_fields( $menu_item_id, $args );

        return $menu_item_id;
    }

    /**
     * Add menu item category
     * 
     * @param int $menu_id  menu id
     * @param array $args   menu meta
     */
    public static function add_menu_item_category( $menu_id, $args ) {
        $menu_item_data = array(
            'menu-item-parent-id' => $args['parent_id'],
            'menu-item-title' => isset( $args['title'] ) ? $args['title'] : get_cat_name( $args['category'] ),
            'menu-item-object-id' => $args['category'],
            'menu-item-url' => get_category_link( $args['category'] ),
            'menu-item-object' => 'category',
            'menu-item-type' => 'taxonomy',
            'menu-item-status' => 'publish'
        );
        $menu_item_id = wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

        self::add_custom_nav_fields( $menu_item_id, $args );

        return $menu_item_id;
    }

    /**
     * Add menu item post type archive
     * 
     * @param int $menu_id  menu id
     * @param array $args   menu meta
     */
    public static function add_menu_item_post_type_archive( $menu_id, $args ) {
        if ( empty( $args['post_type'] ) ) {
            return 0;
        }

        if ( empty( $args['title'] ) ) {
            $title = get_post_type_object( $args['post_type'] );
            $title = $title->labels->archives;
        } else {
            $title = $args['title'];
        }

        $menu_item_data = array(
            'menu-item-parent-id' => $args['parent_id'],
            'menu-item-title' => $title,
            'menu-item-object' => $args['post_type'],
            'menu-item-type' => 'post_type_archive',
            'menu-item-status' => 'publish'
        );
        $menu_item_id = wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

        self::add_custom_nav_fields( $menu_item_id, $args );

        return $menu_item_id;
    }

    /**
     * Add menu item page
     * 
     * @param int $menu_id  menu id
     * @param array $args   menu meta
     */
    public static function add_menu_item_page( $menu_id, $args ) {
        if ( !isset( $args['post_id'] ) ) {
            return 0;
        }

        $menu_item_data = array(
            'menu-item-parent-id' => isset( $args['parent_id'] ) ? $args['parent_id'] : 0,
            'menu-item-title' => isset( $args['title'] ) ? $args['title'] : get_the_title( $args['post_id'] ),
            'menu-item-object-id' => $args['post_id'],
            'menu-item-object' => 'page',
            'menu-item-type' => 'post_type',
            'menu-item-status' => 'publish'
        );
        $menu_item_id = wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

        self::add_custom_nav_fields( $menu_item_id, $args );

        return $menu_item_id;
    }

    /**
     * add menu item post
     * 
     * @param int $menu_id   menu id
     * @param array $args    menu meta
     */
    public static function add_menu_item_post( $menu_id, $args ) {
        $menu_item_data = array(
            'menu-item-parent-id' => $args['parent_id'],
            'menu-item-title' => isset( $args['title'] ) ? $args['title'] : get_the_title( $args['post_id'] ),
            'menu-item-object-id' => $args['post_id'],
            'menu-item-object' => 'post',
            'menu-item-type' => 'post_type',
            'menu-item-status' => 'publish'
        );
        $menu_item_id = wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

        self::add_custom_nav_fields( $menu_item_id, $args );

        return $menu_item_id;
    }

    /**
     * add menu item post_format
     * 
     * @param int $menu_id   menu id
     * @param array $args    menu meta
     */
    public static function add_menu_item_post_format( $menu_id, $args ) {
        $term = get_term_by( 'slug', 'post-format-' . $args['post_format'], 'post_format' );

        if ( !$term ) {
            return;
        }

        $menu_item_data = array(
            'menu-item-parent-id' => $args['parent_id'],
            'menu-item-title' => isset( $args['title'] ) ? $args['title'] : $term->name,
            'menu-item-object-id' => $term->term_id,
            'menu-item-object' => 'post_format',
            'menu-item-type' => 'taxonomy',
            'menu-item-status' => 'publish'
        );
        $menu_item_id = wp_update_nav_menu_item( $menu_id, 0, $menu_item_data );

        self::add_custom_nav_fields( $menu_item_id, $args );

        return $menu_item_id;
    }

    public static function add_custom_nav_fields( $menu_item_id, $args = array() ) {
        if ( isset( $args['_sf_megamenu'] ) ) {
            update_post_meta( $menu_item_id, '_menu_item_sf_megamenu', $args['_sf_megamenu'] );
        }
        // custom fields for megamenu
        update_post_meta( $menu_item_id, self::$demo_key, true );
    }

    /**
     * Add image to library
     * @param string $url image url
     */
    public static function add_media_image( $url ) {

        if ( !function_exists('media_handle_upload') ) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
        }

        $tmp = download_url( $url );
        $desc = 'Demo Image';
        $file_array = array();

        // Set variables for storage
        // fix file filename for query strings
        preg_match( '/[^\?]+\.(jpg|jpe|jpeg|gif|png)/i', $url, $matches );
        $file_array['name'] = basename( $matches[0] );
        $file_array['tmp_name'] = $tmp;

        // If error storing temporarily, unlink
        if ( is_wp_error( $tmp ) ) {
            @unlink( $file_array['tmp_name'] );
            $file_array['tmp_name'] = array();
            echo $tmp->get_error_message();
            return;
        }

        // do the validation and storage stuff
        $id = media_handle_sideload( $file_array, 0, $desc );

        // If error storing permanently, unlink
        if ( is_wp_error( $id ) ) {
            @unlink( $file_array['tmp_name'] );
            echo $id->get_error_message();
            return;
        } else {
            update_post_meta( $id, self::$demo_key, true );
        }

        return $id;
    }

    /**
     * Import Revolution sliders
     * @param array $files  file paths
     * @param string $source local/remote
     */
    public static function import_rev_sliders( $files, $source = 'local' ) {
        if ( !empty( $files ) && class_exists( 'RevSliderFront' ) ) {
            $absolute_path = __FILE__;
            $path_to_file = explode( 'wp-content', $absolute_path );
            $path_to_wp = $path_to_file[0];

            require_once( $path_to_wp . '/wp-load.php' );
            require_once( $path_to_wp . '/wp-includes/functions.php' );

            if ( 'remote' == $source ) {
                $sliders_folder = wp_normalize_path( self::$demo_dir .'/sliders' );
                // create sliders folder if not exist
                if ( !file_exists( $sliders_folder ) ) {
                    wp_mkdir_p( $sliders_folder );
                }
            }

            $revslider = new RevSlider();

            foreach ( $files as $file ) {
                if ( 'remote' == $source ) {
                    $path = parse_url( $file, PHP_URL_PATH );
                    $file_name = basename( $path );
                    $local_file = wp_normalize_path( $sliders_folder .'/'. $file_name );

                    if ( file_exists( $local_file ) ) {
                        $file = $local_file;
                    } else {
                        $response = sf_wp_get_http( $file, $local_file );
                        if ( !$response ) {
                            continue;
                        }
                        $file = $local_file;
                    }
                }
                
                if ( file_exists( $file ) ) {
                    $result = $revslider->importSliderFromPost( true, true, $file );
                    
                    if ( true === $result['success'] ) {
                        if ( empty( self::$history['slider'] ) ) {
                            self::$history['slider'] = [ $result['sliderID'] ];
                        } else {
                            self::$history['slider'][] = $result['sliderID'];
                        }
                    }
                }
            }
        }
    }

    /**
     * Removes Revolution sliders for selected demo.
     *
     * @access private
     */
    public static function delete_rev_sliders() {
        $sliders = self::$history['slider'];

        if ( empty( $sliders ) ) {
            return;
        }

        if ( class_exists( 'RevSliderFront' ) ) {
            $revslider = new RevSlider();
            foreach ( $sliders as $slider_id ) {
                $revslider->initByID( $slider_id );
                $revslider->deleteSlider();
            }
        }
    }

    /**
     * Delete posts
     */
    public static function delete_posts() {
        $query = new WP_Query( array(
            'post_type' => 'any',
            'meta_key'  => self::$demo_key,
            'posts_per_page' => '-1'
        ));
        
        if ( !empty( $query->posts ) ) {
            foreach ( $query->posts as $post ) {
                $response = wp_delete_post( $post->ID, true );
                if ( $response === false ) {
                    echo 'Fail to delete post: ' . $post->ID;
                }
            }
        }
        wp_reset_postdata();
    }

    /**
     * Delete custom post type posts
     */
    public static function delete_cpt_posts() {
        $query = new WP_Query( array(
            'post_type' => array(
                'wpcf7_contact_form',
                'mc4wp-form',
                'tribe_events',
                'tribe_organizer',
                'tribe_venue'
            ),
            'meta_key'  => self::$demo_key,
            'posts_per_page' => '-1'
        ));
        
        if ( !empty( $query->posts ) ) {
            foreach ( $query->posts as $post ) {
                $response = wp_delete_post( $post->ID, true );
                if ( $response === false ) {
                    echo 'Fail to delete post: ' . $post->ID;
                }
            }
        }
        wp_reset_postdata();
    }

    /**
     * Delete media files
     */
    public static function delete_media() {
        $query = new WP_Query(
            array(
            'post_type' => array( 'attachment' ),
            'post_status' => 'inherit',
            'meta_key'  => self::$demo_key,
            'posts_per_page' => '-1'
        ));
        if ( !empty( $query->posts ) ) {
            foreach ( $query->posts as $post ) {
                $response = wp_delete_attachment( $post->ID, true );
                if ( $response === false ) {
                    echo 'Fail to delete attachment: ' . $post->ID;
                }
            }
        }
        wp_reset_postdata();
    }

    /**
     * Delete menus
     */
    public static function delete_menus() {
        if ( empty( self::$history['menu'] ) ) {
            return;
        }

        $menus = self::$history['menu'];
        foreach ( $menus as $menu ) {
            wp_delete_nav_menu( $menu );
        }
    }

    /**
     * Delete terms
     */
    public static function delete_terms() {
        if ( empty( self::$history['term'] ) ) {
            return;
        }

        $terms = self::$history['term'];
        foreach ( $terms as $taxonomy => $term_ids ) {
            if ( !empty( $term_ids ) ) {
                foreach ( $term_ids as $term_id ) {
                    $response = wp_delete_term( $term_id, $taxonomy );
                    if ( $response === false ) {
                        echo 'Fail to delete '. $taxonomy .': ' . $term_id;
                    }
                }
            }
        }
    }

    /**
     * Delete sidebars
     */
    public static function delete_sidebars() {
        if ( empty( self::$history['sidebar'] ) ) {
            return;
        }

        $sidebars = self::$history['sidebar'];
        $custom_sidebars = get_option( 'sf_custom_sidebars' );

        foreach ( $sidebars as $sidebar_id ) {
            if ( isset( $custom_sidebars[ $sidebar_id ] ) ) {
                unset( $custom_sidebars[ $sidebar_id ] );
            }
        }
        update_option( 'sf_custom_sidebars', $custom_sidebars );
    }

    /**
     * Install theme_mods
     * @param string $path  theme option path
     */
    public static function install_theme_options( $path ) {
        $options_json = file_get_contents( $path );
        $mods = json_decode( $options_json, true );
        $theme_slug = get_option( 'stylesheet' );
        update_option( "theme_mods_$theme_slug", $mods );
    }

    /**
     * Update theme_mods
     * @param array $options new options array
     */
    public static function update_theme_options( $options = array() ) {
        $mods = get_theme_mods();
        if ( !empty( $options ) ) {
            foreach ( $options as $option => $value ) {
                $mods[ $option ] = $value;
            }
            $theme_slug = get_option( 'stylesheet' );
            update_option( "theme_mods_$theme_slug", $mods );
        }
    }

    /**
     * Update wp_options
     * @param array $options new options array
     */
    public static function update_options( $options = array() ) {
        foreach ( $options as $key => $value ) {
            update_option( $key, $value );
        }
    }
}