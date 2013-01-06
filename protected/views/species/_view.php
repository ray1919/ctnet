<?php
/* @var $this SpeciesController */
/* @var $data Species */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("species/view",array('id'=>$data->id)) ?>','_self')">
<table>
<tr>
<td><b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b></td>
<td><?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?></td>
</tr>
<tr>
<td><b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b></td>
<td><?php echo CHtml::encode($data->name); ?></td>
</tr>

<tr>
<td><b><?php echo CHtml::encode($data->getAttributeLabel('common')); ?>:</b></td>
<td><?php echo CHtml::encode($data->common); ?></td>
</tr>

</table>
</div>
