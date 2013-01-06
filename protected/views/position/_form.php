<?php
/* @var $this PositionController */
/* @var $model Position */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'position-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'plate_id'); ?>
    <?php echo $form->dropDownList($model,'plate_id', $model->getPlateName()); ?>
		<?php echo $form->error($model,'plate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'well'); ?>
		<?php echo $form->textField($model,'well',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'well'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'primer_id'); ?>
		<?php echo $form->textField($model,'primer_id'); ?>
		<?php echo $form->error($model,'primer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'store_type_id'); ?>
    <?php echo $form->dropDownList($model,'store_type_id', $model->getStoreType()); ?>
		<?php echo $form->error($model,'store_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php $model->store_date=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'store_date'); ?>
		<?php echo $form->dateField($model,'store_date'); ?>
		<?php echo $form->error($model,'store_date'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
