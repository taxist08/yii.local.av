<?php

class CartrigesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public function actionSearch()
    {
        $this->render('search');
    }

    public function actionIndex()
    {

        $model = new Cartriges('search');
        $model->unsetAttributes();
        if (isset($_GET['Cartriges']))
            $model->attributes = $_GET['Cartriges'];
        $this->render('index', array('model' => $model, ));

    }
    public function actionView($id)
    {
        $cartrige = Cartriges::model()->findByPk($id);
        $crt = new CDbCriteria();
        $crt->condition = 't.cartrige_id = :param ';
        $crt->params = array(':param' => $id);
        $statuses = new CActiveDataProvider('CartrigesMove', array('criteria' => $crt, ));

        $this->render('view', array('cartrige' => $cartrige, 'statuses' => $statuses));

    }

    public function actionCreate()
    {
        $model = new Cartriges('create');

        // uncomment the following code to enable ajax-based validation

        if (isset($_POST['ajax']) && $_POST['ajax'] === 'cartriges-create-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if (isset($_POST['Cartriges'])) {
            $model->attributes = $_POST['Cartriges'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();
                $this->redirect(array('/cartriges/' . $model->getPrimaryKey()));
                return;
            }
        }
        $this->render('create', array('model' => $model, ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Cartriges'])) {
            $model->attributes = $_POST['Cartriges'];
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->save();
                $this->redirect(array('/cartriges/' . $model->getPrimaryKey()));
                return;
            }
        }
        $this->render('create', array('model' => $model, ));
    }


    public function actionMove($id)
    {

        $model = $this->loadModel($id);
        $move = new CartrigesMove;

        if (isset($_POST['CartrigesMove'])) {
            $move->attributes = $_POST['CartrigesMove'];
            $move->user_id = Yii::app()->user->id;
            $move->cartrige_id = $id;
            $move->move_date = time();

            if ($move->validate()) {

                $move->save();
                $this->redirect(array('view', 'id' => $id));
            } else {

            }
        }

        $this->render('move', array('model' => $model, 'move' => $move));


    }
    // Uncomment the following methods and override them if needed
    /*
    public function filters()
    {
    // return the filter configuration for this controller, e.g.:
    return array(
    'inlineFilterName',
    array(
    'class'=>'path.to.FilterClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }

    public function actions()
    {
    // return external action classes, e.g.:
    return array(
    'action1'=>'path.to.ActionClass',
    'action2'=>array(
    'class'=>'path.to.AnotherActionClass',
    'propertyName'=>'propertyValue',
    ),
    );
    }
    */
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return InvnomItem the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Cartriges::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
    
    /**
     * AutoComplete Destination
     * */
    public function actionSuggestDest()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = CartrigesMove::model()->suggestDest($_GET['term']);
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->destination,
                    'value' => $m->destination,
                    );

            echo CJSON::encode($result);
        }
    }
}
