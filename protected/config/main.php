<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
        'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        'name'=>'Fabcms 0.2',

        // preloading 'log' component
        'preload'=>array('log'),


        // autoloading model and component classes
        'import'=>array(
                'application.models.*',
                'application.modules.fab.models.*',
                'application.components.*',
        ),

        'modules'=>array(
                'fab'=>array(
                        'siteName'=>'Fabcms Manage',
                        'layout'=>'main',
                ),
        ),

        'language' => 'zh_cn',

        // application components
        'components'=>array(
                'cache'=>array(
                        'class'=>'system.caching.CFileCache',
                ),
                'urlManager'=>array(
                        'urlFormat'=>'path',
                       // 'showScriptName'=>false,
                ),
                'log'=>array(
                        'class'=>'CLogRouter',
                        'routes'=>array(
                                array(
                                        'class'=>'CFileLogRoute',
                                        'levels'=>'trace, error, warning, info, all',
                                //'levels'=>'all, error, warning',
                                ),
                        ),
                ),
                'user'=>array(
                        'allowAutoLogin'=>true,
                        'loginUrl'=>array('/fab/user/login'),
                ),
                'User'=>array(
                        'class' => 'User',
                ),
                'db'=>array(
                        'connectionString'=>'mysql:host=localhost;dbname=f2',
						'enableParamLogging'=>true,
						'enableProfiling'=>true,
						'emulatePrepare' => true,
                        'username'=>'f2',
                        'password'=>'f2',
                        'charset'=>'utf8',
                ),
        ),

        // application-level parameters that can be accessed
        // using Yii::app()->params['paramName']
        'params'=>array(
        // this is used in contact page
                'adminEmail'=>'wgq91here@gmail.com',
				'mainsite'=>'http://fab.jsedu.sh.cn',
				'cachesite'=>'http://fab.jsedu.sh.cn/fab/',
        ),
);
