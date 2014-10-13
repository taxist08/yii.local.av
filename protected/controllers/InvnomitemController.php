<?php
/**
 * 
 * SELECT `t`.`item_id` AS `t0_c0` , `t`.`type_id` AS `t0_c1` , `t`.`brand_id` AS `t0_c2` , `t`.`date_add` AS `t0_c3` , `t`.`distribution` AS `t0_c4` , `t`.`inv_nom` AS `t0_c5` , `t`.`inv_1c` AS `t0_c6` , `t`.`item_model` AS `t0_c7` , `t`.`item_sn` AS `t0_c8` , `t`.`comment` AS `t0_c9` , `move`.`rec_id` AS `t1_c0` , `move`.`item_id` AS `t1_c1` , `move`.`user_id` AS `t1_c2` , `move`.`destination_name` AS `t1_c3` , `move`.`move_date` AS `t1_c4` , `move`.`comments` AS `t1_c5`
FROM `invnom_item` `t`
LEFT OUTER JOIN `invnom_move` `move` ON ( `move`.`item_id` = `t`.`item_id` )
WHERE (
t.item_id =963
)
LIMIT 5 */

class InvnomitemController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array('accessControl', // perform access control for CRUD operations
                //           'postOnly + delete', // we only allow deletion via POST request
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
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'view',
                    'update1c',
                    'test',
                    'unmove',
                    ),
                'roles' => array('invnomReader'),
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
                    'unmove',
                    ),
                'roles' => array('invnomCreator'),
                ),
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('move', 'unmove',),
                'roles' => array('invnomManager'),
                ),
            array(
                'deny', // deny all users
                'users' => array('*'),
                ),
            );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {

        $crt = new CDbCriteria();
        //$crt->distinct = true;
        //$crt->select = "t.name";
        //$crt->join = '';

        $crt->condition = 't.item_id = :param ';
        $crt->params = array(':param' => $id);

       // $moves = InvnomMove::model()->findAll($crt);
        $moves = new CActiveDataProvider('InvnomMove', array('criteria' => $crt, ));

        $this->render('view', array('model' => $this->loadModel($id), 'moves' => $moves));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'preview' page.
     */
    public function actionCreate()
    {

        $model = new InvnomItem;

        $this->performAjaxValidation($model);
        if (isset($_POST['InvnomItem'])) {

            $model->attributes = $_POST['InvnomItem'];
            if ($model->validate()) {
                $items = array();
                $type = InvnomItemType::model()->findByPk($_POST['InvnomItem']['type_id']);
                $brand = InvnomBrand::model()->getBrandId($_POST['InvnomItem']['brand_id']);
                $max = InvnomItem::model()->getMaxNom($type->parent_id);
                for ($i = 1; $i <= $_POST['InvnomItem']['quantity']; $i++) {
                    $item = array(
                        'id' => $i,
                        'distribution' => $_POST['InvnomItem']['distribution'],
                        'type_id' => $_POST['InvnomItem']['type_id'],
                        'brand_id' => $brand,
                        'type_name' => $type->type_name,
                        'inv_nom' => $max + $i,
                        'date_add' => time(),
                        'item_model' => $_POST['InvnomItem']['item_model'],
                        'item_sn' => '',
                        );
                    $items[] = $item;

                }
                $itemsProvider = new CArrayDataProvider($items);
                $this->render('_previewform', array('items' => $items));
                exit;
            }
        }
        if (isset($_POST['InvnomPreview'])) {
            foreach ($_POST['InvnomPreview'] as $postitem) {
                $item = new InvnomItem;
                $item->attributes = $postitem;
                if ($item->validate()) {
                    $item->save();
                } else {
                    print_r($postitem);
                    die('Validate fail');
                }
            }
            $this->redirect(array('/invnomitem'));
        }

        $this->render('_createform', array('model' => $model));


    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['InvnomItem'])) {
            $model->attributes = $_POST['InvnomItem'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->item_id));
        }

        $this->render('update', array('model' => $model, ));
    }
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate1c($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['InvnomItem'])) {
            $model->attributes = $_POST['InvnomItem'];
            //   print_r($model->attributes);exit;
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->item_id));
        }

        $this->render('update1c', array('model' => $model, ));
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
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria;
        $criteria->with = (array('move'));
        $criteria->order="move.rec_id DESC";
        $criteria->together = true;        
        $model = new InvnomItem();
        $model->unsetAttributes();
        if (isset($_GET['InvnomItem']))
            $model->attributes = $_GET['InvnomItem'];
        $this->render('index', array('model' => $model, ));
    }
    /**
     * Lists models with out move.
     */
    public function actionUnmove()
    {
        $criteria = new CDbCriteria;
        $criteria->with = (array('move'));
        $criteria->order="move.rec_id DESC";
        $criteria->together = true;        
        $model = new InvnomItem();
        $model->unsetAttributes();
        if (isset($_GET['InvnomItem']))
            $model->attributes = $_GET['InvnomItem'];
        $this->render('unmove', array('model' => $model,  ));
    }
    
    /**
     * Search items in models.
     */
    public function actionSearch()
    {
        $model = new InvnomItem('search');
        $model->unsetAttributes();
        $dataProvider = new CActiveDataProvider('InvnomItem');
        $this->render('search', array('model' => $model, ));
    }
    /**
     * Move items in models.
     */
    public function actionMove($id)
    {

        $model = $this->loadModel($id);
        $move = new InvnomMove;

        if (isset($_POST['InvnomMove'])) {
            $move->attributes = $_POST['InvnomMove'];
            $move->user_id = Yii::app()->user->id;
            $move->item_id = $id;
            $move->move_date = time();
            if (isset($_POST['InvnomItem'])) {
                $model->item_sn = $_POST['InvnomItem']['item_sn'];
                if ($model->validate()) {
                    $model->save();
                }
            }
            if ($move->validate()) {

                $move->save();
                $this->redirect(array('view', 'id' => $id));
            } else {

            }
        }

        $this->render('move', array('model' => $model, 'move' => $move));


    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new InvnomItem('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['InvnomItem']))
            $model->attributes = $_GET['InvnomItem'];

        $this->render('admin', array('model' => $model, ));
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
        $model = InvnomItem::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param InvnomItem $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invnom-item-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    /**
     * AutoComplete
     * */
    public function actionSuggest()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = InvnomItem::model()->suggestTag($_GET['term']);
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->item_model,
                    'value' => $m->item_model,
                    'id' => $m->item_id,
                    );

            echo CJSON::encode($result);
        }
    }
    /**
     * AutoComplete Brand
     * */
    public function actionSuggestBrand()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = InvnomBrand::model()->getBrandList($_GET['term']);
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->brand_name,
                    'value' => $m->brand_name,
                    'id' => $m->brand_id,
                    );

            echo CJSON::encode($result);
        }
    }
    public function actionSuggestDist()
    {
        if (Yii::app()->request->isAjaxRequest && isset($_GET['term'])) {
            $models = InvnomItem::model()->suggestDist($_GET['term']);
            $result = array();
            foreach ($models as $m)
                $result[] = array(
                    'label' => $m->distribution,
                    'value' => $m->distribution,
                    //'id' => $m->brand_id,
                    );

            echo CJSON::encode($result);
        }
    }
    /**
     * Test.
     */
    public function actionTest()
    {
        $criteria = new CDbCriteria;
        $criteria->with = (array('move'));
        //$criteria->limit = 5;
      // $criteria->select = ('move.move_date');
       // $criteria->condition = 't.item_id=:item_id' ;
      // $criteria->params = array(':item_id'=>963);
        //$criteria->distinct = true;
        $criteria->order="move.rec_id DESC";
        $criteria->together = true;
        $item = InvnomItem::model()->findAll($criteria);
        foreach ($item as $i) {
            if (isset($i->move[0])){
                
            
            echo $i->move[0]->rec_id;
            }
            foreach ($i->move as $m){
               // CVarDumper::dump($m);   
                //echo $m->destination_name;             
            }
        }
    }
}
