<?php
/* @var $this DeliveryController */
/* @var $model ProfnastilDelivery */

$this->breadcrumbs=array(
	'Profnastil Deliveries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProfnastilDelivery', 'url'=>array('index')),
	array('label'=>'Manage ProfnastilDelivery', 'url'=>array('admin')),
);
?>

<h1>Create ProfnastilDelivery</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>