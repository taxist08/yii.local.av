<?php
/* @var $this InvnomitemController */
/* @var $model InvnomItem */

$this->breadcrumbs = array(
    Yii::t("invnom", 'Inventory numbers') => array('index'),
    $model->item_id,
    );

$this->menu = array(
    array('label' => Yii::t("invnom", 'Inventory numbers'), 'url' => array('index')),
    array(
        'label' => Yii::t("invnom", 'Movement'),
        'url' => array('move', 'id' => $model->item_id),
        'visible' => Yii::app()->user->checkAccess('invnomManager'),
        ),
    array(
        'label' => Yii::t("invnom", 'Create item'),
        'url' => array('create'),
        'visible' => Yii::app()->user->checkAccess('invnomCreator'),
        ),

    array(
        'label' => Yii::t("invnom", 'Edit Device'),
        'url' => array('update', 'id' => $model->item_id),
        'visible' => Yii::app()->user->checkAccess('invnomCreator'),
        ),
    array(
        'label' => Yii::t("invnom", 'Edit 1c'),
        'url' => array('update1c', 'id' => $model->item_id),
        'visible' => !Yii::app()->user->checkAccess('invnomCreator'),
        ),        
    );
?>

<h2><?php echo Yii::t("invnom", 'View information of ') . $model->inv_nom; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,

    'attributes' => array(
        array(
            'name' => 'type_name',
            'label' => Yii::t("invnom", 'Device type'),
            'value' => $model->type->type_name,
            ),
        array(
            'name' => 'brand',
            'label' => Yii::t("invnom", 'Brand'),
            'value' => $model->brand->brand_name,
            ),
        array(
            'name' => 'item_model',
            'label' => Yii::t("invnom", 'Device Model'),
            'value' => $model->item_model,
            ),
        array(
            'name' => 'item_sn',
            'label' => Yii::t("invnom", 'Device SN'),
            'value' => $model->item_sn,
            ),
        array(
            'name' => 'inv_1c',
            'label' => Yii::t("invnom", 'Inventory 1c'),
            'value' => $model->inv_1c?$model->inv_1c:"",
            ),            
        array(
            'name' => 'date_add',
            'label' => Yii::t("invnom", 'Date add'),
            'value' => date("Y-m-d", $model->date_add),
            ),
        array(
            'name' => 'comment',
            'label' => Yii::t("invnom", 'Comments'),
            'value' => $model->comment,
            ),            
        ),
    )); ?>

<h2><?php echo Yii::t("invnom", 'Movement') . ' ' . $model->type->type_name .
' ' . $model->item_model . ' ' . Yii::t("invnom", 'Inventory number') . ' ' . $model->
    inv_nom; ?></h2>    

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $moves,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'user_id',
            'header' => Yii::t("invnom", 'User'),
            'value' => '$data->user_id?$data->user->full_name:""',
            'sortable' => true,
            ),
        array(
            'name' => 'move_date',
            'header' => Yii::t("invnom", 'Route date'),
            'value' => 'date("Y-m-d",$data->move_date)',
            'sortable' => true,
            ),
        array(
            'name' => 'destination_name',
            'header' => Yii::t("invnom", 'Destination'),
            'value' => '$data->destination_name',
            'sortable' => true,
            ),
        array(
            'name' => 'comments',
            'header' => Yii::t("invnom", 'Comments'),
            'value' => '$data->comments?$data->comments:""',
            ),
        ),
    ));

?>