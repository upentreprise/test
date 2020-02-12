<?php
/**
 * Demo 1
 */

/** Options **/
$theme_options = array();
$options = array(
	'permalink_structure' => '/%postname%/',
	'elementor_disable_color_schemes' => 'yes',
	'elementor_disable_typography_schemes' => 'yes',
	'elementor_container_width' => 1200,
	'elementor_page_title_selector' => '.post-header',
	'elementor_cpt_support' => array( 'post', 'page', 'sfwd-courses', 'sfwd-lessons', 'sfwd-topic' )
);

// Breadcrumb NavXT settings
$bcn_options = get_option( 'bcn_options' );
if ( is_array( $bcn_options ) ) {
	$bcn_options['hseparator'] = '<span class="sep fas fa-chevron-right"></span>';
	$bcn_options['Hhome_template'] = '<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="Go to %title%." href="%link%" class="%type%"><span class="fas fa-home"></span><span property="name">%htitle%</span></a><meta property="position" content="%position%"></span>';
	$bcn_options['Hhome_template_no_anchor'] = '<span property="itemListElement" typeof="ListItem"><span class="fas fa-home"></span><span property="name">%htitle%</span><meta property="position" content="%position%"></span>';
	$options['bcn_options'] = $bcn_options;
}

/** Images **/
$demo_img_1 = $demo_img_2 = $demo_img_3 = $demo_img_4 = $demo_img_5 = $demo_img_6 = $demo_img_7 = $demo_img_8 = $demo_img_9 = $demo_img_10 = $demo_img_11 = $demo_img_12 =$demo_img_13 = $demo_img_14 = $demo_img_15 = $demo_img_16 = $demo_img_17 = $demo_img_18 = $demo_img_email_icon = '';

if ( 'all' == $demo_data || in_array( 'images', $demo_data ) ) {
	$use_image_placeholder = apply_filters( 'sf_demo_use_image_placeholder', true );
	if ( $use_image_placeholder ) {
		$demo_img_1 = $demo_img_2 = $demo_img_3 = $demo_img_4 = $demo_img_5 = $demo_img_6 = $demo_img_7 = $demo_img_8 = $demo_img_9 = $demo_img_10 = $demo_img_11 = $demo_img_12 =$demo_img_13 = $demo_img_14 = $demo_img_15 = $demo_img_16 = $demo_img_17 = $demo_img_18 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2019/05/demo_image.jpg' );
	} else {
		$demo_img_1 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/58.jpg' );
		$demo_img_2 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/19.jpg' );
		$demo_img_3 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/22.jpg' );
		$demo_img_4 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/34.jpg' );
		$demo_img_5 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/37.jpg' );
		$demo_img_6 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/38.jpg' );
		$demo_img_7 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/41.jpg' );
		$demo_img_8 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/50.jpg' );
		$demo_img_9 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/51.jpg' );
		$demo_img_10 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/52.jpg' );
		$demo_img_11 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/53.jpg' );
		$demo_img_12 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/6.jpg' );
		$demo_img_13 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/60.jpg' );
		$demo_img_14 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/61.jpg' );
		$demo_img_15 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/62.jpg' );
		$demo_img_16 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/63.jpg' );
		$demo_img_17 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/64.jpg' );
		$demo_img_18 = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/08/65.jpg' );
	}
}

$demo_img_logo = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/one-course/wp-content/uploads/sites/17/2018/09/logo_light.png' );
$demo_img_logo_url = wp_get_attachment_image_src( $demo_img_logo, 'full' );
$theme_options['logo'] = $demo_img_logo_url[0];
$demo_img_email_icon = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/one-course/wp-content/uploads/sites/17/2019/04/newsletter.png' );


