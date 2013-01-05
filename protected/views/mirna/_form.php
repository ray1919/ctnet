<?php
/* @var $this MirnaController */
/* @var $model Mirna */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'mirna-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'miRNA_id'); ?>
		<?php echo $form->textField($model,'miRNA_id',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'miRNA_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'accession'); ?>
		<?php echo $form->textField($model,'accession',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'accession'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tax_id'); ?>
		<?php echo $form->textField($model,'tax_id'); ?>
		<?php echo $form->error($model,'tax_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->