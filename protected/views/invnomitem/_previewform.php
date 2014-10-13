<?php
$this->breadcrumbs = array(
    Yii::t("invnom", 'Inventory numbers') => array('index'),
    Yii::t("invnom", 'Create item'),
    );
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
    'template' => '{items}',
    'dataProvider' => new CArrayDataProvider($items),
    'columns' => array(
        array(
            'name' => 'distribution',
            'header' => Yii::t("invnom", 'Distribution'),
            'value' => '$data["distribution"]',
            'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),
        array(
            'name' => 'type_id',
            'header' => Yii::t("invnom", 'Device type'),
            'value' => '$data["type_name"]',
            'sortable' => true,
            ),
        array(
            'name' => 'inv_nom',
            'header' => Yii::t("invnom", 'Inventory number'),
            'value' => '$data["inv_nom"]',
            'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),
        array(
            'name' => 'item_model',
            'header' => Yii::t("invnom", 'Device Model'),
            'value' => '$data["item_model"]',
            'htmlOptions' => array('style' => 'white-space: nowrap;'),
            'sortable' => true,
            ),
        ),
    //	'itemView'=>'_view',
    )); ?>    

 
<div
 class="form">
<?php $form=$this->beginWidget('CActiveForm'); ?>
<?php foreach($items as $i=>$item){
    foreach ($item as $name=>$value){
        echo '<input type="hidden" name="InvnomPreview['.$i.']['.$name.']" value="'.$value.'"/>';
    }    
}
?>
<?php echo CHtml::submitButton(Yii::t("invnom", 'Create item')); ?>
<?php $this->endWidget(); ?>
</div>