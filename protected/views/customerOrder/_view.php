<?php
/* @var $this CustomerOrderController */
/* @var $data CustomerOrder */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("customerOrder/view",array('id'=>$data->id)) ?>','_self')">
<table>
    <tr>
        <td width="25%">
	<?php echo CHtml::link(
                "<b>".CHtml::encode($data->getAttributeLabel('customer_id')).": </b>".
                CHtml::encode($data->customer->title),
                array('customer/view', 'id'=>$data->customer->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('quantity')); ?>:</b>
	<?php echo CHtml::encode($data->quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
       </td>
        <td style="vertical-align: top;">
	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode(substr($data->comment,0,380)."......"); ?>
        </td>
    </tr>
</table>
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	*/ ?>

</div>
