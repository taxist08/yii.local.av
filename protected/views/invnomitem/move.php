<?php
/* @var $this InvnomitemController */
/* @var $model InvnomItem */

$this->breadcrumbs = array(
    Yii::t("invnom", 'Inventory numbers') => array('index'),
    $model->item_id,
    );

$this->menu = array(
    array('label' => Yii::t("invnom", 'Inventory numbers'), 'url' => array('index')),

    array(
        'label' => Yii::t("invnom", 'Create item'),
        'url' => array('create'),
        'visible' => Yii::app()->user->checkAccess('invnomCreator'),
        ),

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
            'name' => 'date_add',
            'label' => Yii::t("invnom", 'Date add'),
            'value' => date("Y-m-d", $model->date_add),
            ),
        ),
    )); ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invnom-move-move-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>
<?php echo $form->errorSummary($move); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>
<?php if(!$model->item_sn){?>
    <div class="row">
		<?php echo $form->labelEx($model,'item_sn'); ?>
		<?php echo $form->textField($model,'item_sn'); ?>
		<?php echo $form->error($model,'item_sn'); ?>
	</div>

<?php
}
?>

	<div class="row">
		<?php echo $form->labelEx($move,'destination_name'); ?>
		<?php echo $form->textField($move,'destination_name'); ?>
		<?php echo $form->error($move,'destination_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($move,'comments'); ?>
		<?php echo $form->textArea($move,'comments'); ?>
		<?php echo $form->error($move,'comments'); ?>
	</div>
    <div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div> 
    <?php $this->endWidget(); ?>   
</div><!-- form -->    