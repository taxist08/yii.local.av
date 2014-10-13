<?php
/* @var $this DeliveryController */
/* @var $model ProfnastilDelivery */

$this->breadcrumbs=array(
	'Profnastil Deliveries'=>array('index'),
	$model->delivery_id=>array('view','id'=>$model->delivery_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProfnastilDelivery', 'url'=>array('index')),
	array('label'=>'Create ProfnastilDelivery', 'url'=>array('create')),
	array('label'=>'View ProfnastilDelivery', 'url'=>array('view', 'id'=>$model->delivery_id)),
	array('label'=>'Manage ProfnastilDelivery', 'url'=>array('admin')),
);
?>

<h1>Update ProfnastilDelivery <?php echo $model->delivery_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>