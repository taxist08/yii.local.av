<?php
/* @var $this StuffController */
/* @var $model ProfnastilStuff */

$this->breadcrumbs=array(
	'Profnastil Stuffs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ProfnastilStuff', 'url'=>array('index')),
	array('label'=>'Manage ProfnastilStuff', 'url'=>array('admin')),
);
?>

<h1>Create ProfnastilStuff</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>