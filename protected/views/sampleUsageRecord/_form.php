<?php
/* @var $this SampleUsageRecordController */
/* @var $model SampleUsageRecord */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'sample-usage-record-form',
  // Please note: When you enable ajax validation, make sure the corresponding
  // controller action is handling ajax validation correctly.
  // There is a call to performAjaxValidation() commented in generated controller code.
  // See class documentation of CActiveForm for details on this.
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
    <?php echo $form->labelEx($model,'person'); ?>
    <?php echo $form->textField($model,'person',array('size'=>20,'maxlength'=>20)); ?>
    <?php echo $form->error($model,'person'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'volume_left'); ?>
    <?php echo $form->textField($model,'volume_left',array('size'=>30,'maxlength'=>30)); ?>
    <?php echo $form->error($model,'volume_left'); ?>
  </div>

  <div class="row">
    <?php echo $form->labelEx($model,'memo'); ?>
    <?php echo $form->textArea($model,'memo',array('rows'=>6, 'cols'=>50)); ?>
    <?php echo $form->error($model,'memo'); ?>
  </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
  </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
