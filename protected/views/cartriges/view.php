<?php


$this->breadcrumbs = array(
    Yii::t("cartriges", 'Cartriges') => array('index'),
    $cartrige->cartrige_id,
    );
$this->menu = array(
    array('label' => Yii::t("cartriges", 'Cartriges'), 'url' => array('index')),
    array(
        'label' => Yii::t("cartriges", 'ADD cartrige'),
        'url' => array('create'),
        'visible' => Yii::app()->user->checkAccess('cartrigeAdmin'),
        ),
    array(
        'label' => Yii::t("cartriges", 'Change status'),
        'url' => array('move', 'id' => $cartrige->cartrige_id),
        'visible' => Yii::app()->user->checkAccess('cartrigeManager'),
        ),
            array(
        'label' => Yii::t("cartriges", 'Edit'),
        'url' => array('update', 'id' => $cartrige->cartrige_id),
        'visible' => Yii::app()->user->checkAccess('cartrigeAdmin'),
        ),
    );
?>
<h2><?php echo Yii::t("cartriges", 'View information of ') . $cartrige->
cartrige_id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $cartrige,

    'attributes' => array(
        array(
            'name' => 'type_id',
            'label' => Yii::t("cartriges", 'Type'),
            'value' => $cartrige->type->model_name,
            ),
        array(
            'name' => 'comment',
            'label' => Yii::t("cartriges", 'Comments'),
            'value' => $cartrige->comment,
            ),
        ),
    )); ?> 
<h2><?php echo Yii::t("cartriges", 'Status history'); ?></h2>    

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $statuses,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'user_id',
            'header' => Yii::t("cartriges", 'User'),
            'value' => '$data->user_id?$data->user->full_name:""',
            'sortable' => true,
            ),
        array(
            'name' => 'move_date',
            'header' => Yii::t("cartriges", 'Date'),
            'value' => 'date("Y-m-d",$data->move_date)',
            'sortable' => true,
            ),
        array(
            'name' => 'destination',
            'header' => Yii::t("cartriges", 'Destination'),
            'value' => '$data->destination',
            'sortable' => true,
            ),
        array(
            'name' => 'move_type',
            'header' => Yii::t("cartriges", 'Status'),
            'value' => '$data->mtype->type_name',
            ),
        ),
    ));

?>
