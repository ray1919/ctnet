<?php
/* @var $this PositionController */
/* @var $data Position */
?>

<div class="view" id='_view' onclick="window.open('<?php echo $this->createUrl("position/view",array('id'=>$data->id)) ?>','_self')">

<table>
<tr>
<td>
	<?php echo CHtml::encode($data->plate->name); ?>
</td>
<td>
	<?php echo CHtml::encode($data->well); ?>
</td>
<td>
	<?php echo CHtml::encode($data->primer->gene_symbol); ?>
</td>

<td>
	<?php echo CHtml::encode($data->primer->gene_id); ?>
</td>
<td>
	<?php echo CHtml::encode($data->primer->primer_id); ?>
</td>

<td>
	<?php echo CHtml::encode($data->storeType->name); ?>
</td>
</tr>

</table>
</div>
