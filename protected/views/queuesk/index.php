<?php
/* @var $this QueueskController */

$cs = Yii::app()->clientScript;
$cs->registerCssFile('/css/sk.css');

$this->breadcrumbs = array( Yii::t("sk", 'queue sk'));
$this->menu = array(array(
        'label' => Yii::t("sk", 'Create queue'),
        'url' => array('create'),
        'visible' => Yii::app()->user->checkAccess('skManager'),
        ), );
?>
<h1><?php echo Yii::t("sk", 'queue sk'); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    // 'template' => '{items}{pager}',
    'filter' => $model,
    'afterAjaxUpdate' => "function() { 
                jQuery('#date_out').datepicker(jQuery.extend(jQuery.datepicker.regional['ru'],{'showAnim':'fold','dateFormat':'yy-mm-dd'})); 
            }",
    'rowCssClassExpression'=>'$data->laststatus->status_type->color',
    'dataProvider' => $model->search(),
    'columns' => array(
        array(
            'name' => 'queue_number',
            'header' => Yii::t("sk", 'Queue number'),
            'value' => '$data->queue_number',
         //   'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),
        array(
            'name' => 'destination_name',
            'header' => Yii::t("sk", 'Destination'),
            'value' => '$data->destination_name',
            'sortable' => true,
            ),
        array(
            'name' => 'quantity',
            'header' => Yii::t("sk", 'Quantity'),
            'value' => '$data->quantity',
            'sortable' => true,
            ),
        array(
            'name' => 'date_out',
            'header' => Yii::t("sk", 'Date Out'),
            'type' => 'raw',
            'htmlOptions' => array('align' => 'center', 'style' => 'width: 123px;'),
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'id' => 'date_out',
                'attribute' => 'date_out',
                'htmlOptions' => array('style' => 'width: 80px;'),
                'options' => array('dateFormat' => 'yy-mm-dd', 'changeYear' => true),
                ), true),
            ),

        array(
            'name' => 'laststatus',
            'header' => Yii::t("sk", 'Status'),
            'value' => '@$data->laststatus->status_type->status_name',
            'sortable' => true,
            ),
        array(
            'name' => 'seal',
            'header' => Yii::t("sk", 'Seal'),
            'value' => '$data->seal',
            'sortable' => true,
            ),            
        array(
            'name' => 'car_number',
            'header' => Yii::t("sk", 'Car number'),
            'value' => '$data->car_number',
            'sortable' => true,
            ),
        array(
            'name' => 'car_info',
            'header' => Yii::t("sk", 'Car info'),
            'value' => '$data->car_info',
            'sortable' => true,
            ),                        
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}',
            'buttons' => array(
                'move' => array(
                    'label' => Yii::t("invnom", 'Movement'),
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/move.png',
                    'url' => 'Yii::app()->createUrl("invnomitem/move", array("id"=>$data->queue_id))',
                    'visible' => 'Yii::app()->user->checkAccess("invnomManager")',
                    ),
                'update' => array('visible' => '$data->user_id == Yii::app()->user->id || Yii::app()->user->checkAccess("skBuhgalter")', ),
                ),
            ),
        ),
    //	'itemView'=>'_view',
    )); ?> 