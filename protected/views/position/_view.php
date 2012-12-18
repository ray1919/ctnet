<?php
/* @var $this PositionController */
/* @var $data Position */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plate_id')); ?>:</b>
	<?php echo CHtml::encode($data->plate_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('well')); ?>:</b>
	<?php echo CHtml::encode($data->well); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gene_id')); ?>:</b>
	<?php echo CHtml::encode($data->gene_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('store_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->store_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />


</div>