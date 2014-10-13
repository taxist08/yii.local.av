<?php
/* @var $this CartrigesTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(Yii::t("cartriges", 'Cartriges')=>array('/cartriges'),
	Yii::t("cartriges", 'Cartriges Types'),
);

$this->menu=array(
    array(
        'label' => Yii::t("cartriges", 'Cartriges'),
        'url' => array('/cartriges'),
        ),
	array('label'=>Yii::t("cartriges", 'Create CartrigesType'), 'url'=>array('create')),
	array('label'=>Yii::t("cartriges", 'Manage CartrigesType'), 'url'=>array('admin')),
);
?>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
