<?php
/* @var $this InvnomitemController */
/* @var $data InvnomItem */
?>

<tr>
    <td><?php echo CHtml::encode($data->distribution); ?></td>
    <td><?php echo CHtml::encode($data->type->type_name); ?></td>
    <td><?php echo CHtml::encode($data->inv_nom); ?></td>
    <td><?php echo CHtml::encode($data->item_model); ?></td>
    <td><?php echo CHtml::encode($data->item_sn); ?></td>
</tr>


<!--
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->item_id), array('view', 'id'=>$data->item_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_id')); ?>:</b>
	<?php echo CHtml::encode($data->type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_add')); ?>:</b>
	<?php echo CHtml::encode($data->date_add); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('distribution')); ?>:</b>
	<?php echo CHtml::encode($data->distribution); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inv_nom')); ?>:</b>
	<?php echo CHtml::encode($data->inv_nom); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_model')); ?>:</b>
	<?php echo CHtml::encode($data->item_model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_sn')); ?>:</b>
	<?php echo CHtml::encode($data->item_sn); ?>
	<br />


</div>

-->