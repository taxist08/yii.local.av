<?php
/* @var $this StatusController */
/* @var $model ProfnastilStatus */

$this->breadcrumbs=array(
	'Profnastil Statuses'=>array('index'),
	$model->status_id=>array('view','id'=>$model->status_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ProfnastilStatus', 'url'=>array('index')),
	array('label'=>'Create ProfnastilStatus', 'url'=>array('create')),
	array('label'=>'View ProfnastilStatus', 'url'=>array('view', 'id'=>$model->status_id)),
	array('label'=>'Manage ProfnastilStatus', 'url'=>array('admin')),
);
?>

<h1>Update ProfnastilStatus <?php echo $model->status_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>