<?php
/* @var $this StatusController */
/* @var $data ProfnastilStatus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->status_id), array('view', 'id'=>$data->status_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_name')); ?>:</b>
	<?php echo CHtml::encode($data->status_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('color')); ?>:</b>
	<?php echo CHtml::encode($data->color); ?>
	<br />


</div>