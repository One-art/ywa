<?php
$yii    = dirname(__FILE__).'/../framework/yii.php';

switch ($_SERVER['SERVER_ADDR']) {
    case '127.0.0.1':
    case '127.0.1.1':
        defined('YII_DEBUG') or define('YII_DEBUG',true);
        defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
        break;
}

require_once($yii);


switch ($_SERVER['SERVER_ADDR']) {
    case '127.0.0.1':
    case '127.0.1.1':
        $config = require ( dirname(__FILE__) . '/config/development_front.php' );
        break;
    default:
        $config = require ( dirname(__FILE__) . '/config/production_front.php' );
        break;
}




$app = Yii::createWebApplication($config)->runEnd('frontend');

$app->run();
