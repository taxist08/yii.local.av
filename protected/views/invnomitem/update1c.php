<?php
/* @var $this InvnomitemController */
/* @var $model InvnomItem */

$this->breadcrumbs=array(
	Yii::t("invnom", 'Inventory numbers')=>array('index'),
	$model->item_id=>array('view','id'=>$model->item_id),
	Yii::t("invnom", 'Edit 1c'),
);

$this->menu=array(
	array('label'=>Yii::t("invnom", 'Inventory numbers'), 'url'=>array('index')),
);
?>
<h1><?php echo Yii::t("invnom", 'View information of ') . $model->inv_nom; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,

    'attributes' => array(
        array(
            'name' => 'type_name',
            'label' => Yii::t("invnom", 'Device type'),
            'value' => $model->type->type_name,
            ),
        array(
            'name' => 'brand',
            'label' => Yii::t("invnom", 'Brand'),
            'value' => $model->brand->brand_name,
            ),
        array(
            'name' => 'item_model',
            'label' => Yii::t("invnom", 'Device Model'),
            'value' => $model->item_model,
            ),
        array(
            'name' => 'item_sn',
            'label' => Yii::t("invnom", 'Device SN'),
            'value' => $model->item_sn,
            ),
        array(
            'name' => 'inv_1c',
            'label' => Yii::t("invnom", 'Inventory 1c'),
            'value' => $model->inv_1c?$model->inv_1c:"",
            ),            
        array(
            'name' => 'date_add',
            'label' => Yii::t("invnom", 'Date add'),
            'value' => date("Y-m-d", $model->date_add),
            ),
        ),
    )); ?>


<?php echo $this->renderPartial('_form1c', array('model'=>$model)); ?>