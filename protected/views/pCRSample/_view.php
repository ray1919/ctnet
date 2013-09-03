<?php
/* @var $this PCRSampleController */
/* @var $data PCRSample */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("pCRSample/view",array('id'=>$data->id)) ?>','_self')">
<table>
    <tr>
        <td>

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::encode($data->id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />
        </td>
        <td>

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('species_id')); ?>:</b>
	<?php echo CHtml::encode($data->species->name . ' (' . $data->species->common . ')'); ?>
	<br />
        </td>
    </tr>
</table>


</div>