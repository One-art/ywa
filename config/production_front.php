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
                    '' => 'site/index',
                    '<_a>/'=>'site/<_a>/',
                    '<_c>/<_a>/'=>'<_c>/<_a>/',
                    '<_c>/<_a>/*'=>'<_c>/<_a>/',
                ),
            ),

            'cache' => array (
                'class'=>'system.caching.CMemCache',
                'servers'=>array(
                    array('host'=>'localhost', 'port'=>11211),
                ),
            ),
        ),
    )
);

