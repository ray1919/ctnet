<?php
/* @var $this MirnaController */
/* @var $data Mirna */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("mirna/view",array('id'=>$data->id)) ?>','_self')">

<table>
<tr>
<td><?php echo CHtml::encode($data->id); ?></td>

<td><?php echo CHtml::encode($data->miRNA_id); ?></td>

<td><?php echo CHtml::encode($data->accession); ?></td>

<td><?php echo CHtml::encode($data->tax->name); ?></td>
</tr>
</table>

</div>
