<?php
/* @var $this CartrigesTypeController */
/* @var $model CartrigesType */

$this->breadcrumbs=array(
    Yii::t("cartriges", 'Cartriges')=>array('/cartriges'),
	Yii::t("cartriges", 'Cartriges Types')=>array('index'),
	$model->type_id,
);

$this->menu=array(
	array('label'=>Yii::t("cartriges", 'List CartrigesType'), 'url'=>array('index')),
	array('label'=>Yii::t("cartriges", 'Create CartrigesType'), 'url'=>array('create')),
	array('label'=>Yii::t("cartriges", 'Update CartrigesType'), 'url'=>array('update', 'id'=>$model->type_id)),
//	array('label'=>Yii::t("cartriges", 'Delete CartrigesType'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t("cartriges", 'Manage CartrigesType'), 'url'=>array('admin')),
);
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'type_id',
		'model_name',
	),
)); ?>
