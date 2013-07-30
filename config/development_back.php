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

        'errorHandler'=>array(
            'errorAction'=>'admin/error',
        ),

    ),
));