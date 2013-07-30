<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
    public $email;
    public $password;
    public $rememberMe;
    public $verifyCode;

    public $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
    public function rules()
    {
        return array(
            // username and password are required
            array('email, password', 'required'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
            array('verifyCode', 'captcha', 'on'=>'withCaptcha'),
        );
    }

	/**
	 * Declares attribute labels.
	 */
    public function attributeLabels()
    {
        return array(
            'email'=> Yii::t('app','E-mail'),
            'password'=> Yii::t('app','Password'),
            'rememberMe'=> Yii::t('app','Remember me'),
            'verifyCode'=> Yii::t('app','Verify code'),
        );
    }

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{

	}

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if($this->_identity===null)
        {
            $this->_identity=new UserIdentityBackEnd($this->email,$this->password);
            $this->_identity->authenticate();
        }
        if($this->_identity->errorCode===UserIdentityBackEnd::ERROR_NONE)
        {
            $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity,$duration);
            return true;
        }
        else
        {
            if($this->_identity->errorCode===UserIdentityBackEnd::ERROR_USERNAME_INVALID)
                $this->addError("email", "User not found");
            elseif($this->_identity->errorCode===UserIdentityBackEnd::ERROR_PASSWORD_INVALID)
                $this->addError("password", "Incorrect password");

            return false;
        }
    }
}
