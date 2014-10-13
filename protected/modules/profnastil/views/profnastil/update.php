<?php
/* @var $this ProfnastilController */
/* @var $model Profnastil */

$this->breadcrumbs=array(
	'Profnastils'=>array('index'),
	$model->order_id=>array('view','id'=>$model->order_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Profnastil', 'url'=>array('index')),
	array('label'=>'Create Profnastil', 'url'=>array('create')),
	array('label'=>'View Profnastil', 'url'=>array('view', 'id'=>$model->order_id)),
	array('label'=>'Manage Profnastil', 'url'=>array('admin')),
);
?>

<h1>Update Profnastil <?php echo $model->order_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>