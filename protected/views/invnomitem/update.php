<?php
/* @var $this InvnomitemController */
/* @var $model InvnomItem */

$this->breadcrumbs=array(
	Yii::t("invnom", 'Inventory numbers')=>array('index'),
	$model->item_id=>array('view','id'=>$model->item_id),
	Yii::t("invnom", 'Update'),
);

$this->menu=array(
	array('label'=>'List InvnomItem', 'url'=>array('index')),
	array('label'=>'Create InvnomItem', 'url'=>array('create')),
	array('label'=>'View InvnomItem', 'url'=>array('view', 'id'=>$model->item_id)),
	array('label'=>'Manage InvnomItem', 'url'=>array('admin')),
);
?>

<h1>Update InvnomItem <?php echo $model->item_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>