<?php
/* @var $this PositionController */
/* @var $data Position */
?>

<div class="view" id='_view' onclick="window.open('<?php echo $this->createUrl("position/view",array('id'=>$data->id)) ?>')">

<table>
<tr>
<td>
	<b><?php echo CHtml::encode($data->getAttributeLabel('plate_id')); ?>:</b>
	<?php echo CHtml::encode($data->plate->name); ?>
</td>
<td>
	<b><?php echo CHtml::encode('Gene Symbol'); ?>:</b>
	<?php echo CHtml::encode($data->primer->gene_symbol); ?>
</td>
</tr>

<tr>
<td>
	<b><?php echo CHtml::encode($data->getAttributeLabel('well')); ?>:</b>
	<?php echo CHtml::encode($data->well); ?>
</td>
<td>
	<b><?php echo CHtml::encode('Gene ID'); ?>:</b>
	<?php echo CHtml::encode($data->primer->gene_id); ?>
</td>
</tr>

<tr>
<td>
	<b><?php echo CHtml::encode($data->getAttributeLabel('store_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->storeType->name); ?>
</td>
<td>
	<b><?php echo CHtml::encode('Primer ID'); ?>:</b>
	<?php echo CHtml::encode($data->primer->primer_id); ?>
</td>
</tr>

</table>
</div>
