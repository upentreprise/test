<?php

$demo_page_blog = SF_Demo_Installer::add_page( array( 'title' => 'Blog' ) );
$demo_page_profile = SF_Demo_Installer::add_page( array(
    'title' => esc_html__( 'Profile', 'talemy-demo-data' ),
    'post_content' => '[ld_profile]',
    'post_meta' => array(
        '_sf_layout' => 'full-width'
    )
));

$demo_page_about_us = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/demo-5/pages/about_us.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_about_us_2 = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/demo-5/pages/about_us_2.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_contact = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/demo-5/pages/contact_us.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_faqs = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/demo-5/pages/faqs.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_research = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/demo-5/pages/research.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

if ( defined( 'LEARNDASH_VERSION' ) ) {
    $demo_page_course_list = SF_Demo_Installer::add_elementor_page( array(
        'file' => TALEMY_DEMO_DIR . 'demos/common/pages/course_list.json',
        'post_meta' => array(
            '_wp_page_template' => 'page-builder.php'
        )
    ));
}

$demo_page_login = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/login.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

/** elements **/

$demo_page_accordion = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/accordion.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_buttons = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/buttons.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_countdown = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/countdown.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_icon_box = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/icon_box.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_info_box = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/info_boxes.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_gallery = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/gallery.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_number_counter = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/number_counter.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_pricing_table = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/pricing_table.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_progress_bars = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/progress_bars.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_team_members = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/team_members.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_testimonials = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/testimonials.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_woo_products = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/woo_products.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_block_courses = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/block_courses.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_block_posts = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/block_posts.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_course_categories = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/course_categories.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

$demo_page_course_search = SF_Demo_Installer::add_elementor_page( array(
    'file' => TALEMY_DEMO_DIR . 'demos/common/pages/course_search.json',
    'post_meta' => array(
        '_wp_page_template' => 'page-builder.php'
    )
));

SF_Demo_Installer::set_homepage( array(
    // 'show_on_front' => 'posts',
    'show_on_front' => 'page',
    'page_on_front' => $demo_page_homepage,
    'page_for_posts' => $demo_page_blog
));