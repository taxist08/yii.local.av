<?php
/* @var $this CartrigesTypeController */
/* @var $model CartrigesType */

$this->breadcrumbs=array(
    Yii::t("cartriges", 'Cartriges')=>array('/cartriges'),
	Yii::t("cartriges", 'Cartriges Types')=>array('index'),
	$model->type_id,
);

$this->menu=array(

	array('label'=>Yii::t("cartriges", 'List CartrigesType'), 'url'=>array('index')),
	array('label'=>Yii::t("cartriges", 'Create CartrigesType'), 'url'=>array('create')),
	array('label'=>Yii::t("cartriges", 'View CartrigesType'), 'url'=>array('view', 'id'=>$model->type_id)),
	array('label'=>Yii::t("cartriges", 'Manage CartrigesType'), 'url'=>array('admin')),
    
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>