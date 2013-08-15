<?php
/**
 * Return config for backEnd app
 */
return CMap::mergeArray(

    require_once(dirname(__FILE__).'/shared.php'),

    array(
    'components'=>array(

        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
            'class' => 'WebUser',
            'loginUrl'=>array('admin/login'),
        ),

        // uncomment the following to enable URLs in path-format
        'urlManager'=>array(
            'urlFormat'=>'path',
            'showScriptName'=>false,
            'rules'=>array(
                'panel/gii'=>'gii',
                'panel/gii/<controller:\w+>'=>'gii/<controller>',
                'panel/gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
                '/panel'=>'admin/index',
                '/'=>'admin/index',
                '/panel/<_a>/'=>'admin/<_a>/',
                '/panel/<_c>/<_a>/*'=>'<_c>/<_a>/*',
            ),
        ),

        'cache' => array (
            'class'=>'system.caching.CDummyCache',
        ),

        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters'=>array('127.0.0.1','127.0.1.1'),
                ),
            ),
        ),

        'errorHandler'=>array(
            'errorAction'=>'admin/error',
        ),

    ),
        'modules'=> array(
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password'=>'root',
                'ipFilters'=>array('127.0.0.1','::1'),
                'generatorPaths' => array(
                    'ext.giix-core', // giix generators
                    'bootstrap.gii',
                ),
            ),
        ),
));