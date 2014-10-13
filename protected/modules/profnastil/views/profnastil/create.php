<?php
/* @var $this ProfnastilController */
/* @var $model Profnastil */

$this->breadcrumbs=array(
	'Profnastils'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Profnastil', 'url'=>array('index')),
	array('label'=>'Manage Profnastil', 'url'=>array('admin')),
);
?>

<h1>Create Profnastil</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>