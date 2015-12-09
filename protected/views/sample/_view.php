<?php
/* @var $this SampleController */
/* @var $data Sample */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("sample/view",array('id'=>$data->id)) ?>','_self')">
<table>
    <tr>
        <td>
        <b><?php echo CHtml::encode($data->getAttributeLabel('arrival_date')); ?>:</b>
        <?php echo CHtml::encode($data->arrival_date); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('source')); ?>:</b>
        <?php echo CHtml::encode($data->source); ?>
        <br />
        </td>
        <td>

        <b><?php echo CHtml::encode($data->getAttributeLabel('purpose')); ?>:</b>
        <?php echo CHtml::encode($data->purpose); ?>
        <br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
        <?php echo CHtml::encode($data->name); ?>
        <br />
        </td>
    </tr>
</table>

</div>
