<?php
/* @var $this ProfnastilController */
/* @var $model Profnastil */

$this->breadcrumbs=array(
	Yii::t("ProfnastilModule.profnastil", 'queue profnastil')=>array('index'),
);

$this->menu=array(
	array('label'=>Yii::t("ProfnastilModule.profnastil", 'List Orders'), 'url'=>array('index')),
	array('label'=>Yii::t("ProfnastilModule.profnastil", 'Create Order'), 'url'=>array('create')),
);

?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'profnastil-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name' => 'order_id',
            'header' => Yii::t("ProfnastilModule.profnastil", 'Order number'),
            'value' => '$data->order_id',
            'sortable' => true,
         ),
        array(
            'name' => 'date_add',
            'header' => Yii::t("ProfnastilModule.profnastil", 'Date add'),
            'type' => 'raw',
            'htmlOptions' => array('align' => 'center', 'style' => 'width: 123px;'),
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'id' => 'date_add',
                'attribute' => 'date_add',
                'htmlOptions' => array('style' => 'width: 80px;'),
                'options' => array('dateFormat' => 'yy-mm-dd', 'changeYear' => true),
                ), true),
            ),
        array(
            'name' => 'user_id',
            'header' => Yii::t("ProfnastilModule.profnastil", 'User name'),
            'value' => '$data->user->full_name',
            'sortable' => true,
         ),   
        array(
            'name' => 'stuff_id',
            'header' => Yii::t("ProfnastilModule.profnastil", 'Stuff'),
            'value' => '$data->stuff->stuff_name',
            'filter' => CHtml::listData(ProfnastilStuff::model()->findAll(), 'stuff_id',
                'stuff_name'),
            'sortable' => true,
         ),   
        array(
            'name' => 'mark',
            'header' => Yii::t("ProfnastilModule.profnastil", 'Mark'),
            'value' => '$data->mark',
            'sortable' => true,
         ),                     
        array(
            'name' => 'raw',
            'header' => Yii::t("ProfnastilModule.profnastil", 'Raw'),
            'value' => '$data->raw',
            'sortable' => true,
         ),
		/*
		'thickness',
		'length',
		'quantity',
		'volume',
		'status_id',
		'city',
		'delivery_id',
		'comment',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
