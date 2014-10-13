<?php

class QueueskController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $cssFile = '/css/sk.css';

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */


    /*    function beforeAction()
    {
    //  $cs = Yii::app()->getClientScript();
    //  $cs->registerCssFile('sk.css');
    }
    */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'view',
                    'update1c',
                    'test'),
                'roles' => array('skSklad'),
                ),
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'create',
                    'preview',
                    'suggest',
                    'suggestDist',
                    'suggestBrand',
                    'update',
                    ),
                'roles' => array('skManager'),
                ),
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', ),
                'roles' => array('authorized'),
                ),
            array(
                'deny', // deny all users
                'users' => array('*'),
                ),
            );
    }

    public function actionIndex()
    {
        $model = new QueueSk();
        $model->unsetAttributes();
        if (isset($_GET['QueueSk']))
            $model->attributes = $_GET['QueueSk'];

        $this->render('index', array('model' => $model, ));
    }

    public function actionDownload($id)
    {
        $model = $this->loadModel($id);

        if ($model->attach_src !== null) {
            // некоторая логика по обработке пути из url в путь до файла на сервере
            $currentFile = $model->attach_src;

            if (is_file($currentFile)) {
                header("Content-Type: application/octet-stream");
                header("Accept-Ranges: bytes");
                header("Content-Length: " . filesize($currentFile));
                header("Content-Disposition: attachment; filename=" . $model->attach);
                readfile($currentFile);
            }
            ;
        } else {
            throw new CHttpException(404, Yii::t("sk", 'Access denidet.'));
        }
        ;
    }


    public function actionCreate()
    {
        if (!Yii::app()->user->checkAccess('skManager')) {
            throw new CHttpException(403, Yii::t("sk", 'Access denidet.'));
        }
        $model = new QueueSk;

        // uncomment the following code to enable ajax-based validation
        /*
        if(isset($_POST['ajax']) && $_POST['ajax']==='queue-sk-create-form')
        {
        echo CActiveForm::validate($model);
        Yii::app()->end();
        }
        */

        if (isset($_POST['QueueSk'])) {
            $model->attributes = $_POST['QueueSk'];
            $model->attach = CUploadedFile::getInstance($model, 'attach');
            if ($model->validate()) {
                // form inputs are valid, do something here

                $model->user_id = Yii::app()->user->id;
                if ($model->save()) {

                    $queue_id = $model->getPrimaryKey();
                    $status = new QueueSkStatus;
                    $status->queue_id = $queue_id;
                    $status->user_id = Yii::app()->user->id;
                    $status->date_add = time();
                    $status->status_id = '1';
                    $status->save();
                }
                $this->redirect(array('queuesk/' . $queue_id));
                return;
            }
        }
        $this->render('create', array('model' => $model));
        return;
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {

        $model = new QueueSk();
        if (isset($_POST['changeStatus'])) {
            $status = new QueueSkStatus;
            $status->queue_id = $id;
            $status->user_id = Yii::app()->user->id;
            $status->date_add = time();
            $status->status_id = $_POST['changeStatus'];
            $status->save();

            if ($_POST['changeStatus'] == '4') {
                $model = $this->loadModel($id);
                $model->priority = '-100';
                $model->save();
            }

        }
        if (isset($_POST['seal'])) {
            $model = $this->loadModel($id);
            $model->seal = $_POST['seal'];

            $model->save();
        }
        if (isset($_POST['comment'])) {
            $comment = new QueueSkComments;
            $comment->queue_id = $id;
            $comment->user_id = Yii::app()->user->id;
            $comment->date_add = time();
            $comment->comment = $_POST['comment'];
            $comment->save();

        }
        //$this->render('create', array('model' => $model));

        $crt = new CDbCriteria();
        $crt->condition = 't.queue_id = :param ';
        $crt->params = array(':param' => $id);
        $crt->order = 'date_add asc';

        $status = new CActiveDataProvider('QueueSkStatus', array('criteria' => $crt, ));
        $comments = new CActiveDataProvider('QueueSkComments', array('criteria' => $crt, ));

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'status' => $status,
            'comments' => $comments));
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return InvnomItem the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = QueueSk::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
    /**
     * Update model.
     * @param integer $id the ID of the model to be updatind
     */
    public function actionUpdate($id)
    {

        $model = $this->loadModel($id);
        if (isset($_POST['QueueSk'])) {
            $model->attributes = $_POST['QueueSk'];
            if ($attach= CUploadedFile::getInstance($model, 'attach')){
                $model->attach =$attach;     
            }
            $model->save();
            $this->redirect(array('queuesk/view/'.$id));
        return;
        }

        $this->render('create', array('model' => $model));
        return;
    }

    /**
     * Delete model.
     * @param integer $id the ID of the model to be deleting
     */
    public function actionDelete($id)
    {

        $model = $this->loadModel($id);
        $crt = new CDbCriteria();
        $crt->condition = 't.queue_id = :param ';
        $crt->params = array(':param' => $id);
        $statuses = QueueSkStatus::model()->findAll($crt);
        foreach ($statuses as $status) {
            $status->delete();
        }
        $comments = QueueSkComments::model()->findAll($crt);
        foreach ($comments as $comment) {
            $comment->delete();
        }
        $model->delete();
        $this->redirect(array('queuesk/'));

    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionChengestatus($id)
    {

        $crt = new CDbCriteria();
        $crt->condition = 't.item_id = :param ';
        $crt->params = array(':param' => $id);

        // $moves = InvnomMove::model()->findAll($crt);
        $moves = new CActiveDataProvider('InvnomMove', array('criteria' => $crt, ));

        $this->render('view', array('model' => $this->loadModel($id), 'moves' => $moves));
    }

    public function actionPriorityup($id)
    {
        if (!Yii::app()->user->checkAccess('skTopmanager')) {
            throw new CHttpException(403, Yii::t("sk", 'Access denidet.'));
        }
        $comment = new QueueSkComments;
        $comment->queue_id = $id;
        $comment->user_id = Yii::app()->user->id;
        $comment->date_add = time();
        $comment->comment = Yii::t("sk", 'Priority changed') . '+1';
        $comment->save();

        $model = $this->loadModel($id);
        $model->priority++;
        $model->save();
        $this->redirect(array('queuesk/' . $id));
        return;
    }
    public function actionPrioritydown($id)
    {
        if (!Yii::app()->user->checkAccess('skTopmanager')) {
            throw new CHttpException(403, Yii::t("sk", 'Access denidet.'));
        }

        $comment = new QueueSkComments;
        $comment->queue_id = $id;
        $comment->user_id = Yii::app()->user->id;
        $comment->date_add = time();
        $comment->comment = Yii::t("sk", 'Priority changed') . '-1';
        $comment->save();

        $model = $this->loadModel($id);
        $model->priority--;
        $model->save();
        $this->redirect(array('queuesk/' . $id));
        return;
    }

}
