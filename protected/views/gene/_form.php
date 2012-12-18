<?php
/* @var $this GeneController */
/* @var $model Gene */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gene-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'symbol'); ?>
		<?php echo $form->textField($model,'symbol',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'symbol'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tax_id'); ?>
		<?php echo $form->textField($model,'tax_id'); ?>
		<?php echo $form->error($model,'tax_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'synonyms'); ?>
		<?php echo $form->textArea($model,'synonyms',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'synonyms'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type_of_gene'); ?>
		<?php echo $form->textField($model,'type_of_gene',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'type_of_gene'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->