<?php
/* @var $this PositionController */
/* @var $model Position */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plate_id'); ?>
		<?php echo $form->textField($model,'plate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'well'); ?>
		<?php echo $form->textField($model,'well',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primer_id'); ?>
		<?php echo $form->textField($model,'primer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'store_type_id'); ?>
		<?php echo $form->textField($model,'store_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'store_date'); ?>
		<?php echo $form->textField($model,'store_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->