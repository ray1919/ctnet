<?php
/* @var $this MirnaController */
/* @var $data Mirna */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('miRNA_id')); ?>:</b>
	<?php echo CHtml::encode($data->miRNA_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('accession')); ?>:</b>
	<?php echo CHtml::encode($data->accession); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_id')); ?>:</b>
	<?php echo CHtml::encode($data->tax_id); ?>
	<br />


</div>