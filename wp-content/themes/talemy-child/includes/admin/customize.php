<?php

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( !class_exists('Kirki') ) {
	return;
}

/* -----------------------------------------------------------------------------
 * Add panels & sections
 * ----------------------------------------------------------------------------- */
$panels = array(
	'header' => array( esc_html__( 'Header', 'talemy' ), 22 ),
	'templates' => array( esc_html__( 'Templates', 'talemy' ), 23 ),
	'list_settings' => array( esc_html__( 'List Settings', 'talemy' ), 23 ),
	'typography' => array( esc_html__( 'Typography', 'talemy' ), 24 ),
	'learndash' => array( esc_html__( 'LearnDash', 'talemy' ), 50 ),
	'woocommerce' => array( esc_html__( 'Woocommerce', 'talemy' ), 51 ),
	'events' => array( esc_html__( 'Events Calendar', 'talemy' ), 52 ),
);

foreach ( $panels as $panel_id => $panel ) {
	Kirki::add_panel( $panel_id, array(
		'title'    => $panel[0],
		'priority' => isset( $panel[1] ) ? $panel[1] : '',
	) );
}

$sections = array(
	// top sections
	'footer' => array( esc_html__( 'Footer', 'talemy' ), '', 22 ),
	'social' => array( esc_html__( 'Social Links', 'talemy' ), esc_html__( 'Enter URL of your social profile', 'talemy' ), 23 ),
	'styling' => array( esc_html__( 'Styling', 'talemy' ), '', 27 ),
	'custom_css' => array( esc_html__( 'Custom CSS', 'talemy' ), esc_html__( 'Add your Custom CSS code here. Any Custom CSS entered here will override the theme CSS. In some cases, the !important rules may be needed.', 'talemy' ), 28 ),
	'advanced' => array( esc_html__( 'Advanced', 'talemy' ), '', 29 ),
	'misc' => array( esc_html__( 'Miscellaneous', 'talemy' ), '', 30 ),
	'bbpress' => array( esc_html__( 'bbPress', 'talemy' ), '', 31 ),
	'buddypress' => array( esc_html__( 'BuddyPress', 'talemy' ), '', 31 ),
	// sub sections
	'header_header' => array( esc_html__( 'Header', 'talemy' ), '', 10, 'header' ),
	'header_topbar' => array( esc_html__( 'Top Bar', 'talemy' ), '', 10, 'header' ),
	'header_navbar' => array( esc_html__( 'Nav Bar', 'talemy' ), '', 10, 'header' ),
	'header_main_menu' => array( esc_html__( 'Main Menu', 'talemy' ), '', 10, 'header' ),
	'header_off_canvas' => array( esc_html__( 'Off-Canvas', 'talemy' ), '', 10, 'header' ),
	'list_style_grid' => array( esc_html__( 'Grid', 'talemy' ), '', 10, 'list_settings' ),
	'list_style_list' => array( esc_html__( 'List', 'talemy' ), '', 10, 'list_settings' ),
	'list_style_masonry' => array( esc_html__( 'Masonry', 'talemy' ), '', 10, 'list_settings' ),
	'template_banner' => array( esc_html__( 'Banner', 'talemy' ), '', 10, 'templates' ),
	'template_post' => array( esc_html__( 'Post', 'talemy' ), '', 10, 'templates' ),
	'template_page' => array( esc_html__( 'Page', 'talemy' ), '', 10, 'templates' ),
	'template_category' => array( esc_html__( 'Category', 'talemy' ), '', 10, 'templates' ),
	'template_tag' => array( esc_html__( 'Tag', 'talemy' ), '', 10, 'templates' ),
	'template_author' => array( esc_html__( 'Author', 'talemy' ), '', 10, 'templates' ),
	'template_archive' => array( esc_html__( 'Archive', 'talemy' ), '', 10, 'templates' ),
	'template_search' => array( esc_html__( 'Search', 'talemy' ), '', 10, 'templates' ),
	'template_home' => array( esc_html__( 'Blog', 'talemy' ), '', 10, 'templates' ),
	'template_attachment' => array( esc_html__( 'Attachment', 'talemy' ), '', 10, 'templates' ),
	'template_error' => array( esc_html__( '404 Page', 'talemy' ), '', 10, 'templates' ),
	'wc_general' => array( esc_html__( 'General', 'talemy' ), '', 10, 'woocommerce' ),
	'wc_product' => array( esc_html__( 'Product Page', 'talemy' ), '', 10, 'woocommerce' ),
	'ec_general' => array( esc_html__( 'General', 'talemy' ), '', 10, 'events' ),
	'ec_single' => array( esc_html__( 'Single Event', 'talemy' ), '', 10, 'events' ),
	'ec_theme' => array( esc_html__( 'Theme', 'talemy' ), '', 10, 'events' ),
	'typography_body' => array( esc_html__( 'Body', 'talemy' ), '', 10, 'typography' ),
	'typography_heading' => array( esc_html__( 'H1 - H6', 'talemy' ), '', 10, 'typography' ),
	'typography_section_heading' => array( esc_html__( 'Section Heading', 'talemy' ), '', 10, 'typography' ),
	'ld_general' => array( esc_html__( 'General', 'talemy' ), '', 10,
		'learndash'
	),
	'ld_courses' => array( esc_html__( 'Course Archive', 'talemy' ), '', 10,
		'learndash'
	),
	'ld_course' => array( esc_html__( 'Course Single', 'talemy' ), '', 10,
		'learndash'
	),
	'ld_lessons' => array( esc_html__( 'Lessons', 'talemy' ), '', 10,
		'learndash'
	)
);

foreach ( $sections as $section_id => $section ) {
	$section_args = array(
		'title'       => $section[0],
		'description' => $section[1],
		'priority'    => $section[2]
	);
	if ( isset( $section[3] ) ) {
		$section_args['panel'] = $section[3];
	}
	Kirki::add_section( $section_id, $section_args );
}

/* -----------------------------------------------------------------------------
 * Add control fields
 * ----------------------------------------------------------------------------- */
