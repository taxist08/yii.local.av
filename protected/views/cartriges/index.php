<?php
/* @var $this CartrigesController */



$this->breadcrumbs = array(Yii::t("cartriges", 'Cartriges'));
$this->menu = array(
    array(
        'label' => Yii::t("cartriges", 'ADD cartrige'),
        'url' => array('create'),
        'visible' => Yii::app()->user->checkAccess('cartrigeAdmin'),
        ), 
    array(
        'label' => Yii::t("cartriges", 'Manage Cartriges Type'),
        'url' => array('/cartrigesType'),
        'visible' => Yii::app()->user->checkAccess('cartrigeAdmin'),
        ),         
        
        );
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'template' => '{items}{pager}',
    'filter' => $model,
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'name' => 'cartrige_id',
            'header' => Yii::t("cartriges", 'Cartrige number'),
            'value' => '$data->cartrige_id',
            //   'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),
        array(
            'name' => 'type_id',
            'header' => Yii::t("cartriges", 'Type'),
            'value' => '$data->type->model_name',
            'filter' => CHtml::listData(CartrigesType::model()->findAll(), 'type_id',
                'model_name'),
            'sortable' => true,
            ),
        array(
            'name' => 'laststatus',
            'header' => Yii::t("cartriges", 'Status'),
            'value' => '@$data->laststatus->type_name',
            'sortable' => true,
            'filter' => false,
            ),
        array(
            'name' => 'lastsmove',
            'header' => Yii::t("cartriges", 'Destination'),
            'value' => '@$data->lastsmove->destination',
            'filter' => false,
            ),
            

        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{move}',
            'buttons' => array('move' => array(
                    'label' => Yii::t("invnom", 'Movement'),
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/move.png',
                    'url' => 'Yii::app()->createUrl("cartriges/move", array("id"=>$data->cartrige_id))',
                    'visible' => 'Yii::app()->user->checkAccess("cartrigeManager")',
                    ),   'update' => array('visible' => 'Yii::app()->user->checkAccess("cartrigeAdmin")', ),
                    ),
            ),
        ),
    )); ?> 