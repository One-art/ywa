<?php
/**
 * Return config for frontend app
 */

return CMap::mergeArray(

    require_once(dirname(__FILE__).'/shared.php'),

    array(
        'components'=> array(
            'user'=>array(
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'class' => 'WebUser',
                'loginUrl'=>array('site/login'),
            ),

            'urlManager'=>array(
                'urlFormat'=>'path',
                'showScriptName'=>false,
                'rules'=>array(
                    'gii'=>'gii',
                    'gii/<controller:\w+>'=>'gii/<controller>',
                    'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
                    '' => 'site/index',
                    '<_a>/'=>'site/<_a>/',
                    '<_c>/<_a>/'=>'<_c>/<_a>/',
                    '<_c>/<_a>/*'=>'<_c>/<_a>/',
                ),
            ),

            'cache' => array (
                'class'=>'system.caching.CDummyCache',
            ),

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
                    array(
                        'class'=>'CFileLogRoute',
                        'levels'=>'info',
                        'categories'=>'system.*',
                    ),
                    array(
                        'class'=>'CProfileLogRoute',
                        'levels'=>'profile',
                        'enabled'=>true,
                    ),
                ),
            ),
        ),
        'modules'=> array(
            'gii' => array(
                'class' => 'system.gii.GiiModule',
                'password'=>'root',
                'ipFilters'=>array('127.0.0.1','::1'),
                'generatorPaths' => array(
                    'ext.giix-core', // giix generators
                ),
            ),
        ),
));

