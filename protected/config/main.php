<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'defaultController' => 'main',


	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.shoppingCart.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			//'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('login/index'),
		),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'showScriptName'=>false,
			'urlFormat'=>'path',
			'rules'=>array(
				// '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				// '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				// '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				// 'login/' => 'login/index', 
				// 'login/<action:\w+>' => 'login/<action>', 
				// 'admin/' => 'admin/index', 
				// 'admin/<action:\w+>' => 'admin/<action>', 
				// '<action:\w+>/<id:\d+>'=>'main/<action>',
				// '<action:\w+>'=>'main/<action>',
				

			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			//'connectionString' => 'mysql:host=localhost;dbname=aaa1ru_pos',
			'connectionString' => 'mysql:host=localhost;dbname=aaa1ru_pos',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				
				array(
					'class'=>'CWebLogRoute',
					'levels' => 'info',
				),
				
			),
		),

		'yexcel' => array(
    		'class' => 'ext.yexcel.Yexcel'
    	),

    	'clientScript' => array(  
    		'packages' => array(  
        		'jquery' => array(  
            		'baseUrl' => 'js/',  
            		'js' => array('jQuery.js'),  
        			), 
        		'ajaxupload' => array(
        			'baseUrl' => 'js/',  
            		'js' => array('ajaxupload.min.js'),
        			),
        		'datatables' => array(
        			'baseUrl' => 'js/',  
            		'js' => array('jquery.dataTables.min.js'), 
        			) ,
        		'datatablesColumnFilter' => array(  
            		'baseUrl' => 'js/',  
            		'js' => array('jquery.datatables.columnfilter.js'),  
        			),
        		'jTruncate' => array(  
            		'baseUrl' => 'js/',  
            		'js' => array('jquery.jTruncate.min.js'),  
        			), 
     		)    
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'myDateFormat' => 'd-m-Y',
	),
);