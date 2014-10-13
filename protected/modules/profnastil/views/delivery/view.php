<?php
/* @var $this DeliveryController */
/* @var $model ProfnastilDelivery */

$this->breadcrumbs=array(
	'Profnastil Deliveries'=>array('index'),
	$model->delivery_id,
);

$this->menu=array(
	array('label'=>'List ProfnastilDelivery', 'url'=>array('index')),
	array('label'=>'Create ProfnastilDelivery', 'url'=>array('create')),
	array('label'=>'Update ProfnastilDelivery', 'url'=>array('update', 'id'=>$model->delivery_id)),
	array('label'=>'Delete ProfnastilDelivery', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->delivery_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ProfnastilDelivery', 'url'=>array('admin')),
);
?>

<h1>View ProfnastilDelivery #<?php echo $model->delivery_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'delivery_id',
		'delivery_name',
	),
)); ?>
