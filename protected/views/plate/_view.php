<?php
/* @var $this PlateController */
/* @var $data Plate */
?>

<div class="view" onclick="window.open('<?php echo $this->createUrl("plate/view",array('id'=>$data->id)) ?>','_self')">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

</div>
