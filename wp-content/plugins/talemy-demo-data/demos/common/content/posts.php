<?php

$demo_data_cats = array(
    array(
        'name' => 'Business',
        'taxonomy' => 'category',
        'args' => array(
            'description' => 'Some category description goes here.',
        )
    ),
    array(
        'name' => 'Design',
        'taxonomy' => 'category',
    ),
    array(
        'name' => 'Development',
        'taxonomy' => 'category',
        'args' => array(
            'description' => 'Some category description goes here.',
        )
    ),
    array(
        'name' => 'Health & Fitness',
        'taxonomy' => 'category',
    ),
    array(
        'name' => 'Marketing',
        'taxonomy' => 'category',
    ),
    array(
        'name' => 'Music',
        'taxonomy' => 'category',
    ),
    array(
        'name' => 'Technology',
        'taxonomy' => 'category',
    )
);

foreach ( $demo_data_cats as $demo_cat ) {
    $term_args = isset( $demo_cat['args'] ) ? $demo_cat['args'] : array();
    SF_Demo_Installer::add_term( $demo_cat['name'], $demo_cat['taxonomy'], $term_args );
}

/** Posts **/

/* ------------------- Business ----------------- */
SF_Demo_Installer::add_post( array(
     'title' => '5 Reason to Start a Home Business',
     'categories' => array( 'business' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
));

SF_Demo_Installer::add_post( array(
     'title' => 'Achieve Business Success: Ask Good Questions',
     'categories' => array( 'business' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
));

SF_Demo_Installer::add_post( array(
     'title' => 'Business Tips Every Entrepreneur Needs To Know',
     'categories' => array( 'business' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
));

SF_Demo_Installer::add_post( array(
     'title' => 'How to Plan Your Business',
     'categories' => array( 'business' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
));

$demo_post_sidebar_right = SF_Demo_Installer::add_post( array(
     'title' => '7 Ways To Increase Your Net Worth',
     'categories' => array( 'business' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
));

SF_Demo_Installer::add_post( array(
     'title' => 'Steps to a Successful Online Marketing Campaign',
     'categories' => array( 'business' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
));

/* ------------------- Design ----------------- */
SF_Demo_Installer::add_post( array(
     'title' => 'How to design a business card on Photoshop',
     'categories' => array( 'design' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
));

SF_Demo_Installer::add_post( array(
     'title' => 'Ultimate Guide to Product Design',
     'categories' => array( 'design' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
     'post_format' => 'gallery',
));

/* ------------------- Development ----------------- */
SF_Demo_Installer::add_post( array(
     'title' => 'The Complete iOS App Development Bootcamp',
     'categories' => array( 'development' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

SF_Demo_Installer::add_post( array(
     'title' => 'The Web Developer Bootcamp',
     'categories' => array( 'design' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

/* ------------------- Health & Fitness ----------------- */
SF_Demo_Installer::add_post( array(
     'title' => 'How to Stay Healthy Without Meat',
     'categories' => array( 'health-fitness' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

SF_Demo_Installer::add_post( array(
     'title' => 'The 12 Best Milk-Free Sources of Calcium',
     'categories' => array( 'health-fitness' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

/* ------------------- Music ----------------- */
SF_Demo_Installer::add_post( array(
     'title' => 'Fundamentals of Music Theory',
     'categories' => array( 'music' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

SF_Demo_Installer::add_post( array(
     'title' => 'How to Make Music Online',
     'categories' => array( 'music' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

/* ------------------- Marketing ----------------- */
SF_Demo_Installer::add_post( array(
     'title' => 'Marketing Fundamentals',
     'categories' => array( 'marketing' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

SF_Demo_Installer::add_post( array(
     'title' => 'Social Media Marketing',
     'categories' => array( 'marketing' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

/* ------------------- Technolog ----------------- */
SF_Demo_Installer::add_post( array(
     'title' => 'Should you Root Your Android Phone?',
     'categories' => array( 'technology' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));

SF_Demo_Installer::add_post( array(
     'title' => 'Mobile Changed Our Life For Better Or For Worse?',
     'categories' => array( 'technology' ),
     'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
));