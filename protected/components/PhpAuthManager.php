<?php

class PhpAuthManager extends CPhpAuthManager {

    public function init() {
        // Иерархию ролей расположим в файле auth.php в директории config приложения
        if ($this->authFile === null) {
            $this->authFile = Yii::getPathOfAlias('application.config.auth') . '.php';
        }

        parent::init();

        // Для гостей у нас и так роль по умолчанию guest.
        if (!Yii::app()->user->isGuest) {
            // Связываем группы из AD с ролями и юзерами
           
            $existingRoles = $this->getRoles();
               
            if (isset(Yii::app()->user->groups)) {
                foreach (Yii::app()->user->groups as $group) {

                    if (isset($existingRoles[$group])) {
                        $this->assign($group, Yii::app()->user->id);
                    }
                }
            }
                 
        }
    }
}
?>