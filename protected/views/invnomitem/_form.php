<?php
/* @var $this InvnomitemController */
/* @var $model InvnomItem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invnom-item-form',
	'enableAjaxValidation'=>true,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type_id'); ?>
		<?php echo $form->textField($model,'type_id'); ?>
		<?php echo $form->error($model,'type_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'brand_id'); ?>
		<?php echo $form->textField($model,'brand_id'); ?>
		<?php echo $form->error($model,'brand_id'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'date_add'); ?>
		<?php echo $form->textField($model,'date_add'); ?>
		<?php echo $form->error($model,'date_add'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'distribution'); ?>
		<?php echo $form->textField($model,'distribution',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'distribution'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inv_nom'); ?>
		<?php echo $form->textField($model,'inv_nom'); ?>
		<?php echo $form->error($model,'inv_nom'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_model'); ?>
		<?php echo $form->textField($model,'item_model',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'item_model'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_sn'); ?>
		<?php echo $form->textField($model,'item_sn',array('size'=>60,'maxlength'=>150)); ?>
		<?php echo $form->error($model,'item_sn'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->