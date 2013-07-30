<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentityBackEnd extends UserIdentity
{
    private $_id;

    public function authenticate(){

        $user = User::model()->find('LOWER(email)=? AND role = ?', array(strtolower($this->username), 'admin'));
        if($user===null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif((md5($this->password)!==$user->password))
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {

            $this->_id = $user->user_id;
            $this->username = $user->name;
            $this->setState('username', $user->name);
            $this->role = $user->role;
            $this->errorCode = self::ERROR_NONE;
            //update last visit without validate
            $user->lastvisit = time();
            $user->save(false);

        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getUsername()
    {
        return $this->username;
    }
}