<?php
/* @var $this DeliveryController */
/* @var $data ProfnastilDelivery */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->delivery_id), array('view', 'id'=>$data->delivery_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('delivery_name')); ?>:</b>
	<?php echo CHtml::encode($data->delivery_name); ?>
	<br />


</div>