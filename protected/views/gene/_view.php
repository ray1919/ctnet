<?php
/* @var $this GeneController */
/* @var $data Gene */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('symbol')); ?>:</b>
	<?php echo CHtml::encode($data->symbol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tax_id')); ?>:</b>
	<?php echo CHtml::encode($data->tax_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('synonyms')); ?>:</b>
	<?php echo CHtml::encode($data->synonyms); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_of_gene')); ?>:</b>
	<?php echo CHtml::encode($data->type_of_gene); ?>
	<br />


</div>