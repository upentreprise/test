<?php

$options['learndash_settings_courses_themes'] = array(
    'active_theme' => 'ld30'
);

$options['learndash_settings_theme_ld30'] = array(
    'color_primary' => '#d22f2f',
    'color_secondary' => '',
    'color_tertiary' => '',
    'focus_mode_enabled' => 'yes',
    'focus_mode_content_width' => 'default',
    'login_mode_enabled' => 'yes',
    'login_logo' => $demo_img_logo_url[0]
);

$options['learndash_settings_courses_builder'] = array(
    'enabled' => 'yes',
    'per_page' => 25,
    'shared_steps' => 'yes'
);

$options['learndash_settings_per_page'] = array(
    'per_page' => 9
);

$ld_cat_1 = SF_Demo_Installer::add_term( 'Business', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-banknote') );
$ld_cat_2 = SF_Demo_Installer::add_term( 'Design', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-monitor') );
$ld_cat_3 = SF_Demo_Installer::add_term( 'Development', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-settings') );
$ld_cat_4 = SF_Demo_Installer::add_term( 'IT & Software', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-data') );
$ld_cat_5 = SF_Demo_Installer::add_term( 'Marketing', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-like') );
$ld_cat_6 = SF_Demo_Installer::add_term( 'Personal Development', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-study') );
$ld_cat_7 = SF_Demo_Installer::add_term( 'Photography', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-camera') );
$ld_cat_8 = SF_Demo_Installer::add_term( 'Music', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-music') );
$ld_cat_9 = SF_Demo_Installer::add_term( 'Language', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-world') );
$ld_cat_10 = SF_Demo_Installer::add_term( 'Health & Fitness', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-user') );
$ld_cat_11 = SF_Demo_Installer::add_term( 'Office Productivity', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-stack') );
$ld_cat_12 = SF_Demo_Installer::add_term( 'Lifestyle', 'ld_course_category', array(), array( '_sf_icon' => 'ticon-cup') );

$theme_options['nav_course_cats'] = array( $ld_cat_1, $ld_cat_2, $ld_cat_3, $ld_cat_4, $ld_cat_5, $ld_cat_6, $ld_cat_7, $ld_cat_8 );

$demo_img_certificate = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/10/certificate.png' );
$demo_certificate = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Sample Certificate',
    'post_type' => 'sfwd-certificates',
    'post_content' => '<br>
<br>
<br>
<br>
<br>
<br>
<div style="text-align: center; font-size: 100px; font-family: Tahoma;">[usermeta field="first_name"] [usermeta field="last_name"]</div>
<br>
<div style="text-align: center; font-size: 50px; margin-top: 500px;">[courseinfo show="course_title"]</div>
&nbsp;
<div style="text-align: center; text-indent: 380px;">[courseinfo show="completed_on" format="F j, Y"]</div>'
));

$ld_course_content = TALEMY_DEMO_DIR . 'demos/demo-5/pages/course_content.json';

$course_1 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'The Complete Digital Marketing Bootcamp',
    'slug' => 'the-complete-digital-marketing-bootcamp',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'business', 'marketing' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '3 days',
            'content_type' => 'fas fa-play-circle',
            'level' => 'Beginner',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '99',
            'sfwd-courses_certificate' => $demo_certificate
        ),
        '_ldcr_review_after' => 0,
    )
));

$course_2 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'Smart Marketing with Price Psychology',
    'slug' => 'smart-marketing-with-price-psychology',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'business', 'marketing' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '3 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'All Levels',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '9',
            'sfwd-courses_certificate' => $demo_certificate
        ),
        '_ldcr_review_after' => 0,
    )
));

$course_3 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'Mastering Adobe Photoshop CC',
    'slug' => 'mastering-adobe-photoshop-cc',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'design', 'photography' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '10.5 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'Intermediate',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '29',
            'sfwd-courses_certificate' => $demo_certificate
        ),
        '_ldcr_review_after' => 0,
    )
));

$course_4 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'Web Design for Beginners',
    'slug' => 'web-design-for-beginners',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'design', 'photography' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '8 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'All Levels',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'free',
            'sfwd-courses_certificate' => $demo_certificate
        ),
        '_ldcr_review_after' => 0,
    )
));

