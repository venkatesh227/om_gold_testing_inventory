<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

	'name'=>'OM Gold Testing',

	// time zone
	'timeZone' => 'Asia/Kolkata',

	//theme installation
	'theme'=>'common',

	//default controlelr
	'defaultController'=>'dashboard/index',
	
	// preloading 'log' component
	'preload'=>array('log'),

	'aliases' => array(
	    'bootstrap' => 'ext.bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'bootstrap.behaviors.*',
		'bootstrap.helpers.*',
		'bootstrap.widgets.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'jagadeesh',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(

		'request' => array(
	        'enableCsrfValidation' => true,
	    ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'Webuser',
			'authTimeout' => 1800, // 5 mints
		),

		'session' => array(
	        'autoStart'=>true,
	        'timeout' => 1800, // 5mints
	    ),

		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>YII_DEBUG ? null : 'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'products'=>[1=>'Gold',/*2=>'Silver'*/],
		'inventoryTypes'=>[1=>'In Stock',2=>'Out Stock'],
		'inventoryTypesShort'=>[1=>'In',2=>'Out'],
		'dashboardSummaryNames'=>[1=>'In',2=>'Out',3=>"Balanace"],
		'pagenationLimit'=>20,
		'productWastage'=>["0.05"=>'0.05',"0.50"=>"0.50"],
	),
);


