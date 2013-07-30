<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginFormBackEnd extends LoginForm
{

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentityBackEnd($this->email,$this->password);
			if(!$this->_identity->authenticate())
            {

            }
		}
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
