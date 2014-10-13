<?php
/* @var $this InvnomBrandController */
/* @var $model InvnomBrand */

$this->breadcrumbs=array(
	'Invnom Brands'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InvnomBrand', 'url'=>array('index')),
	array('label'=>'Manage InvnomBrand', 'url'=>array('admin')),
);
?>

<h1>Create InvnomBrand</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>