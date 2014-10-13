<?php
/* @var $this InvnomBrandController */
/* @var $model InvnomBrand */

$this->breadcrumbs=array(
	'Invnom Brands'=>array('index'),
	$model->brand_id=>array('view','id'=>$model->brand_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InvnomBrand', 'url'=>array('index')),
	array('label'=>'Create InvnomBrand', 'url'=>array('create')),
	array('label'=>'View InvnomBrand', 'url'=>array('view', 'id'=>$model->brand_id)),
	array('label'=>'Manage InvnomBrand', 'url'=>array('admin')),
);
?>

<h1>Update InvnomBrand <?php echo $model->brand_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>