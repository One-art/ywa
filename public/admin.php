<?php

$yii    = dirname(__FILE__).'/../../framework/yii.php';
$local  = require (dirname(__FILE__) . '/../config/local/local.php');
$web  = require (dirname(__FILE__) . '/../config/web.php');
$shared = require dirname(__FILE__).'/../config/shared.php';
$backEnd = require dirname(__FILE__).'/../config/backEnd.php';


require_once($yii);

$config = CMap::mergeArray($shared, $web);
$config = CMap::mergeArray($config, $backEnd);
$config = CMap::mergeArray($config, $local);

$app = Yii::createWebApplication($config)->runEnd('backend');

$app->run();
