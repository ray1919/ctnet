<?php
/* @var $this GeneController */
/* @var $data Gene */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("gene/view",array('id'=>$data->gene_id)) ?>','_self')">
<table>
<tr>
	<td><?php echo CHtml::encode($data->gene_id); ?></td>

	<td><?php echo CHtml::encode($data->gene_symbol); ?></td>

	<td><?php echo CHtml::encode($data->tax->name); ?></td>

	<td><?php echo CHtml::encode($data->type_of_gene); ?></td>
</tr>
</table>
</div>
