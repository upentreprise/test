<?php 
defined( 'ABSPATH' ) || exit;
return array (
  'homepage' => 'https://programmes.espaceatman.com',
  'cache_options' => 
  array (
    'breeze-active' => '1',
    'breeze-ttl' => 1440,
    'breeze-minify-html' => '0',
    'breeze-minify-css' => '0',
    'breeze-minify-js' => '0',
    'breeze-gzip-compression' => '0',
    'breeze-browser-cache' => '0',
    'breeze-desktop-cache' => 1,
    'breeze-mobile-cache' => 1,
    'breeze-disable-admin' => '1',
    'breeze-display-clean' => '1',
    'breeze-include-inline-js' => '0',
    'breeze-include-inline-css' => '0',
  ),
  'disable_per_adminuser' => '1',
  'exclude_url' => 
  array (
    0 => '/panier',
    1 => '/en/cart',
    2 => '/commande/*',
    3 => '/en/checkout/*',
    4 => '/mon-compte/*',
    5 => '/en/my-account/*',
    6 => 'https://programmes.espaceatman.com/mon-compte/',
    7 => 'https://programmes.espaceatman.com/wp-content/plugins/woocommerce/templates/myaccount/my-account.php',
  ),
); 
