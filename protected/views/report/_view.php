<?php
/* @var $this ReportController */
/* @var $data Report */
?>

<div class="view" id='_view' onclick="window.open('<?php echo $this->createUrl("report/view",array('id'=>$data->id)) ?>','_self')">

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('purpose')); ?>:</b>
	<?php echo $data->purpose; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('experimenter')); ?>:</b>
	<?php echo CHtml::encode($data->experimenter); ?>
	<br />
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sample')); ?>:</b>
	<?php echo CHtml::encode($data->sample); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sampleLayout')); ?>:</b>
	<?php echo CHtml::encode($data->sampleLayout); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cycleProgram')); ?>:</b>
	<?php echo CHtml::encode($data->cycleProgram); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('formula')); ?>:</b>
	<?php echo CHtml::encode($data->formula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('result')); ?>:</b>
	<?php echo CHtml::encode($data->result); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conclusion')); ?>:</b>
	<?php echo CHtml::encode($data->conclusion); ?>
	<br />

	*/ ?>

</div>
