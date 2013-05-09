<?php
/* @var $this CustomerController */
/* @var $data Customer */
?>

<div class="view" id="_view" onclick="window.open('<?php echo $this->createUrl("customer/view",array('id'=>$data->id)) ?>','_self')">

        <table>
          <tr>
            <td>
            <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
            <?php echo CHtml::encode($data->title); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
            <?php echo CHtml::encode($data->name); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('organization')); ?>:</b>
            <?php echo CHtml::encode($data->organization); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('tel1')); ?>:</b>
            <?php echo CHtml::encode($data->tel1); ?>
            <br />

            <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
            <?php echo CHtml::encode($data->email); ?>
            <br />
            </td>
            <td style="vertical-align: top;word-wrap: break-word;">
                <b>Visits:</b>
                <?php echo $times[$data->id];?> 
            </td>
          </tr>
        </table>

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('IM')); ?>:</b>
	<?php echo CHtml::encode($data->IM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	*/ ?>

</div>