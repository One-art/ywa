<!DOCTYPE html>
<html lang="<?=Yii::app()->language?>">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="<?=Yii::app()->language?>" />
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/main.css'); ?>
    <?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/font-awesome/css/font-awesome.min.css'); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?=$content?>

</body>
</html>
