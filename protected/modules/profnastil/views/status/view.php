<?php
/* @var $this StatusController */
/* @var $model ProfnastilStatus */

$this->breadcrumbs=array(
	'Profnastil Statuses'=>array('index'),
	$model->status_id,
);

$this->menu=array(
	array('label'=>'List ProfnastilStatus', 'url'=>array('index')),
	array('label'=>'Create ProfnastilStatus', 'url'=>array('create')),
	array('label'=>'Update ProfnastilStatus', 'url'=>array('update', 'id'=>$model->status_id)),
	array('label'=>'Delete ProfnastilStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->status_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProfnastilStatus', 'url'=>array('admin')),
);
?>

<h1>View ProfnastilStatus #<?php echo $model->status_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'status_id',
		'status_name',
		'color',
	),
)); ?>
