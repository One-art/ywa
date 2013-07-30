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
        'preload' => array('log'),

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

        // application components
        'components' => array(
        ),
    ),
    require_once(dirname(__FILE__).'/settings.php')
);
