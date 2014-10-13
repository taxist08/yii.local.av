<?php
/* @var $this StatusController */
/* @var $model ProfnastilStatus */

$this->breadcrumbs=array(
	'Profnastil Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProfnastilStatus', 'url'=>array('index')),
	array('label'=>'Manage ProfnastilStatus', 'url'=>array('admin')),
);
?>

<h1>Create ProfnastilStatus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>