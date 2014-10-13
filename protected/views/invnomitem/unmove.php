<?php
/* @var $this InvnomitemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(Yii::t("invnom", 'Inventory numbers'), );

$this->menu = array(
    array('label' => Yii::t("invnom", 'Inventory numbers'), 'url' => array('index')),
    array('label' => Yii::t("invnom", 'Create item'), 'url' => array('create'),'visible' => Yii::app()->user->checkAccess('invnomCreator'),),
    );

?>

<h1><?php echo Yii::t("invnom", 'Inventory numbers'); ?></h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
    // 'template' => '{items}{pager}',
    'filter' => $model,
    'dataProvider' => $model->searchnull(),
    'columns' => array(
        array(
            'name' => 'distribution',
            'header' => Yii::t("invnom", 'Distribution'),
            'value' => '$data->distribution',
            'filter' => InvnomItem::model()->getDistList(),
            'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),
        array(
            'name' => 'type_id',
            'header' => Yii::t("invnom", 'Device type'),
            'value' => '$data->type->type_name',
            'filter' => CHtml::listData(InvnomItemType::model()->findAll(), 'type_id',
                'type_name'),
            'sortable' => true,
            ),
        array(
            'name' => 'inv_nom',
            'header' => Yii::t("invnom", 'Inventory number'),
            'value' => '$data->inv_nom',
            'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),
        array(
            'name' => 'inv_1c',
            'header' => Yii::t("invnom", 'Inventory 1c'),
            'value' => '$data->inv_1c?$data->inv_1c:""',
            'sortable' => true,
            'visible'=>!(Yii::app()->user->checkAccess('invnomManager'))
            ),
        array(
            'name' => 'brand_id',
            'header' => Yii::t("invnom", 'Brand'),
            'value' => '$data->brand->brand_name',
            'filter' => CHtml::listData(InvnomBrand::model()->findAll(), 'brand_id',
                'brand_name'),
            'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),            
        array(
            'name' => 'item_model',
            'header' => Yii::t("invnom", 'Device Model'),
            'value' => '$data->item_model',
            'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),
        array(
            'name' => 'item_sn',
            'header' => Yii::t("invnom", 'Device SN'),
            'value' => '$data->item_sn',
            'sortable' => true,
            'visible'=>(Yii::app()->user->checkAccess('invnomManager'))
            ),
        array(
            'name' => 'destination',
            'header' => Yii::t("invnom", 'Destination'),
            'value' => '@$data->move[0]->destination_name',
            'sortable' => true,
            'visible'=>!(Yii::app()->user->checkAccess('invnomManager'))
            ),            
  /*      array(
            //'name' => 'move',
            'header' => Yii::t("invnom", 'Device SN'),
            'value' => '$data->move->move_date',
         //   'sortable' => true,
            ),            
*/
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{move}{delete}',
            'buttons' => array(
                'move' => array(
                    'label' => Yii::t("invnom", 'Movement'),
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/move.png',
                    'url' => 'Yii::app()->createUrl("invnomitem/move", array("id"=>$data->item_id))',
                    'visible' => 'Yii::app()->user->checkAccess("invnomManager")',
                    ),
                'update' => array('visible' => 'Yii::app()->user->checkAccess("invnomCreator")', ),
                'delete' => array('visible' => 'Yii::app()->user->checkAccess("invnomCreator")', ),
                ),
            ),
        ),
    //	'itemView'=>'_view',
    )); ?>    


