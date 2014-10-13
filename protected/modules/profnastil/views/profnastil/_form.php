<?php
/* @var $this ProfnastilController */
/* @var $model Profnastil */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profnastil-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
 <?php echo CHtml::script("
     function split(val) {
      return val.split(/,\s*/);
     }
     function extractLast(term) {
      return split(term).pop();
     }
   ")?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'stuff_id'); ?>
		<?php echo $form->dropDownList($model,'stuff_id', CHtml::listData(ProfnastilStuff::model()->findAll(), 'stuff_id','stuff_name'));  ?>
		<?php echo $form->error($model,'stuff_id'); ?>
	</div>        
        
    <div class="row">
        <?php echo $form->labelEx($model,'mark'); ?>
 <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   'model'=>$model,
   'attribute'=>'mark',
   'source'=>"js:function(request, response) {
      $.getJSON('".$this->createUrl('suggestMark')."', {
        term: extractLast(request.term)
      }, response);
      }",
   'options'=>array(
     'delay'=>300,
     'minLength'=>2,
     'showAnim'=>'fold',
 'multiple'=>true,
     'select'=>"js:function(event, ui) {
         var terms = split(this.value);
         terms.pop();
         terms.push( ui.item.value );
         terms.push('');
         this.value = terms.join('');
         return false;
       }",
   ),
   'htmlOptions'=>array(
     'size'=>'40'
   ),
  ));
  
?>
		<?php echo $form->error($model,'mark'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'raw'); ?>
 <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   'model'=>$model,
   'attribute'=>'raw',
   'source'=>"js:function(request, response) {
      $.getJSON('".$this->createUrl('suggestRaw')."', {
        term: extractLast(request.term)
      }, response);
      }",
   'options'=>array(
     'delay'=>300,
     'minLength'=>2,
     'showAnim'=>'fold',
 'multiple'=>true,
     'select'=>"js:function(event, ui) {
         var terms = split(this.value);
         terms.pop();
         terms.push( ui.item.value );
         terms.push('');
         this.value = terms.join('');
         return false;
       }",
   ),
   'htmlOptions'=>array(
     'size'=>'40'
   ),
  ));
  
?>
		<?php echo $form->error($model,'raw'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'thickness'); ?>
		<?php echo $form->textField($model,'thickness'); ?>
		<?php echo $form->error($model,'thickness'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'length'); ?>
		<?php echo $form->textField($model,'length'); ?>
		<?php echo $form->error($model,'length'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'volume'); ?>
		<?php echo $form->textField($model,'volume'); ?>
		<?php echo $form->error($model,'volume'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
 <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   'model'=>$model,
   'attribute'=>'city',
   'source'=>"js:function(request, response) {
      $.getJSON('".$this->createUrl('suggestCity')."', {
        term: extractLast(request.term)
      }, response);
      }",
   'options'=>array(
     'delay'=>300,
     'minLength'=>2,
     'showAnim'=>'fold',
 'multiple'=>true,
     'select'=>"js:function(event, ui) {
         var terms = split(this.value);
         terms.pop();
         terms.push( ui.item.value );
         terms.push('');
         this.value = terms.join('');
         return false;
       }",
   ),
   'htmlOptions'=>array(
     'size'=>'40'
   ),
  ));
  
?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'delivery_id'); ?>
		<?php echo $form->dropDownList($model,'delivery_id', CHtml::listData(ProfnastilDelivery::model()->findAll(), 'delivery_id','delivery_name'));  ?>
		<?php echo $form->error($model,'delivery_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->