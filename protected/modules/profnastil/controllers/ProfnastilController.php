<?php

class ProfnastilController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','SuggestMark','SuggestRaw','SuggestCity'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Profnastil;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profnastil']))
		{
			$model->attributes=$_POST['Profnastil'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->order_id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Profnastil']))
		{
			$model->attributes=$_POST['Profnastil'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->order_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model=new Profnastil('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profnastil']))
			$model->attributes=$_GET['Profnastil'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Profnastil('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Profnastil']))
			$model->attributes=$_GET['Profnastil'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Profnastil the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Profnastil::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Profnastil $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='profnastil-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    /**
     * AutoComplete Makr
     * */
    public function actionSuggestMark()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = Profnastil::model()->suggestTag('mark',$_GET['term']);
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->mark,
                    );

            echo CJSON::encode($result);
        }
    }
    /**
     * AutoComplete Raw
     * */
    public function actionSuggestRaw()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = Profnastil::model()->suggestTag('raw',$_GET['term']);
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->raw,
                    );

            echo CJSON::encode($result);
        }
    } 
    /**
     * AutoComplete City
     * */
    public function actionSuggestCity()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = Profnastil::model()->suggestTag('city',$_GET['term']);
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->city,
                    );

            echo CJSON::encode($result);
        }
    }         
}
