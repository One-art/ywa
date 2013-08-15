<?php
/**
 * Shared settings for all application types
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__) .DS. '..'));

require_once ROOT.DS.'app' . DS.'components'.DS.'helpers'.DS.'functions.php';


return CMap::mergeArray(
    array(
        'basePath'    => ROOT.DS.'app',
        'name'        => 'My Web Application',
        'runtimePath' => ROOT . DS . 'tmp',

        'behaviors'=>array(
            'runEnd'=>array(
                'class'=>'application.behaviors.WebApplicationEndBehavior',
            ),
        ),

        // preloading 'log' component
        'preload' => array('log', 'bootstrap'),

        // autoloading model and component classes
        'import' => array(
            'application.controllers.*',
            'application.components.*',
            'application.components.base.*',
            'application.components.exceptions.*',
            'application.components.helpers.*',
            'ext.giix-components.*',
            'application.models.*',
        ),
        'aliases' => array(
            'xupload' => 'ext.xupload'
        ),

        // application components
        'components' => array(
            'authManager' => array(
                'class' => 'PhpAuthManager',
                'defaultRoles' => array('guest'),
            ),
            'bootstrap' => array(
                'class' => 'ext.yiiBooster.components.Bootstrap',
                'responsiveCss' => true,
            ),

            'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=sceleton',
                'charset' => 'utf8',
                'username' => 'root',
                'password' => 'root',
                'tablePrefix' => '',
                'emulatePrepare' => true,
                'enableProfiling'=>true,
                'enableParamLogging' => true,
                'schemaCacheID'=>'cache',
                'schemaCachingDuration'=>3600,
            ),

        ),
    ),
    require_once(dirname(__FILE__).'/settings.php')
);
