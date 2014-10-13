<?php
/* @var $this QueueSkController */
/* @var $model QueueSk */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'queue-sk-create-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'queue_number'); ?>
		<?php echo $form->textField($model, 'queue_number', array('readonly' => !$model->
    isNewRecord)); ?>
		<?php echo $form->error($model, 'queue_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'destination_name'); ?>
		<?php echo $form->textField($model, 'destination_name'); ?>
		<?php echo $form->error($model, 'destination_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'quantity'); ?>
		<?php echo $form->textField($model, 'quantity'); ?>
		<?php echo $form->error($model, 'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'car_number'); ?>
		<?php echo $form->textField($model, 'car_number'); ?>
		<?php echo $form->error($model, 'car_number'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model, 'car_info'); ?>
		<?php echo $form->textField($model, 'car_info'); ?>
		<?php echo $form->error($model, 'car_info'); ?>
	</div>    
	<div class="row">
		<?php echo $form->labelEx($model, 'date_out'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name' => 'date_out',
    'model' => $model,
    'attribute' => 'date_out',
    'language' => 'ru',
    'value' => date('Y-m-d', time() + 24 * 60 * 60),
    'options' => array(
        'showAnim' => 'slideDown',
        'dateFormat' => 'yy-mm-dd',
        'defaultDate' => date('Y-m-d', time() + 24 * 60 * 60),
        'minDate' => '0',
        'disabled' => !$model->isNewRecord,
        ),
    'htmlOptions' => array('style' => 'height:20px;'),
    )); ?>
		<?php echo $form->error($model, 'date_out'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->labelEx($model, 'attach'); ?>
		<?php echo CHtml::activeFileField($model, 'attach'); ?>
		<?php echo $form->error($model, 'attach'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? Yii::t("sk", 'Create') :
Yii::t("sk", 'Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->