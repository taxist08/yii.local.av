<?php
/* @var $this CartrigesTypeController */
/* @var $model CartrigesType */

$this->breadcrumbs=array(Yii::t("cartriges", 'Cartriges')=>array('/cartriges'),
	Yii::t("cartriges", 'Cartriges Types')=>array('index'),
	Yii::t("cartriges", 'Create CartrigesType'),
);

$this->menu=array(
    array(
        'label' => Yii::t("cartriges", 'Cartriges'),
        'url' => array('/cartriges'),
        ),
	array('label'=>Yii::t("cartriges", 'List CartrigesType'), 'url'=>array('index')),
	array('label'=>Yii::t("cartriges", 'Manage CartrigesType'), 'url'=>array('admin')),
);
?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>