<?php

Yii::import('application.vendors.adLDAP.adLDAP');

class LdapComponent extends adLDAP {

    public $baseDn;
    public $accountSuffix;
    public $domainControllers;
    public $adminUsername;
    public $adminPassword;

    public function __construct() {

    }

    public function init() {
        parent::__construct();
    }
}
?>