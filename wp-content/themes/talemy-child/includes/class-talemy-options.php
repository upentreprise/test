<?php
/**
 * Talemy Options
 *
 * @since   1.1.7
 * @package Talemy/Classes
 */

if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Theme Options
 */
if ( ! class_exists( 'Talemy_Options' ) ) {
	/**
	 * Theme Options
	 */
	class Talemy_Options {

        /**
         * Static property to hold our singleton instance
         */
        private static $instance = null;

        /**
		 * Post id.
		 *
		 * @var $instance Post id.
		 */
		public static $post_id = null;
        
        /**
		 * A static option variable.
		 *
		 * @access private
		 * @var array $theme_options
		 */
		private static $theme_options;
        
        /**
         * If an instance exists, this returns it.  If not, it creates one and
         * retuns it.
         *
         * @return Talemy_Options
         */
        public static function instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

		/**
		 * Constructor
		 */
		public function __construct() {
			// Refresh options variables after customizer save.
			add_action( 'after_setup_theme', array( $this, 'update_options' ) );
		}

		/**
		 * Default theme option values
         * 
		 * @return array
		 */
		public static function defaults() {
			return apply_filters( 'talemy_default_options', array(
                'logo' => '',
                'logo_retina' => '',
                'logo_dimensions' => array( 'width' => '', 'height' => '' ),
                'logo_alt' => '',
                'logo_alt_retina' => '',
                'page_loader' => 'none',
                'page_loading_bg' => '',
                'sticky_sidebar' => 1,
                'disable_megamenu' => 0,
                'hide_sidebar_on_xs' => 0,
                'scroll_top' => 1,
                'loop_thumb_placeholder' => 0,
                'loop_date_format' => '',
                'enable_lightbox' => 1,
                'footer_top' => 1,
                'footer_top_style' => '1',
                'footer_bottom_style' => '3',
                'footer_copyright' => '© %%year%% <a href="https://talemy.themespirit.com" target="_blank">%%sitename%%</a>. All Rights Reserved.',
                'footer_title_style' => '',
                'primary_color' => '#41246d',
                'secondary_color' => '#f5b417',
                'corner_style' => 'sharp',
                'grid_category' => 1,
                'grid_meta_data' => array( 'date', 'author', 'comment' ),
                'grid_excerpt' => 1,
                'grid_excerpt_limit' => 80,
                'list_category' => 1,
                'list_meta_data' => array( 'date', 'author' ),
                'list_excerpt' => 1,
                'list_excerpt_limit' => 120,
                'masonry_category' => 1,
                'masonry_meta_data' => array( 'date', 'author', 'share' ),
                'masonry_excerpt' => 1,
                'masonry_excerpt_limit' => 80,
                'post_style' => '2',
                'post_layout' => 'sidebar-right',
                'post_sidebar' => 'default-sidebar',
                'post_banner' => '',
                'post_banner_image' => '',
                'post_banner_shortcode' => '',
                'post_meta_data' => array( 'avatar', 'author', 'date', 'cats', 'comment' ),
                'post_time_filter' => '86400',
                'post_tags' => 1,
                'post_adjacent' => 1,
                'post_author_box' => 1,
                'post_comments' => 1,
                'post_related' => 1,
                'post_related_type' => '',
                'post_related_count' => 3,
                'post_share' => array( 'facebook', 'twitter', 'pinterest', 'googleplus' ),
                'social_twitter_at' => '',
                'page_layout' => 'sidebar-right',
                'page_sidebar' => 'default-sidebar',
                'page_comments' => 1,
                'page_banner' => '',
                'page_banner_image' => '',
                'page_banner_shortcode' => '',
                'home_title' => esc_html__( 'Blog', 'talemy' ),
                'archive_layout' => 'sidebar-right',
                'archive_sidebar' => 'default-sidebar',
                'archive_list_style' => 'list',
                'archive_thumb_size' => 'talemy_thumb_small',
                'archive_columns' => '3',
                'archive_tablet_columns' => '2',
                'archive_mobile_columns' => '1',
                'archive_banner' => '',
                'archive_banner_image' => '',
                'archive_banner_shortcode' => '',
                'archive_pagination' => 'numeric',
                'archive_ppl' => 5,
                'archive_max_loads' => 3,
                'author_layout' => 'sidebar-right',
                'author_sidebar' => 'default-sidebar',
                'author_list_style' => 'list',
                'author_thumb_size' => 'talemy_thumb_small',
                'author_columns' => '3',
                'author_tablet_columns' => '2',
                'author_mobile_columns' => '1',
                'author_banner' => '',
                'author_banner_image' => '',
                'author_banner_shortcode' => '',
                'author_pagination' => 'numeric',
                'author_ppl' => 5,
                'author_max_loads' => 3,
                'home_layout' => 'sidebar-right',
                'home_sidebar' => 'default-sidebar',
                'home_list_style' => 'list',
                'home_thumb_size' => 'talemy_thumb_small',
                'home_columns' => '3',
                'home_tablet_columns' => '2',
                'home_mobile_columns' => '1',
                'home_banner' => '',
                'home_banner_image' => '',
                'home_banner_shortcode' => '',
                'home_pagination' => 'numeric',
                'home_ppl' => 5,
                'home_max_loads' => 3,
                'category_layout' => 'sidebar-right',
                'category_sidebar' => 'default-sidebar',
                'category_list_style' => 'list',
                'category_thumb_size' => 'talemy_thumb_small',
                'category_columns' => '3',
                'category_tablet_columns' => '2',
                'category_mobile_columns' => '1',
                'category_banner' => '',
                'category_banner_image' => '',
                'category_banner_shortcode' => '',
                'category_pagination' => 'numeric',
                'category_ppl' => 5,
                'category_max_loads' => 3,
                'tag_layout' => 'sidebar-right',
                'tag_sidebar' => 'default-sidebar',
                'tag_list_style' => 'list',
                'tag_thumb_size' => 'talemy_thumb_small',
                'tag_columns' => '3',
                'tag_tablet_columns' => '2',
                'tag_mobile_columns' => '1',
                'tag_banner' => '',
                'tag_banner_image' => '',
                'tag_banner_shortcode' => '',
                'tag_pagination' => 'numeric',
                'tag_ppl' => 5,
                'tag_max_loads' => 3,
                'search_layout' => 'sidebar-right',
                'search_sidebar' => 'default-sidebar',
                'search_list_style' => 'list',
                'search_thumb_size' => 'talemy_thumb_small',
                'search_columns' => '3',
                'search_tablet_columns' => '2',
                'search_mobile_columns' => '1',
                'search_banner' => '',
                'search_banner_image' => '',
                'search_banner_shortcode' => '',
                'search_pagination' => 'numeric',
                'search_ppl' => 5,
                'search_max_loads' => 3,
                'attachment_layout' => 'sidebar-right',
                'attachment_sidebar' => 'default-sidebar',
                'header_style' => '1',
                'header_position' => '',
                'header_info_address' => '',
                'header_info_email' => '',
                'header_info_phone' => '',
                'header_ads_code' => '',
                'topbar' => 1,
                'topbar_cta_btn' => 0,
                'topbar_btn_text' => '',
                'topbar_btn_url' => '',
                'topbar_btn_class' => '',
                'nav_sticky_style' => 'smart',
                'nav_search' => 1,
                'nav_login' => 1,
                'nav_login_button_style' => '',
                'nav_hamburger' => 0,
                'nav_wishlist' => 1,
                'nav_cta_btn' => 0,
                'nav_btn_text' => '',
                'nav_btn_url' => '#',
                'nav_btn_class' => '',
                'nav_show_course_cats' => 1,
                'nav_course_cats' => array(),
                'nav_top_padding' => 15,
                'nav_bottom_padding' => 15,
                'menu_alignment' => 'center',
                'menu_icons_position' => 'left',
                'menu_dropdown_indicator' => 1,
                'custom_css' => '',
                'header_code' => '',
                'footer_code' => '',
                'dynamic_css_method' => 'inline',
                'wc_nav_cart' => 1,
                'wc_layout' => 'sidebar-right',
                'wc_sidebar' => 'wc-sidebar',
                'wc_banner' => '',
                'wc_banner_image' => '',
                'wc_banner_shortcode' => '',
                'wc_product_layout' => 'sidebar-right',
                'wc_product_sidebar' => 'wc-sidebar',
                'wc_related_columns' => '3',
                'wc_related_count' => '3',
                'wc_upsell_columns' => '3',
                'wc_upsell_count' => '3',
                'wc_product_banner' => '',
                'wc_product_banner_image' => '',
                'wc_product_banner_shortcode' => '',
                'ec_banner' => '',
                'ec_banner_image' => '',
                'ec_banner_shortcode' => '',
                'ec_list_thumb_size' => 'talemy_thumb_small',
                'ec_single_layout' => 'sidebar-right',
                'ld_layout' => 'sidebar-right',
                'ld_sidebar' => '',
                'ld_thumb_hover_text' => '<i class="fas fa-eye"></i>' . esc_html__( 'Watch Now', 'talemy' ),
                'ld_banner' => '',
                'ld_banner_image' => '',
                'ld_banner_shortcode' => '',
                'ld_courses_list_style' => 'list',
                'ld_courses_thumb_size' => 'talemy_thumb_small',
                'ld_courses_columns' => '4',
                'ld_courses_tablet_columns' => '3',
                'ld_courses_mobile_columns' => '1',
                'ld_courses_layout' => 'full-width',
                'ld_courses_sidebar' => '',
                'ld_courses_meta_data' => array( 'level', 'duration', 'language' ),
                'ld_courses_pagination' => 'numeric',
                'ld_courses_ppl' => 5,
                'ld_courses_max_loads' => 3,
                'ld_course_layout' => 'sidebar-right',
                'ld_course_style' => '2',
                'ld_course_sections' => array( 'overview', 'curriculum', 'instructors', 'reviews' ),
                'ld_course_sections_layout' => 'toggles',
                'ld_course_section_title_overview' => esc_html__( 'Overview', 'talemy' ),
                'ld_course_section_title_curriculum' => esc_html__( 'Curriculum', 'talemy' ),
                'ld_course_section_title_instructors' => esc_html__( 'Instructors', 'talemy' ),
                'ld_course_section_title_reviews' => esc_html__( 'Reviews', 'talemy' ),
                'ld_course_related' => 1,
                'ld_course_related_type' => '',
                'ld_course_related_count' => 3,
                'bbp_layout' => 'sidebar-right',
                'bbp_sidebar' => '',
                'bbp_banner' => '',
                'bbp_banner_image' => '',
                'bbp_banner_shortcode' => '',
                'bp_layout' => 'sidebar-right',
                'bp_sidebar' => '',
                'bp_banner' => '',
                'bp_banner_image' => '',
                'bp_banner_shortcode' => '',
                'bp_nav_messages' => 1,
                'bp_nav_notifications' => 1,
			) );
        }
        
		/**
		 * Get theme option
		 *
		 * @return array
		 */
		public static function get_options() {
			return self::$theme_options;
        }
        
		/**
		 * Update theme options
		 */
		public static function update_options() {
			self::$theme_options = wp_parse_args(
				get_theme_mods(),
				self::defaults()
			);
		}
	}
}

Talemy_Options::instance();
