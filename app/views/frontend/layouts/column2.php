<?php $this->beginContent('//layouts/main'); ?>
    <div class="container-fluid" id="page">

        <?php
        $this->widget('bootstrap.widgets.TbNavbar', array(
            'brand' => Yii::app()->params['name'],
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label'=>'Home', 'url'=>array('/site/index')),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    )
                )
            )
        ));
        ?>

        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
        <?php endif?>

        <div class="container-fluid">
        <?php echo $content; ?>
        </div>

    </div>
<?php $this->endContent(); ?>