if ( 'all' == $demo_data || in_array( 'posts', $demo_data ) ) {
	/** Categories **/

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
	 	'featured' => $demo_img_1,
	 	'categories' => array( 'business' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'Achieve Business Success: Ask Good Questions',
	 	'featured' => $demo_img_2,
	 	'categories' => array( 'business' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'Business Tips Every Entrepreneur Needs To Know',
	 	'featured' => $demo_img_3,
	 	'categories' => array( 'business' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'How to Plan Your Business',
	 	'featured' => $demo_img_4,
	 	'categories' => array( 'business' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
	));

	$demo_post_sidebar_right = SF_Demo_Installer::add_post( array(
	 	'title' => '7 Ways To Increase Your Net Worth',
	 	'featured' => $demo_img_5,
	 	'categories' => array( 'business' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'Steps to a Successful Online Marketing Campaign',
	 	'featured' => $demo_img_6,
	 	'categories' => array( 'business' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
	));

	/* ------------------- Design ----------------- */
	SF_Demo_Installer::add_post( array(
	 	'title' => 'How to design a business card on Photoshop',
	 	'featured' => $demo_img_7,
	 	'categories' => array( 'design' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' )
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'Ultimate Guide to Product Design',
	 	'featured' => $demo_img_8,
	 	'categories' => array( 'design' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	 	'post_format' => 'gallery',
	));

	/* ------------------- Development ----------------- */
	SF_Demo_Installer::add_post( array(
	 	'title' => 'The Complete iOS App Development Bootcamp',
	 	'featured' => $demo_img_9,
	 	'categories' => array( 'development' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'The Web Developer Bootcamp',
	 	'featured' => $demo_img_10,
	 	'categories' => array( 'design' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	/* ------------------- Health & Fitness ----------------- */
	SF_Demo_Installer::add_post( array(
	 	'title' => 'How to Stay Healthy Without Meat',
	 	'featured' => $demo_img_11,
	 	'categories' => array( 'health-fitness' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'The 12 Best Milk-Free Sources of Calcium',
	 	'featured' => $demo_img_12,
	 	'categories' => array( 'health-fitness' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	/* ------------------- Music ----------------- */
	SF_Demo_Installer::add_post( array(
	 	'title' => 'Fundamentals of Music Theory',
	 	'featured' => $demo_img_13,
	 	'categories' => array( 'music' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'How to Make Music Online',
	 	'featured' => $demo_img_14,
	 	'categories' => array( 'music' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	/* ------------------- Marketing ----------------- */
	SF_Demo_Installer::add_post( array(
	 	'title' => 'Marketing Fundamentals',
	 	'featured' => $demo_img_15,
	 	'categories' => array( 'marketing' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'Social Media Marketing',
	 	'featured' => $demo_img_16,
	 	'categories' => array( 'marketing' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	/* ------------------- Technolog ----------------- */
	SF_Demo_Installer::add_post( array(
	 	'title' => 'Should you Root Your Android Phone?',
	 	'featured' => $demo_img_17,
	 	'categories' => array( 'technology' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));

	SF_Demo_Installer::add_post( array(
	 	'title' => 'Mobile Changed Our Life For Better Or For Worse?',
	 	'featured' => $demo_img_18,
	 	'categories' => array( 'technology' ),
	 	'tags' => array( 'blog', 'course', 'lesson', 'topic', 'quiz' ),
	));
}


/** Pages **/

if ( 'all' == $demo_data || in_array( 'pages', $demo_data ) ) {
	
	$demo_homepage_menu_id = SF_Demo_Installer::add_menu( 'demo-homepage-menu' );
	
	SF_Demo_Installer::add_menu_item_link( $demo_homepage_menu_id, array(
		'parent_id' => 0,
		'title' => 'Home',
		'url' => home_url( '/' ),
	));

	SF_Demo_Installer::add_menu_item_link( $demo_homepage_menu_id, array(
		'parent_id' => 0,
		'title' => 'Overview',
		'url' => '#overview'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_homepage_menu_id, array(
		'parent_id' => 0,
		'title' => 'Features',
		'url' => '#features'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_homepage_menu_id, array(
		'parent_id' => 0,
		'title' => 'Pricing',
		'url' => '#pricing'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_homepage_menu_id, array(
		'parent_id' => 0,
		'title' => 'Instructor',
		'url' => '#instructor'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_homepage_menu_id, array(
		'parent_id' => 0,
		'title' => 'FAQs',
		'url' => '#faqs'
	));

	SF_Demo_Installer::add_menu_item_page( $demo_homepage_menu_id, array(
		'parent_id' => 0,
		'post_id' => $demo_page_contact,
		'title' => 'Contact'
	));

	$demo_page_homepage = SF_Demo_Installer::add_elementor_page( array(
		'file' => TALEMY_DEMO_DIR . 'demos/one-course/pages/home_one_course.json',
		'post_meta' => array(
			'_wp_page_template' => 'elementor_header_footer',
			'_sf_menu' => $demo_homepage_menu_id
		)
	));

	$demo_page_blog = SF_Demo_Installer::add_page( array( 'title' => 'Blog' ) );
	$demo_page_profile = SF_Demo_Installer::add_page( array(
		'title' => esc_html__( 'Profile', 'talemy-demo-data' ),
		'post_content' => '[ld_profile]',
		'post_meta' => array(
			'_sf_layout' => 'full-width'
		)
	));

	$demo_page_about_us = SF_Demo_Installer::add_elementor_page( array(
		'file' => TALEMY_DEMO_DIR . 'demos/one-course/pages/about_us.json',
		'post_meta' => array(
			'_wp_page_template' => 'page-builder.php'
		)
	));

	$demo_page_about_us_2 = SF_Demo_Installer::add_elementor_page( array(
		'file' => TALEMY_DEMO_DIR . 'demos/one-course/pages/about_us_2.json',
		'post_meta' => array(
			'_wp_page_template' => 'page-builder.php'
		)
	));

	$demo_page_contact = SF_Demo_Installer::add_elementor_page( array(
		'file' => TALEMY_DEMO_DIR . 'demos/one-course/pages/contact_us.json',
		'post_meta' => array(
			'_wp_page_template' => 'page-builder.php'
		)
	));

	$demo_page_faqs = SF_Demo_Installer::add_elementor_page( array(
		'file' => TALEMY_DEMO_DIR . 'demos/one-course/pages/faqs.json',
		'post_meta' => array(
			'_wp_page_template' => 'page-builder.php'
		)
	));

	$demo_page_research = SF_Demo_Installer::add_elementor_page( array(
		'file' => TALEMY_DEMO_DIR . 'demos/one-course/pages/research.json',
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
}


/** Contact Form 7 **/

if ( defined( 'WPCF7_VERSION' ) ) {
	SF_Demo_Installer::add_custom_post_type( array(
		'title' => 'Request for quote',
		'post_type' => 'wpcf7_contact_form',
		'post_meta' => array(
			'_form' => '<p>[text* your-name placeholder "Name*"]</p>
<p>[email* your-email akismet:author_email placeholder "Email*"]</p>
<p>[text your-phone placeholder "Phone Number*"]</p>
<p>[select your-subject "I would like to discuss" "Primary School" "Secondary School"]</p>
<p>[submit class:btn class:btn-secondary class:btn-block "Submit"]</p>',
			'_mail' => array(
				'active' => 1,
				'subject' =>
					/* translators: 1: blog name, 2: [your-subject] */
					sprintf(
						_x( '%1$s "%2$s"', 'mail subject', 'talemy-demo' ),
						get_bloginfo( 'name' ), '[your-subject]' ),
				'sender' => sprintf( '[your-name] <%s>', get_option( 'admin_email' ) ),
				'body' =>
					/* translators: %s: [your-name] <[your-email]> */
					sprintf( __( 'From: %s', 'talemy-demo' ),
						'[your-name] <[your-email]>' ) . "\n"
					/* translators: %s: [your-subject] */
					. sprintf( __( 'Subject: %s', 'talemy-demo' ),
						'[your-subject]' ) . "\n"
					. sprintf( __( 'Phone: %s', 'talemy-demo' ),
						'[your-phone]' ) . "\n\n"
					. __( 'Message Body:', 'talemy-demo' )
						. "\n" . '[your-message]' . "\n\n"
					. '-- ' . "\n"
					/* translators: 1: blog name, 2: blog URL */
					. sprintf(
						__( 'This e-mail was sent from a contact form on %1$s (%2$s)', 'talemy-demo' ),
						get_bloginfo( 'name' ),
						home_url( '/' ) ),
				'recipient' => get_option( 'admin_email' ),
				'additional_headers' => 'Reply-To: [your-email]',
				'attachments' => '',
				'use_html' => 0,
				'exclude_blank' => 0
			)
		)
	));

	SF_Demo_Installer::add_custom_post_type( array(
		'title' => 'Send message',
		'post_type' => 'wpcf7_contact_form',
		'post_meta' => array(
			'_form' => '<div class="row sm-gutters">
<p class="col-md-4">[text* your-name placeholder "Name*"]</p>
<p class="col-md-4">[email* your-email placeholder "Email*"]</p>
<p class="col-md-4">[text your-subject placeholder "Subject"]</p>
</div>
<p>[textarea* your-message x4 placeholder "Message*"]</p>
<p class="text-center">[submit class:btn class:btn-primary "Send"]</p>',
			'_mail' => array(
				'active' => 1,
				'subject' =>
					/* translators: 1: blog name, 2: [your-subject] */
					sprintf(
						_x( '%1$s "%2$s"', 'mail subject', 'talemy-demo' ),
						get_bloginfo( 'name' ), '[your-subject]' ),
				'sender' => sprintf( '[your-name] <%s>', get_option( 'admin_email' ) ),
				'body' =>
					/* translators: %s: [your-name] <[your-email]> */
					sprintf( __( 'From: %s', 'talemy-demo' ),
						'[your-name] <[your-email]>' ) . "\n"
					/* translators: %s: [your-subject] */
					. sprintf( __( 'Subject: %s', 'talemy-demo' ),
						'[your-subject]' ) . "\n\n"
					. __( 'Message Body:', 'talemy-demo' )
						. "\n" . '[your-message]' . "\n\n"
					. '-- ' . "\n"
					/* translators: 1: blog name, 2: blog URL */
					. sprintf(
						__( 'This e-mail was sent from a contact form on %1$s (%2$s)', 'talemy-demo' ),
						get_bloginfo( 'name' ),
						home_url( '/' ) ),
				'recipient' => get_option( 'admin_email' ),
				'additional_headers' => 'Reply-To: [your-email]',
				'attachments' => '',
				'use_html' => 0,
				'exclude_blank' => 0
			)
		)
	));
}


/** Mailchimp **/

if ( defined( 'MC4WP_VERSION' ) ) {
	SF_Demo_Installer::add_custom_post_type( array(
			'title' => 'mail form 3',
			'post_type' => 'mc4wp-form',
			'post_content' => '<div class="row footer-newsletter-1">
  <div class="col-md-4">
    <h4 class="newsletter-title" style="background-image:url('. $demo_img_email_icon .');"><span>OUR NEWSLETTER</span></h4>
  </div>
  <div class="col-md-8">
    <div class="newsletter-form">
    	<input type="email" name="EMAIL" placeholder="E-mail Address" required />
    	<button type="submit" class="btn btn-sm btn-secondary sf-submit">Subscribe Now</button>
    </div>
  </div>
</div>'
	));
}

/** LearnDash **/

if ( defined( 'LEARNDASH_VERSION' ) && ( 'all' == $demo_data || in_array( 'courses', $demo_data ) ) ) {

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

	$demo_img_certificate = SF_Demo_Installer::add_media_image( 'https://talemy.themespirit.com/wp-content/uploads/2018/10/certificate.png' );
	$demo_certificate = SF_Demo_Installer::add_custom_post_type( array(
		'title' => 'Sample Certificate',
		'featured' => $demo_img_certificate,
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

	$ld_course_content = TALEMY_DEMO_DIR . 'demos/one-course/pages/course_content.json';

	$course_1 = SF_Demo_Installer::add_elementor_page( array(
	 	'title' => 'The Complete Digital Marketing Bootcamp',
	 	'slug' => 'the-complete-digital-marketing-bootcamp',
	 	'file' => $ld_course_content,
	 	'featured' => $demo_img_1,
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
	 	'featured' => $demo_img_2,
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
	 	'featured' => $demo_img_3,
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
	 	'featured' => $demo_img_4,
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
	 	'featured' => $demo_img_5,
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
	 	'featured' => $demo_img_6,
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
	 	'featured' => $demo_img_7,
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
	 	'featured' => $demo_img_8,
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
	 	'featured' => $demo_img_9,
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
	 	'featured' => $demo_img_10,
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
	 	'featured' => $demo_img_11,
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
	 	'featured' => $demo_img_12,
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
	 	'featured' => $demo_img_13,
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
	 	'featured' => $demo_img_14,
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
	 	'featured' => $demo_img_15,
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
	 	'featured' => $demo_img_16,
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
	 	'featured' => $demo_img_17,
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
	 	'featured' => $demo_img_18,
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
	 	'featured' => $demo_img_1,
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
	 	'featured' => $demo_img_3,
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
	 	'featured' => $demo_img_4,
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
	 	'featured' => $demo_img_5,
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
	 	'featured' => $demo_img_6,
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
}


/** Events Calendar **/

if ( defined( 'TRIBE_EVENTS_FILE' ) && ( 'all' == $demo_data || in_array( 'events', $demo_data ) ) ) {

	$tribe_options = get_option( 'tribe_events_calendar_options' );

	if ( isset( $tribe_options ) && is_array( $tribe_options ) ) {
		$tribe_options['stylesheetOption'] = 'skeleton';
		$tribe_options['hideSubsequentRecurrencesDefault'] = true;
		$tribe_options['tribeEventsTemplate'] = '';
	}
	update_option( 'tribe_events_calendar_options', $tribe_options );

	SF_Demo_Installer::add_term( 'Art', 'tribe_events_cat' );
	
	$event_content = 'Maecenas leo nisi, efficitur at felis sit amet, lacinia auctor quam. Aliquam euismod pretium mattis. Aenean sollicitudin orci non orci gravida ullamcorper. Duis utres odios pellentesque, efficiturs odio vitae, aliquams arcu. Sed pulvinar lacus at neque imperdiet lobortis. Phasellus eget lectus rutrum, fringilla nibh ut, convallis orci. Quisque magna risus, lacinia a pharetra vel, gravida ac mi. Aenean ac interdum nisi, et vehicula nisl. Suspendisse potenti. Cras leo ex, congue eget dignissim nec, porta maximus erat. Etiam ornare arcu neque, in viverra eros egestas eu. Mauris diam velit, dictum et vehicula nec, sagittis nec sapien. Donec tincidunt purus et justo porttitor, non porttitor quam fermentum orci non aliquams arcu dolores ipsums.

Donec maximus a ante sit amet nisl nisi at arcu. Donec lobortis libero ex, a sollicitudin neque volutpat. Aenean pretium nisi id lectus cursus sagittis. Aliquam sit amet nisl pretium, consectetur purus non, porta libero. Integer dui dui, porta non mollis sit amet, pharetra nec risus. Donec fringilla ex non arcu auctor, vel faucibus felis pharetra. Pellentesque condimentum suscipit mi. Sed pretium, tellus et efficitur dapibus, metus nunc gravida ante, at interdum nisl nisi at arcu. Donec lobortis libero ex, a sollicitudin neque dapibus vitae. Maecenas volutpat est sit amet leo pretium mollis eu a odio dolores ipsums ficilis etras.’,
‘post_excerpt’ => ‘Maecenas leo nisi, efficitur at felis sit amet, lacinia auctor quam. Aliquam euismod pretium mattis. Aenean sollicitudin orci non orci gravida ullamcorper.';

	$event_excerpt = 'Maecenas leo nisi, efficitur at felis sit amet, lacinia auctor quam. Aliquam euismod pretium mattis. Aenean sollicitudin orci non orci gravida ullamcorper. Duis utres odios pellentesque, efficiturs odio vitae, aliquams arcu. Sed pulvinar lacus at neque imperdiet lobortis. Phasellus eget lectus rutrum, fringilla nibh ut, convallis orci.';

	$event_time = date( 'Y-m' );

	$event_venue = SF_Demo_Installer::add_custom_post_type( array(
	 	'title' => 'South Campus',
	 	'post_type' => 'tribe_venue',
	 	'post_content' => $event_excerpt,
	 	'post_meta' => array(
		 	'_VenueOrigin' => 'events-calendar',
		 	'_VenueAddress' => '1234 Apple Avenue',
		 	'_VenueCity' => 'New York',
		 	'_VenueCountry' => 'United States',
		 	'_VenueState' => 'NY',
		 	'_VenueZip' => '111111',
		 	'_VenuePhone' => '800-123-4567',
		 	'_VenueURL' => 'https://talemy.themespirit.com',
		 	'_VenueShowMap' => 'true',
	 	)
	));

	$event_organizer = SF_Demo_Installer::add_custom_post_type( array(
	 	'title' => 'Talemy University',
	 	'featured' => $demo_img_1,
	 	'post_type' => 'tribe_organizer',
	 	'post_content' => $event_excerpt,
	 	'post_meta' => array(
		 	'_OrganizerOrigin' => 'events-calendar',
		 	'_OrganizerOrganizerID' => '1001',
		 	'_OrganizerPhone' => '800-123-4567',
		 	'_OrganizerWebsite' => 'https://talemy.themespirit.com',
		 	'_OrganizerEmail' => 'support@themespirit.com',
	 	)
	));

	SF_Demo_Installer::add_custom_post_type(array(
	 	'title' => 'Hack Night',
	 	'featured' => $demo_img_2,
	 	'post_type' => 'tribe_events',
	 	'post_content' => $event_content,
	 	'post_excerpt' => $event_excerpt,
	 	'post_meta' => array(
		 	'_EventOrigin' => 'events-calendar',
		 	'_EventShowMapLink' => '1',
		 	'_EventShowMap' => '1',
		 	'_EventStartDate' => $event_time .'-18 20:00:00',
		 	'_EventEndDate' => $event_time .'-18 23:00:00',
		 	'_EventURL' => 'https://talemy.themespirit.com',
		 	'_EventTimezone' => '',
		 	'_EventOrganizerID' => $event_organizer,
		 	'_EventVenueID' => $event_venue,
		 	'_EventRecurrence' => array(
		 		'rules' => array(
		 			array(
		 				'type' => 'Custom',
		 				'custom' => array(
		 					'interval' => 1,
		 					'month' => array(),
		 					'same-time' => 'yes',
		 					'type' => 'Monthly',
		 				),
		 				'end-type' => 'Never',
		 				'EventStartDate' => $event_time .'-18 20:00:00',
		 				'EventEndDate' => $event_time .'-18 23:00:00'
		 			)
		 		),
		 		'exclusions' => array(),
		 		'description' => ''
		 	)
	 	),
	 	'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
	));

	SF_Demo_Installer::add_custom_post_type(array(
	 	'title' => 'Kids Festival',
	 	'featured' => $demo_img_3,
	 	'post_type' => 'tribe_events',
	 	'post_content' => $event_content,
	 	'post_excerpt' => $event_excerpt,
	 	'post_meta' => array(
		 	'_EventOrigin' => 'events-calendar',
		 	'_EventShowMapLink' => '1',
		 	'_EventShowMap' => '1',
		 	'_EventAllDay' => 'yes',
		 	'_EventStartDate' => $event_time .'-20',
		 	'_EventEndDate' => $event_time .'-20',
		 	'_EventURL' => 'https://talemy.themespirit.com',
		 	'_EventTimezone' => '',
		 	'_EventOrganizerID' => $event_organizer,
		 	'_EventVenueID' => $event_venue,
		 	'_EventRecurrence' => array(
		 		'rules' => array(
		 			array(
		 				'type' => 'Custom',
		 				'custom' => array(
		 					'interval' => 1,
		 					'month' => array(),
		 					'same-time' => 'yes',
		 					'type' => 'Monthly',
		 				),
		 				'end-type' => 'Never',
		 				'EventStartDate' => $event_time .'-20 00:00:00',
		 				'EventEndDate' => $event_time .'-20 23:59:59'
		 			)
		 		),
		 		'exclusions' => array(),
		 		'description' => ''
		 	)
	 	),
	 	'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
	));

	SF_Demo_Installer::add_custom_post_type(array(
	 	'title' => 'Wonders of the Night Sky Show',
	 	'featured' => $demo_img_4,
	 	'post_type' => 'tribe_events',
	 	'post_content' => $event_content,
	 	'post_excerpt' => $event_excerpt,
	 	'post_meta' => array(
		 	'_EventOrigin' => 'events-calendar',
		 	'_EventShowMapLink' => '1',
		 	'_EventShowMap' => '1',
		 	'_EventStartDate' => $event_time .'-20 08:00:00',
		 	'_EventEndDate' => $event_time .'-20 11:00:00',
		 	'_EventCurrencySymbol' => '$',
		 	'_EventCost' => '100',
		 	'_EventURL' => 'https://talemy.themespirit.com',
		 	'_EventTimezone' => '',
		 	'_EventOrganizerID' => $event_organizer,
		 	'_EventVenueID' => $event_venue,
		 	'_EventRecurrence' => array(
		 		'rules' => array(
		 			array(
		 				'type' => 'Custom',
		 				'custom' => array(
		 					'interval' => 1,
		 					'month' => array(),
		 					'same-time' => 'yes',
		 					'type' => 'Monthly',
		 				),
		 				'end-type' => 'Never',
		 				'EventStartDate' => $event_time .'-20 08:00:00',
		 				'EventEndDate' => $event_time .'-20 11:00:00'
		 			)
		 		),
		 		'exclusions' => array(),
		 		'description' => ''
		 	)
	 	),
	 	'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
	));

	SF_Demo_Installer::add_custom_post_type(array(
	 	'title' => 'Yoga Day',
	 	'featured' => $demo_img_5,
	 	'post_type' => 'tribe_events',
	 	'post_content' => $event_content,
	 	'post_excerpt' => $event_excerpt,
	 	'post_meta' => array(
		 	'_EventOrigin' => 'events-calendar',
		 	'_EventShowMapLink' => '1',
		 	'_EventShowMap' => '1',
		 	'_EventAllDay' => 'yes',
		 	'_EventStartDate' => $event_time .'-21 00:00:00',
		 	'_EventEndDate' => $event_time .'-21 23:59:59',
		 	'_EventURL' => 'https://talemy.themespirit.com',
		 	'_EventTimezone' => '',
		 	'_EventOrganizerID' => $event_organizer,
		 	'_EventVenueID' => $event_venue,
		 	'_EventRecurrence' => array(
		 		'rules' => array(
		 			array(
		 				'type' => 'Custom',
		 				'custom' => array(
		 					'interval' => 1,
		 					'month' => array(),
		 					'same-time' => 'yes',
		 					'type' => 'Monthly',
		 				),
		 				'end-type' => 'Never',
		 				'EventStartDate' => $event_time .'-21 00:00:00',
		 				'EventEndDate' => $event_time .'-21 23:59:59'
		 			)
		 		),
		 		'exclusions' => array(),
		 		'description' => ''
		 	)
	 	),
	 	'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
	));

	SF_Demo_Installer::add_custom_post_type(array(
	 	'title' => 'English Study Group Meetup',
	 	'featured' => $demo_img_6,
	 	'post_type' => 'tribe_events',
	 	'post_content' => $event_content,
	 	'post_excerpt' => $event_excerpt,
	 	'post_meta' => array(
		 	'_EventOrigin' => 'events-calendar',
		 	'_EventShowMapLink' => '1',
		 	'_EventShowMap' => '1',
		 	'_EventStartDate' => $event_time .'-23 08:00:00',
		 	'_EventEndDate' => $event_time .'-23 11:00:00',
		 	'_EventCurrencySymbol' => '$',
		 	'_EventCost' => '30',
		 	'_EventURL' => 'https://talemy.themespirit.com',
		 	'_EventTimezone' => '',
		 	'_EventOrganizerID' => $event_organizer,
		 	'_EventVenueID' => $event_venue,
		 	'_EventRecurrence' => array(
		 		'rules' => array(
		 			array(
		 				'type' => 'Custom',
		 				'custom' => array(
		 					'interval' => 1,
		 					'month' => array(),
		 					'same-time' => 'yes',
		 					'type' => 'Monthly',
		 				),
		 				'end-type' => 'Never',
		 				'EventStartDate' => $event_time .'-23 08:00:00',
		 				'EventEndDate' => $event_time .'-23 11:00:00'
		 			)
		 		),
		 		'exclusions' => array(),
		 		'description' => ''
		 	)
	 	),
	 	'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
	));

	SF_Demo_Installer::add_custom_post_type(array(
	 	'title' => 'WordPress Group Meetup',
	 	'featured' => $demo_img_7,
	 	'post_type' => 'tribe_events',
	 	'post_content' => $event_content,
	 	'post_excerpt' => $event_excerpt,
	 	'post_meta' => array(
		 	'_EventOrigin' => 'events-calendar',
		 	'_EventShowMapLink' => '1',
		 	'_EventShowMap' => '1',
		 	'_EventStartDate' => $event_time .'-10 09:00:00',
		 	'_EventEndDate' => $event_time .'-10 11:00:00',
		 	'_EventURL' => 'https://talemy.themespirit.com',
		 	'_EventTimezone' => '',
		 	'_EventOrganizerID' => $event_organizer,
		 	'_EventVenueID' => $event_venue,
		 	'_EventRecurrence' => array(
		 		'rules' => array(
		 			array(
		 				'type' => 'Custom',
		 				'custom' => array(
		 					'interval' => 1,
		 					'montly' => array(),
		 					'same-time' => 'yes',
		 					'type' => 'Monthly',
		 				),
		 				'end-type' => 'Never',
		 				'EventStartDate' => $event_time .'-10 09:00:00',
		 				'EventEndDate' => $event_time .'-10 11:00:00'
		 			)
		 		),
		 		'exclusions' => array(),
		 		'description' => ''
		 	)
	 	),
	 	'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
	));


	SF_Demo_Installer::add_custom_post_type(array(
	 	'title' => 'Guided Tours',
	 	'featured' => $demo_img_8,
	 	'post_type' => 'tribe_events',
	 	'post_content' => $event_content,
	 	'post_excerpt' => $event_excerpt,
	 	'post_meta' => array(
		 	'_EventOrigin' => 'events-calendar',
		 	'_EventShowMapLink' => '1',
		 	'_EventShowMap' => '1',
		 	'_EventStartDate' => $event_time .'-07 08:00:00',
		 	'_EventEndDate' => $event_time .'-07 11:00:00',
		 	'_EventCurrencySymbol' => '$',
		 	'_EventCost' => '80',
		 	'_EventURL' => 'https://talemy.themespirit.com',
		 	'_EventTimezone' => '',
		 	'_EventOrganizerID' => $event_organizer,
		 	'_EventVenueID' => $event_venue,
		 	'_EventRecurrence' => array(
		 		'rules' => array(
		 			array(
		 				'type' => 'Custom',
		 				'custom' => array(
		 					'interval' => 1,
		 					'montly' => array(),
		 					'same-time' => 'yes',
		 					'type' => 'Monthly',
		 				),
		 				'end-type' => 'Never',
		 				'EventStartDate' => $event_time .'-07 08:00:00',
		 				'EventEndDate' => $event_time .'-07 11:00:00'
		 			)
		 		),
		 		'exclusions' => array(),
		 		'description' => ''
		 	)
	 	),
	 	'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
	));

	SF_Demo_Installer::add_custom_post_type(array(
	 	'title' => 'Serenity Art Exhibition',
	 	'featured' => $demo_img_9,
	 	'post_type' => 'tribe_events',
	 	'post_content' => $event_content,
	 	'post_excerpt' => $event_excerpt,
	 	'post_meta' => array(
		 	'_EventOrigin' => 'events-calendar',
		 	'_EventShowMapLink' => '1',
		 	'_EventShowMap' => '1',
		 	'_EventStartDate' => $event_time .'-10 20:00:00',
		 	'_EventEndDate' => $event_time .'-10 21:00:00',
		 	'_EventCurrencySymbol' => '$',
		 	'_EventCost' => '50',
		 	'_EventURL' => 'https://talemy.themespirit.com',
		 	'_EventTimezone' => '',
		 	'_EventOrganizerID' => $event_organizer,
		 	'_EventVenueID' => $event_venue,
		 	'_EventRecurrence' => array(
		 		'rules' => array(
		 			array(
		 				'type' => 'Custom',
		 				'custom' => array(
		 					'interval' => 1,
		 					'month' => array(),
		 					'same-time' => 'yes',
		 					'type' => 'Monthly',
		 				),
		 				'end-type' => 'Never',
		 				'EventStartDate' => $event_time .'-10 20:00:00',
		 				'EventEndDate' => $event_time .'-10 21:00:00'
		 			)
		 		),
		 		'exclusions' => array(),
		 		'description' => ''
		 	)
	 	),
	 	'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
	));

}


/** Menus **/

if ( 'all' == $demo_data ) {
	$demo_main_menu_id = SF_Demo_Installer::add_menu( 'demo-main-menu', array( 'main', 'side' ) );
	$demo_footer_menu_id = SF_Demo_Installer::add_menu( 'demo-footer-menu', array( 'footer' ) );
	$demo_account_menu_id = SF_Demo_Installer::add_menu( 'demo-account-menu', array( 'account' ) );
	$theme_options['nav_menu_locations'] = array( 'main' => $demo_main_menu_id, 'side' => $demo_main_menu_id, 'footer' => $demo_footer_menu_id, 'account' => $demo_account_menu_id );

	$demo_main_menu_item_home = SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => 0,
		'title' => 'Home',
		'url' => home_url( '/' ),
	));

	SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_home,
		'title' => 'Demo Default',
		'url' => 'https://talemy.themespirit.com/demo-1/'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_home,
		'title' => 'Demo University',
		'url' => 'https://talemy.themespirit.com/university/'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_home,
		'title' => 'Demo High School',
		'url' => 'https://talemy.themespirit.com/high-school/'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_home,
		'title' => 'Demo Online Learning',
		'url' => 'https://talemy.themespirit.com/online-learning/'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_home,
		'title' => 'Demo One Course',
		'url' => 'https://talemy.themespirit.com/one-course/'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_home,
		'title' => 'Demo One Instructor',
		'url' => 'https://talemy.themespirit.com/one-instructor/'
	));

	$demo_main_menu_item_pages = SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => 0,
		'title' => 'Pages',
		'url' => '#'
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_pages,
		'post_id' => $demo_page_about_us
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_pages,
		'post_id' => $demo_page_about_us_2
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_pages,
		'post_id' => $demo_page_contact
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_pages,
		'post_id' => $demo_page_faqs
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_pages,
		'post_id' => $demo_page_research
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_pages,
		'post_id' => $demo_page_login
	));

	SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_pages,
		'title' => '404 Page',
		'url' => home_url( '/404', is_ssl() ? 'https' : 'http' )
	));

	if ( defined( 'LEARNDASH_VERSION' ) && ( 'all' == $demo_data || in_array( 'courses', $demo_data ) ) ) {
		$demo_main_menu_item_courses = SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
			'parent_id' => 0,
			'title' => 'Courses',
			'url' => '#'
		));

		SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
			'parent_id' => $demo_main_menu_item_courses,
			'post_id' => $course_4,
			'title' => 'Free Course'
		));


		SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
			'parent_id' => $demo_main_menu_item_courses,
			'post_id' => $course_1,
			'title' => 'Paid Course'
		));

		SF_Demo_Installer::add_menu_item_post_type_archive( $demo_main_menu_id, array(
			'parent_id' => $demo_main_menu_item_courses,
			'post_type' => 'sfwd-courses',
			'title' => 'Course Grid'
		));

		SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
			'parent_id' => $demo_main_menu_item_courses,
			'post_id' => $demo_page_course_list,
			'title' => 'Course List'
		));
	}

	SF_Demo_Installer::add_menu_item_post_type_archive( $demo_main_menu_id, array(
		'parent_id' => 0,
		'post_type' => 'tribe_events',
		'title' => 'Events'
	));

	$demo_main_menu_item_elements = SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => 0,
		'title' => 'Elements',
		'url' => '#',
		'_sf_megamenu' => array(
			'type' => 'mega_menu',
			'width' => '4'
		)
	));

	$demo_main_menu_item_elements_set_1 = SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements,
		'title' => 'Elements Set 1',
		'url' => '#',
		'_sf_megamenu' => array(
			'hide_title' => 1
		)
	));

	$demo_main_menu_item_elements_set_2 = SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements,
		'title' => 'Elements Set 2',
		'url' => '#',
		'_sf_megamenu' => array(
			'hide_title' => 1
		)
	));

	$demo_main_menu_item_elements_set_3 = SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements,
		'title' => 'Elements Set 3',
		'url' => '#',
		'_sf_megamenu' => array(
			'hide_title' => 1
		)
	));

	$demo_main_menu_item_elements_set_4 = SF_Demo_Installer::add_menu_item_link( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements,
		'title' => 'Elements Set 4',
		'url' => '#',
		'_sf_megamenu' => array(
			'hide_title' => 1
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_1,
		'post_id' => $demo_page_accordion,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-th-list'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_1,
		'post_id' => $demo_page_buttons,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-link'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_1,
		'post_id' => $demo_page_countdown,
		'_sf_megamenu' => array(
			'icon' => 'far fa-clock'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_1,
		'post_id' => $demo_page_icon_box,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-cube'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_2,
		'post_id' => $demo_page_info_box,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-cubes'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_2,
		'post_id' => $demo_page_gallery,
		'_sf_megamenu' => array(
			'icon' => 'far fa-images'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_2,
		'post_id' => $demo_page_number_counter,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-sort-numeric-up'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_2,
		'post_id' => $demo_page_pricing_table,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-table'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_3,
		'post_id' => $demo_page_progress_bars,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-chart-bar'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_3,
		'post_id' => $demo_page_team_members,
		'_sf_megamenu' => array(
			'icon' => 'far fa-user'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_3,
		'post_id' => $demo_page_testimonials,
		'_sf_megamenu' => array(
			'icon' => 'far fa-comment-alt'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_3,
		'post_id' => $demo_page_woo_products,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-shopping-cart'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_4,
		'post_id' => $demo_page_block_courses,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-th-large'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_4,
		'post_id' => $demo_page_block_posts,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-th-large'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_4,
		'post_id' => $demo_page_course_categories,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-th'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => $demo_main_menu_item_elements_set_4,
		'post_id' => $demo_page_course_search,
		'_sf_megamenu' => array(
			'icon' => 'fas fa-search'
		)
	));

	SF_Demo_Installer::add_menu_item_page( $demo_main_menu_id, array(
		'parent_id' => 0,
		'post_id' => $demo_page_blog
	));

	/** Footer menu **/
	SF_Demo_Installer::add_menu_item_link( $demo_footer_menu_id, array(
		'parent_id' => 0,
		'title' => 'Privacy Policy',
		'url' => '#'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_footer_menu_id, array(
		'parent_id' => 0,
		'title' => 'Terms',
		'url' => '#'
	));

	SF_Demo_Installer::add_menu_item_link( $demo_footer_menu_id, array(
		'parent_id' => 0,
		'title' => 'Sitemap',
		'url' => '#'
	));

	SF_Demo_Installer::add_menu_item_page( $demo_footer_menu_id, array(
		'parent_id' => 0,
		'post_id' => $demo_page_contact,
		'title' => 'Contact'
	));

	SF_Demo_Installer::add_menu_item_page( $demo_account_menu_id, array(
		'parent_id' => 0,
		'post_id' => $demo_page_profile
	));
}


/** Widgets **/

if ( 'all' == $demo_data || in_array( 'widgets', $demo_data ) ) {

	SF_Demo_Installer::add_widget_to_sidebar(
		'topbar-left',
		'custom_html',
		array(
			'title' => '',
			'content' => '<ul><li><a href="tel:001012345678"><i class="fas fa-phone text-secondary"></i>Hotline 001 012 345 678</a></li><li><a href="mailto:info@talemy.com"><i class="far fa-envelope text-secondary"></i>info@talemy.com</a></li></ul>'
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'topbar-right',
		'sf-social-icons',
		array(
			'title' => '',
			'url_source' => 'mods',
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'default-sidebar',
		'search',
		array(
			'title' => ''
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'default-sidebar',
		'recent-posts',
		array(
			'title' => '',
			'number' => 5,
			'show_date' => false
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'default-sidebar',
		'categories',
		array(
			'title' => '',
			'count' => false,
			'hierarchical' => false,
			'dropdown' => false
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'default-sidebar',
		'tag-cloud',
		array()
	);
	
	SF_Demo_Installer::add_widget_to_sidebar(
		'footer-top',
		'sf-about-site',
		array(
			'title' => '',
			'logo' => $demo_img_logo_url[0],
			'retina_logo' => '',
			'logo_width' => 135,
			'logo_height' => 43,
			'description' => '',
			'show_social' => 1
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'footer-bottom',
		'mc4wp_form_widget',
		array(
			'title' => ''
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'footer-1',
		'text',
		array(
			'title' => 'About Course',
			'text' => 'Talemy is your ideal education WordPress theme for sharing and selling your knowledge online. Teach what you love. Talemy gives you the tools to create an online course.',
			'filter' => false,
			'visual' => null
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'footer-2',
		'sf-contact-info',
		array(
			'title' => 'Get In Touch',
			'item_icon_1' => 'fas fa-map-marker-alt',
			'item_text_1' => '205 West 21th Street, MIAMI FL, USA',
			'item_icon_2' => 'fas fa-phone',
			'item_text_2' => '(800) 123-4567',
			'item_icon_3' => 'fas fa-envelope',
			'item_text_3' => 'info@talemy.com'
		)
	);

	SF_Demo_Installer::add_widget_to_sidebar(
		'footer-3',
		'custom_html',
		array(
			'title' => 'Working Hours',
			'content' => '<ul class="office-hours">
	<li>Monday - Friday <span class="float-right text-white">8:00 am - 16.00 pm</span></li>
	<li>Saturday <span class="float-right text-white">10:00 am - 14.00 pm</span></li>
	<li>Sunday <span class="float-right text-white">9:00 am - 12.00 pm</span></li>
</ul>'
		)
	);
}

/** Theme Options **/

if ( 'all' == $demo_data || in_array( 'options', $demo_data ) ) {
	SF_Demo_Installer::install_theme_options( TALEMY_DEMO_DIR . 'demos/one-course/options.json' );
	SF_Demo_Installer::update_theme_options( $theme_options );
}

SF_Demo_Installer::update_options( $options );

