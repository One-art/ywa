<?php

class AdminController extends BackEndController
{
    public $layout='//layouts/column2';

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('login', 'error', 'captcha'),
                'users'=>array('?'),
            ),
            array('allow',
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('?'),
            ),
            array('deny'),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page'=>array(
                'class'=>'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        if(!Yii::app()->user->isGuest)
            $this->redirect(array('index'));

        $model=new LoginFormBackEnd();
        if(Yii::app()->user->getState('login-error', 0)==1)
        {
            $model->scenario = 'error';
        }

        if(isset($_POST['LoginFormBackEnd']))
        {
            $model->attributes=$_POST['LoginFormBackEnd'];

            if($model->validate() && $model->login())
            {
                $this->redirect(array('index'));
            }
        }

        $this->render('login',array('model'=>$model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(array('index'));
    }
}