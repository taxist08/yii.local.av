<?php
class LdapUser extends CWebUser {

    protected $_groups = null;
    protected $_model;

    /**
     * 
     * @return type
     */
    public function getGroups() {
        
        if ($this->_groups === null) {
            if ($user = $this->getModel()) {
                $this->_groups = Yii::app()->ldap->user()->groups($user->ldap);
            }
        }
        return $this->_groups;
    }

    /**
     * 
     * @return User
     */
    public function getModel() {
        
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = Users::model()->findByPk($this->id);
        }
        return $this->_model;
    }

}
