<?php
/* @var $this InvnomitemController */
/* @var $model InvnomItem */

$this->breadcrumbs=array(
	Yii::t("invnom", 'Inventory numbers')=>array('index'),
	Yii::t("invnom", 'Create'),
);

$this->menu=array(
	array('label'=>'List InvnomItem', 'url'=>array('index')),
	array('label'=>'Manage InvnomItem', 'url'=>array('admin')),
);
?>

<h1>Create InvnomItem</h1>

<?php echo $this->renderPartial('_createform', array('model'=>$model)); ?>