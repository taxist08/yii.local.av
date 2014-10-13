<?php
/* @var $this DeliveryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Profnastil Deliveries',
);

$this->menu=array(
	array('label'=>'Create ProfnastilDelivery', 'url'=>array('create')),
	array('label'=>'Manage ProfnastilDelivery', 'url'=>array('admin')),
);
?>

<h1>Profnastil Deliveries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
