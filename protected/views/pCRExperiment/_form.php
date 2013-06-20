<?php
/* @var $this PCRExperimentController */
/* @var $model PCRExperiment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pcrexperiment-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php //echo $form->labelEx($model,'service_id'); ?>
		<?php echo $form->hiddenField($model,'service_id'); ?>
		<?php echo $form->error($model,'service_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'plate_type'); ?>
		<?php echo $form->dropDownList($model,'plate_type',$model->getPlateOptions()); ?>
		<?php echo $form->error($model,'plate_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'ctfile'); ?>
		<?php echo $form->fileField($model,'ctfile'); ?>
		<?php echo $form->error($model,'ctfile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'tmfile'); ?>
		<?php echo $form->fileField($model,'tmfile'); ?>
		<?php echo $form->error($model,'tmfile'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->