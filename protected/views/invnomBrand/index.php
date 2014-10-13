<?php
/* @var $this InvnomBrandController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Invnom Brands',
);

$this->menu=array(
	array('label'=>'Create InvnomBrand', 'url'=>array('create')),
	array('label'=>'Manage InvnomBrand', 'url'=>array('admin')),
);
?>

<h1>Invnom Brands</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
