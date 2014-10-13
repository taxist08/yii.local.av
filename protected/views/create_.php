<?php
/* @var $this QueueSkController */
/* @var $model QueueSk */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'queue-sk-create-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'queue_number'); ?>
		<?php echo $form->textField($model,'queue_number'); ?>
		<?php echo $form->error($model,'queue_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destination_name'); ?>
		<?php echo $form->textField($model,'destination_name'); ?>
		<?php echo $form->error($model,'destination_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_out'); ?>
		<?php echo $form->textField($model,'date_out'); ?>
		<?php echo $form->error($model,'date_out'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'priority'); ?>
		<?php echo $form->textField($model,'priority'); ?>
		<?php echo $form->error($model,'priority'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->