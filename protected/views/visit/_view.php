<?php
/* @var $this VisitController */
/* @var $data Visit */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("visit/view",array('id'=>$data->id)) ?>','_self')">
    <table>
        <tr>
        <td width="25%">
	<?php echo CHtml::link(
                "<b>".CHtml::encode($data->getAttributeLabel('customer_id')).": </b>".
                CHtml::encode($data->customer->title),
                array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('executor')); ?>:</b>
	<?php echo CHtml::encode($data->executor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('way')); ?>:</b>
	<?php echo CHtml::encode($data->way); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('class')); ?>:</b>
	<?php echo CHtml::encode($data->class); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('time')); ?>:</b>
	<?php echo CHtml::encode($data->time); ?>
	</td>
        <td style="vertical-align: top;">
            <?php echo substr(CHtml::encode($data->comment),0,700)."......"; ?>
	</td>
        </tr>
    </table>
	<?php /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
	<?php echo CHtml::encode($data->create_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->create_user_id); ?>
	<br />

	*/ ?>

</div>
