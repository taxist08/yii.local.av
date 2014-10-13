<?php

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->render('index');
    }
    public function actionCreate()
    {
        $model = new Profnastil;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='profnastil-create-form')
        {
        echo CActiveForm::validate($model);
        Yii::app()->end();
        }
        */

        if (isset($_POST['Profnastil'])) {
            $model->attributes = $_POST['Profnastil'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
        $this->render('create', array('model' => $model));
    }
}
