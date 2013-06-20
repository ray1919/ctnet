<?php
/* @var $this PCRExperimentController */
/* @var $model PCRExperiment */
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
		<?php echo $form->label($model,'gene_id'); ?>
		<?php echo $form->textField($model,'gene_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primer_id'); ?>
		<?php echo $form->textField($model,'primer_id',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'primer_fk'); ?>
		<?php echo $form->textField($model,'primer_fk'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ct'); ?>
		<?php echo $form->textField($model,'ct'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm1'); ?>
		<?php echo $form->textField($model,'tm1'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tm2'); ?>
		<?php echo $form->textField($model,'tm2'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'service_id'); ?>
		<?php echo $form->textField($model,'service_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'pos'); ?>
		<?php echo $form->textField($model,'pos',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plate_type'); ?>
		<?php echo $form->textField($model,'plate_type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sample_id'); ?>
		<?php echo $form->textField($model,'sample_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->