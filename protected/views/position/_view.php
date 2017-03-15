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
	<?php echo CHtml::encode($data->synthetic_name); ?>
</td>
<td>
  <?php /*echo CHtml::encode($data->primer->gene_symbol); */?>
	<?php echo CHtml::encode($data->getPrimerColumn($data->id, 'gene_symbol')); ?>
</td>

<td>
  <?php /* echo CHtml::encode($data->primer->gene_id); */ ?>
	<?php echo CHtml::encode($data->getPrimerColumn($data->id, 'gene_id')); ?>
</td>
<td>
  <?php /* echo CHtml::encode($data->primer->primer_id); */ ?>
	<?php echo CHtml::encode($data->getPrimerColumn($data->id, 'primer_id')); ?>
</td>

<td>
	<?php echo CHtml::encode($data->storeType->name); ?>
</td>
</tr>

</table>
</div>
