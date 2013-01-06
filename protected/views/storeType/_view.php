<?php
/* @var $this StoreTypeController */
/* @var $data StoreType */
?>

<div class="view" onclick="window.open('<?php echo $this->createUrl("storeType/view",array('id'=>$data->id)) ?>','_self')">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

</div>
