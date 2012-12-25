<?php
/* @var $this GeneController */
/* @var $data Gene */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('gene_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->gene_id), array('view', 'id'=>$data->gene_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gene_symbol')); ?>:</b>
	<?php echo CHtml::encode($data->gene_symbol); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gene_name')); ?>:</b>
	<?php echo CHtml::encode($data->gene_name); ?>
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