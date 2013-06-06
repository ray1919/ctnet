<?php
/* @var $this PCRServiceController */
/* @var $data PCRService */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("pCRService/view",array('id'=>$data->id)) ?>','_self')">
<table>
    <tr>
        <td>
	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('customer_id')); ?>:</b>
	<?php echo CHtml::encode($data->customer->title); ?>
	<br />
        </td>
        <td>

	<b><?php echo CHtml::encode($data->getAttributeLabel('sample_arrival_date')); ?>:</b>
	<?php echo CHtml::encode($data->sample_arrival_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('report_date')); ?>:</b>
	<?php echo CHtml::encode($data->report_date); ?>
	<br />
        </td>
    </tr>
</table>

</div>