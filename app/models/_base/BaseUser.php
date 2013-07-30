<?php

/**
 * This is the model base class for the table "user".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "User".
 *
 * Columns in table "user" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $user_id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $contact
 * @property string $role
 * @property integer $lastvisit
 * @property integer $time_reg
 * @property integer $language_id
 * @property integer $status
 *
 */
abstract class BaseUser extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'user';
	}

	public static function label($n = 1) {
		return Yii::t('user', 'User|Users', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('name, email, password, contact, time_reg, language_id', 'required'),
			array('lastvisit, time_reg, language_id, country_id, status, invited_by_user_id, color', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			array('email', 'length', 'max'=>100),
			array('password', 'length', 'max'=>50),
			array('contact', 'length', 'max'=>500),
			array('role', 'length', 'max'=>20),
			array('language_code', 'length', 'max'=>5),
			array('role, lastvisit, language_code, country_id, status, invited_by_user_id, color', 'default', 'setOnEmpty' => true, 'value' => null),
			array('user_id, name, email, password, contact, role, lastvisit, time_reg, language_id, language_code, country_id, status, invited_by_user_id, color', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'user_id' => Yii::t('user', 'User'),
			'name' => Yii::t('user', 'Name'),
			'email' => Yii::t('user', 'Email'),
			'password' => Yii::t('user', 'Password'),
			'contact' => Yii::t('user', 'Contact'),
			'role' => Yii::t('user', 'Role'),
			'lastvisit' => Yii::t('user', 'Lastvisit'),
			'time_reg' => Yii::t('user', 'Time Reg'),
			'language_id' => Yii::t('user', 'Language'),
			'language_code' => Yii::t('user', 'Language Code'),
			'country_id' => Yii::t('user', 'Country'),
			'status' => Yii::t('user', 'Status'),
			'invited_by_user_id' => Yii::t('user', 'Invited By User'),
			'color' => Yii::t('user', 'Color'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('password', $this->password, true);
		$criteria->compare('contact', $this->contact, true);
		$criteria->compare('role', $this->role, true);
		$criteria->compare('lastvisit', $this->lastvisit);
		$criteria->compare('time_reg', $this->time_reg);
		$criteria->compare('language_id', $this->language_id);
		$criteria->compare('language_code', $this->language_code, true);
		$criteria->compare('country_id', $this->country_id);
		$criteria->compare('status', $this->status);
		$criteria->compare('invited_by_user_id', $this->invited_by_user_id);
		$criteria->compare('color', $this->color);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}