function talemy_customizer_settings( $controls ) {

	// logo
	$controls[] = array(
		'type'        => 'image',
		'settings'    => 'logo',
		'label'       => esc_html__( 'Logo', 'talemy' ),
		'section'     => 'title_tagline',
		'default'     => '',
		'priority'    => 50
	);

	$controls[] = array(
		'type'        => 'image',
		'settings'    => 'logo_retina',
		'label'       => esc_html__( 'Retina Logo', 'talemy' ),
		'description' => esc_html__( '2x size of Logo', 'talemy' ),
		'section'     => 'title_tagline',
		'default'     => '',
		'priority'    => 50
	);

	$controls[] = array(
		'type'        => 'dimensions',
		'settings'    => 'logo_dimensions',
		'description' => esc_html__( 'eg. 168px', 'talemy' ),
		'label'       => esc_html__( 'Logo Dimensions', 'talemy' ),
		'section'     => 'title_tagline',
		'priority'    => 50,
		'default'     => array(
			'width'  => '',
			'height' => '',
		),
	);

	$controls[] = array(
		'type'        => 'image',
		'settings'    => 'logo_alt',
		'label'       => esc_html__( 'Mobile & Sticky Logo', 'talemy' ),
		'description' => esc_html__( 'An alternative logo for mobile and sticky navbar', 'talemy' ),
		'section'     => 'title_tagline',
		'default'     => '',
		'priority'    => 50
	);

	$controls[] = array(
		'type'        => 'image',
		'settings'    => 'logo_alt_retina',
		'label'       => esc_html__( 'Mobile & Sticky Retina Logo', 'talemy' ),
		'section'     => 'title_tagline',
		'default'     => '',
		'priority'    => 50
	);


	// general

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'page_loader',
		'label'       => esc_html__( 'Page Loader Style', 'talemy' ),
		'section'     => 'misc',
		'default'     => 'wave',
		'priority'    => 10,
		'choices'     => array(
			'none' => esc_html__( 'No Loader', 'talemy' ),
			'line' => esc_html__( 'Line', 'talemy' ),
			'circle' => esc_html__( 'Circle', 'talemy' ),
			'pulse' => esc_html__( 'Pulse', 'talemy' ),
			'square-spin' => esc_html__( 'Square Spin', 'talemy' ),
			'wave' => esc_html__( 'Wave', 'talemy' )
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'page_loading_bg',
		'label'       => esc_html__( 'Loading Screen Color', 'talemy' ),
		'section'     => 'misc',
		'default'     => '#FFFFFF',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => array( '.site-overlay' ),
				'property' => 'background',
				'exclude' => array( '#FFFFFF' ),
			)
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'sticky_sidebar',
		'label'       => esc_html__( 'Sticky Sidebar', 'talemy' ),
		'section'     => 'misc',
		'default'     => true,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'disable_megamenu',
		'label'       => esc_html__( 'Disable Mega Menu', 'talemy' ),
		'section'     => 'misc',
		'default'     => false,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'hide_sidebar_on_xs',
		'label'       => esc_html__( 'Hide Sidebar On Small Screen', 'talemy' ),
		'section'     => 'misc',
		'default'     => false,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'scroll_top',
		'label'       => esc_html__( 'Show Scroll Top', 'talemy' ),
		'section'     => 'misc',
		'default'     => true,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'loop_thumb_placeholder',
		'label'       => esc_html__( 'Show Thumb Placeholder', 'talemy' ),
		'section'     => 'misc',
		'default'     => false,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'loop_date_format',
		'label'       => esc_html__( 'List Date Format', 'talemy' ),
		'description' => '<a href="https://codex.wordpress.org/Formatting_Date_and_Time" target="_blank">' . esc_html__( 'Documentation on date and time formatting', 'talemy' ) . '</a>',
		'section'     => 'misc',
		'default'     => '',
		'priority'    => 10,
	);
	

	// footer

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'footer_top',
		'label'       => esc_html__( 'Show Footer Top', 'talemy' ),
		'section'     => 'footer',
		'default'     => true,
	);

	$controls[] = array(
		'type'        => 'radio-image',
		'settings'    => 'footer_top_style',
		'label'       => esc_html__( 'Footer Top Style', 'talemy' ),
		'section'     => 'footer',
		'default'     => '1',
		'choices'     => array(
			'1' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/ft1.jpg',
			'2' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/ft2.jpg',
			'3' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/ft3.jpg',
			'4' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/ft4.jpg',
			'5' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/ft5.jpg',
			'6' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/ft6.jpg',
		),
		'active_callback'  => array(
			array(
				'setting'  => 'footer_top',
				'operator' => '==',
				'value'    => 1,
			)
		),
	);

	$controls[] = array(
		'type'        => 'radio-image',
		'settings'    => 'footer_bottom_style',
		'label'       => esc_html__( 'Footer Bottom Style', 'talemy' ),
		'section'     => 'footer',
		'default'     => '3',
		'choices'     => array(
			'1' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/fb1.jpg',
			'2' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/fb2.jpg',
			'3' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/fb3.jpg',
			'4' => TALEMY_THEME_URI . 'includes/admin/assets/images/footer/fb4.jpg',
		)
	);

	$controls[] = array(
		'type'        => 'textarea',
		'settings'    => 'footer_copyright',
		'label'       => esc_html__( 'Footer Copyright Text', 'talemy' ),
		'description' => esc_html__( '%%year%% will be replaced with current year, e.g. 2018. %%sitename%% will be replaced with site title.', 'talemy' ),
		'section'     => 'footer',
		'default'     => '© %%year%% <a href="https://talemy.themespirit.com" target="_blank">%%sitename%%</a>. All Rights Reserved.',
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'footer_heading_1',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Footer Styling', 'talemy' ) .'</div>',
	    'section'     => 'footer',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'background',
		'settings'    => 'footer_bg',
		'label'       => esc_html__( 'Footer Background', 'talemy' ),
		'section'     => 'footer',
		'default'     => array( 'background-color' => '#222' ),
		'output'	  => array( array( 'element' => '#footer' ) )
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'footer_title_style',
		'label'       => esc_html__( 'Title Style', 'talemy' ),
		'section'     => 'footer',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'' => esc_html__( 'Default', 'talemy' ),
			'1' => esc_html__( 'Style 1', 'talemy' ),
			'2' => esc_html__( 'Style 2', 'talemy' ),
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_title_color',
		'label'       => esc_html__( 'Title Color', 'talemy' ),
		'section'     => 'footer',
		'default'     => '#FFFFFF',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => '.footer-top .widget-title',
				'property' => 'color',
				'exclude' => array( '#FFFFFF' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_text_color',
		'label'       => esc_html__( 'Text Color', 'talemy' ),
		'section'     => 'footer',
		'default'     => '#BABABA',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => '#footer',
				'property' => 'color',
				'exclude' => array( '#BABABA' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'footer_link_color',
		'label'       => esc_html__( 'Link Color', 'talemy' ),
		'section'     => 'footer',
		'priority'    => 10,
		'alpha'       => true,
		'choices'     => array(
			'default'    => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' ),
		),
		'default'     => array(
			'default'    => '#BABABA',
			'hover'   => '#f5b417',
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array(
					'#footer a',
					'#footer strong'
				),
				'property' => 'color',
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'#footer a:hover',
				),
				'property' => 'color',
			)
		)
	);

	$controls[] = array(
		'type'        => 'number',
		'settings'    => 'footer_top_border_width',
		'label'       => esc_html__( 'Top Border Width', 'talemy' ),
		'section'     => 'footer',
		'default'     => 0,
		'choices'     => array(
			'min' => 0,
			'max' => 300,
			'step' => 1
		),
		'output' => array(
			array(
				'element' => array(
					'#footer'
				),
				'property' => 'border-top-width',
				'exclude' => array( 0 ),
				'suffix' => 'px'
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_top_border_color',
		'label'       => esc_html__( 'Top Border Color', 'talemy' ),
		'section'     => 'footer',
		'default'     => '#e0e0e0',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array(
					'#footer'
				),
				'property' => 'border-top-color',
				'exclude' => array( '#e0e0e0' )
			),
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_border_color',
		'label'       => esc_html__( 'Border Color', 'talemy' ),
		'section'     => 'footer',
		'default'     => '#585858',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array(
					'#footer .selectric',
					'#footer .sf-input',
					'#footer input:not(.btn)',
					'#footer select'
				),
				'property' => 'border-color',
				'exclude' => array( '#585858' )
			),
			array(
				'element' => array(
					'#footer .selectric .button'
				),
				'property' => 'color',
				'exclude' => array( '#585858' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_divider_color',
		'label'       => esc_html__( 'Divider Color', 'talemy' ),
		'section'     => 'footer',
		'default'     => '#393939',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array(
					'.footer-top .top-widget-area',
					'.footer-top .bottom-widget-area'
				),
				'property' => 'border-color',
				'exclude' => array( '#393939' ),
			)
		)
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'footer_heading_2',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Footer Top Styling', 'talemy' ) .'</div>',
	    'section'     => 'footer',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'background',
		'settings'    => 'footer_top_bg',
		'label'       => esc_html__( 'Footer Top Background', 'talemy' ),
		'section'     => 'footer',
		'default'     => array( 'background-color' => '' ),
		'output'	  => array( array( 'element' => '.footer-top' ) )
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_top1_bg_color',
		'label'       => esc_html__( 'Column 1 Background', 'talemy' ),
		'section'     => 'footer',
		'default'     => '',
		'output'	  => array(
			array(
				'element' => array( '.footer-top .footer-1', '.footer-top .footer-1:before' ),
				'property' => 'background-color',
				'media_query' => '@media (min-width:768px)',
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_top2_bg_color',
		'label'       => esc_html__( 'Column 2 Background', 'talemy' ),
		'section'     => 'footer',
		'default'     => '',
		'output'	  => array(
			array(
				'element' => array( '.footer-top .footer-2' ),
				'property' => 'background-color',
				'media_query' => '@media (min-width:768px)',
			)
		)
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'footer_heading_3',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Footer Bottom Styling', 'talemy' ) .'</div>',
	    'section'     => 'footer',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_bottom_bg_color',
		'label'       => esc_html__( 'Footer Bottom Background', 'talemy' ),
		'section'     => 'footer',
		'default'     => '',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => '.footer-bottom',
				'property' => 'background-color',
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'footer_bottom_text_color',
		'label'       => esc_html__( 'Footer Bottom Text Color', 'talemy' ),
		'section'     => 'footer',
		'default'     => '#bababa',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array(
					'#footer .footer-bottom',
					'#footer .footer-menu a',
					'#footer .footer-bottom .scroll-top'
				),
				'property' => 'color',
				'exclude' => array( '#bababa' ),
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'footer_bottom_link_color',
		'label'       => esc_html__( 'Link Color', 'talemy' ),
		'section'     => 'footer',
		'priority'    => 10,
		'alpha'       => true,
		'choices'     => array(
			'default'    => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' ),
		),
		'default'     => array(
			'default'    => '#f5b417',
			'hover'   => '#ffffff',
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array(
					'#footer .footer-copyright a'
				),
				'property' => 'color',
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'#footer .footer-menu a:hover',
					'#footer .footer-copyright a:hover',
					'#footer .footer-bottom .scroll-top:hover'
				),
				'property' => 'color'
			)
		)
	);

	/* -----------------------------------------------------------------------------
	 * Colors
	 * ----------------------------------------------------------------------------- */

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'primary_color',
		'label'       => esc_html__( 'Primary Color', 'talemy' ),
		'section'     => 'styling',
		'default'     => '#41246d',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array(
					'.btn-primary:hover',
					'.btn-outline-primary',
					'.btn-outline-primary.disabled',
					'.btn-outline-primary:disabled',
					'.btn-link:hover',
					'.error-title',
					'.sf-heading__subtitle',
					// learndash
					'.loop-post .ld-add-to-cart .loop_cart_button:hover',
					'.learndash-wrapper #btn-join:hover',
					'.learndash-wrapper .btn-join:hover',
					'.course-sidebar .ld-add-to-cart .loop_cart_button',
					'.ld-add-to-cart .loop_cart_button + .added_to_cart',
					'.ld-item__type-icon',
					'.course-meta .course-meta__price',
					// woocommerce
					'.woocommerce a.button.alt:hover',
					'.woocommerce button.button.alt:hover',
					'.woocommerce input.button.alt:hover',
					'.woocommerce #respond input#submit.alt:hover',
					'#bbpress-forums>#subscription-toggle .subscription-toggle',
					'#bbpress-forums>#subscription-toggle .subscription-toggle.disabled',
					'#bbpress-forums>#subscription-toggle .subscription-toggle:disabled',
					// buddypress
					'.buddypress .buddypress-wrap button.button.edit:focus',
					'.buddypress .buddypress-wrap input[type=button]:focus',
					'.buddypress .buddypress-wrap input[type=submit]:focus',
					'.buddypress .buddypress-wrap .button.wp-generate-pw:focus',
					'.buddypress .buddypress-wrap button.button.edit:hover',
					'.buddypress .buddypress-wrap input[type=button]:hover',
					'.buddypress .buddypress-wrap input[type=submit]:hover',
					'.buddypress .buddypress-wrap .button.wp-generate-pw:hover',
					'.buddypress .buddypress-wrap .activity-list .load-more a',
					'.buddypress .buddypress-wrap .activity-list .load-newest a',
				),
				'property' => 'color',
				'exclude' => array( '#41246d' ),
			),
			array(
				'element' => array(
					'#loader.line',
					'.sf-circle .sf-child:before',
					'.sf-spinner-pulse',
					'.sf-square-spin > div',
					'.sf-wave .sf-rect',
					'.btn-primary',
					'.btn-primary.disabled',
					'.btn-primary:disabled',
					'.btn-outline-primary:hover',
					'.btn-outline-primary:not(.disabled):active',
					'.btn-outline-primary:not(.disabled).active',
					'.show > .btn-outline-primary.dropdown-toggle',
					'.sf-submit .fa',
					'.loop-post .ld-add-to-cart .loop_cart_button',
					'.learndash-wrapper #btn-join',
					'.learndash-wrapper .btn-join',
					'.course-sidebar .ld-add-to-cart .loop_cart_button:hover',
					'.ld-add-to-cart .loop_cart_button + .added_to_cart:hover',
					'.widget_tag_cloud a:hover',
					'.widget_product_tag_cloud a:hover',
					'.post-tags a:hover',
					'.post-category a',
					'.topbar-btn-wrapper:after',
					'.topbar-btn',
					'.header-style-6 .nav-menu>li>a:before',
					'.header-style-6 .nav-menu>li>a:hover:before',
					'.header-style-6 .nav-menu>.current-menu-ancestor>a:before',
					'.header-style-6 .nav-menu>.current-menu-parent>a:before',
					'.header-style-6 .nav-menu>.current-menu-item>a:before',
					'.pagination .page-numbers:hover',
					'.pagination .page-numbers:focus',
					'.pagination .page-numbers.current',
					'.pagination .page-numbers.current:hover',
					'.pagination .page-numbers.current:focus',
					'.comment-list .comment-reply-link:hover',
					'.sf-swiper-pagination .swiper-pagination-bullet-active',
					'.events-slider-nav',
					'.info-boxes .slider-arrow.prev-slide',
					'.info-box:hover .info-box-icon i',
					'.info-boxes-wrapper:after',
					'.sf-login-tabs a',
					'.footer-title-style-1 .footer-top .widget-title .title:after',
					'.footer-title-style-2 .footer-top .widget-title .title:after',
					'.section-heading .title:after',
					'.rev_slider .talemy-rs-light.tparrows:hover',
					'.rev_slider .talemy-rs-light.tp-bullets .tp-bullet.selected',
					'.rev_slider .talemy-rs-dark.tparrows:hover',
					'.rev_slider .talemy-rs-dark.tp-bullets .tp-bullet.selected',
					'.sf-heading--style-1 .sf-heading:after',
					'.sf-heading--style-2 .sf-heading:before',
					'.sf-gallery__filter.active',
					'.load-next-prev-posts .load-posts',
					'.sf-arrows--skin-1 .sf-swiper-btn:hover',
					'.sf-arrows--skin-2 .sf-swiper-btn:hover',
					'.widget_search .sf-submit .fa-search',
					'.widget_product_search .sf-submit .fa-search',
					// LearnDash
					'.post-badge',
					'.course-tabs .course-tab:hover',
					'.course-tabs .active .course-tab',
					'.course-search__submit',
					'.course-intro',
					// woocommerce
					'.woocommerce span.onsale',
					'.woocommerce a.button.alt',
					'.woocommerce button.button.alt',
					'.woocommerce input.button.alt',
					'.woocommerce #respond input#submit.alt',
					'.woocommerce .widget_price_filter .ui-slider .ui-slider-handle',
					'.woocommerce .widget_price_filter .ui-slider .ui-slider-range',
					// bbPress
					'#bbpress-forums li.bbp-header',
					'#bbpress-forums li.bbp-footer',
					'#bbpress-forums>#subscription-toggle .subscription-toggle:hover',
					'#bbpress-forums>#subscription-toggle .subscription-toggle:not(.disabled):active',
					'#bbpress-forums>#subscription-toggle .subscription-toggle:not(.disabled).active',
					// buddypress
					'.buddypress-wrap .bp-subnavs li.current a',
					'.buddypress-wrap .bp-subnavs li.selected a',
					'.buddypress .buddypress-wrap button.button.edit',
					'.buddypress .buddypress-wrap input[type=button]',
					'.buddypress .buddypress-wrap input[type=submit]',
					'.buddypress .buddypress-wrap .button.wp-generate-pw',
					'.buddypress .buddypress-wrap .activity-list .load-more a:focus',
					'.buddypress .buddypress-wrap .activity-list .load-newest a:focus',
					'.buddypress .buddypress-wrap .activity-list .load-more a:hover',
					'.buddypress .buddypress-wrap .activity-list .load-newest a:hover',
				),
				'property' => 'background-color',
				'exclude' => array( '#41246d' ),
			),
			array(
				'element' => array(
					'#loader.spinner',
					'.btn-primary',
					'.btn-primary:hover',
					'.btn-primary.disabled',
					'.btn-primary:disabled',
					'.btn-outline-primary',
					'.btn-outline-primary:hover',
					'.btn-outline-primary:not(.disabled):active',
					'.btn-outline-primary:not(.disabled).active',
					'.show > .btn-outline-primary.dropdown-toggle',
					'.footer-bottom .scroll-top',
					'.post-pagination .page-nav .fas',
					'.rev_slider .talemy-rs-light.tp-bullets .tp-bullet.selected',
					'.rev_slider .talemy-rs-dark.tp-bullets .tp-bullet.selected',
					// LearnDash
					'.loop-post .ld-add-to-cart .loop_cart_button',
					'.learndash-wrapper #btn-join',
					'.learndash-wrapper .btn-join',
					'.loop-post .ld-add-to-cart .loop_cart_button:hover',
					'.learndash-wrapper #btn-join:hover',
					'.learndash-wrapper .btn-join:hover',
					'.course-sidebar .ld-add-to-cart .loop_cart_button',
					'.ld-add-to-cart .loop_cart_button + .added_to_cart',
					'.course-sidebar .ld-add-to-cart .loop_cart_button:hover',
					'.ld-add-to-cart .loop_cart_button + .added_to_cart:hover',
					// woocommerce
					'.woocommerce a.button.alt',
					'.woocommerce button.button.alt',
					'.woocommerce input.button.alt',
					'.woocommerce #respond input#submit.alt',
					'.woocommerce a.button.alt:hover',
					'.woocommerce button.button.alt:hover',
					'.woocommerce input.button.alt:hover',
					'.woocommerce #respond input#submit.alt:hover',
					// bbpress
					'#bbpress-forums>#subscription-toggle .subscription-toggle',
					'#bbpress-forums>#subscription-toggle .subscription-toggle:hover',
					'#bbpress-forums>#subscription-toggle .subscription-toggle:not(.disabled):active',
					'#bbpress-forums>#subscription-toggle .subscription-toggle:not(.disabled).active',
					// buddypress
					'.buddypress .buddypress-wrap .activity-list .load-more a',
					'.buddypress .buddypress-wrap .activity-list .load-newest a',
					'.buddypress .buddypress-wrap .activity-list .load-more a:focus',
					'.buddypress .buddypress-wrap .activity-list .load-newest a:focus',
					'.buddypress .buddypress-wrap .activity-list .load-more a:hover',
					'.buddypress .buddypress-wrap .activity-list .load-newest a:hover',
					'.buddypress .buddypress-wrap button.button.edit',
					'.buddypress .buddypress-wrap input[type=button]',
					'.buddypress .buddypress-wrap input[type=submit]',
					'.buddypress .buddypress-wrap .button.wp-generate-pw',
					'.buddypress .buddypress-wrap button.button.edit:focus',
					'.buddypress .buddypress-wrap input[type=button]:focus',
					'.buddypress .buddypress-wrap input[type=submit]:focus',
					'.buddypress .buddypress-wrap .button.wp-generate-pw:focus',
					'.buddypress .buddypress-wrap button.button.edit:hover',
					'.buddypress .buddypress-wrap input[type=button]:hover',
					'.buddypress .buddypress-wrap input[type=submit]:hover',
					'.buddypress .buddypress-wrap .button.wp-generate-pw:hover',
				),
				'property' => 'border-color',
				'exclude' => array( '#41246d' )
			),
			array(
				'element' => array(
					'.load-next-prev-posts .prev-posts:after',
					'.info-boxes .slider-arrow.prev-slide .arrow-icon:after',
					'.rev_slider .talemy-rs-light.tparrows:hover.tp-leftarrow:after',
					'.rev_slider .talemy-rs-dark.tparrows:hover.tp-leftarrow:after',
					'.sf-arrows--skin-1 .sf-swiper-btn.sf-swiper-btn-prev:hover:after',
				),
				'property' => 'border-top-color',
				'exclude' => array( '#41246d' )
			),
			array(
				'element' => array(
					'.load-next-prev-posts .next-posts',
					'.load-next-prev-posts .next-posts:after',
					'.rev_slider .talemy-rs-light.tparrows:hover.tp-rightarrow:after',
					'.rev_slider .talemy-rs-dark.tparrows:hover.tp-rightarrow:after',
					'.sf-arrows--skin-1 .sf-swiper-btn.sf-swiper-btn-next:hover:after',
					'.post-comments>.section-heading .title',
					'.post-related>.section-heading .title',
					'.comment-reply-title span'
				),
				'property' => 'border-bottom-color',
				'exclude' => array( '#41246d' )
			),
			array(
				'element' => array(
					'.sf-custom-btn-style-1 .sf-search-form__submit span:before',
				),
				'property' => 'border-bottom-color',
				'exclude' => array( '#41246d' ),
				'media_query' => '@media (min-width: 768px)'
			),
			array(
				'element' => array(
					'.text-primary',
					'.learndash-wrapper .btn-join:hover'
				),
				'property' => 'color',
				'exclude' => array( '#41246d' ),
				'suffix' => '!important'
			),
			array(
				'element' => array(
					'.bg-primary',
				),
				'property' => 'background-color',
				'exclude' => array( '#41246d' ),
				'suffix' => '!important'
			),
			array(
				'element' => array(
					'.sidebar .widget-title .title',
					'.elementor-widget-container .widget-title .title'
				),
				'property' => 'box-shadow',
				'value_pattern' => '0 2px 0 $',
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'secondary_color',
		'label'       => esc_html__( 'Secondary Color', 'talemy' ),
		'section'     => 'styling',
		'default'     => '#f5b417',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array(
					'.hamburger:hover .menu-icon span',
					'.hamburger-2:hover .menu-icon span',
					'#nav-cart .cart-item-count',
					'.nav-btn-cat:hover .icon-category .square',
					'.nav-category-list .cat-item a:hover:before',
					'.block-nav .tab-item.active',
					'.off-canvas-close',
					'#scroll-top',
					'.btn-secondary',
					'.btn-secondary.disabled',
					'.btn-secondary:disabled',
					'.btn-outline-secondary:hover',
					'.btn-outline-secondary:not(.disabled):active',
					'.btn-outline-secondary:not(.disabled).active',
					'.video-play-button',
					'.video-play-button .animation-ripple',
					'.sf-heading__line',
					'.type-sfwd-courses.loop-post .post-thumb>a:before',
				),
				'property' => 'background-color',
				'exclude' => array( '#f5b417' )
			),
			array(
				'element' => array(
					'.btn-secondary',
					'.btn-secondary:hover',
					'.btn-secondary.disabled',
					'.btn-secondary:disabled',
					'.btn-outline-secondary',
					'.btn-outline-secondary:hover',
					'.btn-outline-secondary:not(.disabled):active',
					'.btn-outline-secondary:not(.disabled).active',
					'.contact-info .fas',
					'.loop_cart_button',
					'.loop_cart_button+.added_to_cart',
				),
				'property' => 'border-color',
				'exclude' => array( '#f5b417' )
			),
			array(
				'element' => array(
					'body a:hover',
					'.post-list .post-meta i',
					'.btn-secondary:hover',
					'.btn-outline-secondary',
					'.btn-outline-secondary.disabled',
					'.btn-outline-secondary:disabled',
					'.contact-info-item i',
					'.contact-info .fas',
					'.section-heading .title span',
					'.section-heading.sh-3 .stars .fa-star',
					'.widget_archive ul li:before',
					'.widget_categories ul li:before',
					'.widget_nav_menu ul li:before',
					'.widget_meta ul li:before',
					'.widget_pages ul li:before',
					'.widget_recent_entries ul li:before',
					'.sf-popular-categories ul li:before',
					'.events-countdown-wrapper .post-meta i',
					'.events-slider-item .event-date .fa-calendar-alt',
					'.comment-list .comment-meta .comment-edit-link',
					// LearnDash
					'.course-meta__item .far',
					'.course-meta__item .fas',
					'.course-meta-box__content a:hover',
					'.widget_sfwd-courses-widget ul li:before',
					'.widget_sfwd-lessons-widget ul li:before',
					'.widget_sfwd-quiz-widget ul li:before',
					'.widget_sfwd-certificates-widget ul li:before',
					// woocommerce
					'.widget_product_categories .cat-item:before',
					'.tinv-wishlist .tinvwl_add_to_wishlist_button.tinvwl-icon-heart.no-txt:hover',
					'.tinv-wishlist .tinvwl_add_to_wishlist_button.tinvwl-icon-heart.tinvwl-product-in-list',
					// bbPress
					'.bbp-forum-title:hover',
					'.bbp-forum-freshness a:hover',
					'.bbp-topic-title .bbp-topic-permalink:hover'
				),
				'property' => 'color',
				'exclude' => array( '#f5b417' )
			),
			array(
				'element' => array(
					'.text-secondary',
					'.article-head .breadcrumbs a:hover'
				),
				'property' => 'color',
				'exclude' => array( '#f5b417' ),
				'suffix' => '!important'
			),
			array(
				'element' => array(
					'.bg-secondary',
				),
				'property' => 'background-color',
				'exclude' => array( '#f5b417' ),
				'suffix' => '!important'
			),
			array(
				'element' => array(
					'.single-product div.product form.cart .tinvwl_add_to_wishlist_button.tinvwl-icon-heart.no-txt:hover',
					'.single_add_to_cart_button:hover'
				),
				'property' => 'background-color',
				'exclude' => array( '#f5b417' ),
				'suffix' => '!important'
			),
			array(
				'element' => array(
					'.single-product div.product form.cart .tinvwl_add_to_wishlist_button.tinvwl-icon-heart.no-txt:hover',
					'.single_add_to_cart_button:hover'
				),
				'property' => 'border-color',
				'exclude' => array( '#f5b417' ),
				'suffix' => '!important'
			)
		)
	);


	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'body_link_color',
		'label'       => esc_html__( 'Link Color', 'talemy' ),
		'section'     => 'styling',
		'default'     => '#222222',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array(
					'body a',
				),
				'property' => 'color',
				'exclude' => array( '#222222' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'corner_style',
		'label'       => esc_html__( 'General Corner Style', 'talemy' ),
		'description' => esc_html__( 'Apply to buttons and form elements.', 'talemy' ),
		'section'     => 'styling',
		'default'     => 'sharp',
		'choices'     => array(
			'round' => esc_html__( 'Round Corner', 'talemy' ),
			'sharp' => esc_html__( 'Sharp Corner', 'talemy' )
		)
	);

	$controls[] = array(
		'type'        => 'background',
		'settings'    => 'body_bg',
		'label'       => esc_html__( 'Site Background', 'talemy' ),
		'section'     => 'styling',
		'default'     => array(),
		'output'	  => array( array( 'element' => 'body' ) )
	);

	// loop styles

	// style 1
	
	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'grid_category',
		'label'       => esc_html__( 'Show Category', 'talemy' ),
		'section'     => 'list_style_grid',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'multicheck',
		'settings'    => 'grid_meta_data',
		'label'       => esc_html__( 'Meta Data', 'talemy' ),
		'section'     => 'list_style_grid',
		'default'     => array( 'date', 'author', 'comment' ),
		'priority'    => 10,
		'choices'     => array(
			'date' => esc_html__( 'Date', 'talemy' ),
			'avatar' => esc_html__( 'Avatar', 'talemy' ),
			'author' => esc_html__( 'Author', 'talemy' ),
			'comment' => esc_html__( 'Comment Count', 'talemy' ),
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'grid_excerpt',
		'label'       => esc_html__( 'Show Excerpt', 'talemy' ),
		'section'     => 'list_style_grid',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'number',
		'settings'    => 'grid_excerpt_limit',
		'label'       => esc_html__( 'Excerpt Length', 'talemy' ),
		'section'     => 'list_style_grid',
		'default' 	  => 80,
		'priority'    => 10,
	);

	// style 2

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'list_category',
		'label'       => esc_html__( 'Show Category', 'talemy' ),
		'section'     => 'list_style_list',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'multicheck',
		'settings'    => 'list_meta_data',
		'label'       => esc_html__( 'Meta Data', 'talemy' ),
		'section'     => 'list_style_list',
		'default'     => array( 'date', 'author' ),
		'priority'    => 10,
		'choices'     => array(
			'date' => esc_html__( 'Date', 'talemy' ),
			'avatar' => esc_html__( 'Avatar', 'talemy' ),
			'author' => esc_html__( 'Author', 'talemy' ),
			'comment' => esc_html__( 'Comment Count', 'talemy' ),
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'list_excerpt',
		'label'       => esc_html__( 'Show Excerpt', 'talemy' ),
		'section'     => 'list_style_list',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'number',
		'settings'    => 'list_excerpt_limit',
		'label'       => esc_html__( 'Excerpt Length', 'talemy' ),
		'description' => esc_html__( 'Number of characters.', 'talemy' ),
		'section'     => 'list_style_list',
		'default' 	  => 120,
		'priority'    => 10,
		'choices'     => array(
			'min'  => 0,
			'step' => 1,
		),
	);

	// style masonry

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'masonry_category',
		'label'       => esc_html__( 'Show Category', 'talemy' ),
		'section'     => 'list_style_masonry',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'multicheck',
		'settings'    => 'masonry_meta_data',
		'label'       => esc_html__( 'Meta Data', 'talemy' ),
		'section'     => 'list_style_masonry',
		'default'     => array( 'date', 'author', 'share' ),
		'priority'    => 10,
		'choices'     => array(
			'date' => esc_html__( 'Date', 'talemy' ),
			'avatar' => esc_html__( 'Avatar', 'talemy' ),
			'author' => esc_html__( 'Author', 'talemy' ),
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'masonry_excerpt',
		'label'       => esc_html__( 'Show Excerpt', 'talemy' ),
		'section'     => 'list_style_masonry',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'number',
		'settings'    => 'masonry_excerpt_limit',
		'label'       => esc_html__( 'Excerpt Length', 'talemy' ),
		'description' => esc_html__( 'Number of words.', 'talemy' ),
		'section'     => 'list_style_masonry',
		'default' 	  => 80,
		'priority'    => 10,
		'choices'     => array(
			'min'  => 0,
			'step' => 1,
		)
	);


	// templates

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'banner_bg_overlay',
		'label'       => esc_html__( 'Background Overlay', 'talemy' ),
		'section'     => 'template_banner',
		'default'     => 'rgba(0,0,0,0.6)',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array(
					'.content-banner .banner-overlay'
				),
				'property' => 'background',
				'exclude' => array( 'rgba(0,0,0,0.6)' )
			)
		)
	);
	
	$controls[] = array(
		'type'        => 'background',
		'settings'    => 'banner_bg',
		'label'       => esc_html__( 'Background', 'talemy' ),
		'section'     => 'template_banner',
		'output'	  => array( array( 'element' => '.content-banner' ) )
	);

	// post

	$controls[] = array(
		'type'        => 'radio-image',
		'settings'    => 'post_style',
		'label'       => esc_html__( 'Global Post Style', 'talemy' ),
		'section'     => 'template_post',
		'default'     => '2',
		'priority'    => 10,
		'choices'     => talemy_get_option_post_styles()
	);

	$controls[] = array(
		'type'        => 'radio-image',
		'settings'    => 'post_layout',
		'label'       => esc_html__( 'Content Layout', 'talemy' ),
		'section'     => 'template_post',
		'default'     => 'sidebar-right',
		'priority'    => 10,
		'choices'     => talemy_get_option_post_layouts()
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'post_sidebar',
		'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
		'section'     => 'template_post',
		'default'     => 'default-sidebar',
		'priority'    => 10,
		'choices'     => talemy_get_option_sidebars()
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'post_heading_1',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Page Banner', 'talemy' ) .'</div>',
	    'section'     => 'template_post',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'post_banner',
		'label'       => esc_html__( 'Page Banner', 'talemy' ),
		'section'     => 'template_post',
		'default'     => '',
		'priority'    => 10,
		'choices'     => talemy_get_option_page_banner_options(),
	);

	$controls[] = array(
		'type'        => 'image',
		'settings'    => 'post_banner_image',
		'label'       => esc_html__( 'Banner Image', 'talemy' ),
		'section'     => 'template_post',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'post_banner',
				'operator' => '==',
				'value'    => '',
			)
		),
		'output' => array(
			array(
				'element' => array( '.single-post .content-banner' ),
				'property' => 'background-image',
			)
		)
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'post_banner_shortcode',
		'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
		'section'     => 'template_post',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'post_banner',
				'operator' => '==',
				'value'    => 'shortcode'
			)
		)
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'post_heading_2',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Post Settings', 'talemy' ) .'</div>',
	    'section'     => 'template_post',
	    'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'multicheck',
		'settings'    => 'post_meta_data',
		'label'       => esc_html__( 'Meta Data', 'talemy' ),
		'section'     => 'template_post',
		'default'     => array( 'avatar', 'author', 'date', 'cats', 'comment' ),
		'priority'    => 10,
		'choices'     => array(
			'avatar' => esc_html__( 'Avatar', 'talemy' ),
			'author' => esc_html__( 'Author', 'talemy' ),
			'date' => esc_html__( 'Date', 'talemy' ),
			'cats' => esc_html__( 'Categories', 'talemy' ),
			'comment' => esc_html__( 'Comment Count', 'talemy' )
		)
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'post_time_filter',
		'label'       => esc_html__( 'Time Filter ( Time Ago )', 'talemy' ),
		'section'     => 'template_post',
		'default'     => '86400',
		'priority'    => 10,
		'choices'     => array(
			'none' => esc_html__( 'None', 'talemy' ),
			'86400' => esc_html__( '1 Day', 'talemy' ),
			'604800' => esc_html__( '1 Week', 'talemy' ),
			'2592000' => esc_html__( '1 Month', 'talemy' ),
			'7776000' => esc_html__( '3 Months', 'talemy' ),
			'15552000' => esc_html__( '6 Months', 'talemy' ),
			'31536000' => esc_html__( '1 Year', 'talemy' ),
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'post_tags',
		'label'       => esc_html__( 'Show Post Tags', 'talemy' ),
		'section'     => 'template_post',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'post_adjacent',
		'label'       => esc_html__( 'Show Next & Previous Posts', 'talemy' ),
		'section'     => 'template_post',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'post_author_box',
		'label'       => esc_html__( 'Show Author Box', 'talemy' ),
		'section'     => 'template_post',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'post_comments',
		'label'       => esc_html__( 'Show Post Comments', 'talemy' ),
		'section'     => 'template_post',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'post_related',
		'label'       => esc_html__( 'Show Related Posts', 'talemy' ),
		'section'     => 'template_post',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'post_related_type',
		'label'       => esc_html__( 'Related Type', 'talemy' ),
		'section'     => 'template_post',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'cat' => esc_html__( 'Category', 'talemy' ),
			'tag' => esc_html__( 'Tag', 'talemy' ),
			'cat_or_tag' => esc_html__( 'Category or Tag', 'talemy' ),
			'author' => esc_html__( 'Author', 'talemy' ),
			'' => esc_html__( 'All', 'talemy' )
		)
	);

	$controls[] = array(
		'type'        => 'number',
		'settings'    => 'post_related_count',
		'label'       => esc_html__( 'Number of related posts', 'talemy' ),
		'section'     => 'template_post',
		'default'     => 3,
		'priority'    => 10,
		'choices'     => array(
			'min'  => 0,
			'step' => 1,
		),
	);

	$controls[] = array(
		'type'        => 'multicheck',
		'settings'    => 'post_share',
		'label'       => esc_html__( 'Share Buttons', 'talemy' ),
		'section'     => 'template_post',
		'default'     => array( 'facebook', 'twitter', 'pinterest', 'googleplus' ),
		'priority'    => 10,
		'choices'     => array(
			'facebook' => esc_html__( 'Facebook', 'talemy' ),
			'twitter' => esc_html__( 'Twitter', 'talemy' ),
			'googleplus' => esc_html__( 'Google Plus', 'talemy' ),
			'pinterest' => esc_html__( 'Pinterest', 'talemy' ),
			'linkedin' => esc_html__( 'LinkedIn', 'talemy' ),
			'comments' => esc_html__( 'Comments', 'talemy' ),
			'email' => esc_html__( 'Email', 'talemy' ),
		)
	);
	
	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'social_twitter_at',
		'label'       => 'Twitter @',
		'description' => esc_html__( 'Used by Twitter Share link', 'talemy' ),
		'section'     => 'template_post',
		'default'     => '',
		'priority'    => 10
	);

	// page
	$controls[] = array(
		'type'        => 'radio-image',
		'settings'    => 'page_layout',
		'label'       => esc_html__( 'Content Layout', 'talemy' ),
		'section'     => 'template_page',
		'default'     => 'sidebar-right',
		'priority'    => 10,
		'choices'     => talemy_get_option_layouts()
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'page_sidebar',
		'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
		'section'     => 'template_page',
		'default'     => 'default-sidebar',
		'priority'    => 10,
		'choices'     => talemy_get_option_sidebars()
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'page_comments',
		'label'       => esc_html__( 'Show Comments', 'talemy' ),
		'section'     => 'template_page',
		'default'     => true,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'page_heading_1',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Page Banner', 'talemy' ) .'</div>',
	    'section'     => 'template_page',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'page_banner',
		'label'       => esc_html__( 'Page Banner', 'talemy' ),
		'section'     => 'template_page',
		'default'     => '',
		'priority'    => 10,
		'choices'     => talemy_get_option_page_banner_options(),
	);

	$controls[] = array(
		'type'        => 'image',
		'settings'    => 'page_banner_image',
		'label'       => esc_html__( 'Banner Image', 'talemy' ),
		'section'     => 'template_page',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'page_banner',
				'operator' => '==',
				'value'    => '',
			)
		),
		'output' => array(
			array(
				'element' => array( '.single-post .content-banner' ),
				'property' => 'background-image',
			)
		)
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'page_banner_shortcode',
		'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
		'section'     => 'template_page',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'page_banner',
				'operator' => '==',
				'value'    => 'shortcode'
			)
		)
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'home_title',
		'label'       => esc_html__( 'Blog Title', 'talemy' ),
		'section'     => 'template_home',
		'default' 	  => esc_html__( 'Blog', 'talemy' ),
		'priority'    => 10
	);

	// common settings
	
	$templates = array( 'archive', 'author', 'home', 'category', 'tag', 'search' );


	foreach ( $templates as $template ) {

		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => $template .'_layout',
			'label'       => esc_html__( 'Content Layout', 'talemy' ),
			'section'     => 'template_'. $template,
			'default'     => 'sidebar-right',
			'priority'    => 10,
			'choices'     => talemy_get_option_layouts()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => $template .'_sidebar',
			'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
			'section'     => 'template_'. $template,
			'default'     => 'default-sidebar',
			'priority'    => 10,
			'choices'     => talemy_get_option_sidebars()
		);

		$controls[] = array(
			'type'        => 'custom',
			'settings'    => $template .'_heading_1',
			'label'       => '<div class="kirki-separator">'. esc_html__( 'List', 'talemy' ) .'</div>',
		    'section'     => 'template_'. $template,
		    'priority'    => 10,
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => $template .'_list_style',
			'label'       => esc_html__( 'Listing Style', 'talemy' ),
			'section'     => 'template_'. $template,
			'default'     => 'list',
			'priority'    => 10,
			'choices'     => talemy_get_option_list_styles(),
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => $template .'_thumb_size',
			'label'       => esc_html__( 'Image Size', 'talemy' ),
			'section'     => 'template_' . $template,
			'default'     => 'talemy_thumb_small',
			'choices'     => talemy_get_option_image_sizes(),
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => $template .'_columns',
			'label'       => esc_html__( 'Columns', 'talemy' ),
			'section'     => 'template_' . $template,
			'default'     => '3',
			'choices'     => talemy_get_option_columns(),
			'active_callback'  => array(
				array(
					'setting'  => $template .'_list_style',
					'operator' => 'in',
					'value'    => array( 'grid', 'masonry' )
				)
			)
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => $template .'_tablet_columns',
			'label'       => esc_html__( 'Tablet Columns', 'talemy' ),
			'section'     => 'template_' . $template,
			'default'     => '2',
			'choices'     => talemy_get_option_tablet_columns(),
			'active_callback'  => array(
				array(
					'setting'  => $template .'_list_style',
					'operator' => 'in',
					'value'    => array( 'grid', 'masonry' )
				)
			)
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => $template .'_mobile_columns',
			'label'       => esc_html__( 'Mobile Columns', 'talemy' ),
			'section'     => 'template_' . $template,
			'default'     => '1',
			'choices'     => talemy_get_option_mobile_columns(),
			'active_callback'  => array(
				array(
					'setting'  => $template .'_list_style',
					'operator' => 'in',
					'value'    => array( 'grid', 'masonry' )
				)
			)
		);

		$controls[] = array(
			'type'        => 'custom',
			'settings'    => $template .'_heading_2',
			'label'       => '<div class="kirki-separator">'. esc_html__( 'Page Banner', 'talemy' ) .'</div>',
		    'section'     => 'template_'. $template,
		    'priority'    => 10,
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => $template .'_banner',
			'label'       => esc_html__( 'Page Banner', 'talemy' ),
			'section'     => 'template_'. $template,
			'default'     => '',
			'priority'    => 10,
			'choices'     => talemy_get_option_page_banner_options(),
		);

		$controls[] = array(
			'type'        => 'image',
			'settings'    => $template . '_banner_image',
			'label'       => esc_html__( 'Banner Image', 'talemy' ),
			'section'     => 'template_'. $template,
			'default'     => '',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => $template .'_banner',
					'operator' => '==',
					'value'    => '',
				)
			),
			'output' => array(
				array(
					'element' => array( '.content-banner' ),
					'property' => 'background-image',
				)
			)
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => $template .'_banner_shortcode',
			'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
			'section'     => 'template_'. $template,
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => $template .'_banner',
					'operator' => '==',
					'value'    => 'shortcode',
				)
			)
		);

		$controls[] = array(
			'type'        => 'custom',
			'settings'    => $template .'_heading_3',
			'label'       => '<div class="kirki-separator">'. esc_html__( 'Pagination', 'talemy' ) .'</div>',
		    'section'     => 'template_'. $template,
		    'priority'    => 10,
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => $template .'_pagination',
			'label'       => esc_html__( 'Pagination Type', 'talemy' ),
			'section'     => 'template_'. $template,
			'default'     => 'numeric',
			'priority'    => 10,
			'choices'     => talemy_get_option_pagination_type()
		);

		$controls[] = array(
			'type'        => 'number',
			'settings'    => $template .'_ppl',
			'label'       => esc_html__( 'Posts Per Load', 'talemy' ),
			'default'     => 5,
			'section'     => 'template_'. $template,
			'priority'    => 10,
			'choices'     => array(
				'min'  => 0,
				'step' => 1,
			),
		);

		$controls[] = array(
			'type'        => 'slider',
			'settings'    => $template .'_max_loads',
			'label'       => esc_html__( 'Max Loads ( Infinite Scroll )', 'talemy' ),
			'description'       => esc_html__( 'The number of loads before a load more button will appear. Set 0 to always use infinite scroll.', 'talemy' ),
			'section'     => 'template_'. $template,
			'default'     => 3,
			'priority'    => 10,
			'choices'     => array(
				'min' => 0,
				'max' => 50,
				'step' => 1
			)
		);
	}

	// attachment
	$controls[] = array(
		'type'        => 'radio-image',
		'settings'    => 'attachment_layout',
		'label'       => esc_html__( 'Content Layout', 'talemy' ),
		'section'     => 'template_attachment',
		'default'     => 'sidebar-right',
		'priority'    => 10,
		'choices'     => talemy_get_option_layouts()
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'attachment_sidebar',
		'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
		'section'     => 'template_attachment',
		'default'     => 'default-sidebar',
		'priority'    => 10,
		'choices'     => talemy_get_option_sidebars()
	);

	// 404
	$controls[] = array(
		'type'        => 'background',
		'settings'    => 'error_bg',
		'label'       => esc_html__( 'Error Page Background', 'talemy' ),
		'section'     => 'template_error',
		'priority'    => 10,
		'output'	  => array( array( 'element' => array( '#error' ) ) )
	);

	// typography
	
	$controls[] = array(
		'type'        => 'typography',
		'settings'    => 'typo_body',
		'label'       => esc_html__( 'Body Font', 'talemy' ),
		'section'     => 'typography_body',
		'default'     => array(
			'color'          => '#777777',
			'font-family'    => 'Poppins',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'line-height'    => '1.75',
			'letter-spacing' => '0',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array( 'element' => 'body' )
		)
	);

	$controls[] = array(
		'type'        => 'typography',
		'settings'    => 'typo_heading',
		'label'       => esc_html__( 'H1 - H6', 'talemy' ),
		'section'     => 'typography_heading',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'line-height'    => '1.35',
			'letter-spacing' => '0',
			'text-transform' => '',
		),
		'priority'    => 10,
		'output'      => array(
			array( 'element' => array( 'h1','h2','h3','h4','h5','h6' ) )
		)
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'typo_h1_size',
		'label'       => esc_html__( 'H1 Font Size', 'talemy' ),
		'section'     => 'typography_heading',
		'default'     => '36px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => 'h1',
				'property' => 'font-size',
				'exclude' => array( '36px', '1.8rem' )
			)
		),
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'typo_h2_size',
		'label'       => esc_html__( 'H2 Font Size', 'talemy' ),
		'section'     => 'typography_heading',
		'default'     => '27px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => 'h2',
				'property' => 'font-size',
				'exclude' => array( '27px', '1.35rem' )
			)
		),
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'typo_h3_size',
		'label'       => esc_html__( 'H3 Font Size', 'talemy' ),
		'section'     => 'typography_heading',
		'default'     => '21px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => 'h3',
				'property' => 'font-size',
				'exclude' => array( '21px', '1.05rem' )
			)
		),
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'typo_h4_size',
		'label'       => esc_html__( 'H4 Font Size', 'talemy' ),
		'section'     => 'typography_heading',
		'default'     => '18px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => 'h4',
				'property' => 'font-size',
				'exclude' => array( '18px', '0.9rem' )
			)
		),
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'typo_h5_size',
		'label'       => esc_html__( 'H5 Font Size', 'talemy' ),
		'section'     => 'typography_heading',
		'default'     => '16px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => 'h5',
				'property' => 'font-size',
				'exclude' => array( '16px', '0.8rem' )
			)
		),
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'typo_h6_size',
		'label'       => esc_html__( 'H6 Font Size', 'talemy' ),
		'section'     => 'typography_heading',
		'default'     => '14px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => 'h6',
				'property' => 'font-size',
				'exclude' => array( '14px', '0.7rem' )
			)
		),
	);


	// social

	if ( function_exists( 'sf_get_social_icon_names' ) ) {

		foreach( sf_get_social_icon_names() as $key => $label ) {
			$controls[] = array(
				'type'        => 'text',
				'settings'    => 'social_'. $key,
				'label'       => $label,
				'section'     => 'social',
				'default'     => '',
				'priority'    => 10
			);
		}
	}


	// header style

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'header_style',
		'label'       => esc_html__( 'Header Style', 'talemy' ),
		'section'     => 'header_header',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => talemy_get_option_header_styles()
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'header_position',
		'label'       => esc_html__( 'Header Position', 'talemy' ),
		'section'     => 'header_header',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'' => esc_html__( 'Default', 'talemy' ),
			'absolute' => esc_html__( 'Merge with content', 'talemy' ),
		)
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'header_heading_1',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Header Info', 'talemy' ) .'</div>',
	    'section'     => 'header_header',
	    'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'header_style',
				'operator' => '==',
				'value'    => '4',
			)
		)
	);

	$controls[] = array(
		'type'        => 'textarea',
		'settings'    => 'header_info_address',
		'label'       => esc_html__( 'Header Address', 'talemy' ),
		'section'     => 'header_header',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'header_style',
				'operator' => '==',
				'value'    => '4',
			)
		)
	);

	$controls[] = array(
		'type'        => 'textarea',
		'settings'    => 'header_info_email',
		'label'       => esc_html__( 'Header Email', 'talemy' ),
		'section'     => 'header_header',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'header_style',
				'operator' => '==',
				'value'    => '4',
			)
		)
	);

	$controls[] = array(
		'type'        => 'textarea',
		'settings'    => 'header_info_phone',
		'label'       => esc_html__( 'Header Phone', 'talemy' ),
		'section'     => 'header_header',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'header_style',
				'operator' => '==',
				'value'    => '4',
			)
		)
	);

	$controls[] = array(
		'type'        => 'code',
		'settings'    => 'header_ads_code',
		'label'       => esc_html__( 'Header Ads code', 'talemy' ),
		'section'     => 'header_header',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'language' => 'html',
			'theme'    => 'monokai'
		),
		'active_callback'  => array(
			array(
				'setting'  => 'header_style',
				'operator' => '==',
				'value'    => '4',
			)
		),
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'header_heading_2',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Header Styling', 'talemy' ) .'</div>',
	    'section'     => 'header_header',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'background',
		'settings'    => 'header_bg',
		'label'       => esc_html__( 'Header Background', 'talemy' ),
		'section'     => 'header_header',
		'default'     => array( 'background-color' => '#FFFFFF' ),
		'output'	  => array( array( 'element' => '#header' ) )
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'header_text_color',
		'label'       => esc_html__( 'Text Color', 'talemy' ),
		'section'     => 'header_header',
		'default'     => '#222222',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => array( '#header' ),
				'property' => 'color',
				'exclude' => array( '#222222' ),
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'header_link_color',
		'label'       => esc_html__( 'Link Color', 'talemy' ),
		'section'     => 'header_header',
		'priority'    => 10,
		'alpha'       => true,
		'choices'     => array(
			'default'    => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' ),
		),
		'default'     => array(
			'default'    => '#222222',
			'hover'   => '#f5b417'
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array(
					'.header-wrapper a',
					'.header-wrapper .nav-btns i'
				),
				'property' => 'color',
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'.header-wrapper a:not(.btn):hover',
					'.header-wrapper .nav-btns i:hover'
				),
				'property' => 'color',
			)
		)
	);

	// topbar

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'topbar',
		'label'       => esc_html__( 'Show Topbar', 'talemy' ),
		'section'     => 'header_topbar',
		'default'     => true,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'topbar_cta_btn',
		'label'       => esc_html__( 'Show CTA Button', 'talemy' ),
		'section'     => 'header_topbar',
		'default'     => 0,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'topbar_btn_text',
		'label'       => esc_html__( 'CTA Button Text', 'talemy' ),
		'section'     => 'header_topbar',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'topbar_cta_btn',
				'operator' => '==',
				'value'    => 1,
			)
		)
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'topbar_btn_url',
		'label'       => esc_html__( 'CTA Button URL', 'talemy' ),
		'section'     => 'header_topbar',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'topbar_cta_btn',
				'operator' => '==',
				'value'    => 1,
			)
		)
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'topbar_btn_class',
		'label'       => esc_html__( 'CTA Button Class', 'talemy' ),
		'section'     => 'header_topbar',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'topbar_cta_btn',
				'operator' => '==',
				'value'    => 1,
			)
		)
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'topbar_heading_1',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Top Bar Styling', 'talemy' ) .'</div>',
	    'section'     => 'header_topbar',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'topbar_bg_color',
		'label'       => esc_html__( 'Background Color', 'talemy' ),
		'section'     => 'header_topbar',
		'default'     => '#41246d',
		'choices'     => array( 'alpha' => true ),
		'priority'    => 10,
		'output'	  => array(
			array(
				'element' => '.topbar',
				'property' => 'background',
				'exclude' => array( '#41246d' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'topbar_text_color',
		'label'       => esc_html__( 'Text Color', 'talemy' ),
		'section'     => 'header_topbar',
		'default'     => '#FFFFFF',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => '.topbar',
				'property' => 'color',
				'exclude' => array( '#FFFFFF' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'topbar_link_color',
		'label'       => esc_html__( 'Link Color', 'talemy' ),
		'section'     => 'header_topbar',
		'priority'    => 10,
		'alpha'       => true,
		'choices'     => array(
			'default'    => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' ),
		),
		'default'     => array(
			'default'    => '#FFFFFF',
			'hover'   => '#f5b417',
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array(
					'.topbar a',
					'.topbar-search .fa'
				),
				'property' => 'color',
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'.topbar a:hover',
					'.topbar-search:hover .fa',
					'.topbar-menu a:hover'
				),
				'property' => 'color',
			)
		)
	);

	// navbar

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'nav_sticky_style',
		'label'       => esc_html__( 'Sticky Navbar', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => 'smart',
		'priority'    => 10,
		'choices'     => array(
			'disable' => esc_html__( 'Disable', 'talemy' ),
			'always' => esc_html__( 'Always', 'talemy' ),
			'smart' => esc_html__( 'Smart', 'talemy' ),
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'nav_search',
		'label'       => esc_html__( 'Show Search', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => true,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'nav_login',
		'label'       => esc_html__( 'Show Login', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => true,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'nav_login_button_style',
		'label'       => esc_html__( 'Login Button Style', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'' => esc_html__( 'Icon', 'talemy' ),
			'button' => esc_html__( 'Button', 'talemy' )
		),
		'active_callback'  => array(
			array(
				'setting'  => 'nav_login',
				'operator' => '==',
				'value'    => true
			)
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'nav_hamburger',
		'label'       => esc_html__( 'Show Hamburger', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => false,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'nav_wishlist',
		'label'       => esc_html__( 'Show Wish List', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => true,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'nav_cta_btn',
		'label'       => esc_html__( 'Show CTA Button', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => 0,
		'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'nav_btn_text',
		'label'       => esc_html__( 'CTA Button Text', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'nav_cta_btn',
				'operator' => '==',
				'value'    => 1,
			)
		)
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'nav_btn_url',
		'label'       => esc_html__( 'CTA Button URL', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'nav_cta_btn',
				'operator' => '==',
				'value'    => 1,
			)
		)
	);

	$controls[] = array(
		'type'        => 'text',
		'settings'    => 'nav_btn_class',
		'label'       => esc_html__( 'CTA Button Class', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => '',
		'priority'    => 10,
		'active_callback'  => array(
			array(
				'setting'  => 'nav_cta_btn',
				'operator' => '==',
				'value'    => 1,
			)
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'nav_show_course_cats',
		'label'       => esc_html__( 'Show Course Categories', 'talemy' ),
		'description' => esc_html__( 'Header style 3', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => true,
		'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'multicheck',
		'settings'    => 'nav_course_cats',
		'label'       => esc_html__( 'Course Categories', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => '',
		'priority'    => 10,
		'choices'     => talemy_get_ld_option_course_cats(),
		'active_callback'  => array(
			array(
				'setting'  => 'nav_show_course_cats',
				'operator' => '==',
				'value'    => 1,
			)
		)
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'navbar_heading_1',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Nav Bar Styling', 'talemy' ) .'</div>',
	    'section'     => 'header_navbar',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'number',
		'settings'    => 'nav_top_padding',
		'label'       => esc_html__( 'Top Padding', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => 15,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'output' => array(
			array(
				'element' => array(
					'.header-style-1 .nav-menu>li>a',
					'.header-style-1 .nav .nav-btns .nav-btn',
					'.header-style-2 .nav-menu>li>a',
					'.header-style-2 .nav .nav-btns .nav-btn',
					'.header-style-3 .nav-menu>li>a',
					'.header-style-3 .nav .nav-btns .nav-btn',
					'.header-style-3 .nav-btn-cat',
					'.header-style-4 .nav-menu>li>a',
					'.header-style-4 .nav .nav-btns .nav-btn',
					'.header-style-9 .nav-menu>li>a',
					'.header-style-9 .nav .nav-btns .nav-btn',
					'.header-style-8 .navbar',
					'.header-style-2 .navbar:not(.nav-is-fixed) .logo-wrapper',
					'.navbar:not(.nav-is-fixed) .btn-login-wrapper',
				),
				'property' => 'padding-top',
				'media_query' => '@media (min-width: 768px)',
				'suffix' => 'px',
				'exclude' => array( 15 ),
			)
		)
	);

	$controls[] = array(
		'type'        => 'number',
		'settings'    => 'nav_bottom_padding',
		'label'       => esc_html__( 'Bottom Padding', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => 15,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'output' => array(
			array(
				'element' => array(
					'.header-style-1 .nav-menu>li>a',
					'.header-style-1 .nav .nav-btns .nav-btn',
					'.header-style-2 .nav-menu>li>a',
					'.header-style-2 .nav .nav-btns .nav-btn',
					'.header-style-3 .nav-menu>li>a',
					'.header-style-3 .nav .nav-btns .nav-btn',
					'.header-style-3 .nav-btn-cat',
					'.header-style-4 .nav-menu>li>a',
					'.header-style-4 .nav .nav-btns .nav-btn',
					'.header-style-9 .nav-menu>li>a',
					'.header-style-9 .nav .nav-btns .nav-btn',
					'.header-style-8 .navbar',
					'.header-style-2 .navbar:not(.nav-is-fixed) .logo-wrapper',
					'.navbar:not(.nav-is-fixed) .btn-login-wrapper',
				),
				'property' => 'padding-bottom',
				'media_query' => '@media (min-width: 768px)',
				'suffix' => 'px',
				'exclude' => array( 15 ),
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'navbar_bg_color',
		'label'       => esc_html__( 'Background Color', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => '#ffffff',
		'choices'     => array( 'alpha' => true ),
		'priority'    => 10,
		'output'	  => array(
			array(
				'element' => array(
					'.navbar',
					'.header-style-3 .navbar',
					'.header-style-4 .navbar',
					'.header-style-6 .navbar .nav'
				),
				'property' => 'background-color',
				'exclude' => array( '#ffffff' )
			),
			array(
				'element' => array(
					'.header-style-3 .navbar',
					'.header-style-4 .navbar'
				),
				'property' => 'border-color',
				'exclude' => array( '#ffffff' )
			),
			array(
				'element' => array(
					'.header-style-6 .navbar'
				),
				'property' => 'background-color',
				'media_query' => '@media (max-width:767px)',
				'exclude' => array( '#ffffff' ),
				'suffix' => '!important'
			),
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'navbar_sticky_bg_color',
		'label'       => esc_html__( 'Sticky Background Color', 'talemy' ),
		'section'     => 'header_navbar',
		'default'     => '#FFFFFF',
		'choices'     => array( 'alpha' => true ),
		'priority'    => 10,
		'output'	  => array(
			array(
				'element' => array(
					'.navbar.nav-is-fixed'
				),
				'property' => 'background-color',
				'suffix' => '!important',
				'exclude' => array( '#FFFFFF' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'navbar_link_color',
		'label'       => esc_html__( 'Nav Bar Link Color', 'talemy' ),
		'section'     => 'header_navbar',
		'priority'    => 10,
		'alpha'       => true,
		'choices'     => array(
			'default' => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' ),
		),
		'default'     => array(
			'default' => '#222222',
			'hover'   => '#f5b417',
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array(
					'.navbar .nav-btns .nav-btn',
					'.navbar .nav-btns .nav-btn i',
					'.navbar .nav-btn-cat .text'
				),
				'property' => 'color'
			),
			array(
				'choice' => 'default',
				'element' => array(
					'.hamburger .menu-icon span',
					'.hamburger-2 .menu-icon span'
				),
				'property' => 'background'
			),
			array(
				'choice' => 'default',
				'element' => array(
					'.icon-category .square'
				),
				'property' => 'border-color'
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'.navbar .nav-btns .nav-btn:hover',
					'.navbar .nav-btns .nav-btn:hover i',
					'.navbar .nav-btn-cat:hover .text'
				),
				'property' => 'color',
				'suffix' => '!important'
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'.hamburger:hover .menu-icon span',
					'.hamburger-2:hover .menu-icon span',
					'.nav-btn-cat:hover .icon-category .square'
					
				),
				'property' => 'background',
			)
		)
	);

	$controls[] = array(
		'type'        => 'radio-buttonset',
		'settings'    => 'menu_alignment',
		'label'       => esc_html__( 'Menu Alignment', 'talemy' ),
		'description' => esc_html__( 'For header style 1, 2, 5, 7', 'talemy' ),
		'section'     => 'header_main_menu',
		'default'     => 'center',
		'priority'    => 10,
		'choices'     => array(
			'left' => esc_html__( 'Left', 'talemy' ),
			'center' => esc_html__( 'Center', 'talemy' ),
			'right' => esc_html__( 'Right', 'talemy' )
		)
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'menu_icons_position',
		'label'       => esc_html__( 'Menu Icons Position', 'talemy' ),
		'section'     => 'header_main_menu',
		'default'     => 'left',
		'priority'    => 10,
		'choices'     => array(
			'left' => esc_html__( 'Left', 'talemy' ),
			'top' => esc_html__( 'Top', 'talemy' )
		)
	);

	$controls[] = array(
		'type'        => 'toggle',
		'settings'    => 'menu_dropdown_indicator',
		'label'       => esc_html__( 'Show Dropdown Indicator', 'talemy' ),
		'section'     => 'header_main_menu',
		'default'     => 1,
		'priority'    => 10
	);

	$controls[] = array(
		'type'        => 'custom',
		'settings'    => 'menu_heading_1',
		'label'       => '<div class="kirki-separator">'. esc_html__( 'Main Menu Styling', 'talemy' ) .'</div>',
	    'section'     => 'header_main_menu',
	    'priority'    => 10,
	);

	$controls[] = array(
		'type'        => 'typography',
		'settings'    => 'main_menu_typo',
		'label'       => esc_html__( 'Main Menu', 'talemy' ),
		'section'     => 'header_main_menu',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'letter-spacing' => '0',
			'text-transform' => 'none'
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => array( '.nav-menu>li>a' ),
			)
		)
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'main_menu_size',
		'label'       => esc_html__( 'Main Menu Font Size', 'talemy' ),
		'section'     => 'header_main_menu',
		'default'     => '14px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => array(
					'.nav-menu>li>a'
				),
				'property' => 'font-size',
				'exclude' => array( '14px' )
			)
		),
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'submenu_size',
		'label'       => esc_html__( 'Submenu Font Size', 'talemy' ),
		'section'     => 'header_main_menu',
		'default'     => '13px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => array(
					'.nav-menu .sub-menu a',
					'.nav-menu .megamenu-submenu a'
				),
				'property' => 'font-size',
				'exclude' => array( '13px' )
			)
		),
	);

	$controls[] = array(
		'type'        => 'dimension',
		'settings'    => 'megamenu_title_size',
		'label'       => esc_html__( 'Mega Menu Title Size', 'talemy' ),
		'section'     => 'header_main_menu',
		'default'     => '18px',
		'priority'    => 10,
		'output' 	  => array(
			array(
				'element' => array(
					'.megamenu-widget-area .widget-title',
					'.megamenu-title'
				),
				'property' => 'font-size',
				'exclude' => array( '18px' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'megamenu_divider_color',
		'label'       => esc_html__( 'Mega Menu Divider Color', 'talemy' ),
		'section'     => 'header_main_menu',
		'default'     => '#eeeeee',
		'choices'     => array( 'alpha' => true ),
		'priority'    => 10,
		'output'	  => array(
			array(
				'element' => '.megamenu-submenu:before',
				'property' => 'background-color',
				'exclude' => array( '#eeeeee' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'main_menu_link_color',
		'label'       => esc_html__( 'Main Menu Link Color', 'talemy' ),
		'section'     => 'header_main_menu',
		'priority'    => 10,
		'alpha'       => true,
		'choices'     => array(
			'default'    => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' )
		),
		'default'     => array(
			'default'    => '#000000',
			'hover'   => '#f5b417'
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array(
					'.nav-menu>li>a',
				),
				'property' => 'color',
				'suffix' => '!important'
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'.nav-menu>li>a:hover',
					'.header-style-6 .nav-menu>.current-menu-ancestor>a',
					'.header-style-6 .nav-menu>.current-menu-parent>a',
					'.header-style-6 .nav-menu>.current-menu-item>a'
				),
				'property' => 'color',
				'suffix' => '!important'
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'submenu_link_color',
		'label'       => esc_html__( 'Submenu Link Color', 'talemy' ),
		'section'     => 'header_main_menu',
		'priority'    => 10,
		'alpha'       => true,
		'choices'     => array(
			'default'    => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' )
		),
		'default'     => array(
			'default'    => '#7f7f7f',
			'hover'   => '#f5b417'
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array(
					'.nav-menu .sub-menu a',
					'.nav-menu .megamenu-submenu a'
				),
				'property' => 'color'
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'.nav-menu .sub-menu>li.active>a',
					'.nav-menu .sub-menu .current-menu-parent>a',
					'.nav-menu .sub-menu .current-menu-item>a',
					'.nav-menu .sub-menu a:hover',
					'.nav-menu .megamenu-submenu a:hover'
				),
				'property' => 'color',
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'submenu_bg_color',
		'label'       => esc_html__( 'Submenu Background Color', 'talemy' ),
		'section'     => 'header_main_menu',
		'priority'    => 10,
		'alpha'       => true,
		'choices'     => array(
			'default'    => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' ),
		),
		'default'     => array(
			'default'    => '#FFFFFF',
			'hover'   => '#FFFFFF'
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array( '.nav-menu .sub-menu' ),
				'property' => 'background-color'
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'.nav-menu .sub-menu>li.active>a',
					'.nav-menu .sub-menu .current-menu-parent>a',
					'.nav-menu .sub-menu .current-menu-item>a',
					'.nav-menu .sub-menu>li:hover>a'
				),
				'property' => 'background-color'
			)
		)
	);


	// side menu

	$controls[] = array(
		'type'        => 'background',
		'settings'    => 'side_bg',
		'label'       => esc_html__( 'Off-Canvas Background', 'talemy' ),
		'section'     => 'header_off_canvas',
		'default'     => array( 'background-color' => '' ),
		'output'	  => array( array( 'element' => '.off-canvas' ) )
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'side_title_color',
		'label'       => esc_html__( 'Widget Title Color', 'talemy' ),
		'section'     => 'header_off_canvas',
		'default'     => '#000000',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => '.off-canvas .widget-title',
				'property' => 'color',
				'exclude' => array( '#000000' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'side_text_color',
		'label'       => esc_html__( 'Text Color', 'talemy' ),
		'section'     => 'header_off_canvas',
		'default'     => '#777777',
		'choices'     => array( 'alpha' => true ),
		'output'	  => array(
			array(
				'element' => '.off-canvas',
				'property' => 'color',
				'exclude' => array( '#777777' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'multicolor',
		'settings'    => 'side_link_color',
		'label'       => esc_html__( 'Link Color', 'talemy' ),
		'section'     => 'header_off_canvas',
		'priority'    => 10,
		'choices'     => array(
			'default'    => esc_html__( 'Default', 'talemy' ),
			'hover'   => esc_html__( 'Hover', 'talemy' )
		),
		'alpha'       => true,
		'default'     => array(
			'default'    => '#444444',
			'hover'   => '#f5b417'
		),
		'output' => array(
			array(
				'choice' => 'default',
				'element' => array(
					'.off-canvas-widget a',
					'.off-canvas-menu a'
				),
				'property' => 'color'
			),
			array(
				'choice' => 'hover',
				'element' => array(
					'.off-canvas-widget a:hover',
					'.off-canvas-menu a:hover'
				),
				'property' => 'color'
			)
		)
	);

	$controls[] = array(
		'type'        => 'color',
		'settings'    => 'side_menu_divider_color',
		'label'       => esc_html__( 'Menu Divider Color', 'talemy' ),
		'section'     => 'header_off_canvas',
		'default'     => '#DFDFDF',
		'choices'     => array( 'alpha' => true ),
		'priority'    => 10,
		'output'	  => array(
			array(
				'element' => array(
					'.off-canvas-menu ul',
					'.off-canvas-menu li'
				),
				'property' => 'border-color',
				'exclude' => array( '#DFDFDF' )
			)
		)
	);

	$controls[] = array(
		'type'        => 'typography',
		'settings'    => 'side_typo',
		'label'       => esc_html__( 'Off-Canvas Menu', 'talemy' ),
		'section'     => 'header_off_canvas',
		'default'     => array(
			'font-family'    => 'Poppins',
			'variant'        => '600',
			'letter-spacing' => '0',
			'text-transform' => 'uppercase'
		),
		'output' => array(
			array(
				'element' => array( '.off-canvas-menu a' )
			)
		)
	);


	// custom css

	$controls[] = array(
		'type'        => 'code',
		'settings'    => 'custom_css',
		'label'       => '',
		'section'     => 'custom_css',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'language' => 'css',
			'theme'    => 'monokai'
		)
	);

	// custom codes

	$controls[] = array(
		'type'        => 'code',
		'settings'    => 'header_code',
		'label'       => esc_html__( 'Header Code', 'talemy' ),
		'description' => sprintf( esc_html__( 'Add your before %s code here. e.g. Google Analytics', 'talemy' ), '&lt;/head&gt;' ),
		'section'     => 'advanced',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'language' => 'html',
			'theme'    => 'monokai'
		)
	);

	$controls[] = array(
		'type'        => 'code',
		'settings'    => 'footer_code',
		'label'       => esc_html__( 'Footer Code', 'talemy' ),
		'description' => sprintf( esc_html__( 'Add your before %s code here.', 'talemy' ), '&lt;/body&gt;' ),
		'section'     => 'advanced',
		'default'     => '',
		'priority'    => 10,
		'choices'     => array(
			'language' => 'html',
			'theme'    => 'monokai'
		)
	);

	$controls[] = array(
		'type'        => 'select',
		'settings'    => 'dynamic_css_method',
		'label'       => esc_html__( 'Dynamic CSS Method', 'talemy' ),
		'description' => esc_html__( 'Choose "File" mode to output dynamically generated CSS to a file. Save your settings again if your style is not updated.', 'talemy' ),
		'section'     => 'advanced',
		'default'     => 'inline',
		'choices'     => array(
			'inline' => esc_html__( 'Inline', 'talemy' ),
			'file'   => esc_html__( 'File', 'talemy' )
		)
	);

	// woocommerce

	if ( class_exists( 'WooCommerce' ) ) {

		$controls[] = array(
			'type'        => 'toggle',
			'settings'    => 'wc_nav_cart',
			'label'       => esc_html__( 'Show Nav Cart', 'talemy' ),
			'section'     => 'wc_general',
			'default'     => true,
			'priority'    => 10
		);

		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => 'wc_layout',
			'label'       => esc_html__( 'Layout', 'talemy' ),
			'section'     => 'wc_general',
			'default'     => 'sidebar-right',
			'choices'     => talemy_get_option_layouts()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'wc_sidebar',
			'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
			'section'     => 'wc_general',
			'default'     => 'wc-sidebar',
			'choices'     => talemy_get_option_sidebars()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'wc_banner',
			'label'       => esc_html__( 'Page Banner', 'talemy' ),
			'section'     => 'wc_general',
			'default'     => '',
			'priority'    => 10,
			'choices'     => talemy_get_option_page_banner_options(),
		);

		$controls[] = array(
			'type'        => 'image',
			'settings'    => 'wc_banner_image',
			'label'       => esc_html__( 'Banner Image', 'talemy' ),
			'section'     => 'wc_general',
			'default'     => '',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'wc_banner',
					'operator' => '==',
					'value'    => '',
				)
			),
			'output' => array(
				array(
					'element' => array( '.content-banner' ),
					'property' => 'background-image',
				)
			)
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'wc_banner_shortcode',
			'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
			'section'     => 'wc_general',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'wc_banner',
					'operator' => '==',
					'value'    => 'shortcode'
				)
			)
		);

		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => 'wc_product_layout',
			'label'       => esc_html__( 'Layout', 'talemy' ),
			'section'     => 'wc_product',
			'default'     => 'sidebar-right',
			'choices'     => talemy_get_option_layouts()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'wc_product_sidebar',
			'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
			'section'     => 'wc_product',
			'default'     => 'wc-sidebar',
			'choices'     => talemy_get_option_sidebars()
		);

		$controls[] = array(
			'type'        => 'slider',
			'settings'    => 'wc_related_columns',
			'label'       => esc_html__( 'Related Products Columns', 'talemy' ),
			'section'     => 'wc_product',
			'default'     => 3,
			'priority'    => 10,
			'choices'     => array(
				'min'  => 0,
				'max'  => 6,
				'step' => 1
			)
		);

		$controls[] = array(
			'type'        => 'number',
			'settings'    => 'wc_related_count',
			'label'       => esc_html__( 'Related Products Count', 'talemy' ),
			'section'     => 'wc_product',
			'default'     => 3,
			'priority'    => 10,
			'choices'     => array(
				'min'  => 0,
				'step' => 1
			)
		);

		$controls[] = array(
			'type'        => 'slider',
			'settings'    => 'wc_upsell_columns',
			'label'       => esc_html__( 'Upsell Products Columns', 'talemy' ),
			'section'     => 'wc_product',
			'default'     => 3,
			'priority'    => 10,
			'choices'     => array(
				'min'  => 0,
				'max'  => 6,
				'step' => 1
			)
		);

		$controls[] = array(
			'type'        => 'number',
			'settings'    => 'wc_upsell_count',
			'label'       => esc_html__( 'Upsell Products Count', 'talemy' ),
			'section'     => 'wc_product',
			'default'     => 3,
			'priority'    => 10,
			'choices'     => array(
				'min'  => 0,
				'step' => 1
			)
		);

		$controls[] = array(
			'type'        => 'custom',
			'settings'    => 'wc_product_heading_1',
			'label'       => '<div class="kirki-separator">'. esc_html__( 'Page Banner', 'talemy' ) .'</div>',
			'section'     => 'wc_product',
			'priority'    => 10,
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'wc_product_banner',
			'label'       => esc_html__( 'Page Banner', 'talemy' ),
			'section'     => 'wc_product',
			'default'     => '',
			'priority'    => 10,
			'choices'     => talemy_get_option_page_banner_options(),
		);

		$controls[] = array(
			'type'        => 'image',
			'settings'    => 'wc_product_banner_image',
			'label'       => esc_html__( 'Banner Image', 'talemy' ),
			'section'     => 'wc_product',
			'default'     => '',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'wc_product_banner',
					'operator' => '==',
					'value'    => '',
				)
			),
			'output' => array(
				array(
					'element' => array( '.single-product .content-banner' ),
					'property' => 'background-image',
				)
			)
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'wc_product_banner_shortcode',
			'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
			'section'     => 'wc_product',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'wc_product_banner',
					'operator' => '==',
					'value'    => 'shortcode'
				)
			)
		);
	}

	// events

	if ( defined( 'TRIBE_EVENTS_FILE') ) {

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ec_banner',
			'label'       => esc_html__( 'Page Banner', 'talemy' ),
			'section'     => 'ec_general',
			'default'     => '',
			'priority'    => 10,
			'choices'     => talemy_get_option_page_banner_options(),
		);

		$controls[] = array(
			'type'        => 'image',
			'settings'    => 'ec_banner_image',
			'label'       => esc_html__( 'Banner Image', 'talemy' ),
			'section'     => 'ec_general',
			'default'     => '',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'ec_banner',
					'operator' => '==',
					'value'    => '',
				)
			),
			'output' => array(
				array(
					'element' => array( '.tribe-events-page-template .content-banner' ),
					'property' => 'background-image',
				)
			)
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'ec_banner_shortcode',
			'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
			'section'     => 'ec_general',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'ec_banner',
					'operator' => '==',
					'value'    => 'shortcode'
				)
			)
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ec_list_thumb_size',
			'label'       => esc_html__( 'List View Image Size', 'talemy' ),
			'section'     => 'ec_general',
			'default'     => 'talemy_thumb_small',
			'choices'     => talemy_get_option_image_sizes(),
		);

		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => 'ec_single_layout',
			'label'       => esc_html__( 'Layout', 'talemy' ),
			'section'     => 'ec_single',
			'default'     => 'sidebar-right',
			'priority'    => 10,
			'choices'     => array(
				'sidebar-right' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l1.png',
				'sidebar-left' => TALEMY_THEME_URI . 'includes/admin/assets/images/layout/l2.png',
			)
		);

		$controls[] = array(
			'type'        => 'color',
			'settings'    => 'ec_primary_color',
			'label'       => esc_html__( 'Primary Color', 'talemy' ),
			'section'     => 'ec_theme',
			'default'     => '#41246d',
			'choices'     => array( 'alpha' => true ),
			'output'	  => array(
				array(
					'element' => array(
						".tribe-events-button",
						"#tribe-events .tribe-events-button",
						".tribe-events-calendar .tribe-events-tooltip .entry-title",
						".tribe-events-tooltip .tribe-event-title",
						".tribe-events-calendar th",
						".tribe-events-list-widget .tribe-event-featured",
						".tribe-events-calendar .tribe-events-tooltip .entry-title",
						".tribe-events-tooltip .tribe-event-title",
						".tribe-events-list-widget .tribe-event-featured",
						".datepicker table tr td.active.active",
						".datepicker table tr td span.active.active",
						".tribe-events-calendar th",
						"#tribe-bar-form .tribe-bar-submit input[type=submit]",
						"#tribe-bar-form .tribe-bar-submit input[type=submit]:disabled",
						"#tribe-bar-form .tribe-bar-submit input[type=submit].disabled",
						"#tribe-bar-form .tribe-bar-submit input[type=submit]:disabled[disabled]",
						".tribe-events-header .tribe-events-grid .tribe-grid-content-wrap",
						".tribe-grid-header .tribe-grid-content-wrap",
						".tribe-events-grid .tribe-grid-header .tribe-week-today",
					),
					'property' => 'background-color',
					'exclude' => array( '#41246d' )
				),
				array(
					'element' => array(
						".tribe-events-calendar th",
						".tribe-events-event-cost span",
						".tribe-events-button",
						"#tribe-events .tribe-events-button",
						".tribe-events-button:hover",
						"#tribe-events .tribe-events-button:hover",
						'#tribe-bar-form .tribe-bar-submit input[type=submit]',
						".tribe-events-event-cost span",
						".tribe-events-list .tribe-events-loop .tribe-event-featured .tribe-events-photo-event-wrap",
					),
					'property' => 'border-color',
					'suffix' => '!important',
					'exclude' => array( '#41246d' ),
				),
				array(
					'element' => array(
						".tribe-events-event-cost span",
						".tribe-events-button:hover",
					),
					'property' => 'color',
					'suffix' => '!important',
					'exclude' => array( '#41246d' )
				)
			)
		);

		$controls[] = array(
			'type'        => 'color',
			'settings'    => 'ec_secondary_color',
			'label'       => esc_html__( 'Secondary Color', 'talemy' ),
			'section'     => 'ec_theme',
			'default'     => '#f5b417',
			'choices'     => array( 'alpha' => true ),
			'output'	  => array(
				array(
					'element' => array(
						"#tribe-events-content table.tribe-events-calendar .type-tribe_events.tribe-event-featured",
						".tribe-events-calendar td.tribe-events-present div[id*='tribe-events-daynum-']",
						".tribe-events-calendar td.tribe-events-present div[id*='tribe-events-daynum-'] > a",
					),
					'property' => 'background-color',
					'exclude' => array( '#f5b417' )
				),
				array(
					'element' => array(
						".tribe-events-calendar .tribe-events-present",
						".tribe-events-calendar td.tribe-events-present.mobile-active",
						".tribe-events-calendar .tribe-events-present.mobile-active div[id*='tribe-events-daynum-']",
						".tribe-events-calendar .tribe-events-present.mobile-active div[id*='tribe-events-daynum-'] a",
					),
					'property' => 'background-color',
					'media_query' => '@media (max-width:767px)',
					'exclude' => array( '#f5b417' )
				),
				array(
					'element' => array(
						".tribe-events-list .tribe-event-schedule-details i",
						".tribe-events-list .tribe-events-venue-details i",
						".tribe-events-list .time-details i",
					),
					'property' => 'color',
					'suffix' => '!important',
					'exclude' => array( '#f5b417' )
				)
			)
		);
	}

	// Learn Dash Settings

	if ( defined( 'LEARNDASH_VERSION' ) ) {

		// general
		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => 'ld_layout',
			'label'       => esc_html__( 'Layout', 'talemy' ),
			'section'     => 'ld_general',
			'default'     => 'sidebar-right',
			'choices'     => talemy_get_option_layouts()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_sidebar',
			'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
			'section'     => 'ld_general',
			'default'     => '',
			'choices'     => talemy_get_option_sidebars( true )
		);

		$controls[] = array(
			'type'        => 'code',
			'settings'    => 'ld_thumb_hover_text',
			'label'       => esc_html__( 'Thumbnail Hover Text', 'talemy' ),
			'section'     => 'ld_general',
			'default'     => '<i class="fas fa-eye"></i>' . esc_html__( 'Watch Now', 'talemy' ),
			'choices'     => array(
				'language' => 'html',
				'theme'    => 'monokai'
			),
			'priority'    => 10
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_banner',
			'label'       => esc_html__( 'Page Banner', 'talemy' ),
			'section'     => 'ld_general',
			'default'     => '',
			'priority'    => 10,
			'choices'     => talemy_get_option_page_banner_options(),
		);

		$controls[] = array(
			'type'        => 'image',
			'settings'    => 'ld_banner_image',
			'label'       => esc_html__( 'Banner Image', 'talemy' ),
			'section'     => 'ld_general',
			'default'     => '',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'ld_banner',
					'operator' => '==',
					'value'    => '',
				)
			),
			'output' => array(
				array(
					'element' => array( '.content-banner' ),
					'property' => 'background-image',
				)
			)
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'ld_banner_shortcode',
			'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
			'section'     => 'ld_general',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'ld_archive_banner',
					'operator' => '==',
					'value'    => 'shortcode',
				)
			)
		);

		// course archive
		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_courses_list_style',
			'label'       => esc_html__( 'Listing Style', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => 'list',
			'priority'    => 10,
			'choices'     => talemy_get_option_course_list_styles(),
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_courses_thumb_size',
			'label'       => esc_html__( 'Image Size', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => 'talemy_thumb_small',
			'choices'     => talemy_get_option_image_sizes(),
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_courses_columns',
			'label'       => esc_html__( 'Columns', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => '4',
			'choices'     => talemy_get_option_columns(),
			'active_callback'  => array(
				array(
					'setting'  => 'ld_courses_list_style',
					'operator' => 'in',
					'value'    => array( 'grid', 'grid2', 'masonry' )
				),
			)
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_courses_tablet_columns',
			'label'       => esc_html__( 'Tablet Columns', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => '3',
			'choices'     => talemy_get_option_tablet_columns(),
			'active_callback'  => array(
				array(
					'setting'  => 'ld_courses_list_style',
					'operator' => 'in',
					'value'    => array( 'grid', 'grid2', 'masonry' )
				),
			)
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_courses_mobile_columns',
			'label'       => esc_html__( 'Mobile Columns', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => '1',
			'choices'     => talemy_get_option_mobile_columns(),
			'active_callback'  => array(
				array(
					'setting'  => 'ld_courses_list_style',
					'operator' => 'in',
					'value'    => array( 'grid', 'grid2', 'masonry' )
				),
			)
		);

		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => 'ld_courses_layout',
			'label'       => esc_html__( 'Layout', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => 'full-width',
			'choices'     => talemy_get_option_layouts()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_courses_sidebar',
			'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => '',
			'choices'     => talemy_get_option_sidebars()
		);

		$controls[] = array(
			'type'        => 'multicheck',
			'settings'    => 'ld_courses_meta_data',
			'label'       => esc_html__( 'Meta Data', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => array( 'level', 'duration', 'language' ),
			'priority'    => 10,
			'choices'     => array(
				'level' => esc_html__( 'Level', 'talemy' ),
				'language' => esc_html__( 'Language', 'talemy' ),
				'duration' => esc_html__( 'Duration', 'talemy' ),
				'enrolled' => esc_html__( 'Students', 'talemy' )
			)
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_courses_pagination',
			'label'       => esc_html__( 'Pagination Type', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => 'numeric',
			'priority'    => 10,
			'choices'     => talemy_get_option_pagination_type()
		);

		$controls[] = array(
			'type'        => 'number',
			'settings'    => 'ld_courses_ppl',
			'label'       => esc_html__( 'Posts Per Load', 'talemy' ),
			'default'     => 5,
			'section'     => 'ld_courses',
			'priority'    => 10,
			'choices'     => array(
				'min'  => 0,
				'step' => 1
			)
		);

		$controls[] = array(
			'type'        => 'slider',
			'settings'    => 'ld_courses_max_loads',
			'label'       => esc_html__( 'Max Loads ( Infinite Scroll )', 'talemy' ),
			'description'       => esc_html__( 'The number of loads before a load more button will appear. Set 0 to always use infinite scroll.', 'talemy' ),
			'section'     => 'ld_courses',
			'default'     => 3,
			'priority'    => 10,
			'choices'     => array(
				'min' => 0,
				'max' => 50,
				'step' => 1
			)
		);

		// course single
		
		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => 'ld_course_layout',
			'label'       => esc_html__( 'Content Layout', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => 'sidebar-right',
			'priority'    => 10,
			'choices'     => talemy_get_option_layouts()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_course_style',
			'label'       => esc_html__( 'Content Style', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => '2',
			'priority'    => 10,
			'choices'     => array(
				'1' => esc_html__( 'Style 1', 'talemy' ),
				'2' => esc_html__( 'Style 2', 'talemy' )
			)
		);

		$controls[] = array(
			'type'        => 'sortable',
			'settings'    => 'ld_course_sections',
			'label'       => esc_html__( 'Sections', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => array( 'overview', 'curriculum', 'instructors', 'reviews' ),
			'priority'    => 10,
			'choices'     => array(
				'overview' => esc_html__( 'Overview', 'talemy' ),
				'curriculum' => esc_html__( 'Curriculum', 'talemy' ),
				'instructors' => esc_html__( 'Instructors', 'talemy' ),
				'reviews' => esc_html__( 'Reviews', 'talemy' ),
			),
			'tooltip' => esc_html__( 'Show or hide an item by clicking the eye icon. Drag and drop the items to sort the display order.', 'talemy' ),
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_course_sections_layout',
			'label'       => esc_html__( 'Section Layout', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => 'toggles',
			'priority'    => 10,
			'choices'     => array(
				'tabs' => esc_html__( 'Tabs', 'talemy' ),
				'toggles' => esc_html__( 'Toggles', 'talemy' ),
				'default' => esc_html__( 'Default', 'talemy' ),
			),
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'ld_course_section_title_overview',
			'label'       => esc_html__( 'Title - Overview', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => esc_html__( 'Overview', 'talemy' ),
			'priority'    => 10
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'ld_course_section_title_curriculum',
			'label'       => esc_html__( 'Title - Curriculum', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => esc_html__( 'Curriculum', 'talemy' ),
			'priority'    => 10
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'ld_course_section_title_instructors',
			'label'       => esc_html__( 'Title - Instructors', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => esc_html__( 'Instructors', 'talemy' ),
			'priority'    => 10
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'ld_course_section_title_reviews',
			'label'       => esc_html__( 'Title - Reviews', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => esc_html__( 'Reviews', 'talemy' ),
			'priority'    => 10
		);

		$controls[] = array(
			'type'        => 'toggle',
			'settings'    => 'ld_course_related',
			'label'       => esc_html__( 'Show Related Courses', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => 1,
			'priority'    => 10
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'ld_course_related_type',
			'label'       => esc_html__( 'Related Type', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => '',
			'priority'    => 10,
			'choices'     => array(
				'cat' => esc_html__( 'Category', 'talemy' ),
				'tag' => esc_html__( 'Tag', 'talemy' ),
				'cat_or_tag' => esc_html__( 'Category or Tag', 'talemy' ),
				'author' => esc_html__( 'Author', 'talemy' ),
				'' => esc_html__( 'All', 'talemy' )
			)
		);

		$controls[] = array(
			'type'        => 'number',
			'settings'    => 'ld_course_related_count',
			'label'       => esc_html__( 'Number of related posts', 'talemy' ),
			'section'     => 'ld_course',
			'default'     => 3,
			'priority'    => 10,
			'choices'     => array(
				'min'  => 0,
				'step' => 1,
			),
		);
	}

	// bbPress

	if ( class_exists( 'bbPress' ) ) {

		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => 'bbp_layout',
			'label'       => esc_html__( 'Layout', 'talemy' ),
			'section'     => 'bbpress',
			'default'     => 'sidebar-right',
			'choices'     => talemy_get_option_layouts()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'bbp_sidebar',
			'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
			'section'     => 'bbpress',
			'default'     => '',
			'choices'     => talemy_get_option_sidebars( true )
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'bbp_banner',
			'label'       => esc_html__( 'Page Banner', 'talemy' ),
			'section'     => 'bbpress',
			'default'     => '',
			'priority'    => 10,
			'choices'     => talemy_get_option_page_banner_options(),
		);

		$controls[] = array(
			'type'        => 'image',
			'settings'    => 'bbp_banner_image',
			'label'       => esc_html__( 'Banner Image', 'talemy' ),
			'section'     => 'bbpress',
			'default'     => '',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'bbp_banner',
					'operator' => '==',
					'value'    => '',
				)
			),
			'output' => array(
				array(
					'element' => array( '.content-banner' ),
					'property' => 'background-image',
				)
			)
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'bbp_banner_shortcode',
			'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
			'section'     => 'bbpress',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'bbp_banner',
					'operator' => '==',
					'value'    => 'shortcode',
				)
			)
		);
	}

	// BuddyPress

	if ( class_exists( 'BuddyPress' ) ) {

		$controls[] = array(
			'type'        => 'radio-image',
			'settings'    => 'bp_layout',
			'label'       => esc_html__( 'Layout', 'talemy' ),
			'section'     => 'buddypress',
			'default'     => 'sidebar-right',
			'choices'     => talemy_get_option_layouts()
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'bp_sidebar',
			'label'       => esc_html__( 'Default Sidebar', 'talemy' ),
			'section'     => 'buddypress',
			'default'     => '',
			'choices'     => talemy_get_option_sidebars( true )
		);

		$controls[] = array(
			'type'        => 'select',
			'settings'    => 'bp_banner',
			'label'       => esc_html__( 'Page Banner', 'talemy' ),
			'section'     => 'buddypress',
			'default'     => '',
			'priority'    => 10,
			'choices'     => talemy_get_option_page_banner_options(),
		);

		$controls[] = array(
			'type'        => 'image',
			'settings'    => 'bp_banner_image',
			'label'       => esc_html__( 'Banner Image', 'talemy' ),
			'section'     => 'buddypress',
			'default'     => '',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'bp_banner',
					'operator' => '==',
					'value'    => '',
				)
			),
			'output' => array(
				array(
					'element' => array( '.content-banner' ),
					'property' => 'background-image',
				)
			)
		);

		$controls[] = array(
			'type'        => 'text',
			'settings'    => 'bp_banner_shortcode',
			'label'       => esc_html__( 'Banner Shortcode', 'talemy' ),
			'section'     => 'buddypress',
			'priority'    => 10,
			'active_callback'  => array(
				array(
					'setting'  => 'bp_banner',
					'operator' => '==',
					'value'    => 'shortcode',
				)
			)
		);

		$controls[] = array(
			'type'        => 'toggle',
			'settings'    => 'bp_nav_messages',
			'label'       => esc_html__( 'Show Nav Messages', 'talemy' ),
			'section'     => 'buddypress',
			'default'     => true,
			'priority'    => 10
		);

		$controls[] = array(
			'type'        => 'toggle',
			'settings'    => 'bp_nav_notifications',
			'label'       => esc_html__( 'Show Nav Notifications', 'talemy' ),
			'section'     => 'buddypress',
			'default'     => true,
			'priority'    => 10
		);
	}

	return $controls;
}
add_filter( 'kirki_controls', 'talemy_customizer_settings' );

/* -----------------------------------------------------------------------------
 * Config customizer
 * ----------------------------------------------------------------------------- */

Kirki::add_config( 'talemy', array(
    'capability'    => 'edit_theme_options',
    'option_type'   => 'theme_mod',
));

function talemy_kirki_configuration( $config ) {
	return array(
		'logo_image'   => '',
		'description'  => 'Talemy',
		'color_accent' => '#006799',
		'color_back'   => '#FFFFFF',
		'disable_loader' => true
	);
}
add_filter( 'kirki_config', 'talemy_kirki_configuration' );

// add custom css
function talemy_dynamic_css( $css ) {
    return SF_Fonts::get_frontend_style() . $css . get_theme_mod( 'custom_css', '' );
}
add_filter( 'kirki_global_dynamic_css', 'talemy_dynamic_css' );

// dynamic css method - inline/file
if ( 'file' == talemy_get_option( 'dynamic_css_method' ) ) {
	add_filter( 'kirki_dynamic_css_method', function() {
	    return 'file';
	});
}

