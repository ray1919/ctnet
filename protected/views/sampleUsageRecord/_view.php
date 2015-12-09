<?php
/* @var $this SampleUsageRecordController */
/* @var $data SampleUsageRecord */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("sampleUsageRecord/view",array('id'=>$data->id)) ?>','_self')">
<table>
    <tr>
        <td>
        <b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
        <?php echo CHtml::encode($data->date); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('person')); ?>:</b>
        <?php echo CHtml::encode($data->person); ?>
        <br />
        </td>
        <td>

        <b><?php echo '样本名称'; ?>:</b>
        <?php echo CHtml::encode($data->sample->name); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('volume_left')); ?>:</b>
        <?php echo CHtml::encode($data->volume_left); ?>
        <br />
        </td>
    </tr>
</table>

</div>
