<?php

function ldcm_get_allowed_html_for_embed() {
	return array(
		'iframe' => array(
			'allowfullscreen' => true,
			'frameborder' => true,
			'height' => true,
			'src' => true,
			'width' => true,
			'allow' => true,
			'class' => true,
			'data-playerid' => true,
			'allowtransparency' => true,
			'style' => true,
			'name' => true,
			'watch-type' => true,
			'url-params' => true,
			'scrolling' => true
		),
		'video' => array(
			'class' => true,
			'controls' => true,
			'autoplay' => true,
			'height' => true,
			'width' => true,
			'src' => true
		),
		'script' => array(
			'src' => true
		),
		'source' => array(
			'src' => true,
			'media' => true,
			'sizes' => true,
			'type' => true
		),
		'track' => array(
			'default' => true,
			'src' => true,
			'srclang' => true,
			'kind' => true,
			'label' => true
		),
	);
}