<?php
/* @var $this PrimerController */
/* @var $data Primer */
?>

<div class="view" id='_view' onclick="window.open('<?php echo $this->createUrl("primer/view",array('id'=>$data->id)) ?>','_self')">

<table>
<tr>

<td>
	<?php echo CHtml::encode($data->gene_symbol); ?>
</td>
<td>
	<?php echo CHtml::encode($data->gene_id); ?>
</td>

<td>
	<?php echo CHtml::encode($data->primer_id); ?>
</td>

<td>
	<?php echo CHtml::encode($data->barcode); ?>
</td>

<td>
	<?php echo CHtml::encode($data->tax->name); ?>
</td>

<td>
	<?php echo CHtml::encode($data->type_of_primer); ?>
</td>
</tr>
</table>

</div>
