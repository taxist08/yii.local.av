<?php
/* @var $this StuffController */
/* @var $model ProfnastilStuff */

$this->breadcrumbs=array(
	'Profnastil Stuffs'=>array('index'),
	$model->stuff_id=>array('view','id'=>$model->stuff_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProfnastilStuff', 'url'=>array('index')),
	array('label'=>'Create ProfnastilStuff', 'url'=>array('create')),
	array('label'=>'View ProfnastilStuff', 'url'=>array('view', 'id'=>$model->stuff_id)),
	array('label'=>'Manage ProfnastilStuff', 'url'=>array('admin')),
);
?>

<h1>Update ProfnastilStuff <?php echo $model->stuff_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>