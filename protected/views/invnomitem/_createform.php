<?php
$this->breadcrumbs = array(
    Yii::t("invnom", 'Inventory numbers') => array('index'),
    Yii::t("invnom", 'Create item'),
    );
$this->menu = array();    
?>
<h1><?php echo Yii::t("invnom", 'Create item');?></h1>
 
<div class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>
<?php echo CHtml::errorSummary($model); ?>
<?php //echo $form; ?>

 <?php echo CHtml::script("
     function split(val) {
      return val.split(/,\s*/);
     }
     function extractLast(term) {
      return split(term).pop();
     }
   ")?>
<!-- Тип устройства -->   
<label for="InvnomItem_type_id" class="required"><?php echo Yii::t("invnom", 'Device type');?> <span class="required">*</span></label>
<div class="row">
<?php echo  CHtml::dropDownList('InvnomItem[type_id]',
         Yii::t("invnom", 'Device type'), 
         InvnomItemType::model()->getTypeList()
              
              );
?>
</div>   
<!-- Поставщик -->
<label for="InvnomItem_distribution" class="required"><?php echo Yii::t("invnom", 'Distribution');?> <span class="required">*</span></label>
<div class="row">
 <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   'model'=>$model,
   'attribute'=>'distribution',
    //'value' => $model->brand_id,
   'source'=>"js:function(request, response) {
      $.getJSON('".$this->createUrl('suggestDist')."', {
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
<!-- Производитель -->
<label for="InvnomItem_brand_id" class="required"><?php echo Yii::t("invnom", 'Brand');?> <span class="required">*</span></label>
<div class="row">
 <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   'model'=>$model,
   'attribute'=>'brand_id',
    'value' => $model->brand_id,
   'source'=>"js:function(request, response) {
      $.getJSON('".$this->createUrl('suggestBrand')."', {
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
<!-- Модель -->
<label for="InvnomItem_item_model" class="required"><?php echo Yii::t("invnom", 'Device Model');?> <span class="required">*</span></label>
<div class="row">
 <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   'model'=>$model,
   'attribute'=>'item_model',
    //'value' => $model->brand_id,
   'source'=>"js:function(request, response) {
      $.getJSON('".$this->createUrl('suggest')."', {
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

  // Для подсветки набираемого куска запроса в предлагаемом списке
  Yii::app()->clientScript->registerScript('unique.script.identifier', "
 $('#InvnomItem_brand_id').data('autocomplete')._renderItem = function( ul, item ) {
   var re = new RegExp( '(' + $.ui.autocomplete.escapeRegex(this.term) + ')', 'gi' );
   var highlightedResult = item.label.replace( re, '<b>$1</b>' );
   return $( '<li></li>' )
     .data( 'item.autocomplete', item )
     .append( '<a>' + highlightedResult + '</a>' )
     .appendTo( ul );
 };
 $('#InvnomItem_item_model').data('autocomplete')._renderItem = function( ul, item ) {
   var re = new RegExp( '(' + $.ui.autocomplete.escapeRegex(this.term) + ')', 'gi' );
   var highlightedResult = item.label.replace( re, '<b>$1</b>' );
   return $( '<li></li>' )
     .data( 'item.autocomplete', item )
     .append( '<a>' + highlightedResult + '</a>' )
     .appendTo( ul );
 };
 $('#InvnomItem_distribution').data('autocomplete')._renderItem = function( ul, item ) {
   var re = new RegExp( '(' + $.ui.autocomplete.escapeRegex(this.term) + ')', 'gi' );
   var highlightedResult = item.label.replace( re, '<b>$1</b>' );
   return $( '<li></li>' )
     .data( 'item.autocomplete', item )
     .append( '<a>' + highlightedResult + '</a>' )
     .appendTo( ul );
 }; 
"); 
?>
</div>
<label class="required"><?php echo Yii::t("invnom", 'Quantity');?> <span class="required">*</span></label>
<div class="row">
<select name="InvnomItem[quantity]">
<?php
for ($i=1;$i<=20;$i++){
    echo '<option>'.$i.'</option>';
}
?>
</select>
</div>


<div>

<?php echo CHtml::submitButton(Yii::t("invnom", 'Preview')); ?>

</div>
<?php $this->endWidget(); ?>
</div>