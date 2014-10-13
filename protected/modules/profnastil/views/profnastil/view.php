<?php
/* @var $this ProfnastilController */
/* @var $model Profnastil */

$this->breadcrumbs=array(
	'Profnastils'=>array('index'),
	$model->order_id,
);

$this->menu=array(
	array('label'=>'List Profnastil', 'url'=>array('index')),
	array('label'=>'Create Profnastil', 'url'=>array('create')),
	array('label'=>'Update Profnastil', 'url'=>array('update', 'id'=>$model->order_id)),
	array('label'=>'Delete Profnastil', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->order_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Profnastil', 'url'=>array('admin')),
);
?>

<h1>View Profnastil #<?php echo $model->order_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'order_id',
		'date_add',
		'user_id',
		'stuff_id',
		'mark',
		'raw',
		'thickness',
		'length',
		'quantity',
		'volume',
		'status_id',
		'city',
		'delivery_id',
		'comment',
	),
)); ?>