$course_5 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'Data Science: Deep Learning in Python',
    'slug' => 'data-science-deep-learning-in-python',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'development', 'it-software' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '9.5 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'Intermediate',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '49',
            'sfwd-courses_certificate' => $demo_certificate
        )
    )
));

$course_6 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'The Complete Android App Development',
    'slug' => 'the-complete-android-app-development',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'development', 'it-software' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '2 days',
            'content_type' => 'fas fa-play-circle',
            'level' => 'All Levels',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '69',
            'sfwd-courses_certificate' => $demo_certificate
        )
    )
));

$course_7 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'Business English Course for ESL Students',
    'slug' => 'business-english-course-for-esl-students',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'language', 'business' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '6 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'All Levels',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '19',
            'sfwd-courses_certificate' => $demo_certificate
        )
    )
));

$course_8 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'French for Beginners',
    'slug' => 'french-for-beginners',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'language', 'personal-development' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '20 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'All Levels',
            'language' => 'English, French',
            'lessons' => '7',
            'enrolled' => '200',
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '29',
            'sfwd-courses_certificate' => $demo_certificate
        )
    )
));

$course_9 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'The Art of Energy Healing',
    'slug' => 'the-art-of-energy-healing',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'health-fitness', 'personal-development' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '5 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'Intermediate',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '39',
            'sfwd-courses_certificate' => $demo_certificate
        )
    )
));

$course_10 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'Yoga For Absolute Beginners',
    'slug' => 'yoga-for-absolute-beginners',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'health-fitness', 'personal-development' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '3 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'Beginner',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'free',
            'sfwd-courses_certificate' => $demo_certificate
        )
    )
));

$course_11 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'Learn To Read & Write Music',
    'slug' => 'learn-to-read-write-music',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'music', 'design' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '3.6 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'All Levels',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'paynow',
            'sfwd-courses_course_price' => '39',
            'sfwd-courses_certificate' => $demo_certificate
        )
    )
));

$course_12 = SF_Demo_Installer::add_elementor_page( array(
    'title' => 'Natural Singing for everyone',
    'slug' => 'natural-singing-for-everyone',
    'file' => $ld_course_content,
    'post_type' => 'sfwd-courses',
    'taxonomy' => array(
        array( 'music', 'lifestyle' ),
        'ld_course_category'
    ),
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'short_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque.',
            'duration' => '2.5 hours',
            'content_type' => 'fas fa-play-circle',
            'level' => 'All Levels',
            'language' => 'English',
            'lessons' => '7',
            'enrolled' => '200',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-courses' => array(
            'sfwd-courses_course_price_type' => 'free',
            'sfwd-courses_certificate' => $demo_certificate
        )
    )
));

$ld_post_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in finibus neque. Vivamus in ipsum quis elit vehicula tempus vitae quis lacus. Vestibulum interdum diam non mi cursus venenatis. Morbi lacinia libero et elementum vulputate. Vivamus et facilisis mauris. Maecenas nec massa auctor, ultricies massa eu, tristique erat. Vivamus in ipsum quis elit vehicula tempus vitae quis lacus. Eu pellentesque, accumsan tellus leo, ultrices mi dui lectus sem nulla eu.Eu pellentesque, accumsan tellus leo, ultrices mi dui lectus sem nulla eu. Maecenas arcu, nec ridiculus quisque orci, vulputate mattis risus erat.';

$lesson_1 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Introduction to Digital Marketing',
    'post_type' => 'sfwd-lessons',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        'course_id' => $course_1,
        '_sfwd-lessons' => array(
            'sfwd-lessons_sample_lesson' => 'on',
            'sfwd-lessons_course' => $course_1
        ),
        '_ld_custom_meta' => array(
            'duration' => '30:00',
            'content_type' => 'fas fa-play-circle'
        )
    )
));

$lesson_2 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Content Strategy',
    'post_type' => 'sfwd-lessons',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        'course_id' => $course_1,
        '_sfwd-lessons' => array(
            'sfwd-lessons_course' => $course_1
        ),
        '_ld_custom_meta' => array(
            'duration' => '30:00',
            'content_type' => 'fas fa-play-circle'
        )
    )
));

