<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>


<div class="row-fluid">
    <div class=" span4 offset4" >
        <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Sign In',
            'headerIcon' => 'icon-th-list',
            'htmlOptions' => array('style'=>'margin: 20% auto')
        ));?>
                <div class="box-content padded">

                    <?php $this->widget('bootstrap.widgets.TbAlert', array(
                        'block'=>true, // display a larger alert block?
                        'fade'=>true, // use transitions?
                        'closeText'=>'×', // close link text - if set to false, no close link is displayed
                    )); ?>

                    <?php
                    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'login-form',
                        'enableAjaxValidation'=>true,
                        'htmlOptions'=>array('class'=>'separate-sections', 'removeClass'=>true),
                        'type'=>'inline',
                    )); ?>

                    <?php echo $form->errorSummary($model); ?>
                    <?php echo $form->textFieldRow($model, 'email', array('prepend'=>'<i class="icon-user"></i>')); ?>
                    <?php echo $form->passwordFieldRow($model, 'password', array('prepend'=>'<i class="icon-key"></i>')); ?>
                    <br />
                    <div>
                    <?php echo $form->checkboxRow($model, 'rememberMe'); ?>
                    </div>
                    <div class="">
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            'encodeLabel'=>false,
                            'label'=>Yii::t('app', 'Login').' <i class="icon-signin"></i>',
                            'htmlOptions'=>array('class'=>'btn btn-primary'),
                        )); ?>
                    </div>

                    <?php $this->endWidget(); ?>

                    <div>
                        <?=CHtml::link(Yii::t('app', 'Don\'t have an account? Sign Up'), array('signUp'))?>
                    </div>
                </div>
        <?php $this->endWidget();?>
    </div>
</div>