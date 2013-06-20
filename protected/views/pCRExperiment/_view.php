<?php
/* @var $this PCRExperimentController */
/* @var $data PCRExperiment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gene_id')); ?>:</b>
	<?php echo CHtml::encode($data->gene_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primer_id')); ?>:</b>
	<?php echo CHtml::encode($data->primer_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('primer_fk')); ?>:</b>
	<?php echo CHtml::encode($data->primer_fk); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ct')); ?>:</b>
	<?php echo CHtml::encode($data->ct); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm1')); ?>:</b>
	<?php echo CHtml::encode($data->tm1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tm2')); ?>:</b>
	<?php echo CHtml::encode($data->tm2); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('service_id')); ?>:</b>
	<?php echo CHtml::encode($data->service_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pos')); ?>:</b>
	<?php echo CHtml::encode($data->pos); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plate_type')); ?>:</b>
	<?php echo CHtml::encode($data->plate_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sample_id')); ?>:</b>
	<?php echo CHtml::encode($data->sample_id); ?>
	<br />

	*/ ?>

</div>