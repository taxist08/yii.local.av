<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__file__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'New AVMG Site', // preloading 'log' component
    'preload' => array('log'), // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.user.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.extensions.yiidebugtb.*',
        'ext.KeenActiveDataProvider',
        'ext.RelatedSearchBehavior',
        ),
    'modules' => array(
        'user' => array('tableUsers' => 'tbl_user'), // uncomment the following to enable the Gii tool
        'profnastil', 
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'pass',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array(
                '192.168.2.124',
                '::1',
                '*'),
            ),
        ),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'LdapUser',
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            ),
        'authManager' => array(
            'class' => 'PhpAuthManager',
            'defaultRoles' => array('guest'),
            ),
        'clientScript' => array('packages' => array('dataTables' => array(
                    'baseUrl' => '/',
                    'js' => array('js/jquery.dataTables.min.js',
                            'js/jquery.dataTables.columnFilter.js'),
                    'css' => array('css/jquery.dataTables.css'),
                    'depends' => array('jquery.ui'),
                    ), ), ),
        // uncomment the following to enable URLs in path-format

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '.html',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ),
            ),

        'ldap' => array(
            'class' => 'LdapComponent',
            'baseDn' => 'DC=avmg,DC=loc',
            'accountSuffix' => '@avmg.loc',
            'domainControllers' => array('192.168.3.12'),
            'adminUsername' => 'technical.reader',
            'adminPassword' => '******************'),
        // uncomment the following to use a MySQL database

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=yii',
            'emulatePrepare' => true,
            'username' => 'yii',
            'password' => 'yii',
            'charset' => 'utf8',
            ),
        'errorHandler' => array( // use 'site/error' action to display errors
                'errorAction' => 'site/error', ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                    ), // uncomment the following to show log messages on web pages
                array( // наша конфигурация
                    'class' => 'XWebDebugRouter',
                    'config' => 'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
                    'levels' => 'error, warning, trace, profile, info',
                    ),

                /*
                array(
                'class'=>'CWebLogRoute',
                ),
                */
                ),
            ),
        ), // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array( // this is used in contact page
            'adminEmail' => 'webmaster@example.com', ),
    'sourceLanguage' => 'en',
    'language' => 'ru',
   // 'messages'=>array('profnastil'=>'application.modules.profnastil.messages',),
    );
