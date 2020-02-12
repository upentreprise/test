<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope="itemscope" itemtype="https://schema.org/WebPage">
	<div class="site">
		<?php talemy_page_loader(); ?>
		<?php get_template_part( 'templates/off-canvas-left' ); ?>
		<?php get_template_part( 'templates/off-canvas-right' ); ?>
		<div class="site-overlay"></div>
		<div class="site-main">
		<?php get_template_part( 'templates/header/header', talemy_get_option( 'header_style' ) ); ?>
