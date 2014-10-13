<?php
/* @var $this InvnomBrandController */
/* @var $model InvnomBrand */

$this->breadcrumbs=array(
	'Invnom Brands'=>array('index'),
	$model->brand_id,
);

$this->menu=array(
	array('label'=>'List InvnomBrand', 'url'=>array('index')),
	array('label'=>'Create InvnomBrand', 'url'=>array('create')),
	array('label'=>'Update InvnomBrand', 'url'=>array('update', 'id'=>$model->brand_id)),
	array('label'=>'Delete InvnomBrand', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->brand_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvnomBrand', 'url'=>array('admin')),
);
?>

<h1>View InvnomBrand #<?php echo $model->brand_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'brand_id',
		'brand_name',
	),
)); ?>
