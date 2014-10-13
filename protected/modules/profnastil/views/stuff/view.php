<?php
/* @var $this StuffController */
/* @var $model ProfnastilStuff */

$this->breadcrumbs=array(
	'Profnastil Stuffs'=>array('index'),
	$model->stuff_id,
);

$this->menu=array(
	array('label'=>'List ProfnastilStuff', 'url'=>array('index')),
	array('label'=>'Create ProfnastilStuff', 'url'=>array('create')),
	array('label'=>'Update ProfnastilStuff', 'url'=>array('update', 'id'=>$model->stuff_id)),
	array('label'=>'Delete ProfnastilStuff', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->stuff_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProfnastilStuff', 'url'=>array('admin')),
);
?>

<h1>View ProfnastilStuff #<?php echo $model->stuff_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'stuff_id',
		'stuff_name',
	),
)); ?>
