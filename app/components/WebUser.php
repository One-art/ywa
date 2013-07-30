<?php
class WebUser extends CWebUser {
    private $_model = null;
    private $_access = array();
    public $username;

    function getRole() {
        if($user = $this->getModel()){
            // Table {User} have column "role"
            return $user->role;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }

    protected function beforeLogin(){
        return true;
    }


    /**
     * Grub all user access [and caching it]
     * @param string $operation
     * @param array $params
     * @param bool $allowCaching
     * @return bool
     */
    public function checkAccess($operation, $params=array(), $allowCaching=true)
    {
        $cachId = Yii::app()->user->id.$operation;

        if (!isset($this->_access[$operation]) && Yii::app()->cache->get($cachId) === false) {
            $access = Yii::app()->getAuthManager()->checkAccess($operation, $this->getId(), $params);
            Yii::app()->cache->set($cachId, (int) $access, 60*60*10);
            return $this->_access[$operation] = $access;
        }

        if (!isset($this->_access[$operation])) {
            $access = (boolean) Yii::app()->cache->get($cachId);
            $this->_access[$operation] = $access;
            return $access;
        }

        return $this->_access[$operation];
    }
}