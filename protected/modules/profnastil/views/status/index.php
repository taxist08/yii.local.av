<?php
/* @var $this StatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Profnastil Statuses',
);

$this->menu=array(
	array('label'=>'Create ProfnastilStatus', 'url'=>array('create')),
	array('label'=>'Manage ProfnastilStatus', 'url'=>array('admin')),
);
?>

<h1>Profnastil Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
