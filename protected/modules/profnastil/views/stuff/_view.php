<?php
/* @var $this StuffController */
/* @var $data ProfnastilStuff */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('stuff_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->stuff_id), array('view', 'id'=>$data->stuff_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('stuff_name')); ?>:</b>
	<?php echo CHtml::encode($data->stuff_name); ?>
	<br />


</div>