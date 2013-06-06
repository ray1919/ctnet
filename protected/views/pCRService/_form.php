<?php
/* @var $this PCRServiceController */
/* @var $model PCRService */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pcrservice-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
                <?php if (!isset($model->date)) $model->date=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->dateField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $this->customer_title; ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'service_type'); ?>
		<?php echo $form->dropDownList($model,'service_type', $model->getTypeOptions()); ?>
		<?php echo $form->error($model,'service_type'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->sample_arrival_date)) $model->sample_arrival_date=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'sample_arrival_date'); ?>
		<?php echo $form->dateField($model,'sample_arrival_date'); ?>
		<?php echo $form->error($model,'sample_arrival_date'); ?>
	</div>

	<div class="row">
                <?php if (!isset($model->report_date)) $model->report_date=date('Y-m-d'); ?>
		<?php echo $form->labelEx($model,'report_date'); ?>
		<?php echo $form->dateField($model,'report_date'); ?>
		<?php echo $form->error($model,'report_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
		<?php echo $form->textArea($model,'note',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->