<?php
/* @var $this QueueSkController */
/* @var $model QueueSk */

$this->breadcrumbs = array(
    Yii::t("sk", 'queue sk') => array('index'),
    $model->queue_id,
    );
if ($model->user_id == Yii::app()->user->id) {
    $owner = true;
} else {
    $owner = false;
}
$this->menu = array(

    array('label' => Yii::t("sk", 'queue sk'), 'url' => array('index')),
    array(
        'label' => Yii::t("sk", 'Priority Up'),
        'url' => array('#', 'id' => $model->queue_id),
        'visible' => Yii::app()->user->checkAccess('skTopmanager'),
        'linkOptions'=>array('submit'=>array('priorityup','id'=>$model->queue_id),'confirm'=>Yii::t("sk", 'Priority Up').'?'),
        ),
    array(
        'label' => Yii::t("sk", 'Priority Down'),
        'url' => array('#', 'id' => $model->queue_id),
        'visible' => Yii::app()->user->checkAccess('skTopmanager'),
        'linkOptions'=>array('submit'=>array('prioritydown','id'=>$model->queue_id),'confirm'=>Yii::t("sk", 'Priority Down').'?'),
        ),        
    /*    array(
    'label' => Yii::t("sk", 'Change status'),
    'url' => array('chengestatus', 'id' => $model->queue_id),
    'visible' => Yii::app()->user->checkAccess('invnomCreator'),
    ),
*/
    array(
    'label' => Yii::t("sk", 'Update'),
    'url' => array('update', 'id' => $model->queue_id),
    'visible' => $owner,
    ),
  
    array(
        'label' => Yii::t("sk", 'Delete'),
        'url' => array('delete', 'id' => $model->queue_id),
        'visible' => ($owner && $model->statusCount == 1),
        ),
    );
?>

<h1><?php echo Yii::t("sk", 'View information of') . $model->queue_number; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,

    'attributes' => array(
    'description:html', 
        array(
            'name' => 'queue_number',
            'label' => Yii::t("sk", 'Queue number'),
            'value' => $model->queue_number,
            ),
        array(
            'name' => 'destination_name',
            'label' => Yii::t("sk", 'Destination'),
            'value' => $model->destination_name,
            ),
        array(
            'name' => 'quantity',
            'label' => Yii::t("sk", 'Quantity'),
            'value' => $model->quantity,
            ),
        array(
            'name' => 'date_out',
            'label' => Yii::t("sk", 'Date Out'),
            'value' => $model->date_out,
            ),
        array(
            'name' => 'seal',
            'label' => Yii::t("sk", 'Seal'),
            'value' => $model->seal,
            'visible' => ($model->seal),
            ),  
        array(
            'name' => 'car_number',
            'label' => Yii::t("sk", 'Car number'),
            'value' => $model->car_number,
            ),
        array(
            'name' => 'car_info',
            'label' => Yii::t("sk", 'Car info'),
            'value' => $model->car_info,
            ),                         
        array(
            'name' => 'attach',
            'label' => Yii::t("sk", 'Attach'),
            'type'=>'raw',
            'value' => CHtml::link($model->attach,array('queuesk/download','id'=>$model->queue_id)),
            'visible' => ($model->attach),
            ),                     
        ),
    )); ?>




<h2><?php echo Yii::t("sk", 'Status change'); ?></h2>    

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $status,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'user_id',
            'header' => Yii::t("sk", 'User'),
            'value' => '$data->user_id?$data->user->full_name:""',
            'sortable' => true,
            ),
        array(
            'name' => 'date_add',
            'header' => Yii::t("sk", 'Date'),
            'value' => 'date("Y-m-d H:i",$data->date_add)',
            'sortable' => true,
            ),
        array(
            'name' => 'Comment/Status',
            'header' => Yii::t("sk", 'Comment/Status'),
            'value' => '$data->status_type->status_name',
            'sortable' => true,
            ),
        ),
    ));
?>
<?php if (Yii::app()->user->checkAccess('skSklad')){ ?> 
<div class="form">
<?php $form = $this->beginWidget('CActiveForm'); ?>
 
    <?php echo $form->errorSummary($model); ?>
 
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo CHtml::dropDownList('changeStatus', $model->status[0]->
status_id, CHtml::listData(QueueSkStatusType::model()->findAll(), 'type_id',
    'status_name')); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'seal'); ?>
        <?php echo CHtml::textField('seal',$model->seal,array('disabled'=>$model->seal)); ?>
    </div>
 
    <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t("sk", 'Change status')); ?>
    </div>
 
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php } ?>
<h2><?php echo Yii::t("sk", 'Comments'); ?></h2>    

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $comments,
    'template' => '{items}',
    'columns' => array(
        array(
            'name' => 'user_id',
            'header' => Yii::t("sk", 'User'),
            'value' => '$data->user_id?$data->user->full_name:""',
            'sortable' => true,
            ),
        array(
            'name' => 'date_add',
            'header' => Yii::t("sk", 'Date'),
            'value' => 'date("Y-m-d H:i",$data->date_add)',
            'sortable' => true,
            ),
        array(
            'name' => 'Comments',
            'header' => Yii::t("sk", 'comments'),
            'value' => '$data->comment',
            'sortable' => true,
            ),
        ),
    ));
?>
<?php if (Yii::app()->user->checkAccess('skAddComment')){ ?> 
<div class="form">
<?php $form = $this->beginWidget('CActiveForm'); ?>
 
    <?php echo $form->errorSummary($model); ?>
 
    <div class="row">
        <?php echo CHtml::textArea('comment', '', array('id' => 'idTextField',
    'style' => 'width:100%;height:120px;')); ?>
    </div>
 
    <div class="row submit">
        <?php echo CHtml::submitButton(Yii::t("sk", 'Add comment')); ?>
    </div>
 
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php } ?>