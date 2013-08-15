<?php

Yii::import('application.models._base.BaseUser');

class User extends BaseUser
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_PARTNER = 'partner';

    public $passwordConfirm;
    public $newPassword;
    public $newPasswordConfirm;

    static $roleBackEnd = array(self::ROLE_ADMIN);
    static $roleFrontEnd = array(self::ROLE_USER);

    public function init() {

    }

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function getRoleOptions()
    {
        return array(
            array('id'=>self::ROLE_CUSTOMER, 'title'=>Yii::t('user', 'Customer')),
            array('id'=>self::ROLE_PARTNER, 'title'=>Yii::t('user', 'Partner')),
            array('id'=>self::ROLE_ADMIN, 'title'=>Yii::t('user', 'Admin')),
        );
    }

    public function getRoleOption($option=null)
    {
        if($option==null && $this->role)
            $option = $this->role;

        if($option == self::ROLE_CUSTOMER)
            return Yii::t('user', 'Customer');
        elseif($option == self::ROLE_PARTNER)
            return Yii::t('user', 'Partner');
        elseif($option == self::ROLE_ADMIN)
            return Yii::t('user', 'Admin');
    }

    public function afterFind() {
        return parent::afterFind();
    }

    public function afterSave() {
        if($this->isNewRecord){

            if($this->inviteModel)
            {
                $this->inviteModel->status = Invite::STATUS_USED;
                $this->inviteModel->used_by_user_id = $this->user_id;
                $this->inviteModel->save();
            }

        }
        return parent::afterSave();
    }

    public function beforeValidate() {
        if($this->isNewRecord){
            if(empty($this->language_id))
                $this->language_id = Languages::model()->getLanguageByCode(Yii::app()->language)->language_id;
            $this->time_reg = time();

            $ip = LoginLog::model()->getIpAddress();
            $country = geoip_country_code_by_name($ip);
            if($country)
            {
                $this->country_id = Country::model()->findByAttributes(array('code'=>$country))->country_id;
            }



        }
        return parent::beforeValidate();
    }

    public function afterValidate() {
        if($this->isNewRecord){
        }
        return parent::afterValidate();
    }

    public function beforeSave() {
        if($this->isNewRecord){
            if($this->password)
                $this->password = md5($this->password);
        } else {
            // TODO: add checkAccess for change password
            if($this->newPassword)
                $this->password = md5($this->newPassword);
        }
        return parent::beforeSave();
    }

    public function beforeDelete() {
        return parent::beforeDelete();
    }

    public function afterDelete() {
        return parent::afterDelete();
    }

    public function rules() {

        return CMap::mergeArray(parent::rules(), array(
                array('passwordConfirm', 'required', 'on'=>'signUp'),
                array('name', 'unsafe', 'on'=>'update'),
                array('passwordConfirm', 'compare', 'compareAttribute'=>'password', 'allowEmpty'=>false, 'on'=>'signUp'),
                array('newPasswordConfirm', 'compare', 'compareAttribute'=>'newPassword', 'allowEmpty'=>false, 'on'=>'update'),
                array('newPassword, newPasswordConfirm, password', 'length', 'max'=>50, 'min'=>6),
                array('newPassword, password', 'match', 'pattern'=>'/^[a-z0-9@_\-]{6,}/i', 'message'=>Yii::t('user', 'Allowed characters: 0-9, a-Z, @, _, -')),
                array('name', 'match', 'pattern'=>'/^[a-z0-9@_\-]{4,20}/i', 'message'=>Yii::t('user', 'Allowed characters: 0-9, a-Z, @, _, -')),
                array('email', 'email'),
                array('email, name', 'unique'),
                array('contact', 'length', 'max'=>15),
                array('verifyCode', 'captcha', 'on'=>'signUp'),
                //array('role, time_reg, status', 'readOnly'=>true, 'on'=>'UserUpdate'),
            )
        );
    }

    public function attributeLabels() {
        return CMap::mergeArray(parent::attributeLabels(), array(
                'passwordConfirm' => Yii::t('user', 'Password confirm'),
                'newPassword' => Yii::t('user', 'Change password'),
                'newPasswordConfirm' => Yii::t('user', 'Change password confirm'),
            )
        );
    }

    public function relations()
    {
        return CMap::mergeArray(parent::relations(), array(
            'language'   => array(self::BELONGS_TO, 'Languages', 'language_id'),
            'country'   => array(self::BELONGS_TO, 'Country', 'country_id'),
            'balance'   => array(self::BELONGS_TO, 'Balance', 'user_id', 'select'=>'SUM(balance.amount) as balanceSum', 'together'=>'true'),
        ));
    }

    public function getNameWithLabel() {

        if($this->name)
            return ($this->color!=self::COLOR_DEFAULT)
                ?
                $this->name.' <span class="label label-'.$this->colorClass[$this->color].'">#'.$this->user_id.'</span>'
                :
                $this->name.' #'.$this->user_id;

    }

    public function getColorLabel() {
        if($this->color!=self::COLOR_DEFAULT)
            return '<span class="label label-'.$this->colorClass[$this->color].'">'.$this->ColorOption.'</span>';
        else
            return Yii::t('user', 'Default (No color)');
    }
}