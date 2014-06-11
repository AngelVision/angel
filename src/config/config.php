<?php

$config = array(
	// Migrations use the 'languages' setting in their logic.
	// As such, the database schema changes depending upon whether multiple languages need support.
	'languages'			=> true,
	'language_primary'	=> 'en',
	// All models that have a language relationship must be defined here.
	'language_models'	=> array(
		'Page'
	),

	// All linkable models must be declared here.
	// 'Model Name' => 'uri'
	'linkable_models'	=> array(
		'Page' => 'pages'
	),

	// This is the route URI prefix for the admin pages.
	// You may set this to blank for no prefix.
	'admin_prefix' => '',

	// This is the menu in the admin console.
	// Add modules here after installation.
	// 'Name' => 'uri'
	'menu' => array(
		'Pages'		=> 'pages',
		'Menus'		=> 'menus',
		'Users'		=> 'users',
		'Settings'	=> 'settings'
	)
);

if ($config['languages'] && Session::get('superadmin')) {
	$config['menu']['Languages'] = 'languages';
}

return $config;