$lesson_3 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Social Media Marketing (SMM)',
    'post_type' => 'sfwd-lessons',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        'course_id' => $course_1,
        '_sfwd-lessons' => array(
            'sfwd-lessons_course' => $course_1,
            'sfwd-lessons_lesson_video_url' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl',
            'sfwd-lessons_lesson_video_shown' => 'AFTER',
            'sfwd-lessons_lesson_video_auto_complete_delay' => 0
        ),
        '_ld_custom_meta' => array(
            'duration' => '30:00',
            'content_type' => 'fas fa-play-circle',
        )
    )
));

$lesson_4 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Search Engine Optimization (SEO)',
    'post_type' => 'sfwd-lessons',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        'course_id' => $course_1,
        '_sfwd-lessons' => array(
            'sfwd-lessons_course' => $course_1,
            'sfwd-lessons_lesson_video_url' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl',
            'sfwd-lessons_lesson_video_shown' => 'AFTER',
            'sfwd-lessons_lesson_video_auto_complete_delay' => 0
        ),
        '_ld_custom_meta' => array(
            'duration' => '30:00',
            'content_type' => 'fas fa-play-circle'
        )
    )
));

$lesson_5 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Search Engine Marketing (SEM)',
    'post_type' => 'sfwd-lessons',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        'course_id' => $course_1,
        '_sfwd-lessons' => array(
            'sfwd-lessons_course' => $course_1,
            'sfwd-lessons_lesson_video_url' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl',
            'sfwd-lessons_lesson_video_shown' => 'AFTER',
            'sfwd-lessons_lesson_video_auto_complete_delay' => 0
        ),
        '_ld_custom_meta' => array(
            'duration' => '30:00',
            'content_type' => 'fas fa-play-circle'
        )
    )
));

$lesson_6 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Email Marketing',
    'post_type' => 'sfwd-lessons',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        'course_id' => $course_1,
        '_sfwd-lessons' => array(
            'sfwd-lessons_course' => $course_1,
            'sfwd-lessons_lesson_video_url' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl',
            'sfwd-lessons_lesson_video_shown' => 'AFTER',
            'sfwd-lessons_lesson_video_auto_complete_delay' => 0
        ),
        '_ld_custom_meta' => array(
            'duration' => '30:00',
            'content_type' => 'fas fa-play-circle'
        )
    )
));

$lesson_7 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Analytics & Optimization',
    'post_type' => 'sfwd-lessons',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        'course_id' => $course_1,
        '_sfwd-lessons' => array(
            'sfwd-lessons_course' => $course_1,
            'sfwd-lessons_lesson_video_url' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl',
            'sfwd-lessons_lesson_video_shown' => 'AFTER',
            'sfwd-lessons_lesson_video_auto_complete_delay' => 0
        ),
        '_ld_custom_meta' => array(
            'duration' => '30:00',
            'content_type' => 'fas fa-play-circle'
        )
    )
));

$topic_1 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Overview',
    'post_type' => 'sfwd-topic',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'duration' => '09:00',
            'content_type' => 'fas fa-play-circle',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-topic' => array(
            'sfwd-topic_course' => $course_1,
            'sfwd-topic_lesson' => $lesson_1,
        ),
        'course_id' => $course_1,
        'lesson_id' => $lesson_1
    )
));

$topic_2 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Why Digital Marketing',
    'post_type' => 'sfwd-topic',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'duration' => '11:00',
            'content_type' => 'fas fa-play-circle',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-topic' => array(
            'sfwd-topic_course' => $course_1,
            'sfwd-topic_lesson' => $lesson_1,
        ),
        'course_id' => $course_1,
        'lesson_id' => $lesson_1
    )
));

$topic_3 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Content Strategy 1',
    'post_type' => 'sfwd-topic',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'duration' => '09:00',
            'content_type' => 'fas fa-play-circle',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-topic' => array(
            'sfwd-topic_course' => $course_1,
            'sfwd-topic_lesson' => $lesson_2,
        ),
        'course_id' => $course_1,
        'lesson_id' => $lesson_2
    )
));

