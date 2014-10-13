<?php
/* @var $this DeliveryController */
/* @var $model ProfnastilDelivery */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'delivery_id'); ?>
		<?php echo $form->textField($model,'delivery_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'delivery_name'); ?>
		<?php echo $form->textField($model,'delivery_name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->