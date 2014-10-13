<?php
class LdapIdentity extends CUserIdentity
 {

    protected $_id;
    
    /**
     * Authenticates a user via LDAP.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {

        $ldap = Yii::app()->ldap;

        $result = $ldap->authenticate($this->username, $this->password);
        $ldapUserInfo = $ldap->user()->infoCollection($this->username, array("mail", "displayname"));


        if (!$result) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else {

        $this->setState('fullname', $ldapUserInfo->displayname);
        $this->setState('email', $ldapUserInfo->mail);

            $dbUser = Users::model()->findByAttributes(array('ldap' => $this->username));
            if (!$dbUser) {
                $dbUser = new Users();
                $dbUser->ldap = $this->username;
                $dbUser->full_name = $ldapUserInfo->displayname;
                $dbUser->pass = $this->password;
                $dbUser->mail = $ldapUserInfo->mail;
                $dbUser->salt = 'f';
                $dbUser->url = 'f';
                $dbUser->create = time();

                $dbUser->save();
                //print_r($dbUser);
            }
            
            $this->_id = $dbUser->primaryKey;

            $this->errorCode = self::ERROR_NONE;
        
        }


        return !$this->errorCode;
    }

    public function getId() {
       return $this->_id;
    }
    
}