$topic_4 = SF_Demo_Installer::add_custom_post_type( array(
    'title' => 'Content Strategy 2',
    'post_type' => 'sfwd-topic',
    'post_content' => $ld_post_content,
    'post_meta' => array(
        '_ld_custom_meta' => array(
            'duration' => '11:00',
            'content_type' => 'far fa-file-alt',
            'embed_code' => 'https://youtu.be/hcSTaMhZi64?list=PLMIlFhwbCGsLxz1aw2IUEJqjzt7HP2jJl'
        ),
        '_sfwd-topic' => array(
            'sfwd-topic_course' => $course_1,
            'sfwd-topic_lesson' => $lesson_2,
        ),
        'course_id' => $course_1,
        'lesson_id' => $lesson_2
    )
));

// share lessons topic accross all courses

$ld_course_steps = array(
    'h' => array(
        'sfwd-lessons' => array(
            $lesson_1 => array(
                'sfwd-topic' => array(
                    $topic_1 => array(
                        'sfwd-quiz' => array()
                    ),
                    $topic_2 => array(
                        'sfwd-quiz' => array()
                    )
                ),
                'sfwd-quiz' => array()
            ),
            $lesson_2 => array(
                'sfwd-topic' => array(
                    $topic_3 => array(
                        'sfwd-quiz' => array()
                    ),
                    $topic_4 => array(
                        'sfwd-quiz' => array()
                    )
                ),
                'sfwd-quiz' => array()
            ),
            $lesson_3 => array( 'sfwd-topic' => array(), 'sfwd-quiz' => array() ),
            $lesson_4 => array( 'sfwd-topic' => array(), 'sfwd-quiz' => array() ),
            $lesson_5 => array( 'sfwd-topic' => array(), 'sfwd-quiz' => array() ),
            $lesson_6 => array( 'sfwd-topic' => array(), 'sfwd-quiz' => array() ),
            $lesson_7 => array( 'sfwd-topic' => array(), 'sfwd-quiz' => array() )
        )
    ),
    't' => array(
        'sfwd-lessons' => array(
            $lesson_1,
            $lesson_2,
            $lesson_3,
            $lesson_4,
            $lesson_5,
            $lesson_6,
            $lesson_7
        ),
        'sfwd-topic' => array(
            $topic_1,
            $topic_2,
            $topic_3,
            $topic_4
        )
    ),
    'r' => array(
        'sfwd-lessons:'. $lesson_1 => array(),
        'sfwd-topic:'. $topic_1 => array( 'sfwd-lessons:'. $lesson_1 ),
        'sfwd-topic:'. $topic_2 => array( 'sfwd-lessons:'. $lesson_1 ),
        'sfwd-lessons:'. $lesson_2,
        'sfwd-topic:'. $topic_3 => array( 'sfwd-lessons:'. $lesson_2 ),
        'sfwd-topic:'. $topic_4 => array( 'sfwd-lessons:'. $lesson_2 ),
        'sfwd-lessons:'. $lesson_3 => array(),
        'sfwd-lessons:'. $lesson_4 => array(),
        'sfwd-lessons:'. $lesson_5 => array(),
        'sfwd-lessons:'. $lesson_6 => array(),
        'sfwd-lessons:'. $lesson_7 => array()
    ),
    'l' => array(
        'sfwd-lessons:'. $lesson_1,
        'sfwd-topic:'. $topic_1,
        'sfwd-topic:'. $topic_2,
        'sfwd-lessons:'. $lesson_2,
        'sfwd-topic:'. $topic_3,
        'sfwd-topic:'. $topic_4,
        'sfwd-lessons:'. $lesson_3,
        'sfwd-lessons:'. $lesson_4,
        'sfwd-lessons:'. $lesson_5,
        'sfwd-lessons:'. $lesson_6,
        'sfwd-lessons:'. $lesson_7
    )
);

for ( $i = 2; $i < 13; $i++ ) {
    update_post_meta( ${'course_'.$i}, 'ld_course_steps', $ld_course_steps );

    for ( $j = 1; $j < 8; $j++ ) {
        update_post_meta( ${'lesson_'.$j}, 'ld_course_'.${'course_'.$i}, ${'course_'.$i} );
    }
}