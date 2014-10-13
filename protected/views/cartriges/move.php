<?php


$this->breadcrumbs = array(Yii::t("cartriges", 'Cartriges')=>array('index'),$model->cartrige_id,);
$this->menu = array(
        array('label' => Yii::t("cartriges", 'Cartriges'), 'url' => array('index')),
        array(
        'label' => Yii::t("cartriges", 'ADD cartrige'),
        'url' => array('create'),
        'visible' => Yii::app()->user->checkAccess('cartrigeManager'),
        ), );
?>
<h2><?php echo Yii::t("cartriges", 'View information of ') . $model->cartrige_id; ?></h2>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,

    'attributes' => array(
        array(
            'name' => 'type_id',
            'label' => Yii::t("cartriges", 'Type'),
            'value' => $model->type->model_name,
            ),
        array(
            'name' => 'comment',
            'label' => Yii::t("cartriges", 'Comments'),
            'value' => $model->comment,
            ),            
        ),
    )); ?> 
<h2><?php echo Yii::t("cartriges", 'Status history'); ?></h2>    

<?php
/*
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $statuses,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'user_id',
            'header' => Yii::t("cartriges", 'User'),
            'value' => '$data->user_id?$data->user->full_name:""',
            'sortable' => true,
            ),
        array(
            'name' => 'move_date',
            'header' => Yii::t("cartriges", 'Date'),
            'value' => 'date("Y-m-d",$data->move_date)',
            'sortable' => true,
            ),
        array(
            'name' => 'destination',
            'header' => Yii::t("cartriges", 'Destination'),
            'value' => '$data->destination',
            'sortable' => true,
            ),
        array(
            'name' => 'move_type',
            'header' => Yii::t("cartriges", 'Status'),
            'value' => '$data->mtype->type_name',
            ),
        ),
    ));
*/
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cartriges-move-form',
	'enableAjaxValidation'=>true,
)); ?>


<?php echo $form->errorSummary($move); ?>
 <?php echo CHtml::script("
     function split(val) {
      return val.split(/,\s*/);
     }
     function extractLast(term) {
      return split(term).pop();
     }
   ")?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>


<label for="CartrigesMove_destination" class="required"><?php echo Yii::t("cartriges", 'Destination');?> <span class="required">*</span></label>
<div class="row">
 <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   'model'=>$move,
   'attribute'=>'destination',
   'source'=>"js:function(request, response) {
      $.getJSON('".$this->createUrl('suggestDest')."', {
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
         // remove the current input
         terms.pop();
         // add the selected item
         terms.push( ui.item.value );
         // add placeholder to get the comma-and-space at the end
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
</div>


	<div class="row">
		<?php echo $form->labelEx($move,'move_type'); ?>
		<?php echo $form->dropDownList($move,'move_type',CHtml::listData(CartrigesMoveType::model()->findAll(), 'move_type','type_name'), array('empty'=>'Select type')); ?>
        <?php echo $form->error($move,'destination_name'); ?>
	</div>
    <div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div> 
    <?php $this->endWidget(); ?>   
</div><!-- form -->    