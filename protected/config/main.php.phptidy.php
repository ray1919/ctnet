<?php
/**
 * main.php
 *
 * @package default
 */


// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CT Bioscience Office',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.yii-mail.*',
		'application.extensions.*',
	),

	'modules'=>array(
		'userGroups'=>array(
			'accessCode'=>'demo',
		),
		'media'=>array(
			// Base dir for media browser (app/files):
			'baseDir'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'files',
		),
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'demo',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1', '::1', '192.168.1.178'),
		),
	),

	// application components
	'components'=>array(
		'mail'=>array(
			'class' => 'application.extensions.yii-mail.YiiMail',
			'viewPath' => 'application.views.mail',
			'logging' => true,
			'dryRun' => false,
			'transportType'=>'smtp',     // case sensitive!
			'transportOptions'=>array(
				'host'=>'smtp.163.com',   // smtp服务器
				'username'=>'ctbioscience@163.com',    // 验证用户
				'password'=>'ctb051989886883',   // 验证密码
				'port'=>'25',           // 端口号
				//'encryption'=>'ssl',
			),
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'userGroups.components.WebUserGroups',
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=ctnet',
			'emulatePrepare' => true,
			'username' => 'ctnet',
			'password' => 'ctnet',
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
		'adminEmail'=>'ctbioscience@163.com',
		'webmasterEmail'=>'zzqr@163.com',
	),
);
