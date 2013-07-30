<?php
class BaseController extends CController
{
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }
    
    /**
     * флеш-нотис пользователю
     * @param $message
     * @return mixed
     */
    public function setNotice($message)
    {
        return Yii::app()->user->setFlash('notice', $message);		
    }
    
    /**
     * флеш-ошибка пользователю
     * @param $message
     * @return mixed
     */
    public function setError($message)
    {
        return Yii::app()->user->setFlash('error', $message);		
    }

    /**
     * Update captcha after validate false
     * @return bool
     */
    public function updateCaptchaCache() {
        $session = Yii::app()->session;
        $prefixLen = strlen(CCaptchaAction::SESSION_VAR_PREFIX);
        foreach($session->keys as $key)
        {
            if(strncmp(CCaptchaAction::SESSION_VAR_PREFIX, $key, $prefixLen) == 0)
                $session->remove($key);
        }

        return true;
    }
    
}